<?php
$pageTitle = 'Find a Career That Fits You';
$pageDescription = 'PathSeeker helps students, graduates, and professionals discover career paths based on interests, skills, and goals.';
$activePage = 'home';
$includeCompass = true;
require __DIR__ . '/includes/data.php';
require __DIR__ . '/includes/header.php';
$previewCareers = array_slice($careers, 0, 4);
?>

<section class="ps-hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="ps-badge">Your career. Your direction.</span>
                <h1>Find a Career That Fits You.</h1>
                <p class="lead">Discover career paths based on your interests, skills and goals.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a class="btn btn-ps-primary" href="quiz.php">Take Career Quiz</a>
                    <a class="btn btn-ps-ghost" href="careers.php">Explore Careers</a>
                </div>
                <div class="ps-stat-row">
                    <div class="ps-stat"><strong>50+</strong><span>Career Paths</span></div>
                    <div class="ps-stat"><strong>10+</strong><span>Career Domains</span></div>
                    <div class="ps-stat"><strong>Personalized</strong><span>Matching</span></div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="zoom-in">
                <div class="compass-stage">
                    <div class="float-card top">
                        <span class="match-pill">94% Career Match</span>
                        <strong class="mt-1">Full Stack Developer</strong>
                    </div>
                    <canvas id="career-compass" aria-label="Interactive 3D career compass"></canvas>
                    <div class="compass-fallback" id="compass-fallback">
                        <div>
                            <div class="fallback-ring mx-auto mb-3" aria-hidden="true"></div>
                            <p class="mb-0">3D compass unavailable. Your direction still starts with the quiz.</p>
                        </div>
                    </div>
                    <div class="float-card bottom">
                        <span class="label">Destination</span>
                        <strong>A path you can actually build</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section pt-4">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <p class="section-kicker">Process</p>
            <h2 class="section-title">How PathSeeker Works</h2>
            <p class="section-lead mx-auto">Three calm steps from uncertainty to a career you can act on.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <article class="ps-card step-card">
                    <div class="step-num">01</div>
                    <h3 class="h5 mt-2">Discover Yourself</h3>
                    <p class="text-muted mb-0">Take an interest-based assessment.</p>
                </article>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="80">
                <article class="ps-card step-card">
                    <div class="step-num">02</div>
                    <h3 class="h5 mt-2">Find Your Match</h3>
                    <p class="text-muted mb-0">Get personalized career recommendations.</p>
                </article>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="160">
                <article class="ps-card step-card">
                    <div class="step-num">03</div>
                    <h3 class="h5 mt-2">Build Your Path</h3>
                    <p class="text-muted mb-0">Explore skills, resources and career roadmaps.</p>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4" data-aos="fade-up">
            <div>
                <p class="section-kicker">Matches</p>
                <h2 class="section-title mb-0">Your Future Could Start Here.</h2>
            </div>
            <a class="btn btn-ps-ghost" href="careers.php">View all careers</a>
        </div>
        <div class="row g-4">
            <?php foreach ($previewCareers as $i => $career): ?>
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="<?php echo $i * 70; ?>">
                <article class="ps-card career-card d-flex flex-column">
                    <div class="d-flex justify-content-between">
                        <div class="icon-wrap"><i class="fa-solid <?php echo $career['icon']; ?>"></i></div>
                        <button class="ps-bookmark" type="button" aria-pressed="false" aria-label="Bookmark <?php echo htmlspecialchars($career['title']); ?>">
                            <i class="fa-regular fa-bookmark"></i>
                        </button>
                    </div>
                    <h3 class="h5"><?php echo htmlspecialchars($career['title']); ?></h3>
                    <p class="text-muted small"><?php echo htmlspecialchars($career['description']); ?></p>
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
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <p class="section-kicker">Readiness</p>
                <h2 class="section-title">Know Where You Stand.</h2>
                <p class="section-lead">A preview of the career readiness view you will see in your dashboard after the quiz and profile are complete.</p>
                <a class="btn btn-ps-primary mt-2" href="dashboard.php">Open dashboard preview</a>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="ps-card readiness">
                    <div class="d-flex flex-wrap align-items-end gap-4 mb-4">
                        <div>
                            <div class="readiness-score">82%</div>
                            <div class="text-muted">Career Readiness</div>
                        </div>
                        <p class="mb-0 text-muted">You are close. Skills and profile are strong; projects and experience are the next lift.</p>
                    </div>
                    <?php
                    $breakdown = ['Skills' => 85, 'Profile' => 90, 'Projects' => 72, 'Experience' => 60];
                    foreach ($breakdown as $label => $value):
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between small mb-1"><span><?php echo $label; ?></span><span><?php echo $value; ?>%</span></div>
                        <div class="bar" data-value="<?php echo $value; ?>"><span></span></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4" data-aos="fade-up">
                <p class="section-kicker">Journey</p>
                <h2 class="section-title">A Career Roadmap You Can Follow</h2>
                <p class="section-lead">From first interest to first role — one sequence, not a pile of advice.</p>
            </div>
            <div class="col-lg-8" data-aos="fade-up">
                <div class="roadmap">
                    <?php
                    $steps = ['Discover Interests', 'Choose Career', 'Build Skills', 'Build Projects', 'Gain Experience', 'Start Career'];
                    foreach ($steps as $i => $step):
                    ?>
                    <div class="roadmap-item">
                        <div class="roadmap-rail">
                            <span class="roadmap-dot"></span>
                            <?php if ($i < count($steps) - 1): ?><span class="roadmap-line"></span><?php endif; ?>
                        </div>
                        <div class="roadmap-body">
                            <h3 class="h5 mb-1"><?php echo $step; ?></h3>
                            <p class="text-muted mb-0 small">A clear checkpoint on the PathSeeker journey.</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="mb-4" data-aos="fade-up">
            <p class="section-kicker">Library</p>
            <h2 class="section-title">Resources to Move You Forward</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($resources as $i => $resource): ?>
            <div class="col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="<?php echo $i * 70; ?>">
                <article class="ps-card resource-card d-flex flex-column">
                    <div class="icon-wrap"><i class="fa-solid <?php echo $resource['icon']; ?>"></i></div>
                    <span class="small text-muted"><?php echo htmlspecialchars($resource['category']); ?></span>
                    <h3 class="h5"><?php echo htmlspecialchars($resource['title']); ?></h3>
                    <p class="text-muted small"><?php echo htmlspecialchars($resource['description']); ?></p>
                    <div class="d-flex gap-2 mt-auto">
                        <a class="btn btn-ps-ghost btn-sm" href="resources.php">Preview</a>
                        <button class="btn btn-ps-primary btn-sm" type="button" data-placeholder="Download will connect to the resource library later.">Download</button>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="mb-4" data-aos="fade-up">
            <p class="section-kicker">Multimedia</p>
            <h2 class="section-title">Learn From Experts</h2>
        </div>
        <div class="row g-4">
            <?php foreach ($videos as $i => $video): ?>
            <div class="col-md-6 col-xl-3" data-aos="zoom-in" data-aos-delay="<?php echo $i * 60; ?>">
                <article class="ps-card video-card">
                    <div class="video-thumb t<?php echo ($i % 4) + 1; ?>">
                        <button class="play-btn" type="button" data-video-play aria-label="Play <?php echo htmlspecialchars($video['title']); ?> preview">
                            <i class="fa-solid fa-play"></i>
                        </button>
                        <span class="video-meta"><?php echo htmlspecialchars($video['duration']); ?></span>
                    </div>
                    <h3 class="h5 mb-1"><?php echo htmlspecialchars($video['title']); ?></h3>
                    <p class="small text-muted mb-1"><?php echo htmlspecialchars($video['mentor']); ?> · <?php echo htmlspecialchars($video['duration']); ?></p>
                    <p class="small mb-0" data-video-status><?php echo htmlspecialchars($video['tag']); ?></p>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="mb-4" data-aos="fade-up">
            <p class="section-kicker">Stories</p>
            <h2 class="section-title">Real People. Real Journeys.</h2>
        </div>
        <div class="d-flex flex-wrap gap-2 mb-4">
            <button class="filter-chip is-active" type="button" data-story-filter="all">All</button>
            <button class="filter-chip" type="button" data-story-filter="Technology">Technology</button>
            <button class="filter-chip" type="button" data-story-filter="Design">Design</button>
            <button class="filter-chip" type="button" data-story-filter="Data">Data</button>
        </div>
        <div class="row g-4">
            <?php foreach ($stories as $i => $story): ?>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="<?php echo $i * 80; ?>" data-story-card data-domain="<?php echo htmlspecialchars($story['domain']); ?>">
                <article class="ps-card story-card">
                    <span class="match-pill"><?php echo htmlspecialchars($story['domain']); ?></span>
                    <p class="mt-3">“<?php echo htmlspecialchars($story['quote']); ?>”</p>
                    <strong><?php echo htmlspecialchars($story['name']); ?></strong>
                    <div class="small text-muted mb-3"><?php echo htmlspecialchars($story['role']); ?></div>
                    <div class="timeline">
                        <span>Education</span><i class="fa-solid fa-arrow-right"></i>
                        <span>Learning</span><i class="fa-solid fa-arrow-right"></i>
                        <span>Challenges</span><i class="fa-solid fa-arrow-right"></i>
                        <span>Opportunity</span><i class="fa-solid fa-arrow-right"></i>
                        <span>Career</span>
                    </div>
                </article>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-ps-ghost" href="success-stories.php">Read more stories</a>
        </div>
    </div>
