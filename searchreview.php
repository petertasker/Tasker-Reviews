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
        <div class="box" style="width: 80%;">
			<?php
			$sql = "SELECT Make, BrandName, Cost, YearMade, ExtraDescription, ReviewText, StarRating FROM Guitar, Review WHERE Review.ReviewID = Guitar.ReviewID";
			$stmt = $conn -> prepare($sql);
			$stmt -> excecute();
			$stmt -> store_result();
			$stmt -> bind_result($make, $brand_name, $cost, $year_made, $extra_desc, $review_text, $star_rating);
			while ($stmt -> fetch()) {
				print($make);
			}
			?>
			
		
        </div>
    </body>
</html>

