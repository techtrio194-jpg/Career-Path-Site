<?php
/**
 * Register — frontend UI (Bootstrap / ps-card design) wired to the existing
 * backend registration logic (config.php, tbl_users, password_hash(),
 * duplicate-email check). This replaces signup.php as the canonical
 * registration page. No new auth system, no schema changes.
 */
require_once __DIR__ . '/config.php';
session_start();

$formError = '';
$oldFullName = '';
$oldEmail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $oldFullName = $full_name;
    $oldEmail = $email;

    // ---- VALIDATION START (same rules as the original backend signup.php) ----
    if (empty($full_name) || empty($email) || empty($password)) {
        $formError = 'Please fill in all fields.';
    } elseif (strlen($full_name) < 2) {
        $formError = 'Name must be at least 2 characters long.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = 'Please enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $formError = 'Password must be at least 6 characters long.';
    } else {
        // ---- CHECK DUPLICATE EMAIL ----
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check_stmt = $conn->prepare('SELECT email FROM tbl_users WHERE email = ?');
        $check_stmt->bind_param('s', $email);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            $formError = 'This email is already registered. Please use a different email or login.';
            $check_stmt->close();
        } else {
            $check_stmt->close();

            // ---- INSERT NEW USER ----
            $stmt = $conn->prepare('INSERT INTO tbl_users (full_name, email, password) VALUES (?, ?, ?)');
            $stmt->bind_param('sss', $full_name, $email, $hashed_password);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();

                $_SESSION['register_success'] = 'Account created! Please login.';
                header('Location: login.php');
                exit();
            } else {
                $formError = 'Something went wrong. Please try again.';
                $stmt->close();
            }
        }
    }
    // ---- VALIDATION END ----
}

$pageTitle = 'Get Started';
$pageDescription = 'Create your PathSeeker account.';
$activePage = '';
$extraScripts = ['assets/js/auth.js'];
require __DIR__ . '/includes/header.php';
?>

<section class="section-sm">
    <div class="container">
        <form class="ps-card ps-card-static auth-panel" id="register-form" method="post" action="register.php" novalidate>
            <p class="section-kicker">Start your passport</p>
            <h1 class="h3">Create an account</h1>
            <p class="text-muted">Create your PathSeeker account to save your progress.</p>

            <?php if ($formError !== ''): ?>
                <div class="alert-error-ps is-visible" role="alert">
                    <?php echo htmlspecialchars($formError); ?>
                </div>
            <?php endif; ?>

            <div class="alert-success-ps" id="register-success" role="status">Nice. Creating your account&hellip;</div>

            <div class="mb-3">
                <label class="form-label" for="register-name">Full name</label>
                <input class="form-control" id="register-name" name="full_name" type="text" autocomplete="name" value="<?php echo htmlspecialchars($oldFullName); ?>" required>
                <p class="form-error" data-error-for="register-name"></p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="register-email">Email</label>
                <input class="form-control" id="register-email" name="email" type="email" autocomplete="email" value="<?php echo htmlspecialchars($oldEmail); ?>" required>
                <p class="form-error" data-error-for="register-email"></p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="register-type">I am a</label>
                <select class="form-select" id="register-type" name="user_type" required>
                    <option value="">Select one</option>
                    <option>Student</option>
                    <option>Graduate</option>
                    <option>Working professional</option>
                </select>
                <p class="form-error" data-error-for="register-type"></p>
            </div>
            <div class="mb-4">
                <label class="form-label" for="register-password">Password</label>
                <input class="form-control" id="register-password" name="password" type="password" autocomplete="new-password" minlength="8" required>
                <p class="form-error" data-error-for="register-password"></p>
            </div>
            <button class="btn btn-ps-primary w-100" type="submit">Get Started</button>
            <p class="text-center small mt-3 mb-0">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
