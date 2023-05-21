<?php
include('db.php');
$array =array();
if($_SESSION['logintype']=='Customer'){
	$query = mysqli_query($conn,"SELECT b.id,b.date,b.type,c.paymentstatus,(b.seat*(select amt from bookamt)) as amount,a.personname,c.paymode,b.custstatus,b.desti,b.time,o.paymode as pay,b.booktype as btype from booking as b 
left join providerpay as c on c.bookingid=b.id
inner join custpayment as o on o.custid=b.id
inner join customer as a on a.id=b.custid
where a.id='".$_SESSION['unqid']."' order by b.id desc");
}else{
	
	$query = mysqli_query($conn,"SELECT b.id,b.date,b.desti as place,b.zone,(b.seat*(select amt from bookamt)) as amount,p.paymentstatus as status,b.custstatus,p.paymode as pay,b.desti,b.time,b.booktype as btype FROM `booking` as b
inner join providerpay as p on p.bookingid=b.id where p.providerid='".$_SESSION['unqid']."' and b.booktype='".$_SESSION['regas']."'  order by b.id desc");
}
while($fetch = mysqli_fetch_assoc($query)){
		array_push($array,$fetch);
}
echo json_encode($array);
?>