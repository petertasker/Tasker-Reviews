<?php

// Peter Tasker SCN: 111310599

require_once "config.php";

// User must be admin account
if ($_SESSION["username"] != "admin") {
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
        <a href='signout.php'><span class='pull-right glyphicon glyphicon-log-out clickable_space'></span></a>
        <a href='myreviews.php'><span class='pull-right glyphicon glyphicon-list clickable_space'></span></a>
        <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>
    <div class="form__box">
        <br>
        <li class="link-msg"><a href="brands.php">Brand Dashboard</a></li>
        <li class="link-msg"><a href="myreviews.php">All reviews</a></li>
    </div>  
</body>
	

</html>


