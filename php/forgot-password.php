<?php
   require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $username=stripslashes(htmlspecialchars(trim($_POST['username_forgetpassword'])));
    $email=stripslashes(htmlspecialchars(trim($_POST['email_forgetpassword'])));
    
    if(empty($username)){
       $message=REQUIRED_FIELD_NULL;
       $final_message=str_replace("{1}","username",$message);
       throw new Exception($final_message);
    }

    if(empty($email)){
       $message=REQUIRED_FIELD_NULL;
       $final_message=str_replace("{1}","email",$email);
       throw new Exception($final_message);
    }
    
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        throw new Exception(EMAIL_NOT_VALID);
    }
    
    $userdetail=checkifUserIsRegistered($username);
    
    $usernamedb=$userdetail['username'];
    $passworddb=$userdetail['password'];
    
    $to = $email; 
    $email_subject = "Forgot username,password-Dappoint Admin";
    $email_body = "You are recieving this e-mail as you have requested username and password details for website www.dappoint.com .\n\n"."Please find below your username and password registered with our website.\n\n Username:$usernamedb\n\n Password:$passworddb \n\n Please use your above mentioned credentials to log into website www.dappoint.com";
    $headers = "From:appdeveloperkol@gmail.com \n"; 
   
    $mailsendstatus=mail($to,$email_subject,$email_body,$headers);
    if(!$mailsendstatus){
        throw new Exception(MAIL_NOT_SENT_SUCCESSFULLY);
    }
    echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>'NA']);
    
}catch(Exception $e){
    echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]);
}

function checkifUserIsRegistered($username){
    
    try{
          $dbname=DATABASE_NAME;
          $userdetail=array();
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select x.Login_Username username,x.Login_Password password from $dbname.Login x where x.Login_Username='$username'";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $userdetail['username']=$row['username'];
                $userdetail['password']=$row['password'];
                
           }else{
               throw new Exception(USER_NOT_REGISTERED);
           }
        
            mysqli_close($conn);
    
            return $userdetail;
        
    }catch(Exception $e){
        throw $e;
    }
          
}

?>