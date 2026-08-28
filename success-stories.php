<?php
$pageTitle = 'Success Stories';
$pageDescription = 'Real people and the paths they followed.';
$activePage = 'stories';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Journeys</p>
        <h1>Real People. Real Journeys.</h1>
        <p class="section-lead">Education → Learning → Challenges → Opportunity → Career</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="journey-track" data-aos="fade-up" aria-label="Career journey stages">
            <div class="journey-step"><span>01</span><strong>Education</strong></div>
            <div class="journey-step"><span>02</span><strong>Learning</strong></div>
            <div class="journey-step"><span>03</span><strong>Challenges</strong></div>
            <div class="journey-step"><span>04</span><strong>Opportunity</strong></div>
            <div class="journey-step"><span>05</span><strong>Career</strong></div>
        </div>
        <div class="d-flex flex-wrap gap-2 mb-4" role="tablist" aria-label="Domain filters">
            <button class="filter-chip is-active" type="button" data-story-filter="all">All</button>
            <button class="filter-chip" type="button" data-story-filter="Technology">Technology</button>
            <button class="filter-chip" type="button" data-story-filter="Design">Design</button>
            <button class="filter-chip" type="button" data-story-filter="Data">Data</button>
        </div>
        <div class="row g-4">
            <?php foreach ($stories as $story): ?>
            <div class="col-lg-4" data-story-card data-domain="<?php echo htmlspecialchars($story['domain']); ?>">
                <article class="ps-card story-card h-100">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="avatar avatar-sm">
                            <?php echo strtoupper(substr($story['name'], 0, 1)); ?>
                        </div>
                        <div>
                            <strong><?php echo htmlspecialchars($story['name']); ?></strong>
                            <div class="small text-muted"><?php echo htmlspecialchars($story['role']); ?></div>
                        </div>
                    </div>
                    <span class="match-pill"><?php echo htmlspecialchars($story['domain']); ?></span>
                    <p class="mt-3">“<?php echo htmlspecialchars($story['quote']); ?>”</p>
                    <div class="timeline">
                        <?php foreach ($story['path'] as $i => $step): ?>
                            <span><?php echo htmlspecialchars($step); ?></span>
                            <?php if ($i < count($story['path']) - 1): ?><i class="fa-solid fa-arrow-right"></i><?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
