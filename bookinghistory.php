<?php 
include('header.php');

?>
		<div style="display:none;" class="main-panel" data-ng-controller="myCtrl">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <?php if($_SESSION['logintype']=='Customer') { ?>
                    <h4 class="card-title">Booking History List  </h4>
                    <?php } else { ?>
                    <h4 class="card-title">Booking History List  </h4>
                    
                    <?php } ?>
                    <div class="row">
                          <div class="col-md-12">
                                <div class="table-responsive">
                                    <table id="example" class="gkg" width="100%">
                                      <thead>
                                        <tr>
                                          <th>SNo</th>
                                          <th>Booking ID</th>
                                          <th>Type</th>
                                          <th>Destination</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <?php if($_SESSION['logintype']=='Customer'){ ?>
										  <th>Name</th>
                                          <th>Total Amount </th>
                                          
                                          <th>Book Status </th>
                                          <th>Payment Mode</th>
										  <?php } else { ?>
										  <th>Pickup Location</th>
										  <th>Drop Location</th>
										  <th>Amount</th>
										  <th>Book Status</th>
										  <th>Payment Mode</th>
										  <?php } ?>
                                         </tr>
                                      </thead>
                                      <tbody>
                                      	<tr ng-repeat="x in BookHis">
											<td>{{$index+1}}</td>
											<td>{{x.id}}</td>
											<td>{{x.btype}}</td>
											<td>{{x.desti}}</td>
											<td>{{x.date}}</td>
											<td>{{x.time}}</td>
											<?php if($_SESSION['logintype']=='Customer'){ ?>
											<td>{{x.personname}}</td>
											<td>{{x.amount}}</td>
											
											<td>
	
					<span ng-if="x.custstatus==0  && x.date!='<?php echo date('Y-m-d');?>'">Expired</span>  
				        <span ng-if="x.paymentstatus==1 && x.custstatus==1 && x.date=='<?php echo date('Y-m-d');?>'">Confirm</span>
			               <span ng-if="x.paymentstatus==null && x.custstatus==0  && x.date=='<?php echo date('Y-m-d');?>'">Requested</span>
					<span ng-if="x.paymentstatus==1  && x.custstatus==0  && x.date=='<?php echo date('Y-m-d');?>'">Requested</span>
											</td>
											<td>{{x.pay}}</td>
											
											 <?php } else { ?>
											<td>{{x.zone}}</td>
											<td>{{x.place}}</td>
											<td>{{x.amount}}</td>
											<td> <span ng-if="x.custstatus==0">Requested</span>
											<span ng-if="x.custstatus==1">Confirmed</span></td>
											<td>{{x.pay}}</td>
											 <?php } ?>
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
    }	</style>
    
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
		$http.post("api/getBookHis.php",1).then(function(response) {
			//alert(JSON.stringify(response));
			$scope.BookHis = response.data;
		})
	}
	$scope.bookingList();
	
  });
</script>
      </body>
</html>