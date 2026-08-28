<?php
$pageTitle = 'My Bookmarks';
$pageDescription = 'Saved careers, resources, and videos.';
$activePage = '';
$extraScripts = ['assets/js/bookmarks.js'];
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Saved</p>
        <h1>My Bookmarks</h1>
        <p class="section-lead">Frontend-only lists. Persistence will arrive with user accounts.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="d-flex gap-3 mb-4" role="tablist">
            <button class="tab-btn is-active" type="button" data-bookmark-tab="careers" aria-selected="true">Careers</button>
            <button class="tab-btn" type="button" data-bookmark-tab="resources" aria-selected="false">Resources</button>
            <button class="tab-btn" type="button" data-bookmark-tab="videos" aria-selected="false">Videos</button>
        </div>

        <div data-bookmark-panel="careers">
            <?php
            $items = [
                ['title' => 'Full Stack Developer', 'category' => 'Technology', 'date' => '24 Aug 2026'],
                ['title' => 'UI/UX Designer', 'category' => 'Design', 'date' => '21 Aug 2026'],
            ];
            foreach ($items as $item):
            ?>
            <article class="ps-card p-4 mb-3" data-bookmark-item>
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div>
                        <h2 class="h5 mb-1"><?php echo $item['title']; ?></h2>
                        <p class="small text-muted mb-0"><?php echo $item['category']; ?> · Saved <?php echo $item['date']; ?></p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-ps-ghost btn-sm" type="button" data-toggle-note>Add note</button>
                        <button class="btn btn-ps-ghost btn-sm" type="button" data-remove-bookmark>Remove</button>
                    </div>
                </div>
                <div class="note-box">
                    <label class="form-label small mt-3" for="note-<?php echo md5($item['title']); ?>">Note</label>
                    <textarea class="form-control" id="note-<?php echo md5($item['title']); ?>" rows="2" placeholder="Why this path matters to you"></textarea>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <div class="d-none" data-bookmark-panel="resources">
            <article class="ps-card p-4 mb-3" data-bookmark-item>
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div>
                        <h2 class="h5 mb-1">Interview Preparation</h2>
                        <p class="small text-muted mb-0">Workbook · Saved 18 Aug 2026</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-ps-ghost btn-sm" type="button" data-toggle-note>Add note</button>
                        <button class="btn btn-ps-ghost btn-sm" type="button" data-remove-bookmark>Remove</button>
                    </div>
                </div>
                <div class="note-box">
                    <label class="form-label small mt-3" for="note-resource">Note</label>
                    <textarea class="form-control" id="note-resource" rows="2"></textarea>
                </div>
            </article>
        </div>

        <div class="d-none" data-bookmark-panel="videos">
            <article class="ps-card p-4 mb-3" data-bookmark-item>
                <div class="d-flex flex-wrap justify-content-between gap-3">
                    <div>
                        <h2 class="h5 mb-1">Cyber Security</h2>
                        <p class="small text-muted mb-0">Video · Saved 12 Aug 2026</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-ps-ghost btn-sm" type="button" data-toggle-note>Add note</button>
                        <button class="btn btn-ps-ghost btn-sm" type="button" data-remove-bookmark>Remove</button>
                    </div>
                </div>
                <div class="note-box">
                    <label class="form-label small mt-3" for="note-video">Note</label>
                    <textarea class="form-control" id="note-video" rows="2"></textarea>
                </div>
            </article>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
