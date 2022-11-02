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
<<<<<<< HEAD
                <a href="/guitar-web/signup.php"><div class="btn"id="btn2">Sign up here</div></a>
                <br><br><br>
                <?php 

                    if (isset($_POST["Login"])) {
                        //$username = $_POST['username'];
                        //$password = $_POST['password'];

                        $errors = array();

                        $username =  mysqli_real_escape_string($conn, $_POST['username']); // cleans inputs
                        $password = mysqli_real_escape_string($conn, $_POST['password']);

                        // Prepared statement
                        $stmt = $conn->prepare("SELECT Forename, Username, UserPassword FROM Users WHERE Username= ? ");
                        $stmt -> bind_param("s", $username); // "s" means string
                        $stmt -> execute();
                        $result = $stmt -> get_result();
                        
                        
                        
                        // will only fetch one row
                        while ($row = $result -> fetch_assoc()) {
                            $forename = $row['Forename'];
                            $db_password = $row['UserPassword'];
                            // if password matches the hashed database password, it redirects to index.php
                            // with username and forename as session variable
                            if (password_verify($password, $db_password)) {
                                $_SESSION['username'] = $username;
                                $_SESSION['forename'] = $forename;
                                header('Location: /guitar-web/index.php');
                            } else {
                                $errors[] = "Password do not match!";
                            }
                        
                        }
                    
                        
                        
                    

                        if (sizeof($errors) > 0) {
                            foreach($errors as $error) {
                                printf("<li class='error-msg'>%s</li>", $error);
                            }
                        }
                    }
                    mysqli_close($conn);
                ?>
=======
                <a href="/guitar-web/signup.php"><div class="btn"id="btn2">Sign up here</div></a><br><br><br><br>
                <?php 

    if (isset($_POST["Login"])) {
        $username =  mysqli_real_escape_string($conn, $_POST['username']); // cleans inputs
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Prepared statement finding user in the database
        $stmt = $conn -> prepare("SELECT Forename, Username, UserPassword FROM Users WHERE Username = ?");
        // Bind parameters s - string
        $stmt -> bind_param("s", $username);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($db_forename, $db_username, $db_password);
        $num_rows = $stmt -> num_rows();
        if ($num_rows > 0) {
            while ($stmt -> fetch()) {
                if (password_verify($password, $db_password)) {
                    $_SESSION['username'] = $db_username;
                    $_SESSION['forename'] = $db_forename;
                    header('Location: /guitar-web/index.php');
                } else {   
                    echo "<li class='login-msg'>Incorrect Password</li>";
                }
            }
            
        } else {
            echo "<li class='login-msg'>User not found!</li>";
        }
    }
    ?>
>>>>>>> 5028c8095d4f387e9ba9c14c81a4ce41be0da784
            </div> <!-- end of box-->
        </form>

    
    </body>
</html>
