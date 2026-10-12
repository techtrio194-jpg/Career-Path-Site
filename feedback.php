<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';
$user_id = $_SESSION['user_id'];
$full_name = $_SESSION['full_name'];
$message = '';

$sql = "SELECT email FROM tbl_users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_email = $stmt->get_result()->fetch_assoc()['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $msg = $_POST['message'];

    $sql = "INSERT INTO tbl_feedback (user_id, name, email, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isss", $user_id, $name, $email, $msg);
    
    if ($stmt->execute()) { $message = "Thank you for your feedback!"; }
    else { $message = "Error submitting feedback."; }
}
$conn->close();
$page_title = 'Feedback';
include 'includes/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="text-center">Feedback</h2>
    <?php if ($message): ?><div class="alert-success"><?php echo $message; ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Name</label><input type="text" name="name" value="<?php echo htmlspecialchars($full_name); ?>"></div>
        <div class="form-group"><label>Email</label><input type="email" name="email" value="<?php echo htmlspecialchars($user_email); ?>"></div>
        <div class="form-group"><label>Message</label><textarea name="message" style="min-height: 120px;" required></textarea></div>
        <button type="submit" class="btn">Submit Feedback</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>