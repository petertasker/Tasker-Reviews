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
			
			$results = $conn->query("SELECT Username, Make, BrandName, Cost, YearMade, ExtraDescription, ReviewText, StarRating FROM Guitar, Review WHERE Review.ReviewID = Guitar.ReviewID;");
			?>
			<table class="search-reviews">;
			<tr style="font-weight: bold;">
				<td>Username</td>
				<td>Make</td>
				<td>Brand Name</td>
				<td>Cost</td>
				<td>Year Made</td>
				<td>Extra Description</td>
				<td>Review Text</td>
				<td>Star Rating</td>
				</tr>
			<?php	
			while($row = $results->fetch_array()) {
				echo "<tr>";
				echo "<td>".$row["Username"]."</td>";
				echo "<td>".$row["Make"]."</td>";
				echo "<td>".$row["BrandName"]."</td>";
				echo "<td>".$row["Cost"]."</td>";
				echo "<td>".$row["YearMade"]."</td>";
				echo "<td>".$row["ExtraDescription"]."</td>";
				echo "<td>".$row["ReviewText"]."</td>";
				echo "<td>".$row["StarRating"]."</td>";
				echo "</tr>";
			}   
			echo "</table>";
		?>
			
		
        </div>
        
    </body>
</html>

