<!--order_fcns.php-->

<?php

require_once('db_fcns.php');

function insert_order($order_details) {
    
    extract($order_details);

    if(!$ship_name) {$ship_name=$name;}
    if(!$ship_address) {$ship_address=$address;}
    if(!$ship_city) {$Ship_city=$city;}
    if(!$ship_province) {$ship_province=$province;}
    if(!$ship_phone) {$ship_phone=$phone;}
    if(!$ship_mailcode) {$ship_mailcode=$mailcode;}
    

    $conn=db_connect();
    
    $conn->autocommit(FALSE);

    $query = "select customerid from customers where
            name='$name' and phone='$phone' and address='$address' and
            city='$city' and province='$province' and mailcode='$mailcode'";
    
    $result=@$conn->query($query);
    if(!$result) {
        $conn->rollback();
        return false;
    }
    if($result->num_rows>0) {
        $row = $conn->fetch_object();
        $customerid = $row->customerid;
    } else {
        $query = "insert into customers values
            ('".$name."','".$phone."','".$address."','".$city."','"
            .$province."','".$mailcode."')";
        $result = $conn->query($query);
        if(!$result) {
            $conn->rollback();    
            return false;
        }
        $customerid=$conn->insert_id;
    }
    
    $date = date("Y-m-d");

    //insert order
    $query = "insert into orders values('$customerid','"
        .$_SESSION['total_price']."','$date','$ship_name','$ship_phone',
        ,'$ship_address','$ship_city','$ship_province','$ship_mailcode')";
    $result = $conn->query($query);
    if(!$result) {
        $conn->rollback();
        return false;
    }

    //select orderid
    $orderid = $conn->insert_id;
    
    //insert order_items
    foreach ($_SESSION['cart'] as $isbn=>$qty) {
        $price = get_book_price($isbn);
        $query = "insert into order_items values('$orderid'
            ,'$isbn','$price','$qty')";
        $result = $conn->query($query);
        if(!$result) {
            $conn->roolback();
            return false;
        }
    }
    //commit
    $conn->commmit();
    conn->autocommot(TRUE);

    return TRUE;
}

    

?>
