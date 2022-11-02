<?php
session_unset();
session_destroy();
session_start();
header("Refresh:0");
header('Location: /guitar-web/index.php');
?>