<?php
include 'conn.php';
session_start();

$title = "Home";
require_once "header.php";
require_once "database_functions.php";
?>
<!-- Add CSS styles -->
<style>
    .book-container {
        justify-content: center;
        display: flex; /* Use flex display to arrange books in one row */
        flex-wrap: nowrap; /* Ensure books do not wrap to the next line */
        overflow-x: auto; /* Add horizontal scroll if books overflow the container */
    }

    .card {
        width: 300px; /* Set a fixed width for each card */
        margin-right: 20px; /* Add margin right between cards */
        border: 1px solid #dee2e6; /* Add border to separate cards visually */
        border-radius: 5px; /* Add border radius for rounded corners */
        overflow: hidden; /* Hide overflowing content within cards */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for depth effect */
    }
</style>
<?php
// Connect to the database
$conn = db_connect();

// Query to fetch the latest 4 books based on publication date
$query = "SELECT * FROM books ORDER BY date_pub DESC LIMIT 4";
$result = mysqli_query($conn, $query);

echo '<div class="book-container">'; // Start book container

if ($result && mysqli_num_rows($result) > 0) {
    // Display each book as a card
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card">';
        echo '<img src="' . $row["book_img"] . '" class="card-img-top" alt="Book Image">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row["title"] . '</h5>';
        echo '<p class="card-text"><strong>Author:</strong> ' . $row["author"] . '</p>';
        echo '<p class="card-text"><strong>Genre:</strong> ' . $row["genre"] . '</p>';
        echo '<p class="card-text"><strong>Date Published:</strong> ' . $row["date_pub"] . '</p>';
        echo '<p class="card-text"><strong>Price:</strong> $' . $row["price"] . '</p>';
        // echo '<a href="cart.php?id=' . $row["book_id"] . '" class="add-to-cart-btn">Add to Cart</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No books found.";
}

echo '</div>'; // End book container

// Close database connection
if(isset($conn)) {
    mysqli_close($conn);
}

require_once "footer.php";
?>
