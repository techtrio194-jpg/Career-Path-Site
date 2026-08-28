<?php
$pageTitle = 'Career Discovery Quiz';
$pageDescription = 'A 15-question quiz to discover career direction.';
$activePage = '';
$extraScripts = ['assets/js/quiz.js'];
require __DIR__ . '/includes/header.php';
?>

<section class="section">
    <div class="container">
        <div class="quiz-shell" id="quiz-app">
            <p class="section-kicker">Assessment</p>
            <h1 class="section-title">Career Discovery Quiz</h1>
            <p class="text-muted" id="quiz-step">Question 1 of 15</p>
            <div class="quiz-progress mb-4" aria-hidden="true"><span id="quiz-bar"></span></div>
            <div class="ps-card ps-card-static p-4 p-lg-5">
                <h2 class="h4" id="quiz-question">Loading question…</h2>
                <div id="quiz-answers" class="mt-4" role="group" aria-labelledby="quiz-question"></div>
                <p class="quiz-hint" id="quiz-hint" role="status" aria-live="polite"></p>
                <div class="d-flex justify-content-between gap-3 mt-4">
                    <button class="btn btn-ps-ghost" type="button" id="quiz-prev">Previous</button>
                    <button class="btn btn-ps-primary" type="button" id="quiz-next">Next</button>
                </div>
            </div>
            <p class="small text-muted mt-3">Scoring is a frontend placeholder. Answers are stored locally for the results preview only.</p>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
