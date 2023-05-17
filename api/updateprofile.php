<?php 
include('db.php');
if($_POST['tt']=='Cust'){
	$oldpath = $_FILES['front']['tmp_name'];
	$newpath ="upload/".$_FILES['front']['name'];
	move_uploaded_file($oldpath, $newpath);

	$oldpath1 = $_FILES['back']['tmp_name'];
	$newpath1 ="upload/".$_FILES['back']['name'];
	move_uploaded_file($oldpath1, $newpath1);

	$update = mysqli_query($conn,"Update customer set personname='".$_POST['name']."',mobile='".$_POST['mobile']."',nationalid='".$newpath."',natback='".$newpath1."' where id='".$_POST['id']."'");
}else{
	$update = mysqli_query($conn,"Update providers set name='".$_POST['name']."',mobile='".$_POST['mobile']."' where id='".$_POST['id']."'");
}
header('location:../profile.php');
?>
