<?php

 session_start();
 require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{

$search_option="";
$searchvalue="";
$appointment_date="";
    
 if(isset($_POST['search_option'])) {
      $search_option=stripslashes(htmlspecialchars(trim($_POST['search_option'])));
 } 
 if(isset($_POST['searchvalue'])) {
      $searchvalue=stripslashes(htmlspecialchars(trim($_POST['searchvalue'])));
 } 
 if(isset($_POST['appointment_date'])) {
      $appointment_date=stripslashes(htmlspecialchars(trim($_POST['appointment_date'])));
 }else{
	 $appointment_date=date("Y-m-d");
 }

 $shopid=$_SESSION['shopid'];
 $appointmentDetails=getAppointmentDetails($search_option,$searchvalue,$appointment_date,$shopid);
 echo json_encode(['OPERATION'=>0,'SEARCH_REASULT'=>$appointmentDetails,'VALIDATION_ERROR'=>'NA']);    
    
 }catch(Exception $e){
    echo  json_encode(['OPERATION'=>1,'VALIDATION_ERROR'=>$e->getMessage()]) ;
 }

function getAppointmentDetails($search_option,$searchvalue,$appointment_date,$shopid){
    try{
          
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
        
           $appointmentDetails=array();
        
           $sql="select x1.User_ID user_id,x1.User_First_Name first_name,x1.User_Last_Name last_name,x.User_Apnt_Time apnt_time,x.User_Apnt_Status apnt_status,x1.User_Login_Mobile_No phone_no,x1.User_email_id1 email,x.Appointment_ID appnt_id from $dbname.Client_Shop_Apnt x,$dbname.User_Details x1 where x.Shop_ID=$shopid and x.User_ID=x1.User_ID";
        
          if(!empty($searchvalue)){
              
             if($search_option=='Name'){
              $sql=$sql." and x1.User_First_Name='$searchvalue'";
             }
            if($search_option=='Cognome'){
                   $sql=$sql." and x1.User_Last_Name='$searchvalue'";
              } 
              
          }
          
          $sql=$sql." and x.User_Apnt_Dt='$appointment_date' and x.user_apnt_status in('CONFIRMED','POSTPONED','DELETED','BOOKED') order by x.User_Apnt_Time";
          
          //echo $sql;
          
          $result=mysqli_query($conn,$sql);
        
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
               
                while($row=mysqli_fetch_array($result)){
                    $appointmentDetails[]=$row;
                }
                
           }
          mysqli_close($conn);
          
          return $appointmentDetails;
          
      }catch(Exception $e){
          mysqli_close($conn);
          throw $e;
      }
}
?>