<?php
// Include file to establish database connection
include 'conn.php';

// Check if the connection is successful
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the form
$email = $_POST['email'];
$comment = $_POST['comment'];

// Prepare SQL statement to insert data into the notifications table
$sql = "INSERT INTO notifications (email, comment) VALUES ('$email', '$comment')";

// Execute SQL statement
if (mysqli_query($connect, $sql)) {
    echo "Thank you! Your message has been submitted successfully.";
    header ("Location:index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
}

// Close database connection
mysqli_close($connect);

?>
