<?php
  // Include your database connection file
  require_once "conn.php";

  // Check if the search term is provided
  if(isset($_GET['search'])) {
    // Sanitize the search term to prevent SQL injection
    $search = mysqli_real_escape_string($connect, $_GET['search']);

    // Query to search for books that match the search term
    $query = "SELECT * FROM books WHERE title LIKE '%$search%' OR author LIKE '%$search%' OR genre LIKE '%$search%' OR date_pub LIKE '%$search%'";
    $result = mysqli_query($connect, $query);

    if ($result) {
      if (mysqli_num_rows($result) > 0) {
        // Display the matching books with all details
        echo '<h2>Search Results</h2>';
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div>';
          echo '<h3>Title: ' . $row["title"] . '</h3>';
          echo '<p>Author: ' . $row["author"] . '</p>';
          echo '<p>Genre: ' . $row["genre"] . '</p>';
          echo '<p>Price: $' . $row["price"] . '</p>';
          echo '<p>Date Published: ' . $row["date_pub"] . '</p>';
          echo '</div>';
        }
      } else {
        // If no books match the search criteria
        echo '<p>No books found matching your search criteria.</p>';
      }
    } else {
      // If there was an error executing the query
      echo "Error: " . mysqli_error($connect);
    }
  } else {
    // If no search term is provided
    echo '<p>Please enter a search term.</p>';
  }

  // Close the database connection
  mysqli_close($connect);
?>
