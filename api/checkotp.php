<?php 
include('db.php');
// echo 1;
// die;
$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.msg91.com/api/v5/otp/verify?otp=".$_POST['otpcode']."&authkey=342273AYvWx7WxQ5f683daeP1&mobile=".$_POST['mobile'],
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
  echo "0";
} else {
  $res =  json_encode(json_decode($response,true));
  $json = json_decode($res, true);
  if($json['message']=='OTP not match'){
  			echo "0";
  }else{
  			echo "1";
  }
}
?>
