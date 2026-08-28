<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }
include '../config.php';

$sql = "SELECT career_id, career_name, description, salary_range FROM tbl_careers ORDER BY career_id DESC";
$result = $conn->query($sql);

$page_title = 'Manage Careers';
include '../includes/header.php';
?>

<div class="container">
    <h1 style="margin-bottom: 20px;">Manage Careers</h1>
    <div class="table-container">
        <table>
            <thead><tr><th>ID</th><th>Career</th><th>Description</th><th>Salary</th></tr></thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['career_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['career_name']); ?></td>
                    <td><?php echo htmlspecialchars(substr($row['description'], 0, 60)) . '...'; ?></td>
                    <td><?php echo htmlspecialchars($row['salary_range']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>