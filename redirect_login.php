<?php 
//redirects to login if username is not set.
if (!(isset($_SESSION['username']))) {
    header('Location: /guitar-web/login.php');

if (!(isset($_SESSION['forename']))) {
  header('Location: /guitar-web/login.php');
}
?>
