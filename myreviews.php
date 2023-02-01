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
            <form style="display: inline-block" method="GET" action="searchreview.php">
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
                $sql = "
                    SELECT Guitar.guitar_id, make, Brand.brand_name, year_made, price, extra_info, review_text, recommend, date_reviewed, Users.username
                    FROM Brand, Guitar, Review, Users
                    WHERE Brand.brand_name = Guitar.brand_name AND Guitar.guitar_id = Review.guitar_id AND Users.username = Review.username
                    AND Users.username LIKE ?
                    ORDER BY date_reviewed DESC";
                $stmt = $conn -> prepare($sql);
                $stmt -> bind_param("s", $username);
                $stmt -> execute();
                $stmt -> bind_result($db_guitar_id, $db_make, $db_brand_name, $db_year_made, $db_price, $db_extra_info, $db_review_text, $db_recommend, $db_date_reviewed, $db_username);
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
                    if ($db_recommend == 0) {
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
