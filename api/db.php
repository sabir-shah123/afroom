<?php
global $conn;
$conn = mysqli_connect("localhost","thealiens_afroonlock","afroonlock@123","thealiens_afroonlock");
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
session_start();

?>