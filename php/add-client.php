<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $name=stripslashes(htmlspecialchars(trim($_POST['name'])));
    $surname=stripslashes(htmlspecialchars(trim($_POST['lastname'])));
    $telephone=stripslashes(htmlspecialchars(trim($_POST['telephone'])));
    $email=stripslashes(htmlspecialchars(trim($_POST['email'])));
    $userid=stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    $action=stripslashes(htmlspecialchars(trim($_POST['action'])));
    $shopid=$_SESSION['shopid'];
    
    
    if(empty($name)){
        $validation_msg=REQUIRED_FIELD_NULL;
        $final_message=str_replace("{1}","name",$validation_msg);
        throw new Exception($final_message);
    }
    if(empty($surname)){
        $validation_msg=REQUIRED_FIELD_NULL;
        $final_message=str_replace("{1}","surname",$validation_msg);
        throw new Exception($final_message);
    }
    if(empty($telephone)){
        $validation_msg=REQUIRED_FIELD_NULL;
        $final_message=str_replace("{1}","telephone",$validation_msg);
        throw new Exception($final_message);
    }
    if(empty($email)){
        $validation_msg=REQUIRED_FIELD_NULL;
        $final_message=str_replace("{1}","email",$validation_msg);
        throw new Exception($final_message);
    }
    
    if(strlen($name)>32){
        $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
        $final_message=str_replace("{1}","name",$validation);
        throw new Exception($final_message);
    } 
    if(strlen($surname)>32){
        $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
        $final_message=str_replace("{1}","surname",$validation);
        throw new Exception($final_message);
    } 
    if(strlen($telephone)>20){
        $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
        $final_message=str_replace("{1}","telephone",$validation);
        throw new Exception($final_message);
    } 
    if(strlen($email)>20){
        $validation=FIELD_VALUE_LARGER_THAN_SUPPORTED;
        $final_message=str_replace("{1}","email",$validation);
        throw new Exception($final_message);
    } 
    
   // $userid_tocheck=checkIfUserIdMatchesWithSuppliedDetails($name,$surname,$telephone,$email);
    
    //if($userid!=$userid_tocheck){
      //  $userid=trim('');
    //}
    
    $isUserAssociatedWithTheShop=false;
    $isSMSUserAssociatedWithTheShop=false;
    //FOR APP USER
    if(!empty($userid)){
        $isUserAssociatedWithTheShop=checkIfUserDataIsAlreadyAssociated($shopid,$userid);
        if(!$isUserAssociatedWithTheShop){
             linkUserWithShop($userid,$shopid);
        }else{
            throw new Exception(USER_ALREADY_ASSOCIATED);
        }    
    }
    //For SMS_USER
    if(empty($userid)){
        $isSMSUserIsAlreadyAssociatedWithTheShop=checkIfSMSUserIsAlreadyAssociatedWithTheShop($name,$surname,$telephone,$email,$shopid);
        
        if(!$isSMSUserIsAlreadyAssociatedWithTheShop){
             insertSMSUser($name,$surname,$telephone,$email,$shopid);
        }else{
            throw new Exception(USER_ALREADY_ASSOCIATED);
        } 
    }
     echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>'NA']);
    
    
}catch(Exception $e){
     echo json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]);
}

function checkIfSMSUserIsAlreadyAssociatedWithTheShop($name,$surname,$telephone,$email,$shopid){
    
     try{
          $isUserAssociated=false;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select count(*) user_count from $dbname.User_Details x,$dbname.User_Shop_Map x1 where x.user_id=x1.user_id and x.user_first_name='$name' and x.user_last_name='$surname' and x.user_login_mobile_no='$telephone' and x.user_email_id1='$email' and x1.shop_id=$shopid";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $user_count=$row['user_count'];
                 if($user_count==1){
                      $isUserAssociated=true;
                 }
               
           }
          mysqli_close($conn);
          
          return $isUserAssociated;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
    
}

function insertSMSUser($name,$surname,$telephone,$email,$shopid){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into $dbname.Login (login_username,login_password,login_mobile_no,login_type,client_login_type) value('$telephone','$telephone','NA','NA','SMS_USER')";
              
           
           $result=mysqli_query($conn,$sql);
          
           if($result){
               $loginId=mysqli_insert_id($conn);
               insertSMSUserDetails($name,$surname,$telephone,$email,$shopid,$loginId);
               
                 
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}

function insertSMSUserDetails($name,$surname,$telephone,$email,$shopid,$loginId){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into $dbname.User_Details (user_login_id,user_first_name,user_last_name,user_qr_code,user_login_mobile_no,user_alt_contact2,user_email_id1,User_Status) value($loginId,'$name','$surname','NA','$telephone','NA','$email','NA')";
              
           
           $result=mysqli_query($conn,$sql);
           if($result){
               $userid=mysqli_insert_id($conn);
               linkUserWithShop($userid,$shopid);
                 
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}



function checkIfUserDataIsAlreadyAssociated($shopid,$userid){
    try{
          $isUserAssociated=false;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select count(*) user_shop_map_count from $dbname.User_Shop_Map where shop_id=$shopid and user_id=$userid";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
               $row=mysqli_fetch_array($result);
                $user_count=$row['user_shop_map_count'];
                 if($user_count==1){
                      $isUserAssociated=true;
                 }
           }
          mysqli_close($conn);
          
          return $isUserAssociated;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}

function linkUserWithShop($userid,$shopid){
    try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into $dbname.User_Shop_Map (shop_id,user_id,user_active_flag,is_shop_fav_flag) value($shopid,$userid,'Y','N')";
              
           
           $result=mysqli_query($conn,$sql);
           if($result){
               updateUserStatus($userid,$conn,$dbname);
                 
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}

function updateUserStatus($userid,$conn,$dbname){
    try{
        
         $sql="update $dbname.User_Details set user_status='Connected',update_date=now() where user_id=$userid";
         $result=mysqli_query($conn,$sql);
         if(!$result){
             throw new Exception("Database error::$sql");
         }
    }catch(Exception $e){
         throw $e;
    }
}

function checkIfUserIdMatchesWithSuppliedDetails($name,$surname,$telephone,$email){
    try{
          $userid=-1;
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select x.user_id user_id from $dbname.User_Details x where x.user_first_name='$name' and x.user_last_name='$surname' and x.user_login_mobile_no='$telephone' and x.user_email_id1='$email'";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $user_id=$row['user_id'];
               
           }
          mysqli_close($conn);
          
          return $userid;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}
?>