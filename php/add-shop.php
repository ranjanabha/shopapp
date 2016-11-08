<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
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
                $checkuser=isUserAlreadyRegistered($username,DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
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
                       
                     insertShopData($username,$password,$shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$sms,$targetfile,$doctor_id);

                        
                            echo json_encode(['OPERATION'=>0,'IMAGE_URL'=>$targetfile,'VALIDATION_ERROR'=>'NA']);
                        } 

            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>1,'IMAGE_URL'=>'NA','VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
    function isUserAlreadyRegistered($username,$servername,$db_username,$db_password,$db){
      try{
          $isuserpresent=false;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="select count(*) count_user from $dbname.Login x where x.Login_Username='$username'";
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                if($row['count_user'] >0){
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
    
   function insertShopData($username,$password,$shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$sms,$image_url,$doctor_id){
       
       try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into  $dbname.Login (Login_Username,Login_Password,Login_Mobile_No,Login_Type,Client_Login_Type ) values('$username','$password','NA','NA','SHOP')";
              
           
           $result=mysqli_query($conn,$sql);
           if($result){
              $loginId=selectLogInIdforSuppliedUsername($username,$conn,$dbname);
              insertShopDetails($loginId,$shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$sms,$image_url,$conn,$dbname) ; 
               
              $shopId=selectShopId($loginId,$conn,$dbname);
              //insert into SMS_TABLE and Shop_notify_settings   
              insertIntoSMSTable($shopId,$sms,$conn,$dbname);
              insertShopNotificationSettings($shopId,$conn,$dbname); 
              insertShopDoctorAssociationData($shopId,$doctor_id,$conn,$dbname);   
                 
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
       
       
   }

function insertShopDoctorAssociationData($shopId,$doctor_id,$conn,$dbname){
    
    try{
        $sql="insert into $dbname.Shop_Doc_Map (doc_id,shop_id,shop_doc_link_flag)
              values($doctor_id,$shopId,'Y')";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
          }  
         
    }catch(Exception $e){
       throw $e;  
    }
   
}

function selectLogInIdforSuppliedUsername($username,$conn,$dbname){
  try{    
        $sql="select Login_ID from $dbname.Login where Login_Username='$username'";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
          }  
         if(mysqli_num_rows($result)>0){
              $row=mysqli_fetch_array($result);
              $login_id=$row['Login_ID'];
              return $login_id;
         }
    }catch(Exception $e){
      throw $e;
  }  
}

function insertShopDetails($loginId,$shop_name,$shop_name_2,$address,$city,$phone,$webpage,$facebook_page,
                             $open_hours,$open_hours_second_line,$account_type,$sms,$image_url,$conn,$dbname){
    try{
        $sms_status="Active"; 
        $sql="insert into $dbname.Shop_Details (Shop_Login_ID,Shop_Name1,Shop_Name2,Shop_Address,Shop_City,Shop_Phone1,Shop_Open_Hrs,Shop_Open_Dt,Shop_Web_Page,Shop_FB_Page,Shop_Type,Shop_img_url,Shop_Status) values($loginId,'$shop_name','$shop_name_2','$address','$city','$phone','$open_hours','$open_hours_second_line','$webpage','$facebook_page','$account_type','$image_url','$sms_status')";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
        }    
        
    }catch(Exception $e){
        throw $e;
    }
}

function selectShopId($loginId,$conn,$dbname){
    try{
        $sql="select Shop_ID from $dbname.Shop_Details where Shop_Login_ID =$loginId";
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
        }    
         if(mysqli_num_rows($result)>0){
              $row=mysqli_fetch_array($result);
              $shop_id=$row['Shop_ID'];
              return $shop_id;
         }
    }catch(Exception $e){
        throw $e;
    }
}

function insertIntoSMSTable($shopId,$sms,$conn,$dbname){
    try{
        if(empty($sms))    {
            $sms=0;
        }
        $sql="insert into $dbname.SMS_Table (Shop_ID,SMS_Limit,SMS_Current) values($shopId,$sms,0)";
       // echo $sql;        
        $result=mysqli_query($conn,$sql);
        if(!$result){
            throw new Exception("Database error::$sql");
        }    
    } catch(Exception $e){
        throw $e;
    }   
    
}

function insertShopNotificationSettings($shopId,$conn,$dbname){
    try{
        $sql="insert into $dbname.Shop_notify_settings (Shop_ID,Push_first_notify_hr,Push_second_notify_hr,Sms_notify_hr)
         values($shopId,24,0,2)";
        $result=mysqli_query($conn,$sql);
        if(!$result){
                throw new Exception("Database error::$sql");
        }     
    }catch(Exception $e){
        throw $e;
    }
}
                   

?>