<?php
	/*
		loop through array of $_SESSION['cart'][book_isbn] => number
		get isbn => take from database => take book price
		price * number (quantity)
		return sum of price
	*/
    
    
    function total_price($cart){
        $price = 0.0;
        if(is_array($cart)){
            foreach($cart as $book_id => $quantity){
                $bookprice = getbookprice($book_id);
                if($bookprice){
                    $price += floatval($bookprice) * floatval($quantity);
                }
            }
        }
        ($price); // Debugging output
        return $price;
    }
    
    function total_items($cart){
        $items = 0;
        if(is_array($cart)){
            foreach($cart as $book_id => $quantity){
                $items += floatval($quantity);
            }
        }
        ($items); // Debugging output
        return $items;
    }
    function addToCart($book_id) {
        // Check if the book ID is provided via POST
        if (!isset($book_id)) {
          return;
        }
      
        // Initialize the cart if it doesn't exist
        if (!isset($_SESSION['cart'])) {
          $_SESSION['cart'] = array();
          $_SESSION['total_items'] = 0;
          $_SESSION['total_price'] = 0.00;
        }
      
        // Add the book to the cart or increment its quantity
        if (!isset($_SESSION['cart'][$book_id])) {
          $_SESSION['cart'][$book_id] = 1;
        } else {
          $_SESSION['cart'][$book_id]++;
        }
      
        // Calculate total price and total items
        $_SESSION['total_price'] = total_price($_SESSION['cart']);
        $_SESSION['total_items'] = total_items($_SESSION['cart']);
      }
?>