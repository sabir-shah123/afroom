<?php

include '../api/db.php';

header('Content-Type: application/json');

// username,gender,country,city,refferalcode,regas are required
$missingVariables = [];

if (!isset($_POST['username'])) {
    $missingVariables[] = 'username';
}

if (!isset($_POST['gender'])) {
    $missingVariables[] = 'gender';
}

if (!isset($_POST['country'])) {
    $missingVariables[] = 'country';
}

if (!isset($_POST['city'])) {
    $missingVariables[] = 'city';
}

if (!isset($_POST['code'])) {
    $missingVariables[] = 'code';
}

if (!isset($_POST['regas'])) {
    $missingVariables[] = 'regas';
}

if (!isset($_POST['mobile']) ) {
    $missingVariables[] = 'mobile';
}

if (!empty($missingVariables)) {
    $res = [
        'status' => 0,
        'message' => 'Missing required fields: ' . implode(', ', $missingVariables),
    ];

    echo json_encode($res);
    exit();
}

//all field are okay, now update the profile

$update = mysqli_query($conn, "UPDATE providers set name='" . $_POST['username'] . "',gender='" . $_POST['gender'] . "',country='" . $_POST['country'] . "',city='" . $_POST['city'] . "',refferalcode='" . $_POST['code'] . "',wallet='1000',
regas='" . $_POST['regas'] . "' where mobile='" . $_POST['mobile'] . "'");

if ($update) {
    $res = [
        'status' => 1,
        'message' => 'Profile updated successfully',
    ];
} else {
    $res = [
        'status' => 0,
        'message' => 'Error updating profile',
    ];
}

echo json_encode($res);
exit();
