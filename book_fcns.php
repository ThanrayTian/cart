<!--book_fcns.php-->

<?php

require_once('db_fcns.php');

function get_categories() {
    
    $conn = db_connect();
    $query = "select catid catname from categories";
    $result = @$conn->query($query);    //here @ the error when $conn=false

    if(!$result || $result->num_rows == 0 ) {    
        return false;
    }  
    $array = db_result_to_array($result);
    return $array;
}

function get_category_name($catid) {
    $conn = db_connect();
    $query = "select catname from categories 
        where catid='$catid'";
    $result = @$conn->query($query);

    if(!$result || $result->num_rows == 0) {
        return false;
    }
    $row = $result->fetch_object();
    return $row->catename;
}

function get_books($catid) {
    $conn = db_connect();
    $query = "select isbn,title,author,price from book where catid='$catid'";
    $result = @$conn->query($query);

    if(!$result || $result->num_rows == 0) {
        return false;
    }
    $array = db_result_to_array($result);
    return $array;
}

function get_book_details($isbn) {
    $conn = db_connect();
    $query = "select * from book where isbn='$isbn'";
    $result = @$conn->query($query);

    if(!$result || $result->num_rows == 0) {
        return false;
    }
    $array = db_result_to_array($result);
    return $array;
}

function calculate_cart_items($array) {
    
    $items = 0;
    if(is_array($array)) { 
        foreach ($array as $isbn=>$qty) {
            $items += $qty;
        }
    }
    return $items;
}

function get_book_price($isbn) {
    $conn = db_connect();
    $query = "select price from book where isbn='$isbn'";
    $result = @$conn->query($query);

    if(!$result || $result->num_rows == 0) {
        return false;
    }
    $price = $result->fetch_object()->price;
    return $price;
}

function calculate_cart_price($array) {
    $total_price=0.0;
    if(is_array($array)) {
        foreach ($array as $isbn=>$qty) {
            $price = get_book_price($isbn);
            $total_price += $price*$qty;
        }
    }
    return $total_price;
}

?>
