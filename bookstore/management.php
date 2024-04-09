<?php
// Start session
session_start();

// Include database connection
include 'conn.php';

// Fetch data from 'users' table
$sql = "SELECT * FROM users";
$result = $connect->query($sql);

// Initialize $error_message variable as an empty string
$error_message = "";

// Check if any action is requested (e.g., delete)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && isset($_POST['id'])) {
        $action = $_POST['action'];
        $id = $_POST['id'];
        
        if ($action === 'delete') {
            // Delete record from 'users' table
            $delete_sql = "DELETE FROM users WHERE id = ?";
            $stmt = $connect->prepare($delete_sql);
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                // Record deleted successfully
                header("Location: management.php");
                exit();
            } else {
                $error_message = "Error: Unable to delete record";
            }
        }
    }
}

// Check if 'full_name' key exists in $_SESSION array
$full_name = isset($_SESSION['full_name']) ? $_SESSION['full_name'] : '';

// Close connection
$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="stylesheet" href="management.css"> <!-- Link your CSS file here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
</head>
<body>
    <div class="navbar">
        <div class="container">
            <div class="logo">User Management</div>
            <div class="profile">
                <span>Welcome, <?php echo $full_name; ?></span>
                <a href="#"><i class="fas fa-user"></i></a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <?php if ($error_message) : ?>
                <div class="error"><?php echo $error_message; ?></div>
            <?php endif; ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['phone_number']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td class="icon-container">
                                <form action="update_user.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="icon-button"><i class="fas fa-edit"></i></button>
                                </form>
                                <form action="" method="POST">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="icon-button"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr><td colspan="6">No records found</td></tr>
                <?php endif; ?>
            </table>
            <form action="add_user.php" method="POST">
                <button type="submit" class="icon-button"><i class="fas fa-plus"></i></button>
            </form>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p>&copy; 2022 User Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
