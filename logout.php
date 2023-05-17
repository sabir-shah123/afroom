<?php
session_start();
unset($_SESSION["mobile"]);
unset($_SESSION["logintype"]);
unset($_SESSION["unqid"]);
unset($_SESSION['name']);
header("Location:index.php");
?>