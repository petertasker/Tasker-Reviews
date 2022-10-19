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
    <body>
        <form action="" method="post">
            <p>
                <label for="username">Username*</label>
                <input type="text" name="username" id="username" required>
            </p>
            <p>
                <label for="password">Password*</label>
                <input type="text" name="password" id="password" required>
            </p>
            <p>
                <input value="Login" type="submit" name="Login">
                <input value="reset" type="reset" name="reset">
            </p>
        </form>
        <?php 

        if (isset($_POST["Login"])) {
            //$username = $_POST['username'];
            //$password = $_POST['password'];

            $username =  mysqli_real_escape_string($conn, $_POST['username']); // cleans inputs
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $sql = "SELECT Username, UserPassword FROM Users WHERE Username='$username'";
            $result = mysqli_query($conn,$sql); 
            // will only fetch one row
            while($row = mysqli_fetch_array($result)) {
                $db_password = $row['UserPassword'];
                // if password matches the hashed database password, it redirects to index.php
                // with username session variable
                if (password_verify($password, $db_password)) {
                    $_SESSION['username'] = $username;
                    header('Location: /guitar-web/index.php');

                } 
                else {
                    echo "Incorrect Password";
                }

            }
        }
        ?>
        <a href="/guitar-web/signup.php">Sign up here</a>
    </body>
</html>
