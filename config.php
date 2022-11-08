<?php
// This script is ran at runtime
define("db_server", "localhost");
define("db_username", "root");
define("db_password", "");
define("db_name", "Guitar");


// This code automatically highlights errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connection
$conn = new mysqli(db_server, db_username, db_password, db_name);

// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>

