<?php
	session_start();
	
	require_once "conn.php";


	if(isset($_GET['book_id'])){
		$book_id = $_GET['book_id'];}
	// } else {
	// 	echo "Empty query!";
	// 	exit;
	// }

	if(!isset($book_id)){
		echo "Empty book ID! Please check again!";
		exit;
	}

	// Get book data
	$query = "SELECT * FROM books WHERE book_id = '{$book_id}'";
	$result = mysqli_query($connect, $query);
	if(!$result){
		$err = "Can't retrieve data ";
		exit;
	}else{
		$row = mysqli_fetch_assoc($result);
	}

	if(isset($_POST['edit'])){
		$title = trim($_POST['title']);
		$author = trim($_POST['author']);
		$genre = trim($_POST['genre']);
		$date_pub = trim($_POST['date_pub']);
		$price = trim($_POST['price']);

		$query = "UPDATE books SET title = '$title', author = '$author', genre = '$genre', date_pub = '$date_pub', price = '$price' WHERE book_id = '{$book_id}'";
		$result = mysqli_query($connect, $query);
		if($result){
			$_SESSION['book_success'] = "Book details have been updated successfully";
			header("Location: books_management.php");
			exit;
		} else {
			$err = "Can't update data: " . mysqli_error($conn);
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <!-- Include any necessary CSS styles here -->
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    .container {
    width: 50%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

h2 {
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
}

button[type="submit"]:hover {
    background-color: #0056b3;
}

.error {
    color: red;
    margin-bottom: 10px;
}

</style>
<body>
    <!-- Your HTML content here -->
    <div class="container">
        <h2>Edit Book</h2>
        <?php if(isset($err)) echo '<div class="error">' . $err . '</div>'; ?>
        <form action="edit_book.php?book_id=<?php echo $book_id; ?>" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="<?php echo $row['title']; ?>" required>
            </div>
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" value="<?php echo $row['author']; ?>" required>
            </div>
            <div class="form-group">
                <label for="genre">Genre:</label>
                <input type="text" id="genre" name="genre" value="<?php echo $row['genre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="date_pub">Date Published:</label>
                <input type="date" id="date_pub" name="date_pub" value="<?php echo $row['date_pub']; ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo $row['price']; ?>" required>
            </div>
            <button type="submit" name="edit">Update Book</button>
        </form>
    </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($connect);
?>
