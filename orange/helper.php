<?php

require_once '../api/db.php';

global $types,$is_orange_sandbox;
$is_orange_sandbox=false;
$types = ['cust'=>'custpayment','prov'=>'providerpay'];
$sk_success = 'V3w23e*_sucess';
$sk_cancel = 'L_@34_cancel';

//orange api call

function getAuthToken()
{
    global $is_orange_sandbox;
    $is_sandbox = $is_orange_sandbox;
    $url = "https://api" . ($is_sandbox ? ".sandbox" : "") . ".orange-sonatel.com/oauth/token";
    $client_id= $is_sandbox ? '4f67c2cd-aa35-4a13-9fae-7a80cc8a1758' : '3730872c-71e8-4761-a1c0-f5a5030ddd56';
    $client_secret= $is_sandbox ? '10190003-2bc4-4498-8299-f30969a4d779' : 'a6c0df26-0e62-479a-be23-aa89c0cc86e0';

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => 'client_id=' . urlencode($client_id) . '&client_secret=' . urlencode($client_secret) . '&grant_type=client_credentials',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);

    $accessToken = '';
    $refreshToken = '';
    if ($response && property_exists($response, 'access_token')) {
        $accessToken = $response->access_token;
        $refreshToken = $response->refresh_token;
    }

    /*
  its return array of access_token and refresh_token
  you can save the refresh token and can grab the new access token when needed or you can just let the system work as it is and get new access token everytime
    */

    return [
        "access_token" => $accessToken,
        "refresh_token" => $refreshToken
    ];
}

function orangeApiCall($endpoint, $method = 'GET', $data = '', $headers = [], $json = false)
{
    $accessToken = '';
    global $is_orange_sandbox;
    $token = getAuthToken();
    if ($token && isset($token['access_token'])) {
        $accessToken = $token['access_token'];
    }
    if ($accessToken == '') {
        return false; 
    }
    
    $is_sandbox = $is_orange_sandbox;
    $base_url = "https://api" . ($is_sandbox ? ".sandbox" : "") . ".orange-sonatel.com/api/";

    if ($json) {
        if (is_object($data) || is_array($data)) {
            $data = json_encode($data);
        }
    }
    $headers = array();
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    if ($json) {
        $headers[] = 'Content-Type: application/json';
    }

    // dd($base_url . $endpoint, $method, $data, $headers);
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $base_url . $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => $headers,
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);
    return $response;
}


function encrypt_data($plaintext, $secret_key, $algorithm = 'aes-256-cbc')
{
    $iv =openssl_random_pseudo_bytes(openssl_cipher_iv_length($algorithm));
    return openssl_encrypt($plaintext, $algorithm, $secret_key, 0, $iv) . ':' . base64_encode($iv);
}

function decrypt_data($ciphertext, $secret_key, $algorithm = 'aes-256-cbc')
{
    list($encrypted, $iv) = explode(':', $ciphertext);
    $iv = base64_decode($iv);
    return openssl_decrypt($encrypted, $algorithm, $secret_key, 0, $iv);
}


function updatePayStatus($id,$response,$type="cust"){
    
    //save to db here
      global $types,$conn;
      $matchwith=$_POST['matchwith'];
      $check = mysqli_query($conn,"Select * from ".$types[$type]." where ".$matchwith."='". $id."'");
      $check = mysqli_fetch_assoc($check);
      if($check['paymentstatus']==0){
          mysqli_query($conn,"UPDATE ".$types[$type]." set paymentstatus='1' where ".$matchwith."='".$id."'");
          $orderid = $check['orderid'];
          if($type=='cust'){
              include('../api/main_payment_done.php');
          }else{
              //will be work incase we have provider
          }
          
          $back = new \stdClass;
          $back->status=200;
          $back->detail="Payment Done Successfully.";
          $back->transactionId = $response->transactionId;
          return $back;
          
        /*if wallet*/
      }else{
          $back = new \stdClass;
          $back->status=200;
          $back->detail="Payment already done.";
          $back->transactionId = '';
          return $back;
      }
    
    
    return $back;
}
