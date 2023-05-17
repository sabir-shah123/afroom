<?php
include('api/db.php');
if(isset($_SESSION['mobile'])){
	
}else{
header('location:index.php');
}
if($_SESSION['logintype']=='Provider'){
$pros = mysqli_query($conn,"SELECT id,name as name,regas from providers where mobile='".$_SESSION['mobile']."'");
$p = mysqli_fetch_assoc($pros);
$_SESSION['unqid'] = $p['id']; 
$_SESSION['name'] = $p['name']; 
$_SESSION['regas'] =$p['regas'];
}else{
$cros = mysqli_query($conn,"SELECT id,personname as name,nationalid,natback from customer where mobile='".$_SESSION['mobile']."'");
$c = mysqli_fetch_assoc($cros);
$_SESSION['unqid'] = $c['id']; 
$_SESSION['name'] = $c['name']; 
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="myApp">
  <head>



    <!-- START: Template CSS-->
        <link rel="stylesheet" href="dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="dist/vendors/flags-icon/css/flag-icon.min.css">         
        <!-- END Template CSS-->

        <!-- START: Page CSS-->
        <link rel="stylesheet"  href="dist/vendors/chartjs/Chart.min.css">
        <!-- END: Page CSS-->

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="dist/vendors/morris/morris.css"> 
        <link rel="stylesheet" href="dist/vendors/weather-icons/css/pe-icon-set-weather.min.css"> 
        <link rel="stylesheet" href="dist/vendors/chartjs/Chart.min.css"> 
        <link rel="stylesheet" href="dist/vendors/starrr/starrr.css"> 
        <link rel="stylesheet" href="dist/vendors/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="dist/vendors/ionicons/css/ionicons.min.css"> 
        <link rel="stylesheet" href="dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.css">
        <!-- END: Page CSS-->
    

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="dist/css/main.css">
        <script src="easyNotify.js"></script>
        <!-- END: Custom CSS-->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $_SESSION['logintype'];?> |  Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/logo.png" />
    
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
	.sidebar .nav .nav-item.active > .nav-link i {
    color: #fe7c96;
	}
	.sidebar .nav .nav-item.active > .nav-link .menu-title {
    color: #fe7c96;
    font-family: "ubuntu-medium", sans-serif;
}
.sidebar .nav .nav-item .nav-link i.menu-icon {
    font-size: 1.125rem;
    line-height: 1;
    margin-left: auto;
    color: #fe7c96;
}

.sidebar .nav .nav-item.active > .nav-link .menu-title {
  color:  #FFC300 ;
  font-family: "ubuntu-medium", sans-serif;
}
html {
  --scrollbarBG:#f2f2f2;
  --thumbBG: #fe7c96 ;
}
body::-webkit-scrollbar {
  width: 11px;
}
body {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
  
}
body::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}
body::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG) ;
  border-radius: 6px;
  border: 3px solid var(--scrollbarBG);
}
.bg-gradient-danger {
  background: #fff !important;
  background: #fff!important;
  border-bottom:5px solid  #FFC300 ;
}

html {
  background: lightgrey;
  
}
body{
	overflow:auto;
	
}

