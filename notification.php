<?php include('header.php');
if($_SESSION['logintype']=='Customer') { 
	
	$update = mysqli_query($conn,"Update noti set numb='1' where cust='".$_SESSION['unqid']."' and type='CUSTOMER'");
}else{
	$update = mysqli_query($conn,"Update noti set numb='1' where pro='".$_SESSION['unqid']."' and type='PROVIDER'");
}
?>
<div  class="main-panel">
           <div class="content-wrapper">
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Notifications  </h4>
                    	<div class="row">
                    	 <?php
            	if($_SESSION['logintype']!='Customer') { 
            		$cou1 = mysqli_query($conn,"SELECT  * from noti where pro='".$_SESSION['unqid']."' and type='PROVIDER' order by id asc");
            	}else{
            	       $cou1 = mysqli_query($conn,"SELECT * from noti where  cust='".$_SESSION['unqid']."' and type='CUSTOMER' order by id asc");	
            	}
            ?>	
            <div class="col-md-12">
            		<div class="table-responsive">
            		<table width="100%">
            		<?php 
            		$rowcount=mysqli_num_rows($cou1);
            		if($rowcount>0){
                    while($fetch1 = mysqli_fetch_assoc($cou1)){
                      if($_SESSION['logintype']!='Customer') { 	
                      	if($fetch1['status']=='1'){
                    	$col = "<button style=color:#fff;border-radius:10px;background:green;border-color:green;padding:2px 6px;>Read</button>";
                    }else{
                    	$col = "<button style=color:#fff;border-radius:10px;background:red;border-color:green;padding:2px 6px;>Un Read</button>";
                    }				
                    ?>
                  <tr>
                    	   <td> <a style="text-decoration:none;" href="noti.php?id=<?php echo $fetch1['id'];?>"><p style="padding:0px 7px;" class="">
                    	    <?php echo $fetch1['message'];?>
                    	    </p></a></td>
                    	    <td><?php echo $fetch1['created_at'];?></td>
                    	    <td><?php echo $col;?> </td>
                    	    <td><a href="customer"><button class="btn btn-warning"><i class="fa fa-eye"></i> Requested</button></a></td>
                    	    <td><a href="completebooking"><button class="btn btn-success"><i class="fa fa-eye"></i> Completed</button></a></td>
                    	    </tr>
                    <?php }  else {    
                    if($fetch1['status']=='1'){
                    	$col = "<button style=color:#fff;border-radius:10px;background:green;border-color:green;padding:2px 6px;>Read</button>";
                    }else{
                    	$col = "<button style=color:#fff;border-radius:10px;background:red;border-color:green;padding:2px 6px;>Un Read</button>";
                    }		
                    ?>
                  
	                    <td><a style="text-decoration:none;" href="noti.php?id=<?php echo $fetch1['id'];?>"><p style="padding:0px 7px;" class=""><?php echo $fetch1['message'];?></p></a></td>
	                    <td><?php echo $fetch1['created_at'];?></td>
	                    <td><?php echo $col;?> </td>
	                     <td><a href="customer"><button class="btn btn-warning"><i class="fa fa-eye"></i> Requested</button></a></td>
                    	    <td><a href="completebooking"><button class="btn btn-success"><i class="fa fa-eye"></i> Completed</button></a></td>
                    <?php }?></tr> <?php } 
                    
                    } else {?>
                    	<p>No New Notification Found!</p>
                    	
                    <?php } ?>
                          
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