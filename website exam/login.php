<?php
// Start session
session_start();

// Include database connection
include 'conn.php';

// Initialize $error_message variable as an empty string
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if email ends with '@books.com'
    $domain = substr(strrchr($email, "@"), 1);
    $table = '';
    $redirect_url = '';

    switch ($domain) {
        case 'manager.com':
            $table = 'managers';
            $redirect_url = 'management.php';
            break;
        case 'employee.com':
            $table = 'employees';
            $redirect_url = 'employees.php';
            break;
        default:
            $table = 'users';
            $redirect_url = 'books_management.php';
            break;
    }

    // Prepare SQL statement to select user data
    $sql = "SELECT * FROM $table WHERE email = ?";
    $stmt = $connect->prepare($sql);
    if ($stmt) { // Check if statement preparation was successful
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify password
            if ($password === $row['password_hash']) { // Comparing plain text password with hashed password
                // Password is correct, redirect to appropriate page
                $_SESSION['email'] = $email;
                header("Location: $redirect_url");
                exit();
            } else {
                $error_message = "Invalid username or password";
            }
        } else {
            $error_message = "Invalid username or password";
        }

        // Close statement
        $stmt->close();
    } else {
        // Error in statement preparation
        $error_message = "Error in statement preparation";
    }
}

// Close connection
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="registration.css"> <!-- You can create a CSS file for styling -->
</head>
<body>
    <div class="container">
        <div class="title">Login</div>
        <div class="content">
            <form action="" method="POST">
                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <span class="error"><?php echo $error_message; ?></span>
                <div class="button">
                    <input type="submit" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>
