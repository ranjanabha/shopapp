<?php
header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $user_id=stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    $shop_id=stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
    $status=stripslashes(htmlspecialchars(trim($_POST['status'])));
  
	makeShopFavourite($user_id,$shop_id,$status);
    
   echo json_encode(['OPERATION'=>0]);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function makeShopFavourite($user_id,$shop_id,$status){

	try{
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);

          if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql = "update  User_Shop_Map set Is_Shop_Fav_Flag = '$status' where Shop_ID = $shop_id and User_ID = $user_id;";
           $result = mysqli_query($conn,$sql);
           
           if(!$result){
               throw new Exception("Database error::$sql");
           }
          
          mysqli_close($conn);
          return $shopConnected;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
}

?>