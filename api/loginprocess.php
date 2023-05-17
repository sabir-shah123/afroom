<?php 
include('db.php');
/*$fields = array(
    "Param1" => "6137072a833fd47982727a63",
    "Param2" => $_POST['mobile'],
	"Param3" => "342273AYvWx7WxQ5f683daeP1",
);
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.msg91.com/api/v5/otp?template_id=6137072a833fd47982727a63&mobile=".$_POST['mobile']."&authkey=342273AYvWx7WxQ5f683daeP1",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/JSON"
  ],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);*/
$check = mysqli_query($conn,"Select count(id) as id from providers where mobile='".$_POST['mobile']."'");
$fetch = mysqli_fetch_assoc($check);
if($fetch['id']==0){
	$query = mysqli_query($conn,"INSERT into providers (mobile) Values('".$_POST['mobile']."')");
	echo "0";
}else{
	echo "1";
}
$_SESSION['mobile'] = $_POST['mobile'];
$_SESSION['logintype']='Provider';

?>