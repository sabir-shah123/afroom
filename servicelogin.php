<?php error_reporting(0);?>
<?php
  include('api/db.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booking Portal |  Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/logo.png" />
    <link rel="stylesheet" href="fonts.css" type="text/css" charset="utf-8" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
	.demo
	{
		font-family:'Conv_Comfortaa-VariableFont_wght',Sans-Serif!important;
	}
	body{
		font-family:'Conv_Comfortaa-VariableFont_wght',Sans-Serif!important;
    
	}
      
      .btn-danger{
    /*background: #FFC300 !important;*/
background:#21a05d !important;
    border-color: #000000 !important;
    color: #000000!important;
   
}
	</style>
         <style>
	
	    #myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}
</style>
      </head>
  <body>

 
  

  <?php include('loader.php');?>
<video autoplay muted loop id="myVideo">
  <source src="video/taxi2.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
  <?php include('loader.php');?>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" style="background: #FFC300 !important;">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto text-center">
              <div class="auth-form p-5" style="background: rgba(255, 255, 255, 0.13);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgb(0 0 0 / 10%);
    backdrop-filter: blur(4.7px) !important;" >
                
               <a href="index.php"><button class="btn btn-danger"  style="width:50%;margin:15px 0px; position: absolute;
  top: 8px;
  left: 16px;"><i class="fa fa-home"> Home</i></button></a>

               <button  onclick="history.back()" class="btn btn-danger"  style="width:50%;margin:15px 0px; position: absolute;
  top: 8px;
  right: 16px;"><i class="fa fa-arrow-left"></i> Back </button>
                <br>
                   <br>
                   
                
                <h4  class="demo" style="color:black";>LOGIN TO PROVIDER PANEL </h4>
                <br>
                <form style="display:none;"  id="profile" action="api/updateprofile1.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Name</label>	
                    <input type="text" class="form-control" name="username"  placeholder="Username">
                  </div>
                  	<div class="form-group">
                    		<label>Gender</label>
                    		<select required class="form-control" name="gender">
                            		<option>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                            </select>
                    </div>
                    <div class="form-group"> 
                    	    <label>Country</label>	       
                            <input type="text" required class="form-control" name="country" placeholder="Country">
                     </div>
                     <div class="form-group">
                     	    <label>City</label>	       
                            <input type="text" required class="form-control" name="city" placeholder="City">
                      </div>
                      <div class="form-group">
                      	    <label>Refferal Code</label>      
                            <input type="text" required class="form-control" name="code" placeholder="Refferal Code">
                       </div>
                       <?php
                  	$log = mysqli_query($conn,"Select * from secu limit 1");
                  	$logfetch = mysqli_fetch_assoc($log);
                  	if($logfetch['servicenational']==1){
                  ?>
                       <div class="form-group"> 
                       	    <label>National Id Front</label>     
                            <input type="file"  class="form-control" name="national">
                       </div>
                       <div class="form-group">      
                       	   <label>National Id Back</label>     	
                            <input type="file" class="form-control" name="nationalback">
                       </div>
                      
                       <div class="form-group">   
                       	   <label>RC</label>     	   
                            <input type="file" required class="form-control" name="rc">
                       </div>
                       <div class="form-group">
                       	    <label>License</label>     	     
                            <input type="file" required class="form-control" name="profile">
                    </div>
                    	    
                     <?php } ?>
                     <div class="form-group">
                       	    <label>Reg As</label>     	     
                       	    <select class="form-control" requried name="regas">
                       	    	<option value="">Select</option>
                       	    	<option>Ride Booking</option>
             			<option>Plumber</option>
             			<option>Fibre Optic Engineer</option>
                       	    </select>
                    </div>   
                    <input type="hidden" name="id" id="id">
                  	<button type="submit" style="width:100%;" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
                  
                  </form>
                  <?php
				  include('api/db.php');
                  	$pre = mysqli_query($conn,"Select * from prefixs order by id desc limit 1");
					$fetch = mysqli_fetch_assoc($pre);
				  ?>
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg mob numberonly" name="mobile" style="border: 1px solid #000000"!important; value="<?php echo $fetch['prefix'];?>" placeholder="Mobile">
                  
                  </div>
                  <div class="form-group otp" style="display:none;">
                  	<div style="padding:5px 0px;color:green;font-weight:bold" class="countdown"></div>	
                    <input type="text" class="form-control form-control-lg" name="otpcode" placeholder="Otpcode">
                    <input type="button" id="showtime" class="btn btn-warning" value="Resend Otp" onclick="sendotp()">
                  </div>
                  <button onclick="sendotp()" type="button" style="    width: 100%;
    background: #000000;
    border-color: #FFC300;
    color: #ffc300;
}" class="demo btn btn-danger mob"><i class="fa fa-sign-in"></i> SIGN IN</button>
                  <button onclick="verify()" type="button" style="width:100%;display:none;background: #FFC300 ;border-color: #FFC300;color:#000;" class="demo btn btn-danger otp"> Verify Otpcode</button>
                  
               </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
     <style>
  .auth .brand-logo img {
    width: 80px;
    text-align: center !important;
}
</style>

