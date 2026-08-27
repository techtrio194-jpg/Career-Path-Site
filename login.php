<?php
include 'config.php';
session_start();

// Agar already logged in hai toh quiz par bhejo
if (isset($_SESSION['user_id'])) {
    header("Location: quiz.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ---- VALIDATION START ----
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "❌ Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "❌ Please enter a valid email address.";
    } else {
        // ---- DATABASE CHECK ----
        $sql = "SELECT user_id, full_name, password, role FROM tbl_users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                // ---- LOGIN SUCCESS - SAVE SESSION ----
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];
                header("Location: quiz.php");
                exit();
            } else {
                $error = "❌ Incorrect password.";
            }
        } else {
            $error = "❌ Email not found. Please sign up first.";
        }
    }
}

$page_title = 'Login - PathSeeker';
include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="logo" style="text-align:center; font-size:28px; font-weight:700; color:var(--text-dark); margin-bottom:4px;">
            🚀 Path<span style="color:var(--primary);">Seeker</span>
        </div>
        <h2>🔐 Welcome Back</h2>
        <p class="subtitle">Login to continue your career journey</p>

        <?php if (isset($error) && !empty($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="text-center mt-3">
            New here? <a href="signup.php" class="link">Create Account</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>