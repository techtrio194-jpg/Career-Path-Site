<?php
$pageTitle = 'Profile';
$pageDescription = 'Your PathSeeker career profile.';
$activePage = '';
require __DIR__ . '/includes/header.php';
?>

<section class="ps-page-hero">
    <div class="container">
        <p class="section-kicker">Account</p>
        <h1>Career Profile</h1>
    </div>
</section>

<section class="section-sm">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="ps-card p-4 text-center">
                    <div class="avatar mx-auto mb-3">AS</div>
                    <h2 class="h4 mb-1" id="profile-display-name">Ayaan Shah</h2>
                    <p class="text-muted mb-2">ayaan.shah@email.com</p>
                    <span class="tag">Graduate</span>
                    <button class="btn btn-ps-primary w-100 mt-4" type="button" id="profile-edit-toggle" aria-expanded="false" aria-controls="profile-edit-panel">Edit profile</button>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="ps-card p-4 p-lg-5 mb-4 d-none" id="profile-edit-panel">
                    <h2 class="h5">Edit preview</h2>
                    <form id="profile-edit-form">
                        <div class="mb-3">
                            <label class="form-label" for="profile-name">Display name</label>
                            <input class="form-control" id="profile-name" type="text" value="Ayaan Shah">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="profile-headline">Headline</label>
                            <input class="form-control" id="profile-headline" type="text" value="Graduate — seeking first full-time role">
                        </div>
                        <button class="btn btn-ps-primary" type="submit">Save preview</button>
                    </form>
                </div>
                <div class="ps-card p-4 p-lg-5">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h3 class="h6 text-muted">User type</h3>
                            <p>Graduate — seeking first full-time role</p>
                        </div>
                        <div class="col-md-6">
                            <h3 class="h6 text-muted">Education</h3>
                            <p>B.S. Computer Science, 2025</p>
                        </div>
                        <div class="col-12">
                            <h3 class="h6 text-muted">Skills</h3>
                            <div class="tag-row">
                                <span class="tag">JavaScript</span>
                                <span class="tag">PHP</span>
                                <span class="tag">SQL</span>
                                <span class="tag">Figma</span>
                            </div>
                        </div>
                        <div class="col-12">
                            <h3 class="h6 text-muted">Interests</h3>
                            <p>Product design, web platforms, career tools, accessible interfaces.</p>
                        </div>
                        <div class="col-12">
                            <h3 class="h6 text-muted">Experience</h3>
                            <p class="mb-0">Campus developer intern · Freelance landing pages · Capstone: advising portal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
