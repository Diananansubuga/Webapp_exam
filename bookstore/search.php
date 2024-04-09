<?php
include 'conn.php'; // Include file to establish database connection

// Check if the connection is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle search query input
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Fetch search results from the database
$searchResults = getSearchResults($connect, $searchQuery);

// Display search results
if (!empty($searchResults)) {
    foreach ($searchResults as $result) {
        echo "<div class='book'>";
        echo "<h3>" . $result['title'] . "</h3>";
        echo "<p><strong>Author:</strong> " . $result['author'] . "</p>";
        echo "<p><strong>Genre:</strong> " . $result['genre'] . "</p>";
        echo "<p><strong>Date Published:</strong> " . $result['date_pub'] . "</p>";
        echo "<p><strong>Price:</strong> $" . $result['price'] . "</p>";
        echo "<a href='cart.php?id=" . $result['book_id'] . "' class='add-to-cart-btn'>Add to Cart</a>";
        echo "</div>";
    }
} else {
    echo "<p>No results found.</p>";
}

// Close database connection
mysqli_close($connect);

// Function to fetch search results from database based on query
function getSearchResults($conn, $query) {
    // Implement logic to fetch search results from database based on query
    // Example query (replace table_name with your actual table name):
    $sql = "SELECT * FROM books WHERE title LIKE '%$query%' OR author LIKE '%$query%' OR genre LIKE '%$query%' OR date_pub LIKE '%$query%'";
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Fetch results as an associative array
        $searchResults = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $searchResults;
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
        return array(); // Return empty array if there are no search results
    }
}
?>