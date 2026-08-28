<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';

$user_id = $_SESSION['user_id'];
$career_id = intval($_GET['id']);

// Pehle check karo ki duplicate toh nahi hai
$check = $conn->prepare("SELECT * FROM tbl_bookmarks WHERE user_id = ? AND career_id = ?");
$check->bind_param("ii", $user_id, $career_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    // Insert karo
    $stmt = $conn->prepare("INSERT INTO tbl_bookmarks (user_id, career_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $career_id);
    $stmt->execute();
}

// Wapas bhejo
header("Location: bookmarks.php");
exit();
?>