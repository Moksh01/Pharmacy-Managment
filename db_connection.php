<?php
// Connect to MariaDB
$dbname = 'pharmacy_managment';
$dbuser = 'root';
$dbpass = 'moksh@vjti';
$dbhost = 'localhost';
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>