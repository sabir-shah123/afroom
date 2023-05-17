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
    exit();
}

$data = [];

$check = mysqli_query($conn, "Select * from providers where mobile='" . $_POST['mobile'] . "'");
$fetch = mysqli_fetch_assoc($check);

//if fetch found, then login
if ($fetch) {
    $data['id'] = $fetch['id'];
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Provider';
} else {
    $insert = mysqli_query($conn, "INSERT into providers (mobile) Values('" . $_POST['mobile'] . "')");
    $data['id'] = mysqli_insert_id($conn);
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Provider';
}

$data['mobile'] = $_POST['mobile'];
$data['logintype'] = 'Provider';

$res = [
    'status' => 1,
    'message' => 'Login Successful',
    'data' => $data,
];

echo json_encode($res);
exit();
