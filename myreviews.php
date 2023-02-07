<?php
require_once "config.php";
if (!(isset($_SESSION["username"]))) {
	header("Location: index.php");
}

if ($_SESSION["username"] == "admin") {
    $username = "%%";
} else {
    $username = "%".$_SESSION["username"]."%";
}

// Used in filterreview.php
$_SESSION["previous_location"] = "myreviews.php";
?>
<html>
<head>
    <title>Tasker Reviews</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <nav class="navbar">
		<a href="signout.php"><span class="pull-right glyphicon glyphicon-log-out clickable_space"></span></a>
		<a href="myreviews.php"><span class="pull-right glyphicon glyphicon-list clickable_space"></span></a>"
        <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>
    <div class="search-review">
        <div class="search-review__filter">
            <h1>My Reviews</h1>
            <form style="display: inline-block" method="GET" action="filterreview.php">
                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-filter"</span></button>
            </form>
            <form style="display: inline-block" method="GET" action="myreviews.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-refresh"</span></button>
            </form>
        </div>
        <div class="search-review__box">

            <table class="table">
                <tr class="header">
                    <td>Make</td>
                    <td>Manufacturer</td>
                    <td>Year Made</td>
                    <td>Price</td>
                    <td>Extra Info</td>
                    <td>Review Text</td>
                    <td>Recommend</td>
                    <td>Date Reviewed</td>
                    <td>Username</td>
                    <td>Action</td>
                </tr>
                <?php 
                // If user there are no filter variables in the URL 
                // Use of wildcard for users to allow admin to be "%%"
                if (count($_GET) == 0) {
                    $sql = "
                            SELECT Guitar.guitar_id, 
			    	make, 
				Brand.brand_name, 
				year_made, 
				price, 
				extra_info, 
				review_text, 
				recommend, 
				Users.username, 
				date_reviewed
                            FROM Brand, Users, Guitar, Review
                            WHERE Brand.brand_name = Guitar.brand_name 
			    	AND Guitar.guitar_id = Review.guitar_id 
				AND Users.username = Review.username
                                AND Users.username LIKE ?
                            ORDER BY date_reviewed DESC";
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bind_param("s", $username);
                    
                } else {

                    $sql = "
                            SELECT Guitar.guitar_id,
			    	make, 
				Brand.brand_name, 
				year_made, 
				price, 
				extra_info, 
				review_text, 
				recommend, 
				Users.username, 
				date_reviewed
                            FROM Brand, Users, Guitar, Review
                            WHERE Brand.brand_name = Guitar.brand_name 
			    	AND Guitar.guitar_id = Review.guitar_id 
				AND Users.username = Review.username
                                AND make LIKE ?
                                AND Brand.brand_name LIKE ?
                                AND Users.username LIKE ?
                                AND recommend LIKE ?
                                AND (price BETWEEN ? AND ? OR (price IS NULL OR price IS NOT NULL))
                                AND (year_made LIKE ? OR year_made IS NULL)
                                AND extra_info LIKE ?
                                ORDER BY date_reviewed DESC";

                    
                    // concatenate for wildcard
                    $make = "%" . $_GET["make"] . "%";
                    $brand_name = "%" . $_GET["brand"] . "%";
                    $username = "%" . $_GET["username"] . "%";
                    $year_made = "%" . $_GET["year-made"] . "%";
                    $extra_info = "%" . $_GET["extra-info"] . "%";               
                    $cost_high = $_GET["cost-high"];
                    $cost_low = $_GET["cost-low"];

                    
                    // Unchecked radio buttons do not appear in URL
                    if (isset($_GET["recommendation"])) {
                        $recommend = "%" . $_GET["recommendation"] . "%";
                    } else {
                        $recommend = "%%";
                    }
                
                    if (!(isset($_GET["cost-low"]))) {
                        $cost_low = 0;
                    }
                    
                    if (!(isset($_GET["cost-high"]))) {
                        $cost_low = 999999;
                    }
                    // If lower > higher
                    if ($cost_high < $cost_low) {
                        $cost_high = 999999;
                    }
                    
                    // Two decimal places format for SQL
                    $cost_low = number_format((float)$cost_low, 2, '.', '');
                    $cost_high = number_format((float)$cost_high, 2, '.', '');
                    
                    $stmt = $conn -> prepare($sql);
                    $stmt -> bind_param("ssssddsss", $make, $brand_name, $username, $recommend, $cost_low, $cost_high, $year_made, $extra_info, $username);

                }                  
                    $stmt -> execute();
                    $stmt -> bind_result($db_guitar_id, $db_make, $db_brand_name, $db_year_made, $db_price, $db_extra_info, $db_review_text, $db_recommend, $db_username, $db_date_reviewed);
                    while ($stmt -> fetch()) {
                ?>
                        <tr>
                            <td><?php echo $db_make; ?></td>
                            <td><?php echo $db_brand_name; ?></td>
                            <td><?php echo $db_year_made; ?></td>
                            <td><?php echo $db_price; ?></td>
                            <td><?php echo $db_extra_info; ?></td>
                            <td><?php echo $db_review_text; ?></td>
                            <?php 
                            if ($db_recommend == 1) {
                                ?><td><span class="glyphicon glyphicon-thumbs-up"></span></td>
                            <?php } else {
                                ?><td><span class="glyphicon glyphicon-thumbs-down"></span></td>	
                                <?php
                            }
                            ?> 
                            <td><?php echo $db_date_reviewed; ?></td>
                            <td><?php echo $db_username; ?></td>

                            <td>
                                <div style="display:flex;">
                                    <form action="editreview.php" method="GET">
                                        <button value="<?php echo $db_guitar_id;?>" type="submit" name="guitar_id">Edit</button>
                                    </form>
                                    <form action="deletedreview.php" method="GET">
                                        <button value="<?php echo $db_guitar_id;?>" type="submit" name="guitar_id">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
            <?php ;}?>
            </table>
        </div>
    </div>
</body>
</html>
