<!DOCTYPE html>

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
<html lang="en">

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
    
    <style type="text/css">
      .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; }
      .toggle.ios .toggle-handle { border-radius: 20px; }
    </style>
    
    
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
                    <div class="row" style="margin-top:30px;">
                                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding" >
                                         <form role="form"  class="form-horizontal" id="search">
										
                                           <div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 nopadding">
                                                <div class="form-group has-feedback" id="qrcodegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Codice a 8 cifre:</label>
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"><input type="text" name="qrcode" placeholder="inserire il codice" class="form-control"><span class="glyphicon glyphicon-ok form-control-feedback" style="color:#38B0DE;"></span></div>
                                                <div class="col-lg-4 col-sm-4 col-md-4 col-xs-4"><button class="btn btn-primary">Cerca</button></div>    
                                                </div>
                                                   
                                           </div>
                                             <!-- setting shop id as hidden field-->
                                           <input type="hidden" id="shopid" name="shop_id" value="<?php echo $_SESSION['shopid'] ?>"/>
                                            
                                             
                                        </form>
                                </div>
                                              
				    </div>
                    <div class="h-divider">
                    </div>
                    <div class="row" style="margin-top:30px;">
                               <div class="form-horizontal">
                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8  nopadding" >
                                        
										
                                           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="namegroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Nome:</label>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"><input type="text" id="client_name" name="name" placeholder="inserire il nome" class="form-control"></div> 
                                                </div>
                                           </div>
                                           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="surnamegroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Cognome:</label>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"><input type="text" id="client_surname" name="surname" placeholder="inserire il cognome" class="form-control"></div> 
                                                </div>
                                           </div> 
                                           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="telephonegroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Neumero di telefone:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><input type="text" name="telephone" id="client_telephone" placeholder="inserire il numero di telephono" class="form-control"></div> 
                                                </div>
                                           </div>  
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="emailgroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Email:</label>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"><input type="text" name="email" id="client_email" placeholder="inserire la mail" class="form-control"></div> 
                                                </div>
                                           </div>
                                            
                                            <input type="hidden" id="user_id" name="user_id"/>
                                            <input type="hidden" id="action" name="action"/> 
                                           </div>
                                </div>
                                <div class="col-xs-offset-1 nopadding" >
                                          <img alt="image" style="width:150px;"  src="../image/default_profile.png" >
                                </div>
                    </div>
                               
                                              
				    
                    <div class="row">
                       <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                            <div class="form-group nopadding">
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2"><label></label></div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2"><button id="insert" class="btn btn-primary">Inserisci!</button></div>
                                <div class="col-sm-2 col-md-2 col-lg-2 col-xs-2" style="margin-bottom:10px;"><button id="insert-appointment" class="btn btn-primary" data-toggle="modal" data-target="#newappointment">Inserisci+appuntamento!</button></div>
                                    
                            </div>
                           <div style="padding:20px;"></div>
                        </div>
                    </div>
                <!-- /.container-fluid -->
            </div>
                <!-- /.row -->
            </div> 
            
        <!-- /#page-wrapper -->
        </div>
        

       </div>
    <!-- /#wrapper -->
    
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
                                                    <input type="checkbox" id="sms_service" name="sms_service" data-on="on" data-off="off" data-toggle="toggle" data-onstyle="success" data-size="mini" data-style="ios" value="checked">
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
    
    <!-- /#wrapper -->
    <div class="modal modal-lg modal-md modal-sm modal-xs" id="messagemodal" role="dialog" style="margin-top:200px;margin-left:200px;">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color:gainsboro">
        <div class="modal-body" >
            <div id="success">
                    <h6 id="reason" style="color: #006633;text-align:center;"><i class='fa fa-check fa-3x' style='color: #006633;margin-right:10px;'></i>Data inserted successfully</h6>
            </div>
            <div id="error">
            </div>
        </div>
          <button type="button" id="dismiss_error" class="btn btn-md btn-primary" style="margin-left:260px;margin-bottom:20px;" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>  

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    
    <script src="../vendor/moment/moment.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
   
    <script src="../vendor/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
    <!--for bootstrap  date time picker-->
    <script type="text/javascript">
        
                $(function () {
                   $('#datetimepicker1').datetimepicker({
                       format:'YYYY-MM-DD'
                    });
                });
    </script>   
    
   
	<script src="../js/bootstrap-toggle.min.js"></script>
   
   
    <script>
    $("form#search").submit(function(){
    //check formdata for required fields add appropriate class 
    
    var isRequiredFieldBlank=false;   
    if($("input[name='qrcode']").val()==""){
        $("#qrcodegroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#qrcodegroup").hasClass("has-error")){
            $("#qrcodegroup").removeClass("has-error")
        }
    }
   
    if(!isRequiredFieldBlank){
         var formData = new FormData($(this)[0]);
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
    }
//end of submit
    return false;
    });
    
    </script>
    
    <script>
      $('#insert').click(function(){
          var name=$('#client_name').val();
          var lastname=$('#client_surname').val();
          var telephone=$('#client_telephone').val();
          var email=$('#client_email').val();
          var userid=$('#user_id').val();
          
          var isRequiredFieldBlank=false;   
    if($("input[name='name']").val()==""){
        $("#namegroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#namegroup").hasClass("has-error")){
            $("#namegroup").removeClass("has-error")
        }
    }
    if($("input[name='surname']").val()==""){
        $("#surnamegroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#surnamegroup").hasClass("has-error")){
            $("#surnamegroup").removeClass("has-error")
        }
    } 
    if($("input[name='telephone']").val()==""){
        $("#telephonegroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#telephonegroup").hasClass("has-error")){
            $("#telephonegroup").removeClass("has-error")
        }
    } 
    if($("input[name='email']").val()==""){
        $("#emailgroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#emailgroup").hasClass("has-error")){
            $("#emailgroup").removeClass("has-error")
        }
    } 
    
    $(".modal-body #success").hide();
    $(".modal-body #error").show();
    $(".modal-body #error #reason").remove(); 
        
        
    $('<h6 id="reason" style="color: #990000;text-align:center;">'
                           +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+'Please fill in the required field marked in red'+'</h6>').appendTo('#error'); 
    $("#messagemodal").modal();   
          
        if(!isRequiredFieldBlank)  {
            $.post("../php/add-client.php",
                {name:name,
                 lastname:lastname,
                 telephone:telephone,
                 email:email,
                 user_id:userid,
                 action:'Insert'},
                function(result){
                  console.log(result);
                  var finaldata=JSON.parse(result);
               if(finaldata.OPERATION==0){
                  $('#user_id').val('');
                  $('#client_name').val('');
                  $('#client_surname').val('');
                  $('#client_telephone').val('');
                  $('#client_email').val('');
                  $(".modal-body #success").show();
                  $(".modal-body #error").hide();
                  $(".modal-body #error #reason").remove();   
                  $("#messagemodal").modal();   
               }else{
                var finaldata=JSON.parse(result);
                var error_code=finaldata.VALIDATION_ERROR;   
                $(".modal-body #success").hide();
                $(".modal-body #error").show();
                $(".modal-body #error #reason").remove();
                $('<h6 id="reason" style="color: #990000;text-align:center;">'
                           +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+error_code+'</h6>').appendTo('#error');
                $("#messagemodal").modal();
                   
               }
                  
          });
        }
          
          
      })
    
    </script>
    <script>
      $('#insert-appointment').click(function(){
           var name=$('#client_name').val();
           var lastname=$('#client_surname').val();
           var telephone=$('#client_telephone').val();
           var email=$('#client_email').val();
          var userid=$('#user_id').val();
          $('#appointment_userid').val(userid);
          $('#appointment_hidden_name').val(name);
          $('#appointment_hidden_surname').val(lastname);
          $('#appointment_telephone').val(telephone);
          $('#appointment_email').val(email);  
          $('#appointment_name').text(name);
          $('#appointment_surname').text(lastname);
          $('#tipo_attivita').val('');
          $('#seconda_attivita').val('');
          $('#appointment_end_date').val('');
          $('#ora1').val("0");
          $('#ora2').val("0");
          $('#sms_service').bootstrapToggle("on");
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

</body>

</html>
