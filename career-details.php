<?php
require __DIR__ . '/includes/data.php';
$id = isset($_GET['id']) ? preg_replace('/[^a-z0-9\-]/', '', strtolower($_GET['id'])) : 'fullstack';
$career = ps_find_career($careers, $id);
$pageTitle = $career['title'];
$pageDescription = $career['overview'];
$activePage = 'careers';
require __DIR__ . '/includes/header.php';
$sameDomain = array_values(array_filter($careers, function ($item) use ($career) {
    return $item['id'] !== $career['id'] && $item['domain'] === $career['domain'];
}));
$others = array_values(array_filter($careers, function ($item) use ($career) {
    return $item['id'] !== $career['id'] && $item['domain'] !== $career['domain'];
}));
$related = array_slice(array_merge($sameDomain, $others), 0, 3);
?>

<section class="ps-page-hero">
    <div class="container">
        <a class="small text-muted text-decoration-none" href="careers.php">← All careers</a>
        <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mt-3">
            <div>
                <p class="section-kicker"><?php echo htmlspecialchars($career['domain']); ?></p>
                <h1><?php echo htmlspecialchars($career['title']); ?></h1>
                <span class="match-pill"><?php echo (int) $career['match']; ?>% career match</span>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-ps-ghost" type="button" data-bookmark-toggle aria-pressed="false">
                    <i class="fa-regular fa-bookmark"></i> Bookmark
                </button>
                <button class="btn btn-ps-primary" type="button" data-placeholder="Career guide download is a frontend placeholder.">Download Career Guide</button>
            </div>
        </div>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <article class="ps-card p-4 p-lg-5 mb-4">
                    <h2 class="h4">Overview</h2>
                    <p class="mb-0"><?php echo htmlspecialchars($career['overview']); ?></p>
                </article>
                <article class="ps-card p-4 p-lg-5 mb-4">
                    <h2 class="h4">Required Skills</h2>
                    <div class="tag-row">
                        <?php foreach ($career['skills'] as $skill): ?>
                            <span class="tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    </div>
                </article>
                <article class="ps-card p-4 p-lg-5">
                    <h2 class="h4">Career Roadmap</h2>
                    <div class="roadmap mt-3">
                        <?php foreach ($career['roadmap'] as $i => $step): ?>
                        <div class="roadmap-item">
                            <div class="roadmap-rail">
                                <span class="roadmap-dot"></span>
                                <?php if ($i < count($career['roadmap']) - 1): ?><span class="roadmap-line"></span><?php endif; ?>
                            </div>
                            <div class="roadmap-body">
                                <h3 class="h6 mb-0"><?php echo htmlspecialchars($step); ?></h3>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </article>
            </div>
            <div class="col-lg-4">
                <aside class="ps-card p-4 mb-4">
                    <h2 class="h5">At a glance</h2>
                    <p class="mb-2"><strong>Salary</strong><br><span class="text-muted"><?php echo htmlspecialchars($career['salary']); ?></span></p>
                    <p class="mb-2"><strong>Job demand</strong><br><span class="text-muted text-capitalize"><?php echo htmlspecialchars($career['demand']); ?></span></p>
                    <p class="mb-0"><strong>Education</strong><br><span class="text-muted"><?php echo htmlspecialchars($career['education']); ?></span></p>
                </aside>
                <aside class="ps-card p-4">
                    <h2 class="h5">Related careers</h2>
                    <?php foreach ($related as $item): ?>
                        <a class="d-block py-2 text-decoration-none" href="career-details.php?id=<?php echo urlencode($item['id']); ?>">
                            <strong><?php echo htmlspecialchars($item['title']); ?></strong>
                            <div class="small text-muted"><?php echo (int) $item['match']; ?>% match</div>
                        </a>
                    <?php endforeach; ?>
                </aside>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
