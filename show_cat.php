<!--show_cat.php-->

<?php

require_once('output_fcns.php');
require_once('book_fcns.php');

session_start();
//url wrong
if(!isset($_GET['catid'])) {
    header('Location: http://localhost/index.php');
}
$catid = $_GET['catid'];

//wrong catid
$catname = get_category_name($catid);
if(!$catname) {
    header('Location: http://localhost/index.php');
}

do_html_header('Category - ' . $catname);

//books
$book_array = get_books($catid);
display_books($book_array);


do_html_url('index.php','Continue Shopping');
do_html_footer();

?>
