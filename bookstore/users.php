<?php
include 'conn.php'; // Include the file for database connection

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input data
    $full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone_number = isset($_POST['phone_number']) ? trim($_POST['phone_number']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $address = isset($_POST['address']) ? trim($_POST['address']) : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';

    // Check if email already exists
    $sql_check = "SELECT * FROM users WHERE email = ?";
    $stmt = $connect->prepare($sql_check);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $error_message = "Error: Email already exists in the database.";
        // Redirect or display an error message
        exit;
    }

    // Insert user data into the database
    $sql = "INSERT INTO users (email, full_name, phone_number, password, address, gender)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssss", $email, $full_name, $phone_number, $password, $address, $gender);

    if ($stmt->execute()) {
        echo 'New record created successfully';
        header("location: login.php");
    } else {
        echo 'Error: ' . $sql . '<br>' . $stmt->error;
        // Display an error message
    }

    $stmt->close(); // Close the prepared statement
}

?>
