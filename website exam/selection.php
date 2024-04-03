<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Genre Selection</title>
    <link rel="stylesheet" href="selection.css"> 
</head>
<body>
    <div class="container">
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
    <form action="preferences.php" method="POST">
        <div class="title"><h2>Welcome to Your Next Adventure!</h2></div>
        <div class="subtitle"><h4>Select Your Preferred Genres (Choose up to 6):</h4></div>
        <div class="genre-categories">
            <div class="genre-category">
                <div class="category-title">Fiction</div>
                <ul>
                    <li><input type="checkbox" name="genres[]" id="genre1" value="Literary Fiction"><label for="genre1">Literary Fiction</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre2" value="Historical Fiction"><label for="genre2">Historical Fiction</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre3" value="Science Fiction"><label for="genre3">Science Fiction</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre4" value="Fantasy"><label for="genre4">Fantasy</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre5" value="Mystery"><label for="genre5">Mystery</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre6" value="Thriller"><label for="genre6">Thriller</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre7" value="Horror"><label for="genre7">Horror</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre8" value="Romance"><label for="genre8">Romance</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre9" value="Adventure"><label for="genre9">Adventure</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre10" value="Western"><label for="genre10">Western</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre11" value="Humor"><label for="genre11">Humor</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre12" value="Satire"><label for="genre12">Satire</label></li>
                </ul>
            </div>
            <div class="genre-category">
                <div class="category-title">Non-Fiction</div>
                <ul>
                    <li><input type="checkbox" name="genres[]" id="genre13" value="Biography/Autobiography"><label for="genre13">Biography/Autobiography</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre14" value="Memoir"><label for="genre14">Memoir</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre15" value="History"><label for="genre15">History</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre16" value="True Crime"><label for="genre16">True Crime</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre17" value="Self-Help"><label for="genre17">Self-Help</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre18" value="Philosophy"><label for="genre18">Philosophy</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre19" value="Psychology"><label for="genre19">Psychology</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre20" value="Sociology"><label for="genre20">Sociology</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre21" value="Science"><label for="genre21">Science</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre22" value="Technology"><label for="genre22">Technology</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre23" value="Travel"><label for="genre23">Travel</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre24" value="Cooking/Food"><label for="genre24">Cooking/Food</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre25" value="Art/Photography"><label for="genre25">Art/Photography</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre26" value="Music"><label for="genre26">Music</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre27" value="Sports"><label for="genre27">Sports</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre28" value="Business/Finance"><label for="genre28">Business/Finance</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre29" value="Politics"><label for="genre29">Politics</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre30" value="Religion/Spirituality"><label for="genre30">Religion/Spirituality</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre31" value="Health/Fitness"><label for="genre31">Health/Fitness</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre32" value="Parenting"><label for="genre32">Parenting</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre33" value="Education"><label for="genre33">Education</label></li>
                </ul>
            </div>
            <div class="genre-category">
                <div class="category-title">Other</div>
                <ul>
                    <li><input type="checkbox" name="genres[]" id="genre34" value="Poetry"><label for="genre34">Poetry</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre35" value="Drama/Plays"><label for="genre35">Drama/Plays</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre36" value="Graphic Novels/Comics"><label for="genre36">Graphic Novels/Comics</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre37" value="Children's/Young Adult"><label for="genre37">Children's/Young Adult</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre38" value="Experimental/Avant-Garde"><label for="genre38">Experimental/Avant-Garde</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre39" value="Short Stories"><label for="genre39">Short Stories</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre40" value="Essay/Creative Non-Fiction"><label for="genre40">Essay/Creative Non-Fiction</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre41" value="Fable/Mythology"><label for="genre41">Fable/Mythology</label></li>
                    <li><input type="checkbox" name="genres[]" id="genre42" value="Epistolary Fiction"><label for="genre42">Epistolary Fiction</label></li>
                </ul>
            </div>
        </div>
        <div class="button-container">
            <button class="continue-button">Continue</button>
        </div>
    </form>
    </div>
</main>
</body>
</html>
