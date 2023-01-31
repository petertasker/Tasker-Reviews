<?php
require_once "config.php";
if (!(isset($_SESSION["admin"]))) {
    header("Location: index.php");
}

$stmt = $conn -> prepare("SELECT guitar_id FROM Guitar, Brand WHERE Brand.brand_name = Guitar.brand_name AND Brand.brand_name = ?");
$stmt -> bind_param("s", $_GET["brand_name"]);
$stmt -> execute();
$stmt -> bind_param($db_guitar_id);
while ($stmt -> fetch()) {
	$guitar_id = $db_guitar_id;
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
		<li class="link-msg">This brand has been deleted. <a href='index.php'>Click here</a> to go to the home page, or <a href="brands.php">click here </a>to go back to the brand dashboard.</li>
		<?php 
		
		$guitar_id = (int)$_GET["guitar_id"];
		$stmt = $conn -> prepare("DELETE FROM Review WHERE guitar_id = ?");
		$stmt -> bind_param("i", $guitar_id);
		$stmt -> execute();
		echo "Reviews Deleted!";

		$stmt = $conn -> prepare("DELETE FROM Guitar WHERE guitar_id = ?");
		$stmt -> bind_param("i", $guitar_id);
		$stmt -> execute();
		echo "Guitars Deleted!";

		$stmt = $conn -> prepare("DELETE FROM Brand WHERE brand_name = ?");
		$stmt -> bind_param("s", $_GET["brand_name"]);
		echo "Brand Deleted!";
		?>
    </div>  
</body>
</html>

