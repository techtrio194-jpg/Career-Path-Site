<?php
$pageTitle = 'Help';
$pageDescription = 'Answers about using the PathSeeker frontend.';
$activePage = '';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Support</p>
        <h1>Help</h1>
        <p class="section-lead">Short answers for the current frontend preview. Account and scoring help will expand after backend integration.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <article class="ps-card ps-card-static p-4 p-lg-5 form-wide mx-0">
            <dl class="help-list mb-0">
                <dt>How do I find a career match?</dt>
                <dd>Open the Career Discovery Quiz, answer all 15 questions, then review the sample results and recommended careers.</dd>
                <dt>Can I filter careers?</dt>
                <dd>Yes. On Explore Careers, search by title or skill and filter by domain, salary band, and demand. Filtering is client-side using sample data.</dd>
                <dt>Do Login and Get Started create a real account?</dt>
                <dd>Not yet. Those screens validate input on the frontend only. Authentication belongs to the backend team.</dd>
                <dt>Where is the sitemap?</dt>
                <dd>Use Sitemap in the footer, or open sitemap.php from any page.</dd>
                <dt>How do I send feedback?</dt>
                <dd>Use the Feedback page. Choose Bug, Suggestion, or Query. Messages are validated in the browser until the API is connected.</dd>
            </dl>
            <a class="btn btn-ps-primary mt-4" href="feedback.php">Contact support</a>
        </article>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
