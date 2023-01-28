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
                <label for="make">Make:</label><br>
                <input type="text" name="make" class="input"><br>

                <label for="brand">Manufacturer:</label><br>
                <input type="text" name="brand" class="input"><br>

                <div>
                <label for="cost">Cost (between):</label><br>
                <input style="width:40%" type="number" name="cost-low" class="input" min="0.00" max="9999999.99" step="0.01" value="0">
                <input style ="width:40%"type="number" name="cost-high" class="input" min="0.00" max="9999999.99" step="0.01" value="1000"><br>
                </div>
                <label for="year-made">Year Made (type "198" for 1980's or "2015" for 2015):</label><br>
                <input type="number" name="year-made" class="input" max="<?php echo date("Y");?>"><br>

                <label for="extra-info">Extra Information:</label><br>
                <textarea name="extra-info" class="input" type="text" rows="4" cols="50"></textarea><br>

                <div class="radio-container">
                    <label><input class="form-radio" type="radio" name="recommendation" value="1"><span class="recommend glyphicon glyphicon-thumbs-up"></span></label>
                    <label><input class="form-radio" type="radio" name="recommendation" value="0"><span class="recommend glyphicon glyphicon-thumbs-down"></span></label>
                </div>
                    <br>
                
                <label for="username">Username:</label><br>
                <input type="text" name="username" class="input"><br><br>
                
                <div class="button-container">
                    <div><input class="button" type="reset" name="reset" value="Reset"></div>
                    <div><input class="button button-2" type="submit" name="submit" value="submit"></div>
                </div>
            </div>
        </form>  
    </div> 
</body>
</html>