<script>
function sendotp(){
	var mobile = $('[name="mobile"]').val();
	
	if(mobile!='' && mobile.length>=10){
	$.ajax({
           url:'api/loginprocess.php',
           type: 'post',
           data: 'mobile='+mobile,
           success:function(result){
					//alert(JSON.stringify(result));
					if(result=='1'){
							swal({text: "Login Successfully!",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
  							window.location = 'dashboard.php';
							$('#showtime').css("display","none");	
							$('.otp').css("display","block");
							$('.mob').css("display","none");
							$('#profile').css("display","none");
							var timer2 = "1:01";
										var interval = setInterval(function() {
											var timer = timer2.split(':');
										  //by parsing integer, I avoid all extra string processing
										  var minutes = parseInt(timer[0], 10);
										  var seconds = parseInt(timer[1], 10);
										  --seconds;
										  minutes = (seconds < 0) ? --minutes : minutes;
										  seconds = (seconds < 0) ? 59 : seconds;
										  seconds = (seconds < 10) ? '0' + seconds : seconds;
										  //minutes = (minutes < 10) ?  minutes : minutes;
										  $('.countdown').html(minutes + ':' + seconds);
										  if (minutes < 0) clearInterval(interval);
										  
										  if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
										  timer2 = minutes + ':' + seconds;
										  if(timer2=='0:00'){
											  	timer2='';
												$('#showtime').css("display","block");	
										  }
										}, 1000);

					}
					else if(result=='0'){
							$('.otp').css("display","none");
							$('.mob').css("display","none");
							$('#id').val(mobile);
							$('#profile').css("display","block");
					}
					else{
							alert("Some Critical Problem");
							$('.otp').css("display","none");
							$('.mob').css("display","block");
							$('#profile').css("display","none");
					}
		   }
	})
	}else{
		swal({text: "Please Fill Mobile Number with 10 digit!",type:"warning",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
	}
}
function verify(){
	
	var mobile = $('[name="mobile"]').val();
	var otpcode = $('[name="otpcode"]').val();
	if(otpcode!=''){
	$.ajax({
           url:'api/verifyotp.php',
           type: 'post',
           data: 'mobile='+mobile+'&otpcode='+otpcode,
           success:function(result){
					//alert(JSON.stringify(result));
					if(result=='1'){
							$('.otp').css("display","none");
							$('.mob').css("display","none");
							$('#id').val(mobile);
							$('#profile').css("display","block");
					}
					else if(result=='2'){
								window.location = 'dashboard.php';
					}
					else{
							swal({text: "You Entered wrong otpcode!",type:"warning",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
							
					}
		   }
	})
	}else{
				swal({text: "Please Enter Otpcode",type:"warning",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
	}
}
$(document).ready(function () {    
    
            $('.numberonly').keypress(function (e) {    
    
                var charCode = (e.which) ? e.which : event.keyCode    
    
                if (String.fromCharCode(charCode).match(/[^0-9]/g))    
    
                    return false;                        
    
            });    
    
        });  
	</script>
	<style>
		label{
			text-align:left!important;
		}
	</style>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>  
  </body>
</html>