<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
                $sms = stripslashes(htmlspecialchars(trim($_POST['sms'])));
                $shop_id = stripslashes(htmlspecialchars(trim($_POST['shop_id'])));
                $add_sms = stripslashes(htmlspecialchars(trim($_POST['add'])));

                if(empty($sms) || !preg_match('/^[0-9]+$/',$sms)){
                      echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>'Numaric value expected']);
                }
                else{
                	updateIntoSMSTable($shop_id,$sms,$add_sms);	
                }
            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
function updateIntoSMSTable($shop_id,$sms,$add_sms){
    
	try{
             
          $dbname=DATABASE_NAME;
          $conn=mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
            }
            
            if( $add_sms == 'true' ){
				$sql="update SMS_Table set SMS_Limit = SMS_Limit + $sms where shop_id = $shop_id ";
            }
            else{
            	$sql="update SMS_Table set SMS_Limit = SMS_Limit - $sms where shop_id = $shop_id ";
            }

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