<?php 

require_once "config.php";
require_once "session_start.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Guitar Review</title>   
        <link rel="stylesheet" href="style.css">
        <!-- For stars -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
        <link rel="shortcut icon" href="media/gtr-favicon.ico"/>

    </head>
    <body class="form-body">
        <div class="top">
            <ul>
                <a class="nav-link" href="?logout">Sign Out</a>
                <a class="nav-link" href="myreviews.php">My reviews</a>
                <a class="nav-link" href="index.php">Home</a>
            </ul>
        </div>
        <div class="box">
            <form action="" method="post">
                <h1>Review Guitar</h1>
                <input name="make" class="input" type="text" placeholder="*Make of Guitar"required>
                <input list="brand" name="brand" class="input" type="text" placeholder="*Brand Name" required>

                <datalist id="brand">
                    <?php
                    $stmt = $conn->prepare("SELECT DISTINCT BrandName FROM Guitar");
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($db_brand_name);
                    while ($stmt->fetch()){
                    ?>
                        <option value="<?php echo $db_brand_name;?>"></option>
                    <?php }
                    ?>
                </datalist>

                <input name="cost" class="input" type="number" placeholder="Cost" min="0.00" max="9999999.99" step="0.01">
                <input name="year-made" class="input" type="number" placeholder="Year Made" min="1900" max="<?php echo date("Y"); ?>">
                <textarea name="extra-desc" class="input review-textarea" type="text" placeholder="Extra Description" rows="4" cols="5o"></textarea>
                <textarea name="review-text" class="input review-textarea" type="text" placeholder="Review Text" rows="4" cols="50"></textarea>
                <div class="stars">
                    <input class="star star-5" id="star-5" type="radio" name="star" value="5"/>
                    <label class="star star-5" for="star-5"></label>
                    <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                    <label class="star star-4" for="star-4"></label>
                    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                    <label class="star star-1" for="star-1"></label>
                </div>
                <div><input class="btn" value="submit" type="submit" name="submit"></div>
                <div><input style="background-color:red" class="btn"id="btn2" value="reset" type="reset"></div>
            
                <?php
                    if (isset($_POST["submit"])){

                        $make = mysqli_real_escape_string($conn, $_POST["make"]);
                        $brand = mysqli_real_escape_string($conn, $_POST["brand"]);
                        $cost = mysqli_real_escape_string($conn, $_POST["cost"]);
                        $year_made = mysqli_real_escape_string($conn, $_POST["year-made"]);
                        $review_text = mysqli_real_escape_string($conn, $_POST["review-text"]);
                        $star_rating = mysqli_real_escape_string($conn, $_POST["star"]);
                        $extra_desc = mysqli_real_escape_string($conn, $_POST["extra-desc"]);

                        $errors = array();

                        if ($star_rating == 0 ) {
                            $errors = "Please give this item a star rating";
                        }

                        if (sizeof($errors) > 0) {
                            print("<br><br><br>");
                            foreach($errors as $error) {
                                printf("<li class='login-msg'>%s</li>", $error);
                            }

                        } else {
                            

                            $username = $_SESSION["username"];
                            $email = $_SESSION["email"];

                            $stmt = $conn -> prepare("INSERT INTO Review(Username, ReviewText, StarRating, Email) VALUES(?, ?, ?, ?)");
                            
                            $stmt -> bind_param("ssis", $username, $review_text, $star_rating, $email);
                            $stmt -> execute();
                            
                            $stmt = $conn -> prepare("INSERT INTO Guitar(Make, BrandName, Cost, YearMade, ReviewID, ExtraDescription) 
                                                        VALUES(?, ?, ?, ?, (SELECT MAX(ReviewID) FROM Review), ?)");
                            $stmt -> bind_param("ssdis", $make, $brand, $cost, $year_made, $extra_desc);
                            $stmt -> execute();
                            
                        }

                        //subquery getting highest number
                        // add email as session variable
                        //errors
                        //INSERT INTO Guitar(Make, BrandName, ReviewID) VALUES("Telecaster", "Fender", (SELECT MAX(ReviewID) FROM Review));
                    }
                ?>
            </form>
        </div>
    </body>
</html>
