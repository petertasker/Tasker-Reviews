<?php

// Peter Tasker SCN: 111310599

define("db_server", "localhost");
define("db_username", "root");
define("db_password", "");
define("db_name", "guitar_database");

// Automatiacally highlights any MySQL errors
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connect
$conn = new mysqli(db_server, db_username, db_password, db_name);

if ($conn === false) {
    die("ERROR: Could not connect." . mysqli_connect_error());
}

session_start();

?>


