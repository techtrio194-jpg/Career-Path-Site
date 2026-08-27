<?php
include 'config.php';
session_start();

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ---- VALIDATION START ----
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($full_name) || empty($email) || empty($password)) {
        $error = "❌ Please fill in all fields.";
    } elseif (strlen($full_name) < 2) {
        $error = "❌ Name must be at least 2 characters long.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "❌ Please enter a valid email address.";
    } elseif (strlen($password) < 6) {
        $error = "❌ Password must be at least 6 characters long.";
    } else {
        // ---- CHECK DUPLICATE EMAIL ----
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_sql = "SELECT email FROM tbl_users WHERE email = ?";
        $check_stmt = $conn->prepare($check_sql);
        $check_stmt->bind_param("s", $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $error = "❌ This email is already registered! Please use a different email or login.";
        } else {
            // ---- INSERT NEW USER ----
            $sql = "INSERT INTO tbl_users (full_name, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $full_name, $email, $hashed_password);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Account created! Please login.";
                header("Location: login.php");
                exit();
            } else {
                $error = "❌ Something went wrong. Please try again.";
            }
        }
    }
}

$page_title = 'Sign Up - PathSeeker';
include 'includes/header.php';
?>

<div class="container">
    <div class="card">
        <div class="logo" style="text-align:center; font-size:28px; font-weight:700; color:var(--text-dark); margin-bottom:4px;">
            🚀 Path<span style="color:var(--primary);">Seeker</span>
        </div>
        <h2>Create Account</h2>
        <p class="subtitle">Start your career journey today</p>

        <?php if (isset($error) && !empty($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success"><?php echo $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="full_name" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password (min 6 characters)" required minlength="6">
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>

        <div class="text-center mt-3">
            Already have an account? <a href="login.php" class="link">Login</a>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>