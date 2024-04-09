<?php
include 'conn.php'; // Include file to establish database connection

// Check if the connection is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to fetch recommendations from database
function getRecommendations($conn, $genre) {
    // Implement logic to fetch recommendations from database based on genre
    // Example query (replace table_name with your actual table name):
    $sql = "SELECT * FROM books WHERE genre = '$genre' ORDER BY date_pub DESC LIMIT 2";
    $result = mysqli_query($conn, $sql);

    // Check if query was successful
    if ($result) {
        // Fetch results as an associative array
        $recommendations = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $recommendations;
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
        return array(); // Return empty array if there are no recommendations
    }
}

// Handle genre input
$genre = isset($_GET['genre']) ? $_GET['genre'] : '';

// Fetch recommendations from database based on genre
$recommendations = getRecommendations($connect, $genre);

// Close database connection
mysqli_close($connect);
require_once 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recommendations</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="recomendations.css">
</head>
<body>
    <center>
        <div class="container">
            <h3>Recommendations</h3>
            <form id="recommendationForm">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
                <button type="submit">Get Recommendations</button>
            </form>
            <div id="recommendations">
                <?php
                if (!empty($recommendations)) {
                    echo "<div class='container'>";
                    echo "<h2>Recommendations for $genre:</h2>";
                    foreach ($recommendations as $recommendation) {
                        echo "<div class='book'>";
                        echo "<h3>" . $recommendation['title'] . "</h3>";
                        echo "<p><strong>Author:</strong> " . $recommendation['author'] . "</p>";
                        echo "<p><strong>Genre:</strong> " . $recommendation['genre'] . "</p>";
                        echo "<p><strong>Date Published:</strong> " . $recommendation['date_pub'] . "</p>";
                        echo "<p><strong>Price:</strong> $" . $recommendation['price'] . "</p>";
                        echo "<a href='cart.php?id=" . $recommendation['book_id'] . "' class='add-to-cart-btn'>Add to Cart</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='container'>";
                    echo "<p>No recommendations found for $genre.</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </center>
    <!-- <script src="script.js"></script> -->
</body>
</html>