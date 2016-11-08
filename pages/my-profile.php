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

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
    

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="../css/bootstrap-toggle.min.css" rel="stylesheet">
    
    <style>
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
                        <form role="form" id="myprofile" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 nopadding" >
                                         
										
                                           <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 nopadding">
                                                <div class="form-group" id="usernamegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Username*</label>

                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" name="username" id="username" placeholder="Username" class="form-control"></div>
                                                </div>
                                                <div class="form-group" id="passwordgroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Password*</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" name="password" id="password" placeholder="Password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="shopnamegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Nome dell' &aacute;ttivit&aacute;:*</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" name="shop_name" id="shop_name" placeholder="Name of the shop" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Descrizione</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" name="description" id="description" placeholder="Description of the activity" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="addressgroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Indirizzio dell' attivit&aacute;*</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" name="address" id="address" placeholder="Address of the shop" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group" id="citygroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Citt&aacute;*</label>

                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" placeholder="City" name="city" id="city"></div>
                                                </div>
                                                <div class="form-group" id="phonegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Telefono</label>

                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" placeholder="Telephone Number" name="Phone" id="phone"></div>
                                                </div>     
                                                  
                                                <div class="form-group" id="webpagegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Sito Web</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" class="form-control" placeholder="Web Site" name="web_page" id="web_page"></div>
                                                </div>
                                                <div class="form-group" id="fbpagegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Pagina Facebook</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" placeholder="Facebook page" name="facebook_page" id="facebook_page" class="form-control" ></div>
                                                </div>
                                                <div class="form-group"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Orari de apertura</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" placeholder="Opening time" name="open_hours" id="open_hours" class="form-control" ></div>
                                                </div>

                                                <div class="form-group"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Seconda linea orari</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" placeholder="Second line opening time" name="open_hrs_2" id="open_hrs_2" class="form-control" ></div>
                                                </div>
													
											</div>
                                               
                                               
											<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="margin-left:10px;">
                                                
                                               <div class="form-group" style="padding-right:0px;padding-top:0px;padding-bottom:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;" >
                                                   <label>Uploaded images</label>
                                               </div>
                                                <img alt="image" id="shop_image" style="width:100px;"  src="../image/default_profile.png"/>
                                               
                                                
                                               <div class="form-group" style="padding-right:0px;padding-top:0px;padding-bottom:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;">
                                                <label>Add images</label>
                                               </div>
                                                
                                               <div class="form-group">
                                                <input  type="file" id="shop_photo" name="shop_photo">
                                               </div>
                                                <div class="form-group"><label>Testo degli appuntamenti:</label>
                                                    <div ><input type="text" placeholder="Description of the activity(of default)" name="default_description" id="default_description" class="form-control" ></div>
                                                </div>
                                                <div class="form-group" style="padding-right:0px;padding-top:0px;padding-bottom:0px;margin-right:70px;margin-top:0px;margin-bottom:0px;"><label>Servizio SMS ai clienti:</label>
                                                    <input type="checkbox" id="sms_service" name="sms_service" checked  data-on="on" data-off="off" data-toggle="toggle" data-onstyle="success" data-size="mini" data-style="ios" value="checked"/>
                                                </div>
                                                <div class="form-group" style="padding-right:0px;padding-top:0px;padding-bottom:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;"><label style="margin-top:0px;">Total SMS rimasti:</label>
                                                    <label class="text-success"  style="margin-top:0px;margin-left:70px;"><h4 id="sms_remaining"></h4></label>
                                                </div>
                                                <div class="form-group"><label>Primo avviso:</label>
                                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">    
                                                    <select class="input-sm form-control input-s-sm inline" style="background: gainsboro;" id="notification_hr_1" name="notification_hr_1">
                                                        <option value="2">2</option>
                                                        <option value="6">6</option>
                                                        <option value="12">12</option>
                                                        <option value="24">24</option>
                                                    </select>
                                                    </div>  
                                                </div>
                                                <div class="form-group"><label>Secondo avviso:</label>
                                                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">    
                                                    <select class="input-sm form-control input-s-sm inline" style="background: gainsboro;" id="notification_hr_2" name="notification_hr_2">
                                                        <option value="0">---</option>
                                                        <option value="2">2</option>
                                                        <option value="4">4</option>
                                                        <option value="6">6</option>
                                                    </select>
                                                    </div>  
                                                </div>
                                                <div class="form-group"><label>Avviso tramite SMS:</label>
                                                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right ">
                                                    <select class="input-sm form-control input-s-sm inline" style="background: gainsboro;" id="sms_hr_1" name="sms_hr_1">
                                                        <option value="2">2</option>
                                                        <option value="6">6</option>
                                                        <option value="12">12</option>
                                                        <option value="24">24</option>
                                                    </select>
                                                  </div>
                                                </div>
                                                <div class="form-group" style="padding-right:0px;padding-top:0px;padding-bottom:0px;margin-right:0px;margin-top:0px;margin-bottom:0px;">
                                                   <label><small>Gli SMS verranno inviati solo se l'utente non conferma tramite l'app.</small></label>
                                               </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                                    <button type="submit" id="updateprofile" class="btn btn-primary">Aggiorna profilo</button>
                                                    </div>    
                                                </div>
                                                    
                                        </div>
								</div>
                           
                                                
                       </form>                    
				    </div>
                <!-- /.container-fluid -->
        <!-- /#page-wrapper -->
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

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
            
    <script src="../js/bootstrap-toggle.min.js"></script>
    
    
    
    <script>
    
     
    
        $("form#myprofile").submit(function(){
        var formData = new FormData($(this)[0]);
            
        var isRequiredFieldBlank=false;   
    if($("input[name='username']").val()==""){
        $("#usernamegroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#usernamegroup").hasClass("has-error")){
            $("#usernamegroup").removeClass("has-error")
        }
    }
    if($("input[name='password']").val()==""){
        $("#passwordgroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#passwordgroup").hasClass("has-error")){
            $("#passwordgroup").removeClass("has-error")
        }
    } 
    if($("input[name='shop_name']").val()==""){
        $("#shopnamegroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#shopnamegroup").hasClass("has-error")){
            $("#shopnamegroup").removeClass("has-error")
        }
    } 
    if($("input[name='address']").val()==""){
        $("#addressgroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#addressgroup").hasClass("has-error")){
            $("#addressgroup").removeClass("has-error")
        }
    } 
    if($("input[name='city']").val()==""){
        $("#citygroup").addClass("has-error");
        isRequiredFieldBlank=true;
    }else{
        if($("#citygroup").hasClass("has-error")){
            $("#citygroup").removeClass("has-error")
        }
    }
    if(isRequiredFieldBlank){
        $(".modal-body #success").hide();
    $(".modal-body #error").show();
    $(".modal-body #error #reason").remove(); 
        
        
    $('<h6 id="reason" style="color: #990000;text-align:center;">'
                           +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+'Please fill in the required field marked in red'+'</h6>').appendTo('#error'); 
    $("#messagemodal").modal(); 
    }else{
        if( $("#phonegroup").hasClass("has-error")){
            $("#phonegroup").removeClass("has-error");
        }
        if( $("#webpagegroup").hasClass("has-error")){
            $("#webpagegroup").removeClass("has-error");
        }
        if( $("#fbpagegroup").hasClass("has-error")){
            $("#fbpagegroup").removeClass("has-error");
        }
        $.ajax({
        url: '../php/update-shop-details.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function(data) {
               console.log(data);
               var finaldata=JSON.parse(data);
              
               if(finaldata.OPERATION==0){
                   var search_result=finaldata.SEARCH_RESULT;
                   $("#username").val(search_result['username']);
                   $("#password").val(search_result['password']);
                   $("#shop_name").val(search_result['shop_name']);
                   $("#address").val(search_result['shop_address']);
                   $("#city").val(search_result['shop_city']);
                   $("#phone").val(search_result['shop_phone']);
                   $("#web_page").val(search_result['shop_web']);
                   $("#facebook_page").val(search_result['fb_page']);
                   $("#open_hours").val(search_result['open_hrs']);
                   $("#open_hrs_2").val(search_result['open_date']);
                   $("#sms_remaining").text(search_result['sms_remaining']);
                   $("#default_description").val(search_result['default_description']);
                   $("#description").val(search_result['description']);
                   if(search_result['sms_status']=='Y'){
                    $("#sms_service").bootstrapToggle('on') ;
                   }else{
                    $("#sms_service").bootstrapToggle('off');
                   }
                   
                   
                   if(search_result['notify_hr1']==24){
                       $("#notification_hr_1").val("24");
                   }
                   if(search_result['notify_hr1']==12){
                       $("#notification_hr_1").val("12");
                   }
                   if(search_result['notify_hr1']==6){
                       $("#notification_hr_1").val("6");
                   }
                   if(search_result['notify_hr1']==2){
                       $("#notification_hr_1").val("2");
                   }
                   
                   if(search_result['notify_hr2']==6){
                       $("#notification_hr_2").val("6");
                   }
                   else if(search_result['notify_hr2']==4){
                       $("#notification_hr_2").val("4");
                   }
                   else if(search_result['notify_hr2']==2){
                       $("#notification_hr_2").val("2");
                   }
                  else{
                       $("#notification_hr_2").val("0");
                   }
                   
                   if(search_result['sms_notify_hr']==24){
                       $("#sms_hr_1").val("24");
                   }
                   else if(search_result['sms_notify_hr']==12){
                       $("#sms_hr_1").val("12");
                   }
                   else if(search_result['sms_notify_hr']==6){
                       $("#sms_hr_1").val("6");
                   }
                  else{
                       $("#sms_hr_1").val("2");
                   }
                   
                   
                var image_src=search_result['image_url'];
                var start_index=image_src.indexOf('upload');
                var end_index=image_src.length;
                var relativeUrl=image_src.substring(start_index,end_index);
                $("#shop_image").attr("src","../"+relativeUrl);
                $(".modal-body #error #reason").remove();
                $(".modal-body #error").hide();
                $(".modal-body #success").show();  
                $("#messagemodal").modal();
               }else{
                var finaldata=JSON.parse(data);
                var error_code=finaldata.VALIDATION_ERROR; 
                if(error_code=="Supplied phone no not valid"){
                    $("#phonegroup").addClass("has-error");
                }
                if(error_code=="Supplied web url not valid"){
                    $("#webpagegroup").addClass("has-error");
                }
                if(error_code=="Supplied facebook web url not valid"){
                    $("#fbpagegroup").addClass("has-error");
                }
                if(error_code=="Field value sms supplied is not neumeric, only neumeric value expected"){
                     $("#smsgroup").addClass("has-error");
                }   
                $(".modal-body #success").hide();
                $(".modal-body #error #reason").remove();
                $(".modal-body #error").show();
                $('<h6 id="reason" style="color: #990000;text-align:center;">'
                           +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+error_code+'</h6>').appendTo('#error');
                $("#messagemodal").modal();
                   
               }
          },
        cache: false,
        contentType: false,
        processData: false
    }); 
       
        
    }        
      return false;
    });     
     
    
    
    
    </script>
      
    <script>
      
            $.post("../php/getShopDetailsByShopId.php",
                
                function(result){
                  console.log(result);
                  var finaldata=JSON.parse(result);
               if(finaldata.OPERATION==0){
                   var search_result=finaldata.SEARCH_RESULT;
                   $("#username").val(search_result['username']);
                   $("#password").val(search_result['password']);
                   $("#shop_name").val(search_result['shop_name']);
                   $("#address").val(search_result['shop_address']);
                   $("#city").val(search_result['shop_city']);
                   $("#phone").val(search_result['shop_phone']);
                   $("#web_page").val(search_result['shop_web']);
                   $("#facebook_page").val(search_result['fb_page']);
                   $("#open_hours").val(search_result['open_hrs']);
                   $("#open_hrs_2").val(search_result['open_date']);
                   $("#sms_remaining").text(search_result['sms_remaining']);
                   $("#default_description").val(search_result['default_description']);
                   $("#description").val(search_result['description']);
                   if(search_result['sms_service']=='Y'){
                    $("#sms_service").bootstrapToggle('on') ;
                   }else{
                    $("#sms_service").bootstrapToggle('off');
                   }
                   
                   if(search_result['notify_hr1']==24){
                       $("#notification_hr_1").val("24");
                   }
                   if(search_result['notify_hr1']==12){
                       $("#notification_hr_1").val("12");
                   }
                   if(search_result['notify_hr1']==6){
                       $("#notification_hr_1").val("6");
                   }
                   if(search_result['notify_hr1']==2){
                       $("#notification_hr_1").val("2");
                   }
                   
                   if(search_result['notify_hr2']==6){
                       $("#notification_hr_2").val("6");
                   }
                   else if(search_result['notify_hr2']==4){
                       $("#notification_hr_2").val("4");
                   }
                   else if(search_result['notify_hr2']==2){
                       $("#notification_hr_2").val("2");
                   }
                  else{
                       $("#notification_hr_2").val("0");
                   }
                   
                   if(search_result['sms_notify_hr']==24){
                       $("#sms_hr_1").val("24");
                   }
                   else if(search_result['sms_notify_hr']==12){
                       $("#sms_hr_1").val("12");
                   }
                   else if(search_result['sms_notify_hr']==6){
                       $("#sms_hr_1").val("6");
                   }
                  else{
                       $("#sms_hr_1").val("2");
                   }
                   
                   
                var image_src=search_result['image_url'];
                var start_index=image_src.indexOf('upload');
                var end_index=image_src.length;
                var relativeUrl=image_src.substring(start_index,end_index);
                $("#shop_image").attr("src","../"+relativeUrl);
                  
                   
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
