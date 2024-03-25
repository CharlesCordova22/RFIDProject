<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'student';
$conn = new mysqli($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to Connect to the Database: " . mysqli_connect_error();
    exit();
}
?>
