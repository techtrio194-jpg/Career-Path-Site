(function () {
    const search = document.getElementById('career-search');
    const domain = document.getElementById('filter-domain');
    const salary = document.getElementById('filter-salary');
    const demand = document.getElementById('filter-demand');
    const cards = document.querySelectorAll('[data-career-card]');
    const empty = document.getElementById('careers-empty');
    const count = document.getElementById('careers-count');

    if (!cards.length) return;

    function applyFilters() {
        const q = (search && search.value ? search.value : '').toLowerCase().trim();
        const d = domain ? domain.value : 'all';
        const s = salary ? salary.value : 'all';
        const dem = demand ? demand.value : 'all';
        let visible = 0;

        cards.forEach(function (card) {
            const hay = (card.getAttribute('data-title') + ' ' + card.getAttribute('data-skills')).toLowerCase();
            const matchQ = !q || hay.indexOf(q) !== -1;
            const matchD = d === 'all' || card.getAttribute('data-domain') === d;
            const matchS = s === 'all' || card.getAttribute('data-salary') === s;
            const matchDem = dem === 'all' || card.getAttribute('data-demand') === dem;
            const show = matchQ && matchD && matchS && matchDem;
            card.classList.toggle('d-none', !show);
            if (show) visible += 1;
        });

        if (empty) empty.classList.toggle('d-none', visible !== 0);
        if (count) count.textContent = visible + ' career' + (visible === 1 ? '' : 's') + ' shown';
    }

    [search, domain, salary, demand].forEach(function (el) {
        if (!el) return;
        el.addEventListener(el.tagName === 'INPUT' ? 'input' : 'change', applyFilters);
    });

    applyFilters();
})();
