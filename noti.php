<?php include('header.php');
if(isset($_GET['id'])){
$update = mysqli_query($conn,"UPDATE noti set status=1 where id='".$_GET['id']."'");	
header('location:notification.php');
}
?>