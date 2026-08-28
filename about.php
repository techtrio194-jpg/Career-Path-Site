<?php
$pageTitle = 'About PathSeeker';
$pageDescription = 'PathSeeker is a Career Passport for students, graduates, and working professionals.';
$activePage = 'about';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">About</p>
        <h1>A Career Passport, Not Another Job Board</h1>
        <p class="section-lead">PathSeeker helps you find direction: compass, path, destination, growth.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3" data-aos="fade-up">
                <article class="ps-card p-4 h-100">
                    <div class="icon-wrap mb-3"><i class="fa-solid fa-compass"></i></div>
                    <h2 class="h5">Compass</h2>
                    <p class="text-muted mb-0">Start with who you are — interests, skills, and the kind of workday you actually want.</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="70">
                <article class="ps-card p-4 h-100">
                    <div class="icon-wrap mb-3"><i class="fa-solid fa-route"></i></div>
                    <h2 class="h5">Career Paths</h2>
                    <p class="text-muted mb-0">See realistic roles, skills, and demand instead of an endless list of job posts.</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="140">
                <article class="ps-card p-4 h-100">
                    <div class="icon-wrap mb-3"><i class="fa-solid fa-flag-checkered"></i></div>
                    <h2 class="h5">Destination</h2>
                    <p class="text-muted mb-0">Match to a direction you can explain — to yourself, and later to hiring managers.</p>
                </article>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="210">
                <article class="ps-card p-4 h-100">
                    <div class="icon-wrap mb-3"><i class="fa-solid fa-seedling"></i></div>
                    <h2 class="h5">Growth</h2>
                    <p class="text-muted mb-0">Use quizzes, resources, and roadmaps to turn a match into a buildable plan.</p>
                </article>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-7" data-aos="fade-right">
                <article class="ps-card p-4 p-lg-5 h-100">
                    <h2 class="h4">Who it is for</h2>
                    <p>Students choosing a first direction. Graduates converting study into a credible path. Professionals switching or growing without starting from noise.</p>
                    <p class="mb-0 text-muted">This frontend is Member 1’s UI layer. Accounts, scoring, and admin tools are owned by other team members and will plug into these screens.</p>
                </article>
            </div>
            <div class="col-lg-5" data-aos="fade-left">
                <article class="ps-card p-4 p-lg-5 h-100">
                    <h2 class="h4">How to start</h2>
                    <ol class="mb-4 ps-3">
                        <li class="mb-2">Take the Career Discovery Quiz</li>
                        <li class="mb-2">Explore matched careers</li>
                        <li>Save resources and build the roadmap</li>
                    </ol>
                    <a class="btn btn-ps-primary" href="quiz.php">Take Career Quiz</a>
                </article>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
