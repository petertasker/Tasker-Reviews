<?php
session_unset();
session_destroy();
session_start();
header('Location: /guitar-web/index.php');
?>