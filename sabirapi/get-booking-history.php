<?php

include '../api/db.php';
include 'helper.php';
include 'auth.php';
header('Content-Type: application/json');


$array = array();
if ($_SESSION['logintype'] == 'Customer') {
    $query = mysqli_query($conn, "SELECT b.id, b.date, b.type, c.paymentstatus, (b.seat * (SELECT amt FROM bookamt)) AS amount, a.personname, c.paymode, b.custstatus, b.desti, b.time, o.paymode AS pay, b.booktype
        FROM booking AS b
        LEFT JOIN providerpay AS c ON c.bookingid = b.id
        INNER JOIN custpayment AS o ON o.custid = b.id
        INNER JOIN customer AS a ON a.id = b.custid
        WHERE a.id = '" . $_SESSION['unqid'] . "' ORDER BY b.id DESC");
} else {
    $query = mysqli_query($conn, "SELECT b.id, b.date, b.desti AS place, b.zone, (b.seat * (SELECT amt FROM bookamt)) AS amount, p.paymentstatus AS status, b.custstatus, p.paymode AS pay, b.desti, b.time
        FROM booking AS b
        INNER JOIN providerpay AS p ON p.bookingid = b.id
        WHERE p.providerid = '" . $_SESSION['unqid'] . "' AND b.booktype = '" . $_SESSION['regas'] . "' ORDER BY b.id DESC");
}

while ($fetch = mysqli_fetch_assoc($query)) {
    array_push($array, $fetch);
}

$res = [
    'status' => 1,
    'message' => 'Booking History',
    'data' => $array,
];

echo json_encode($res);
