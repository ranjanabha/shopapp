<?php
header('Access-Control-Allow-Origin: *');

if(!session_id()){
    session_start();
}

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");

try{
  $username=stripslashes(htmlspecialchars(trim($_POST['username'])));
  $password=stripslashes(htmlspecialchars(trim($_POST['password'])));

   

   checkIfUserIsValid($username,$password); 
    
}catch(Exception $e){
    echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function getShopId($username,$conn,$dbname){
    
    try{
           $sql="select x1.shop_id from $dbname.Login x,$dbname.shop_details x1 where x.login_id=x1.shop_login_id and x.login_username='$username'";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                return $row['shop_id'];
           }
    }catch(Exception $e){
        throw $e;
    }
    
}

function getClientId($username,$conn,$dbname){
	try{
		$sql="select x1.user_ID user_id from $dbname.Login x,$dbname.User_Details x1 where x.login_id=x1.user_Login_ID and x.login_username='$username'";

		$result=mysqli_query($conn,$sql);
		if(!$result){
			throw new Exception("Database error::$sql");
		}
		$rowcount=mysqli_num_rows($result);

		if($rowcount>0){
			$row=mysqli_fetch_array($result);
			return $row['user_id'];
		}

	}catch(Exception $e){
		throw $e;
	}
}


function getShopAdminId($username,$conn,$dbname){
    try{
        $sql="select x1.Doc_ID doc_id from $dbname.Login x,$dbname.doctor_details x1 where x.login_id=x1.Doc_Login_ID and x.login_username='$username'";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                return $row['doc_id'];
           }
        
    }catch(Exception $e){
        throw $e;
    }
}


function checkIfUserIsValid($username,$password){
      try{
          $loginType="";
          $shopid="";
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select x.client_login_type loginType from $dbname.Login x where x.Login_Username='$username' and x.Login_Password='$password'";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $loginType=$row['loginType'];
           }
           
            if ($loginType=='Client'){
          	$clientid=getClientId($username,$conn,$dbname);
          		echo json_encode(['OPERATION'=>0,'CLIENTID'=>$clientid]);
	          }
          
          else{
              throw new Exception(LOGIN_FAILED);
          }

          mysqli_close($conn);
          
          
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}

?>