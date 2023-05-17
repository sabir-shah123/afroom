<?php
include('db.php');
$oldpath = $_FILES['profile']['tmp_name'];
$newpath ="upload/".$_FILES['profile']['name'];
move_uploaded_file($oldpath, $newpath);

$oldpath1 = $_FILES['nationalback']['tmp_name'];
$newpath1 ="upload/".$_FILES['nationalback']['name'];
move_uploaded_file($oldpath1, $newpath1);

$oldpath2 = $_FILES['rc']['tmp_name'];
$newpath2 ="upload/".$_FILES['rc']['name'];
move_uploaded_file($oldpath2, $newpath2);

$oldpath3 = $_FILES['national']['tmp_name'];
$newpath3 ="upload/".$_FILES['national']['name'];
move_uploaded_file($oldpath3, $newpath3);

$update = mysqli_query($conn,"UPDATE providers set name='".$_POST['username']."',gender='".$_POST['gender']."',country='".$_POST['country']."',city='".$_POST['city']."',
profile='".$newpath."',refferalcode='".$_POST['code']."',wallet='1000',nationalid='".$newpath3."',natback='".$newpath1."',license='".$newpath."',rc='".$newpath2."',
regas='".$_POST['regas']."' where mobile='".$_POST['id']."'");
header('location:../dashboard.php');
?>