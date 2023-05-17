<?php 
include('header.php');
$bamt = mysqli_query($conn,"Select * from bookamt limit 1");
$fetchA = mysqli_fetch_assoc($bamt);

if($_SESSION['logintype']=='Customer'){
		$custrefund = mysqli_query($conn,"Select b.id as id,b.custid,b.seat from booking as b left join providerpay as p on p.bookingid=b.id where b.date < '".date('Y-m-d')."' and b.custid='".$_SESSION['unqid']."' and b.refundstatus=0");
		while($row = mysqli_fetch_assoc($custrefund)){
		$getlast = mysqli_query($conn,"Select wallet from customer where id='".$row['custid']."'");
		$fetchlast = mysqli_fetch_assoc($getlast);
		$newbal = $fetchlast['wallet']+($fetchA['amt']*$row['seat']); 
		$update = mysqli_query($conn,"Update customer set wallet='".$newbal."' where id='".$row['custid']."'");
		$status = mysqli_query($conn,"Update booking set refundstatus=1 where id='".$row['id']."'");
		}
		
}else{
		$prorefund = mysqli_query($conn,"Select b.id as id,b.custid,b.seat,p.providerid from booking as b inner join providerpay as p on p.bookingid=b.id where b.date < '".date('Y-m-d')."' and p.providerid='".$_SESSION['unqid']."' and b.refundstatus1=0 and b.custstatus=0 and p.paymentstatus=1");
		while($col = mysqli_fetch_assoc($prorefund)){
		$getlast = mysqli_query($conn,"Select wallet from providers where id='".$col['providerid']."'");
		$fetchlast = mysqli_fetch_assoc($getlast);
		$newbal = $fetchlast['wallet']+($fetchA['pamt']*$col['seat']); 
		$update = mysqli_query($conn,"Update providers set wallet='".$newbal."' where id='".$col['providerid']."'");
		$status = mysqli_query($conn,"Update booking set refundstatus1=1 where id='".$col['id']."'");
		}

}
?>
		<div style="display:none;" class="main-panel" data-ng-controller="myCtrl">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                 
                    <h4 class="card-title">Refund History List  </h4>
                   
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
                                          <th>Total Amount </th>
                                          <th>Refund Status </th>			  
                                         </tr>
                                      </thead>
                                      <tbody>
                                      	<tr ng-repeat="x in BookHis">
		                                      	<td>{{$index+1}}</td>
		                                      	<td>{{x.id}}</td>
		                                      	<td>{{x.booktype}}</td>
		                                      	<td>{{x.desti}}</td>
		                                      	<td>{{x.date}}</td>
		                                      	<td>{{x.time}}</td>
		                                      	<td>{{x.amount}}</td>
		                                      	<td>Done</td>
											
				</tr>
            						</tbody>
                                 </table>   		  
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
	$scope.bookingList = function(){
		$http.post("api/getRefundhis.php",1).then(function(response) {
			//alert(JSON.stringify(response.data));
			$scope.BookHis = response.data;
			
		})
		
	}
	$scope.bookingList();
	
  });
</script>
      </body>
</html>