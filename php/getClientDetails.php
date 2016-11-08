<?php

header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $user_id = stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    
    $clientdetails = findClientDetailsById($user_id);
    
    echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$clientdetails,'ERROR'=>'NA']);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function findClientDetailsById($user_id){
    try{
        
          $clientdetails=array();
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select x2.user_id user_id, x2.user_qr_code , x2.user_first_name first_name,x2.user_last_name last_name,x2.user_login_mobile_no mobile_no,x2.User_email_id1 email_id from $dbname.User_Details x2 where x2.user_id = $user_id ";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $clientdetails['user_id']=$row['user_id'];
                $clientdetails['first_name']=$row['first_name'];
                $clientdetails['last_name']=$row['last_name'];
                $clientdetails['mobile_no']=$row['mobile_no'];
                $clientdetails['email_id']=$row['email_id'];
                $clientdetails['qrcode']=$row['user_qr_code'];
           }
          
          mysqli_close($conn);
          return $clientdetails;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
        
}
 
?>