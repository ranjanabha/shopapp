<?php
	header('Access-Control-Allow-Origin: *');
	
	require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
	
	try{
	    $user_id = stripslashes(htmlspecialchars(trim($_POST['user_id'])));
	    
	    $appointmentdetails = findAppointmentDetails($user_id);
	    
	   echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$appointmentdetails,'ERROR'=>'NA']);
	    
	}catch(Exception $e){
	   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
	}
	
	function findAppointmentDetails($user_id){

		try{
	          $appointmentdetails = array();
	          
	          $dbname = DATABASE_NAME;
	          
	          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
	          
	            if(!$conn){
	                throw new Exception(DATABASE_CONNECTION_ERROR);
	            }
	          
	           $sql="select  A2.shop_name1,A.Appointment_ID,A.user_id,A2.shop_desc,A.first_line_activity,
	               A2.shop_id,
	               A.user_apnt_dt,
	               A2.shop_address,
	               A.user_apnt_time,
	               A.user_apnt_status,
	               A.update_date,
	               A2.shop_img_url,
	               A4.doc_first_name,
	               A4.doc_last_name
	               from
	               Client_Shop_Apnt A,
	               Shop_Details A2,
	               Shop_Doc_Map A3,
	               Doctor_Details A4
	               where A.shop_id=A2.shop_id
	               and A2.shop_id = A3.shop_id
	               and A3.doc_id=A4.doc_id
	               and A.user_id=$user_id
	               and Date(A.User_Apnt_Dt) BETWEEN Date( CURDATE() ) AND Date ( DATE_ADD(CURDATE(), INTERVAL 6 DAY) )";
	          
	           $result = mysqli_query($conn,$sql);
	           
	           if(!$result){
	               throw new Exception("Database error::$sql");
	           }
	           $rowcount=mysqli_num_rows($result);
	           
	           $shop_details = array();
	          
	           if($rowcount>0){
	                
	           	while($row=mysqli_fetch_assoc($result)){ 
	                
	                $shop_details[] = array( 'shop_name1' => $row['shop_name1'] , 'shop_id' => $row['shop_id'] , 'shop_address' => $row['shop_address'] ,
	                'user_apnt_dt' => $row['user_apnt_dt'],'user_apnt_time' => $row['user_apnt_time'],'user_apnt_status' => $row['user_apnt_status'],
	                'update_date' => $row['update_date'],'shop_img_url' => $row['shop_img_url'],'doc_first_name' => $row['doc_first_name'],
	                'doc_last_name' => $row['doc_last_name'],'Appointment_ID' => $row['Appointment_ID'],'user_id' => $row['user_id'],
	                'shop_desc' => $row['shop_desc'],'first_line_activity' => $row['first_line_activity']);
	           	}
	           }
	          
	          mysqli_close($conn);
	          return $shop_details;
	        
	    }catch(Exception $e){
	        mysqli_close($conn);
	        throw $e;
	    }
	        
	}
	 
?>