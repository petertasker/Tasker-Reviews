<?php
require_once "config.php";
require_once "session_start.php";
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Guitar Reviews</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="shortcut icon" href="media/gtr-favicon.ico"/>
        <script src="script.js"></script>
    </head>
    <body>
		<?php
		$results = $conn->query("SELECT Make, BrandName, Cost, YearMade, ExtraDescription, ReviewText, StarRating FROM Guitar, Review WHERE Review.ReviewID = Guitar.ReviewID;");
		echo '<table border="1">';
		while($row = $results->fetch_array()) {
			echo "<tr>";
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
	</body>
</html>
