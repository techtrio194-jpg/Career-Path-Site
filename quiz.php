<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

$user_id = $_SESSION['user_id'];

// Fetch all questions with their options
$sql = "SELECT 
            q.question_id, 
            q.question_text,
            o.option_id,
            o.option_text,
            o.career_id,
            c.career_name
        FROM tbl_quiz_questions q
        JOIN tbl_quiz_options o ON q.question_id = o.question_id
        JOIN tbl_careers c ON o.career_id = c.career_id
        ORDER BY q.question_id, o.option_id";

$result = $conn->query($sql);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[$row['question_id']]['text'] = $row['question_text'];
    $questions[$row['question_id']]['options'][] = [
        'option_id' => $row['option_id'],
        'option_text' => $row['option_text'],
        'career_id' => $row['career_id'],
        'career_name' => $row['career_name']
    ];
}

$conn->close();

$questions_json = json_encode($questions);
$total_questions = count($questions);

$page_title = 'Career Quiz - PathSeeker';
include 'includes/header.php';  // ✅ HEADER INCLUDE
?>

<div class="quiz-container" style="max-width:700px; width:100%; margin:0 auto; background:#FFFFFF; border-radius:16px; padding:clamp(24px,5vw,40px); box-shadow:var(--shadow-sm);">
    
    <!-- Progress -->
    <div class="progress-section">
        <div class="progress-info">
            <span id="questionCounter">Question 1 of <?php echo $total_questions; ?></span>
            <span id="progressPercentage">0% complete</span>
        </div>
        <div class="progress-bar">
            <div class="progress-fill" id="progressFill"></div>
        </div>
    </div>

    <!-- Quiz Form -->
    <form id="quizForm" action="submit_quiz.php" method="POST">
        <div id="questionContainer"></div>

        <div class="nav-buttons">
            <button type="button" class="btn-prev" id="prevBtn" disabled>← Previous</button>
            <button type="button" class="btn-next" id="nextBtn">Next →</button>
            <button type="submit" class="btn-submit" id="submitBtn" style="display:none;">🎯 See My Career Match</button>
        </div>
    </form>
</div>

<script>
    const questions = <?php echo $questions_json; ?>;
    const totalQuestions = <?php echo $total_questions; ?>;
    const questionIds = Object.keys(questions);
    let currentIndex = 0;
    const answers = {};

    const container = document.getElementById('questionContainer');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const progressFill = document.getElementById('progressFill');
    const questionCounter = document.getElementById('questionCounter');
    const progressPercentage = document.getElementById('progressPercentage');

    function renderQuestion(index) {
        const qId = questionIds[index];
        const qData = questions[qId];
        const selectedCareerId = answers[qId] || null;

        let html = `
            <div class="question-number">Question ${index + 1} of ${totalQuestions}</div>
            <div class="question-text">${qData.text}</div>
            <div class="options-grid">
        `;

        qData.options.forEach(opt => {
            const checked = (selectedCareerId == opt.career_id) ? 'checked' : '';
            html += `
                <label class="option-label ${checked ? 'selected' : ''}">
                    <input type="radio" 
                           name="q${qId}" 
                           value="${opt.career_id}" 
                           data-qid="${qId}"
                           data-career="${opt.career_id}"
                           ${checked}>
                    ${opt.option_text}
                    <span class="career-tag">→ ${opt.career_name}</span>
                </label>
            `;
        });

        html += `</div>`;
        container.innerHTML = html;

        document.querySelectorAll(`input[name="q${qId}"]`).forEach(radio => {
            radio.addEventListener('change', function() {
                const qid = this.dataset.qid;
                const careerId = this.value;
                answers[qid] = careerId;
                document.querySelectorAll('.option-label').forEach(label => label.classList.remove('selected'));
                this.closest('.option-label').classList.add('selected');
                updateButtons();
                updateProgress();
            });
        });

        updateButtons();
        updateProgress();
    }

    function updateButtons() {
        prevBtn.disabled = (currentIndex === 0);
        if (currentIndex === totalQuestions - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'block';
            submitBtn.disabled = !questionIds.every(qId => answers[qId] !== undefined);
        } else {
            nextBtn.style.display = 'block';
            submitBtn.style.display = 'none';
            nextBtn.disabled = (answers[questionIds[currentIndex]] === undefined);
        }
    }

    function updateProgress() {
        const answered = questionIds.filter(qId => answers[qId] !== undefined).length;
        const percent = Math.round((answered / totalQuestions) * 100);
        progressFill.style.width = percent + '%';
        questionCounter.textContent = `Question ${currentIndex + 1} of ${totalQuestions}`;
        progressPercentage.textContent = `${percent}% complete`;
    }

    prevBtn.addEventListener('click', () => { if (currentIndex > 0) { currentIndex--; renderQuestion(currentIndex); } });
    nextBtn.addEventListener('click', () => {
        if (answers[questionIds[currentIndex]] !== undefined && currentIndex < totalQuestions - 1) {
            currentIndex++;
            renderQuestion(currentIndex);
        }
    });

    document.getElementById('quizForm').addEventListener('submit', function(e) {
        const allAnswers = {};
        questionIds.forEach(qId => { if (answers[qId] !== undefined) allAnswers[qId] = answers[qId]; });
        for (const [qId, careerId] of Object.entries(allAnswers)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `question[${qId}]`;
            input.value = careerId;
            this.appendChild(input);
        }
        if (Object.keys(allAnswers).length < totalQuestions) {
            e.preventDefault();
            alert('Please answer all questions before submitting!');
        }
    });

    renderQuestion(0);
</script>

<?php include 'includes/footer.php';  // ✅ FOOTER INCLUDE ?>