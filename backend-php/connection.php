<?php
$servername = "127.0.0.1";  // Change this to your MySQL server name
$username = "root";  // Change this to your MySQL username
$password = "";  // Change this to your MySQL password
$dbname = "react";  // Change this to your MySQL database name

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
