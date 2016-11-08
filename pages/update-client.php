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
                               <div class="form-horizontal">
                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8  nopadding" >
                                          <input type="hidden" id="user_id" name="user_id" value="<?php echo $_GET['user_id'] ?>"/>
										
                                           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="namegroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Nome:</label>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"><input type="text" id="client_name" name="name" placeholder="inserire il nome" class="form-control" value="<?php echo $_GET['client_name'] ?>"></div> 
                                                </div>
                                           </div>
                                           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="surnamegroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Cognome:</label>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"><input type="text" id="client_surname" name="surname" placeholder="inserire il cognome" class="form-control" value="<?php echo $_GET['client_surname'] ?>"></div> 
                                                </div>
                                           </div> 
                                           <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="telephonegroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Neumero di telefone:</label>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><input type="text" name="telephone" id="client_telephone" placeholder="inserire il numero di telephono" class="form-control" value="<?php echo $_GET['client_telephone'] ?>"></div> 
                                                </div>
                                           </div>  
                                            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 nopadding">
                                                <div class="form-group" id="emailgroup"><label class="col-sm-4 col-md-4 col-lg-4 col-xs-4 control-label">Email:</label>
                                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6"><input type="text" name="email" id="client_email" placeholder="inserire la mail" class="form-control" value="<?php echo $_GET['email'] ?>"></div> 
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
                                <div class="col-sm-4 col-md-4 col-lg-4 col-xs-4"><button id="update" class="btn btn-primary">Update</button></div>
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

    var fromCLientList = $('#fromCLientList').val();
    
    
                $(function () {
                   $('#datetimepicker1').datetimepicker({
                       format:'DD/MM/YYYY'
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
      $('#update').click(function(){
          var name=$('#client_name').val();
          var lastname=$('#client_surname').val();
          var telephone=$('#client_telephone').val();
          var email=$('#client_email').val();
          var userid=$('#user_id').val();
        
          $.post("../php/update-client.php",
                {name:name,
                 lastname:lastname,
                 telephone:telephone,
                 email:email,
                 user_id:userid,
                 },
                function(result){
                  console.log(result);
                  var finaldata=JSON.parse(result);
               if(finaldata.OPERATION==0){
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
