<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }
include '../config.php';

$sql = "SELECT user_id, full_name, email, role, created_at FROM tbl_users ORDER BY created_at DESC";
$result = $conn->query($sql);

$page_title = 'Manage Users';
include '../includes/header.php';
?>

<div class="container">
    <h1 style="margin-bottom: 20px;">Manage Users</h1>
    <div class="table-container">
        <table>
            <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Joined</th></tr></thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>