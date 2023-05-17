<?php include('header.php');?>
		<div style="display:none;" class="main-panel" data-ng-controller="myCtrl">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <?php if($_SESSION['logintype']=='Customer') { ?>
                    <h4 class="card-title">Requested Booking List  </h4>
                    <?php } else { ?>
                    <h4 class="card-title">Pending Booking List  </h4>
                    <u style="color:#F90;">(Note : you need to pay according to number of booking per person)</u>
                    <?php } ?>
                    <div class="row">
                          <div class="col-md-12">
                          <div id="paypal-button-container" ></div>
                          <!--orange pay-->
                            <div class="row my-2 paywithorange" style="display:none">
                             <div class="col-md-8">
                                 <input type="button" class="btn btn-info form-control" value="Pay with Orange Pay" />
                             </div>
                            </div>
             
                             <div class="orange-pay-container" style="display:none">
                                <?php include('orangepay.php');?> 
                                
                                <button ng-click="payWithOrange()" id="aorangepaybutton" class="btn btn-primary form-control" value="Pay now" >Pay Now</button>
                             </div>
                          <!--orange pay end-->
                            <script src="https://www.paypal.com/sdk/js?client-id=AbHg1QPV4ppfl7XQbHTxd_t5W4Gdi6pD524Wtel3gsUysImtLj1lOi2hD77OGDzSuobM3x8FWTlaVVBn&currency=USD"></script>
                                 <div class="table-responsive">
                                    <table id="example" class="gkg" width="100%">
                                      <thead>
                                        <tr>
                                          <?php
										  	if($_SESSION['logintype']=='Provider'){
										  ?>
                                          <th   align="center">Choose </th>
                                          <?php } else {  ?>
                                          <th   align="center">Action </th>
                                          <?php } ?>
                                          <th >Name</th>
                                          <th >Mobile</th>
                                          <th>Type</th>
                                          <th>Destination</th>
                                          <th >Zone</th>
                                          <th >Place </th>
                                          <th >Time </th>
                                          <th >Date </th>
                                          <th>Seats </th>
                                          
                                         
                                        </tr>
                                      </thead>
                                      <tbody>
                                      	<tr  ng-repeat="x in bookList"<?php
										  	if($_SESSION['logintype']=='Customer'){?>
											 ng-if="x.show>0 && x.providername!=''" <?php }else {"";}?> >
                                        	<?php
										  	if($_SESSION['logintype']=='Provider'){
										  ?>
                                            <td ng-click="updateCustomerListFlag($index,[[x.mobile]],[[x.seat]])" class="table-text">
                                        	<span ng-if="x.show==0"><i style="color:#000!important;" class="fa fa-square-o icon" ng-show="x.flag==false" aria-hidden="true"></i><i style="color:#000!important;" class="fa fa-check-square-o icon" ng-show="x.flag==true" aria-hidden="true"></i></span> <span style="color:red;font-weight:bold;" ng-if="x.show!=0">Request Send</span></td>
                                            <td><span ng-if="x.show>0 && x.cstatus==1">{{x.personname}}</span></td>
                                            <td><span ng-if="x.show>0 && x.cstatus==1">{{x.mobile}}</span></td>
                                             <?php } else { ?>
                                             <td><button ng-if="x.cstatus==0" ng-click="statusV([[x.id]])" class="btn btn-success">Accept</button>
                                             <button ng-if="x.cstatus==1" class="btn btn-warning">Accepted</button></td>
                                             <td></td>
                                             <td></td>
                                             <?php } ?>
                                            <td>{{x.btype}}</td>
                                            <td>{{x.desti}}</td>
                                            <td>{{x.zone}}</td>
                                            <td>{{x.place}}</td>
                                            <td>{{x.time}}</td>
                                            <td>{{x.date}}</td>
                                            <td>{{x.seat}}</td>
                                          
                                         </tr>
                                     
            						</tbody>
                                 </table>   		  
                                </div> 
                                <?php
									if($_SESSION['logintype']=='Customer'){
										
									}else{
								?>
                                <input type="hidden" ng-init="orderid='<?php echo rand('1000','9999');?>'" ng-model="orderid">
                                <input type="hidden" ng-model="providerid" ng-init='providerid=<?php echo $_SESSION['unqid'];?>'>
                                <span>TOTAL PAID AMOUNT : <span style="color:green;" ng-bind="amount"></span></span><br>
                                <button ng-click="getPayment()" class="btn btn-warning">Pay</button>
                  				<?php } ?>
                            </div>
                		</div>
						 <audio id="mySound" src="sound.mp3"></audio>
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
          <!-- partial:partials/_footer.html -->
          <footer class="footer">
            <div class="container-fluid clearfix text-center">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">All Rights Reserved & Copyright © By Afroon</span>
             
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
     <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>  
