<?php
/**
 * Dashboard — main logged-in landing page after login.
 * Auth guard: unauthenticated visitors are redirected to login.php.
 */
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$pageTitle = 'Dashboard';
$pageDescription = 'Your PathSeeker career workspace.';
$activePage = '';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
$trending = array_slice($careers, 0, 4);

$firstName = trim(explode(' ', $_SESSION['full_name'] ?? '')[0]);
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Workspace</p>
        <h1 data-greeting>Good Morning 👋</h1>
        <p class="section-lead">Welcome back<?php echo $firstName !== '' ? ', ' . htmlspecialchars($firstName) : ''; ?>. A SaaS-style preview of your career passport. Data is sample-only until scoring is fully connected.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="dash-grid">
            <div class="ps-card dash-card">
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div>
                        <p class="text-muted mb-1">Career Readiness</p>
                        <div class="readiness-score score-lg">82%</div>
                    </div>
                    <div>
                        <p class="text-muted mb-1">Top Career Match</p>
                        <h2 class="h4 mb-1">Full Stack Developer</h2>
                        <span class="match-pill">94%</span>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    <?php foreach (['Skills' => 85, 'Profile' => 90, 'Projects' => 72, 'Experience' => 60] as $label => $value): ?>
                    <div class="col-md-6 col-xl-3">
                        <div class="small d-flex justify-content-between"><span><?php echo $label; ?></span><span><?php echo $value; ?>%</span></div>
                        <div class="bar" data-value="<?php echo $value; ?>"><span></span></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="ps-card dash-card">
                <h2 class="h5">Quiz Result</h2>
                <p class="mb-2">Last completed: sample profile</p>
                <p class="small text-muted">Technical 91 · Analytical 82 · Creative 74 · Social 51</p>
                <a class="btn btn-ps-ghost btn-sm" href="quiz-result.php">View full results</a>
                <a class="btn btn-ps-primary btn-sm" href="quiz.php">Retake quiz</a>
            </div>
        </div>

        <div class="row g-4 mt-1">
            <div class="col-lg-6">
                <div class="ps-card dash-card h-100">
                    <h2 class="h5">Recent Activity</h2>
                    <ul class="list-unstyled mb-0">
                        <li class="py-2 border-bottom">Bookmarked UI/UX Designer</li>
                        <li class="py-2 border-bottom">Opened Web Development Roadmap</li>
                        <li class="py-2 border-bottom">Completed Career Discovery Quiz</li>
                        <li class="py-2">Viewed Full Stack Developer profile</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ps-card dash-card h-100">
                    <div class="d-flex justify-content-between">
                        <h2 class="h5">My Bookmarks</h2>
                        <a class="small" href="bookmarks.php">View all</a>
                    </div>
                    <p class="mb-1">Full Stack Developer</p>
                    <p class="mb-1">Interview Preparation</p>
                    <p class="mb-0">Cyber Security session</p>
                </div>
            </div>
        </div>

        <h2 class="h4 mt-5 mb-3">Trending Careers</h2>
        <div class="row g-4">
            <?php foreach ($trending as $career): ?>
            <div class="col-md-6 col-xl-3">
                <article class="ps-card career-card h-100">
                    <h3 class="h6"><?php echo htmlspecialchars($career['title']); ?></h3>
                    <span class="match-pill"><?php echo (int) $career['match']; ?>%</span>
                    <a class="d-block mt-3 small" href="career-details.php?id=<?php echo urlencode($career['id']); ?>">Open</a>
                </article>
            </div>
            <?php endforeach; ?>
        </div>

        <h2 class="h4 mt-5 mb-3">Top Picks For You</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <a class="ps-card p-4 d-block text-decoration-none h-100" href="resources.php">
                    <strong>CV Building Guide</strong>
                    <p class="small text-muted mb-0">Resource match based on your profile.</p>
                </a>
            </div>
            <div class="col-md-4">
                <a class="ps-card p-4 d-block text-decoration-none h-100" href="videos.php">
                    <strong>Web Development video</strong>
                    <p class="small text-muted mb-0">18 minutes with Amina Shah.</p>
                </a>
            </div>
            <div class="col-md-4">
                <a class="ps-card p-4 d-block text-decoration-none h-100" href="career-details.php?id=cloud">
                    <strong>Cloud Engineer</strong>
                    <p class="small text-muted mb-0">Growing demand in your skill cluster.</p>
                </a>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
