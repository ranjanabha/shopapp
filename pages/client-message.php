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

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
     <!-- Bootstrap datetimepicker CSS -->
    <link href="../vendor/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet">


    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
<link href="../css/bootstrap-toggle.min.css" rel="stylesheet">
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<style type="text/css">
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
  .toggle.ios .toggle-handle { border-radius: 20px; }
</style>
</head>

<body>


    <div id="wrapper">

        <!-- Navigation -->
        

        <!-- Page Content -->
        <div id="page-wrapper" >
            <div class="row">
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
                            <a href="client-message.php">Messaggi dai clienti&nbsp;<span id="notification_count" class="badge" style="background-color:#C0392B;"></span></a>
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
					<form role="form" id="appointment-search" class="form-horizontal">	
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                       <label class="col-lg-2 col-md-2 col-sm-2 col-xs-2 control-labelnopadding"> Search :</label>
                        <label><input type="hidden" id="shop_id" value='<?php echo $_SESSION['shopid'] ?>'/></label>
                    </div>
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 20px;" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
                                <select name="search_option" id="search_option" class="input-sm form-control input-s-sm inline" style="background: gainsboro;">
                                    <option value="Name">Name defoult</option>
                                    <option value="Cognome">Cognome</option>
                                </select>
                                </div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
									<input type="text" name="searchvalue" id="searchvalue" placeholder="Place holder" class="form-control">
								</div>
								<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <button class="btn btn-sm btn-primary"><i class="fa fa-search"></i>
									<span> Premi invio per cercare </span>
                                    </button>
									
								</div>
                                
                        </div>    
						</form>	    
                         </div>
                        
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" style="margin-top: 20px;">
                        <div class="table-responsive">
						<table class="table table-bordered" >
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Cognome</th>
                                    <th>Appuntamento</th>
                                    <th>Stato</th>
                                    <th>Nuovo appuntamento</th>
                                    <th>Contattato</th>
                                    <th>Telefono*</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                
                                </tbody>
                            </table>   
                            </div>
                         </div>
                                          
                      </div>
                                              
				    </div>
				    
				    </div>
				    </div>
   <!--modal window for new appointment-->
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
                                                           <h6 id="reason" style="color: #006633;text-align:center;"><i class='fa fa-check fa-3x' style='color: #006633;margin-right:10px;'></i>Data inserted successfully</h6>
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
                                                    <input type="checkbox" id="sms_service" name="sms_service" data-on="on" data-off="off" checked data-toggle="toggle" data-onstyle="success" data-size="mini" data-style="ios" value="on">
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
                                            <input type="hidden" id="action" name="action" value="update"/>
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
    <!--for bootstrap  date time picker-->
    <script type="text/javascript">
        
                $(function () {
                   $('#datetimepicker1').datetimepicker({
                       format:'YYYY-MM-DD'
                    });
                   $('#datetimepicker2').datetimepicker({
                       format:'YYYY-MM-DD'
                    });
                });
               
    </script>   
     <script>
          $(document).on('click','[data-toggle="popover"]',function(){
               $('[data-toggle="popover"]').popover();
           });
       
    </script>
	
	<script>
		$("form#appointment-search").submit(function(e){
            e.preventDefault();   
            var formData = new FormData($(this)[0]);
            $('tbody tr').remove(); 
			$.ajax({
					url: '../php/show-notification.php',
					type: 'POST',
					data:formData,		
					async: false,
					success: function(data) {
					  console.log(data);
					  var finaldata=JSON.parse(data);
					   console.log("operation value is"+finaldata.OPERATION)      ;
					   if(finaldata.OPERATION==0){
							var result=finaldata.SEARCH_REASULT;
							var tablerowindex=0;
							$.each(result,function(){
								var html="<tr>";
								html=html+"<td>"+result[tablerowindex]['first_name']+"<input type=\"hidden\" id=\"user_id\" value=\""+result[tablerowindex]['user_id']+"\""+"/>"+"</td>";
								html=html+"<td>"+result[tablerowindex]['last_name']+"<input type=\"hidden\" id=\"appointment_id\" value=\""+result[tablerowindex]['appointment_id']+"\""+"/>"+"</td>";
								html=html+"<td>"+result[tablerowindex]['appointment_date']+"</td>";

								if(result[tablerowindex]['notification_msg']=='DELETED'){
									var confirmeddata="<a href=\"#\" style=\"color:red;font-weight:bold;\" data-toggle=\"popover\" data-html=\"true\" data-content=\"<h6 style='font-weight:bold;text-align:center;'><span style='color:red;font-weight:bold'>DISDETTO:</span></h6><h6 style='text-align:center'>"+result[tablerowindex]['notification_date']+"</h6>\">DISDETTO</a>";
									html=html+"<td>"+confirmeddata+"</td>";
								}
								if(result[tablerowindex]['notification_msg']=='POSTPONED'){
									var confirmeddata="<a href=\"#\" style=\"color:green;font-weight:bold;\" data-toggle=\"popover\" data-html=\"true\" data-content=\"<h6 style='font-weight:bold;text-align:center;'><span style='color:green;font-weight:bold'>CHIAMARA:</span></h6><h6 style='text-align:center'>"+result[tablerowindex]['notification_date']+"</h6>\">CHIAMARA</a>";
									html=html+"<td>"+confirmeddata+"</td>";
								}

								html=html+"<td><a style=\"color: blue;\" name=\"appointment_window\""+">Fissa un appuntamento</a></td>";
								if(result[tablerowindex]['is_client_contacted']=='N'||result[tablerowindex]['is_client_contacted']==''){
								html=html+"<td><input type=\"checkbox\" name=\"contacted\" data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" data-onstyle=\"success\" data-size=\"mini\" data-style=\"ios\" value=\"checked\"></td>";
								}
								if(result[tablerowindex]['is_client_contacted']=='Y'){
								html=html+"<td><input type=\"checkbox\" name=\"contacted\" data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" data-onstyle=\"success\" data-size=\"mini\" checked data-style=\"ios\" value=\"checked\"></td>";
								}

								if(result[tablerowindex]['notification_msg']=='POSTPONED'){
								  html=html+"<td style=\"color:green\">"+result[tablerowindex]['telephone']+"</td>";
								}
								if(result[tablerowindex]['notification_msg']=='DELETED'){
									html=html+"<td style=\"color:red\">"+result[tablerowindex]['telephone']+"</td>";
								}

								html=html+"</tr>";
								$('tbody').append(html);
								tablerowindex++;
							});
                            $("[data-toggle='toggle']").bootstrapToggle();
						 }else{

					   }
					},
					cache: false,
					contentType: false,
					processData: false
				});
		});
	</script>
    
    
    
    <script>
     $.ajax({
        url: '../php/show-notification.php',
        type: 'POST',
        async: false,
        success: function(data) {
          console.log(data);
          var finaldata=JSON.parse(data);
           console.log("operation value is"+finaldata.OPERATION)      ;
           if(finaldata.OPERATION==0){
                var result=finaldata.SEARCH_REASULT;
                var tablerowindex=0;
                $.each(result,function(){
                    var html="<tr>";
                    html=html+"<td>"+result[tablerowindex]['first_name']+"<input type=\"hidden\" id=\"user_id\" value=\""+result[tablerowindex]['user_id']+"\""+"/>"+"</td>";
                    html=html+"<td>"+result[tablerowindex]['last_name']+"<input type=\"hidden\" id=\"appointment_id\" value=\""+result[tablerowindex]['appointment_id']+"\""+"/>"+"</td>";
                    html=html+"<td>"+result[tablerowindex]['appointment_date']+"</td>";
        
                    if(result[tablerowindex]['notification_msg']=='DELETED'){
                        var confirmeddata="<a href=\"#\" style=\"color:red;font-weight:bold;\" data-toggle=\"popover\" data-html=\"true\" data-content=\"<h6 style='font-weight:bold;text-align:center;'><span style='color:red;font-weight:bold'>DISDETTO:</span></h6><h6 style='text-align:center'>"+result[tablerowindex]['notification_date']+"</h6>\">DISDETTO</a>";
                        html=html+"<td>"+confirmeddata+"</td>";
                    }
                    if(result[tablerowindex]['notification_msg']=='POSTPONED'){
                        var confirmeddata="<a href=\"#\" style=\"color:green;font-weight:bold;\" data-toggle=\"popover\" data-html=\"true\" data-content=\"<h6 style='font-weight:bold;text-align:center;'><span style='color:green;font-weight:bold'>CHIAMARA:</span></h6><h6 style='text-align:center'>"+result[tablerowindex]['notification_date']+"</h6>\">CHIAMARA</a>";
                        html=html+"<td>"+confirmeddata+"</td>";
                    }
                    
                    html=html+"<td><a style=\"color: blue;\" name=\"appointment_window\""+">Fissa un appuntamento</a></td>";
                    if(result[tablerowindex]['is_client_contacted']=='N'||result[tablerowindex]['is_client_contacted']==''){
				      html=html+"<td><input type=\"checkbox\" name=\"contacted\" data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" data-onstyle=\"success\" data-size=\"mini\" data-style=\"ios\" value=\"checked\"></td>";
				     }
                    if(result[tablerowindex]['is_client_contacted']=='Y'){
				      html=html+"<td><input type=\"checkbox\" name=\"contacted\" data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" checked data-onstyle=\"success\" data-size=\"mini\" data-style=\"ios\" value=\"checked\"></td>";
				     }
                   
                    if(result[tablerowindex]['notification_msg']=='POSTPONED'){
                      html=html+"<td style=\"color:green\">"+result[tablerowindex]['telephone']+"</td>";
                    }
                    if(result[tablerowindex]['notification_msg']=='DELETED'){
                        html=html+"<td style=\"color:red\">"+result[tablerowindex]['telephone']+"</td>";
                    }
                   
                    html=html+"</tr>";
                    $('tbody').append(html);
                    tablerowindex++;
                });
             }else{
            
           }
        },
        cache: false,
        contentType: false,
        processData: false
    });
    
    
    
