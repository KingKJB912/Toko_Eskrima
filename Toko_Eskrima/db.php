<?php
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Your MySQL password
$dbname = "tokoeskrima"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
