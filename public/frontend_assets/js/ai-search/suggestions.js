window.TtoAiSearch = window.TtoAiSearch || {};

(function (ns) {
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text || '';
        return div.innerHTML;
    }

    /**
     * Creates an independent suggestions controller for a given
     * input + list pair. Each instance keeps its own state so
     * multiple search bars on the same page don't interfere.
     */
    function createInstance(inputEl, listEl) {
        let debounceTimer = null;
        let activeIndex = -1;
        let currentItems = [];

        function hideSuggestions() {
            if (!listEl) return;
            listEl.classList.add('d-none');
            listEl.innerHTML = '';
            activeIndex = -1;
            currentItems = [];
            if (inputEl) inputEl.setAttribute('aria-expanded', 'false');
        }

        function showSuggestions() {
            if (!listEl) return;
            listEl.classList.remove('d-none');
            if (inputEl) inputEl.setAttribute('aria-expanded', 'true');
        }

        function renderSuggestions(items) {
            if (!listEl) return;

            currentItems = items;
            activeIndex = -1;

            if (!items.length) {
                hideSuggestions();
                return;
            }

            listEl.innerHTML = items
                .map((item, i) => {
                    const icon =
                        item.kind === 'product'
                            ? '<i class="fas fa-box suggest-icon"></i>'
                            : '<i class="fas fa-wand-magic-sparkles suggest-icon"></i>';
                    const kindLabel =
                        item.kind === 'product' ? 'Product' : 'AI suggestion';
                    return `<li role="option" data-index="${i}" id="${inputEl.id}Option${i}">
                        ${icon}
                        <span class="suggest-text">${escapeHtml(item.text)}</span>
                        <span class="suggest-kind">${kindLabel}</span>
                    </li>`;
                })
                .join('');

            showSuggestions();
        }

        function showLoading() {
            if (!listEl) return;
            listEl.innerHTML =
                '<li class="suggest-loading"><i class="fas fa-spinner fa-spin"></i> AI suggestions...</li>';
            showSuggestions();
        }

        function applySelection(item) {
            if (!inputEl || !item) return;

            hideSuggestions();

            if (item.kind === 'product' && item.url) {
                window.location.href = item.url;
                return;
            }

            inputEl.value = item.text;

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
            if (!listEl) return;
            const options = listEl.querySelectorAll('li[role="option"]');
            options.forEach((el, i) => {
                el.classList.toggle('active', i === index);
            });
            activeIndex = index;
        }

        async function fetchSuggestions(query) {
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
        }

        // --- Bind events ---

        inputEl.addEventListener('input', () => {
            clearTimeout(debounceTimer);
            const value = inputEl.value.trim();
            if (value.length < 2) {
                hideSuggestions();
                return;
            }
            debounceTimer = setTimeout(() => fetchSuggestions(value), 280);
        });

        inputEl.addEventListener('keydown', (e) => {
            if (listEl.classList.contains('d-none') || !currentItems.length) {
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

        listEl.addEventListener('mousedown', (e) => {
            const li = e.target.closest('li[role="option"]');
            if (!li) return;
            e.preventDefault();
            const index = parseInt(li.dataset.index, 10);
            if (!Number.isNaN(index) && currentItems[index]) {
                applySelection(currentItems[index]);
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.ai-search-input-wrap') && !e.target.closest('.ai-home-input-wrap')) {
                hideSuggestions();
            }
        });

        return { fetchSuggestions, hideSuggestions };
    }

    // Keep backward-compatible public API
    ns.fetchSuggestions = function () {};

    ns.initSuggestions = function (opts = {}) {
        const input = document.getElementById(opts.inputId || 'aiSearchQuery');
        const list = document.getElementById(opts.listId || 'aiSearchSuggestions');
        if (!input || !list) return;

        const instance = createInstance(input, list);

        // If this is the default (page) instance, expose fetchSuggestions globally
        if (!opts.inputId || opts.inputId === 'aiSearchQuery') {
            ns.fetchSuggestions = instance.fetchSuggestions;
        }
    };
})(window.TtoAiSearch);

document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('aiSearchQuery')) {
        TtoAiSearch.initSuggestions();
    }
    if (document.getElementById('headerAiSearchQuery')) {
        TtoAiSearch.initSuggestions({
            inputId: 'headerAiSearchQuery',
            listId: 'headerAiSearchSuggestions',
        });
    }
});
