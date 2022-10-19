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
        <title>Guitar Reviews</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="script.js"></script>
    </head>
    <body>
        <div id="register-form">
            <form name="signup" action="" method="post" onsubmit="return validateSignup()">
                <p>
                    <label for="email">Email Address*:</label>
                    <input type="email" name="email" id="email" required>
                </p>
                <p>
                    <label for="username">Username*:</label>
                    <input type="text" name="username" id="username" required>
                </p>
                <p>
                    <label for="password">Password*:</label>
                    <input type="text" name="password" id="password" required><br><br>

                    <input type="submit" name="submit" value="Submit">
                    <input type="reset" value ="reset">
                
            </form>
            <p> *required </p>
            <p id="error"></p>
        </div>


        <?php 
        if (isset($_POST["submit"])) {

            // gets information when submit is clicked
            //mysqli_real_escape_string() cleans inputs
            $email = mysqli_real_escape_string($conn,$_POST['email']);
            $username =  mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            //hashes the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO Users(Username, Email, UserPassword) 
                VALUES('$username', '$email', '$hashed_password')";
            if (mysqli_query($conn, $sql)) {
                echo "User Created, please <a href='/guitar-web/login.php'>log in</a>";
            } else {
                echo "Email / Username already used.";
                echo "If you have an account,<a href='/guitar-web/login.php'>log in</a>";
            }
        }
        mysqli_close($conn);
        ?>
    </body>
</html>
