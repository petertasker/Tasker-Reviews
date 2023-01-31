<?php
require_once "config.php";
if (!(isset($_SESSION["admin"]))) {
    header("Location: index.php");
}

$results = array();

$stmt = $conn -> prepare("SELECT guitar_id FROM Guitar, Brand WHERE Brand.brand_name = Guitar.brand_name AND Brand.brand_name = ?");
$stmt -> bind_param("s", $_GET["brand_name"]);
$stmt -> execute();
$stmt -> bind_result($db_guitar_id);
$stmt -> store_result();

// Loop for each revew result and delete
while ($stmt -> fetch()) {
	$results[] = $db_guitar_id;
}
echo $results;
foreach($results as $result) {
	// Each individual review
}

 while ($stmt -> fetch()) {
	$stmt = $conn -> prepare("DELETE FROM Review WHERE guitar_id = ?");
	$stmt -> bind_param("i", $db_guitar_id);
	$stmt -> execute();
	echo "Review Deleted!";

	$stmt = $conn -> prepare("DELETE FROM Guitar WHERE guitar_id = ?");
	$stmt -> bind_param("i", $db_guitar_id);
	$stmt -> execute();
	echo "Guitar Deleted!";
}
// TODO: have (if admin && previous location = admin.php) for searchreveiw
// Delete the brand
// $stmt = $conn -> prepare("DELETE FROM Brand WHERE brand_name = ?");
// $stmt -> bind_param("s", $_GET["brand_name"]);
// echo "Brand Deleted!";


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
		<li class="link-msg">This brand has been deleted. <a href='index.php'>Click here</a> to go to the home page, or <a href="brands.php">click here </a>to go back to the brand dashboard.</li>
		<?php 
		
		?>
    </div>  
</body>
</html>

