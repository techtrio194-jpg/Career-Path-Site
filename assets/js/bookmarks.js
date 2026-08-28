(function () {
    const tabs = document.querySelectorAll('[data-bookmark-tab]');
    const panels = document.querySelectorAll('[data-bookmark-panel]');

    tabs.forEach(function (tab) {
        tab.addEventListener('click', function () {
            const target = tab.getAttribute('data-bookmark-tab');
            tabs.forEach(function (t) {
                t.classList.toggle('is-active', t === tab);
                t.setAttribute('aria-selected', t === tab ? 'true' : 'false');
            });
            panels.forEach(function (panel) {
                panel.classList.toggle('d-none', panel.getAttribute('data-bookmark-panel') !== target);
            });
        });
    });

    function updateEmptyState(panel) {
        if (!panel) return;
        const remaining = panel.querySelectorAll('[data-bookmark-item]').length;
        let empty = panel.querySelector('[data-empty-bookmarks]');
        if (remaining === 0) {
            if (!empty) {
                empty = document.createElement('p');
                empty.className = 'text-muted';
                empty.setAttribute('data-empty-bookmarks', '');
                empty.textContent = 'No saved items in this list yet.';
                panel.appendChild(empty);
            }
        } else if (empty) {
            empty.remove();
        }
    }

    document.querySelectorAll('[data-remove-bookmark]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const item = btn.closest('[data-bookmark-item]');
            const panel = btn.closest('[data-bookmark-panel]');
            if (item) item.remove();
            updateEmptyState(panel);
        });
    });

    document.querySelectorAll('[data-toggle-note]').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const item = btn.closest('[data-bookmark-item]');
            const note = item ? item.querySelector('.note-box') : null;
            if (note) note.classList.toggle('is-open');
        });
    });
})();
