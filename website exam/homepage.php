<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Store</title>
  <link rel="stylesheet" href="homepage.css">
</head>
<body>
  <header>
    <div class="container">
      <div class="logo">
        <img src="logo.png" alt="Book Store Logo">
      </div>
      <nav>
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">Books</a></li>
          <li><a href="#">Offers</a></li>
          <li><a href="#">Contact</a></li>
          <li><a href="#">Login</a></li>
          <li><a href="#">Sign Up</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main>
    <section class="banner">
    <div class="container">
        <div class="background"></div>
        <div class="content">
        <h1>Welcome to Book Store</h1>
        <p>"Discover the joy of reading with us. Explore our curated collection and embark on new literary adventures today!"</p>
        <button class="explore-btn">Explore Now</button>
        </div>
    </div>
    </section>


    <section class="featured-books">
      <div class="container">
        <center><h2>Featured Books</h2>
        <div class="books-wrapper">
          <div class="book-card">
            <img src="book1.jpg" alt="Book 1">
            <div class="book-info">
              <h3>Leverage Agile Frameworks</h3>
              <p>A guide to provide robust...</p>
              <a href="#">Read</a>
            </div>
          </div>
          <div class="book-card">
            <img src="book2.jpg" alt="Book 2">
            <div class="book-info">
              <h3>Web UI Design for the...</h3>
              <p>A guide to effective UI/UX...</p>
              <a href="#">Read</a>
            </div>
          </div>
          <div class="book-card">
            <img src="book3.jpg" alt="Book 3">
            <div class="book-info">
              <h3>Data Science Handbook</h3>
              <p>Learn data science from...</p>
              <a href="#">Read</a>
            </div>
          </div>
        </div>
        <a href="#" class="view-all">View All Books</a>
      </div>
    </section>

    <section class="call-to-action">
      <div class="container">
        <h2>Join Us Today and Explore the World of Books!</h2>
        <button class="join-btn">Join Now</button>
      </div>
    </section>
  </main>

  <footer>
    <div class="container">
      <p>&copy; 2024 Book Store. All Rights Reserved.</p>
    </div>
  </footer>

  <script src="script.js"></script>
</body>
</html>
