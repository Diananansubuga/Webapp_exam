<?php
// Include your database connection file
require_once "conn.php";

// Function to sanitize input to prevent SQL injection
function sanitize($connect, $data) {
    return mysqli_real_escape_string($connect, $data);
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Sanitize input data
    $title = sanitize($connect, $_POST['title']);
    $author = sanitize($connect, $_POST['author']);
    $genre = sanitize($connect, $_POST['genre']);
    $date_pub = sanitize($connect, $_POST['date_pub']);
    $price = sanitize($connect, $_POST['price']);

    // Check if the book already exists
    $check_query = "SELECT * FROM books WHERE title='$title' AND author='$author' AND genre='$genre' AND date_pub='$date_pub'";
    $check_result = mysqli_query($connect, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('Book already exists');</script>";
    } else {
        // Insert new book into the database
        $insert_query = "INSERT INTO books (title, author, genre, date_pub, price) VALUES ('$title', '$author', '$genre', '$date_pub', '$price')";
        $insert_result = mysqli_query($connect, $insert_query);

        if ($insert_result) {
            echo "<script>alert('Book added successfully');</script>";
        } else {
            echo "<script>alert('Error adding book');</script>";
        }
    }
}

// Close the database connection
mysqli_close($connect);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <!-- Include any necessary CSS styles here -->
    <link rel="stylesheet" href="styles.css">
</head>
<style>body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    text-align: center;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="number"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

@media (max-width: 768px) {
    .container {
        width: 80%;
    }
}
</style>
<body>
    <div class="container">
        <h2>Add Book</h2>
        <form action="add_book.php" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" required>
            </div>
            <div class="form-group">
                <label for="date_pub">Date Published:</label>
                <input type="date" id="date_pub" name="date_pub" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <button type="submit" name="submit">Add Book</button>
        </form>
        
    </div>
    <a href="books_management.php"><center><button>Back to Management</button></center></a>
</body>
</html>
