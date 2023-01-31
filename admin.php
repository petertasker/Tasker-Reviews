<?php
require_once "config.php";
if (!($_SESSION["admin"])) {
	header("Location: index.php");
}

$stmt = $conn -> prepare("SELECT country_of_origin, website_url, date_established FROM Brand WHERE brand_name = ?");
$stmt -> bind_param("s", $_GET["brand_name"]);
$stmt -> execute();
$stmt -> bind_result($db_country, $db_url, $db_date);
while ($stmt -> fetch()){
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
</body>
	<div class="form__box">
        <br>
		<li class="link-msg">Your review has been deleted. <a href='index.php'>Click here</a> to go to the home page, or <a href="myreviews.php">click here </a>to see your reviews.</li>
		<li class="link-msg">Your reviwe</li>
    </div>  

</html>


