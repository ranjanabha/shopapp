<?php

session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");

try{
     $shopid=$_SESSION['shopid'];
     updateAppointmentStatus($shopid);
     echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>'NA']);
}catch(Exception $e){
     echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]);
}

function updateAppointmentStatus($shop_id){
    try{
          $dbname = DATABASE_NAME;
          $updatedStatus="";
          
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
        
           $sql="update $dbname.Shop_notify_settings set Last_notification_checked=NOW() where Shop_iD=$shop_id;";
           $result=mysqli_query($conn,$sql);
           mysqli_close($conn);
           
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}

?>