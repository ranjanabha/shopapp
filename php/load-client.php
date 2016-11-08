<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
                $shop_id = trim($_POST['shop_id']);
                $search = trim($_POST['search']);
                $searchCriteria = trim($_POST['searchCriteria']);
                $searchData = trim($_POST['searchData']);
                       
                     loadClientDetails($shop_id,$search,$searchCriteria,$searchData);
            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
   function loadClientDetails($shop_id,$search,$searchCriteria,$searchData){
       
       try{
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            
          if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
           }
           
           $sql = "select ud.user_id , ud.user_first_name , ud.user_last_name ,ud.user_qr_code , usm.is_sms_active from User_Details ud
          		   inner join User_Shop_Map usm on ud.user_id = usm.user_id
          		   and ud.user_status = 'Connected'
                   and usm.user_active_flag = 'Y'
                   and usm.shop_id = $shop_id";
           
           if( $search ){

           	
           	if( $searchCriteria == 'F'){
           		$sql = "select ud.user_id , ud.user_first_name , ud.user_last_name , ud.user_qr_code , usm.is_sms_active from User_Details ud
          		   inner join User_Shop_Map usm on ud.user_id = usm.user_id
          		   and ud.user_status = 'Connected'
                   and usm.user_active_flag = 'Y'
                   and usm.shop_id = $shop_id 
                   and ud.user_first_name like '%$searchData%'";
           	}
           	else{
           		$sql = "select ud.user_id , ud.user_first_name , ud.user_last_name , ud.user_qr_code , usm.is_sms_active from User_Details ud
          		   inner join User_Shop_Map usm on ud.user_id = usm.user_id
          		   and ud.user_status = 'Connected'
                   and usm.user_active_flag = 'Y'
                   and usm.shop_id = $shop_id 
                   and ud.user_last_name like '%$searchData%'";
           	}
           }

       		$result = mysqli_query($conn,$sql);
		  	
       		$client_details = array();
       		
	  	if(mysqli_num_rows($result)>0){

		  		while($row=mysqli_fetch_assoc($result)){ 
					$client_details[] = array( 'is_sms_active' => $row['is_sms_active']  , 'user_qr_code' => $row['user_qr_code']  , 'user_first_name' => $row['user_first_name'] , 'user_last_name' => $row['user_last_name'] , 'user_id' => $row['user_id']);
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