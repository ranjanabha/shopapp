<!DOCTYPE html>
<html lang="en">
<?php
session_start();
try{
   $doctorid=$_SESSION['doctorid'];
   $shop_id = stripslashes(htmlspecialchars(trim($_GET['shop_id'])));
   
    if(empty($doctorid)){
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
                        <form role="form"  class="form-horizontal" id="data" method="post" enctype="multipart/form-data">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nopadding" >
                                         
										
                                           <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7 nopadding">
                                                <div class="form-group" id="usernamegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Username*</label>

                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input id="user_name" type="text" name="username" placeholder="input value" class="form-control"></div>
                                                </div>
                                                <div class="form-group" id="passwordgroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Password*</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input id="password" type="password" name="password" placeholder="input-value" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group" id="shopnamegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Name of the shop*</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="shop_name" name="shop_name" placeholder="input value" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Secondo line name</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="shop_name_2" name="shop_name_2" placeholder="input-value" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group"  id="addressgroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Adress of the shop*</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="address" name="address" placeholder="input value" class="form-control">
                                                    </div>
                                                </div>

                                                <div class="form-group"  id="citygroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">City*</label>

                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="city" class="form-control" placeholder="input value" name="city"></div>
                                                </div>
                                                <div class="form-group" id="phonegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Phone</label>

                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="phone" class="form-control" placeholder="input value" name="phone"></div>
                                                </div>     
                                                  
                                                <div class="form-group" id="webpagegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Web Page</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="webpage" class="form-control" placeholder="input value" name="webpage"></div>
                                                </div>
                                                <div class="form-group" id="fbpagegroup"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Facebook Page</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="fbPage" placeholder="input value" name="facebook_page" class="form-control" ></div>
                                                </div>
                                                <div class="form-group"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Open hours</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="open_hours" placeholder="input value" name="open_hours" class="form-control" ></div>
                                                </div>

                                                <div class="form-group"><label class="col-lg-4 col-md-4 col-sm-4 col-xs-4 control-label">Second line detail</label>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8"><input type="text" id="open_hours_second_line" placeholder="input value" name="open_hours_second_line" class="form-control" ></div>
                                                </div>
													
											</div>
                                               
                                               
											<div class="col-lg-4 col-md-4 col-xs-4 col-sm-4" style="margin-left:20px;">
                                                
                                               <div class="form-group">
                                                   <label>Uploaded image</label>
                                               </div>
                                                
                                               <img alt="image" id="shop_image" style="width:150px;"  src="../image/default_profile.png" >
                                                
                                               <div class="form-group">
                                                <label>Add image</label>
                                               </div>
                                                
                                               <div class="form-group">
                                                <input  type="file" name="shop_photo">
                                               </div>
                                              <div class="radio">
                                                  <label>
                                                    <input type="radio" name="account_type" id="account_type1" value="Standard Account"/>Standard Account
                                                  </label>                                                
                                              </div>
                                              <div class="radio">
                                                  <label>
                                                    <input type="radio" name="account_type" id="account_type2" value="Premium Account"/>Premium Account
                                                  </label>                                                
                                              </div>
                                              <div class="radio">
                                                  <label>
                                                    <input type="radio" name="account_type" checked="checked" id="account_type3" value="Free Forever"/>Free Forever
                                                  </label>                                                
                                              </div>    
                                                  
                                               <div class="form-group" id="smsgroup" style="margin-top:10px;">
                                                        <label class="control-label pull-left">SMS</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" placeholder="input value" id="sms_count" name="sms" class="form-control" >
                                                        </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-4">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>    
                                                </div>
                                               <input type="hidden" placeholder="input value" name="doctor_id" id="doctor_id" class="form-control" value="<?php echo $doctorid ?>">
                                               <input type="hidden" placeholder="input value" name="shop_id" id="shop_id" class="form-control" value="<?php echo $shop_id ?>">
                                               <input type="hidden" placeholder="input value" name="shop_login_id" id="shop_login_id" class="form-control" >        
                                        </div>
                                           
								</div>
                              
                       </form>                      
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

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
    
    <script>

    $(document).ready(function(){

		load_shop_details();
        
    });

    function load_shop_details(){

    	var shop_id = $('#shop_id').val();

    	var formData = new FormData($(this)[0]);
    	formData.append( 'shop_id' , shop_id );
    	
        $.ajax({
      url: '../php/load_shop_detail_by_id.php',
      type: 'POST',
      data: formData,
      async: false,
      success: function(data) {

    	  var details = JSON.parse(data);

    	  var shopDetails = details.SEARCH_RESULT;

          var user_name = shopDetails['username'];
          var password = shopDetails['password'];
          var shop_name = shopDetails['shop_name'];
          var shop_description = shopDetails['shop_description'];
          var shop_address = shopDetails['shop_address'];
          var shop_city = shopDetails['shop_city'];
          var shop_phone = shopDetails['shop_phone'];
          var shop_web = shopDetails['shop_web'];
          var fb_page = shopDetails['fb_page'];
          var open_hrs = shopDetails['open_hrs'];
          var image_url = shopDetails['image_url'];
          var sms_remaining = shopDetails['sms_remaining'];
          var account_type = shopDetails['account_type'];
          var image_url = shopDetails['image_url'];
          var description = shopDetails['description'];
          var default_description = shopDetails['default_description'];
          var open_date = shopDetails['open_date'];
          var shop_login_id = shopDetails['shop_login_id'];

          $('#user_name').val( user_name );
          $('#password').val( password );
          $('#shop_name').val( shop_name );
          $('#shop_name_2').val( shop_description );
          $('#address').val( shop_address );
          $('#city').val( shop_city );
          $('#phone').val( shop_phone );
          $('#webpage').val( shop_web );
          $('#fbPage').val( fb_page );
          $('#open_hours').val( open_hrs );
          $('#sms_count').val( sms_remaining );
          $('#shop_image').attr( 'src' ,image_url );
          $('#open_hours_second_line').val( open_date );
          $('#shop_login_id').val( shop_login_id );

          var start_index = image_url.indexOf('upload');
          var end_index = image_url.length;
          var relativeUrl = image_url.substring(start_index,end_index);

          if(relativeUrl===''){
           $("#shop_image").attr("src","../"+"image/default_profile.png");
           
          }else{
             $("#shop_image").attr("src","../"+relativeUrl);
           }

          if( account_type == 'Premium Account' ){
        	  $('#account_type2').attr( 'checked' , true);
          }
          else if( account_type == 'Standard Account' ){
        	  $('#account_type1').attr( 'checked' , true);
          }
          else if( account_type == 'Free Forever' ){
        	  $('#account_type3').attr( 'checked' , true);
          }
          
      },
      cache: false,
      contentType: false,
      processData: false
  	});
    	
    }

    
    $("form#data").submit(function(){
    
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

    console.log( $('input[name=account_type]:checked').val());
    
    if(!isRequiredFieldBlank){
        
        if( $("#phonegroup").hasClass("has-error")){
            $("#phonegroup").removeClass("has-error");
        }
        if( $("#webpagegroup").hasClass("has-error")){
            $("#webpagegroup").removeClass("has-error");
        }
        if( $("#fbpagegroup").hasClass("has-error")){
            $("#fbpagegroup").removeClass("has-error");
        }
        if( $("#smsgroup").hasClass("has-error")){
            $("#smsgroup").removeClass("has-error");
        }
         var formData = new FormData($(this)[0]);
          $.ajax({
        url: '../php/update-shop.php',
        type: 'POST',
        data: formData,
        async: false,
        success: function(data) {
          console.log(data)      ;
          var finaldata=JSON.parse(data);
           console.log("operation value is"+finaldata.OPERATION)      ;
           if(finaldata.OPERATION==0){
                console.log("Inside if") ;
                var image_src=finaldata.IMAGE_URL;
                var start_index=image_src.indexOf('upload');
                var end_index=image_src.length;
                var relativeUrl=image_src.substring(start_index,end_index);
                 console.log(relativeUrl);
                if(relativeUrl===''){
                 $("#shop_image").attr("src","../"+"image/default_profile.png");
                 
                }else{
                   $("#shop_image").attr("src","../"+relativeUrl);
                 }
                  
                  $(".modal-body #error").hide();
                  $(".modal-body #success").show();
                  $("#messagemodal").modal();
                
             }else{
                console.log("Inside else") ;
                error_code="";
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
                $(".modal-body #error").show();
                $(".modal-body #error #reason").remove();
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
   
    else{
    	   $(".modal-body #success").hide();
    	    $(".modal-body #error").show();
    	    $(".modal-body #error #reason").remove(); 
    	        
    	        
    	    $('<h6 id="reason" style="color: #990000;text-align:center;">'
    	                           +"<i class='fa fa-remove fa-3x' style='color: #990000;margin-right:10px;'></i>"+'Please fill in the required field marked in red'+'</h6>').appendTo('#error'); 
    	    $("#messagemodal").modal();    

    }   

    return false;
    });
    
    </script>
      
             
   
    
   

</body>

</html>
