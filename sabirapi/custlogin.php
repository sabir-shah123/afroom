<?php

include '../api/db.php';
$check = mysqli_query($conn, "Select count(id) as id from customer where mobile='" . $_POST['mobile'] . "'");
$fetch = mysqli_fetch_assoc($check);
if ($fetch['id'] == 0) {
    $insert = mysqli_query($conn, "INSERT into customer (mobile) Values('" . $_POST['mobile'] . "')");
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Customer';
} else {
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Customer';
}

$res = [
    'status' => 1,
    'message' => 'Login Successful',
    'data' => [
        'mobile' => $_POST['mobile'],
        'logintype' => 'Customer',
    ],
];

echo json_encode($res);
