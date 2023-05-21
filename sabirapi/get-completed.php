<?php 

 include('../api/db.php');
 include 'helper.php';
include 'auth.php';


 header('Content-Type: application/json');
$array = array();
$session = "";
$session1 = "";

if ($_SESSION['logintype'] == 'Customer') {
    $session = "and c.custid='" . $_SESSION['unqid'] . "'";
} 

if ($_SESSION['logintype'] == 'Provider') {
    $session1 = "and a.providerid='" . $_SESSION['unqid'] . "'";
}

$bookingQuery = "Select c.*,b.personname,b.mobile 
                 from booking as c 
                 inner join customer as b on b.id=c.custid 
                 inner join custpayment as p on p.custid=c.id 
                 inner join providerpay as a on a.bookingid=c.id 
                 where p.paymentstatus=1 and c.custstatus=1 and a.paymentstatus=1 " . $session . " " . $session1 . " 
                 order by c.id desc";

if ($_SESSION['logintype'] != 'Customer') {
    $bookingQuery .= " and c.booktype='" . $_SESSION['regas'] . "'";
}

$booking = mysqli_query($conn, $bookingQuery);

while ($result = mysqli_fetch_assoc($booking)) {
    $checkpay = mysqli_query($conn, "SELECT pp.id,pp.bookingid,p.name,p.mobile 
                                     from providerpay as pp 
                                     left join providers as p on p.id=pp.providerid 
                                     where pp.bookingid='" . $result['id'] . "' and pp.paymentstatus=1");
    $fetchpay = mysqli_fetch_assoc($checkpay);

    if (!empty($fetchpay['id'])) {
        array_push($array, array(
            "id" => $result['id'],
            "personname" => $result['personname'],
            "mobile" => $result['mobile'],
            "zone" => $result['zone'],
            "place" => $result['place'],
            "time" => $result['time'],
            "date" => $result['date'],
            "seat" => $result['seat'],
            "created_at" => $result['created_at'],
            "show" => $fetchpay['id'],
            "providername" => $fetchpay['name'],
            "providermobile" => $fetchpay['mobile'],
            "cstatus" => $result['custstatus'],
            "desti" => $result['desti'],
            "btype" => $result['booktype']
        ));
    } else {
        $checkpay1 = mysqli_query($conn, "SELECT pp.id,pp.bookingid,p.name,p.mobile 
                                          from providerpay as pp 
                                          left join providers as p on p.id=pp.providerid 
                                          where bookingid='" . $result['id'] . "' and paymentstatus=1");
        $fetchpay1 = mysqli_fetch_assoc($checkpay1);

        if (empty($fetchpay1)) {
            array_push($array, array(
                "id" => $result['id'],
                "personname" => $result['personname'],
                "mobile" => $result['mobile'],
                "zone" => $result['zone'],
                "place" => $result['place'],
                "time" => $result['time'],
                "date" => $result['date'],
                "seat" => $result['seat'],
                "created_at" => $result['created_at'],
                "show" => 0,
                "cstatus" => $result['custstatus'],
                "desti" => $result['desti'],
                "btype" => $result['booktype']
            ));
        }
    }
}

echo json_encode($array);
die(    )


?>





