<?php
$hostname = "localhost:3309";
$userName = "root";
$password = "";

$dbname = "music";
$conn = new mysqli($hostname, $userName, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected successfully";
}

?>