<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }
include '../config.php';

$message = '';
$careers_result = $conn->query("SELECT career_id, career_name FROM tbl_careers ORDER BY career_name");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_text = trim($_POST['question_text']);
    $options = $_POST['options']; 
    $career_ids = $_POST['career_ids']; 

    if (empty($question_text) || count($options) < 4 || count($career_ids) < 4) {
        $message = "Please fill all fields.";
    } else {
        $stmt = $conn->prepare("INSERT INTO tbl_quiz_questions (question_text) VALUES (?)");
        $stmt->bind_param("s", $question_text);
        if ($stmt->execute()) {
            $question_id = $conn->insert_id;
            $stmt->close();

            $stmt = $conn->prepare("INSERT INTO tbl_quiz_options (question_id, option_text, career_id) VALUES (?, ?, ?)");
            for ($i = 0; $i < 4; $i++) {
                $opt = trim($options[$i]);
                $cid = intval($career_ids[$i]);
                if (!empty($opt) && $cid > 0) {
                    $stmt->bind_param("isi", $question_id, $opt, $cid);
                    $stmt->execute();
                }
            }
            $stmt->close();
            $message = "Question added successfully!";
        } else {
            $message = "Error adding question.";
        }
    }
}

$page_title = 'Add New Question';
include '../includes/header.php';
?>

<div class="container">
    <h1 style="margin-bottom: 20px;">Add New Question</h1>
    <?php if ($message): ?>
        <div class="alert-success"><?php echo $message; ?></div>
    <?php endif; ?>
    
    <form method="POST">
        <div class="form-group">
            <label>Question Text</label>
            <textarea name="question_text" style="min-height: 80px;" required></textarea>
        </div>

        <?php for ($i = 1; $i <= 4; $i++): ?>
            <div class="form-group">
                <label>Option <?php echo $i; ?></label>
                <input type="text" name="options[]" required>
                <label>Career for this option</label>
                <select name="career_ids[]" required>
                    <option value="">Select Career</option>
                    <?php while ($career = $careers_result->fetch_assoc()): ?>
                        <option value="<?php echo $career['career_id']; ?>"><?php echo htmlspecialchars($career['career_name']); ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        <?php endfor; ?>

        <button type="submit" class="btn btn-primary">Add Question</button>
    </form>
    <div class="mt-20">
        <a href="managequiz.php" class="btn-link">← Back to Manage Quiz</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>