<?php
session_start();
$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : '';
$count = 0;
// connect to database
require_once "database_functions.php";
$conn = db_connect();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect the user to the login page
    header("Location: login.php");
    exit();
}

if ($book_id) {
    $query = "SELECT * FROM books WHERE book_id = $book_id";
} else {
    $query = "SELECT * FROM books";
}

//   echo "<pre>$query</pre>"; // print out the SQL query for debugging

$result = mysqli_query($conn, $query);
if (!$result) {
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
}

$title = "List of Books";
require_once "header.php";
?>
<style>
  /* CSS for the card container */
  .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 10px;
    gap: 20px;
  }

  /* CSS for the individual card */
  .card {
    width: calc(25% - 20px); /* Adjust the width as needed */
    overflow: hidden;
    border: 1px solid #ccc;
    height: 700px;
  }

  /* CSS for the image */
  .card img {
    width: 100%; /* Make the image fill the entire width of the card */
    height: 100%; /* Make the image fill the entire height of the card */
    object-fit: cover; /* Ensure the image covers the entire space */
  }

  /* Additional styles for card body and title */
  .card-body {
    padding: 10px;
    height: 70px;
  }

  .card-title {
    margin: 0;
    text-align: center;
  }
</style>
<p class="lead text-center text-muted">List of All Books</p>
<div class="card-container">
  <?php while($book = mysqli_fetch_assoc($result)){ ?>
    <div class="card rounded-0 shadow">
      <a href="books.php?book_id=<?php echo $book['book_id']; ?>" class="text-reset text-decoration-none">
        <div class="img-holder overflow-hidden">
          <?php 
            // Display the image directly using img tag
            echo '<img src="' . $book["book_img"] . '" class="img-top" alt="Book Image">';
          ?>
        </div>
      </a>
      <div class="card-body">
        <div class="card-title fw-bolder h5 text-center"><?= htmlspecialchars($book['title']) ?></div>
        <form method="post" action="cart.php">
          <input type="hidden" name="book_id" value="<?php echo $book['book_id']; ?>">
          <div class="text-center">
            <input type="submit" value="Add to Cart" name="cart" class="btn btn-primary rounded-0">
          </div>
        </form>
      </div>
    </div>
  <?php } ?> 
</div>
<?php
if(isset($conn)) { mysqli_close($conn); }
require_once "footer.php";
?>
