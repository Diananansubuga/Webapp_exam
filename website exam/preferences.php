<?php
session_start();

// Include your database connection file
require_once "conn.php";

// Fetch user's preferences from the database
// Replace this with your database connection code
$connect = new mysqli($server, $user, $pass, $db_name); // Assuming this function establishes the database connection

// Check if the user ID is set in the session
if (!isset($_SESSION['id'])) {
    // Redirect to the login page if user ID is not set
    header("Location: login.php");
    exit();
}

// Assume the user ID is retrieved from the login session
$id = $_SESSION['id']; // Replace with the actual user ID

// Get user's preferences from the form submission
$preference1 = $_POST['preference_1'] ?? '';
$preference2 = $_POST['preference_2'] ?? '';
$preference3 = $_POST['preference_3'] ?? '';

// Update user's preferences in the database
$query = "UPDATE users SET preference_1 = ?, preference_2 = ?, preference_3 = ? WHERE id = ?";
$statement = $connect->prepare($query);
$statement->bind_param("sssi", $preference1, $preference2, $preference3, $id);
$statement->execute();

// Redirect to a different page after updating preferences
header("Location: books.php");
exit();

// Close connection

?>
