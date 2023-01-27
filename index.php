<?php
require_once "config.php";
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
        <?php
        // If session variable is set the user is logged in.
            if (isset($_SESSION["username"])) {
                echo "<a href='signout.php'><span class='pull-right glyphicon glyphicon-log-out clickable_space'></span></a>";
                echo "<a href='myreviews.php'><span class='pull-right glyphicon glyphicon-list clickable_space'></span></a>"; 
            } else {
                echo "<a href='login.php'><span class='pull-right glyphicon glyphicon-log-in clickable_space'></span></a>";
            }
        ?>
        <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>  
    <div id="index-img-container">
        <div class="image">
            <img class="image__img" src="media/guitarsquare.jpg" alt="Two guitars">
            <div class="image__overlay">
                <div class="image__title"><a href="submitreview.php">Review Guitar</a></div>
                <div class="image__description"><a href="submitreview.php">Click to review a guitar</a></div>
            </div>
        </div>
        <div class="image">
            <img class="image__img" src="media/review.jpg" alt="find reviews">
            <div class="image__overlay">
                <div class="image__title"><a href="searchreview.php">Search Reviews</a></div>
                <div class="image__description"><a href="searchreview.php">Click to find and filter reviews</a></div>
            </div>
        </div>
    </div>

</body>
</html>
