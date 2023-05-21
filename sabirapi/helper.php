<?php

function checkLogin($token, $conn)
{
    if (!isset($_SESSION['unqid']) || !isset($_SESSION['logintype']) || !in_array($_SESSION['logintype'], ['Customer', 'Provider'])) {
        session_abort();
        return [
            'message' => 'You are not logged in',
        ];
    }

    $user_id = $_SESSION['unqid'];
    $type = $_SESSION['logintype'];
    $token = str_replace('Bearer ', '', $token);
    $token = base64_decode($token);
    $token = mysqli_real_escape_string($conn, $token);
    $check = mysqli_query($conn, "SELECT * FROM auth_tokens WHERE user_id = '$user_id' AND token = '$token' AND type = '$type'");
    if (mysqli_num_rows($check) == 0) {
        session_abort();
        $res = [
            'message' => 'Bearer token is invalid',
        ];
        echo json_encode($res);
        exit();
    }
    return true;
}

function generateToken($length)
{
    $bytes = random_bytes($length / 2); // Generate random bytes (half the length because each byte is represented by two hexadecimal characters)
    $uniqueId = bin2hex($bytes); // Convert bytes to hexadecimal string
    return $uniqueId;

}

function save_token($user_id, $token, $conn)
{
    $user_id = mysqli_real_escape_string($conn, $user_id);
    $token = mysqli_real_escape_string($conn, $token);
    $type = $_SESSION['logintype'];
    $query = "SELECT * FROM auth_tokens WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        $updateQuery = "UPDATE auth_tokens SET token = '$token' WHERE user_id = '$user_id' AND type = '$type'";
        mysqli_query($conn, $updateQuery);
    } else {
        $insertQuery = "INSERT INTO auth_tokens (user_id, token, type) VALUES ('$user_id', '$token', '$type')";
        mysqli_query($conn, $insertQuery);
    }

    return true;
}
