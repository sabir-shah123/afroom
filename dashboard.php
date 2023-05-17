<?php include('header.php');
?>

        <!-- partial -->
		 <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon  text-white mr-2" style="background: #21a05d ;color:#fff;">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
            </div>
            <div class="b-5 row bg-white rounded">
              <?php 
			  		if($_SESSION['logintype']=='Provider'){
					$query = mysqli_query($conn,"Select (SELECT count(id) from providerpay where paymentstatus=1 and providerid='".$_SESSION['unqid']."') as totalCust,(SELECT ifnull(sum(amount),0) from providerpay where paymentstatus=1 and providerid='".$_SESSION['unqid']."') as totalAmt");
$fetch = mysqli_fetch_assoc($query);
	
			  ?>
              
               
              <div class="col-md-12 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  
                </div>
                 
                </div>
              </div>
             
             <?php } else { 
			 	$customer = mysqli_query($conn,"Select count(id) as id from booking where id='".$_SESSION['unqid']."'");
				$total = mysqli_fetch_assoc($customer);
			 ?>
           
                   <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card shadow-lg bg-body rounded">
                            <div class="card-body text-info border-bottom border-info border-w-5 rounded">
                                <h2 class="text-center">38</h2>
                                <h6 class="text-center">My Bookings</h6>       
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card shadow-lg bg-body rounded">
                            <div class="card-body text-success border-bottom border-success border-w-5 rounded">
                                <h2 class="text-center">1</h2>
                                <h6 class="text-center">Running Ride</h6>       
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card shadow-lg bg-body rounded">
                            <div class="card-body text-danger border-bottom border-danger border-w-5 rounded">
                                <h2 class="text-center">258</h2>
                                <h6 class="text-center">Paid Payments</h6>       
                            </div>
                        </div>
                    </div>
            
            <div class="col-12 col-sm-6 col-xl-3 mt-3">
                        <div class="card shadow-lg bg-body rounded">
                            <div class="card-body text-info border-bottom border-info border-w-5 rounded">
                                <h2 class="text-center">1054</h2>
                                <h6 class="text-center">Wallet Balance</h6>       
                            </div>
                        </div>
                    </div>
<br>
              <!--<div class="col-12 col-md-6 col-lg-6 mt-3">
                        <div class="card">                            
                            <div class="card-content">
                                <div class="card-body shadow-lg rounded">  
                                    <div class="d-flex"> 
                                        <div class="media-body align-self-center ">
                                            <span class="mb-0 h5 font-w-600">Booking History</span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                        </div>
                                        <div class="ml-auto border-0 outline-badge-warning circle-50"><span class="h5 mb-0">$</span></div>
                                    </div>
                                    <div id="flot-report" class="height-175 w-100 mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>-->
            <!--<br>
              <div class="col-12 col-md-6 col-lg-6 mt-3">
                        <div class="card">                            
                            <div class="card-content">
                                <div class="card-body shadow-lg rounded">  
                                    <div class="d-flex"> 
                                        <div class="media-body align-self-center ">
                                            <span class="mb-0 h5 font-w-600">Refund History</span><br>
                                            <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                        </div>
                                        <div class="ml-auto border-0 outline-badge-warning circle-50"><span class="h5 mb-0">$</span></div>
                                    </div>
                                    <div id="flot-report" class="height-175 w-100 mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>-->
          <!--  <br>
            
            <div class="col-md-6 col-lg-8 mt-3">
                        <div class="card overflow-hidden shadow-lg rounded">
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                <h6 class="card-title">Driver Notification</h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body p-0">
                                    <ul class="list-group list-unstyled">
                                        <li class="p-2 border-bottom zoom">
                                            <div class="media d-flex w-100">
                                                <a href="#"><img src="dist/images/author1.jpg" alt="" class="img-fluid ml-0 mt-2  rounded-circle" width="40"></a>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Jonathan</span><br>
                                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                                </div>
                                                <div class="ml-auto my-auto">
                                                    <a href="#"  data-toggle="dropdown">
                                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                            <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom zoom">
                                            <div class="media d-flex w-100">
                                                <a href="#"><img src="dist/images/author2.jpg" alt="" class="img-fluid ml-0 mt-2  rounded-circle" width="40"></a>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">kelvin</span><br>
                                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                    
                                                </div>
                                                <div class="ml-auto my-auto">
                                                    <a href="#"  data-toggle="dropdown">
                                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                            <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="p-2 border-bottom zoom">
                                            <div class="media d-flex w-100">
                                                <a href="#"><img src="dist/images/author3.jpg" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Peter</span><br>
                                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                   
                                                </div>
                                                <div class="ml-auto my-auto">
                                                    <a href="#"  data-toggle="dropdown">
                                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                            <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="p-2 border-bottom zoom">
                                            <div class="media d-flex w-100">
                                                <a href="#"><img src="dist/images/author9.jpg" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Ray Sin</span><br>
                                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                                 
                                                </div>
                                                <div class="ml-auto my-auto">
                                                    <a href="#"  data-toggle="dropdown">
                                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                            <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="p-2 border-bottom zoom">
                                            <div class="media d-flex w-100">
                                                <a href="#"><img src="dist/images/author6.jpg" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Abexon Dixon</span><br/>
                                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                              
                                                </div>

                                                <div class="ml-auto mail-tools">
                                                    <a href="#"  data-toggle="dropdown">
                                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                            <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="p-2 zoom">
                                            <div class="media d-flex w-100">
                                                <a href="#"><img src="dist/images/author7.jpg" alt="" class="img-fluid ml-0 mt-2 rounded-circle" width="40"></a>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Nathan S. Johnson</span><br/>
                                                    <p class="mb-0 font-w-500 tx-s-12">San Francisco, California, USA</p>                                              
                                                </div>

                                                <div class="ml-auto mail-tools">
                                                    <a href="#"  data-toggle="dropdown">
                                                        <i class="icon-options icons h6 font-weight-bold"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-pencil mr-2 h6 mb-0"></span> Edit Profile</a>
                                                        <a href="#" class="dropdown-item px-2 align-self-center d-flex">
                                                            <span class="icon-user mr-2 h6 mb-0"></span> View Profile</a>
                                                        <a href="#" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                                            <span class="icon-trash mr-2 h6  mb-0"></span> Delete</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>

                                    </ul> 
                                </div>
                            </div>
                        </div>
                    </div>-->
            
           <!-- <br>
            <div class="col-md-6 col-lg-4 mt-3">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                <h6 class="card-title">Refund History</h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body p-0 shadow-lg rounded">
                                    <ul class="list-group list-unstyled">
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-primary"><span>ML</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Max S. Lewis</span><br>
                                                    <small class="mb-0 font-w-500">msl@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-secondary"><span>TW</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Timothy S. Williamson</span><br>
                                                    <small class="mb-0 font-w-500">tsw@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-info"><span>HW</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Harry J. Mitchell</span><br>
                                                    <small class="mb-0 font-w-500">hjm@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-warning"><span>JS</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">John M. Stokes</span><br>
                                                    <small class="mb-0 font-w-500">jms@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2 border-bottom">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-success"><span>JP</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Joshua P. Morrison</span><br>
                                                    <small class="mb-0 font-w-500">jpm@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                        <li class="p-2">
                                            <div class="media d-flex w-100">
                                                <div class="circle-40 outline-badge-danger"><span>LC</span></div>
                                                <div class="media-body align-self-center pl-2">
                                                    <span class="mb-0 font-w-600">Lester V. Cargo</span><br>
                                                    <small class="mb-0 font-w-500">lvc@test.com</small>                                                    
                                                </div>
                                                <div class="ml-auto my-auto font-weight-bold">
                                                    $12,456.00
                                                </div>
                                            </div> 
                                        </li>
                                    </ul> 
                                </div>
                            </div>
                        </div>
                    </div>-->
            <!--<br>
         
                    <div class="col-12  mt-3">
                        <div class=" card shadow-lg rounded" >
                            <div class="card-header d-flex justify-content-between align-items-center">                               
                                <h4 class="card-title">Google Map</h4>
                            </div>
                            <div >                               
                                <iframe style="width:100% !important; height:400px !important;border:0 !important"; src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.0172969085047!2d77.37484751492099!3d28.629243690980907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390ce557c86ccf81%3A0xa11ee0eff72292a7!2sExcel%20Geomatics%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1677061510269!5m2!1sen!2sin"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                </div>
         -->
                  </div>
                </div>
             
            <?php } ?>


 
  
   
<!-- content-wrapper ends -->
        <?php include('footer.php');?>