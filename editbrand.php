<?php
require_once "config.php";
if ($_SESSION["username"] != "admin") {
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
    <div class="form">
        <form method="POST">
            <div class="form__box">
                <h1>Edit Brand</h1>
                <h2>Deleting a brand will delte all related reviews</h2>
                <label for="make">Brand Name:</label><br>
                <input disabled type="text" class="input" value="<?php echo $_GET["brand_name"]; ?>"><br>

                <label for="brand">Country of Origin:</label><br>
                <input type="text" name="country" class="input" value="<?php echo $db_country; ?>"><br>

                <label for="brand">Website Url:</label><br>
                <input type="text" name="url" class="input" value="<?php echo $db_url; ?>"><br>

                <label for="brand">Date Established (YYYY-MM-DD):</label><br>
                <input type="text" name="date" class="input" value="<?php echo substr($db_date,0 ,10); ?>"><br>
                
                <div class="button-container">
                    <div><input class="button" type="reset" name="reset" value="Reset"></div>
                    <div><input class="button button-2" type="submit" name="submit" value="submit"></div>
                </div>
                <div>
                <?php 
                
                if(isset($_POST["submit"])) {
                    
                    // Validation
                
                    
                    $stmt = $conn -> prepare("UPDATE Brand 
                    SET country_of_origin = ?, website_url = ?, 
                    date_established = ? 
                    WHERE brand_name = ?");

                    $stmt -> bind_param("ssss", $_POST["country"], $_POST["url"], $_POST["date"], $_GET["brand_name"]);
                    $stmt -> execute();
                    header("Location: brands.php");
                    echo "<li>Is your date in the correct format?</li>";
                }
                    
                            
                ?>
                </div>
            </div>
        </form>  
    </div> 
</body>
</html>

