<?php
// Start session
session_start();

// Include database connection
include 'conn.php';

// Check if any action is requested (e.g., delete)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action']) && isset($_POST['book_id'])) {
        $action = $_POST['action'];
        $book_id = $_POST['book_id'];
        
        // Delete record from 'books' table
        if ($action === 'delete') {
            $delete_sql = "DELETE FROM books WHERE book_id = ?";
            $stmt = $connect->prepare($delete_sql);
            $stmt->bind_param("i", $book_id); // Assuming book_id is an integer
            if ($stmt->execute()) {
                echo "Record deleted successfully";
            } else {
                echo "Error deleting record: " . $stmt->error;
            }
            $stmt->close();
        }
    }
}

// Fetch data from the books table
$query = "SELECT * FROM books";
$result = $connect->query($query);

// Check if 'full_name' key exists in $_SESSION array
$full_name = isset($_SESSION['title']) ? $_SESSION['title'] : '';

// Close connection

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Management</title>
    <link rel="stylesheet" href="management.css"> <!-- Link your CSS file here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome -->
</head>
<body>
<div class="navbar">
    <div class="container">
        <div class="logo">Book Management</div>
        <div class="profile">
            <span>Welcome, Admin</span>
            <a href="#"><i class="fas fa-user"></i></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
            <a href="add_book.php" class="add-book-button"><i class="fas fa-plus"></i> Add Book</a>
        </div>
    </div>
</div>
<div class="container">
    <div class="search-bar">
        <input type="text" id="searchInput" onkeyup="searchTable()" placeholder="Search by title or author...">
    </div>

    <div class="container">
        <div class="content">
            <table id="bookTable">
                <tr>
                    <th>book_id</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>quantity</th>
                    <th>Date Published</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php if ($result->num_rows > 0) : ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $row['book_id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['genre']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['date_pub']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td>
                                <!-- Inside the while loop where you display books -->
                                <form action="edit_book.php" method="POST">
                                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                                    <button type="submit" class="edit-button"><a href="edit_book.php?book_id=<?php echo $row['book_id']; ?>" class="edit-button">Edit</a></button>
                                </form>

                                <form action="" method="POST">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this book?')"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr><td colspan="6">No records found</td></tr>
                <?php endif; ?>
            </table>
            <form action="add_book.php" method="POST">
                <button type="submit"><i class="fas fa-plus"></i></button>
            </form>
        </div>
    </div>
    <div class="footer">
        <div class="container">
            <p>&copy; 2022 Book Management System. All rights reserved.</p>
        </div>
    </div>
    <script>
    function searchTable() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("bookTable");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            var found = false; // Flag to check if any match is found
            for (var j = 1; j < td.length - 1; j++) { // Start from the second column and ignore the last column (action buttons)
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            if (found) {
                tr[i].classList.add("highlight");
            } else {
                tr[i].classList.remove("highlight");
            }
        }
    }
</script>
</body>
</html>

<?php
  // Close the database connection
  mysqli_close($connect);
?>