.dropdown{
	position:absolute;
}
.dropdown .dropdown-menu {
  margin-top: .75rem;
  font-size: 0.875rem;
  -webkit-box-shadow: 0px!important;
  box-shadow: 0px!important;
}
.dropdown-menu.show {
  display: block;
  width: 200px;
}
.dropdown-menu[x-placement^="top"], .dropdown-menu[x-placement^="right"], .dropdown-menu[x-placement^="bottom"], .dropdown-menu[x-placement^="left"] {
  right: auto;
  bottom: auto;
}
.dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
   margin-top: 0.125rem;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #21a05d;
  border: 0px solid #ebedf2;
  border-radius: 0px;
}
.dropdown .dropdown-toggle::after {
  border-top: 0;
  border-right: 0;
  border-left: 0;
  border-bottom: 0;
  font: normal normal normal 24px/1 "Material Design Icons";
  font-size: 21px;
  content: "\f140";
  width: auto;
  height: auto;
  vertical-align: baseline;
  position:absolute;
  right:-139px; 
 
}
.content-wrapper{
	background:#ffc300;
}
@media only screen and (max-width: 800px) {
	.ar{
		display:none!important;
	}
}
</style>
 <?php
      		$docper = mysqli_query($conn,"Select * from documemtper");
      		$fetdoc = mysqli_fetch_assoc($docper);
      ?>
  </head>
  <body>
  <?php include('loader.php');?>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #FFC300 ;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
           	<span class="ar" style="color: #FFC300 ;font-weight:bold;">BOOKING PORTAL </span>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          	
          <?php   if($_SESSION['logintype']=='Customer'){ 
          		if($fetdoc['per']=='1'){
          		if($c['nationalid']!='' && $c['natback']!=''){ 
          ?>
          
          <?php }   else { ?>
          		<p style="color:#fff;padding:10px;">Please Upload Your Identity Document In the Profile</p>
          <?php } } } ?>
          <ul class="navbar-nav navbar-nav-right">
           
            <li class="nav-item dropdown see">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i style="color:#000;font-size:bold;" class="mdi mdi-bell-outline"></i>
               <span style="color:#000;" id="totalNoti"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
              	<?php 
                  		if($_SESSION['logintype']!='Customer') { 	
                    ?>
                    	    	<span id="pronoti"></span>
                    <?php }  else { 
                    		
                    ?>
	                    <span id="custnoti"></span>	
                    <?php }?> <div class="dropdown-divider"></div>
              
                </a>
                <a style="text-decoration:none;padding:5px;" href="notification.php"> view all notifications</a>
              </div>
            </li>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                 <span style="padding:0px 10px;color:#000;"><b><?php echo $_SESSION['name'];?></b></span>
                <div class="nav-profile-img">
                
                  <img src="assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                
              </a>
              <div class="dropdown-menu navbar-dropdown" style="background-color:#FFF!important;" aria-labelledby="profileDropdown">
                <a style="color:#000;" class="dropdown-item" href="profile">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Profile </a>
                <a style="color:#000;" class="dropdown-item" href="logout.php">
                  <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            
          </ul>
         
        </div>
      </nav>
     
      
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
         <?php
          	if($_SESSION['logintype']=='Customer'){ 
          	if($fetdoc['per']=='1'){?>
          		<?php if($c['nationalid']!='' && $c['natback']!=''){ ?>
          			<ul class="nav" > 
          		<?php } else { ?>
          			<ul class="nav" style="pointer-events: none;">
          		<?php } ?>
          		
          	<?php } else { ?>
          		<ul class="nav"> 
          	<?php } ?>
           <?php }  else { ?>
           <ul class="nav"> 
           <?php } ?>
         <li style="background-color:#fff;" class="nav-item">
              <a  class="nav-link" href="dashboard">
                <span  class="menu-title demo">Dashboard</span>
                <!--<i class="mdi mdi-view-dashboard"></i>-->
                <i style="color: #FFC300 ;" class="mdi mdi-view-dashboard menu-icon"></i>
              </a>
            </li>
            
			 <li style="background-color:#fff;"  class="nav-item">
              <a class="nav-link" href="wallet">
                <span class="menu-title demo">Wallet Balance</span>
                <i style="color: #FFC300 ;" class="mdi mdi-wallet menu-icon"></i>
              </a>
            </li>
            <!--<li style="background-color:#fff;" class="nav-item">
              <a  class="nav-link" href="profile">
                <span class="menu-title demo">Profile</span>
                <i style="color: #FFC300 ;" class="mdi mdi-account menu-icon"></i>
              </a>
            </li>-->
            <?php if($_SESSION['logintype']=='Customer') { ?>
             <li style="background-color:#fff;" class="nav-item">
              <a class="nav-link" href="running">
                <span class="menu-title demo">Running Rides</span>
                <i style="color: #FFC300 ;" class="mdi mdi-ticket menu-icon"></i>
              </a>
            </li>
            <?php } ?>
            
              <li style="background-color:#fff;" class="nav-item">
              <a class="nav-link" href="customer">
                <span class="menu-title demo"><?php if($_SESSION['logintype']=='Customer'){echo "Requested Bookings";}else{echo "Pending Bookings";}?> </span>
                <i style="color: #FFC300 ;" class="mdi mdi-information-outline menu-icon"></i>
              </a>
            </li>
           
            <li style="background-color:#fff;" class="nav-item">
              <a class="nav-link" href="oldbooking">
                <span class="menu-title demo">Expired Bookings</span>
                <i style="color: #FFC300 ;" class="mdi mdi-pin-off menu-icon"></i>
              </a>
            </li>
            
            
            <li style="background-color:#fff;" class="nav-item">
              <a  class="nav-link" href="completebooking">
                <span class="menu-title demo">Completed Bookings</span>
                <i style="color: #FFC300 ;" class="mdi mdi-bookmark-check menu-icon"></i>
              </a>
            </li>
            
             <li style="background-color:#fff;" class="nav-item">
              <a class="nav-link" href="refundhistory.php">
                <span class="menu-title demo">Refund History</span>
                <i style="color: #FFC300 ;" class="mdi mdi-account-heart menu-icon"></i>
              </a>
            </li>
         <li  class="nav-item">
              <a class="nav-link" href="bookinghistory">
                <span class="mdi menu-title demo">Booking History </span>
                    <i style="color: #FFC300 ;" class="mdi mdi-wifi menu-icon"  menu-icon></i>
              </a>
            </li>
          <!---  <li class="nav-item">
              <a class="nav-link" href="completebooking">
                <span class="menu-title demo">View Tickets</span>
                <i class="mdi mdi-bookmark-check menu-icon"></i>
              </a>
            </li>
            <li style="background-color:#fff;"  class="nav-item">
              <a class="nav-link" href="completebooking">
                <span class="menu-title demo">Payment Logs </span>
                <i style="color: #FFC300 ;" class="mdi mdi-wifi menu-icon"  menu-icon></i>
              </a>
            </li>-->
          
             <!--<li style="background-color:#fff;" class="nav-item">
              <a  class="nav-link" href="logout.php">
                <span class="menu-title demo">Signout</span>
                <i style="color: #FFC300 ;" class="mdi mdi-bookmark-check menu-icon"></i>
              </a>
            </li>-->
			 
          </ul>
        </nav>
        <style>
          @media (min-width: 992px){
.navbar .navbar-menu-wrapper .navbar-nav.navbar-nav-right {
  margin-left: auto;
  margin-right: 86px!important;
}
.see{
	right:190px!important;
	}
	.navbar .navbar-menu-wrapper .navbar-nav .nav-item.dropdown .dropdown-menu.navbar-dropdown {
		width:250px!important;
	}
}

