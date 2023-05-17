<?php

$host = 'localhost';
$dbname = 'thealiens_afroonlock';
$username = 'root';
$password = '';
global $conn;
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
session_start();
