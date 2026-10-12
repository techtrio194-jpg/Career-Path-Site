<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }
include '../config.php';

$page_title = 'Admin Dashboard';
include '../includes/header.php';
?>

<div class="card text-center" style="max-width: 700px; margin: 0 auto;">
    <h2>Admin Dashboard</h2>
    <p style="color: #687386;">Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?></p>
</div>

<div class="grid-admin">
    <a href="users.php" class="link-card"><div style="font-size: 40px;">👥</div>Manage Users</a>
    <a href="careers.php" class="link-card"><div style="font-size: 40px;">💼</div>Manage Careers</a>
    <a href="managequiz.php" class="link-card"><div style="font-size: 40px;">📝</div>Manage Quiz</a>
    <a href="../feedback.php" class="link-card"><div style="font-size: 40px;">💬</div>Feedback</a>
</div>

<?php include '../includes/footer.php'; ?>