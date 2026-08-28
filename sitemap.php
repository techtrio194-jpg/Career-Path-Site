<?php
$pageTitle = 'Sitemap';
$pageDescription = 'All PathSeeker frontend pages.';
$activePage = '';
require __DIR__ . '/includes/header.php';
$groups = [
    'Discover' => [
        'index.php' => 'Home',
        'careers.php' => 'Explore Careers',
        'career-details.php' => 'Career Details',
        'quiz.php' => 'Career Quiz',
        'quiz-result.php' => 'Quiz Results',
    ],
    'Learn' => [
        'resources.php' => 'Resources',
        'videos.php' => 'Videos',
        'success-stories.php' => 'Success Stories',
    ],
    'Workspace' => [
        'dashboard.php' => 'Dashboard',
        'profile.php' => 'Profile',
        'bookmarks.php' => 'Bookmarks',
    ],
    'Account & support' => [
        'login.php' => 'Login',
        'register.php' => 'Register',
        'feedback.php' => 'Feedback',
        'help.php' => 'Help',
        'about.php' => 'About',
        'sitemap.php' => 'Sitemap',
    ],
];
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Index</p>
        <h1>Sitemap</h1>
        <p class="section-lead">Every public frontend page currently in PathSeeker.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4 sitemap-grid">
            <?php foreach ($groups as $title => $links): ?>
            <div class="col-md-6 col-lg-3">
                <h2 class="h5"><?php echo htmlspecialchars($title); ?></h2>
                <?php foreach ($links as $href => $label): ?>
                    <a href="<?php echo htmlspecialchars($href); ?>"><?php echo htmlspecialchars($label); ?></a>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
