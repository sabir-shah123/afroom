<?php
include_once 'helper.php';


if (isset($_REQUEST['id'])) {
    $data = $_REQUEST['id'];
    $decrypted = decrypt_data($_GET['id'], $sk_cancel);
    try {
        $data = explode('_', $decrypted);
        $id = $data[0];
        if (count($data) == 4 && date('Ymd') == $data[2]) {
            //save to db here
            echo 'Payment Canceled';
            die;
        }
    } catch (\Exception $e) {
    }
    echo 'Invalid signature';
}
