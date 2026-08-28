<?php
$pageTitle = 'Explore Careers';
$pageDescription = 'Browse career paths by domain, salary range, and demand.';
$activePage = 'careers';
$extraScripts = ['assets/js/careers.js'];
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Directory</p>
        <h1>Explore Careers</h1>
        <p class="section-lead">Search and filter sample career paths. Matching will connect to backend scoring later.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <form class="filters-bar mb-4" role="search" onsubmit="return false;">
            <div class="row g-3 align-items-end">
                <div class="col-lg-4">
                    <label class="form-label" for="career-search">Search</label>
                    <input class="form-control" id="career-search" type="search" placeholder="Title or skill">
                </div>
                <div class="col-md-4 col-lg-2">
                    <label class="form-label" for="filter-domain">Domain</label>
                    <select class="form-select" id="filter-domain">
                        <option value="all">All domains</option>
                        <option value="Technology">Technology</option>
                        <option value="Design">Design</option>
                        <option value="Data">Data</option>
                        <option value="Security">Security</option>
                        <option value="Business">Business</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Healthcare">Healthcare</option>
                    </select>
                </div>
                <div class="col-md-4 col-lg-3">
                    <label class="form-label" for="filter-salary">Salary</label>
                    <select class="form-select" id="filter-salary">
                        <option value="all">Any range</option>
                        <option value="entry">Under $80k typical</option>
                        <option value="mid">$70k – $130k</option>
                        <option value="high">$90k+</option>
                    </select>
                </div>
                <div class="col-md-4 col-lg-3">
                    <label class="form-label" for="filter-demand">Demand</label>
                    <select class="form-select" id="filter-demand">
                        <option value="all">Any demand</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="growing">Growing</option>
                    </select>
                </div>
            </div>
        </form>
        <p class="text-muted mb-4" id="careers-count"></p>
        <div class="row g-4">
            <?php foreach ($careers as $career): ?>
            <div class="col-md-6 col-xl-3" data-career-card
                data-title="<?php echo htmlspecialchars($career['title']); ?>"
                data-domain="<?php echo htmlspecialchars($career['domain']); ?>"
                data-salary="<?php echo htmlspecialchars($career['salaryBand']); ?>"
                data-demand="<?php echo htmlspecialchars($career['demand']); ?>"
                data-skills="<?php echo htmlspecialchars(implode(' ', $career['skills'])); ?>">
                <article class="ps-card career-card h-100 d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <div class="icon-wrap"><i class="fa-solid <?php echo $career['icon']; ?>"></i></div>
                        <button class="ps-bookmark" type="button" data-bookmark-career aria-pressed="false" aria-label="Bookmark <?php echo htmlspecialchars($career['title']); ?>" title="Bookmark career">
                            <i class="fa-regular fa-bookmark"></i>
                        </button>
                    </div>
                    <h2 class="h5"><?php echo htmlspecialchars($career['title']); ?></h2>
                    <p class="small text-muted"><?php echo htmlspecialchars($career['domain']); ?> · <?php echo htmlspecialchars($career['salary']); ?></p>
                    <p class="small"><?php echo htmlspecialchars($career['description']); ?></p>
                    <span class="match-pill"><?php echo (int) $career['match']; ?>% match</span>
                    <div class="tag-row">
                        <?php foreach ($career['skills'] as $skill): ?>
                            <span class="tag"><?php echo htmlspecialchars($skill); ?></span>
                        <?php endforeach; ?>
                    </div>
                    <a class="btn btn-ps-ghost mt-auto" href="career-details.php?id=<?php echo urlencode($career['id']); ?>">Explore Career</a>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        <p class="text-center text-muted mt-4 d-none" id="careers-empty">No careers match those filters. Try a wider search.</p>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
