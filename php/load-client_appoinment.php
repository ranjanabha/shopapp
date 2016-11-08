<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
                $shop_id = trim($_POST['shop_id']);
                $user_id = trim($_POST['user_id']);
                       
                     loadClientAppoinments($shop_id,$user_id);
            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
   function loadClientAppoinments($shop_id,$user_id){
       
       try{
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            
          if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
           }
           $sql = "select Appointment_ID , user_apnt_dt , user_apnt_time , is_sms_active
				   from Client_Shop_Apnt where user_id = $user_id and shop_id = $shop_id and Date( user_apnt_dt ) >= Date( now() )
				   and user_apnt_status in ( 'BOOKED' , 'CONFIRMED' ) order by user_apnt_dt , user_apnt_time";

       		$result = mysqli_query($conn,$sql);
		  	
       		$client_details = array();
       		
	  	if(mysqli_num_rows($result)>0){

		  		while($row=mysqli_fetch_assoc($result)){ 
					$client_details[] = array( 'Appointment_ID' => $row['Appointment_ID'] , 'user_apnt_dt' => $row['user_apnt_dt'] , 'user_apnt_time' => $row['user_apnt_time'], 'is_sms_active' => $row['is_sms_active']);
     			 }
 			 }
			mysqli_close($conn);
			
  			echo json_encode($client_details);
  
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
       
       
   }
?>