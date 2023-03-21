<?php

// Peter Tasker SCN: 111310599

require_once "config.php";

// User must be admin account
if ($_SESSION["username"] != "admin") {
    header("Location: index.php");
}
// Brand name must be in URL
if (!(isset($_GET["brand_name"]))) {
    header("Location: index.php");
}
// Query to find if any reviews use this guitar_id.
$stmt = $conn -> prepare("SELECT guitar_id FROM Guitar, Brand WHERE Brand.brand_name = Guitar.brand_name AND Brand.brand_name = ?");
$stmt -> bind_param("s", $_GET["brand_name"]);
$stmt -> execute();
$stmt -> bind_result($db_guitar_id);

// Loop for each query result and append to array
while ($stmt -> fetch()) {
}
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
    <a href="myreviews.php"><span class="pull-right glyphicon glyphicon-list clickable_space"></span></a>
    <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>
    <div class="form__box">
        <br>
        <?php
        // If there were any results of the query, then the DELETE query will not be ran
        if ($db_guitar_id) {
        echo "<li class='link-msg'>Cannot delete! Please delete all reviews from this brand</li>";
        echo "<li class='link-msg'><a href='brands.php'>Click here</a> to go back to the Brand Dashboard</li>";
        } else {
            $stmt = $conn -> prepare("DELETE FROM Brand WHERE brand_name = ?");
            $stmt -> bind_param("s", $_GET["brand_name"]);
            $stmt -> execute();
            
            echo "<li class='link-msg'>Brand Deleted! <a href='brands.php'>Click here</a> to go the Brand Dashboard</li>";
        }
        ?>
    </div>  
</body>
</html>

