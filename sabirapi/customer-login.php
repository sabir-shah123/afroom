<?php

include '../api/db.php';
header('Content-Type: application/json');

//mobile is required and must be 10 digit
if (!isset($_POST['mobile']) || strlen($_POST['mobile']) != 10) {
    $res = [
        'status' => 0,
        'message' => 'Mobile is required and must be 10 digit',
        'data' => [],
    ];

    echo json_encode($res);
    exit;
}

$check = mysqli_query($conn, "Select * from customer where mobile='" . $_POST['mobile'] . "'");
$fetch = mysqli_fetch_assoc($check);
if (!$fetch) {
    $insert = mysqli_query($conn, "INSERT into customer (mobile) Values('" . $_POST['mobile'] . "')");
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Customer';
    $_SESSION['unqid'] = mysqli_insert_id($conn);
} else {
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Customer';
    $_SESSION['unqid'] = $fetch['id'];
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
