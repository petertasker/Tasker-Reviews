<?php
require_once "config.php";
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
        <form action="" method="POST">
            <div class="form__box">
                <h1>Register</h1>
                <label for="username">Username:</label><br>
                <input type="text" name="username" class="input" required><br>

                <label for="email-address">Email Address</label><br>
                <input type="text" name="email-address" class="input" required><br>

                <label for="forename">Forename</label><br>
                <input type="text" name="forename" class="input" required><br>

                <label for="surname">Surname</label><br>
                <input type="text" name="surname" class="input" required><br>

                <label for="password-1">Create Password</label><br>
                <input type="password" name="password-1" class="input" required><br>

                <label for="password-2">Re-enter password</label><br>
                <input type="password" name="password-2" class="input" required><br>
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

                    // Passwords match
                    if (($_POST["password-1"]) != ($_POST["password-2"])) {
                        $errors[] = "Passwords do not match"; 
                    } else {
                        // Nested for user clarity

                        // Password contains uppercase
                        if (!(preg_match("/[A-Z]/", $_POST["password-1"]))) {
                            $errors[] = "Password must contain an uppercase letter";
                        }

                        // Password contains digit
                        if (!(preg_match("/[\d]/", $_POST["password-1"]))) {
                            $errors[] = "Password must contain a digit";
                        }

                        // Password contains special character
                        if (!(preg_match("/\W/", $_POST["password-1"]))) {
                            $errors[] = "Password must contain a special character";
                        }

                        // Password > 7 characters
                        if (strlen($_POST["password-1"]) < 7) {
                            $errors[] = "Password must be greater than 7 characters";
                        }
                        // Password contains no white space
                        if (preg_match("/\s/", $_POST["password-1"])) {
                            $errors[] = "Password should not contain any white space";
                        }

                        // Check for unique email
                        $stmt = $conn -> prepare("SELECT email FROM Users WHERE email = ?");
                        $stmt -> bind_param("s", $_POST['email-address']);
                        $stmt -> execute();
                        $stmt -> store_result();
                        if ($stmt -> num_rows() > 0) {
                            $errors[] = "Email already taken";
                        }
                        // Check for unique username
                        $stmt = $conn -> prepare("SELECT username FROM Users WHERE username = ?");
                        $stmt -> bind_param("s", $_POST['username']);
                        $stmt -> execute();
                        $stmt -> store_result();
                        if ($stmt -> num_rows() > 0) {
                            $errors[] = "Username already taken";
                        }
                    }
                    // List error messages
                    if ($errors) {
                        foreach($errors as $error) {
                            echo "<br><li>".$error."</li>";
                        }
                    // Otherwise go through register process
                    } else {
                        // 1. Hash password
                        $hash_password = password_hash($_POST["password-1"], PASSWORD_DEFAULT);
                        
                        // 2. Create user in database
                        $stmt = $conn -> prepare("INSERT INTO Users(username, email, password, forename, surname) VALUES(?,?,?,?,?)");
                        $stmt -> bind_param("sssss", $_POST["username"], $_POST["email-address"], $hash_password, $_POST["forename"], $_POST["surname"]);
                        $stmt -> execute();
                        // 3. Declare session variables
                        $_SESSION['username'] = $_POST["username"];
                        $_SESSION["email-address"] = $_POST["email-address"];
                        // If admin account
                        if ($db_username == "admin") {
                            $_SESSION["admin"] = True;
                        }

                        // 4. Let user traverse website
                        echo "<br><li>Successfully created account!, please <a class='home-page-link' href='index.php'>click here</a> to go to the home page.</li>";
                    }
                }
                ?>
                </div>
                <br>
                <a href="login.php">Already have an account?</a>

            </div>
        </form>  
    </div>

    
</body>
</html>
.image__overlay a {
  color: white;
}
