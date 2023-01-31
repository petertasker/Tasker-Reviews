<?php
require_once "config.php";
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
		<a href="signout.php"><span class="pull-right glyphicon glyphicon-log-out clickable_space"></span></a>
		<a href="myreviews.php"><span class="pull-right glyphicon glyphicon-list clickable_space"></span></a>"
        <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>
    <div class="search-review">
    <div class="search-review__filter">
		<h1>Edit Brand</h1>
	</div>
	</div>
		<div class="search-review__box">
		
			<table class="table">
				
				<tr class="header">
					<td>Brand Name</td>
					<td>Country of Origin</td>
					<td>Website url</td>
					<td>Date Established</td>
					<td>Action</td>
				</tr>
				<?php 
				$sql = "
					SELECT brand_name, country_of_origin, website_url, date_established
					FROM Brand";
				$stmt = $conn -> prepare($sql);
				$stmt -> execute();
				$stmt -> bind_result($db_brand_name, $db_country_of_origin, $db_website_url, $db_date_established);
				while ($stmt -> fetch()) {
				?>
				<tr>
					<td><?php echo $db_brand_name; ?></td>
					<td><?php echo $db_country_of_origin ?></td>
					<td><?php echo $db_website_url; ?></td>
					<td><?php echo $db_date_established; ?></td>
					<td>
						<div style="display:flex;">
							<form action="editbrand.php" method="GET">
								<button value="<?php echo $db_brand_name;?>" type="submit" name="brand_name">Edit</button>
							</form>
							<form action="deletedbrand.php" method="GET">
								<button value="<?php echo $db_brand_name;?>" type="submit" name="brand_name">Delete</button>
							</form>
						</div>
					</td>
				</tr>
			<?php ;}?>
			</table>
        </div>
    </div>
</body>
</html>

