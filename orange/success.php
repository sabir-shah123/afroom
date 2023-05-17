<?php
include_once 'helper.php';
if (isset($_REQUEST['id'])) {
    $data = $_REQUEST['id'];
    $data = base64_decode($data);
    $decrypted = decrypt_data($data, $sk_success);
    try {
        $data = explode('_', $decrypted);
        $id = $data[0];
        if (count($data) == 4 && date('Ymd') == $data[2]) {
            //save to db here
              $type =$data[3]; 
              $check = mysqli_query($conn,"Select * from ".$types[$type]." where id='". $id."'");
              $check = mysqli_fetch_assoc($check);
              if($check['paymentstatus']==0){
                  mysqli_query($conn,"UPDATE custpayment set paymentstatus='1' where id='".$id."'");
                  $orderid = $check['orderid'];
                  if($type=='cust'){
                      include('../api/main_payment_done.php');
                  }
                    
		        
		        /*if wallet*/
              }
            die;
        }
    } catch (\Exception $e) {
    }
    echo 'Invalid signature';
}
