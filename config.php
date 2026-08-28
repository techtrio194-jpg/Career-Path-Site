<?php
// Database connection
$host = 'localhost';
$user = 'root';
$password = ''; // XAMPP mein password kuch nahi hota
$database = 'db_pathseeker';

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>