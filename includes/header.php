<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
    <title><?php echo $page_title ?? 'PathSeeker'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<nav class="navbar">
    <div class="logo">🚀 Path<span>Seeker</span></div>
    <div class="user-info">
        <?php if (isset($_SESSION['user_id'])): ?>
            👋 <?php echo htmlspecialchars($_SESSION['full_name']); ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                <a href="admin/dashboard.php" style="color:#7C5CFC;">⚙️ Admin</a>
            <?php endif; ?>
            <a href="logout.php" class="btn-logout">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>
        <?php endif; ?>
    </div>
</nav>