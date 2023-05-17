<?php include('header.php');
$bamt = mysqli_query($conn,"Select * from bookamt limit 1");
$fetchA = mysqli_fetch_assoc($bamt);

if($_SESSION['logintype']=='Customer'){
		$custrefund = mysqli_query($conn,"Select b.id as id,b.custid,b.seat from booking as b where b.id not in(Select bookingid from providerpay)
and b.refundstatus=0 and b.custid='".$_SESSION['unqid']."' and b.date < '".date('Y-m-d')."'");
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
     	<div class="main-panel">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    
                    <h4 class="card-title">Wallet Balance    </h4>
                    <div class="row">
                          <div class="col-md-12">
                          		<?php
									if($_SESSION['logintype']=='Customer'){
										$query = mysqli_query($conn,"Select wallet from customer where id='".$_SESSION['unqid']."'");
										$bal = mysqli_fetch_assoc($query);
									}else{
										$query = mysqli_query($conn,"Select wallet from providers where id='".$_SESSION['unqid']."'");
										$bal = mysqli_fetch_assoc($query);
									}
								?>
                                 <input type="text" readonly value="<?php echo $bal['wallet'];?>" class="form-control" style="color:green;">
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
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">All Rights Reserved & Copyright © By Receipe</span>
             
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
    <script src="assets/js/todolist.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.0.5/css/scroller.jqueryui.min.css">
    <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.jqueryui.min.css" rel="stylesheet">
    <link href="://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.jqueryui.min.css" rel="stylesheet">

    
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.jqueryui.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.4/js/dataTables.rowGroup.min.js"></script>

    <script>
    $(document).ready(function() {
    $('#example').DataTable( {
        order: [[1, 'asc']],
        
    } );
} );
</script>
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
$('.main-panel').css("display","block");	
$scope.amount = 0;
  	$scope.selectAllFlag = false;
	$scope.bookingList = function(){
		$scope.bookList = [];
		$http.post("api/getDataToday.php",1).then(function(response) {
			//alert(JSON.stringify(response));
			angular.forEach(response.data,function (obj, index) {
						$scope.bookList.push({"flag":false,"id":obj.id,"personname":obj.personname,"mobile":obj.mobile,"zone":obj.zone,"place":obj.place,"time":obj.time,"date":obj.date,"seat":obj.seat,"created_at":obj.created_at,"show":obj.show,"providername":obj.providername,"providermobile":obj.providermobile,"cstatus":obj.cstatus});
			})
		})
		//alert(JSON.stringify($scope.bookList));
		
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
			$http.post("api/payment.php",{"bookdata":$scope.bookList,"providerid":$scope.providerid,"amount":$scope.amount}).then(function(response) {
						//alert(JSON.stringify(response));
						window.open(response.data, '_blank');	
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