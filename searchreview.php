<?php 

require_once "config.php";
require_once "session_start.php";
require_once "redirect_login.php";
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
        <?php
		// Logs out the user when the link is clicked
		if(isset($_GET['logout'])) {
		require_once "signout.php";
		}	
		?>
		<div class="box" style="width: 80%;">
			<h1>Guitar Reviews</h1>
			<?php
			$stmt = $conn->prepare("SELECT Username, Make, BrandName, Cost, YearMade, ExtraDescription, ReviewText, StarRating 
			FROM Guitar, Review WHERE Review.ReviewID = Guitar.ReviewID;");
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($db_username, $db_make, $db_brand_name, $db_cost, $db_year_made, $db_extra_desc, $db_review_text, $db_star_rating);
			$num_rows = $stmt -> num_rows();
			if ($num_rows > 0) {
			?>
			<table class="search-reviews">
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
				while ($stmt -> fetch()) {
				?>
				<tr>
				<td><?php echo $db_username;?></td>
				<td><?php echo $db_make?></td>
				<td><?php echo $db_brand_name;?></td>
				<td><?php echo $db_cost;?></td>
				<td><?php echo $db_year_made;?></td>
				<td><?php echo $db_extra_desc;?></td>
				<td><?php echo $db_review_text;?></td>
				<td><?php echo $db_star_rating;?></td>
				</tr>
			<?php }
			} else {
				echo "Nothing found :(";
			} 
			?>
			</table>
		</div>
    </body>
</html>
