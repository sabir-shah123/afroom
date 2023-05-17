<?php
  include('api/db.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Booking Portal | Panel</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/logo.png" />
    <link rel="stylesheet" href="fonts.css" type="text/css" charset="utf-8" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>-->

    <style>
	.demo
	{
		font-family:'Conv_Comfortaa-VariableFont_wght',Sans-Serif!important;
	}
	body{
		font-family:'Conv_Comfortaa-VariableFont_wght',Sans-Serif!important;
	}
	
	.paypal-powered-by{
	    display:none !important;
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
        .btn-danger{
        
background:#21a05d !important;
    border-color: #000000 !important;
    color: #000000!important;
   
}
</style>
      </head>
  <body >
  

  <?php include('loader.php');?>
<video autoplay muted loop id="myVideo">
  <source src="video/taxi2.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
  <?php include('loader.php');?>
    <div class="container-scroller" >
      <div class="container-fluid page-body-wrapper full-page-wrapper" >
        <div class="content-wrapper d-flex align-items-center auth" class="row flex-grow" >
            
            <div class="col-lg-8 mx-auto text-center" >
              <div class="auth-form p-5" style="background: rgba(255, 255, 255, 0.13);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgb(0 0 0 / 10%);
    backdrop-filter: blur(4.7px) !important;" >
            	<div class="col-md-12" >
                  
                <span style="color:green;margin:10px 0px;float:right; font-size: 18px !important;">TOTAL AMOUNT : <span id="amount">0</span></span> 
               <?php
			   		$payamt = mysqli_query($conn,"Select * from bookamt order by id desc limit 1");
					$fetchp = mysqli_fetch_assoc($payamt);
			   ?>
                <p style="color: #000000; font-size: 22px !important;">You need to pay cfa <?php echo $fetchp['amt'];?> for confirm the booking per seat</p>
                
             <div id="paypal-button-container"></div>
             <!--<button class="btn btn-primary btn-orange-pay" hidden>Orange Senegal</button>-->
             <!--<div id="orange-senegal-pay" hidden>-->
             <!--    <div class="msg">Please scan the below qr code using Orange Money App in order to pay the amount</div>-->
             <!--    <div class="qrcode1"></div>-->
                 

             <!--</div>-->
             
             <div class="row my-2 paywithorange" style="display:none">
                 <div class="col-md-12">
                     <input type="button" class="btn btn-info form-control" value="Pay with Orange Pay" />
                 </div>
             </div>
             
             <div class="orange-pay-container" style="display:none">
                <?php include('orangepay.php');?> 
             </div>
             
 <script src="https://www.paypal.com/sdk/js?client-id=AbHg1QPV4ppfl7XQbHTxd_t5W4Gdi6pD524Wtel3gsUysImtLj1lOi2hD77OGDzSuobM3x8FWTlaVVBn&currency=USD"></script>
                </div>
             <div class="row">
             		<div class="col-md-12">
             			<div class="form-group">
             				<label>Booking Type</label>
             				<select onchange="getPlace()" class="form-control" name="btype">
             					<option value="0">Select Booking Type</option>
             					<option>Ride Booking</option>
             					<option>Plumber</option>
             					<option>Fibre Optic Engineer</option>
             				</select>
             				
             			</div>
             		</div>
                  <div class="col-md-4">
                 <div class="form-group">
                
                <select name="dest" class="form-control" style="border:1px solid #000000;">
                <option>Pick your destination</option>
                <option value="allo dakar to touba">Dakar to Touba</option>
                <option value="allo dakar to touba">Touba  to  Dakar</option>
                </select>
                </div>
                </div>
                
                  <div class="col-md-4">
                      <div class="form-group">
                      	<?php if(isset($_SESSION['logintype']) && $_SESSION['logintype']=='Customer'){ 
                      		$cust = mysqli_query($conn,"Select * from customer whete mobile='".$_SESSION['mobile']."'");
                      		$fetch = mysqli_fetch_assoc($cust);
                      		$name = $fetch['personname'];
                      		$nat = $fetch['nationalid'];
                      	}else{
                      		$name = "";
                      		$nat = "";
                      	}?>
                      	
                        <input type="text" value="<?php echo $name;?>" class="form-control form-control-lg" required name="person"  placeholder="Person Name">
                      </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                  <?php
				
                  	$pre = mysqli_query($conn,"Select * from prefixs order by id desc limit 1");
					$fetch = mysqli_fetch_assoc($pre);
				  ?>
                    	<input id="mo" type="text" class="form-control form-control-lg" required name="mobile" value="<?php if(isset($_SESSION['logintype']) && $_SESSION['logintype']=='Customer'){echo $_SESSION['mobile'];}else{ echo $fetch['prefix'];}?>" <?php if(isset($_SESSION['logintype']) && $_SESSION['logintype']=='Customer'){echo "readonly";}else{ echo "";}?> placeholder="Mobile">
                        <input id="mo1" onKeyUp="checkOtp()" type="text" class="form-control form-control-lg"  name="otpcode" maxlength="4" style="display:none;"  placeholder="Otpcode">
                        <?php
							if(isset($_SESSION['logintype']) && $_SESSION['logintype']=='Customer'){
								
							}else{
						?>
                  	<!--<span id="mo2" style="font-size:12px;color:#000000;font-weight:bold;float:left;padding:10px 0px;" onclick="verifyMob()">Verfiy Mobile</span>-->
                        <?php } ?>
                        </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" required name="zone" placeholder="Zone">
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" required name="place" placeholder="Place">
                  </div>
                  </div>
				  <audio id="mySound" src="sound.mp3"></audio>
                  <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" required onblur="checkPrice()" name="seat" placeholder="Seats">
                    <input type="hidden" name="amount" value="">
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <input type="time" class="form-control form-control-lg" required name="time" placeholder="Time">
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <input type="date" class="form-control form-control-lg" required name="date" placeholder="Date">
                  </div>
                  </div>
                  <div class="col-md-4">
                  <div class="form-group">
                    <select class="form-control form-control-lg" required name="type" style="border:1px solid #000000;">
                    		<option>Select Type</option>
                            <option value="Refundable">Refundable</option>
                            <option value="Non-Refundable">Non-Refundable</option>
                    </select>
                  </div>
                  </div>
                 
                  </div>
                  <input type="hidden" value="<?php echo rand('1000','9999');?>" name="orderid">
                  
                  <button  onclick="savebooking()" type="button" style="width:100%;margin-top:5px;background: #FFC300; border:1.5px solid #000000 !important;border:none;opacity:0px;color:#000;" class="demo btn btn-danger"><i class="fa fa-sign-in"></i> SAVE</button>
                <br>
                <a href="index.php"><button class="btn btn-danger"  style="width:50%;margin:15px 0px;top: 8px;left: 16px;"><i class="fa fa-home"> Home</i></button></a><button  onclick="history.back()" class="btn btn-danger"  style="width:50%;margin:15px 0px;top: 8px;right: 16px;"><i class="fa fa-arrow-left"></i> Back </button>
                  <input type="hidden" name="pay">
                  
                              </div>
              <audio id="mySound" src="sound.mp3"></audio>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    
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
<script src="easyNotify.js"></script>
<script>
function getPlace(){
	var btype = $('[name="btype"]').val();
	if(btype=='Ride Booking'){
		$('[name="seat"]').attr("placeholder", "No of Seat").val("");
	}else if(btype=='Plumber'){
		$('[name="seat"]').attr("placeholder", 'No of Plumber').val("");
		
	}
	else if(btype=='0'){
		$('[name="seat"]').attr("placeholder", 'No of Seat').val("");
	}
	 else{
		$('[name="seat"]').attr("placeholder", 'No of Engineer').val("");
	}
	
	$.ajax({url:'api/getpriceofbook.php', type: 'post',data: 'btype='+btype,success:function(result){
			   		$('[name="pay"]').val(result);
				}
	})			
}

$(document).ready(function(){
	<?php if(isset($_SESSION['logintype']) && $_SESSION['logintype']=='Customer'){?>
	$('#ot').prop("disabled",false);
	<?php } else { ?>
	$('#ot').prop("disabled",true);
	<?php } ?>
	
	 $('body').on('click', '.paywithorange', function(){
        $('.orange-pay-container').toggle();
    })
})
function verifyMob(){
	var mobile = $('[name="mobile"]').val();
	$.ajax({
			   url:'api/custloginprocess.php',
			   type: 'post',
			   data: 'mobile='+mobile,
			   success:function(result){
			   		swal({text: "Otpcode Sent to Your Mobile",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
					$('#mo').css("display","none");
					$('#mo1').css("display","block");
			   }
	})
}

$('body').on('click','#orangesubmit',init_orange_pay);
// let waitfororangepayment=null;
// function check_payment_status_orange(){
//     $.ajax({
// 			   url:'orange/orange.php',
// 			   type: 'post',
// 			   data: 'type=cust&order_id='+ssid+"&status=check",
// 			   success:function(result){
			   	    
// 			   	    if(result==1){
// 			   	        clearInterval(waitfororangepayment);
// 			   	        location.href = '';
// 			   	    }
					
					
// 			   }
// 	})
// }

function init_orange_pay(){
    let o_phone = $('#o_phone').val();
    let o_otp = $('#o_otp').val();
     $('#orangesubmit').hide();
    $.ajax({
			   url:'orange/orange.php',
			   type: 'post', 
			   data: 'type=cust&order_id='+ssid+'&o_otp='+o_otp+'&o_phone='+o_phone,
			   success:function(result){
                    
                   handleresult(result);
                }


	})
}
function checkOtp(){
		var mobile = $('[name="mobile"]').val();
		var otpcode = $('[name="otpcode"]').val();
		if(otpcode.length >=4){
		$.ajax({
			   url:'api/checkotp.php',
			   type: 'post',
			   data: 'otpcode='+otpcode+'&mobile='+mobile,
			   success:function(result){
				   //alert(JSON.stringify(result));
				   if(result=='1'){
			   		swal({text: "Otpcode Verified",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
						$('#ot').prop("disabled",false);
						$('#mo1').css("display","none");
					    $('#mo').css("display","block");
						$('#mo2').css("display","none");
				   }else{
					   swal({text: "Otpcode is not match",type:"danger",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
						$('#ot').prop("disabled",true);
				   }
			   }
	})
		}
}
let ssid = null;
function savebooking(){
	var person = $('[name="person"]').val();
	var mobile = $('[name="mobile"]').val();
	var zone = $('[name="zone"]').val();
	var place = $('[name="place"]').val();
	var time = $('[name="time"]').val();
	var date = $('[name="date"]').val();
	var seat = $('[name="seat"]').val();
	var amt = $('[name="amount"]').val();
	var type = $('[name="type"]').val();
	var btype = $('[name="btype"]').val();
	var orderid = $('[name="orderid"]').val();
	var dest = $('[name="dest"]').val();
	if(person!='' && mobile!='' && btype!='0'){
		$.ajax({
			   url:'api/bookingsave.php',
			   type: 'post',
			   data: 'mobile='+mobile+'&person='+person+'&zone='+zone+'&place='+place+'&time='+time+'&date='+date+'&seat='+seat+'&amount='+amt+'&type='+type+'&orderid='+orderid+'&dest='+dest+'&btype='+btype,
			   success:function(result){
							//alert(JSON.stringify(result));
							result = JSON.parse(result); 
							if(result.pay >0){
							    $('.paywithorange').show();
							    ssid = result.last_cust_id;
							$('#amount').html(result.pay);
							$('[name="amount"]').val(result.pay);	
							swal({text: "Booking Done Successfully & you need to pay "+result.pay,type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
			paypal.Buttons({
						
						// Set up the transaction
						createOrder: function(data, actions) {
							var total = result.pay;
							var orderid = orderid;//result.last_cust_id
							return actions.order.create({
								purchase_units: [{
										amount: {
											 value: total
										}
								}]
							});
						},
						// Finalize the transaction
						onApprove: function(data, actions) {
							return actions.order.capture().then(function(details) {
								window.location ='booksuccess.php?trx_id='+orderid;	
								alert('Transaction completed by ' + details.payer.name.given_name + '!');
							});
						}
					}).render('#paypal-button-container');	
							}
							else if(result=='error'){
								swal({text: "Some Critical Problem!",type:"warning",showCancelButton:false,confirmButtonClass: "btn-warning",
  			closeOnConfirm: false});
							}
							else{
								swal({text: "Booking Saved Successfully ",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
  							
  							window.location= 'running.php';
							
				}
				$('[name="person"]').val('');
	 			$('[name="mobile"]').val('');
	            		$('[name="zone"]').val('');
				$('[name="place"]').val('');
				$('[name="time"]').val('');
				$('[name="date"]').val('');
				$('[name="seat"]').val('');
				$('[name="amount"]').val('');
				$('[name="type"]').val('');
				$('[name="orderid"]').val('');
			}
		})
	}else{
			swal({text: "Please Fill Required Fields",type:"warning",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
	}
}

	 </script>
	 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>  
<script>
function checkPrice(){
	var p = $('[name="pay"]').val();
	//alert(p);
	var seat = $('[name="seat"]').val();
	if(seat=='' || seat==0){
		$('#amount').html(0);
	}else{
		$('#amount').html(seat*p);
		$('[name="amount"]').val(seat*p);
	}
}
</script>
<style>
span{
	cursor:pointer;
}
.form-control{
      border: none;
    border: 1px solid #000000;
    border-radius: 5px;
    outline: 0px solid #ebedf2!important;
}
select.form-control {{
border:none;
border-bottom:2px solid #f2f2f2;
border-radius:5px;
}

</style>


<script>
$(document).ready(function() {
   
});

</script>

  </body>
</html>