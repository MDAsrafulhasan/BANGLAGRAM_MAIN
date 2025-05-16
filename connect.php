<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "banglagram";
$port = 3306;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>