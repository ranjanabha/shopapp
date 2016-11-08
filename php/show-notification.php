<?php

session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");

try{
    
$search_option="";
$searchvalue="";
    
 if(isset($_POST['search_option'])) {
      $search_option=stripslashes(htmlspecialchars(trim($_POST['search_option'])));
 } 
 if(isset($_POST['searchvalue'])) {
      $searchvalue=stripslashes(htmlspecialchars(trim($_POST['searchvalue'])));
 } 

$shopid=$_SESSION['shopid'];
$notificationDetails=getNotificationDetails($shopid,$search_option,$searchvalue);
    
echo json_encode(['OPERATION'=>0,'SEARCH_REASULT'=>$notificationDetails,'VALIDATION_ERROR'=>'NA']);     
}catch(Exception $e){
    echo  json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]) ; 
}

function getNotificationDetails($shopid,$search_option,$searchvalue){
    try{
          
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
        
           $notificationDetails=array();
        
           $sql="select x1.user_id user_id,x1.User_First_Name first_name,x1.User_Last_Name last_name,x2.User_Apnt_Dt appointment_date,x.User_Notification notification_msg,x.Appointment_ID appointment_id,x2.is_client_contacted is_client_contacted,x1.user_login_mobile_no telephone,x.notification_date notification_date from 
           $dbname.Notification x,$dbname.User_Details x1,$dbname.Client_Shop_Apnt x2 where x.User_ID=x1.User_ID and x1.User_ID=x2.User_ID and x.Appointment_ID=x2.Appointment_ID and x.Notification_Date>=(select insert_date from Shop_Details where shop_id=$shopid) and x.user_notification in('POSTPONED','DELETED') and x.shop_id=$shopid";
        
          if(!empty($searchvalue)){
              
             if($search_option=='Name'){
              $sql=$sql." and x1.User_First_Name='$searchvalue'";
             }
            if($search_option=='Cognome'){
                   $sql=$sql." and x1.User_Last_Name='$searchvalue'";
              } 
              
          }
          
          
          //echo $sql;
          
          $result=mysqli_query($conn,$sql);
        
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
               
                while($row=mysqli_fetch_array($result)){
                    $notificationDetails[]=$row;
                }
                
           }
          mysqli_close($conn);
          
          return $notificationDetails;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}
?>