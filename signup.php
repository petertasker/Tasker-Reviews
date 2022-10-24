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
    <body class="form-body">
        <div id="register-form">
            <form name="signup" action="" method="post" onsubmit="return validateSignup()">
                <div class="box">
                    <h1>Register</h1>
                    <input type="forename" name="forename" id="forename" class="input" placeholder="Forename" required>
                    <input type="surname" name="surname" id="surname" class="input" placeholder="Surname" required>
                    <input type="email" name="email" id="email" class="input" placeholder="Email Address" required>
                    <input type="text" name="username" id="username" class="input" placeholder="Username" required>
                    <input type="password" name="password" id="password" class="password" class="input"placeholder="password" required>
                    <div><input class="btn" type="submit" name="submit" value="Submit"></div>
                    <a href="/guitar-web/login.php"><div class="btn"id="btn2">Login Page</div></a>
                    <br><br><br>
                    <?php 
                        if (isset($_POST["submit"])) {
                            
                            // Collects all errors
                            $errors = array();

                            // gets information when submit is clicked
                            //mysqli_real_escape_string() cleans inputs
                            $forename = mysqli_real_escape_string($conn,$_POST['forename']);
                            $surname = mysqli_real_escape_string($conn,$_POST['surname']);
                            $email = mysqli_real_escape_string($conn,$_POST['email']);
                            $username =  mysqli_real_escape_string($conn, $_POST['username']);
                            $password = mysqli_real_escape_string($conn, $_POST['password']);
                            //hashes the password
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            

                            if (strlen($username) < 5) {
                                $errors[] = "Username is not long enough.";
                            }

                            $username_query = "SELECT Username FROM Users WHERE Username = '$username'";
                            $result = (mysqli_query($conn, $username_query));
                            if(mysqli_num_rows($result) > 0) {
                                $errors[] = "Username already taken.";
                            }

                            $email_query = "SELECT Email FROM Users WHERE Email = '$email'";
                            $result = (mysqli_query($conn, $email_query));
                            if(mysqli_num_rows($result) > 0) {
                                $errors[] = "Email already used.";
                            }

        
                            if (!(preg_match('/[0-9]+/', $password))) {
                                $errors[] = "Password must have a digit.";
                            }
                            
                            if (!(preg_match('/[A-Z]+/', $password))){
                                $errors[] = "Password must have one uppercase letter.";
                            }
                            
                            // Displays all the error messages. printf formats it.
                            if (sizeof($errors) > 0) {
                                foreach($errors as $error) {
                                    printf("<li class='error-msg'>%s</li>", $error);
                                }

                            } else {
                                $sql = "INSERT INTO Users(Email, Username, Forename, Surname, UserPassword) 
                                    VALUES('$email', '$username', '$forename', '$surname', '$hashed_password')";
                                if (mysqli_query($conn, $sql)) {
                                    print("<li class='error-msg'>User Created, please <a href='/guitar-web/login.php'>log in</a></li>");
                                } else {
                                    echo mysqli_error($conn);
                                }
                            }       

                        }

                        mysqli_close($conn);
                    ?>
                </div>
                
            </form>
        </div>

        
    </body>
</html>
