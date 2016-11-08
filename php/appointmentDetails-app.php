<?php
header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    
    $appointment_id = stripslashes(htmlspecialchars(trim($_POST['appointment_id'])));
    $appointmentdetails = findAppointmentDetails( $appointment_id );
     
   echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$appointmentdetails,'ERROR'=>'NA']);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function findAppointmentDetails( $appointment_id ){
    try{
        
          $appointmentdetails = array();
          
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
          
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql="select
               a2.shop_id,a.user_id,a2.shop_desc,a.first_line_activity,
               a.user_apnt_status,
               a.user_apnt_dt,
               a.user_apnt_time,
               a2.Shop_Phone1,a2.Shop_Web_Page,a2.Shop_FB_Page,
               a2.shop_name1,
               a2.shop_address,
               a2.Shop_City,a2.shop_open_hrs,
               a4.Doc_ID,a4.Doc_First_Name,a4.Doc_Last_Name,
               a.update_date,
               a2.shop_img_url
from
               Client_Shop_Apnt a,
               Shop_Details a2, Shop_Doc_Map a3,
               Doctor_Details a4
               where a.shop_id=a2.shop_id
               and a2.shop_id = a3.shop_id
               and a3.doc_id=a4.doc_id
               and a.Appointment_ID=$appointment_id";
          
           $result=mysqli_query($conn,$sql);
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           $rowcount=mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $appointmentdetails['shop_name1']=$row['shop_name1'];
                $appointmentdetails['shop_id']=$row['shop_id'];
                $appointmentdetails['user_id']=$row['user_id'];
                $appointmentdetails['user_apnt_dt']=$row['user_apnt_dt'];
                $appointmentdetails['user_apnt_time']=$row['user_apnt_time'];
                $appointmentdetails['user_apnt_status']=$row['user_apnt_status'];
                $appointmentdetails['update_date']=$row['update_date'];
                $appointmentdetails['shop_img_url']=$row['shop_img_url'];
                $appointmentdetails['doc_first_name']=$row['doc_first_name'];
                $appointmentdetails['doc_last_name']=$row['doc_last_name'];
                $appointmentdetails['Shop_Phone1']=$row['Shop_Phone1'];
                $appointmentdetails['Shop_Web_Page']=$row['Shop_Web_Page'];
                $appointmentdetails['Shop_FB_Page']=$row['Shop_FB_Page'];
                $appointmentdetails['shop_address']=$row['shop_address'];
                $appointmentdetails['Shop_City']=$row['Shop_City'];
                $appointmentdetails['Shop_Web_Page']=$row['Shop_Web_Page'];
                $appointmentdetails['Shop_FB_Page']=$row['Shop_FB_Page'];
                $appointmentdetails['shop_open_hrs']=$row['shop_open_hrs'];
                $appointmentdetails['Doc_ID']=$row['Doc_ID'];
                $appointmentdetails['shop_desc']=$row['shop_desc'];
                $appointmentdetails['first_line_activity']=$row['first_line_activity'];
               
           }
          
          mysqli_close($conn);
          return $appointmentdetails;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
        
}
 
?>