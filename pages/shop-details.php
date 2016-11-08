<!DOCTYPE html>
<html lang="en">
<?php
session_start();
try{
   $doctorid=$_SESSION['doctorid'];
    if(empty($doctorid)){
        header("Location: login.html");
    } 
}    
catch(Exception $e){
    header("Location: login.html");
}
?>    

<head>

<style type="text/css">

.display_none{
display: none;
}

</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor's App</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

      <div id="wrapper">

        <!-- Navigation -->
        

        <!-- Page Content -->
        <div id="page-wrapper" >
            <div class="row">
            <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-xs-offset-1">
                            <h4 style="margin-top:20px;">Admin Mode</h4>
                        </div>
                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2">
                            <li>
                            <a href="configure-shop.php">Create a new user</a>
                            </li>    
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <li>
                            <a href="shop-details.php">Manage Users</a>
                            </li>    
                        </div>
                         <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 pull-right">
                            <li>
                                <a href="../php/logout.php"><i class="fa fa-power-off fw"></i></a>                          
                            </li>    
                        </div>
                
                    </div>
                     <div class="h-divider">
                     </div>
                    <div class="row" style="margin-top:30px;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" >
                                         <form id="doc_details" role="form"  class="form-horizontal">
										
                                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 nopadding">
                                                <div class="form-group">
                                                    <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Serach</label>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                            <select class="form-control" name="searchCriteria" style="background-color:gainsboro">
                                                                <option value="SN">Nome</option>
                                                            </select>
                                                        </div>    
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8"><input type="text" name="searchData" placeholder="Enter shop name" class="form-control">
                                                    </div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="search"><i class="fa fa-search"></i>
									<span> Search</span></button>
									
								</div>                                                    
                                                </div>
                                             </div> 
        	<input type="hidden" placeholder="input value" name="doctor_id" id="doctor_id" class="form-control" value="<?php echo $doctorid ?>">
								      </form> 
								</div>      
				    </div>
                    <div class="row" style="margin-top:30px;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
                                        <div class="table-responsive">
                                           
											<table class="table table-bordered" id="shop_details_table">
												<thead>
												<tr>
													<th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Name of the shop</th>
													<th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Users Connected</th>
													<th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Appointments</th>
													<th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">SMS Sent</th>
													<th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">SMS Bank</th>
                                                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Add SMS</th>
                                                    <th class="col-lg-2 col-md-2 col-sm-2 col-xs-2">usar date</th>
												</tr>
												</thead>
												<tbody id="shop_details">
                                                </tbody> 
											</table>
								</div>      
				    </div>
                <!-- /.container-fluid -->
            </div>
                <!-- /.row -->
            </div> 
            
        <!-- /#page-wrapper -->
        </div>
        
        

       </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

   <script type="text/javascript">
   
   $(document).ready(function(){

	   $('#search').click(function(){
			$('#shop_details').html('');
			loadShop( true ); 
		});

		$(this).on( 'click' , '.edit_shop' , function(){

			var shop_id = $(this).attr('shop_id');
			document.location = 'update-shop.php?shop_id='+shop_id;
		});

		loadShop( false );

		$(this).on( 'click' , '.add_sms' , function(){

			var shop_id = $(this).attr('shop_id');
			var sms_count = $('#' + shop_id + '.sms_count' ).val();
			var formData = new FormData();
			formData.append( 'shop_id' , shop_id );
			formData.append( 'sms' , sms_count );
			formData.append( 'add' , true );

			$.ajax({
		           url: '../php/add-sms.php',
		           type: 'POST',
		           data: formData,
		           async: false,
		           success: function(data) {

		        	   var returnData = JSON.parse(data);

		        	   if( returnData.OPERATION == 0 ){

		        		   var error_code = returnData.VALIDATION_ERROR;
		        		   
		        		   $(".modal-body #success").hide();
		                   $(".modal-body #error").show();
		                   $(".modal-body #error #reason").remove();
		                   $('<h6 id="reason" style="color: #990000;text-align:center;">'
		                              +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+error_code+'</h6>').prependTo('#error');
		                   $("#messagemodal").modal();
		               }
		               else{
		            	   $(".modal-body #error").hide();
		                   $(".modal-body #success").show();
		                   $("#messagemodal").modal();
		               }
		           },
		           cache: false,
		           contentType: false,
		           processData: false
		       });
					
		});

		$(this).on( 'click' , '.sub_sms' , function(){

			var shop_id = $(this).attr('shop_id');
			var sms_count = $('#' + shop_id + '.sms_count' ).val();
			var formData = new FormData();
			formData.append( 'shop_id' , shop_id );
			formData.append( 'sms' , sms_count );
			formData.append( 'add' , false );

			$.ajax({
		           url: '../php/add-sms.php',
		           type: 'POST',
		           data: formData,
		           async: false,
		           success: function(data) {

		        	   var returnData = JSON.parse(data);

		        	   if( returnData.OPERATION == 0 ){

		        		   var error_code = returnData.VALIDATION_ERROR;
		        		   
		        		   $(".modal-body #success").hide();
		                   $(".modal-body #error").show();
		                   $(".modal-body #error #reason").remove();
		                   $('<h6 id="reason" style="color: #990000;text-align:center;">'
		                              +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+error_code+'</h6>').prependTo('#error');
		                   $("#messagemodal").modal();
		               }
		               else{
		            	   $(".modal-body #error").hide();
		                   $(".modal-body #success").show();
		                   $("#messagemodal").modal();
		               }
		           },
		           cache: false,
		           contentType: false,
		           processData: false
		       });
					
		});
		$('#dismiss_success').click(function(){
			document.location = 'shop-details.php';
		});

   });

	function loadShop( search ){

		 var formData = new FormData($('#doc_details')[0]);
		 formData.append( 'search' , search );
		   
	       $.ajax({
	           url: '../php/load-shop.php',
	           type: 'POST',
	           data: formData,
	           async: false,
	           success: function(data) {

	        	   var shopDetails = JSON.parse(data);

	        	   $.each(  shopDetails , function(index , value){

	        		   var shop_name = value.shop_name;
	        		   var user_connected = value.user_connected;
	        		   var sms_balance = value.sms_balance;
	        		   var sms_sent = value.sms_sent;
	        		   var shop_id = value.shop_id;
	        		   var appoinments = value.appoinments;

	            	   var shop_detail_clone = $('.shop_detail_clone').clone();
	            	   $( shop_detail_clone ).removeClass( 'display_none' );
	            	   $( shop_detail_clone ).removeClass( 'shop_detail_clone' );
	            	   $( shop_detail_clone ).find('.shop_name').html( shop_name );
	            	   $( shop_detail_clone ).find('.user_connected').html( user_connected );
	            	   $( shop_detail_clone ).find('.sms_balance').html( sms_balance );
	            	   $( shop_detail_clone ).find('.sms_sent').html( sms_sent );
	            	   $( shop_detail_clone ).find('.add_sms').attr( 'shop_id' , shop_id );
	            	   $( shop_detail_clone ).find('.sub_sms').attr( 'shop_id' , shop_id );
	            	   $( shop_detail_clone ).find('.sms_count').attr( 'id' , shop_id );
	            	   $( shop_detail_clone ).find('.appoinments').html( appoinments );
	            	   $( shop_detail_clone ).find('.edit_shop').attr( 'shop_id' , shop_id );
	            	   
	            	   $('#shop_details').append( shop_detail_clone.find('tr'));
	        	   });
	           },
	           cache: false,
	           contentType: false,
	           processData: false
	       });
	}

   </script>
   
    
  <table class="display_none shop_detail_clone">
	<tr>
    	<td class="shop_name"></td>
        <td class="user_connected"></td>
        <td class="appoinments"></td>
        <td class="sms_sent"></td>
        <td class="sms_balance"></td>
        <td>
			<div class="input-group">
			    <span class="sub_sms btn btn-sm btn-primary input-group-addon" ><i class="fa fa-minus fa-fw"></i></span>
  				<input type="text" class="form-control sms_count" aria-describedby="basic-addon2">
  				<span class="add_sms btn btn-sm btn-primary input-group-addon" ><i class="fa fa-plus fa-fw"></i></span>
			</div>        
        </td>
        <td>
        	<div class="col-sm-2"> <button type="button" class="btn btn-sm btn-primary edit_shop"><i class="fa fa-edit fa-fw"></i></button></div>
        </td>
	</tr>
  
  </table> 

    <div class="modal modal-lg modal-md modal-sm modal-xs" id="messagemodal" role="dialog" style="margin-top:200px;margin-left:200px;">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color:gainsboro">
        <div class="modal-body" >
            <div id="success">
                    <h6 id="reason" style="color: #006633;text-align:center;"><i class='fa fa-check fa-3x' style='color: #006633;margin-right:10px;'></i>Data inserted successfully</h6>
                    <button type="button" id="dismiss_success" class="btn btn-md btn-primary" style="margin-left:260px;margin-bottom:20px;" data-dismiss="modal">Close</button>
            </div>
            <div id="error">
            <button type="button" id="dismiss_error" class="btn btn-md btn-primary" style="margin-left:260px;margin-bottom:20px;" data-dismiss="modal">Close</button>
            </div>
        </div>
          
      </div>
    </div>
  </div>  

</body>

</html>
