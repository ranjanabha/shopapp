<?php
header('Access-Control-Allow-Origin: *');
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
     
                $user_id=stripslashes(htmlspecialchars(trim($_POST['User_id'])));
                $user_first_name=stripslashes(htmlspecialchars(trim($_POST['User_First_Name'])));
                $user_last_name=stripslashes(htmlspecialchars(trim($_POST['User_Last_Name'])));
                $user_login_mobile_no=stripslashes(htmlspecialchars(trim($_POST['User_Login_Mobile_No'])));
                $user_email_id1=stripslashes(htmlspecialchars(trim($_POST['User_email_id1'])));
           
              editUser($user_id,$user_first_name,$user_last_name,$user_login_mobile_no,$user_email_id1,$language);
             
              echo json_encode(['OPERATION'=>0]);
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>1,'IMAGE_URL'=>'NA','VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
   
function editUser($user_id,$user_first_name,$user_last_name,$user_login_mobile_no,$user_email_id1,$language)
{
	try{
		$dbname = DATABASE_NAME;
		
		$conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
		
		if(!$conn){
			throw new Exception(DATABASE_CONNECTION_ERROR);
		}
		$sql = "update User_Details set User_First_Name='$user_first_name',User_Last_Name='$user_last_name',User_Login_Mobile_No='$user_login_mobile_no',User_email_id1='$user_email_id1' where user_id=$user_id";
		$result = mysqli_query($conn,$sql);

		if(!$result){
			throw new Exception("Database error::$sql");
		}
	
		mysqli_close($conn);
	}catch(Exception $e){
		mysqli_close($conn);
		throw $e;
	}
	
}






?>