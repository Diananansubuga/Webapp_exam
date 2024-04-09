<!-- <?php
  session_start();
  $book_id = $_GET['book_id'];
  // connect to database
  require_once "database_functions.php";
  $conn = db_connect();

  $query = "SELECT * FROM books WHERE book_id = '$book_id'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }

  $title = $row['title'];
  require "header.php";
?>
<!-- Example row of columns -->
<nav aria-label="breadcrumb">
    <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="books.php" class="text-decoration-none text-muted fw-light">book</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $row['title']; ?></li>
    </ol> -->
</nav><br><br>
<div class="row">
    <!-- <div class="col-md-3 text-center book-item">
        <div class="img-holder overflow-hidden">
            <?php 
                // Display the image directly using img tag
                // echo '<img class="img-top" src="' . $row['book_img'] . '">';
            ?>
        </div>
    </div> -->

    <center>
        <div class="col-md-9">
            <div class="card rounded-0 shadow">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="content-wrapper">
                            <h4><?= $row['title'] ?></h4>
                            
                            <table class="table">
                                <?php foreach($row as $key => $value){
                                    if( $key == "book_img" || $key == "price" || $key == "book_title"){
                                        continue;
                                    }
                                    switch($key){
                                        case "book_title":
                                            $key = "title";
                                            break;
                                        case "author":
                                            $key = "Author";
                                            break;
                                        case "price":
                                            $key = "Price";
                                            break;
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $key; ?></td>
                                    <td><?php echo $value; ?></td>
                                </tr>
                                <?php 
                                    } 
                                    if(isset($conn)) {mysqli_close($conn); }
                                ?>
                            </table>
                            <form method="post" action="cart.php">
                                <input type="hidden" name="book_id" value="<?php echo $book_id;?>">
                                <div class="text-center">
                                    <input type="submit" value="Add to cart" name="cart" class="btn btn-primary rounded-0">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </center>
</div>
<?php
  require "footer.php";
?> 
