<html>
<?php
require_once "config.php";
?>
<head>
    <title>Tasker Reviews</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <nav class="navbar">
        <?php
        // If session variable is set the user is logged in.
            if ((isset($_SESSION["username"])) || (isset($_SESSION["email"]))) {
                echo "<a href='signout.php'><span class='pull-right glyphicon glyphicon-log-out clickable_space'></span></a>";
                echo "<a href='myreviews.php'><span class='pull-right glyphicon glyphicon-list clickable_space'></span></a>"; 
            } else {
                echo "<a href='login.php'><span class='pull-right glyphicon glyphicon-log-in clickable_space'></span></a>";
            }
        ?>
        <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>
    <div class="search-review">
        <div class="search-review__filter">
            <h1>Search and filter</h1>
            <form>
                <label for="keyword">keyword</label>
                <input name="keyword" class="filter-input">
                <input type="button" class="filter-button" value="filter">
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
                    <td>Review Tetxt</td>
                    <td>Recommend</td>
                    <td>Username</td>
                    <td>Date Reviewed</td>
                </tr>

                <?php 

                    $stmt = $conn -> prepare("
                        SELECT make, Brand.brand_name, year_made, price, extra_info, review_text, recommend, Users.username, date_reviewed
                        FROM Brand, Users, Guitar, Review
                        WHERE Brand.brand_name = Guitar.brand_name AND Guitar.guitar_id = Review.guitar_id 
                            AND Users.username = Review.username");
                    $stmt -> execute();
                    $stmt -> bind_result($db_make, $db_brand_name, $db_year_made, $db_price, $db_extra_info, $db_review_text, $db_recommend, $db_username, $db_date_reviewed);
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
                            <td><?php echo $db_username; ?></td>
                            <td><?php echo $db_date_reviewed; ?></td>
                        </tr>


                    <?php ;}?>
            </table>
            
        </div>
    </div>
</body>
</html>