<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");

try{
     $name=stripslashes(htmlspecialchars(trim($_POST['appointment_hidden_name'])));
     $surname=stripslashes(htmlspecialchars(trim($_POST['appointment_hidden_surname'])));
     $telephone=stripslashes(htmlspecialchars(trim($_POST['appointment_telephone'])));
     $email=stripslashes(htmlspecialchars(trim($_POST['appointment_email'])));
     $userid=stripslashes(htmlspecialchars(trim($_POST['appointment_userid'])));
     $shopid=$_SESSION['shopid'];
     $tipo_attivita=stripslashes(htmlspecialchars(trim($_POST['tipo_attivita'])));
     $seconda_attivita=stripslashes(htmlspecialchars(trim($_POST['seconda_attivita'])));
     $appointment_end_date=stripslashes(htmlspecialchars(trim($_POST['appointment_end_date'])));
     $ora1=stripslashes(htmlspecialchars(trim($_POST['ora1'])));
     $ora2=stripslashes(htmlspecialchars(trim($_POST['ora2'])));
     $sms_service=stripslashes(htmlspecialchars(trim($_POST['sms_service'])));
     if($sms_service=='true'){
         $sms_service='Y';
     }else{
         $sms_service='N';
     }
    
    //Checking if supplied userid matches with name,surname,telephone and email
    //$userid_tocheck=checkIfUserIdMatchesWithSuppliedDetails($name,$surname,$telephone,$email);
    
    //if($userid!=$userid_tocheck){
     //   $userid=trim('');
    //}
   
    //FOR APP USER
    if(!empty($userid)){
        
        $isUserAssociatedWithTheShop=checkIfUserDataIsAlreadyAssociated($shopid,$userid);
                
        if(!$isUserAssociatedWithTheShop){
             linkUserWithShop($userid,$shopid);
        } 
    }
    //For SMS_USER
    if(empty($userid)){
        $isSMSUserIsAlreadyAssociatedWithTheShop=checkIfSMSUserIsAlreadyAssociatedWithTheShop($name,$surname,$telephone,$email,$shopid);
        
        if(!$isSMSUserIsAlreadyAssociatedWithTheShop){
           
             $loginId=insertSMSUser($name,$surname,$telephone,$email,$shopid);
             $userid=insertSMSUserDetails($name,$surname,$telephone,$email,$shopid,$loginId);
             linkUserWithShop($userid,$shopid);
        }else{
            $userid=getUserIdForExistingSmsUser($name,$surname,$telephone,$email,$shopid);
        }
    }
    
    $appointmentId=insertClientAppointmentDetails($shopid,$userid,$tipo_attivita,$seconda_attivita,$appointment_end_date,$ora1,$ora2,$sms_service);
    
    echo json_encode(['OPERATION'=>0,'USER_ID'=>$userid,'APPOINTMENT_ID'=>$appointmentId,'VALIDATION_ERROR'=>'NA']);
    
} catch(Exception $e){
    echo json_encode(['OPERATION'=>1,'USER_ID'=>'NA','APPOINTMENT_ID'=>'NA','VALIDATION_ERROR'=>$e->getMessage()]);
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
 
function getUserIdForExistingSmsUser($name,$surname,$telephone,$email,$shopid){
    
    try{
          
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select x.user_id user_id from $dbname.User_Details x,$dbname.User_Shop_Map x1 where x.user_id=x1.user_id and x.user_first_name='$name' and x.user_last_name='$surname' and x.user_login_mobile_no='$telephone' and x.user_email_id1='$email' and x1.shop_id=$shopid";
          
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
          
          return $user_id;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
    
}



function insertClientAppointmentDetails($shopid,$userid,$tipo_attivita,$seconda_attivita,$appointment_end_date,$ora1,$ora2,$sms_service){
    try{
          $appointmentId=-1;     
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           $sql="insert into $dbname.Client_Shop_Apnt (user_id,shop_id,user_apnt_dt,user_apnt_time,user_apnt_status,is_sms_active,first_line_activity,second_line_activity) values($userid,$shopid,STR_TO_DATE('$appointment_end_date','%Y-%m-%d'),STR_TO_DATE('$ora1:$ora2','%T:%i'),'BOOKED','$sms_service','$tipo_attivita','$seconda_attivita')";
           
           $result=mysqli_query($conn,$sql);
           if($result){
               $appointmentId=mysqli_insert_id($conn);
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
        
           return $appointmentId;
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}


function checkIfSMSUserIsAlreadyAssociatedWithTheShop($name,$surname,$telephone,$email,$shopid){
    
     try{
          $isUserAssociated=FALSE;
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
                      $isUserAssociated=TRUE;
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
          $loginId=-1;   
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into $dbname.Login (login_username,login_password,login_mobile_no,login_type,client_login_type) value('$telephone','$telephone','NA','NA','SMS_USER')";
              
           
           $result=mysqli_query($conn,$sql);
          
           if($result){
               $loginId=mysqli_insert_id($conn);
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
         return $loginId;
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}

function insertSMSUserDetails($name,$surname,$telephone,$email,$shopid,$loginId){
    try{
          $userid=-1;     
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
           
           
           $sql="insert into $dbname.User_Details (user_login_id,user_first_name,user_last_name,user_qr_code,user_login_mobile_no,user_alt_contact2,user_email_id1,User_Status) value($loginId,'$name','$surname','NA','$telephone','NA','$email','NA')";
              
           
           $result=mysqli_query($conn,$sql);
           if($result){
               $userid=mysqli_insert_id($conn);
                 
           }else{
               throw new Exception("Database error::$sql");
           }
            
           mysqli_close($conn);
        
        return $userid;
          
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
}



function checkIfUserDataIsAlreadyAssociated($shopid,$userid){
    try{
          $isUserAssociated=FALSE;
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
                      $isUserAssociated=TRUE;
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

 


?>