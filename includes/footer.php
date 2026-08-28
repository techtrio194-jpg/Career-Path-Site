</main>
<footer class="ps-footer">
    <div class="container">
        <div class="row g-4 g-lg-5">
            <div class="col-lg-4">
                <a class="ps-logo ps-logo-light" href="index.php">
                    <span class="ps-logo-mark" aria-hidden="true"><i class="fa-solid fa-compass"></i></span>
                    <span class="ps-logo-text">PATHSEEKER</span>
                </a>
                <p class="ps-footer-tagline mt-3">Discover What Fits You Best.</p>
                <p class="ps-footer-copy">A Career Passport for students, graduates, and working professionals who want a clearer direction.</p>
                <div class="ps-social" aria-label="Social links">
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <h2 class="ps-footer-title">Platform</h2>
                <ul class="ps-footer-links">
                    <li><a href="careers.php">Explore Careers</a></li>
                    <li><a href="quiz.php">Career Quiz</a></li>
                    <li><a href="resources.php">Resources</a></li>
                    <li><a href="videos.php">Videos</a></li>
                    <li><a href="success-stories.php">Success Stories</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <h2 class="ps-footer-title">Workspace</h2>
                <ul class="ps-footer-links">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="bookmarks.php">Bookmarks</a></li>
                    <li><a href="quiz-result.php">Quiz Results</a></li>
                    <li><a href="login.php">Login</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <h2 class="ps-footer-title">Support</h2>
                <ul class="ps-footer-links">
                    <li><a href="feedback.php">Feedback</a></li>
                    <li><a href="feedback.php">Contact</a></li>
                    <li><a href="help.php">Help</a></li>
                    <li><a href="sitemap.php">Sitemap</a></li>
                    <li><a href="about.php">About</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-12 col-lg-2">
                <h2 class="ps-footer-title">Direction</h2>
                <p class="ps-footer-mini">Compass. Paths. Destination. Growth.</p>
                <a href="quiz.php" class="btn btn-ps-primary btn-sm mt-2">Take Career Quiz</a>
            </div>
        </div>
        <div class="ps-footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> PathSeeker. Built for students, graduates, and professionals.</p>
            <p>Frontend preview — backend integration pending.</p>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="assets/js/app.js"></script>
<?php if (!empty($includeCompass)): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.160.1/three.min.js"></script>
<script src="assets/js/compass.js"></script>
<?php endif; ?>
<?php if (!empty($extraScripts) && is_array($extraScripts)): ?>
    <?php foreach ($extraScripts as $script): ?>
        <script src="<?php echo htmlspecialchars($script, ENT_QUOTES, 'UTF-8'); ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
</body>
</html>
