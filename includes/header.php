<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'PathSeeker'; ?></title>
    <link rel="stylesheet" href="http://localhost/pathseeker/assets/css/style.css">
</head>
<body>
<nav class="navbar">
    <div class="logo">🚀 Path<span>Seeker</span></div>
    <div class="user-info">
        <?php if (isset($_SESSION['user_id'])): ?>
            👋 <?php echo htmlspecialchars($_SESSION['full_name']); ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="http://localhost/pathseeker/Admin/dashboard.php">⚙️ Admin</a>
            <?php endif; ?>
            <a href="http://localhost/pathseeker/logout.php" class="logout">Logout</a>
        <?php else: ?>
            <a href="http://localhost/pathseeker/login.php">Login</a>
            <a href="http://localhost/pathseeker/signup.php">Signup</a>
        <?php endif; ?>
    </div>
</nav>
<div class="container">