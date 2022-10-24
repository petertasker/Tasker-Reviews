<?php
// this script is ran at runtime
define("db_server", "localhost");
define("db_username", "root");
define("db_password", "root");
define("db_name", "Guitar");

// connect
$conn = mysqli_connect(db_server, db_username, db_password, db_name);

// check connection
if($conn === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>