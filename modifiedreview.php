<?php
require_once "config.php";
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
 </body>
 </html>
