<?php
session_start();
 require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{

 $user_id=stripslashes(htmlspecialchars(trim($_POST['user_id']))); 
 $appointment_id=stripslashes(htmlspecialchars(trim($_POST['appointment_id'])));
 $shop_id=stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
 $status_tobe_updated=stripslashes(htmlspecialchars(trim($_POST['status_to_be_updated'])));   
    
  updateContactedStatusOfClient($user_id,$appointment_id,$shop_id,$status_tobe_updated);    
    
  echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>'NA']);    
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]); 
}

function  updateContactedStatusOfClient($user_id,$appointment_id,$shop_id,$status_tobe_updated){
     try{
          $dbname = DATABASE_NAME;
          $updatedStatus="";
          
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
        
           $sql="update $dbname.Client_Shop_Apnt set Is_client_contacted='$status_tobe_updated' where Appointment_ID=$appointment_id and User_ID=$user_id and Shop_ID=$shop_id";
         
          //echo $sql;
         
           $result=mysqli_query($conn,$sql);
           mysqli_close($conn);
           
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}



?>