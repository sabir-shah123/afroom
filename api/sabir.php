<?php
$host = 'localhost';
$dbname = 'thealiens_afroonlock';
$username = 'root';
$password = '';

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully!";
}
?>
