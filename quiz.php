<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit(); }
include 'config.php';

$sql = "SELECT q.question_id, q.question_text, o.option_text, o.career_id, c.career_name 
        FROM tbl_quiz_questions q
        JOIN tbl_quiz_options o ON q.question_id = o.question_id
        JOIN tbl_careers c ON o.career_id = c.career_id
        ORDER BY q.question_id, o.option_id";
$result = $conn->query($sql);

$questions = [];
while ($row = $result->fetch_assoc()) {
    $questions[$row['question_id']]['text'] = $row['question_text'];
    $questions[$row['question_id']]['options'][] = [
        'career_id' => $row['career_id'],
        'career_name' => $row['career_name'],
        'text' => $row['option_text']
    ];
}
$conn->close();
$questions_json = json_encode($questions);
$total_questions = count($questions);

$page_title = 'Quiz';
include 'includes/header.php';
?>

<div class="quiz-container">
    <div class="progress-bar"><div class="progress-fill" id="progressFill"></div></div>
    
    <!-- ✅ FORM TAG YAHAN HAI (Ye missing tha) -->
    <form id="quizForm" action="submit_quiz.php" method="POST">
        <div id="questionContainer"></div>
        <div class="nav-buttons">
            <button type="button" class="btn btn-outline" id="prevBtn" style="width: auto;" disabled>← Previous</button>
            <button type="button" class="btn" id="nextBtn" style="width: auto;">Next →</button>
            <button type="button" class="btn" id="submitBtn" style="width: auto; display: none;">Submit Quiz</button>
        </div>
    </form>
</div>

<script>
const questions = <?php echo $questions_json; ?>;
const qIds = Object.keys(questions);
let current = 0;
const answers = {};
const container = document.getElementById('questionContainer');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');
const submitBtn = document.getElementById('submitBtn');
const progressFill = document.getElementById('progressFill');

function render(qIndex) {
    const qId = qIds[qIndex];
    const q = questions[qId];
    let html = `<h3>Question ${qIndex + 1} of ${qIds.length}</h3><p>${q.text}</p><div class="options-grid">`;
    q.options.forEach(opt => {
        const checked = (answers[qId] == opt.career_id) ? 'checked' : '';
        html += `<label class="option-label ${checked ? 'selected' : ''}">
            <input type="radio" name="q${qId}" value="${opt.career_id}" ${checked}>
            ${opt.text} <span style="color:#999; font-size:12px; margin-left:auto;">→ ${opt.career_name}</span>
        </label>`;
    });
    html += `</div>`;
    container.innerHTML = html;
    
    document.querySelectorAll(`input[name="q${qId}"]`).forEach(radio => {
        radio.addEventListener('change', function() {
            answers[qId] = this.value;
            document.querySelectorAll('.option-label').forEach(l => l.classList.remove('selected'));
            this.closest('.option-label').classList.add('selected');
            updateUI();
        });
    });
    updateUI();
}

function updateUI() {
    prevBtn.disabled = (current === 0);
    const currentQAnswered = (answers[qIds[current]] !== undefined);
    
    if (current === qIds.length - 1) {
        nextBtn.style.display = 'none';
        submitBtn.style.display = 'block';
        const allAnswered = qIds.every(q => answers[q] !== undefined);
        submitBtn.disabled = !allAnswered;
    } else {
        nextBtn.style.display = 'block';
        submitBtn.style.display = 'none';
        nextBtn.disabled = !currentQAnswered;
    }

    const answeredCount = qIds.filter(q => answers[q] !== undefined).length;
    progressFill.style.width = (answeredCount / qIds.length * 100) + '%';
}

prevBtn.addEventListener('click', () => { if (current > 0) { current--; render(current); } });
nextBtn.addEventListener('click', () => { if (current < qIds.length - 1) { current++; render(current); } });

submitBtn.addEventListener('click', () => {
    const form = document.getElementById('quizForm');
    
    // Purane hidden inputs hatao
    const oldInputs = form.querySelectorAll('input[type="hidden"]');
    oldInputs.forEach(input => input.remove());

    // Naye inputs add karo
    qIds.forEach(qId => {
        if (answers[qId]) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = `question[${qId}]`;
            input.value = answers[qId];
            form.appendChild(input);
        }
    });
    
    if (qIds.every(q => answers[q] !== undefined)) {
        form.submit(); // ✅ Ab submit hoga!
    } else {
        alert('Please answer all questions before submitting!');
    }
});

render(0);
</script>
<?php include 'includes/footer.php'; ?>