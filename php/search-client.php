<?php

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $qrcode=stripslashes(htmlspecialchars(trim($_POST['qrcode'])));
    $shopid=stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
    $user_id_exists = isset($_POST['user_id']) ? $_POST['user_id'] : false;
    
    if( $user_id_exists ){
    	$user_id = stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    }
    else{
    	$user_id = 0;
    }
    if(empty($qrcode)){
        throw new Exception(REQUIRED_FIELD_QR_CODE_NOT_PROVIDED);
    }
    
    $clientdetails=findClientDetailsByQRCODE($qrcode,$shopid,$user_id);
    
    echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$clientdetails,'ERROR'=>'NA']);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function findClientDetailsByQRCODE($qrcode,$shop_id,$user_id){
    try{
        
          $clientdetails=array();
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
            if( $user_id == 0 ){
	           $sql="select x2.user_id user_id,x2.user_first_name first_name,x2.user_last_name last_name,x2.user_login_mobile_no mobile_no,x2.User_email_id1 email_id from $dbname.User_Details x2 where x2.user_qr_code='$qrcode' "; 	
            }
            else{
            $sql="select x2.user_id user_id,x2.user_first_name first_name,x2.user_last_name last_name,x2.user_login_mobile_no mobile_no,x2.User_email_id1 email_id from $dbname.User_Details x2 where x2.user_id = $user_id ";
            }
            
           
          
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
           }
          
          mysqli_close($conn);
          return $clientdetails;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
        
}
 
?>