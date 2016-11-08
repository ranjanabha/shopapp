<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $username=stripslashes(htmlspecialchars(trim($_POST['username'])));
    $password=stripslashes(htmlspecialchars(trim($_POST['password'])));
    $shop_name=stripslashes(htmlspecialchars(trim($_POST['shop_name'])));
    $address=stripslashes(htmlspecialchars(trim($_POST['address'])));
    $city=stripslashes(htmlspecialchars(trim($_POST['city'])));
    $phone=stripslashes(htmlspecialchars(trim($_POST['Phone'])));
    $web_page=stripslashes(htmlspecialchars(trim($_POST['web_page'])));
    $facebook_page=stripslashes(htmlspecialchars(trim($_POST['facebook_page'])));
    $open_hours=stripslashes(htmlspecialchars(trim($_POST['open_hours'])));
    $open_hrs_2=stripslashes(htmlspecialchars(trim($_POST['open_hrs_2'])));
    $notification_hr_1=stripslashes(htmlspecialchars(trim($_POST['notification_hr_1'])));
    $notification_hr_2=stripslashes(htmlspecialchars(trim($_POST['notification_hr_2'])));
    $sms_hr_1=stripslashes(htmlspecialchars(trim($_POST['sms_hr_1'])));
    $description=stripslashes(htmlspecialchars(trim($_POST['description'])));
    $default_description=stripslashes(htmlspecialchars(trim($_POST['default_description'])));
    $sms_service="";
    if(isset($_POST['sms_service'])){
      $sms_service=stripslashes(htmlspecialchars(trim($_POST['sms_service'])));
    }
   
    
               if(empty($username)){
                    $validation_msg=REQUIRED_FIELD_NULL;
                    $final_message=str_replace("{1}","username",$validation_msg);
                    throw new Exception($final_message);
                }
                if(empty($password)){
                   $validation_msg=REQUIRED_FIELD_NULL;
                   $final_message=str_replace("{1}","password",$validation_msg);
                   throw new Exception($final_message);
                }
                if(empty($city)){
                   $validation_msg=REQUIRED_FIELD_NULL;
                   $final_message=str_replace("{1}","city",$validation_msg);
                   throw new Exception($final_message);
                }
                if(empty($address)){
                   $validation_msg=REQUIRED_FIELD_NULL;
                   $final_message=str_replace("{1}","address",$validation_msg);
                   throw new Exception($final_message);
                }
                if(empty($shop_name)){
                   $validation_msg=REQUIRED_FIELD_NULL;
                   $final_message=str_replace("{1}","shop_name",$validation_msg);
                   throw new Exception($final_message);
                }

             if(strlen($username)>50){
                      $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                      $final_message=str_replace("{1}","username",$validation);
                      throw new Exception($final_message);
                } 
                if(strlen($password)>32){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","password",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($shop_name)>50){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","shop_name",$validation);
                    throw new Exception($final_message);
                }
                
                if(strlen($address)>1000){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","address",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($city)>50){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","city",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($phone)>20){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","phone",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($web_page)>200){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","webpage",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($facebook_page)>200){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","facebook page",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($open_hours)>32){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","open hours",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($open_hrs_2)>32){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","open hours second line",$validation);
                    throw new Exception($final_message);
                }
                if (!empty($web_page) && !preg_match("/(?:http|https)?(?:\:\/\/)?(?:www.)?(([A-Za-z0-9-]+\.)*[A-Za-z0-9-]+\.[A-Za-z]+)(?:\/.*)?/im",$web_page)) {
                      throw new Exception(WEB_URL_NOTVALID);
                }
            //checking facebook url entered is valid or not
	           if(!empty($facebook_page) && !preg_match("/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/", $facebook_page)) {
		           throw new Exception(FB_URL_NOTVALID);
	           }
            //checking if phone no entered is valid or not
               if(!empty($phone) 
                  && !preg_match('/^[+0-9]+$/',$phone)){
                        throw new Exception(PHONE_SUPPLIED_NOT_VALID);
               }

              $filename=$_FILES["shop_photo"]["name"];

       //get shop id from session
              $shopid=$_SESSION['shopid'];
              $shopdetails=getShopDetailsByShopID($shopid);
       //update colums if $shopdetails array attribute does not match with the posted inputs
             $dbname=DATABASE_NAME;
    
     $isLoginDetailsChanged=false;
    
      $basesqllogin="update $dbname.Login set";
      
      if($username!=$shopdetails['username']){
          
         $isUserPresent=checkIfChangedUsernameAlreadyRegistered($username);
          
          if($isUserPresent){
              throw new Exception(USERNAME_ALREADY_PRESENT);
          }
          
         $isLoginDetailsChanged=true;  
         $basesqllogin=$basesqllogin." login_username='$username',"; 
      }
    
      if($password!=$shopdetails['password']){
         $isLoginDetailsChanged=true;   
         $basesqllogin=$basesqllogin." login_password='$password',"; 
      } 
       //to remove trailing , from sql fromed
      $basesqllogin=substr($basesqllogin,0,strlen($basesqllogin)-1);
      $basesqllogin=$basesqllogin." where login_username='{$shopdetails['username']}'";
    
    if($isLoginDetailsChanged){
        updateLoginDetails($basesqllogin); 
    }
    
    $isShopDetailsChanged=false;
    
    $baseShopDetailssql="update $dbname.Shop_Details set ";
    
      
      if($shop_name!=$shopdetails['shop_name']){
         $isShopDetailsChanged=true;  
         $baseShopDetailssql=$baseShopDetailssql." shop_name1='$shop_name',"; 
      }
      if($address!=$shopdetails['shop_address']){
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." shop_address='$address',"; 
      }
     
      if($city!=$shopdetails['shop_city']){
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." shop_city='$city',"; 
      }
       if($phone!=$shopdetails['shop_phone']){
         $isShopDetailsChanged=true;    
         $baseShopDetailssql=$baseShopDetailssql." shop_phone1='$phone',"; 
      }
      if($web_page!=$shopdetails['shop_web']){
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." shop_web_page='$web_page',"; 
      }
      if($facebook_page!=$shopdetails['fb_page']){
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." Shop_FB_Page='$facebook_page',"; 
      }
      if($open_hours!=$shopdetails['open_hrs']){
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." Shop_Open_Hrs='$open_hours',"; 
      }
      if($open_hrs_2!=$shopdetails['open_date']){
         $baseShopDetailssql=$baseShopDetailssql." Shop_Open_Dt='$open_hrs_2',"; 
      }
      if(!empty($description)){
         $isShopDetailsChanged=true;  
         $baseShopDetailssql=$baseShopDetailssql." shop_desc='$description',"; 
      }
      if(!empty($default_description)){
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." shop_default_desc='$default_description',"; 
      }
      if($sms_service==""){
          $isShopDetailsChanged=true;   
          $baseShopDetailssql=$baseShopDetailssql." sms_service_status='N',"; 
      }else{
          $isShopDetailsChanged=true;   
          $baseShopDetailssql=$baseShopDetailssql." sms_service_status='Y',"; 
      }
      if(!empty($filename) && $filename!=substr($shopdetails['image_url'],strrpos($shopdetails['image_url'],"/")+1,strlen($shopdetails['image_url'])) ){
         
         //uploading new file
                    $imageFileType = pathinfo($filename,PATHINFO_EXTENSION);
                    $checkimage = getimagesize($_FILES["shop_photo"]["tmp_name"]);
                    $allowedtypes=array(IMG_GIF,IMG_JPEG,IMG_PNG);
                    //echo var_dump($checkimage);
                    if(!in_array($checkimage[2],$allowedtypes)){
                        throw new Exception(NOT_SUPPORTED_FILE_TYPE);
                    }
                    if($imageFileType != "gif" && $imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png"){
                        throw new Exception(NOT_SUPPORTED_FILE_TYPE);
                    }
                    if($_FILES["shop_photo"]["size"]>500000)   {
                        throw new Exception(NOT_PERMITTED_FILE_SIZE);
                    }  
                    $uploadfolderbasefilename="{$_SERVER['DOCUMENT_ROOT']}/shopapp/upload/$username/";
                    if(!file_exists($uploadfolderbasefilename)){
                         mkdir($uploadfolderbasefilename);
                    }
                    $targetfile=$uploadfolderbasefilename.basename($_FILES["shop_photo"]["name"]);
                    if(file_exists($targetfile)) {
                        throw new Exception(FILE_EXISTS);
                    }
                    $checkupload=move_uploaded_file($_FILES["shop_photo"]["tmp_name"], $targetfile);
                    if(!$checkupload){
                        throw new Exception(UPLOAD_FAIL);
                    }
         $isShopDetailsChanged=true;   
         $baseShopDetailssql=$baseShopDetailssql." shop_img_url='$targetfile',"; 
      }
    
    $baseShopDetailssql=substr($baseShopDetailssql,0,strlen($baseShopDetailssql)-1);
    $baseShopDetailssql=$baseShopDetailssql." where shop_id=$shopid";
    
    if($isShopDetailsChanged) {
         updateShopDetails($baseShopDetailssql) ;
    }   
     
    $isShopNotifyDetailsChanged=false;
    
    $baseShopNotifySettingsql="update $dbname.Shop_notify_settings set ";
    
    if($notification_hr_1!=$shopdetails['notify_hr1']){
        $isShopNotifyDetailsChanged=true;
        $baseShopNotifySettingsql=$baseShopNotifySettingsql." Push_first_notify_hr=$notification_hr_1,";
    } 
    if($notification_hr_2!=$shopdetails['notify_hr2']){
        $isShopNotifyDetailsChanged=true;
        $baseShopNotifySettingsql=$baseShopNotifySettingsql." Push_second_notify_hr=$notification_hr_2,";
    }
    if($sms_hr_1!=$shopdetails['sms_notify_hr']){
        $isShopNotifyDetailsChanged=true;
        $baseShopNotifySettingsql=$baseShopNotifySettingsql." sms_notify_hr=$sms_hr_1,";
    }
    $baseShopNotifySettingsql=substr($baseShopNotifySettingsql,0,strlen($baseShopNotifySettingsql)-1);
    $baseShopNotifySettingsql=$baseShopNotifySettingsql." where shop_id=$shopid";
    
    if($isShopNotifyDetailsChanged){
        updateShopNotifySettings($baseShopNotifySettingsql);
    }
    
    $shopdetailsChanged=getShopDetailsByShopID($shopid);
    
    echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$shopdetailsChanged,'VALIDATION_ERROR'=>'NA']);
    
}catch(Exception $e){
    echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]);
}

 function updateLoginDetails($sql){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           $result=mysqli_query($conn,$sql);
          
           if(!$result){
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
} 

function updateShopDetails($sql){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           $result=mysqli_query($conn,$sql);
          
           if(!$result){
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}       

function updateShopNotifySettings($sql){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           $result=mysqli_query($conn,$sql);
          
           if(!$result){
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}       

function checkIfChangedUsernameAlreadyRegistered($username){
    try{
          
          $isuserpresent=false;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="select count(*) user_count from $dbname.Login where login_username='$username'";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $usercount=$row['user_count'];
                if($usercount==1){
                     $isuserpresent=true;
                }
               
           }
          mysqli_close($conn);
          
          return $isuserpresent;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
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
           $sql="select x.Login_Username username,x.Login_Password password ,x1.Shop_Name1 shop_name,x1.Shop_Name2 shop_description,x1.Shop_Address shop_address ,x1.Shop_City shop_city,x1.Shop_Phone1 shop_phone,x1.Shop_Web_Page shop_web,x1.Shop_FB_Page fb_page,x1.Shop_Open_Hrs open_hrs,x1.Shop_Open_Dt open_date,x1.Shop_img_url image_url,x1.shop_type account_type,x1.sms_service_status sms_status,x2.SMS_Current sms_remaining,x1.shop_desc description,x1.shop_default_desc default_description,x3.Push_first_notify_hr notify_hr1,x3.Push_second_notify_hr notify_hr2,x3.Sms_notify_hr sms_notify_hr from $dbname.Login x,$dbname.Shop_Details x1 ,$dbname.SMS_Table x2 ,$dbname.Shop_notify_settings x3 where x.Login_ID=x1.Shop_Login_ID and x1.Shop_ID=x2.Shop_ID and x1.Shop_ID=x3.Shop_ID and x1.Shop_ID=$shopid";
          
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
                $shopdetails['sms_status']=$row['sms_status'];
               
           }
          mysqli_close($conn);
          
          return $shopdetails;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}


?>