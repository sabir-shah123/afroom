<?php
include('db.php');
$check = mysqli_query($conn,"Select wallet from providers where id='".$request->providerid."'");
$fetchbal = mysqli_fetch_assoc($check);
$pay = 0;
if($fetchbal['wallet']>0 && $request->amount<=$fetchbal['wallet']){
		$pay = 0;
		$bal = $fetchbal['wallet'] - $request->amount;
		mysqli_query($conn,"UPDATE providers set wallet='".$bal."' where id='".$request->providerid."'");
		
}else{
		if($fetchbal['wallet']>0){
			$bal =  $request->amount-$fetchbal['wallet'];
		}else{
			$pay = $request->amount;
		}
}
foreach($request->bookdata as $obj){
		if($obj->flag==true){
			if($pay!=0){
				mysqli_query($conn,"INSERT into providerpay Values(0,'".$obj->id."','".$request->providerid."','".$request->orderid."','".$request->amount."','0','ONLINE',now())");
			}else{
				mysqli_query($conn,"INSERT into providerpay Values(0,'".$obj->id."','".$request->providerid."','".$request->orderid."','".$pay."','1','WALLET',now())");
				// NOTI
				$getcustid = mysqli_query($conn,"Select custid from booking where id='".$obj->id."'");
				$fetchcust = mysqli_fetch_assoc($getcustid);
				$message  = "Driver has paid for your booking";
				mysqli_query($conn,"INSERT into noti Values(0,'".$message."','0','".$fetchcust['custid']."','CUSTOMER',now(),'0','0')");
			}
		}
	}
	echo $pay;
?>