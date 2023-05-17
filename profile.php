<?php include('header.php');?>
		<div  class="main-panel" style="display:none;" ng-app="myApp" data-ng-controller="myCtrl">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title">Profile  </h4>
                    <div class="row">
                          <div class="col-md-12">
                          		<form  action="api/updateprofile.php" method="post" enctype="multipart/form-data">
								<?php
									if($_SESSION['logintype']=='Customer'){
										$query = mysqli_query($conn,"Select * from customer where id='".$_SESSION['unqid']."'");
										$bal = mysqli_fetch_assoc($query);
									
									?>
                                  <label>Name</label>
                                  <input type="text" class="form-control" name="name" value="<?php echo $bal['personname'];?>">
                                  <label>Mobile</label>
                                  <input type="text" class="form-control" name="mobile" value="<?php echo $bal['mobile'];?>">
                                  <label>Front Upload</label>
                                  <input type="file" class="form-control" name="front">
                                  <?php if($bal['nationalid']!='') { ?>
                                  <img src="api/<?php echo $bal['nationalid'];?>" width="40">
                                  <?php } ?>
                                  <label>Back Upload</label>
                                  <input type="file" class="form-control" name="back">
                                  <?php if($bal['natback']!='') { ?>
                                  <img src="api/<?php echo $bal['natback'];?>" width="40">
                                  <?php } ?>
                                  <input type="hidden" name="tt" value="Cust">
                                  <input type="hidden" name="id" value="<?php echo $bal['id'];?>">
								  <?php  
									}else{
										$query = mysqli_query($conn,"Select * from providers where id='".$_SESSION['unqid']."'");
										$bal = mysqli_fetch_assoc($query);
									?>
                                <label>Name</label>
                                  <input type="text" class="form-control" name="name" value="<?php echo $bal['name'];?>">
                                  <label>Mobile</label>
                                  <input type="text" class="form-control" name="mobile" value="<?php echo $bal['mobile'];?>">
                            	  <input type="hidden" name="tt" value="Pro">	
                                  <input type="hidden" name="id" value="<?php echo $bal['id'];?>">
                                  
								<?php } ?>
                                <br>
                                <input type="text" maxlength="4" class="form-control otp" name="otpcode">
                                <button type="button" ng-click="sendotp()" class="btn btn-success mob">Update</button>
                                <button type="button" ng-click="verify()" class="btn btn-danger otp">Verify otpcode</button>
                                <button style="display:none;" id="form32" type="submit"></button>
                                </form>
                            </div>
                		</div>
              	</div>
            </div>
        </div>
        </div>
        </div>
        </div>
   </div>                  
 </div>       
            
<style>
.btn {
  
  padding: 0.678rem 1.5rem;
}
</style>
<!-- content-wrapper ends -->
 <?php include('footer.php');?>        
    <!-- End custom js for this page -->
    <style>
	.ui-widget-header {
  border: 1px solid #fff;
  background: #fff;
  color: #333333;
  font-weight: bold;
}
.table-striped tbody tr:nth-of-type(2n+1) {
  background-color: #fff;
}
th{
text-align:center;
}
td{
border:1px solid #f2f2f2;
text-align:center;

}
	</style>
    
<style>
td{
	padding:10px;
}
label{
	padding-top:5px;
	padding-bottom:5px;
}
.navbar .navbar-menu-wrapper .navbar-toggler
color:#fff;
}
.navbar{
	background:#FF4500!important;
	color:#fff;
}
table.dataTable thead th div.DataTables_sort_wrapper span {
  position: absolute;
  top: 50%;
  margin-top: -8px;
  right: -18px;
  display: none;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
	//alert("hi");
$('.main-panel').css("display","block");	
$('.otp').css("display","none");	
$scope.sendotp = function(){
var mobile = $('[name="mobile"]').val();
	//alert(mobile);
	if(mobile!='' && mobile.length>=10){
	$.ajax({
           url:'api/custloginprocess.php',
           type: 'post',
           data: 'mobile='+mobile,
           success:function(result){
					//alert(JSON.stringify(result));
					if(result=='1'){
							swal({text: "Otpcode Sent to Your Mobile Number!",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
							$('.otp').css("display","block");
							$('.mob').css("display","none");
					}else{
							alert("Some Critical Problem");
							$('.otp').css("display","none");
							$('.mob').css("display","block");
							
					}
		   }
	})
	}else{
		swal({text: "Please Fill Mobile Number with 10 digit!",type:"warning",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
	}
}
$scope.verify = function(){
	var mobile = $('[name="mobile"]').val();
	var otpcode = $('[name="otpcode"]').val();
	if(otpcode!=''){
	$.ajax({
           url:'api/updateverifyotp.php',
           type: 'post',
           data: 'mobile='+mobile+'&otpcode='+otpcode,
           success:function(result){
					//alert(JSON.stringify(result));
					if(result=='1'){
								swal({text: "Otpcode verified!",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
								$('#form32').trigger("click");
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
});
</script>
 