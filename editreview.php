<?php
require_once "config.php";
if (!(isset($_SESSION["username"]))) {
    header("Location: index.php");
}
// Make sure guitar id is there to be edited
if (!(isset($_GET["guitar_id"]))) {
    header("Location: index.php");
}

// Select review details for default form values
$stmt = $conn -> prepare("SELECT make, 
    Brand.brand_name, year_made, price, extra_info, review_text,
    recommend
    FROM Guitar, Brand, Review, Users
    WHERE Brand.brand_name = Guitar.brand_name
        AND Guitar.guitar_id = Review.guitar_id
        AND Users.username = Review.username
        AND Guitar.guitar_id = ?");
$stmt -> bind_param("i", $_GET["guitar_id"]);
$stmt -> execute();
$stmt -> bind_result($db_make, $db_brand_name, $db_year_made,
    $db_price, $db_extra_info, $db_review_text, $db_recommend);

// Fetch results
while ($stmt -> fetch()) {
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
                <h1>Edit Review</h1>
                <p style="color:black; margin-left: 10%">*Required</p>
                <label for="make">Make:*</label><br>
                <input type="text" name="make" class="input" value="<?php echo $db_make; ?>"required><br>

                <label for="brand">Manufacturer:*</label><br>
                <input type="text" name="brand" class="input" value="<?php echo $db_brand_name;?>"required><br>


                <label for="cost">Cost</label><br>
                <input type="number" name="cost" class="input" min="0.00" max="9999999.99" step="0.01" value="<?php echo $db_price;?>"><br>

                <label for="year-made">Year Made:</label><br>
                <input type="number" name="year-made" class="input" min="1900" max="<?php echo date("Y");?>" value="<?php echo $db_year_made?>"><br>

                <label for="extra-info">Extra Information:</label><br>
                <textarea name="extra-info" class="input" type="text" rows="4" cols="50"><?php echo $db_extra_info;?></textarea><br>

                <label for="review-text">Review Text:*</label><br>
                <textarea name="review-text" class="input" type="text" rows="4" cols="50" Required><?php echo $db_review_text;?></textarea><br>

                <div class="radio-container">
                <?php
                // html checked change for recommend
                if ($db_recommend == 0) { ?>
                    <label><input class="form-radio" type="radio" name="recommendation" value="0" required><span class="recommend glyphicon glyphicon-thumbs-up"></span></label>
                <label><input class="form-radio" type="radio" name="recommendation" value="1" checked="checked" required><span class="recommend glyphicon glyphicon-thumbs-down"></span></label>
                <?php
                } else { ?>
                    <label><input class="form-radio" type="radio" name="recommendation" value="1" checked="checked" required><span class="recommend glyphicon glyphicon-thumbs-up"></span></label>
                <label><input class="form-radio" type="radio" name="recommendation" value="0" required><span class="recommend glyphicon glyphicon-thumbs-down"></span></label>
                <?php } ?>
                    
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
                    
                    // Update guitar details
                    $stmt = $conn -> prepare("UPDATE Guitar
                        SET make = ?, brand_name = ?, year_made = ?, price = ?, extra_info = ?
                        WHERE guitar_id = ?");
                    $stmt -> bind_param("sssdsi", $_POST["make"], $_POST["brand"], $_POST["year-made"], 
                        $_POST["price"], $_POST["extra-info"], $_GET["guitar_id"]);
                    $stmt -> execute();
                    
                    // Update review details
                    $stmt = $conn -> prepare("UPDATE Review
                        SET review_text = ?, recommend = ?, date_reviewed = Now()
                        WHERE guitar_id = ?");
                    $stmt -> bind_param("sis", $_POST["review-text"], $_POST["recommendation"], $_GET["guitar_id"]);
                    $stmt -> execute();
                
                    // Stop duplicate data on F5
                    header("Location: myreviews.php");
                }
                ?>
                </div>
            </div>
        </form>  
    </div> 
</body>
</html>

