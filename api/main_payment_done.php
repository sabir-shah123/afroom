<?php

$getPay = mysqli_query($conn,"Select a.amount,a.custid,c.id as cust from custpayment as a inner join booking as b on b.id=a.custid inner join customer as c on c.id=b.custid where orderid='".$orderid."'");
$fetchPay = mysqli_fetch_assoc($getPay);
$check = mysqli_query($conn,"Select wallet,mobile from customer where id='".$fetchPay['cust']."'");
$fetchbal = mysqli_fetch_assoc($check);
if($fetchbal['wallet']>0 && $fetchPay['amount']<=$fetchbal['wallet']){
		$bal = $fetchbal['wallet'] - $fetchPay['amount'];
		mysqli_query($conn,"UPDATE customer set wallet='".$bal."' where id='".$fetchPay['cust']."'");
}else{
		$bal =  $fetchPay['amount']-$fetchbal['wallet'];
		mysqli_query($conn,"UPDATE customer set wallet='0' where id='".$fetchPay['cust']."'");
}
$pre = mysqli_query($conn,"Select * from prefixs order by id desc limit 1");
$fetch = mysqli_fetch_assoc($pre);

$provi = mysqli_query($conn,"Select * from providers");
while($fetchp = mysqli_fetch_assoc($provi)){

	
	
}