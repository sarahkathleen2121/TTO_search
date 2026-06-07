window.TtoAiSearch = window.TtoAiSearch || {};

(function (ns) {
    let pendingImageFile = null;
    let sceneSelection = { x: 0.1, y: 0.1, width: 0.4, height: 0.4 };
    let sceneImage = null;

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text || '';
        return div.innerHTML;
    }

    function productCardHtml(item, showCategory) {
        const url = item.url || `/product-detail/${item.slug || ''}`;
        const img =
            item.image_url || '/frontend_assets/images/banner_img.png';
        const price = item.price
            ? `$ ${Number(item.price).toLocaleString()}`
            : '';
        const category =
            showCategory && item.category
                ? `<div class="sr-card-category">${escapeHtml(item.category)}</div>`
                : '';
        return `
                <div class="sr-card">
                    <div class="sr-card-top">
                        <i class="fa-regular fa-heart sr-card-fav" style="cursor:pointer;" onclick="addToBasket(${item.id})" title="Add to Enquiry Basket"></i>
                        <a href="${escapeHtml(url)}">
                            <img src="${escapeHtml(img)}" class="sr-card-img" alt="${escapeHtml(item.title)}" loading="lazy" />
                        </a>
                    </div>
                    <div class="sr-card-body">
                        ${category}
                        <a href="${escapeHtml(url)}" class="text-decoration-none text-dark">
                            <div class="sr-card-name">${escapeHtml(item.title)}</div>
                        </a>
                        <div class="sr-card-price">${price}</div>
                    </div>
                </div>`;
    }

    function showRelatedLoading() {
        const section = document.getElementById('srRelatedSection');
        const grid = document.getElementById('srRelatedGrid');
        if (!section || !grid) return;
        section.classList.remove('d-none');
        grid.innerHTML =
            '<div class="sr-related-loading col-12"><i class="fas fa-spinner fa-spin"></i> Finding related products...</div>';
    }

    function renderRelated(data) {
        const section = document.getElementById('srRelatedSection');
        const grid = document.getElementById('srRelatedGrid');
        const heading = document.getElementById('srRelatedHeading');
        const subtext = document.getElementById('srRelatedSubtext');
        if (!section || !grid) return;

        const related = data.related_results || [];
        if (related.length === 0) {
            section.classList.add('d-none');
            grid.innerHTML = '';
            return;
        }

        section.classList.remove('d-none');
        if (heading) {
            heading.textContent = data.related_heading || 'Related Products';
        }
        if (subtext) {
            subtext.textContent =
                'Products that pair well with your search — suggested by AI';
        }
        grid.innerHTML = related
            .map((item) => productCardHtml(item, true))
            .join('');
    }

    function renderResults(data) {
        const grid = document.getElementById('srGrid');
        const countEl = document.getElementById('srResultsCount');
        const emptyEl = document.getElementById('srEmptyState');
        const messageEl = document.getElementById('srEmptyMessage');
        if (!grid) return;

        const results = data.results || [];
        const total = data.total ?? results.length;

        if (countEl) countEl.textContent = `${total} Results`;

        if (results.length === 0) {
            grid.innerHTML = '';
            renderRelated({ related_results: [] });
            if (emptyEl) emptyEl.classList.remove('d-none');
            if (messageEl) {
                messageEl.textContent =
                    data.message ||
                    'No products found. Try different keywords, a clearer photo, or text search.';
            }
            return;
        }

        if (emptyEl) emptyEl.classList.add('d-none');

        grid.innerHTML = results.map((item) => productCardHtml(item, false)).join('');
        renderRelated(data);
    }

    function showLoading() {
        const grid = document.getElementById('srGrid');
        if (grid) {
            grid.innerHTML =
                '<div class="sr-loading col-12"><i class="fas fa-spinner fa-spin"></i> Searching...</div>';
        }
        showRelatedLoading();
    }

    ns.runTextSearch = async function (query, params) {
        showLoading();
        const data = await ns.searchText({
            query,
            filters: params.filters || null,
            sort: params.sort || 'relevance',
            page: params.page || 1,
            limit: params.limit || 20,
        });
        renderResults(data);
    };

    ns.runImageSearch = async function (file, params, sceneCoords) {
        showLoading();
        const data = sceneCoords
            ? await ns.searchScene(file, sceneCoords, params)
            : await ns.searchImage(file, params);
        renderResults(data);
    };

    function initSceneCanvas(file) {
        const canvas = document.getElementById('aiSceneCanvas');
        const ctx = canvas.getContext('2d');
        const img = new Image();
        const url = URL.createObjectURL(file);
        img.onload = function () {
            const maxW = 700;
            const scale = Math.min(1, maxW / img.width);
            canvas.width = img.width * scale;
            canvas.height = img.height * scale;
            sceneImage = { img, scale };
            drawScene();
        };
        img.src = url;
        pendingImageFile = file;

        let dragging = false;
        let startX = 0;
        let startY = 0;

        canvas.onmousedown = (e) => {
            dragging = true;
            const rect = canvas.getBoundingClientRect();
            startX = e.clientX - rect.left;
            startY = e.clientY - rect.top;
            sceneSelection.x = startX / canvas.width;
            sceneSelection.y = startY / canvas.height;
            sceneSelection.width = 0.2;
            sceneSelection.height = 0.2;
            drawScene();
        };
        canvas.onmousemove = (e) => {
            if (!dragging) return;
            const rect = canvas.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            sceneSelection.width = Math.max(0.05, (x - startX) / canvas.width);
            sceneSelection.height = Math.max(0.05, (y - startY) / canvas.height);
            drawScene();
        };
        canvas.onmouseup = () => {
            dragging = false;
        };

        function drawScene() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
            ctx.strokeStyle = '#383E42';
            ctx.lineWidth = 2;
            ctx.strokeRect(
                sceneSelection.x * canvas.width,
                sceneSelection.y * canvas.height,
                sceneSelection.width * canvas.width,
                sceneSelection.height * canvas.height
            );
        }
    }

    ns.initSearchPage = function () {
        const params = new URLSearchParams(window.location.search);
        const q = params.get('q') || '';
        const mode = params.get('mode') || 'text';

        if (q && mode === 'text') {
            ns.runTextSearch(q, {}).catch((err) => {
                console.error(err);
                renderResults({
                    results: [],
                    total: 0,
                    message: 'Search failed. Please try again.',
                });
            });
        }

        const textBtn = document.getElementById('aiSearchTextBtn');
        const queryInput = document.getElementById('aiSearchQuery');
        if (textBtn && queryInput) {
            textBtn.addEventListener('click', () => {
                const query = queryInput.value.trim();
                if (!query) return;
                const url = new URL(window.location.href);
                url.searchParams.set('q', query);
                url.searchParams.set('mode', 'text');
                window.history.replaceState({}, '', url);
                ns.runTextSearch(query, {}).catch(console.error);
            });
            queryInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') textBtn.click();
            });
        }

        const imageInput = document.getElementById('aiSearchImageInput');
        if (imageInput) {
            imageInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (!file) return;
                const modal = new bootstrap.Modal(
                    document.getElementById('aiSceneModal')
                );
                initSceneCanvas(file);
                modal.show();
            });
        }

        const sceneConfirm = document.getElementById('aiSceneConfirm');
        if (sceneConfirm) {
            sceneConfirm.addEventListener('click', () => {
                if (!pendingImageFile) return;
                bootstrap.Modal.getInstance(
                    document.getElementById('aiSceneModal')
                )?.hide();
                ns.runImageSearch(pendingImageFile, {}, sceneSelection).catch(
                    console.error
                );
            });
        }
    };

    ns.initSearchBar = function () {
        const textBtn = document.getElementById('aiSearchTextBtn');
        const queryInput = document.getElementById('aiSearchQuery');
        const imageInput = document.getElementById('aiSearchImageInput');

        if (textBtn && queryInput) {
            textBtn.addEventListener('click', () => {
                const q = queryInput.value.trim();
                if (!q) return;
                window.location.href = `/search-results?q=${encodeURIComponent(q)}&mode=text`;
            });
            queryInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    textBtn.click();
                }
            });
        }

        if (imageInput) {
            imageInput.addEventListener('change', (e) => {
                const file = e.target.files[0];
                if (!file) return;
                sessionStorage.setItem('tto_pending_image', '1');
                window.location.href = '/search-results?mode=image';
            });
        }
    };
})(window.TtoAiSearch);

document.addEventListener('DOMContentLoaded', function () {
    if (document.getElementById('srGrid')) {
        TtoAiSearch.initSearchPage();
    }
    if (document.getElementById('aiSearchBar') && !document.getElementById('srGrid')) {
        TtoAiSearch.initSearchBar();
    }
});
