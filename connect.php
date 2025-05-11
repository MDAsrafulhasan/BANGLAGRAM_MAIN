<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "banglagram";
$port = 3310;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>