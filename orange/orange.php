<?php

include 'helper.php';
 
 $post = $_POST;

 if(count($post)==0){
     $data = file_get_contents('php://input');
     $data = json_decode($data,true);
     if(count($data)>0){
         $_POST = $data;
     }
 }
 
 
// Check if the required POST parameters are set
if (!isset($_POST['type'], $_POST['order_id'], $_POST['o_phone'], $_POST['o_otp'])) {
    echo 'Invalid Request Data';
    die;
}
if(!isset($_POST['o_phone']) || empty($_POST['o_phone']) || !isset($_POST['o_otp']) || empty($_POST['o_otp'])){
    echo json_encode([
        'status'=>400,
        'detail'=>"Phone number and otp required",
        'code'=>24
        ]);
        die;
}

$type = $_POST['type'];
$order_id = $_POST['order_id'];
$o_phone = $_POST['o_phone'];
$o_otp = $_POST['o_otp'];

// Get the transaction amount from the database
$matchwith = $type == 'cust' ? 'id':"orderid";
$_POST['matchwith'] = $matchwith;
$check = mysqli_query($conn, "SELECT * FROM " . $types[$type] . " WHERE ".$matchwith." = '$order_id'");
$fetchbal = mysqli_fetch_assoc($check);
$amount = $fetchbal['amount'] ?? 0;

// Check if the 'status' parameter is set, and return the payment status if it is
if (isset($_POST['status'])) {
    $status = $fetchbal['paymentstatus'] ?? 0;
    echo $status;
    exit;
}

// Build the request data for the Orange API

// $live ="494260";
$merchant = $is_orange_sandbox ? '485423':'494260';
$data = array(
    'amount' => array(
        'unit' => 'XOF',
        'value' => $amount
    ),
    'customer' => array(
        'id' => $o_phone,
        'idType' => 'MSISDN',
        'otp' => $o_otp
    ),
    
    
    'partner' => array(
        'id' => $merchant,//'494260',
        'idType' => 'CODE'
    )
);

// Make the API call using the orangeApiCall function from helper.php
$accountEndPoint = 'eWallet/v1/payments/onestep';
$response = orangeApiCall($accountEndPoint, 'POST', $data, [], true);

// Return the API response to the AJAX success function
    // $d = updatePayStatus($order_id,$response,$type);
   if(property_exists($response,'reference') && $response->status == 'SUCCESS'){
         $d = updatePayStatus($order_id,$response,$type);
         echo json_encode($d);
   }else{
    //   echo $d;
      echo json_encode($response);
   }
