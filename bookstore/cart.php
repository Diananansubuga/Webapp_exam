<?php
    // Start the session
    session_start();

    // Include necessary files
    require_once "database_functions.php";
    require_once "cart_functions.php";

    // Check if a book ID is provided via POST
    if(isset($_POST['book_id'])){
        $book_id = $_POST['book_id'];
    }

    if(isset($book_id)){
        // Initialize the cart if it doesn't exist
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = array();
            $_SESSION['total_items'] = 0;
            $_SESSION['total_price'] = '0.00';
        }

        // Add the book to the cart or increment its quantity
        if(!isset($_SESSION['cart'][$book_id])){
            $_SESSION['cart'][$book_id] = 1;
        } elseif(isset($_POST['cart'])){
            $_SESSION['cart'][$book_id]++;
            unset($_POST);
        }
    }

    // Handle saving changes to cart quantities
    if(isset($_POST['save_change'])){
        foreach($_SESSION['cart'] as $book_id =>$quantity){
            if(isset($_POST[$book_id]) && $_POST[$book_id] == '0'){
                unset($_SESSION['cart'][$book_id]);
            } elseif(isset($_POST[$book_id])) {
                $_SESSION['cart'][$book_id] = $_POST[$book_id];
            }
        }
    }

    // Handle deleting items from the cart
    if(isset($_POST['delete'])){
        $delete_book_id = $_POST['delete'];
        unset($_SESSION['cart'][$delete_book_id]);
    }

    // Include header
    $title = "Your shopping cart";
    require "header.php";
?>

<!-- Cart List HTML -->
<h4 class="fw-bolder text-center">Cart List</h4>
<center>
  <hr class="bg-warning" style="width:5em;height:3px;opacity:1">
</center>
<?php
    if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
        $_SESSION['total_price'] = total_price($_SESSION['cart']);
        $_SESSION['total_items'] = total_items($_SESSION['cart']);
?>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="cart.css">
    <head>
    <div class="card rounded-0 shadow">
        <div class="card-body">
            <div class="container-fluid">
                <form action="cart.php" method="post" id="cart-form">
                    <table class="table">
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Delete</th>
                        </tr>
                        <?php
                            // Iterate through each item in the cart
                            foreach($_SESSION['cart'] as $book_id => $quantity){
                                $conn = db_connect();
                                $book = mysqli_fetch_assoc(getBookById($conn, $book_id));
                                if($book){ // Check if book exists
                        ?>
                        <tr>
                            <td><?php echo $book['title'] . " by " . $book['author']; ?></td>
                            <td><?php echo "$" . $book['price']; ?></td>
                            <td><input type="text" value="<?php echo $quantity; ?>" size="5" name="<?php echo $book_id; ?>"></td>
                            <td><?php echo "$" . floatval($quantity) * $book['price']; ?></td>
                            <td>
                                <button type="submit" class="btn btn-danger btn-sm" name="delete" value="<?php echo $book_id; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php 
                                }
                            }
                        ?>
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th><?php echo $_SESSION['total_items']; ?></th>
                            <th><?php echo "$" . $_SESSION['total_price']; ?></th>
                            <td>&nbsp;</td> <!-- Empty cell for alignment -->
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="card-footer text-end">
            <input type="submit" class="btn btn-primary rounded-0" name="save_change" value="Save Changes" form="cart-form">
            <a href="checkout.php" class="btn btn-dark rounded-0">Go To Checkout</a> 
            <a href="books.php" class="btn btn-warning rounded-0">Continue Shopping</a>
        </div>
<?php
    } else {
        // If cart is empty, display a message
?>
    <div class="alert alert-warning rounded-0">Your cart is empty! Please add at least 1 book to purchase first.</div>
<?php
    }
    // Close database connection
    if(isset($conn)){ mysqli_close($conn); }
    // Include footer
    require_once "footer.php";
?>
