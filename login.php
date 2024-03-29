<?php

// Peter Tasker SCN: 111310599

require_once "config.php";

// User cannot already be logged in
if (isset($_SESSION["username"])) {
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
        <a href='login.php'><span class='pull-right glyphicon glyphicon-log-in clickable_space'></span></a>
        <a href="index.php"><span class="pull-right glyphicon glyphicon-home clickable_space"></span></a>
    </nav>   
    <div class="form">
        <form action="" method="POST">
            <div class="form__box">
                <h1>Log In</h1>
                <label for="username">Username:</label><br>
                <input type="text" name="username" class="input" required><br>

                <label for="password">Password:</label><br>
                <input type="password" name="password" id="password" class="input" required>


                <div class="button-container">
                    <div><input class="button" type="reset" name="reset" value="Reset"></div>
                    <div><input class="button button-2" type="submit" name="submit" value="submit"></div>
                </div>
                <br><br>
                <div class="error-box">
                <?php
                    if (isset($_POST["submit"])) {  
                        // Form submission validation
                        
                        $errors = array();

                    // Check if user exists, gets required data
                    $stmt = $conn -> prepare("SELECT username, password FROM Users WHERE username = ?");
                    $stmt -> bind_param("s", $_POST["username"]);
                    $stmt -> execute();
                    $stmt -> store_result();
                    $stmt -> bind_result($db_username, $db_password);

                        // Loops for each result, although there can only be one.
                        if ($stmt -> num_rows() == 0) {
                            $errors[] = "User not found";
                        } else {
                            // Verifies password
                            while ($stmt -> fetch()) {
                                if (password_verify($_POST["password"], $db_password)) {
                                    // Set session variables and redirect
                                    $_SESSION["username"] = $db_username;
                                    // If admin account
                                    if ($_SESSION["username"] == "admin") {
                                        header("Location: admin.php");
                                    }
                                    header("Location: index.php");
                                } else {
                                    $errors[] = "Password is incorrect";
                                }
                            }
                        }
                        // List error messages
                        if ($errors) {
                            foreach($errors as $error) {
                                echo "<br><li>".$error."</li>";
                            }
                        }
                    }   
                ?>
                </div>
                <br>
                <a href="register.php">Don't have an account?</a>

            </div>
        </form>  
    </div> 
</body>
</html>
