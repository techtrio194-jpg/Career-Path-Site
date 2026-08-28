(function () {
    function bind(formId, successId) {
        const form = document.getElementById(formId);
        if (!form) return;
        form.addEventListener('submit', function (event) {
            let valid = true;
            form.querySelectorAll('[required]').forEach(function (input) {
                const error = form.querySelector('[data-error-for="' + input.id + '"]');
                const empty = !input.value.trim();
                const emailBad = input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim());
                const minLenAttr = input.getAttribute('minlength');
                const minLen = minLenAttr ? parseInt(minLenAttr, 10) : null;
                const passBad = input.type === 'password' && minLen && input.value.length > 0 && input.value.length < minLen;
                const fail = empty || emailBad || passBad;
                if (error) {
                    error.textContent = empty
                        ? 'This field is required.'
                        : (emailBad ? 'Enter a valid email.' : (passBad ? ('Use at least ' + minLen + ' characters.') : ''));
                    error.classList.toggle('is-visible', fail);
                }
                if (fail) valid = false;
            });

            if (!valid) {
                // Only block submission when client-side checks actually fail.
                event.preventDefault();
                return;
            }

            // Valid: let the browser submit the form normally to the PHP
            // backend (login.php / register.php). We no longer call
            // preventDefault() here, since the backend now handles the
            // real authentication — this box is just a quick visual cue
            // while the page navigates.
            const success = document.getElementById(successId);
            if (success) {
                success.classList.add('is-visible');
            }
        });
    }

    bind('login-form', 'login-success');
    bind('register-form', 'register-success');
})();
