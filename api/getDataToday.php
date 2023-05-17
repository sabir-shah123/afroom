<?php
error_reporting(0);
include('db.php');
$array =array();
if($_SESSION['logintype']=='Customer'){
	$session = "and c.custid='".$_SESSION['unqid']."'"; 
}else{
    $session = "";
}
if($_SESSION['logintype']=='Provider'){
	$session1 = ""; 
}else{
    $session1 = "";
}
if($_SESSION['logintype']=='Customer'){
$booking = mysqli_query($conn,"Select c.*,a.personname,a.mobile from booking as c 
left join customer as a on a.id=c.custid inner join custpayment as p on p.custid=c.id 
where p.paymentstatus=1 and date='".date("Y-m-d")."' ".$session." and c.custstatus=0   order by c.id desc");
}else{
$booking = mysqli_query($conn,"Select c.*,a.personname,a.mobile from booking as c 
left join customer as a on a.id=c.custid inner join custpayment as p on p.custid=c.id 
where p.paymentstatus=1 and date='".date("Y-m-d")."' ".$session." and c.custstatus=0  and c.booktype='".$_SESSION['regas']."' order by c.id desc");
}


while($result = mysqli_fetch_assoc($booking)){
		$checkpay = mysqli_query($conn,"SELECT pp.id,pp.bookingid,p.name,p.mobile from providerpay as pp left join providers as p on p.id=pp.providerid where pp.bookingid='".$result['id']."' and pp.paymentstatus=1");
		$fetchpay = mysqli_fetch_assoc($checkpay);
		if(!empty($fetchpay['id'])){
			array_push($array,array("id"=>$result['id'],"personname"=>$result['personname'],"mobile"=>$result['mobile'],"zone"=>$result['zone'],"place"=>$result['place'],
			"time"=>$result['time'],"date"=>$result['date'],"seat"=>$result['seat'],"created_at"=>$result['created_at'],"show"=>$fetchpay['id'],"providername"=>$fetchpay['name'],
			"providermobile"=>$fetchpay['mobile'],"cstatus"=>$result['custstatus'],"desti"=>$result['desti'],"btype"=>$result['booktype']));
		}else{
			$checkpay1 = mysqli_query($conn,"SELECT pp.id,pp.bookingid,p.name,p.mobile 
			from providerpay as pp left join providers as p on p.id=pp.providerid 
			where bookingid='".$result['id']."' and paymentstatus=1");
			$fetchpay1 = mysqli_fetch_assoc($checkpay1);
			if(empty($fetchpay1)){
			array_push($array,array("id"=>$result['id'],"personname"=>$result['personname'],"mobile"=>$result['mobile'],"zone"=>$result['zone'],"place"=>$result['place'],
			"time"=>$result['time'],"date"=>$result['date'],"seat"=>$result['seat'],"created_at"=>$result['created_at'],"show"=>0,"providername"=>$fetchpay1['name'],
			"providermobile"=>$fetchpay1['mobile'],"cstatus"=>$result['custstatus'],"desti"=>$result['desti'],"btype"=>$result['booktype']));
			}
		}
}

echo json_encode($array);
?>