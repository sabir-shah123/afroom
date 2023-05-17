<?php 
$conn = mysqli_connect("localhost","thealiens_afroonlock","afroonlock@123","thealiens_afroonlock");
session_start();
if($_SESSION['logintype']!='Customer') { 
$cou2 = mysqli_query($conn,"SELECT  * from noti where status=0 and pro='".$_SESSION['unqid']."' and type='PROVIDER' and numb=0 and cast(created_at as date)='".date('Y-m-d')."'");
}else{
 $cou2 = mysqli_query($conn,"SELECT * from noti where status=0 and cust='".$_SESSION['unqid']."' and type='CUSTOMER' and numb=0 and cast(created_at as date)='".date('Y-m-d')."'");	

 }
 
 
 if($_SESSION['logintype']!='Customer') { 
$cou = mysqli_query($conn,"SELECT  * from noti where status=0 and pro='".$_SESSION['unqid']."' and type='PROVIDER'  and cast(created_at as date)='".date('Y-m-d')."' LIMIT 5");
            	}else{
$cou = mysqli_query($conn,"SELECT * from noti where status=0 and cust='".$_SESSION['unqid']."' and type='CUSTOMER' and cast(created_at as date)='".date('Y-m-d')."' limit 5");	
}
$data=array();
	while($fetch=mysqli_fetch_assoc($cou)){
			array_push($data,$fetch);
	}

echo json_encode(array("total" =>  $rowcount=mysqli_num_rows($cou2),"data"=>$data));          	 
?>