<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['question'])) {
    $answers = $_POST['question'];
    $career_count = [];
    foreach ($answers as $qid => $cid) { 
        $cid = intval($cid); 
        if(!isset($career_count[$cid])) $career_count[$cid] = 0; 
        $career_count[$cid]++; 
    }
    
    $top_career_id = array_keys($career_count, max($career_count))[0];
    $total_questions = count($answers);
    $match_percentage = round(($career_count[$top_career_id] / $total_questions) * 100, 2);
    
    $sql = "SELECT * FROM tbl_careers WHERE career_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $top_career_id);
    $stmt->execute();
    $career = $stmt->get_result()->fetch_assoc();
    
    $sql_res = "SELECT * FROM tbl_resources WHERE career_id = ?";
    $stmt_res = $conn->prepare($sql_res);
    $stmt_res->bind_param("i", $top_career_id);
    $stmt_res->execute();
    $resources = $stmt_res->get_result();

    $sql_save = "INSERT INTO tbl_quiz_results (user_id, career_id, match_percentage) VALUES (?, ?, ?)";
    $stmt_save = $conn->prepare($sql_save);
    $stmt_save->bind_param("iid", $user_id, $top_career_id, $match_percentage);
    $stmt_save->execute();
    
    $rec_text = "Based on your answers, we recommend " . $career['career_name'] . " (" . $match_percentage . "% match).";
    $sql_rec = "INSERT INTO tbl_recommendations (user_id, career_id, recommendation_text) VALUES (?, ?, ?)";
    $stmt_rec = $conn->prepare($sql_rec);
    $stmt_rec->bind_param("iis", $user_id, $top_career_id, $rec_text);
    $stmt_rec->execute();
    $conn->close();
} else { header("Location: quiz.php"); exit(); }

$page_title = 'Result';
include 'includes/header.php';
?>

<div class="container-wide">
    <!-- Result Header -->
    <div class="result-header">
        <h1>🎯 Your Career Match!</h1>
        <p>Based on your quiz answers, here's your ideal career path</p>
        <div class="match-badge">
            <?php echo $match_percentage; ?>% <small>Match</small>
        </div>
    </div>

    <!-- Career Card -->
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

    <!-- Resources -->
    <?php if ($resources->num_rows > 0): ?>
    <div class="resources-section">
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

    <!-- Summary -->
    <div class="summary-box">
        <h3>📊 Your Quiz Summary</h3>
        <div class="summary-grid">
            <div class="summary-item">
                <span class="label">Total Questions</span>
                <span class="value"><?php echo $total_questions; ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Matching Answers</span>
                <span class="value highlight"><?php echo $career_count[$top_career_id]; ?> / <?php echo $total_questions; ?></span>
            </div>
            <div class="summary-item">
                <span class="label">Top Career</span>
                <span class="value highlight"><?php echo htmlspecialchars($career['career_name']); ?></span>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="actions">
        <a href="quiz.php" class="btn btn-primary" style="width:auto;">🔄 Retake Quiz</a>
        <a href="dashboard.php" class="btn btn-outline" style="width:auto;">🏠 Go to Dashboard</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>