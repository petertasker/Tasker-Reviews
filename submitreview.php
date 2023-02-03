<?php    
require_once "config.php";
if (!(isset($_SESSION["username"]))) {
    header("Location: login.php");
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
    <div class="form">
        <form action="" method="POST">
            <div class="form__box">
                <h1>Submit a Review</h1>
                <p style="color:black; margin-left: 10%">*Required</p>
                <label for="make">Make:*</label><br>
                <input type="text" name="make" class="input" required><br>

                <label for="brand">Manufacturer:*</label><br>
                <input list="brands" name="brand" class="input" required><br>

                <datalist id="brand">
                    <?php
                    $stmt = $conn->prepare("SELECT DISTINCT brand_name FROM Brand");
                    $stmt->execute();
                    $stmt->bind_result($db_brand_name);
                    while ($stmt->fetch()){
                    
                    echo "<option value=".$db_brand_name."></option>";
                    }
                    ?>
                    
                    
                </datalist>

                <label for="cost">Cost</label><br>
                <input type="number" name="cost" class="input" min="0.00" max="9999999.99" step="0.01"><br>

                <label for="year-made">Year Made:</label><br>
                <input type="number" name="year-made" class="input" min="1900" max="<?php echo date("Y");?>"><br>

                <label for="extra-info">Extra Information:</label><br>
                <textarea name="extra-info" class="input" type="text" rows="4" cols="50"></textarea><br>

                <label for="review-text">Review Text:*</label><br>
                <textarea name="review-text" class="input" type="text" rows="4" cols="50" Required></textarea><br>

                <div class="radio-container">
                    <label><input class="form-radio" type="radio" name="recommendation" value="1" required><span class="recommend glyphicon glyphicon-thumbs-up"></span></label>
                    <label><input class="form-radio" type="radio" name="recommendation" value="0" required><span class="recommend glyphicon glyphicon-thumbs-down"></span></label>
                </div>
                    <br><br>

                <div class="button-container">
                    <div><input class="button" type="reset" name="reset" value="Reset"></div>
                    <div><input class="button button-2" type="submit" name="submit" value="submit"></div>
                </div>
                <br><br>
                <div class="error-box">
                <?php
                
                if (isset($_POST["submit"])) {
                    // Insert null values instead of empty strings
                    if ($_POST["year-made"] == "") {
                        $_POST["year-made"] = NULL;
                    }
                    
                    if ($_POST["cost"] == "") {
                        $_POST["cost"] = NULL;
                    }
                    
                
                    // Insert new brand details
                    $stmt = $conn -> prepare("INSERT IGNORE INTO Brand(brand_name) VALUES(?)");
                    $stmt -> bind_param("s", $_POST["brand"]);
                    $stmt -> execute();

                    // Insert guitar details
                    $stmt = $conn -> prepare("INSERT INTO Guitar(make, brand_name, year_made, price, extra_info) VALUES(?, ?, ?, ?, ?)");
                    $stmt -> bind_param("ssids", $_POST["make"], $_POST["brand"], $_POST["year-made"], $_POST["cost"], $_POST["extra-info"]);
                    $stmt -> execute();

                    // Insert review details
                    $stmt = $conn -> prepare("INSERT INTO Review(review_text, recommend, date_reviewed, guitar_id, username) VALUES(?, ?, NOW(), (SELECT MAX(guitar_id) FROM Guitar), ?)");
                    $stmt -> bind_param("sis", $_POST["review-text"], $_POST["recommendation"], $_SESSION["username"]);
                    $stmt -> execute();
                
                    // Stop duplicate data on F5
                    header("Location: submitted.php");
                }
                ?>
                </div>
            </div>
        </form>  
    </div> 
</body>
</html>
