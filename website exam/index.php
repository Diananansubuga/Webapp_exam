<?php
  session_start();
  
  // Include your database connection file
  require_once "conn.php";

  // Fetch user's preferences from the database
  // Replace this with your database connection code
  $connect=new mysqli($server, $user, $pass, $db_name); // Assuming this function establishes the database connection

  // Assume the user ID is retrieved from the login session
  $id = 1; // Replace with the actual user ID

  // Query to fetch user's preferences
  $query = "SELECT preferences FROM userpreferences WHERE id = $id";
  $result = mysqli_query($connect, $query);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      // Fetch preferences from the result
      $row = mysqli_fetch_assoc($result);
      $preferences = $row["preferences"];

      // Query to select three random books based on user's preferences
      $query = "SELECT * FROM books WHERE genre IN ($preferences) ORDER BY RAND() LIMIT 3";
      $result = mysqli_query($conn, $query);

      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          // Output sidebar with recommended books
          echo '<div class="sidebar">';
          echo '<h2>Recommended Books</h2>';
          echo '<ul>';
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<li>' . $row["title"] . '</li>';
          }
          echo '</ul>';
          echo '</div>';
        } else {
          echo "No recommendations found.";
        }
      } else {
        echo "Error fetching recommendations: " . mysqli_error($conn);
      }
    } else {
      echo "User preferences not found.";
    }
  } else {
    echo "Error fetching user preferences: " . mysqli_error($conn);
  }

  // Close connection
   // Assuming this function closes the database connection
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>books</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="index.css">
</head>
<body>
<header>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Your Books</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Books</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
    <!-- Separate container for search and cart -->
    <div class="d-flex">
      <!-- Search Form in Navbar (visible on all screen sizes) -->
      <form action="search.php" method="GET" class="mr-3">
        <input type="text" id="search" name="search" placeholder="Search...">
        <button type="submit">Search</button>
      </form>
      <!-- Cart Icon (visible on all screen sizes) -->
      <a class="nav-link" href="#">
        <span class="badge badge-danger">0</span>
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart" fill="currentColor"
          xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd"
            d="M5.42 11H14a1 1 0 0 0 .993-.883l1-8a1 1 0 0 0-.883-1.117l-12-1A1 1 0 0 0 .14 1.14l-.1.93-1 8a1 1 0 0 0 1.016 1.117L2 10h3.42a2 2 0 1 0 0-4H2a1 1 0 1 0 0 2h1.295l.485 2.91a1 1 0 1 0 1.986.18l-.484-2.91h5.428l-.485 2.91a1 1 0 1 0 1.986.18l-.484-2.91H14a1 1 0 1 0 0-2h-1.42L11.42 1.11a1 1 0 1 0-1.986-.18l.485 2.91H5.499L5.42 11z" />
        </svg>
      </a>
    </div>
  </nav>
</header>


  <div class="content">
  <div class="row">
    <?php
    // Query to fetch book details from the database
    $query = "SELECT * FROM books";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        // Output each book as a card
        echo '<div class="col-md-4">';
        echo '<div class="card">';
        echo '<img src="' . $row["book_img"] . '" class="card-img-top" alt="Book Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["title"] . '</h5>';
        echo '<p class="card-text"><strong>Author:</strong> ' . $row["author"] . '</p>';
        echo '<p class="card-text"><strong>Genre:</strong> ' . $row["genre"] . '</p>';
        echo '<p class="card-text"><strong>Date Published:</strong> ' . $row["date_pub"] . '</p>';
        echo '<p class="card-text"><strong>Price:</strong> $' . $row["price"] . '</p>';
        
        echo '<a href="add_to_cart.php?id=' . $row["book_id"] . '" class="btn btn-success">Add to Cart</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
      }
    } else {
      echo "No books found.";
    }
    ?>
  </div>
</div>

<div class="cart-dropdown">
    <div class="cart-content">
      <table>
        <!-- Table header -->
        <thead>
          <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Action</th> <!-- New column for remove action -->
          </tr>
        </thead>
        <tbody>
          <!-- PHP loop to display items in the cart -->
          <?php foreach ($_SESSION['cart'] as $item): ?>
            <tr>
              <td><?php echo $item['title']; ?></td>
              <td><?php echo $item['price']; ?></td>
              <td><button class="btn btn-danger" onclick="removeFromCart(<?php echo $item['id']; ?>)">Remove</button></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <!-- Table footer -->
      </table>
      <div class="cart-buttons">
        <!-- Button to clear the cart -->
        <button class="btn btn-danger" onclick="clearCart()">Clear Cart</button>
        <!-- Button to continue to checkout -->
        <button class="btn btn-primary" onclick="continueToCheckout()">Continue to Checkout</button>
        <!-- Button to continue browsing -->
        <button class="btn btn-secondary" onclick="continueBrowsing()">Continue Browsing</button>
      </div>
    </div>
  </div>

  <!-- JavaScript code -->
  <script>
    // JavaScript code for cart functionality

    // Function to update the cart icon and badge count
    function updateCartBadge(count) {
      const cartBadge = document.querySelector('.cart-icon .badge');
      if (cartBadge) {
        cartBadge.textContent = count;
      }
    }

    // Function to remove a book from the cart
    function removeFromCart(bookId) {
      // You can perform additional logic here, such as removing the selected book from the session cart
      // For demonstration purposes, this function only updates the cart badge count
      const currentCount = parseInt(document.querySelector('.cart-icon .badge').textContent);
      if (currentCount > 0) {
        updateCartBadge(currentCount - 1);
      }

      // You should implement the logic to remove the item from the session cart
      // For example, you can use AJAX to send a request to the server to remove the item from the cart
    }

    // Function to clear the cart
    function clearCart() {
      // Perform logic to clear the cart (remove all items)
      // For demonstration purposes, this function only updates the cart badge count
      updateCartBadge(0);
    }

    // Function to continue to checkout
    function continueToCheckout() {
      // Redirect the user to the checkout page
      window.location.href = "checkout.php"; // Replace "checkout.php" with your actual checkout page URL
    }

    // Function to continue browsing
    function continueBrowsing() {
      // Redirect the user to the homepage or another page
      window.location.href = "index.php"; // Replace "index.php" with the URL of the page you want to redirect to
    }

    // Call the updateCartBadge function to initialize the cart count
    updateCartBadge(<?php echo count($_SESSION['cart']); ?>);
  </script>
</body>
</html>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // JavaScript code for cart functionality

// Function to update the cart icon and badge count
function updateCartBadge(count) {
  const cartBadge = document.getElementById('cart-badge');
  cartBadge.textContent = count;
}

// Example function to add a book to the cart
function addToCart(bookId) {
  // Perform logic to add the book to the cart
  // Increment the cart count
  updateCartBadge(parseInt(cartBadge.textContent) + 1);
}

// Example function to remove a book from the cart
function removeFromCart(bookId) {
  // Perform logic to remove the book from the cart
  // Decrement the cart count
  const currentCount = parseInt(cartBadge.textContent);
  if (currentCount > 0) {
    updateCartBadge(currentCount - 1);
  }
}

// Example function to clear the cart
function clearCart() {
  // Perform logic to clear the cart
  // Reset the cart count to 0
  updateCartBadge(0);
}

// Call the updateCartBadge function to initialize the cart count
updateCartBadge(0);

  </script>
</body>
</html>
