<?php include('header.php');

?>
		<div style="display:none;" class="main-panel" data-ng-controller="myCtrl">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <?php if($_SESSION['logintype']=='Customer') { ?>
                    <h4 class="card-title">Expired List  </h4>
                    <?php } else { ?>
                    <h4 class="card-title">Expired List  </h4>
                    
                    <?php } ?>
                    <div class="row">
                          <div class="col-md-12">
                                 		<div class="table-responsive">
                                    <table id="example" class="gkg" width="100%">
                                      <thead>
                                        <tr>
                                          <th>Status</th>
                                          <th>Name</th>
                                          <th>Mobile</th>
                                          <th>Type</th>
                                          <th>Destination</th>
                                          <th>Zone</th>
                                          <th>Place </th>
                                          <th>Time </th>
                                          <th>Date </th>
                                          <th>Seats </th>
                                          <th>Booking Status</th>
					<th>Refund Status</th>
                                         </tr>
                                      </thead>
                                      <tbody>
                                      	<tr  ng-repeat="x in bookList"<?php
										  	if($_SESSION['logintype']=='Customer'){?>
											  <?php }else {"";}?> >
                                        	<?php
										  	if($_SESSION['logintype']=='Provider'){
										  ?>
                                          <td><button ng-if="x.cstatus==0"  class="btn btn-warning">Pending</button>
                                             <button ng-if="x.cstatus==1" class="btn btn-success">Accepted</button></td>
                                            <td><span ng-if="x.show>0 && x.cstatus==1">{{x.personname}}</span></td>
                                            <td><span ng-if="x.show>0 && x.cstatus==1">{{x.mobile}}</span></td>
                                             <?php } else { ?>
                                             <td><button ng-if="x.cstatus==0" class="btn btn-success">Not Accepted</button>
                                             <button ng-if="x.cstatus==1" class="btn btn-warning">Accepted</button></td>
                                          
                                             <td>{{x.providername}}</td>
                                             <td>{{x.providermobile}}</td>
                                             <?php } ?>
                                            <td>{{x.btype}}</td>
                                            <td>{{x.desti}}</td>
                                            <td>{{x.zone}}</td>
                                            <td>{{x.place}}</td>
                                            <td>{{x.time}}</td>
                                            <td>{{x.date}}</td>
                                            <td>{{x.seat}}</td>
					    <td>Expired</td>
					    <td><button class="btn btn-success">Done</button></td>
                                         </tr>
                                     
            						</tbody>
                                 </table>   		  
                                </div> 
                                <?php
									if($_SESSION['logintype']=='Customer'){
										
									}else{
								?>
                                <input type="hidden" ng-model="providerid" ng-init='providerid=<?php echo $_SESSION['mobile'];?>'>
                                
                                
                  				<?php } ?>
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

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
$('.main-panel').css("display","block");	
$scope.amount = 0;
  	$scope.selectAllFlag = false;
	$scope.bookingList = function(){
		$scope.bookList = [];
		$http.post("api/getData.php",1).then(function(response) {
			//alert(JSON.stringify(response.data));
			angular.forEach(response.data,function (obj, index) {
				
						if(obj.providername){
								var a = obj.providername; 
						}else{
								var a = '';
						}
						if(obj.providermobile){
								var b = obj.providermobile; 
						}else{
								var b = '';
						}
						$scope.bookList.push({"flag":false,"id":obj.id,"personname":obj.personname,"mobile":obj.mobile,"zone":obj.zone,"place":obj.place,"time":obj.time,"date":obj.date,"seat":obj.seat,
"created_at":obj.created_at,"show":obj.show,"providername":a,"providermobile":b,"cstatus":obj.cstatus,"refundstatus":obj.refundstatus,"refundstatus1":obj.refundstatus1,
"desti":obj.desti,"btype":obj.btype});
			})
			//alert(JSON.stringify($scope.bookList));
		})
		
		
	}
	$scope.bookingList();
	$scope.updateCustomerListFlag = function(index,custid,seat) {
		if($scope.bookList[index].flag) {
			$scope.bookList[index].flag = false;
			$scope.amount = $scope.amount-(seat*3); 
		}
		else {
			$scope.bookList[index].flag = true;
			$scope.amount = 0;
			angular.forEach($scope.bookList, function(value,index) {
						$scope.amount1 = 0;
						if(value.flag==true){
							$scope.amount1 = parseFloat(value.seat*3);
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
	
	$scope.getPayment = function(){
			
			//alert($scope.amount);
			//alert($scope.providerid);
			$http.post("api/payment.php",{"bookdata":$scope.bookList,"providerid":$scope.providerid,"amount":$scope.amount,"orderid":$scope.orderid}).then(function(response) {
						//alert(JSON.stringify(response));
						//window.open(response.data, '_blank');

						if(response.data <=0){
						swal({text: "Process with Your Payment & Your Wallet Balance is "+response.data,type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
  			closeOnConfirm: false});
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
						swal({text: "Please Wait for Customer Approval & Your Wallet Balance is "+response.data,type:"success",showCancelButton:false,confirmButtonClass: "btn-success",
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
					}else{
						swal({text: "Some Critical Problem!",type:"danger",showCancelButton:false,confirmButtonClass: "btn-danger",
  			closeOnConfirm: false});
					}
			})
	}
  });
</script>
      </body>
</html>