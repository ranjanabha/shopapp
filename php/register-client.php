<?php
header('Access-Control-Allow-Origin: *');
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
                $firstName=stripslashes(htmlspecialchars(trim($_POST['firstName'])));
                $lastName=stripslashes(htmlspecialchars(trim($_POST['lastName'])));
                $email=stripslashes(htmlspecialchars(trim($_POST['email'])));
                $username=stripslashes(htmlspecialchars(trim($_POST['username'])));
                $password=stripslashes(htmlspecialchars(trim($_POST['password'])));
               
                               
                //checking if username is already present   
                $checkuser=isUserAlreadyRegistered($username,DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
                //echo $checkuser;
                if($checkuser){
                   
                    echo json_encode(['OPERATION'=>1,'IMAGE_URL'=>'NA','VALIDATION_ERROR'=>USERNAME_ALREADY_PRESENT]);
                } else{
                        //insert user data and upload file in server.
                    
                      
                       
                     registerClientData($firstName,$lastName,$email,$username,$password);

                        
                          //  echo json_encode(['OPERATION'=>0,'IMAGE_URL'=>$targetfile,'VALIDATION_ERROR'=>'NA']);
                        } 

            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>1,'IMAGE_URL'=>'NA','VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
    function isUserAlreadyRegistered($username,$servername,$db_username,$db_password,$db){
      try{
          $isuserpresent=false;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="select count(*) count_user from $dbname.Login x where x.Login_Username='$username'";
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                if($row['count_user'] >0){
                    $isuserpresent=true; 
                }
             
           }

          mysqli_close($conn);
          return $isuserpresent;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
       
        
    }
    
   function  registerClientData($firstName,$lastName,$email,$username,$password){
       
       try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into  $dbname.Login (Login_Username,Login_Password,Login_Mobile_No,Login_Type,Client_Login_Type ) values('$username','$password','NA','NA','Client')";
              
           
           $result=mysqli_query($conn,$sql);
           if($result){
              $loginId=selectLogInIdforSuppliedUsername($username,$conn,$dbname);
              insertClientDetails($loginId,$firstName,$lastName,$email,$conn,$dbname) ; 
               
              
                 
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
       
       
   }



function selectLogInIdforSuppliedUsername($username,$conn,$dbname){
  try{    
        $sql="select Login_ID from $dbname.Login where Login_Username='$username'";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
          }  
         if(mysqli_num_rows($result)>0){
              $row=mysqli_fetch_array($result);
              $login_id=$row['Login_ID'];
              return $login_id;
         }
    }catch(Exception $e){
      throw $e;
  }  
}

function   insertClientDetails($loginId,$firstName,$lastName,$email,$conn,$dbname){
    try{
    	
    	$qrCode = rand(10000000, 99999999); 
    	
        $sql="insert into $dbname.User_Details (User_Login_ID,user_first_name,user_last_name,User_email_id1,user_status,user_qr_code) values($loginId,'$firstName','$lastName','$email','Connected','$qrCode')";
        
        $result=mysqli_query($conn,$sql);
        
        
        if(!$result){
            throw new Exception("Database error::$result");
        }   
        
        else 
        {
        	echo json_encode(['OPERATION'=>0]);
        }
        
        
        
    }catch(Exception $e){
        throw $e;
    }
}






?>