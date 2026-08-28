<?php
include 'config.php';
session_start();
if (isset($_SESSION['user_id'])) { header("Location: quiz.php"); exit(); }
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    if (empty($email) || empty($password)) { $error = "Please fill all fields."; }
    else {
        $sql = "SELECT * FROM tbl_users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                
                // ✅ Ye logic exit() se pehle hai
                if ($user['role'] === 'admin') {
                    header("Location: Admin/dashboard.php");
                } else {
                    header("Location: quiz.php");
                }
                exit(); 
                
            } else { $error = "Incorrect password."; }
        } else { $error = "Email not found."; }
    }
}
$page_title = 'Login';
include 'includes/header.php';  // ✅ Ye line wapas add ki hai (CSS yahan se load hogi)
?>

<div class="card text-center" style="max-width: 450px; margin: 50px auto;">
    <h2>Login</h2>
    <p class="mt-20" style="color: #687386;">Welcome back!</p>
    <?php if ($error): ?><div class="alert alert-error"><?php echo $error; ?></div><?php endif; ?>
    <form method="POST">
        <div class="form-group"><input type="email" name="email" placeholder="Email" required></div>
        <div class="form-group"><input type="password" name="password" placeholder="Password" required></div>
        <button type="submit" class="btn">Login</button>
    </form>
    <p class="mt-20">Don't have an account? <a href="signup.php" style="color:#4F7CFF;">Signup</a></p>
</div>

<?php include 'includes/footer.php'; ?>