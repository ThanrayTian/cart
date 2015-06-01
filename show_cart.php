<!--show_cart.php-->

<?php

    require_once('output_fcns.php');
    require_once('book_fcns.php');

    session_start();

    @$new = $_GET['new'];

    if(!$new) {
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart']=array();
            $_SESSION['items']=0;
            $_SESSION['total_price']=0.0;
        }
        if( isset($_SESSION['cart'][$new]) ) {
            $_SESSION['cart'][$new]++;
        } 
        else 
        {
            $_SESSION['cart'][$new]=1;
        }
        
        $_SESSION['items'] = calculate_cart_items($_SESSION['cart']);
        $_SESSION['total_price'] = calculate_cart_price($_SESSION['cart']);

    }

    if(isset(_POST['save'])) {
        foreach ($_SESSION['cart'] as $isbn=>$qty) {
            if($_POST[$isbn]=='0') {
                unset($_SESSION['cart'][$isbn]);
            } else {
                $_SESSION['cart'][$isbn] = $_POST[$isbn];
            }
        }
        $_SESSION['items'] = calculate_cart_items($_SESSION['cart']);
        $_SESSION['total_price'] = calculate_cart_price($_SESSION['cart']);
    }

    do_html_header('Your Shopping Cart');
    if(isset($_SESSION['cart']) && array_count_values($_SESSION['cart'])) {
        display_cart($_SESSION['cart']);
    } else {
        echo "No item in your shopping cart<br/>";
    }

    $target = "index.php";
    
    if($new) {
        $book = get_book_details($new);
        if($book) {
            $target = "show_cat.php?catid=".$book['catid'];
        }
    }

    do_html_url($target,'Continue to shopping');
    do_html_url('checkout.php','Go To Checkout');
    do_html_footer();
    
?>
