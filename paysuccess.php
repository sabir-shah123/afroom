<?php
include('api/db.php');
$query = mysqli_query($conn,"UPDATE providerpay set paymentstatus=1,paymode='ONLINE' where orderid='".$_GET['trx_id']."'");
$getPay = mysqli_query($conn,"Select f.amount,c.mobile,f.providerid,c.id as cid from providerpay as f 
inner join booking as b on b.id=f.bookingid
inner join customer as c on b.custid=c.id
where f.orderid='".$_GET['trx_id']."'");
$fetchPay = mysqli_fetch_assoc($getPay);
$check = mysqli_query($conn,"Select wallet from providers where id='".$fetchPay['providerid']."'");
$fetchbal = mysqli_fetch_assoc($check);
if($fetchbal['wallet']>0 && $fetchPay['amount']<=$fetchbal['wallet']){
		$bal = $fetchbal['wallet'] - $fetchPay['amount'];
		mysqli_query($conn,"UPDATE providers set wallet='".$bal."' where id='".$fetchPay['providerid']."'");
}else{
		$bal =  $fetchPay['amount']-$fetchbal['wallet'];
		mysqli_query($conn,"UPDATE providers set wallet='0' where id='".$fetchPay['providerid']."'");
}

$message  = "Driver has paid for your booking";
mysqli_query($conn,"INSERT into noti Values(0,'".$message."','0','".$fetchPay['cid']."','CUSTOMER',now(),'0','0')");

$pre = mysqli_query($conn,"Select * from prefixs order by id desc limit 1");
$fetch = mysqli_fetch_assoc($pre);


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
	</style>
      </head>
  <body >
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth" style="background:#f2f2f2!important;">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto text-center">
              <div class="auth-form-light p-5">
              			<h2 align="center" style="color:green;">$<?php echo $fetchPay['amount'];?> Amount</h2>
                 		<img src="payment.png" width="340">   
                  
                              </div>
                              <br>
                              <a href="https://afroom.aliensera.in/customer"><button class="btn btn-warning">Go to Dashboard</button></a>
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
  </body>
</html>