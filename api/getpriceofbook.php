<?php
include('db.php');
if($_POST['btype']=='Ride Booking'){
	$query = mysqli_query($conn,"Select amt as amt from bookamt");
}
else if($_POST['btype']=='Plumber'){
	$query = mysqli_query($conn,"Select plumber as amt from bookamt");
}else{
	$query = mysqli_query($conn,"Select fabric as amt from bookamt");
}
$fetch = mysqli_fetch_assoc($query);
echo $fetch['amt'];
?>