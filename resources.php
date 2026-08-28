<?php
$pageTitle = 'Resources';
$pageDescription = 'Guides, checklists, and roadmaps to move your career forward.';
$activePage = 'resources';
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Library</p>
        <h1>Resources to Move You Forward</h1>
        <p class="section-lead">Frontend placeholders for guides you will later download or preview from the backend.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($resources as $resource): ?>
            <div class="col-md-6">
                <article class="ps-card resource-card d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <div class="icon-wrap"><i class="fa-solid <?php echo $resource['icon']; ?>"></i></div>
                        <span class="tag"><?php echo htmlspecialchars($resource['type']); ?></span>
                    </div>
                    <span class="small text-muted"><?php echo htmlspecialchars($resource['category']); ?></span>
                    <h2 class="h4"><?php echo htmlspecialchars($resource['title']); ?></h2>
                    <p><?php echo htmlspecialchars($resource['description']); ?></p>
                    <div class="d-flex gap-2 mt-auto">
                        <button class="btn btn-ps-ghost" type="button" data-placeholder="Resource preview will open from stored files later.">Preview</button>
                        <button class="btn btn-ps-primary" type="button" data-placeholder="Download will connect to the resource library later.">Download</button>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
