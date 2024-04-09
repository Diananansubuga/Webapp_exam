
<?php
// Start session
session_start();

// Include database connection
include 'conn.php';
// require_once 'header.php';

// Initialize $error_message variable as an empty string
$error_message = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if email ends with '@books.com' or '@manager.com'
    $domain = substr(strrchr($email, "@"), 1);
    $table = '';
    $redirect_url = '';

    switch ($domain) {
        case 'books.com':
            $table = 'employees';
            $redirect_url = 'books_management.php';
            break;
        case 'manager.com':
            $table = 'managers';
            $redirect_url = 'management.php';
            break;
        default:
            $table = 'users';
            $redirect_url = 'index.php';
            break;
    }

    // Prepare SQL statement to select user data
    $sql = "SELECT * FROM $table WHERE email = ?";
    echo "SQL: $sql";
    $stmt = $connect->prepare($sql);
    if ($stmt) { // Check if statement preparation was successful
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify password
            if ($password == $row['password']) { // Comparing plain text password with plain text password
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
        // $stmt->close();
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
    <style>
        /* Additional CSS */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 400px; /* Set container width */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .content {
            text-align: center;
        }

        .input-box {
            margin-bottom: 20px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%; /* Make input boxes full width */
            padding: 10px; /* Add padding */
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Include padding and border in element's total width and height */
            font-size: 16px;
        }

        .button {
            text-align: center;
        }

        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
            display: block;
            text-align: center;
        }
    </style>
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
                <p>Dont have an account?<a href="registration.php">Sign up now!🫡</a></p>
            </form>
        </div>
    </div>
</body>
</html>
