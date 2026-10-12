<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }
include '../config.php';

$sql = "SELECT question_id, question_text, created_at FROM tbl_quiz_questions ORDER BY created_at DESC";
$result = $conn->query($sql);

$page_title = 'Manage Quiz';
include '../includes/header.php';
?>

<div class="container">
    <h1 style="margin-bottom: 20px;">Manage Quiz</h1>
    
    <!-- YE BUTTON MISSING THA -->
    <div style="margin-bottom: 20px;">
        <a href="add_question.php" style="background:#4F7CFF; color:#fff; padding:10px 20px; border-radius:8px; text-decoration:none; font-weight:600;">+ Add New Question</a>
    </div>
    <!-- BUTTON END -->

    <div class="table-container">
        <table>
            <thead><tr><th>ID</th><th>Question</th><th>Created At</th></tr></thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['question_id']; ?></td>
                        <td><?php echo htmlspecialchars($row['question_text']); ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3" style="text-align: center;">No questions added yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../includes/footer.php'; ?>