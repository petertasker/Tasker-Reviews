<html>
<?php
require_once "config.php";

// Make sure a user who is not signed out can access this page
if (!(isset($_SESSION["username"]))) {
    header("Location: index.php");
} else {
    session_destroy();
}
?>

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
   
    <div class="form__box">
        <li class="link-msg">You have been logged out. <a href='index.php'>Click here</a> to go to the home page.</li>
    </div>
    
</body>
</html>