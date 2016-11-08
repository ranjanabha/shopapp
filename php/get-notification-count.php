<?php

session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");

try{
     $shopid=$_SESSION['shopid'];
     $notification_count=selectNotificationCount($shopid);
     echo json_encode(['OPERATION'=>0,'COUNT'=>$notification_count,'VALIDATION_ERROR'=>'NA']);
}catch(Exception $e){
     echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]);
}

function selectNotificationCount($shop_id){
    try{
           $dbname = DATABASE_NAME;
            $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="select count(*) notification_count from notification x where x.shop_id=$shop_id and x.notification_date >=(select last_notification_checked from Shop_notify_settings where shop_id=$shop_id)";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                return $row['notification_count'];
           }
         mysqli_close($conn);
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
}



?>