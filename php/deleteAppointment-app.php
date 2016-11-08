<?php
header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{

	$user_id = stripslashes(htmlspecialchars(trim($_POST['user_id'])));
	$shop_id = stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
	$appointment_id = stripslashes(htmlspecialchars(trim($_POST['appointment_id'])));

	checkNotification($user_id,$shop_id,$appointment_id);
	deleteAppointmentDetails($user_id,$shop_id,$appointment_id);

	echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$appointmentdetails,'ERROR'=>'NA']);

}catch(Exception $e){
	echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function deleteAppointmentDetails($user_id,$shop_id,$appointment_id){
	try{

		// $appointmentdetails=array();
		$dbname=DATABASE_NAME;
		$conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
		if(!$conn){
			throw new Exception(DATABASE_CONNECTION_ERROR);
		}

		$sql="update Client_Shop_Apnt a set a.user_apnt_status = 'DELETED' , update_date = CURRENT_TIMESTAMP
		where a.appointment_id = $appointment_id";

		$result=mysqli_query($conn,$sql);
		if(!$result){
			throw new Exception("Database error::$sql");
		}
			

		mysqli_close($conn);
		// return $appointmentdetails;

	}catch(Exception $e){
		mysqli_close($conn);
		throw $e;
	}

}

function insertNotification($user_id,$shop_id,$appointment_id){
	try{

		// $appointmentdetails=array();
		$dbname=DATABASE_NAME;
		$conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
		if(!$conn){
			throw new Exception(DATABASE_CONNECTION_ERROR);
		}

		$sql="insert into Notification(Appointment_ID,User_ID,Shop_ID,User_Notification) values ($appointment_id,$user_id,$shop_id,'DELETED');";

		$result=mysqli_query($conn,$sql);
		if(!$result){
			throw new Exception("Database error::$sql");
		}
			

		mysqli_close($conn);
		// return $appointmentdetails;

	}catch(Exception $e){
		mysqli_close($conn);
		throw $e;
	}

}

function updateNotification($user_id,$shop_id,$appointment_id){
	try{

		// $appointmentdetails=array();
		$dbname=DATABASE_NAME;
		$conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
		if(!$conn){
			throw new Exception(DATABASE_CONNECTION_ERROR);
		}

		$sql="update Notification set User_Notification='DELETED' where Appointment_ID=$appointment_id and User_ID=$user_id and Shop_ID=$shop_id;";

		$result=mysqli_query($conn,$sql);
		if(!$result){
			throw new Exception("Database error::$sql");
		}
			

		mysqli_close($conn);
		// return $appointmentdetails;

	}catch(Exception $e){
		mysqli_close($conn);
		throw $e;
	}

}

function checkNotification($user_id,$shop_id,$appointment_id){
	try{

		// $appointmentdetails=array();
		$dbname=DATABASE_NAME;
		$conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
		if(!$conn){
			throw new Exception(DATABASE_CONNECTION_ERROR);
		}

		$sql="select Appointment_ID from Notification where Appointment_ID=$appointment_id and User_ID=$user_id and Shop_ID=$shop_id;";

		$result=mysqli_query($conn,$sql);
		if(!$result){
			throw new Exception("Database error::$sql");
		}

		$rowcount=mysqli_num_rows($result);

		if($rowcount>0)
		{
			updateNotification($user_id,$shop_id,$appointment_id);
		}
		else {
			insertNotification($user_id,$shop_id,$appointment_id);
		}

		mysqli_close($conn);
		// return $appointmentdetails;

	}catch(Exception $e){
		mysqli_close($conn);
		throw $e;
	}

}

?>