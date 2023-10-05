<?php
// db values
$dbhost = "127.0.0.1";
$dbport = "8889";
$dbuser = "root";
$dbpass = "root";
$dbname = "edusogno";

// Create connection
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname, $dbport);

// Check connection
if (!$conn) {
    echo "Connection failed: " . mysqli_connect_error();
} else {
    echo "Connected successfully";
}
