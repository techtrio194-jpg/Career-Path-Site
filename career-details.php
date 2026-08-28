<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';

$career_id = intval($_GET['id']); // URL se ID lo

// Career ki details fetch karo
$sql = "SELECT * FROM tbl_careers WHERE career_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $career_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // Agar career nahi mila toh wapas bhejo
    header("Location: careers.php");
    exit();
}

$career = $result->fetch_assoc();

// Resources bhi fetch karo (agar database mein hain)
$sql_res = "SELECT * FROM tbl_resources WHERE career_id = ?";
$stmt_res = $conn->prepare($sql_res);
$stmt_res->bind_param("i", $career_id);
$stmt_res->execute();
$resources = $stmt_res->get_result();

$page_title = 'Career Details';
include 'includes/header.php';
?>

<div class="container">
    <a href="careers.php" class="btn-link" style="display:inline-block; margin-bottom:20px;">← Back to Careers</a>

    <div class="career-card">
        <div class="title"><span class="icon">🚀</span> <?php echo htmlspecialchars($career['career_name']); ?></div>
        <div class="description"><?php echo htmlspecialchars($career['description']); ?></div>

        <div class="details-grid">
            <div class="detail-item">
                <span class="icon">🎓</span>
                <div>
                    <div class="label">Required Education</div>
                    <div class="value green">✅ <?php echo htmlspecialchars($career['required_education']); ?></div>
                </div>
            </div>
            <div class="detail-item">
                <span class="icon">🛠️</span>
                <div>
                    <div class="label">Required Skills</div>
                    <div class="value"><?php echo htmlspecialchars($career['required_skills']); ?></div>
                </div>
            </div>
            <div class="detail-item">
                <span class="icon">💰</span>
                <div>
                    <div class="label">Salary Range</div>
                    <div class="value"><?php echo htmlspecialchars($career['salary_range']); ?></div>
                </div>
            </div>
            <div class="detail-item">
                <span class="icon">📈</span>
                <div>
                    <div class="label">Career Scope</div>
                    <div class="value"><?php echo htmlspecialchars($career['career_scope']); ?></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Save Button -->
    <div style="text-align: center; margin-top: 20px;">
        <a href="save_bookmark.php?id=<?php echo $career['career_id']; ?>" class="btn btn-primary" style="display: inline-block; width: auto;">🔖 Save this Career</a>
    </div>

    <!-- Resources -->
    <?php if ($resources->num_rows > 0): ?>
    <div class="resources-section" style="margin-top: 20px;">
        <h2>📚 Recommended Learning Resources</h2>
        <?php while ($resource = $resources->fetch_assoc()): ?>
        <div class="resource-item">
            <div class="info">
                <span class="title"><?php echo htmlspecialchars($resource['resource_title']); ?></span>
                <span class="type">📖 <?php echo htmlspecialchars($resource['resource_type']); ?></span>
                <?php if (!empty($resource['description'])): ?>
                    <span class="desc"><?php echo htmlspecialchars($resource['description']); ?></span>
                <?php endif; ?>
            </div>
            <a href="<?php echo htmlspecialchars($resource['resource_link']); ?>" target="_blank" class="btn-resource">View Resource →</a>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>