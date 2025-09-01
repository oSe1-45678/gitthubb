<?php
$host = "localhost";
$user = "root";   // default in XAMPP
$pass = "";       // default empty in XAMPP
$db   = "github_clone";  // the database you created in phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>