</style>
<?php
if($_SESSION['logintype']!='Customer') { 
$cou21 = mysqli_query($conn,"SELECT  count(id) as id from noti where status=0 and pro='".$_SESSION['unqid']."' and type='PROVIDER' and numb=0");
}else{
$cou21 = mysqli_query($conn,"SELECT count(id) as id from noti where status=0 and cust='".$_SESSION['unqid']."' and type='CUSTOMER' and numb=0");	

}
$notis = mysqli_fetch_assoc($cou21);
?>

<script>
$(document).ready(function(){
var sestype = '<?php echo $_SESSION['logintype'];?>';
if(sestype!='Customer'){
var notis = '<?php echo $notis['id'];?>';
}else{
var notis1 = '<?php echo $notis['id'];?>';
}
setInterval(function () {
	$.post("getNoti.php",{"id":"1"}, function (response) {
			
			var res = jQuery.parseJSON(response);
			$('#totalNoti').html(res.total);
			
			$('#pronoti').html('');
					if(sestype!='Customer'){
							if(res.total == notis){
							
							}else{
								document.getElementById('mySound1').play();
								
									window.location.reload();
								
							}
					}else{
							if(res.total == notis1){
							
							}else{
								document.getElementById('mySound1').play();
								
								window.location.reload();
								
							}
					}
			$(res.data).each(function(index,item ) {
					
					$('#pronoti').append('<a style=text-decoration:none; href=noti.php?id='+item.id+'><p style=padding:7px; class=ellipsis> '+item.message+' </p></a><div class=dropdown-divider></div>');
					
					
			})
			$('#custnoti').html('');
			var counts1 = 0;
			$(res.data).each(function(index,item ) {
					
					$('#custnoti').append('<a style=text-decoration:none; href=noti.php?id='+item.id+'><p style=padding:7px; class=ellipsis>'+item.message+'</p></a><div class="dropdown-divider"></div>');
						
					
			})
			
	})
 },2000);
})
</script>
  
<audio id="mySound1" src="sound.mp3"></audio>