<!DOCTYPE html>
<html lang="en">
  <head>
            <div id="google_translate_element"></div>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            setCookie('googtrans', '/en/fr/', 1);
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'en,fr',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE
            }, 'google_translate_element');
        }
        function setCookie(key, value, expiry) {
            var expires = new Date();
            expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
            document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
        }
    </script>


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
  <body >
  <?php include('loader.php');?>
<video autoplay muted loop id="myVideo">
  <source src="video/taxi2.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" style="background:#fff!important;">
            
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto text-center">
              <div style="background: rgba(255, 255, 255, 0.13);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(4.7px);
-webkit-backdrop-filter: blur(4.7px);
border: 1px solid rgba(255, 255, 255, 0.3);" class="auth-form-light p-5" style="background:#fff!important;border:10px solid #fff;border-radius:10px;">
                 <a href="index.php"><button class="btn btn-danger"  style="width:50%;margin:15px 0px; position: absolute;
  top: 8px;
  left: 16px;"><i class="fa fa-home">Home</i></button></a>

               <button  onclick="history.back()" class="btn btn-danger"  style="width:50%;margin:15px 0px; position: absolute;
  top: 8px;
  right: 16px;"><i class="fa fa-arrow-left"></i>Back </button>
                <hr>
                                  <img src="https://afroom.com/assets/logot.png" height="105" width="125">
<hr style="background-color:#21a05d;">
                <h4  class="demo" style="text-transform:uppercase;color:#000;">Welcome To Intercity Ride</h4>
                
<hr style="background-color:#21a05d;">
                		<div class="row">
                            <div class="col-md-12 col-xs-12">
                            <a href="custlogin.php"><button class="btn btn-danger" style="width:100%;margin:15px 0px;"><i class="fa fa-sign-in"></i> CUSTOMER</button></a>
                       		
                            <a href="servicelogin.php"><button class="btn btn-danger" style="width:100%;margin:15px 0px;"><i class="fa fa-sign-in"></i> PROVIDER</button></a>
                            
                        	<a href="booking.php"><button style="width:100%;margin:15px 0px;" class="btn btn-danger"><i class="fa fa-ticket"></i> BOOKING</button></a>
              
   
 
                     	</div>  
                     </div>  
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
.btn-danger{
background:#21a05d !important;
	color:#000!important;
	border-color:#fff;
	font-weight:bold;
}
</style>


  </body>
</html>