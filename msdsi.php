<?php
$ch = curl_init();
$data ="{'mc_claims':{'device_msisdn':'+919866895180'}";
curl_setopt($ch, CURLOPT_URL, 'https://api.orange.com/msisdnverify/match/fr/v1/msisdn_verify');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

curl_setopt($ch, CURLOPT_POSTFIELDS,$data);

$headers = array();
$headers[] = 'Authorization: Bearer MFkwEwYHKoZIzj0CAQYIKoZIzj0DAQcDQgAEIsFro6K+IUxRr4yFTOTO+kFCCEvHo7B9IOMLxah6c977oFzX\/beObH4a9OfosMHmft3JJZ6B3xpjIb8kduK4\/A==';
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
print_r($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>