</section>

<section class="section" id="about">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <p class="section-kicker">About</p>
                <h2 class="section-title">A Career Passport, Not Another Job Board</h2>
                <p class="section-lead">PathSeeker is built for students, graduates, and working professionals who need direction — not noise. The metaphor is simple: compass, path, destination, growth.</p>
                <a class="btn btn-ps-ghost mt-2" href="about.php">Read the story</a>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="ps-card p-4">
                    <div class="row g-3">
                        <div class="col-6"><strong>Students</strong><p class="small text-muted mb-0">Find a first direction with evidence.</p></div>
                        <div class="col-6"><strong>Graduates</strong><p class="small text-muted mb-0">Turn study into a credible path.</p></div>
                        <div class="col-6"><strong>Professionals</strong><p class="small text-muted mb-0">Switch or grow with a plan.</p></div>
                        <div class="col-6"><strong>Teams later</strong><p class="small text-muted mb-0">Admin tools live on a separate track.</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section pt-0">
    <div class="container">
        <div class="cta-band text-center" data-aos="zoom-in">
            <div class="cta-particles" aria-hidden="true"></div>
            <div class="position-relative">
                <h2 class="section-title">Your Career Journey Starts Here.</h2>
                <p class="cta-lead">Take the first step toward a career built around your strengths.</p>
                <a class="btn btn-ps-primary mt-2" href="quiz.php">Take Career Quiz →</a>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
