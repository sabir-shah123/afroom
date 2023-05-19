<?php 
include('db.php');
$last = mysqli_query($conn,"Select id from customer where mobile='".$_POST['mobile']."'");
$fetch = mysqli_fetch_assoc($last);
if(empty($fetch)){
	$insert = mysqli_query($conn,"INSERT into customer Values(0,'".$_POST['person']."','".$_POST['mobile']."','0','','',now())");
	$last = mysqli_query($conn,"Select id from customer where mobile='".$_POST['mobile']."'");
	$fetch = mysqli_fetch_assoc($last);
}else{
     $last = mysqli_query($conn,"Select id from customer where mobile='".$_POST['mobile']."'");
     $fetch = mysqli_fetch_assoc($last);

}
$check = mysqli_query($conn,"Select wallet from customer where mobile='".$_POST['mobile']."'");
$fetchbal = mysqli_fetch_assoc($check);
if($fetchbal['wallet']>0 && $_POST['amount']<=$fetchbal['wallet']){
		$pay = 0;
		$bal = $fetchbal['wallet'] - $_POST['amount'];
		mysqli_query($conn,"UPDATE customer set wallet='".$bal."' where mobile='".$_POST['mobile']."'");
}else{
		if($fetchbal['wallet']>0){
			$bal =  $_POST['amount']-$fetchbal['wallet'];
			$pay = $bal;
		}else{
			$pay = $_POST['amount'];
		}
}
$booking = mysqli_query($conn,"INSERT into booking Values(0,'".$fetch['id']."','".$_POST['dest']."','".$_POST['zone']."','".$_POST['place']."','".$_POST['time']."','".$_POST['date']."','".$_POST[	'seat']."',now(),now(),'".$_POST['type']."','0','0','0','".$_POST['btype']."')");
if($booking){
//	$book = mysqli_query($conn,"Select max(id) as id from booking");
	$lastbooking_id =mysqli_insert_id($conn);
//	$lfetch = mysqli_fetch_assoc($book);
	$lfetch = ['id'=>$lastbooking_id];
	if($pay==0){
		$_SESSION['mobile'] = $_POST['mobile'];
		$_SESSION['logintype']='Customer';
		mysqli_query($conn,"INSERT into custpayment Values(0,'".$_POST['orderid']."','".$lfetch['id']."','".$pay."','1','WALLET',now())");
		//Noti
		$message = 'New Booking Created By Customer '.$_POST['person'];
		$allpro = mysqli_query($conn,"Select * from providers");
		while($pros = mysqli_fetch_assoc($allpro)){
			mysqli_query($conn,"INSERT into noti Values(0,'".$message."','".$pros['id']."','".$fetch['id']."','PROVIDER',now(),'0','0')");
		}
	}else{
	        mysqli_query($conn,"INSERT into custpayment Values(0,'".$_POST['orderid']."','".$lfetch['id']."','".$pay."','0','ONLINE',now())");		
	}
	$lastcust_id =mysqli_insert_id($conn);
	echo json_encode(['pay'=>$pay,'last_cust_id'=>$lastcust_id,'lastbooking_id'=>$lastbooking_id]);
}else{
	echo "error";
}
?>