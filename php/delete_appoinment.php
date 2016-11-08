<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
                $appointment_id = $_POST['appointment_id'];

                	deleteAppoinment($appointment_id);	
            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
function deleteAppoinment($appointment_id){
    
	try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
            
        $sql="update Client_Shop_Apnt set user_apnt_status = 'DELETED' , update_date = CURRENT_TIMESTAMP where appointment_id = $appointment_id";

        $result=mysqli_query($conn,$sql);
        
        echo json_encode(['OPERATION'=>1]);
        
        if(!$result){
            throw new Exception("Database error::$sql");
        }    
    } catch(Exception $e){
        throw $e;
    }   
    
}
?>