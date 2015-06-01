<!--output_fcns.php-->

<?php

function do_html_header($str) {
    echo "<h2>$str</h2>";
}

function do_html_footer() {
    echo "<br/>";
}

function do_html_url($url,$name) {
    echo "<a href=\"$url\">$name</a>"."&nbsp&nbsp";
}

function display_book_categories($categories) {

    if(!is_array($categories)) {
        echo "No categories currently avaliable<br/>";
        return;
    }
    echo "<ul>";
    foreach ($categories as $row) {
        echo "<li>";
        do_html_url("show_cat.php?catid=".$row['catid'],$row['catname']);
        echo "</li>";
    }
    echo "</ul>";
    echo "<hr/>";
}

function display_books($book_array) {
    if(!is_array($book_array)) {
        echo "No books in this category avaliable<br/>";
        return ;
    }
    echo "<ul>";
    foreach ($book_array as $row) {
        echo "<li>";
        echo "title: <a href='show_book.php?isbn=".$row['isbn']."'>"
            .$row['title']."</a><br/>";
        echo "author: ".$row['author']."<br/>";
        echo "price: ".$row['price']."<br/>";
        echo "</li>"; 
    }
    echo "</ul>";
    echo "<hr/>";
}

function display_book_details($book) {
    
    if(!is_array($book)) {
        echo "No description for the book avalibale<br/>";
        return; 
    }
    echo "author: ".$book['author']."<br/>";
    echo "price: ".$row['price']."<br/>";
    echo "isbn: ".$row['isbn']."<br/>";
    echo "description: ".$row['description']."<br/>";
    
}

function display_cart($cart,$change=true,$image=1) {

    echo "<table border='0' width='100%' cellspacing='0'>
          <form action='show_cart.php' method='post'>
          <tr><th colspan='".($image+1)."' bgcolor='#cccccc'>Item</th>
          <th bgcolor='#cccccc'>Price</th>
          <th bgcolor='#cccccc'>Quantity</th>
          <th bgcolor='#cccccc'>Total</th>
          </tr>";
    
    foreach ($cart as $isbn=>$qty) {
        $detail = get_book_details($isbn);
        echo "<tr>"; 
        //若images=1则colspan=2即一个th对应需要写两个<td>
        if($images == true) {
            echo "<td algin='left'>";
            if(file_exists("images/".$isbn.".jpg")) {
                $size = GetImageSize("images/".$isbn.".jpg");
                if($size[0]>0 && $size[1]>0) {
                    echo "<img src='images/'$isbn.jpg'
                            style='border: 1px solid black' 
                            width='".($size[0]/3)."' 
                            height='".($zie[1]/3)."'/>";
                }
            } else {
                echo "&nbsp";
            }
            echo "</td>";
        }  
        echo "<td algin'left'>
              <a href='show_book.php?isbn=$isbn'>".$detail['title']."</a> by "
              .$detail['author']."</td>
              <td algin='center'>\$".number_format($detail['price'],2)."</td>
              <td algin='center'>"; 
        if($change) {
            echo "<input type='text' name=$isbn value=$qty size='3'>";
        } else {
            echo $qty;
        }
        echo "</td>
              <td algin='center'>".number_format($detail['price']*$qty,2)."</td>
              </tr>\n";
    }
    
    echo "<tr>
          <th colspan=".($images+2)." bgcolor='#cccccc'>&nbsp;</th>
          <th bgcolor='#cccccc'>".$_SESSION['items']."</th>
          <th bgcolor='#cccccc'>".number_format($_SESSION['total_price'])."</th>
          </tr>";

    if($change) {
        echo "<tr>
              <td colspan='".($images+2)."'>&nbsp;</td>
              <td algin='center'>
              <input type='hidden' name='save' value='true'/>
              <input type='submit' value='Save Change'/>
              </td>
              <td>&nbsp;</td>";
    }
    echo "</form></table>";

}

function display_checkout_form() {

    echo "<br/>";
    echo "<table>
          <form action='purchase.php' method='post'>
          <tr><th algin='center' colspan='2' bgcolor='#cccccc'>Your Detials
              </th></tr>
          <tr><td algin='left'>Name</td>
              <td><input type='text' algin='center' name='name'/></td></tr>
          <tr><td algin='left'>Address</td>
              <td><input type='text' algin='center' name='address'/></td></tr>
          <tr><td algin='left'>City/Suburb</td>
              <td><input type='text' algin='center' name='city'/></td></tr>
          <tr><td algin='left'>Province</td>
              <td><input type='text' algin='center' name='province'/></td></tr>
          <tr><td algin='left'>Phone</td>
              <td><input type='text' algin='center' name='phone'/></td></tr>
          <tr><td algin='left'>Postal Code</td>
              <td><input type='text' algin='center' name='mailcode'/></td></tr>";
              
          //Shipping Details
    echo "<tr><td colspan='2'>Shipping Address (leave blank if as above)</td></tr>
          <tr><td algin='left'>Name</td>
              <td><input type='text' algin='center' name='ship_name'/></td></tr>
          <tr><td algin='left'>Address</td>
              <td><input type='text' algin='center' name='ship_address'/></td></tr>
          <tr><td algin='left'>City/Suburb</td>
              <td><input type='text' algin='center' name='ship_city'/></td></tr>
          <tr><td algin='left'>Province</td>
              <td><input type='text' algin='center' name='ship_province'/></td></tr>
          <tr><td algin='left'>Phone</td>
              <td><input type='text' algin='center' name='ship_phone'/></td></tr>
          <tr><td algin='left'>Postal Code</td>
              <td><input type='text' algin='center' name='ship_mialcode'/></td></tr>";

    echo "<tr><td colspan='2' align='center'>
          <input type='submit' value='Purchase'/>
          </td></tr>
          </form></table>";

}

?>
