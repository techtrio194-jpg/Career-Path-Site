<?php
if (!isset($activePage)) {
    $activePage = '';
}
?>
<header class="ps-navbar" id="site-navbar">
    <nav class="navbar navbar-expand-lg" aria-label="Primary">
        <div class="container">
            <a class="navbar-brand ps-logo" href="index.php">
                <span class="ps-logo-mark" aria-hidden="true">
                    <i class="fa-solid fa-compass"></i>
                </span>
                <span class="ps-logo-text">PATHSEEKER</span>
            </a>

            <div class="d-flex align-items-center gap-2 order-lg-3">
                <button type="button" class="ps-icon-btn" id="theme-toggle" aria-label="Toggle dark mode" title="Toggle theme">
                    <i class="fa-solid fa-moon" data-theme-icon></i>
                </button>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="btn btn-ps-ghost d-none d-md-inline-flex">
                        <?php echo htmlspecialchars(explode(' ', trim($_SESSION['full_name'] ?? 'Account'))[0]); ?>
                    </a>
                    <a href="logout.php" class="btn btn-ps-primary d-none d-md-inline-flex">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-ps-ghost d-none d-md-inline-flex">Login</a>
                    <a href="register.php" class="btn btn-ps-primary d-none d-md-inline-flex">Get Started</a>
                <?php endif; ?>
                <button class="navbar-toggler ps-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>

            <div class="collapse navbar-collapse order-lg-2" id="primaryNav">
                <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link<?php echo $activePage === 'home' ? ' active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $activePage === 'careers' ? ' active' : ''; ?>" href="careers.php">Explore Careers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $activePage === 'resources' ? ' active' : ''; ?>" href="resources.php">Resources</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $activePage === 'videos' ? ' active' : ''; ?>" href="videos.php">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $activePage === 'stories' ? ' active' : ''; ?>" href="success-stories.php">Success Stories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $activePage === 'about' ? ' active' : ''; ?>" href="about.php">About</a>
                    </li>
                </ul>
                <div class="d-md-none d-flex gap-2 pt-2 pb-3">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="dashboard.php" class="btn btn-ps-ghost w-50">Dashboard</a>
                        <a href="logout.php" class="btn btn-ps-primary w-50">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-ps-ghost w-50">Login</a>
                        <a href="register.php" class="btn btn-ps-primary w-50">Get Started</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>
