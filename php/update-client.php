<?php
 session_start();
 require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
 try{
      $name=stripslashes(htmlspecialchars(trim($_POST['name'])));
      $lastname=stripslashes(htmlspecialchars(trim($_POST['lastname'])));
      $telephone=stripslashes(htmlspecialchars(trim($_POST['telephone'])));
      $email=stripslashes(htmlspecialchars(trim($_POST['email'])));
      $user_id=stripslashes(htmlspecialchars(trim($_POST['user_id'])));
     
      $userdetails=getUserDetails($user_id);
      $dbname=DATABASE_NAME;
      $isFieldUpdated=false;
      $baseupdatesql="update $dbname.User_Details set ";
     
      if($name!=$userdetails['name']){
          $isFieldUpdated=true;
          $baseupdatesql=$baseupdatesql." user_first_name='$name',";
      }
      if($lastname!=$userdetails['surname']){
          $isFieldUpdated=true;
          $baseupdatesql=$baseupdatesql." user_last_name='$lastname',";
      }
     if($telephone!=$userdetails['telephone']){
          $isFieldUpdated=true;
          $baseupdatesql=$baseupdatesql." user_login_mobile_no='$telephone',";
      }
     if($email!=$userdetails['email']){
          $isFieldUpdated=true;
          $baseupdatesql=$baseupdatesql." user_email_id1='$email',";
      }
     
     $baseupdatesql=substr($baseupdatesql,0,strlen($baseupdatesql)-1);
     $baseupdatesql=$baseupdatesql." where user_id=$user_id";
     
     if($isFieldUpdated){
         updateClientDetails($baseupdatesql);
     }
     echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>'NA']);
     
 }catch(Exception $e){
     echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]);
 }

function updateClientDetails($baseupdatesql){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           $result=mysqli_query($conn,$baseupdatesql);
          
           if(!$result){
               throw new Exception("Database error::$baseupdatesql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}

function getUserDetails($user_id){
    try{
         
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $userdetails=array();
           $sql="select user_first_name name,user_last_name surname,user_alt_contact2 telephone,user_email_id1 email from $dbname.User_Details where user_id=$user_id";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $userdetails['name']=$row['name'];
                $userdetails['surname']=$row['surname'];
                $userdetails['telephone']=$row['telephone'];
                $userdetails['email']=$row['email'];
           }
          mysqli_close($conn);
          
          return $userdetails;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}
?>