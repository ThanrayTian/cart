<!--index.php-->

<?php

require_once('output_fcns.php');
require_once('book_fcns.php');

session_start();

//header
do_html_header('Welcome to Thanray BookShop');

//view cart url
do_html_url('show_cart.php','view my cart');
echo "<br/>";

//show categories
echo "<p>Please choose a category:</p>";
$categories = get_categories();
display_book_categories($categories);

//footer
do_html_footer();

?>
