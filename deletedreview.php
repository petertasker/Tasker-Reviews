<?php

// Peter Tasker SCN: 111310599

require_once "config.php";
// Make sure a user who is not signed out can access this page
if (!(isset($_SESSION["username"]))) {
    header("Location: index.php");
}
// Make sure guitar id is there to be deleted
if (!(isset($_GET["guitar_id"]))) {
    header("Location: index.php");
}
// Delete from Review
$guitar_id = (int)$_GET["guitar_id"];
$stmt = $conn -> prepare("DELETE FROM Review WHERE guitar_id = ?");
$stmt -> bind_param("i", $guitar_id);
$stmt -> execute();

// Delete from Guitar
$stmt = $conn -> prepare("DELETE FROM Guitar WHERE guitar_id = ?");
$stmt -> bind_param("i", $guitar_id);
$stmt -> execute();
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
		<li class="link-msg">Your review has been deleted. <a href='index.php'>Click here</a> to go to the home page, or <a href="myreviews.php">click here </a>to see your reviews.</li>
    </div>  
</body>
</html>
