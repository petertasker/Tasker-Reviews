<html>
<?php
require_once "config.php";
if (!(isset($_SESSION["username"]))) {
	header("Location: index.php");
}
?>
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
            <div class="search-review__box">

            <table class="table">
                <tr class="header">
                    <td>Make</td>
                    <td>Manufacturer</td>
                    <td>Year Made</td>
                    <td>Price</td>
                    <td>Extra Info</td>
                    <td>Review Tetxt</td>
                    <td>Recommend</td>
                    <td>Username</td>
                    <td>Action</td>
                </tr>
                <?php 
                        $sql = "
                            SELECT review_id, make, Brand.brand_name, year_made, price, extra_info, review_text, recommend, date_reviewed
                            FROM Brand, Guitar, Review
                            WHERE Brand.brand_name = Guitar.brand_name AND Guitar.guitar_id = Review.guitar_id 
                
                            ORDER BY date_reviewed DESC";
                        $stmt = $conn -> prepare($sql);
 
                    $stmt -> execute();
                    $stmt -> bind_result($db_review_id, $db_make, $db_brand_name, $db_year_made, $db_price, $db_extra_info, $db_review_text, $db_recommend, $db_date_reviewed);
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
                            <td>
								<form action="modifiedreview.php?review_id=<?php $db_review_id ?>" method="GET">
									<input type="submit" name="edit" value="Edit">
									<input type="submit" name="delete" value="Delete">
								</form>
							</td>
                        </tr>


                    <?php ;}?>
            </table>
            
        </div>
    </div>
</body>
</html>
