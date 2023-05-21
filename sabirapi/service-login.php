<?php
include '../api/db.php';
include 'helper.php';
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

$token = generateToken(50);
$data = [];

$check = mysqli_query($conn, "Select * from providers where mobile='" . $_POST['mobile'] . "'");
$fetch = mysqli_fetch_assoc($check);

//if fetch found, then login
if ($fetch) {
    $data['id'] = $fetch['id'];
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Provider';
    $_SESSION['unqid'] = $fetch['id'];
    $_SESSION['regas'] = $fetch['regas'];
} else {
    $insert = mysqli_query($conn, "INSERT into providers (mobile) Values('" . $_POST['mobile'] . "')");
    $data['id'] = mysqli_insert_id($conn);
    $_SESSION['mobile'] = $_POST['mobile'];
    $_SESSION['logintype'] = 'Provider';
    $_SESSION['unqid'] = mysqli_insert_id($conn);
}

$data['mobile'] = $_POST['mobile'];
$data['logintype'] = 'Provider';

save_token($_SESSION['unqid'], $token, $conn);

$res = [
    'status' => 1,
    'message' => 'Login Successful',
    'token' => base64_encode($token),
];

echo json_encode($res);
exit();