</script>
    
<script>
     $.ajax({
        url: '../php/update-notification-date.php',
        type: 'POST',
        async: false,
        success:function(data){
         console.log(data);
        },
        cache: false,
        contentType: false,
        processData: false
    });    
</script>    
<script>
   $(document).on('click','[name=appointment_window]',function(){
        var $row = $(this).closest("tr"),       
        $tds = $row.find("td");             
        var tabledata=[];
        var inputfieldvalues=[]
        var index=0;
        $.each($tds, function() {               
         tabledata[index]=$(this).text();
         index++;    
        });
        $inputfields=$row.find("input");
        var inputindex=0;
        $.each($inputfields,function(){
            inputfieldvalues[inputindex]=$(this).val();
            inputindex++;
        })
        $('#appointment_name').text(tabledata[0]);
        $('#appointment_surname').text(tabledata[1]);
        $('#appointment_hidden_name').val(tabledata[0]);
        $('#appointment_hidden_surname').val(tabledata[1]);
        $('#appointment_telephone').val(tabledata[6]);
        $('#appointment_userid').val(inputfieldvalues[0]);
        $('#appointment_email').val(inputfieldvalues[1]);
        $("#newappointment").modal();
   });
    
</script>
 <script>
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
              var sms_service=$('#sms_service').prop('checked');
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
    
    </script> 
    <script>
    $('#addanotherapointment').click(function(){
          
          
           $('#tipo_attivita').val('');
           $('#seconda_attivita').val('');
           $('#appointment_end_date').val('');
           $('#ora1').val("0");
           $('#ora2').val("0");
           $('#sms_service').val("on");
           $('#success-appointment').hide();
           $('#error-appointment').hide();
    })
    
    </script>
    
    <script>
     var ajax_call = function() {
        $.ajax({
        url: '../php/get-notification-count.php',
        type: 'POST',
        async: false,
        success:function(data){
         //console.log(data);
         var finaldata=JSON.parse(data);
         if(finaldata.COUNT>0){
            $('#notification_count').show();
            $('#notification_count').text(finaldata.COUNT);
            $.ajax({
        url: '../php/show-notification.php',
        type: 'POST',
        async: false,
        success: function(data) {
          console.log(data);
          var finaldata=JSON.parse(data);
           console.log("operation value is"+finaldata.OPERATION)      ;
           if(finaldata.OPERATION==0){
                $('tbody tr').remove();
                var result=finaldata.SEARCH_REASULT;
                var tablerowindex=0;
                $.each(result,function(){
                    var html="<tr>";
                    html=html+"<td>"+result[tablerowindex]['first_name']+"<input type=\"hidden\" id=\"user_id\" value=\""+result[tablerowindex]['user_id']+"\""+"/>"+"</td>";
                    html=html+"<td>"+result[tablerowindex]['last_name']+"<input type=\"hidden\" id=\"appointment_id\" value=\""+result[tablerowindex]['appointment_id']+"\""+"/>"+"</td>";
                    html=html+"<td>"+result[tablerowindex]['appointment_date']+"</td>";
        
                    if(result[tablerowindex]['notification_msg']=='DELETED'){
                        var confirmeddata="<a href=\"#\" style=\"color:red;font-weight:bold;\" data-toggle=\"popover\" data-html=\"true\" data-content=\"<h6 style='font-weight:bold;text-align:center;'><span style='color:red;font-weight:bold'>DISDETTO:</span></h6><h6 style='text-align:center'>"+result[tablerowindex]['notification_date']+"</h6>\">DISDETTO</a>";
                        html=html+"<td>"+confirmeddata+"</td>";
                    }
                    if(result[tablerowindex]['notification_msg']=='POSTPONED'){
                        var confirmeddata="<a href=\"#\" style=\"color:green;font-weight:bold;\" data-toggle=\"popover\" data-html=\"true\" data-content=\"<h6 style='font-weight:bold;text-align:center;'><span style='color:green;font-weight:bold'>CHIAMARA:</span></h6><h6 style='text-align:center'>"+result[tablerowindex]['notification_date']+"</h6>\">CHIAMARA</a>";
                        html=html+"<td>"+confirmeddata+"</td>";
                    }
                    
                    html=html+"<td><a style=\"color: blue;\" name=\"appointment_window\""+">Fissa un appuntamento</a></td>";
                    if(result[tablerowindex]['is_client_contacted']=='N'||result[tablerowindex]['is_client_contacted']==''){
				      html=html+"<td><input type=\"checkbox\" name=\"contacted\" data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" data-onstyle=\"success\" data-size=\"mini\" data-style=\"ios\" value=\"checked\"></td>";
				     }
                    if(result[tablerowindex]['is_client_contacted']=='Y'){
				      html=html+"<td><input type=\"checkbox\" name=\"contacted\" data-on=\"on\" data-off=\"off\" data-toggle=\"toggle\" checked data-onstyle=\"success\" data-size=\"mini\" data-style=\"ios\" value=\"checked\"></td>";
				     }
                   
                    if(result[tablerowindex]['notification_msg']=='POSTPONED'){
                      html=html+"<td style=\"color:green\">"+result[tablerowindex]['telephone']+"</td>";
                    }
                    if(result[tablerowindex]['notification_msg']=='DELETED'){
                        html=html+"<td style=\"color:red\">"+result[tablerowindex]['telephone']+"</td>";
                    }
                   
                    html=html+"</tr>";
                    $('tbody').append(html);
                    tablerowindex++;
                });
                $("[data-toggle='toggle']").bootstrapToggle();
             }else{
            
           }
        },
        cache: false,
        contentType: false,
        processData: false
    });
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
    
    <script>
       $(document).on('change','[name="contacted"]',function(){
        var currentStatus=$(this).prop('checked') ;
        var status_to_be_updated='N'   
        if(currentStatus==true) {
            status_to_be_updated='Y'
        }  
           
        var $row = $(this).closest("tr"),       
        $tds = $row.find("td");             
        var tabledata=[];
        var inputfieldvalues=[]
        var index=0;
        $.each($tds, function() {               
         tabledata[index]=$(this).text();
         index++;    
        });
        $inputfields=$row.find("input");
        var inputindex=0;
        $.each($inputfields,function(){
            inputfieldvalues[inputindex]=$(this).val();
            inputindex++;
        })   
           
        var user_id=inputfieldvalues[0];
        var appointment_id=inputfieldvalues[1]   
           
        $.post({
        url: '../php/update-contacted-status.php',
        type: 'POST',
        data:{
              user_id:user_id,
              appointment_id:appointment_id,
              shop_id:$('#shop_id').val(),
              status_to_be_updated:status_to_be_updated
            
        }, 
        success:function(data){
           console.log(data);
        }
        });
       })
    </script>
    
	
</body>

</html>
