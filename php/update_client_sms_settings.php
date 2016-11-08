<?php
header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    $user_id=stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    $shop_id=stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
    $is_sms_active = stripslashes(htmlspecialchars(trim($_POST['is_sms_active'])));
  
    $sql = update_client_sms_settings($user_id,$shop_id,$is_sms_active);
    
   echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$sql,'ERROR'=>'NA']);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function update_client_sms_settings($user_id,$shop_id,$is_sms_active){
    try{
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="update User_Shop_Map set is_sms_active = $is_sms_active where user_id = $user_id and shop_id = $shop_id";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
          
          mysqli_close($conn);
          
          return $sql;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
}
 
?>