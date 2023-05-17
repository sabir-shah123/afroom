<?php

include 'helper.php';
 
  $type= $_POST['type']??null;
  if(!$type){
      die;
  }
  
 
  
  $trans_id = $_POST['order_id'];
  $check = mysqli_query($conn,"Select * from ".$types[$type]." where id='".$_POST['order_id']."'");
$fetchbal = mysqli_fetch_assoc($check);
$amount =$fetchbal['amount'] ??0;
if(isset($_POST['status'])){
    $status  =$fetchbal['paymentstatus'] ??0;
    echo $status;
    exit;
}
//   $data = $trans_id.'_'.time().'_'.date('Ymd').'_'.$type;
        // $successData = encrypt_data($data, $sk_success);

       
        //transactionId_currenttime()
        // $cancelData = encrypt_data($data, $sk_cancel);
       
$mainurl='http://afroom.aliensera.in/orange/';
 $accountEndPoint = 'eWallet/v1/payments/onestep';//'eWallet/v4/qrcode';
        //$data = new stdClass;
        // $data->amount = new stdClass;
        // $data->metadata = new stdClass;
        // $data->amount->unit = 'XOF';
        // $data->amount->value = $amount;
        // $data->callbackCancelUrl = $mainurl.'cancel.php?id='.base64_encode($cancelData);
        // $data->callbackSuccessUrl =$mainurl.'success.php?id='.base64_encode($successData);
        // $data->code = 123456;
        // $data->name = "Zahid";
        // $data->validity = 15;
        
        /*
           this is the new endpoint
           
        */
        
        $data = array(
            'amount' => array(
                'unit' => 'XOF',
                'value' => $amount
            ), 
            'customer' => array(
                'id' => $_POST['o_phone'], 
                'idType' => 'MSISDN',  
                'otp' => $_POST['o_otp'] 
            ),
            'partner' => array(
                'id' => '494260',
                'idType' => 'CODE'
            )
        );
        
        $obj = (object) $data;
        echo $obj;
        die();
    //   return response()->json($obj);
       
        

        
      
        //echo json_encode($data);
        $response = orangeApiCall($accountEndPoint, 'POST', $data, [], true);
       
        // $data->qrCode = '';
        // $result = new stdClass;
        //     $result->status=false;
        //      $result->unit = $data->amount->unit ;
        // $result->value = $data->amount->value ;
        // if ($response && property_exists($response, 'qrCode')) {
           
        //     $result->status=true;
        //     $result->qrCode = $response->qrCode;
           
            
            
        // }
        
        
        // $result->qrCode = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data='.$data->callbackSuccessUrl;
        $d = json_encode($response);
        
        echo $d;