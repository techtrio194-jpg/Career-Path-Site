(function () {
    const form = document.getElementById('feedback-form');
    if (!form) return;

    const fields = {
        type: document.getElementById('feedback-type'),
        name: document.getElementById('feedback-name'),
        email: document.getElementById('feedback-email'),
        message: document.getElementById('feedback-message')
    };

    function showError(input, message) {
        const error = form.querySelector('[data-error-for="' + input.id + '"]');
        if (error) {
            error.textContent = message;
            error.classList.toggle('is-visible', Boolean(message));
        }
        input.setAttribute('aria-invalid', message ? 'true' : 'false');
    }

    function validEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        let ok = true;

        if (!fields.type.value) {
            showError(fields.type, 'Please choose a feedback type.');
            ok = false;
        } else {
            showError(fields.type, '');
        }

        if (!fields.name.value.trim()) {
            showError(fields.name, 'Name is required.');
            ok = false;
        } else {
            showError(fields.name, '');
        }

        if (!validEmail(fields.email.value.trim())) {
            showError(fields.email, 'Enter a valid email address.');
            ok = false;
        } else {
            showError(fields.email, '');
        }

        if (fields.message.value.trim().length < 12) {
            showError(fields.message, 'Please share a little more detail (at least 12 characters).');
            ok = false;
        } else {
            showError(fields.message, '');
        }

        const success = document.getElementById('feedback-success');
        if (ok) {
            form.reset();
            if (success) success.classList.add('is-visible');
        } else if (success) {
            success.classList.remove('is-visible');
        }
    });
})();
