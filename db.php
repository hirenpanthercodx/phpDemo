<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = 'LEARNINGDB';

if (mysqli_connect_errno()) echo "Failed to connect to MySQL: " . mysqli_connect_error();

$conn = mysqli_connect($servername, $username, $password, $dbname);

?>