<?php
header('Access-Control-Allow-Origin: *');

require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
    $user_id = stripslashes(htmlspecialchars(trim($_POST['user_id'])));
    $myAccount = viewmyAccount($user_id);
    
   echo json_encode(['OPERATION'=>0,'SEARCH_RESULT'=>$myAccount,'ERROR'=>'NA']);
    
}catch(Exception $e){
   echo json_encode(['OPERATION'=>1,'ERROR'=>$e->getMessage()]);
}

function viewmyAccount($user_id){

	try{
    	$myAccount = array();
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,DATABASE_NAME);
          
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
          
           $sql = "select User_id , User_First_Name , User_Last_Name , User_Login_Mobile_No , User_email_id1 from User_Details where user_id = $user_id";
          
           $result = mysqli_query($conn,$sql);
           
           if(!$result){
               throw new Exception("Database error::$sql");
           }
           
           $rowcount = mysqli_num_rows($result);
          
           if($rowcount>0){
                $row=mysqli_fetch_array($result);
                $myAccount['User_id']=$row['User_id'];
                $myAccount['User_First_Name']=$row['User_First_Name'];
                $myAccount['User_Last_Name']=$row['User_Last_Name'];
                $myAccount['User_Login_Mobile_No']=$row['User_Login_Mobile_No'];
                $myAccount['User_email_id1']=$row['User_email_id1'];
           }
          
          mysqli_close($conn);
          return $myAccount;
        
    }catch(Exception $e){
        mysqli_close($conn);
        throw $e;
    }
        
}
 
?>