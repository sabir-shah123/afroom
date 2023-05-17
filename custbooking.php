<?php include('header.php');?>
		<div style="display:none;" class="main-panel" data-ng-controller="myCtrl">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Customer Booking List  </h4>
      
                    <div class="row">
                          <div class="col-md-12">
                                 		<div class="table-responsive">
                                    <table id="example" class="table table-striped" width="100%">
                                      <thead>
                                        <tr>
                                          <th  style="background:#fe7c96;color:#fff;" align="center" class="table-head">Choose </th>
                                          <th style="background:#fe7c96;color:#fff;">Name</th>
                                          <th style="background:#fe7c96;color:#fff;">Mobile</th>
                                          <th style="background:#fe7c96;color:#fff;">Zone</th>
                                          <th style="background:#fe7c96;color:#fff;">Place </th>
                                          <th style="background:#fe7c96;color:#fff;">Time </th>
                                          <th style="background:#fe7c96;color:#fff;">Date </th>
                                          <th style="background:#fe7c96;color:#fff;">Seats </th>
                                          <th style="background:#fe7c96;color:#fff;">Created At </th>
                                         
                                        </tr>
                                      </thead>
                                      <tbody>
                                      	<tr ng-repeat="x in bookList">
                                        	<td ng-click="updateCustomerListFlag($index,[[x.mobile]],[[x.seat]])" class="table-text">
                                        	<span ng-if="x.show==0"><i style="color:#000!important;" class="fa fa-square-o icon" ng-show="x.flag==false" aria-hidden="true"></i><i style="color:#000!important;" class="fa fa-check-square-o icon" ng-show="x.flag==true" aria-hidden="true"></i></span></td>
                                            <td><span ng-if="x.show>0">{{x.personname}}</span></td>
                                            <td><span ng-if="x.show>0">{{x.mobile}}</span></td>
                                            <td>{{x.zone}}</td>
                                            <td>{{x.place}}</td>
                                            <td>{{x.time}}</td>
                                            <td>{{x.date}}</td>
                                            <td>{{x.seat}}</td>
                                            <td>{{x.created_at}}</td> 
                                         </tr>
                                     
            						</tbody>
                                 </table>   		  
                                </div> 
                                <input type="hidden" ng-model="providerid" ng-init='customerid=<?php echo $_SESSION['mobile'];?>'>
                               
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
$('.main-panel').css("display","block");	
$scope.amount = 0;
  	$scope.selectAllFlag = false;
	$scope.bookingList = function(){
		$scope.bookList = [];
		$http.post("api/getDataToday.php",1).then(function(response) {
			alert(JSON.stringify(response));
			angular.forEach(response.data,function (obj, index) {
						$scope.bookList.push({"flag":false,"id":obj.id,"personname":obj.personname,"mobile":obj.mobile,"zone":obj.zone,"place":obj.place,"time":obj.time,"date":obj.date,"seat":obj.seat,"created_at":obj.created_at,"show":obj.show});
			})
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
			$http.post("api/payment.php",{"bookdata":$scope.bookList,"providerid":$scope.providerid,"amount":$scope.amount}).then(function(response) {
						//alert(JSON.stringify(response));
						window.open(response.data, '_blank');	
			})
	}
  });
</script>
      </body>
</html>