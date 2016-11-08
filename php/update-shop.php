<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
            	$shop_id=stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
            	$shop_login_id=stripslashes(htmlspecialchars(trim($_POST['shop_login_id'])));
            	
                $username=stripslashes(htmlspecialchars(trim($_POST['username'])));
                $password=stripslashes(htmlspecialchars(trim($_POST['password'])));
                $shop_name=stripslashes(htmlspecialchars(trim($_POST['shop_name'])));
                $shop_name_2=stripslashes(htmlspecialchars(trim($_POST['shop_name_2'])));
                $address=stripslashes(htmlspecialchars(trim($_POST['address'])));
                $city=stripslashes(htmlspecialchars(trim($_POST['city'])));
                $phone=stripslashes(htmlspecialchars(trim($_POST['phone'])));
                $webpage=stripslashes(htmlspecialchars(trim($_POST['webpage'])));
                $facebook_page=stripslashes(htmlspecialchars(trim($_POST['facebook_page'])));
                $open_hours=stripslashes(htmlspecialchars(trim($_POST['open_hours'])));
                $open_hours_second_line=stripslashes(htmlspecialchars(trim($_POST['open_hours_second_line'])));
                $doctor_id=stripslashes(htmlspecialchars(trim($_POST['doctor_id'])));
                $account_type="";
                if(isset($_POST['account_type'])){
                    $account_type=stripslashes(htmlspecialchars(trim($_POST['account_type'])));
                }
                $sms=stripslashes(htmlspecialchars(trim($_POST['sms']))); 
                //form related validations
                
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
            //checking if field value length is grater than db supported
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
                if(strlen($shop_name_2)>50){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","shop_name_2",$validation);
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
                if(strlen($webpage)>200){
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
                if(strlen($open_hours_second_line)>32){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","open hours second line",$validation);
                    throw new Exception($final_message);
                }
                if(strlen($account_type)>20){
                    $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
                    $final_message=str_replace("{1}","account type",$validation);
                    throw new Exception($final_message);
                }
            //checking supplied value in sms field is neumeric
                if(!empty($sms) && !preg_match('/^[0-9]+$/',$sms)){
                      $validation=NEUMERIC_VALUE_EXPECTED;
                      $final_message=str_replace("{1}","sms",$validation);
                      throw new Exception($final_message);
                }
            //checking webpage value entered is valid or not
            
              if (!empty($webpage) && !preg_match("/(?:http|https)?(?:\:\/\/)?(?:www.)?(([A-Za-z0-9-]+\.)*[A-Za-z0-9-]+\.[A-Za-z]+)(?:\/.*)?/im",$webpage)) {
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
            //file related validations   
                $filename=$_FILES["shop_photo"]["name"];
                if(!empty($filename)){
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
                }
                
                //checking if username is already present   
                $checkuser=isUserAlreadyRegistered($username,DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME,$shop_login_id);
                //echo $checkuser;
                if($checkuser){
                    throw new Exception(USERNAME_ALREADY_PRESENT);
                } else{
                        //insert user data and upload file in server.
                    $targetfile="";
                      if(!empty($filename)){
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
                      }
                     update_login_details( $username,$password , DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME,$shop_login_id );
                       
                     updateShopData($username,$password,$shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$sms,$targetfile,$shop_id);

                        
                            echo json_encode(['OPERATION'=>0,'IMAGE_URL'=>$targetfile,'VALIDATION_ERROR'=>'NA']);
                        } 

            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>1,'IMAGE_URL'=>'NA','VALIDATION_ERROR'=>$e->getMessage()]);
    }

    function update_login_details( $username,$password,$DATABASE_SERVER,$DATABASE_USERNAME,$DATABASE_PASSWORD,$DATABASE_NAME,$shop_login_id ){
    	
    try{
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="update Login set login_username = '$username' , login_password = '$password' where login_id='$shop_login_id' ";
           $result=mysqli_query($conn,$sql);
           
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
 
    }
    
    function isUserAlreadyRegistered($username,$servername,$db_username,$db_password,$db,$shop_login_id){
      try{
          $isuserpresent=false;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="select login_id from $dbname.Login x where x.Login_Username='$username'";
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                if($row['login_id'] != $shop_login_id ){
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
    
   function updateShopData($username,$password,$shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$sms,$image_url,$shop_id){
       
       try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
              updateShopDetails($shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$image_url,$conn,$dbname,$shop_id) ; 
               
              updateIntoSMSTable($shop_id,$sms,$conn,$dbname);
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
       
       
   }

function updateShopDetails($shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$image_url,$conn,$dbname,$shop_id){
    try{
        $sql = "update Shop_Details set Shop_Name1 = '$shop_name' ,Shop_Name2 = '$shop_name_2' , Shop_Address = '$address' , Shop_City = '$city' , 
        Shop_Phone1 = '$phone' , Shop_Open_Hrs = '$open_hours' , Shop_Open_Dt = '$open_hours_second_line' 
        ,Shop_Web_Page = '$webpage' , Shop_FB_Page = '$facebook_page' , Shop_Type = '$account_type' , Shop_img_url = '$image_url' where shop_id = $shop_id ";
        $result = mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
        }    
        
    }catch(Exception $e){
        throw $e;
    }
}

function updateIntoSMSTable($shopId,$sms,$conn,$dbname){
    try{
        if(empty($sms))    {
            $sms=0;
        }
        $sql="update SMS_Table set SMS_Limit = $sms where shop_id = $shopId ";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
        }    
    } catch(Exception $e){
        throw $e;
    }   
    
}
?>