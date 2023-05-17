<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.sandbox.orange-sonatel.com/oauth/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=4decc7b2-0055-44b5-9040-e57686d61076&client_secret=d1eacf15-61cf-46c4-809a-722db9f1ba2e&grant_type=client_credentials");

$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
print_r($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
?>
