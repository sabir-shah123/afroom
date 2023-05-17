<?php
include('db.php');
$array =array();
if($_SESSION['logintype']=='Customer'){
	$session = "and c.custid='".$_SESSION['unqid']."'";
	$booking = mysqli_query($conn,"Select c.*,b.personname,b.mobile from booking as c 
inner join customer as b on b.id=c.custid  inner join custpayment as p on p.custid=c.id 
where p.paymentstatus=1 and c.custstatus=0 and 
c.date < '".date("Y-m-d")."' ".$session." and  c.id not in(select bookingid from providerpay) order by c.id desc");
 
}
if($_SESSION['logintype']=='Provider'){
	$booking = mysqli_query($conn,"Select c.*,b.personname,b.mobile from booking as c 
inner join customer as b on b.id=c.custid  
inner join custpayment as p on p.custid=c.id 
inner join providerpay as o on o.bookingid=c.id
where p.paymentstatus=1 and c.custstatus=0 and 
c.date < '".date("Y-m-d")."' and o.providerid='".$_SESSION['unqid']."' and c.booktype='".$_SESSION['regas']."' order by c.id desc");
}
while($result = mysqli_fetch_assoc($booking)){
			array_push($array,array("id"=>$result['id'],"personname"=>$result['personname'],"mobile"=>$result['mobile'],"zone"=>$result['zone'],"place"=>$result['place'],
			"time"=>$result['time'],"date"=>$result['date'],"seat"=>$result['seat'],"created_at"=>$result['created_at'],"show"=>0,"cstatus"=>$result['custstatus'],
			"refundstatus"=>$result['refundstatus'],"refundstatus1"=>$result['refundstatus1'],"desti"=>$result['desti'],"btype"=>$result['booktype']));
		
		
}
echo json_encode($array);
?>