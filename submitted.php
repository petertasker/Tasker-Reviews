<?php

// Peter Tasker SCN: 111310599

require_once "config.php";

// Make sure a user who is not signed out can access this page
if (!(isset($_SESSION["username"]))) {
    header("Location: index.php");
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
    <a href="myreviews.php"><span class="pull-right glyphicon glyphicon-list clickable_space"></span></a>"
    <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>
   
    <div class="form__box">
        <br>
        <li class="link-msg">Thank you for submitting your review. <a href='index.php'>Click here</a> to go to the home page, or <a href="myreviews.php">click here </a>to see your reviews.</li>
    </div>
    
</body>
</html>
