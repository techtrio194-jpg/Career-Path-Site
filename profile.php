<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';
$user_id = $_SESSION['user_id'];
$message = '';

$sql = "SELECT * FROM tbl_profiles WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$profile = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $education = $_POST['education'];
    $skills = $_POST['skills'];
    $interests = $_POST['interests'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    if ($profile) {
        $sql = "UPDATE tbl_profiles SET education=?, skills=?, interests=?, experience=?, bio=? WHERE user_id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $education, $skills, $interests, $experience, $bio, $user_id);
    } else {
        $sql = "INSERT INTO tbl_profiles (user_id, education, skills, interests, experience, bio) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssss", $user_id, $education, $skills, $interests, $experience, $bio);
    }
    
    if ($stmt->execute()) { $message = "Profile saved!"; header("Refresh: 1; url=dashboard.php"); }
    else { $message = "Error saving profile."; }
}
$conn->close();
$page_title = 'Profile';
include 'includes/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h2 class="text-center">Your Profile</h2>
    <?php if ($message): ?><div class="alert-success"><?php echo $message; ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><label>Education</label><input type="text" name="education" value="<?php echo htmlspecialchars($profile['education'] ?? ''); ?>"></div>
        <div class="form-group"><label>Skills</label><input type="text" name="skills" value="<?php echo htmlspecialchars($profile['skills'] ?? ''); ?>"></div>
        <div class="form-group"><label>Interests</label><input type="text" name="interests" value="<?php echo htmlspecialchars($profile['interests'] ?? ''); ?>"></div>
        <div class="form-group"><label>Experience</label><textarea name="experience" style="min-height: 80px;"><?php echo htmlspecialchars($profile['experience'] ?? ''); ?></textarea></div>
        <div class="form-group"><label>Bio</label><textarea name="bio" style="min-height: 80px;"><?php echo htmlspecialchars($profile['bio'] ?? ''); ?></textarea></div>
        <button type="submit" class="btn">Save Profile</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>