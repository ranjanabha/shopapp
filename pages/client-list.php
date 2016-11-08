<!DOCTYPE html>
<html lang="en">
<?php
session_start();
try{
   $shopid=$_SESSION['shopid'];
    if(empty($shopid)){
        header("Location: login.html");
    } 
}    
catch(Exception $e){
    header("Location: login.html");
}
?>    

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor's App</title>

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../css/bootstrap-toggle.min.css" rel="stylesheet">

	<style type="text/css">
	  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
	  .toggle.ios .toggle-handle { border-radius: 20px; }
	  
	</style>

<style type="text/css">

.display_none{
display: none;
}

.delete_appoinment{
cursor: pointer;
}
</style>
</head>

<body>

<div id="edit_client_data" class="display_none"></div>

     <div id="wrapper" class="client_list_details">

        <!-- Navigation -->
        

        <!-- Page Content -->
        <div id="page-wrapper" >
            <div class="row" style="margin-left:10px;">
            <div class="container-fluid">
                    <div class="row" style="margin-left:10px;">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <li>
                            <a href="new-client.php">Nuovo Cliente</a>
                            </li>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <li>
                            <a href="client-list.php">Elenco clienti</a>
                            </li>    
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <li>
                            <a href="activityoftoday.php">Attivit&aacute; di oggi</a>
                            </li>    
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <li>
                            <a href="my-profile.php">ll mio profilo</a>
                            </li>    
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                            <li>
                            <a href="client-message.php">Messaggi dai clienti&nbsp;<span class="badge" id="notification_count"  style="background-color:#C0392B;"></span></a>
                            </li>    
                        </div>
                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                            <li>
                                <a href="../php/logout.php"><i class="fa fa-power-off fw"></i></a>                          
                            </li>    
                        </div>
                
                    </div>
                     <div class="h-divider">
                     </div>
                    <div class="row" style="margin-top:20px;">
                    
				<form id="shop_details">
				
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-label" >Search :</label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 20px;" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                                <select class="input-sm form-control input-s-sm inline" style="background: gainsboro;" name="searchCriteria">
                                    <option value="F">Nome defoult</option>
                                    <option value="L">Cognome</option>
                                </select>
                                </div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
									<input type="text" name="searchData" placeholder="input name" class="form-control">
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <button type="button" class="btn btn-sm btn-primary" id="search"><i class="fa fa-search"></i>
									<span> Premi invio per cercare </span></button>
									
								</div>
                                
                                                     
                                </div>
        	<input type="hidden" placeholder="input value" name="shop_id" id="shop_id" class="form-control" value="<?php echo $shopid ?>">
        </form>                    
                                
                         </div>
                         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 20px;">
                           <div class="table-responsive">        
						    <table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Prossimo appuntamento</th>
                                    <th>serv. SMS</th>
                                    <th>Prenota un appuntamento</th>
                                    <th>Profilo</th>
                                </tr>
                                </thead>
                                <tbody id="client_details">
                                </tbody>
                            </table> 
                           </div>
                         </div>
                      </div>
				    </div>
				</div>
        </div>
    
    <div id="newappointment" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div id="newappointmentmodal" class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Nuovo apuntamento</h4>
                  </div>
                  <div class="modal-body">
                      <div class="form-horizontal">
                      
                      <div class="row" >
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" >
                                                        <div class="form-group" id="success-appointment" style="display:none">
                                                           <h6 style="color: #006633;text-align:center;"><i class='fa fa-check fa-3x' style='color: #006633;margin-right:10px;'></i>Data inserted successfully</h6>
                                                        </div>
                                                        <div class="form-group" id="error-appointment" style="display:none">
                                                        </div>
                                                        <div class="form-group" style="padding:0;margin:0;">
                                                            <label>Nome:</label>
                                                            <label id="appointment_name"></label>
                                                       </div>
                                                   
                                                        <div class="form-group" style="padding:0;margin:0;">
                                                            <label>Cognome:</label>
                                                            <label id="appointment_surname"></label>
                                                       </div>
                                        </div>
                          </div>
                           <div class="row" style="margin-top:30px;">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" >
                                            
                                                <div class="form-group" id="tipo_attivita_group">
                                                    
                                                    <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Tipo Attivit&aacute;:</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 pull-left">
                                                       <input type="text" placeholder="Type the activity to show on the application" name="tipo_attivita" id="tipo_attivita" class="form-control" >
                                                    </div>   
                                                       
                                                  </div>
                                            
                                                  <div class="form-group" id="seconda_attivita_group">
                                                       <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 nopadding">Seconda linea attivita(facoltativa):</label>
                                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 nopadding">
                                                            <input type="text" placeholder="Second line of description of the activity" name="seconda_attivita" id="seconda_attivita" class="form-control" >
                                                        </div>
                                                  </div>
                                                  
                                                 <div class="form-group" id="appointment_end_date_group">
                                                       <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Data:</label>
                                                       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                         <div class='input-group date' id='datetimepicker1'>
                                                            <input type='text' class="form-control" placeholder="" name="appointment_end_date" id="appointment_end_date" />
                                                            <span class="input-group-addon">
                                                                <i class="glyphicon glyphicon-calendar" style="color:brown"></i>
                                                            </span>
                                                        </div>
                                                       </div>
                                                        
                                                </div>
                                            
                                                    <div class="form-group">
                                                        <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 nopadding">Ora:</label>
                                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                            <select class="form-control" name="ora1" id="ora1">
                                                                <option value="0">00 </option>
                                                                <option value="1">01</option>
                                                                <option value="2">02</option>
                                                                <option value="3">03</option>
                                                                <option value="4">04</option>
                                                                <option value="5">05</option>
                                                                <option value="6">06</option>
                                                                <option value="7">07</option>
                                                                <option value="8">08</option>
                                                                <option value="9">09</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                <option value="13">13</option>
                                                                <option value="14">14</option>
                                                                <option value="15">15</option>
                                                                <option value="16">16</option>
                                                                <option value="17">17</option>
                                                                <option value="18">18</option>
                                                                <option value="19">19</option>
                                                                <option value="20">20</option>
                                                                <option value="21">21</option>
                                                                <option value="22">22</option>
                                                                <option value="23">23</option>
                                                               
                                                            </select>
                                                        </div>    
                                                        <label class="col-lg-1 col-md-1 col-sm-1 col-xs-1 control-label">:</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 nopadding">
                                                     <select class="form-control" name="ora2" id="ora2">
                                                            <option value="0">00</option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="30">30</option>
                                                            <option value="40">40</option>
                                                            <option value="50">50</option>
                                                     </select>
                                                    </div>
                                                   
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-lg-4 col-md-4 col-sm-4 col-xs-4">Servizio SMS:</label>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                                    <input type="checkbox" name="contacted" data-on="on" data-off="off" data-toggle="toggle" data-onstyle="success" data-size="mini" checked data-style="ios" value="checked">
                                                    
                                                    </div>
                                                     
                                                </div>
                                                
                                            <div class="form-group pull-right" style="margin-right:10px;">
                                                
                                                    <button id="addappointment" class="btn btn-primary">INSERISCI <br/>APPUNTAMENTO</button>
                                                    
                                                    <button id="addanotherapointment" class="btn btn-primary">INSERISCI UN ALTRO<br/> APPUNTAMENTO</button>
                                            </div>
                                            <input type="hidden" id="appointment_userid" name="appointment_userid"/>
                                            <input type="hidden" id="appointment_hidden_name" name="appointment_hidden_name"/>
                                            <input type="hidden" id="appointment_hidden_surname" name="appointment_hidden_surname"/>
                                            <input type="hidden" id="appointment_telephone" name="appointment_telephone"/>
                                            <input type="hidden" id="appointment_email" name="appointment_email"/>
                                        </div>
                          </div> 
                      
                      
                      
                      </div>
                           
                  </div>
          </div>
        </div>

    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>
	<script src="../js/bootstrap-toggle.min.js"></script>
    <script src="../vendor/moment/moment.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
     
    <script>
        $(document).ready(function(){

        	//$('#sms_service').bootstrapToggle("on");
        	
            loadClientList( false ); 

			$('#search').click(function(){
				$('#client_details').html('');
				 loadClientList( true ); 
			});
            
            $('#dismiss_success').click(function(){
    			document.location = 'client-list.php';
    		});
    		
            $(this).on( 'click' , '.delete_appoinment' , function(){
            	var appoinment_id = $(this).attr('appoinment_id');

            	var formData = new FormData();
            	formData.append( 'appointment_id' , appoinment_id );

                $.ajax({
                    url: '../php/delete_appoinment.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    success: function(data) {

                        $('.popover').hide();
                        $('#reason').html('Appointment cancelled successfully');
                    	$("#messagemodal").modal(); 
                    },
                    cache: false,
                    contentType: false,
                    processData: false
            	
                });
        });

		$(this).on( 'click' , '.book_new_appointment' , function(){

			var qrcode = $(this).attr('qrcode');
			var shop_id = $('#shop_id').val();
			var user_id = $(this).attr('user_id');
						
	         var formData = new FormData();
	         formData.append( 'shop_id' , shop_id );
	         formData.append( 'qrcode' , qrcode );
	         formData.append( 'user_id' , user_id );
	         
	          $.ajax({
	        url: '../php/search-client.php',
	        type: 'POST',
	        data: formData,
	        async: false,
	        success: function(data){
	              console.log(data);
	              var finaldata=JSON.parse(data);
	              if(finaldata.OPERATION==0){
	                    var searchresult=finaldata.SEARCH_RESULT;
	                    var userid=searchresult['user_id'];
	                    var name=searchresult['first_name'];
	                    var lastname=searchresult['last_name'];
	                    var mobileno=searchresult['mobile_no'];
	                    var email=searchresult['email_id'];
	                    
	                    $('#client_name').val(name);
	                    $('#client_surname').val(lastname);
	                    $('#client_telephone').val(mobileno);
	                    $('#client_email').val(email);
	                    $('#user_id').val(userid);
	                    $('#appointment_name').text(name);
	                    $('#appointment_surname').text(lastname);
	                    $('#appointment_userid').val(userid);
	              
	               }else{
	                  $("#errormessage").show();
	                 }
	              
	          },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});

		$(this).on( 'click' , '.edit_client' , function(){

			var qrcode = $(this).attr('qrcode');
			var shop_id = $('#shop_id').val();
			var user_id = $(this).attr('user_id');
						
	         var formData = new FormData();
	         formData.append( 'shop_id' , shop_id );
	         formData.append( 'qrcode' , qrcode );
	         formData.append( 'user_id' , user_id );
	         
	          $.ajax({
	        url: '../php/search-client.php',
	        type: 'POST',
	        data: formData,
	        async: false,
	        success: function(data){
	              console.log(data);
	              var finaldata=JSON.parse(data);
	              if(finaldata.OPERATION==0){
	                    var searchresult=finaldata.SEARCH_RESULT;
	                    var userid=searchresult['user_id'];
	                    var name=searchresult['first_name'];
	                    var lastname=searchresult['last_name'];
	                    var mobileno=searchresult['mobile_no'];
	                    var email=searchresult['email_id'];

	                    $.ajax({
	                        url: "update-client.php",
	                        data: 'user_id='+userid+'&client_name='+name+'&client_surname='+lastname+'&client_telephone='+mobileno+'&email='+email+'&fromCLientList=true',
	                        type: "GET",
	                        success: function(data){
	                              $('#edit_client_data').html(data);
	                              $('.client_list_details').hide();
	                              $('#edit_client_data').show();
	                        }
	                      });
	              }
	          },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	});
		
		 $('#addanotherapointment').click(function(){
	          
	          
	           $('#tipo_attivita').val('');
	           $('#seconda_attivita').val('');
	           $('#appointment_end_date').val('');
	           $('#ora1').val("0");
	           $('#ora2').val("0");
	           $('#sms_service').val("on");
	           $('#success-appointment').hide();
	           $('#error-appointment').hide();
	    });

	      $('#addappointment').click(function(){
	          
	           var isRequiredFieldBlank=false;   
	            if($("input[name='tipo_attivita']").val()==""){
	                $("#tipo_attivita_group").addClass("has-error");
	                isRequiredFieldBlank=true;
	            }else{
	                if($("#tipo_attivita_group").hasClass("has-error")){
	                    $("#tipo_attivita_group").removeClass("has-error")
	                }
	            }
	            if($("input[name='seconda_attivita']").val()==""){
	                $("#seconda_attivita_group").addClass("has-error");
	                isRequiredFieldBlank=true;
	            }else{
	                if($("#seconda_attivita_group").hasClass("has-error")){
	                    $("#seconda_attivita_group").removeClass("has-error")
	                }
	            } 
	            if($("input[name='appointment_end_date']").val()==""){
	                $("#appointment_end_date_group").addClass("has-error");
	                isRequiredFieldBlank=true;
	            }else{
	                if($("#appointment_end_date_group").hasClass("has-error")){
	                    $("#appointment_end_date_group").removeClass("has-error")
	                }
	            } 
	            
	          if(!isRequiredFieldBlank){
	              
	              var name=$('#appointment_hidden_name').val();
	              var lastname=$('#appointment_hidden_surname').val();
	              var telephone=$('#appointment_telephone').val();
	              var email=$('#appointment_email').val();
	              var userid=$('#appointment_userid').val();
	              var firstlineactivity=$('#tipo_attivita').val();
	              var secondlineactivity=$('#seconda_attivita').val();
	              var appointmentenddate=$('#appointment_end_date').val();
	              var ora1=$('#ora1').val();
	              var ora2=$('#ora2').val();
	              var sms_service=$('#sms_service').val();
	            $.post("../php/insert-appointment.php",
	                {appointment_hidden_name:name,
	                 appointment_hidden_surname:lastname,
	                 appointment_telephone:telephone,
	                 appointment_email:email,
	                 appointment_userid:userid,
	                 tipo_attivita:firstlineactivity,
	                 seconda_attivita:secondlineactivity,
	                 appointment_end_date:appointmentenddate,
	                 ora1:ora1,
	                 ora2:ora2,
	                 sms_service:sms_service
	                },
	                function(result){
	                  console.log(result);
	                  var finaldata=JSON.parse(result);
	               if(finaldata.OPERATION==0){
	                   var userid=finaldata.USER_ID;
	                   $('#appointment_userid').val(userid);
	                   $('#success-appointment').show();
	               }else{
	                   var error_code=finaldata.VALIDATION_ERROR;
	                   $('#success-appointment').hide();
	                   $('<h6 id="reason" style="color: #990000;text-align:center;">'
	                           +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+error_code+'</h6>').appendTo('#error-appointment');
	                    $('#error-appointment').show();
	               }
	                  
	          });
	          }
	         
	           
	      });
			 
        });
        function loadClientList(search){

        	var formData = new FormData($('#shop_details')[0]);
        	formData.append('search' , search );

            $.ajax({
                url: '../php/load-client.php',
                type: 'POST',
                data: formData,
                async: false,
                success: function(data) {

             	   var clientDetails = JSON.parse(data);

             	  var client_details = "";
             	  
             	   $.each(  clientDetails , function(index , value){

             		   var user_first_name = value.user_first_name;
             		   var user_last_name = value.user_last_name;
             		   var user_id = value.user_id;
             		   var user_qr_code = value.user_qr_code;

             		   var shop_id = $('#shop_id').val();

             		   var appoinmentDate = "";
             		   var is_sms_active = false;
             		   var appointment_ID = 0;
             		   
             		  var formData = new FormData();
            		  formData.append( 'shop_id' , shop_id );
            		  formData.append( 'user_id' , user_id );

            		  var details='';
            		  
             		  $.ajax({
                          url: '../php/load-client_appoinment.php',
                          type: 'POST',
                          data: formData,
                          async: false,
                          success: function(data) {

                        	  var clientApntDetails = JSON.parse(data);
                        	  
                        	   $.each(  clientApntDetails , function(index , value1){

                            	   if( jQuery.isEmptyObject( appoinmentDate ) ){
                            		   appoinmentDate = value1.user_apnt_dt;
                            		   is_sms_active = value1.is_sms_active;
                            		   appointment_ID = value1.Appointment_ID;
                            	   }
                            	   
                            	   details =  details + value1.user_apnt_dt + ' ' +  value1.user_apnt_time + '<i appoinment_id='+value1.Appointment_ID+' class=\'delete_appoinment fa fa-close\' style=\'color:red;margin-left:10px;\'> </i><br>';
                        	  });
                          },
                          cache: false,
                          contentType: false,
                          processData: false
                      });

             		 client_details = client_details + '<tr>'+
             	     '<td class="firstName">'+user_first_name+'</td>'+	
             	     '<td class="lastName">'+user_last_name+'</td>';

             	    if( jQuery.isEmptyObject( details )){
             	    	client_details = client_details + '<td></td>';
             	    }
             	    else{
             	    	client_details = client_details + '<td><span class="appoinment_date">'+appoinmentDate+'</span><a data-content="'+details+'" class="appoinment_details" href="#" data-toggle="popover" title="Prossimi Apuntamenti" data-html="true" ><i class="fa fa-calendar" style="font-size:20px"></i></a></td>'
             	    }

             	    var sms_enable = '';

             	    if( value.is_sms_active == '1' ){
             	    	sms_enable='checked';
             	    }
             	    
             	        
             	   client_details = client_details + '<td class="sms_option" >'+   
             	     '<input type=\"checkbox\" name=\"sms_enable\" shop_id='+shop_id+' user_id='+user_id+' data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" data-onstyle=\"success\" data-size=\"mini\" '+sms_enable+' data-style=\"ios\" value=\"'+sms_enable+'\">'+   
             	     '</td>'+   
             	     '<td ><a qrcode='+user_qr_code+' user_id='+user_id+' class="book_new_appointment" data-toggle="modal" href="#newappointment" style="color: blue;" >Book New Appoinment</a></td>'+   
             	     '<td><button qrcode='+user_qr_code+' user_id='+user_id+' class="btn btn-primary edit_client" type="button" ><i class="fa fa-pencil"></i></button></td>'+   
             	     '</tr>';
             	   });
           	      $('#client_details').append( client_details )
                },
                cache: false,
                contentType: false,
                processData: false
            });
            $("[name='sms_enable']").bootstrapToggle('on');
            $('[data-toggle="popover"]').popover();
           }

   </script>
   <script type="text/javascript">

                
   
                $(function () {
                   $('#datetimepicker1').datetimepicker({
                       format:'YYYY-MM-DD'
                    });

                   $(document).on('change','[name="sms_enable"]',function(){

                      var currentStatus = $(this).prop('checked') ;
               		  var shop_id = $(this).attr('shop_id') ;
               		  var user_id = $(this).attr('user_id');
               						
               	      var formData = new FormData();
               	      formData.append( 'shop_id' , shop_id );
               	      formData.append( 'user_id' , user_id );
               	   	  formData.append( 'is_sms_active' , currentStatus );

            	      $.ajax({
                          url: '../php/update_client_sms_settings.php',
                          type: 'POST',
                          data: formData,
                          async: false,
                          success: function(data) {

                              console.log( data );
                          },
                          cache: false,
                          contentType: false,
                          processData: false
                      });
                   });  
                });
    </script>  
	<script>
     var ajax_call = function() {
        $.ajax({
        url: '../php/get-notification-count.php',
        type: 'POST',
        async: false,
        success:function(data){
        // console.log(data);
         var finaldata=JSON.parse(data);
         if(finaldata.COUNT>0){
            $('#notification_count').show();
            $('#notification_count').text(finaldata.COUNT);
          }else{
               $('#notification_count').hide();
               }
        },
        cache: false,
        contentType: false,
        processData: false
    });    
      };

var interval = 1000 * 60 * 1; // where X is your every X minutes

setInterval(ajax_call, interval);
    
    </script>
	
    <div class="modal modal-lg modal-md modal-sm modal-xs" id="messagemodal" role="dialog" style="margin-top:200px;margin-left:200px;">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color:gainsboro">
        <div class="modal-body" >
            <div>
                    <h6 id="reason" style="color: #006633;text-align:center;"><i class='fa fa-check fa-3x' style='color: #006633;margin-right:10px;'></i></h6>
                    <button type="button" id="dismiss_success" class="btn btn-md btn-primary" style="margin-left:260px;margin-bottom:20px;" data-dismiss="modal">Close</button>
            </div>
        </div>
          
      </div>
    </div>
  </div>  

</body>
</html>
