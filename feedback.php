<?php
$pageTitle = 'Feedback';
$pageDescription = 'Send a bug report, suggestion, or query.';
$activePage = '';
$extraScripts = ['assets/js/feedback.js'];
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Support</p>
        <h1>We read every note.</h1>
        <p class="section-lead">Frontend validation only. Submissions will post to the backend later.</p>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <form class="ps-card ps-card-static p-4 p-lg-5 auth-panel form-wide mx-0" id="feedback-form" novalidate>
            <div class="alert-success-ps" id="feedback-success" role="status">Thank you. Your feedback is ready for the backend queue.</div>
            <div class="mb-3">
                <label class="form-label" for="feedback-type">Feedback type</label>
                <select class="form-select" id="feedback-type" required>
                    <option value="">Select one</option>
                    <option value="bug">Bug</option>
                    <option value="suggestion">Suggestion</option>
                    <option value="query">Query</option>
                </select>
                <p class="form-error" data-error-for="feedback-type"></p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="feedback-name">Name</label>
                <input class="form-control" id="feedback-name" type="text" autocomplete="name" required>
                <p class="form-error" data-error-for="feedback-name"></p>
            </div>
            <div class="mb-3">
                <label class="form-label" for="feedback-email">Email</label>
                <input class="form-control" id="feedback-email" type="email" autocomplete="email" required>
                <p class="form-error" data-error-for="feedback-email"></p>
            </div>
            <div class="mb-4">
                <label class="form-label" for="feedback-message">Message</label>
                <textarea class="form-control" id="feedback-message" rows="5" required></textarea>
                <p class="form-error" data-error-for="feedback-message"></p>
            </div>
            <button class="btn btn-ps-primary" type="submit">Submit feedback</button>
        </form>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
