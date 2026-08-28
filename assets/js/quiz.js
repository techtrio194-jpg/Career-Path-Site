(function () {
    const questions = [
        { q: 'Which kind of workday sounds most satisfying?', a: ['Building something people can use', 'Finding patterns in numbers', 'Designing how something feels', 'Helping a team stay aligned'] },
        { q: 'When a project stalls, you usually…', a: ['Debug until it moves', 'Look at the data again', 'Sketch a simpler flow', 'Talk to stakeholders'] },
        { q: 'Which tool would you happily open first?', a: ['Code editor', 'Spreadsheet / SQL', 'Figma or sketchbook', 'Roadmap / notes app'] },
        { q: 'Your friends would say you are strongest at…', a: ['Systems and logic', 'Evidence and analysis', 'Taste and empathy', 'Clarity and persuasion'] },
        { q: 'A good outcome for you looks like…', a: ['A product that ships', 'A decision backed by insight', 'An interface that feels obvious', 'A team moving in one direction'] },
        { q: 'Learning style you prefer:', a: ['Build a project', 'Study a dataset', 'Redesign a real product', 'Interview users / teams'] },
        { q: 'Which constraint energizes you?', a: ['Performance and reliability', 'Messy, incomplete data', 'Accessibility and usability', 'Limited time and competing goals'] },
        { q: 'In a group, you naturally…', a: ['Own the technical path', 'Question the assumptions', 'Shape the experience', 'Keep scope honest'] },
        { q: 'What would you protect most?', a: ['Code quality', 'Truth in the numbers', 'The user’s trust', 'The product’s purpose'] },
        { q: 'Pick a weekend experiment:', a: ['Ship a small web app', 'Visualize public data', 'Prototype a better checkout', 'Map a career or product plan'] },
        { q: 'Feedback you value most:', a: ['It works under pressure', 'The insight changed our plan', 'People knew what to do', 'We chose the right problem'] },
        { q: 'Which headline would make you proud?', a: ['We launched v1', 'We found the hidden pattern', 'Users finally get it', 'The team shipped with focus'] },
        { q: 'Risk you are most willing to take:', a: ['New technical stack', 'Ambiguous dataset', 'Bold visual direction', 'Saying no to a feature'] },
        { q: 'Ideal collaboration looks like…', a: ['Pairing on architecture', 'Reviewing charts together', 'Critique of a prototype', 'A crisp product brief'] },
        { q: 'Five years from now you want to be known for…', a: ['Reliable systems', 'Clear insight', 'Human-centered design', 'Products that matter'] }
    ];

    const root = document.getElementById('quiz-app');
    if (!root) return;

    let index = 0;
    const answers = new Array(questions.length).fill(null);

    const qText = document.getElementById('quiz-question');
    const answersEl = document.getElementById('quiz-answers');
    const stepEl = document.getElementById('quiz-step');
    const barEl = document.getElementById('quiz-bar');
    const prevBtn = document.getElementById('quiz-prev');
    const nextBtn = document.getElementById('quiz-next');
    const hintEl = document.getElementById('quiz-hint');

    function render() {
        const item = questions[index];
        stepEl.textContent = 'Question ' + (index + 1) + ' of ' + questions.length;
        qText.textContent = item.q;
        barEl.style.width = (((index + 1) / questions.length) * 100) + '%';
        answersEl.innerHTML = '';
        item.a.forEach(function (label, i) {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'answer-card' + (answers[index] === i ? ' is-selected' : '');
            btn.textContent = label;
            btn.setAttribute('aria-pressed', answers[index] === i ? 'true' : 'false');
            btn.addEventListener('click', function () {
                answers[index] = i;
                render();
            });
            answersEl.appendChild(btn);
        });
        prevBtn.disabled = index === 0;
        nextBtn.textContent = index === questions.length - 1 ? 'See results' : 'Next';
        if (hintEl) hintEl.textContent = '';
    }

    prevBtn.addEventListener('click', function () {
        if (index > 0) {
            index -= 1;
            render();
        }
    });

    nextBtn.addEventListener('click', function () {
        if (answers[index] === null) {
            const first = answersEl.querySelector('.answer-card');
            if (first) first.focus();
            if (hintEl) hintEl.textContent = 'Select an answer to continue.';
            return;
        }
        if (index < questions.length - 1) {
            index += 1;
            render();
            return;
        }
        try {
            sessionStorage.setItem('ps-quiz-answers', JSON.stringify(answers));
        } catch (e) {}
        window.location.href = 'quiz-result.php';
    });

    render();
})();
