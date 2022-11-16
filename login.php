

<?php 
// connect script
require_once "config.php";
require_once "session_start.php";
if (isset($_SESSION["forename"])) {
        header('Location: /guitar-web/index.php');
}
if (isset($_SESSION["username"])) {
        header('Location: /guitar-web/index.php');
}

        
// start session on this page and login page for the username
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Log In</title>
        <link rel="stylesheet" href="style.css">
        <link rel="shortcut icon" href="media/gtr-favicon.ico"/>
    </head>
    <body class="form-body">
        <div class="top">
            <ul>
                <a class="nav-link" href="login.php">Log In</a>
                <a class="nav-link" href="signup.php">Sign up</a>
                <a class="nav-link" href="index.php">Home</a>
            </ul>
        </div>
        <form action="" method="post">
            <div class="box">
                <h1>Log in</h1>
                <input type="text" name="username" class="input" placeholder="username" required>
                <input type="password" name="password" class="password" placeholder="password" required>
                <div><input class="btn" value="Login" type="submit" name="Login"></div>
                <div><input class="btn"id="btn2" value="reset" name="reset" type="reset"></div> 
                <?php 
                
                        
                if (isset($_POST["Login"])) {
                        $username =  mysqli_real_escape_string($conn, $_POST['username']); // cleans inputs
                        $password = mysqli_real_escape_string($conn, $_POST['password']);

                        // Prepared statement finding user in the database
                        $stmt = $conn -> prepare("SELECT Forename, Username, UserPassword, Email FROM Users WHERE Username = ?");
                        // Bind parameters s - string
                        $stmt -> bind_param("s", $username);
                        $stmt -> execute();
                        $stmt -> store_result();
                        $stmt -> bind_result($db_forename, $db_username, $db_password, $db_email);
                        $num_rows = $stmt -> num_rows();
                        if ($num_rows > 0) {
                            while ($stmt -> fetch()) {
                                if (password_verify($password, $db_password)) {
                                    $_SESSION['username'] = $db_username;
                                    $_SESSION['forename'] = $db_forename;
                                    $_SESSION['email'] = $db_email;
                                    header('Location: /guitar-web/index.php');
                                } else {   
                                    echo "<br><br><br><br><li class='login-msg'>Incorrect Password</li>";
                                }
                        }
                            
                        } else {
                            echo "<br><br><br><br><li class='login-msg'>User not found!</li>";
                        }
                }
                    ?>
            </div> <!-- end of box-->
        </form>

    
    </body>
</html>
