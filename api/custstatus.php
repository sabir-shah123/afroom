<?php 
include('db.php');
$update = mysqli_query($conn,"Update booking set custstatus=1 where id='".$request->bookid."'");
if($update){
  		echo "1";
		$pre = mysqli_query($conn,"Select * from prefixs order by id desc limit 1");
		$fetch = mysqli_fetch_assoc($pre);
		$pro = mysqli_query($conn,"SELECT a.mobile,p.providerid FROM providerpay as p  inner join providers as a on a.id=p.providerid where p.bookingid='".$request->bookid."'");
		$fetchp = mysqli_fetch_assoc($pro);
		
		$curl = curl_init();
		$message = "Customer Has Accepted Your Request";
		mysqli_query($conn,"INSERT into noti Values(0,'".$message."','".$fetchp['providerid']."','0','PROVIDER',now(),'0','0')");
$fields = array(
    "flow_id" => "63a97190b45ef716a54083b5",
    "sender" => "EGPLDP",
	"short_url" => "",
	"mobiles" => $fetch['prefix'].$fetchp['mobile'],
	"VAR1" => "You Have New Booking Requests Please Login Portal And Accept Your Booking ",
	"VAR2" => "",
);
curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.msg91.com/api/v5/flow/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => [
    "authkey: 342273AYvWx7WxQ5f683daeP1",
    "content-type: application/json"
  ],
]);
$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

  	}else{
  		echo "0";
}
?>
