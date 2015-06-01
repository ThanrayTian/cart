<!--purchase.php-->

<?php
    require_once('order_fcns.php');
    require_once('output_fcns.php');

    session_start();
    do_html_header('Purchase');

    $name=$_POST['name'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $province=$_POST['province'];
    $mailcode=$_POST['mailcode'];
    $phone=$_POST['phone'];

    if($_SESSION['cart'] && $name && $address && $city && $province
    && $mailcode && $phone) {
        if(insert_order($_POST)) {
            display_cart($_SESSION['cart'],false,0);            
            echo "<h3>Purchase successfully!</h3>";
            do_html_url('index.php','Continue Shopping');
        } else {
            //roll back
            echo "Could not store the order 
                - Please go back and try again later<br/>";
            do_html_url('checkout.php','back');
        }
    } else {
        echo "You did not fill in all the fields, please try again.<br/>";
        do_html_url('checkout.php','back');
    }
    do_html_footer();
?>
