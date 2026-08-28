<?php
$pageTitle = 'Your Career Profile';
$pageDescription = 'Quiz results preview with recommended careers.';
$activePage = '';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
$recommended = array_slice($careers, 0, 3);
$traits = ['Technical' => 91, 'Analytical' => 82, 'Creative' => 74, 'Social' => 51];
?>

<section class="ps-page-hero">
    <div class="container text-center">
        <p class="section-kicker">Results</p>
        <h1>Your Career Profile</h1>
        <div class="skill-ring skill-ring-94 mx-auto my-4"><span>94%</span></div>
        <h2 class="h3">Full Stack Developer</h2>
        <p class="section-lead mx-auto">A preview result. Backend scoring will replace this sample profile after integration.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4 mb-5">
            <?php foreach ($traits as $label => $value): ?>
            <div class="col-md-6 col-xl-3">
                <div class="ps-card p-4">
                    <div class="d-flex justify-content-between mb-2"><strong><?php echo $label; ?></strong><span><?php echo $value; ?>%</span></div>
                    <div class="bar" data-value="<?php echo $value; ?>"><span></span></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <h2 class="section-title">Recommended Careers</h2>
        <div class="row g-4">
            <?php foreach ($recommended as $career): ?>
            <div class="col-md-4">
                <article class="ps-card career-card h-100 d-flex flex-column">
                    <div class="icon-wrap"><i class="fa-solid <?php echo $career['icon']; ?>"></i></div>
                    <h3 class="h5"><?php echo htmlspecialchars($career['title']); ?></h3>
                    <span class="match-pill"><?php echo (int) $career['match']; ?>% match</span>
                    <p class="small mt-2"><?php echo htmlspecialchars($career['description']); ?></p>
                    <a class="btn btn-ps-ghost mt-auto" href="career-details.php?id=<?php echo urlencode($career['id']); ?>">Explore Career</a>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-ps-primary" href="dashboard.php">Go to dashboard</a>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
