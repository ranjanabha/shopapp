<?php
session_start();
require("{$_SERVER['DOCUMENT_ROOT']}/shopapp/constant/application-constant.php");
try{
        if($_SERVER['REQUEST_METHOD']==='POST')
            {
                $doctor_id = trim($_POST['doctor_id']);
                $search = trim($_POST['search']);
                $searchCriteria = trim($_POST['searchCriteria']);
                $searchData = trim($_POST['searchData']);
                       
                     loadShopDetails($doctor_id,$search,$searchCriteria,$searchData);
            } else {
                throw new Exception(GET_METHOD_NOT_SUPPORTED);
            }
       }catch(Exception $e){
             echo json_encode(['OPERATION'=>0,'VALIDATION_ERROR'=>$e->getMessage()]);
    }
                   
   function loadShopDetails($doctor_id,$search,$searchCriteria,$searchData){
       
       try{
          $dbname = DATABASE_NAME;
          $conn = mysqli_connect(DATABASE_SERVER,DATABASE_USERNAME,DATABASE_PASSWORD,$dbname);
            
          if(!$conn){
                throw new Exception(DATABASE_CONNECTION_ERROR);
           }
			$sql = "select count(usm.user_id) as user_connected ,  sdm.shop_id , sd.shop_name1 , st.sms_limit , st.sms_current
				   ,(select count(user_id) as appoinments from Client_Shop_Apnt where shop_id = sdm.shop_id  and user_apnt_status IN ( 'BOOKED' , 'CONFIRMED' )) as appoinments
           		   from Doctor_Details dd
			       inner join Shop_Doc_Map sdm on dd.doc_id = sdm.doc_id
			       inner join Shop_Details sd on sd.shop_id = sdm.shop_id
			       inner join SMS_Table st on st.shop_id = sd.shop_id
			       and dd.doc_status = 'Y'
			       and sdm.shop_doc_link_flag = 'Y'
			       and sd.shop_status = 'Active'
			       and dd.doc_id = $doctor_id
			       left outer join User_Shop_Map usm on st.shop_id = usm.shop_id and user_active_flag = 'Y'
			       group by sd.shop_id";
           
           if( $search ){
           	$sql = "select count(usm.user_id) as user_connected ,  sdm.shop_id , sd.shop_name1 , st.sms_limit , st.sms_current
				   ,(select count(user_id) as appoinments from Client_Shop_Apnt where shop_id = sdm.shop_id  and user_apnt_status IN ( 'BOOKED' , 'CONFIRMED' )) as appoinments
           		   from Doctor_Details dd
			       inner join Shop_Doc_Map sdm on dd.doc_id = sdm.doc_id
			       inner join Shop_Details sd on sd.shop_id = sdm.shop_id
			       inner join SMS_Table st on st.shop_id = sd.shop_id
			       and dd.doc_status = 'Y'
			       and sdm.shop_doc_link_flag = 'Y'
			       and sd.shop_status = 'Active'
			       and dd.doc_id = $doctor_id and sd.shop_name1 like '%$searchData%'
			       left join User_Shop_Map usm on st.shop_id = usm.shop_id and user_active_flag = 'Y'
			       group by sd.shop_id";
           	
           }
           
       		$result=mysqli_query($conn,$sql);
		  			$shop_details = array();
       		
	  	if(mysqli_num_rows($result)>0){

		  		while($row=mysqli_fetch_assoc($result)){ 
					$shop_details[] = array( 'appoinments' => $row['appoinments'] , 'shop_id' => $row['shop_id'] , 'shop_name' => $row['shop_name1'] ,'user_connected' => $row['user_connected'],'sms_balance' => $row['sms_limit'],'sms_sent' => $row['sms_current']);
     			 }
 			 }
			mysqli_close($conn);
			
  			echo json_encode($shop_details);
  
      }catch(Exception $e){
          mysqli_close($conn);   
          throw $e;
      }
       
       
   }
?>