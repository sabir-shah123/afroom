<?php

include '../api/db.php';
include 'helper.php';
$log_check = checkLogin();
if (!$log_check) {
    http_response_code(401);
    echo json_encode([
        'message' => 'Unauthorized',
    ]);
    exit();
}

header('Content-Type: application/json');

if (!isset($_POST['btype'])) {
    $res = [
        'status' => 0,
        'message' => 'Booking type is required',
        'data' => [],
    ];

    echo json_encode($res);
    exit();
}

if ($_POST['btype'] == 'Ride Booking') {
    $query = mysqli_query($conn, "Select amt as amt from bookamt");
} else if ($_POST['btype'] == 'Plumber') {
    $query = mysqli_query($conn, "Select plumber as amt from bookamt");
} else {
    $query = mysqli_query($conn, "Select fabric as amt from bookamt");
}
$fetch = mysqli_fetch_assoc($query);

$res = [
    'status' => 1,
    'message' => 'Price',
    'data' => $fetch,
];

echo json_encode($res);
