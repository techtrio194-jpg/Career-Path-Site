<?php
include 'config.php';
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    if (empty($name) || empty($email) || empty($password)) { $error = "Fill all fields."; }
    elseif (strlen($password) < 6) { $error = "Password must be 6 chars."; }
    else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        
        // ⚠️ YAHAN GALTI THI: 'id' ki jagah 'user_id' kiya hai
        $check = $conn->prepare("SELECT user_id FROM tbl_users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();
        
        if ($check->num_rows > 0) { $error = "Email already exists."; }
        else {
            $stmt = $conn->prepare("INSERT INTO tbl_users (full_name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hash);
            if ($stmt->execute()) {
                header("Location: login.php");
                exit();
            } else { $error = "Something went wrong."; }
        }
    }
}
$page_title = 'Signup';
include 'includes/header.php';
?>
<div class="card text-center" style="max-width: 450px; margin: 50px auto;">
    <h2>Signup</h2>
    <p class="mt-20" style="color: #687386;">Create your account</p>
    <?php if ($error): ?><div class="alert alert-error"><?php echo $error; ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><input type="text" name="full_name" placeholder="Full Name" required></div>
        <div class="form-group"><input type="email" name="email" placeholder="Email" required></div>
        <div class="form-group"><input type="password" name="password" placeholder="Password (6+ chars)" required></div>
        <button type="submit" class="btn">Signup</button>
    </form>
    <p class="mt-20">Have an account? <a href="login.php" style="color:#4F7CFF;">Login</a></p>
</div>
<?php include 'includes/footer.php'; ?>