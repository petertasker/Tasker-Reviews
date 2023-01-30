<?php
require_once "config.php";
if (!(isset($_GET["brand_name"])) || ((!(isset($_SESSION["admin"]))))) {
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
        <form action="searchreview.php" method="GET">
            <div class="form__box">
                <h1>Filter Review</h1>
                <label for="make">Brand Name:</label><br>
                <input disabled type="text" name="make" class="input" value="<?php echo $_GET["brand_name"]; ?>"><br>

                <label for="brand">Country of Origin:</label><br>
                <input type="text" name="brand" class="input"><br>

                <label for="brand">Website Url:</label><br>
                <input type="text" name="brand" class="input"><br>

                <label for="brand">Date Established:</label><br>
                <input type="text" name="brand" class="input"><br>
                
                <div class="button-container">
                    <div><input class="button" type="reset" name="reset" value="Reset"></div>
                    <div><input class="button button-2" type="submit" name="submit" value="submit"></div>
                </div>
            </div>
        </form>  
    </div> 
</body>
</html>

