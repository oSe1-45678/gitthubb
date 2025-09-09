<?php
$host = "localhost";
$user = "root";   // default in XAMPP
$pass = "";       // default empty in XAMPP
$db   = "github_clone";  // the database you created in phpMyAdmin

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die(" Database connection failed: " . $conn->connect_error);
}
?> 
<?php
// Load environment variables from Render (set in render.yaml or Render dashboard)
$host     = getenv('MYSQL_HOST') ?: '127.0.0.1';
$username = getenv('MYSQL_USER') ?: 'root';
$password = getenv('MYSQL_PASSWORD') ?: '';
$dbname   = getenv('MYSQL_DATABASE') ?: 'github_clone';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
