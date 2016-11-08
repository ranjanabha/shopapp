<?php

session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
     $shopid = trim($_POST['shop_id']);

    $shopdetails=getShopDetailsByShopID($shopid);
    
    echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$shopdetails,'ERROR'=>'NA']);
}catch(Exception $e){
    echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function getShopDetailsByShopID($shopid){
    try{
          $userid=-1;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $shopdetails=array();
           $sql="select x.login_id shop_login_id , x.Login_Username username,x.Login_Password password ,x1.Shop_Name1 shop_name,x1.Shop_Name2 shop_description,x1.Shop_Address shop_address ,x1.Shop_City shop_city,x1.Shop_Phone1 shop_phone,x1.Shop_Web_Page shop_web,x1.Shop_FB_Page fb_page,x1.Shop_Open_Hrs open_hrs,x1.Shop_Open_Dt open_date,x1.Shop_img_url image_url,x1.shop_type account_type,x2.SMS_limit sms_remaining,x1.shop_desc description,x1.shop_default_desc default_description,x3.Push_first_notify_hr notify_hr1,x3.Push_second_notify_hr notify_hr2,x3.Sms_notify_hr sms_notify_hr from $dbname.Login x,$dbname.Shop_Details x1 ,$dbname.SMS_Table x2 ,$dbname.Shop_notify_settings x3 where x.Login_ID=x1.Shop_Login_ID and x1.Shop_ID=x2.Shop_ID and x1.Shop_ID=x3.Shop_ID and x1.Shop_ID=$shopid";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $shopdetails['username']=$row['username'];
                $shopdetails['password']=$row['password'];
                $shopdetails['shop_name']=$row['shop_name'];
                $shopdetails['shop_description']=$row['shop_description'];
                $shopdetails['shop_address']=$row['shop_address'];
                $shopdetails['shop_city']=$row['shop_city'];
                $shopdetails['shop_phone']=$row['shop_phone'];
                $shopdetails['shop_web']=$row['shop_web'];
                $shopdetails['fb_page']=$row['fb_page'];
                $shopdetails['open_hrs']=$row['open_hrs'];
                $shopdetails['open_date']=$row['open_date'];
                $shopdetails['image_url']=$row['image_url'];
                $shopdetails['sms_remaining']=$row['sms_remaining'];
                $shopdetails['notify_hr1']=$row['notify_hr1'];
                $shopdetails['notify_hr2']=$row['notify_hr2'];
                $shopdetails['sms_notify_hr']=$row['sms_notify_hr'];
                $shopdetails['account_type']=$row['account_type'];
                $shopdetails['image_url']=$row['image_url'];
                $shopdetails['description']=$row['description'];
                $shopdetails['default_description']=$row['default_description'];
                $shopdetails['shop_login_id']=$row['shop_login_id'];
                
               
           }
          mysqli_close($conn);
          
          return $shopdetails;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}    

?>