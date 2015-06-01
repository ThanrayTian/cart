<?php

function db_connect() {
    $result = new mysqli('localhost','bs_user','password','bookshop');
    if(!$result) {
        echo mysqli_errno($conn) . ": " . mysqli_error($conn) . "<br/>";
    }
    $result->autocommit(TRUE);
    return $result;
}

function db_query($conn,$query) {
    $result = $conn->query($query);
    if(!$result) {
        echo mysqli_errno() . ": " . mysqli_error() . "<br/>";
    }
    return $result;
}

function db_result_to_array($result) {
    $array = array();
    for ($cnt=0; $row = $result->fetch_assoc(); $cnt++) {
        $array[$cnt] = $row;
    }
    return $array;
}

?>
