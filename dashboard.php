<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';
$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];

$sql = "SELECT * FROM tbl_profiles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$profile = $stmt->get_result()->fetch_assoc();

$sql = "SELECT r.*, c.career_name FROM tbl_quiz_results r JOIN tbl_careers c ON r.career_id = c.career_id WHERE r.user_id = ? ORDER BY r.taken_at DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$last_result = $stmt->get_result()->fetch_assoc();

$sql = "SELECT COUNT(*) as count FROM tbl_bookmarks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$saved_count = $stmt->get_result()->fetch_assoc()['count'];

$sql = "SELECT COUNT(*) as count FROM tbl_quiz_results WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$quiz_count = $stmt->get_result()->fetch_assoc()['count'];

$conn->close();
$page_title = 'Dashboard';
include 'includes/header.php';
?>

<div class="card">
    <h1>Welcome, <?php echo htmlspecialchars($full_name); ?>!</h1>
    <?php if (!$profile): ?><div class="alert-warning">Please complete your profile <a href="profile.php">here</a>.</div><?php endif; ?>
</div>

<div class="grid-stats">
    <div class="card text-center">
        <div class="stat-number"><?php echo $last_result ? $last_result['match_percentage'] . '%' : '—'; ?></div>
        <div class="stat-label">Latest Match</div>
        <?php if ($last_result): ?><div class="stat-detail"><?php echo htmlspecialchars($last_result['career_name']); ?></div><?php endif; ?>
    </div>
    <div class="card text-center">
        <div class="stat-number"><?php echo $saved_count; ?></div>
        <div class="stat-label">Saved Careers</div>
    </div>
    <div class="card text-center">
        <div class="stat-number"><?php echo $quiz_count; ?></div>
        <div class="stat-label">Quizzes Taken</div>
    </div>
</div>

<div class="grid-links">
    <a href="quiz.php" class="link-card">🧠 Take Quiz</a>
    <a href="careers.php" class="link-card">💼 Explore Careers</a> <!-- ✅ Ye line add ki hai -->
    <a href="profile.php" class="link-card">👤 Profile</a>
    <a href="bookmarks.php" class="link-card">🔖 Bookmarks</a>
    <a href="feedback.php" class="link-card">💬 Feedback</a>
    <?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="Admin/dashboard.php" class="link-card admin-card">⚙️ Admin</a>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>