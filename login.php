<?php 
// connect script
require_once "config.php";
require_once "session_start.php";
// start session on this page and login page for the username
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Log In</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body class="form-body">
        <form action="" method="post">
            <div class="box">
                <h1>Log in</h1>
                <input type="text" name="username" class="input" placeholder="username" required>
                <input type="password" name="password" class="password" placeholder="password" required>
                <div><input class="btn" value="Login" type="submit" name="Login"></div>
                <a href="/guitar-web/signup.php"><div class="btn"id="btn2">Sign up here</div></a>
            </div> <!-- end of box-->
        </form>

    <?php 

    if (isset($_POST["Login"])) {
        //$username = $_POST['username'];
        //$password = $_POST['password'];

        $username =  mysqli_real_escape_string($conn, $_POST['username']); // cleans inputs
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT Forename, Username, UserPassword FROM Users WHERE Username='$username'";
        $result = mysqli_query($conn,$sql); 
        // will only fetch one row
        while($row = mysqli_fetch_assoc($result)) {
            $forename = $row['Forename'];
            $db_password = $row['UserPassword'];
            // if password matches the hashed database password, it redirects to index.php
            // with username and forename as session variable
            if (password_verify($password, $db_password)) {
                $_SESSION['username'] = $username;
                $_SESSION['forename'] = $forename;
                header('Location: /guitar-web/index.php');

            } 
            else {
                echo "<p>Incorrect Password</p>";
            }

        }
    }
    ?>
    </body>
</html>
