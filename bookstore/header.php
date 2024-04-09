
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css"> <!-- Assuming this is your custom CSS file -->

    <script type="text/javascript" src="./bootstrap/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="clear-fix pt-5 pb-3"></div>
    <nav class="navbar bg-warning">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand" href="index.php">Online Book Store</a>
            </div>
            <div class="navbar-collapse">
                <ul class="nav">
                     <!-- Added logout icon -->
                    <li class="nav-item"><a class="nav-link" href="recomendations.php">Recommendation</a></li>
                    <li class="nav-item"><a class="nav-link" href="books.php"><i class="fas fa-book"></i> Books</a></li> <!-- Added book icon -->
                    <li class="nav-item"><a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a></li> <!-- Added cart icon -->
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php"><i class="fas fa-envelope"></i> Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li> <!-- Added envelope icon -->
                    <!-- Search Form in Navbar (visible on all screen sizes) -->
                    <form id="searchForm" class="mr-3">
                        <input type="text" id="search" name="search" placeholder="Search...">
                    </form>
                </ul>
            </div>
        </div>
    </nav>

    <center>
        
        <div id="searchResults"></div>
    </center>

    <?php if(isset($title) && $title == "Home"): ?>
    <div class="container">
        <center><h1>Welcome to Diana's Online Book Store</h1></center>
        <center><h6>Latest Additions<h6></center>
        <hr>
    </div>
    <?php endif; ?>

    <div class="container" id="main">
        
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script> <!-- Assuming this is your custom JavaScript file -->
</body>
</html>
