<?php
// get header Authorization
$headers = apache_request_headers();
$token = $headers['Authorization'] ?? null;

if ($token == null || $token == '' || empty($token)) {
    http_response_code(401);
    $res = [
        'message' => 'Bearer token  not found',
    ];
    echo json_encode($res);
    exit();
}

$log_check = checkLogin($token, $conn);

if (!$log_check && isset($log_check['message'])) {
    http_response_code(401);
    $res = [
        'message' => 'Invalid token',
    ];
    echo json_encode($res);
    exit();
}

