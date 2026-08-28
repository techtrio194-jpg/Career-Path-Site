<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';
$user_id = $_SESSION['user_id'];

$sql = "SELECT b.*, c.career_name FROM tbl_bookmarks b JOIN tbl_careers c ON b.career_id = c.career_id WHERE b.user_id = ? ORDER BY b.created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$bookmarks = $stmt->get_result();
$conn->close();

$page_title = 'Bookmarks';
include 'includes/header.php';
?>

<h1 style="margin-bottom: 20px;">Your Bookmarks</h1>
<?php if ($bookmarks->num_rows > 0): ?>
    <div class="grid-stats">
        <?php while ($row = $bookmarks->fetch_assoc()): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['career_name']); ?></h3>
                <p style="color:#687386;">Saved on: <?php echo $row['created_at']; ?></p>
                <a href="career-details.php?id=<?php echo $row['career_id']; ?>" class="btn-link">View Details →</a>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <div class="card text-center" style="color:#687386;">You haven't saved any careers yet.</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>