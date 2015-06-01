<!--checkout.php-->


<?php

require_once('output_fcns.php');
require_once('book_fcns.php');

session_start();

do_html_header('Checkout');
if($_SESSION['cart'] && array_count_values($_SESSION['cart'])) {
    display_cart($_SESSION['cart'],false,0);
    display_checkout_form();
} else {
    echo "There are no items in your cart<br/>";
}

do_html_url('index.php','Continue Shopping');
do_html_footer();

?>
