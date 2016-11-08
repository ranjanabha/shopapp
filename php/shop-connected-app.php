<?php
header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{

	$user_id=stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    
    $shopConnected=findShopsConnected($user_id);
    
   echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$shopConnected,'ERROR'=>'NA']);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function findShopsConnected($user_id){
    try{
        
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select X1.shop_name1 shop_name,X1.shop_id shop_id,X1.shop_address shop_address,X1.shop_city shop_city,X1.shop_img_url shop_image, X1.shop_desc , Date(X.insert_date) as insert_date,X.is_shop_fav_flag fav_flag from User_Shop_Map X,Shop_Details X1
				 where X.shop_id=X1.shop_id
				 and X.user_id=$user_id";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);

           $shop_details = array();
	          
	       if($rowcount>0){
	                
	       while($row=mysqli_fetch_assoc($result)){ 
	                
                $shop_details[] = array( 'shop_name' => $row['shop_name'] , 'shop_id' => $row['shop_id'] , 'shop_address' => $row['shop_address'] ,
                'shop_city' => $row['shop_city'],'shop_image' => $row['shop_image'],'fav_flag' => $row['fav_flag'],'shop_desc' => $row['shop_desc'],'insert_date' => $row['insert_date']);
	       }
	      }
          
          mysqli_close($conn);
          
          return $shop_details;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
        
}
 
?>