<!--show_book.php-->

<?php
    
    require_once('output_fcns.php');
    require_once('book_fcns.php');

    session_start();
    
    if(!isset($_GET['isbn'])) {
        header('Location: http://localhost/index.php');
    }
    $isbn = $_GET['isbn'];
    $book = get_book_details($isbn);
    if(!$book) {
        header('Location: http://localhost/index.php');
    }

    do_html_header($book['title']);
    display_book_details($book);

    $target = 'index.php';
    if($book['catid']) {
        $target = "show_cat.php?catid=" . $book['catid'];
    }
    
    do_html_url("show_cart.php?new=$isbn",'Add to Cart');
    do_html_url($target,'Contine Shopping');
    do_html_footer();

?>
