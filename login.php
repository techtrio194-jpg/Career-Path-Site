<?php
/**
 * Login — frontend UI (Bootstrap / ps-card design) wired to the existing
 * backend authentication logic (config.php, tbl_users, password_verify()).
 * No new auth system, no new session system, no schema changes.
 */
require_once __DIR__ . '/config.php';
session_start();

// Already logged in? Send straight to the dashboard.
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$formError = '';
$oldEmail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $oldEmail = $email;

    if ($email === '' || $password === '') {
        $formError = 'Please fill in all fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formError = 'Please enter a valid email address.';
    } else {
        $stmt = $conn->prepare('SELECT user_id, full_name, password, role FROM tbl_users WHERE email = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                // ---- LOGIN SUCCESS - SAVE SESSION ----
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];

                $stmt->close();
                $conn->close();

                header('Location: dashboard.php');
                exit();
            } else {
                $formError = 'Incorrect password.';
            }
        } else {
            $formError = 'Email not found. Please sign up first.';
        }
        $stmt->close();
    }
}

$pageTitle = 'Login';
$pageDescription = 'Sign in to PathSeeker.';
$activePage = '';
$extraScripts = ['assets/js/auth.js'];
require __DIR__ . '/includes/header.php';
?>

<section class="section-sm">
    <div class="container">
        <form class="ps-card ps-card-static auth-panel" id="login-form" method="post" action="login.php" novalidate>
            <p class="section-kicker">Welcome back</p>
            <h1 class="h3">Login</h1>
            <p class="text-muted">Sign in to continue your career journey.</p>

            <?php if (!empty($_SESSION['register_success'])): ?>
                <div class="alert-success-ps is-visible" role="status">
                    <?php echo htmlspecialchars($_SESSION['register_success']); ?>
                </div>
                <?php unset($_SESSION['register_success']); ?>
            <?php endif; ?>

            <?php if ($formError !== ''): ?>
                <div class="alert-error-ps is-visible" role="alert">
                    <?php echo htmlspecialchars($formError); ?>
                </div>
            <?php endif; ?>

            <div class="alert-success-ps" id="login-success" role="status">Looks good. Signing you in&hellip;</div>

            <div class="mb-3">
                <label class="form-label" for="login-email">Email</label>
                <input class="form-control" id="login-email" name="email" type="email" autocomplete="email" value="<?php echo htmlspecialchars($oldEmail); ?>" required>
                <p class="form-error" data-error-for="login-email"></p>
            </div>
            <div class="mb-4">
                <label class="form-label" for="login-password">Password</label>
                <input class="form-control" id="login-password" name="password" type="password" autocomplete="current-password" required>
                <p class="form-error" data-error-for="login-password"></p>
            </div>
            <button class="btn btn-ps-primary w-100" type="submit">Login</button>
            <p class="text-center small mt-3 mb-0">New here? <a href="register.php">Create an account</a></p>
        </form>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
