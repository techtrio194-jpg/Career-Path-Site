<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';
$user_id = $_SESSION['user_id'];

// Saari careers fetch karo
$sql = "SELECT * FROM tbl_careers ORDER BY career_id DESC";
$result = $conn->query($sql);

$page_title = 'Explore Careers';
include 'includes/header.php';
?>

<div class="container">
    <h1 style="margin-bottom: 20px;">Explore Careers</h1>
    <div class="grid-stats">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['career_name']); ?></h3>
                <p style="color:#687386;"><?php echo htmlspecialchars(substr($row['description'], 0, 80)); ?>...</p>
                <p><strong>Salary:</strong> <?php echo htmlspecialchars($row['salary_range']); ?></p>
                
                <!-- SAVE BUTTON yahan hai -->
            <a href="save_bookmark.php?id=<?php echo $row['career_id']; ?>" class="btn btn-primary">🔖 Save Career</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>