(function () {
    const navbar = document.getElementById('site-navbar');
    const themeToggle = document.getElementById('theme-toggle');
    const themeIcon = document.querySelector('[data-theme-icon]');
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    const savedTheme = localStorage.getItem('ps-theme');
    if (savedTheme === 'dark') {
        document.documentElement.setAttribute('data-theme', 'dark');
        if (themeIcon) themeIcon.className = 'fa-solid fa-sun';
    }

    function onScroll() {
        if (!navbar) return;
        navbar.classList.toggle('is-scrolled', window.scrollY > 12);
    }

    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });

    if (themeToggle) {
        themeToggle.addEventListener('click', function () {
            const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
            const next = isDark ? 'light' : 'dark';
            if (next === 'light') {
                document.documentElement.removeAttribute('data-theme');
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
            localStorage.setItem('ps-theme', next);
            if (themeIcon) {
                themeIcon.className = next === 'dark' ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
            }
        });
    }

    if (window.AOS) {
        AOS.init({
            duration: reduceMotion ? 0 : 700,
            once: true,
            offset: 80,
            disable: reduceMotion
        });
    }

    const bars = document.querySelectorAll('.bar[data-value]');
    if (bars.length && 'IntersectionObserver' in window) {
        const io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.4 });
        bars.forEach(function (bar) {
            bar.style.setProperty('--value', bar.getAttribute('data-value') + '%');
            io.observe(bar);
        });
    }

    const greeting = document.querySelector('[data-greeting]');
    if (greeting) {
        const hour = new Date().getHours();
        const text = hour < 12 ? 'Good Morning' : hour < 18 ? 'Good Afternoon' : 'Good Evening';
        greeting.textContent = text + ' 👋';
    }

    document.querySelectorAll('[data-video-play]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const card = btn.closest('.video-card');
            const status = card ? card.querySelector('[data-video-status]') : null;
            if (status) {
                status.textContent = 'Preview placeholder — video player will connect to backend later.';
            }
        });
    });

    document.querySelectorAll('.ps-bookmark, [data-bookmark-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const icon = btn.querySelector('i');
            const pressed = btn.getAttribute('aria-pressed') === 'true';
            btn.setAttribute('aria-pressed', pressed ? 'false' : 'true');
            if (icon) {
                icon.classList.toggle('fa-regular', pressed);
                icon.classList.toggle('fa-solid', !pressed);
            }
            btn.title = pressed ? 'Bookmark' : 'Bookmarked';
        });
    });

    document.querySelectorAll('[data-story-filter]').forEach(function (chip) {
        chip.addEventListener('click', function () {
            const value = chip.getAttribute('data-story-filter');
            document.querySelectorAll('[data-story-filter]').forEach(function (c) {
                c.classList.toggle('is-active', c === chip);
            });
            document.querySelectorAll('[data-story-card]').forEach(function (card) {
                const show = value === 'all' || card.getAttribute('data-domain') === value;
                card.classList.toggle('d-none', !show);
            });
        });
    });

    function toast(message) {
        let el = document.getElementById('ps-toast');
        if (!el) {
            el = document.createElement('div');
            el.id = 'ps-toast';
            el.className = 'ps-toast';
            el.setAttribute('role', 'status');
            document.body.appendChild(el);
        }
        el.textContent = message;
        el.classList.add('is-visible');
        clearTimeout(toast.timer);
        toast.timer = setTimeout(function () {
            el.classList.remove('is-visible');
        }, 2800);
    }

    document.querySelectorAll('[data-placeholder]').forEach(function (el) {
        el.addEventListener('click', function () {
            toast(el.getAttribute('data-placeholder') || 'This action will connect to the backend later.');
        });
    });

    const editToggle = document.getElementById('profile-edit-toggle');
    const editPanel = document.getElementById('profile-edit-panel');
    const editForm = document.getElementById('profile-edit-form');
    if (editToggle && editPanel) {
        editToggle.addEventListener('click', function () {
            const open = !editPanel.classList.contains('d-none');
            editPanel.classList.toggle('d-none', open);
            editToggle.textContent = open ? 'Edit profile' : 'Close editor';
            editToggle.setAttribute('aria-expanded', open ? 'false' : 'true');
        });
    }
    if (editForm) {
        editForm.addEventListener('submit', function (event) {
            event.preventDefault();
            const name = document.getElementById('profile-name');
            const display = document.getElementById('profile-display-name');
            if (name && display && name.value.trim()) {
                display.textContent = name.value.trim();
            }
            toast('Profile preview updated. Saving will connect to the backend later.');
        });
    }
})();
