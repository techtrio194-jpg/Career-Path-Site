<?php
$pageTitle = 'Videos';
$pageDescription = 'Learn from experts across web, design, data, and security.';
$activePage = 'videos';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Multimedia</p>
        <h1>Learn From Experts</h1>
        <p class="section-lead">Preview cards only. Playback will connect to stored media later.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($videos as $i => $video): ?>
            <div class="col-md-6 col-xl-3">
                <article class="ps-card video-card">
                    <div class="video-thumb t<?php echo ($i % 4) + 1; ?>">
                        <button class="play-btn" type="button" data-video-play aria-label="Play <?php echo htmlspecialchars($video['title']); ?>">
                            <i class="fa-solid fa-play"></i>
                        </button>
                        <span class="video-meta"><?php echo htmlspecialchars($video['duration']); ?></span>
                    </div>
                    <h2 class="h5"><?php echo htmlspecialchars($video['title']); ?></h2>
                    <p class="small text-muted"><?php echo htmlspecialchars($video['mentor']); ?> · <?php echo htmlspecialchars($video['duration']); ?></p>
                    <p class="small mb-0" data-video-status><?php echo htmlspecialchars($video['tag']); ?> session</p>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
