window.TtoAiSearch = window.TtoAiSearch || {};

(function (ns) {
    let debounceTimer = null;
    let activeIndex = -1;
    let currentItems = [];

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text || '';
        return div.innerHTML;
    }

    function getElements() {
        return {
            input: document.getElementById('aiSearchQuery'),
            list: document.getElementById('aiSearchSuggestions'),
        };
    }

    function hideSuggestions() {
        const { input, list } = getElements();
        if (!list) return;
        list.classList.add('d-none');
        list.innerHTML = '';
        activeIndex = -1;
        currentItems = [];
        if (input) input.setAttribute('aria-expanded', 'false');
    }

    function showSuggestions() {
        const { list, input } = getElements();
        if (!list) return;
        list.classList.remove('d-none');
        if (input) input.setAttribute('aria-expanded', 'true');
    }

    function renderSuggestions(items) {
        const { list } = getElements();
        if (!list) return;

        currentItems = items;
        activeIndex = -1;

        if (!items.length) {
            hideSuggestions();
            return;
        }

        list.innerHTML = items
            .map((item, i) => {
                const icon =
                    item.kind === 'product'
                        ? '<i class="fas fa-box suggest-icon"></i>'
                        : '<i class="fas fa-wand-magic-sparkles suggest-icon"></i>';
                const kindLabel =
                    item.kind === 'product' ? 'Product' : 'AI suggestion';
                return `<li role="option" data-index="${i}" id="aiSuggestOption${i}">
                    ${icon}
                    <span class="suggest-text">${escapeHtml(item.text)}</span>
                    <span class="suggest-kind">${kindLabel}</span>
                </li>`;
            })
            .join('');

        showSuggestions();
    }

    function showLoading() {
        const { list } = getElements();
        if (!list) return;
        list.innerHTML =
            '<li class="suggest-loading"><i class="fas fa-spinner fa-spin"></i> AI suggestions...</li>';
        showSuggestions();
    }

    function applySelection(item) {
        const { input } = getElements();
        if (!input || !item) return;

        hideSuggestions();

        if (item.kind === 'product' && item.url) {
            window.location.href = item.url;
            return;
        }

        input.value = item.text;

        if (document.getElementById('srGrid')) {
            const url = new URL(window.location.href);
            url.searchParams.set('q', item.text);
            url.searchParams.set('mode', 'text');
            window.history.replaceState({}, '', url);
            if (typeof ns.runTextSearch === 'function') {
                ns.runTextSearch(item.text, {}).catch(console.error);
            }
            return;
        }

        window.location.href = `/search-results?q=${encodeURIComponent(item.text)}&mode=text`;
    }

    function setActiveIndex(index) {
        const { list } = getElements();
        if (!list) return;
        const options = list.querySelectorAll('li[role="option"]');
        options.forEach((el, i) => {
            el.classList.toggle('active', i === index);
        });
        activeIndex = index;
    }

    ns.fetchSuggestions = async function (query) {
        const q = (query || '').trim();
        if (q.length < 2) {
            hideSuggestions();
            return;
        }

        showLoading();

        try {
            const data = await ns.getSuggestions(q);
            renderSuggestions(data.suggestions || []);
        } catch (err) {
            console.error(err);
            hideSuggestions();
        }
    };

    ns.initSuggestions = function () {
        const { input, list } = getElements();
        if (!input || !list) return;

        input.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            const value = input.value.trim();
            if (value.length < 2) {
                hideSuggestions();
                return;
            }
            debounceTimer = setTimeout(() => ns.fetchSuggestions(value), 280);
        });

        input.addEventListener('keydown', (e) => {
            if (list.classList.contains('d-none') || !currentItems.length) {
                return;
            }

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                const next =
                    activeIndex < currentItems.length - 1 ? activeIndex + 1 : 0;
                setActiveIndex(next);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                const prev =
                    activeIndex > 0 ? activeIndex - 1 : currentItems.length - 1;
                setActiveIndex(prev);
            } else if (e.key === 'Enter' && activeIndex >= 0) {
                e.preventDefault();
                applySelection(currentItems[activeIndex]);
            } else if (e.key === 'Escape') {
                hideSuggestions();
            }
        });

        list.addEventListener('mousedown', (e) => {
            const li = e.target.closest('li[role="option"]');
            if (!li) return;
            e.preventDefault();
            const index = parseInt(li.dataset.index, 10);
            if (!Number.isNaN(index) && currentItems[index]) {
                applySelection(currentItems[index]);
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.ai-search-input-wrap')) {
                hideSuggestions();
            }
        });
    };
})(window.TtoAiSearch);

document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('aiSearchQuery')) {
        TtoAiSearch.initSuggestions();
    }
});