<link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.12/r-2.1.0/se-1.2.0/datatables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/v/dt/dt-1.10.12/r-2.1.0/se-1.2.0/datatables.min.js"></script>
    <script>
	$(document).ready(function() {
   var table = $('#example').DataTable({
      
      'responsive': {
         'details': {
            'type': 'column',
            'target': 0
         }
      },
      'select': {
         'style': 'multi',
         'selector': 'td:not(.control)'
      },
      'order': [[1, 'asc']]
   });
   
   
   //pay with orange
    $('body').on('click', '.paywithorange', function(){
        $('.orange-pay-container').toggle();
    });
   
});
	</script>
    <script src="assets/js/todolist.js"></script>
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
	border:none;
	border-bottom:1px solid #d2d2d2;
	text-align:center;
	padding:15px!important;

}
th{
	pointer-events: none;
}
@media only screen and (max-width: 800px) {
	table {
                border-collapse: collapse;
            }
	.gkg{
	            border-collapse:separate!important;
                border-spacing:0 15px!important;
				
	}
  td, th {
   text-align: left!important;
   display: block;
   float: left;
  width: 100%; 
  border:1px solid #f2f2f2;
}

thead {
  display: none;
}
    }

	</style>
    
<style>
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
#example_info{
	display:none;	
}

</style>
<?php
$payamt = mysqli_query($conn,"Select * from bookamt order by id asc limit 1");
$fetamt = mysqli_fetch_assoc($payamt);

?>

<script src="easyNotify.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
$('.main-panel').css("display","block");

$scope.amount = 0;
  	$scope.selectAllFlag = false;
	$scope.bookingList = function(){
		$scope.bookList = [];
		$http.post("api/getDataToday.php",1).then(function(response) {
			//alert(JSON.stringify(response));
			angular.forEach(response.data,function (obj, index) {
				$scope.bookList.push({"flag":false,"id":obj.id,"personname":obj.personname,"mobile":obj.mobile,"zone":obj.zone,"place":obj.place,"time":obj.time,"date":obj.date,"seat":obj.seat,"created_at":obj.created_at,"show":obj.show,"providername":obj.providername,"providermobile":obj.providermobile,"cstatus":obj.cstatus,"desti":obj.desti,"btype":obj.btype});
			})
		})
	//alert(JSON.stringify($scope.bookList));
		
	}
	$scope.bookingList();
	$scope.updateCustomerListFlag = function(index,custid,seat) {
		if($scope.bookList[index].flag) {
			$scope.bookList[index].flag = false;
			$scope.amount = $scope.amount-(seat*<?php echo $fetamt['pamt'];?>); 
			
		}
		else {
			$scope.bookList[index].flag = true;
			$scope.amount = 0;
			angular.forEach($scope.bookList, function(value,index) {
				$scope.amount1 = 0;
				if(value.flag==true){
					$scope.amount1 = parseFloat(value.seat*<?php echo $fetamt['pamt'];?>);
					//alert($scope.amount1);
					$scope.amount = parseInt($scope.amount)+parseInt($scope.amount1); 
				}
			})	
			
		}
		checkSTBListAllFlags();
	
	}
	function checkSTBListAllFlags() {
		var flag = true;
		angular.forEach($scope.bookList, function(value,index) {
			if(!value.flag) {
				flag = false;
				return false;
			}
		});
		$scope.selectAllFlag = flag;
	}
	$scope.updateCustomerSelectAllFlag = function() {
		if($scope.selectAllFlag) {
			$scope.selectAllFlag = false;
		}
		else {
			$scope.selectAllFlag = true;
			
		}
		
		angular.forEach($scope.bookList, function(value,index) {
			$scope.bookList[index].flag = $scope.selectAllFlag;
		});
	}
	$scope.selectAllFlag = false;
	
	$scope.payWithOrange= function(){
	    
	    let o_phone = $('#o_phone').val();
    let o_otp = $('#o_otp').val();
    $('#aorangepaybutton').hide();
    $http.post("orange/orange.php",{"providerid":$scope.providerid,"amount":$scope.amount,"order_id":$scope.orderid,"type":"prov","o_otp":o_otp,"o_phone":o_phone}).then(function(result) {
        handleresult(result.data);
       
        
    });
			
   
	    
	}
	
	$scope.getPayment = function(){
			
			$('.paywithorange').show();
			$('#orangesubmit').hide();
			//alert($scope.amount);
			//alert($scope.providerid);
			$http.post("api/payment.php",{"bookdata":$scope.bookList,"providerid":$scope.providerid,"amount":$scope.amount,"orderid":$scope.orderid}).then(function(response) {
						//alert(JSON.stringify(response));
						//window.open(response.data, '_blank');

						if(response.data!=0){
						swal({text: "Process with Your Payment",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
						$scope.amount = response.data;
						paypal.Buttons({
						
						// Set up the transaction
						createOrder: function(data, actions) {
							var total = $scope.amount;
							var orderid = $scope.orderid;
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
								window.location ='paysuccess.php?trx_id='+$scope.orderid;	
								alert('Transaction completed by ' + details.payer.name.given_name + '!');
							});
						}
					}).render('#paypal-button-container');	
				}else{
					$scope.bookingList();
						swal({text: "Please Wait for Customer Approval",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			            closeOnConfirm: false});
						
					
				}
			})
	}
	$scope.statusV = function(bookingid){
			//alert(bookingid);		
			$http.post("api/custstatus.php",{"bookid":bookingid.toString()}).then(function(response) {
					if(response.data=='1'){
							$scope.bookingList();
							swal({text: "Booking Accepted Successfully!",type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
  						document.getElementById('mySound').play();
					}else{
						swal({text: "Some Critical Problem!",type:"danger",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
					}
			})
	}
  });
  
  //pay on click
 // $('body').on('click','#orangesubmit',init_orange_pay);
  
</script>
      </body>
</html>