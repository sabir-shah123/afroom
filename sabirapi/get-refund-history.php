<?php

include '../api/db.php';
header('Content-Type: application/json');
include 'helper.php';
include 'auth.php';


$array = array();
if ($_SESSION['logintype'] == 'Customer') {

    $query = mysqli_query($conn, "Select a.*,a.seat*(Select amt from bookamt limit 1) as amount from booking as a inner join custpayment as c on c.custid=a.id where  a.custid='" . $_SESSION['unqid'] . "' and a.refundstatus=1 and a.id not in(Select bookingid from providerpay) order by a.id desc");
} else {
    $query = mysqli_query($conn, "SELECT c.*,c.seat*(Select pamt from bookamt limit 1) as amount,c.booktype FROM `providerpay` as b
inner join booking as c on c.id=b.bookingid
where b.providerid='" . $_SESSION['unqid'] . "' and c.refundstatus1=1 and custstatus=0 and c.booktype='" . $_SESSION['regas'] . "'  order by c.id desc");
}
while ($fetch = mysqli_fetch_assoc($query)) {
    array_push($array, $fetch);
}

$res = [
	'status' => 1,
	'message' => 'Refund History',
	'data' => $array,
];

echo json_encode($res);
?>
