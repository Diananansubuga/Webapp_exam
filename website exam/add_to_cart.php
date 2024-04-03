<?php
session_start();

// Check if the cart array exists in the session, if not, initialize it
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get the book details from the request (you may adjust this based on your actual book data)
$bookId = $_POST['book_id']; // Assuming you have a unique ID for each book
$bookTitle = $_POST['book_title'];
$bookPrice = $_POST['book_price'];

// Add the book to the cart array
$_SESSION['cart'][] = [
    'id' => $bookId,
    'title' => $bookTitle,
    'price' => $bookPrice
];

// Redirect back to the previous page or any other page
header("Location: {$_SERVER['HTTP_REFERER']}");
exit();
?>
