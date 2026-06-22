window.TtoAiSearch = window.TtoAiSearch || {};

(function (ns) {
    let pendingImageFile = null;
    let sceneSelection = { x: 0.1, y: 0.1, width: 0.4, height: 0.4 };
    let sceneImage = null;

    let currentSearchMode = 'text';
    let currentImageFile = null;
    let currentSceneCoords = null;
    let currentQuery = '';
    let currentPage = 1;

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text || '';
        return div.innerHTML;
    }

    function productCardHtml(item, showCategory) {
        const url = item.url || `/product-detail/${item.slug || ''}`;
        const img =
            item.image_url || '/frontend_assets/images/banner_img.png';
        const priceOrBrand = item.brand_name || '';
        return `
                <div class="col-sm-6 col-lg-4">
                    <div class="ap-card">
                        <div class="ap-card-top">
                            <img src="${escapeHtml(img)}" class="ap-card-img" alt="${escapeHtml(item.title)}" loading="lazy" />
                            <a href="${escapeHtml(url)}" class="ap-card-link-overlay"></a>
                        </div>
                        <div class="ap-card-body">
                            <a href="${escapeHtml(url)}" class="text-decoration-none text-dark">
                                <div class="ap-card-name">${escapeHtml(item.title)}</div>
                            </a>
                            <div class="ap-card-price">${escapeHtml(priceOrBrand)}</div>
                        </div>
                    </div>
                </div>`;
    }

    function blogCardHtml(blog) {
        const url = blog.url || `/new-blogs/${blog.slug || ''}`;
        const img = blog.image_url || '/frontend_assets/images/banner_img.png';
        const cats = (blog.categories || []).map(c => `<span class="sr-blog-badge">${escapeHtml(c)}</span>`).join('');
        const date = blog.created_at || '';
        return `
                <div class="col-md-6 col-lg-4">
                    <div class="sr-blog-card">
                        <a href="${escapeHtml(url)}" class="sr-blog-card-link">
                            <div class="sr-blog-card-img-wrap">
                                <img src="${escapeHtml(img)}" class="sr-blog-card-img" alt="${escapeHtml(blog.title)}" loading="lazy" />
                                ${cats ? `<div class="sr-blog-badges">${cats}</div>` : ''}
                            </div>
                            <div class="sr-blog-card-body">
                                ${date ? `<span class="sr-blog-date">${escapeHtml(date)}</span>` : ''}
                                <h3 class="sr-blog-card-title">${escapeHtml(blog.title)}</h3>
                                <p class="sr-blog-card-excerpt">${escapeHtml(blog.excerpt || '')}</p>
                                <span class="sr-blog-read-more">Read More <i class="fas fa-chevron-right ms-1"></i></span>
                            </div>
                        </a>
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

    function renderBlogs(data) {
        const section = document.getElementById('srBlogsSection');
        const grid = document.getElementById('srBlogsGrid');
        if (!section || !grid) return;

        const blogs = data.related_blogs || [];
        if (blogs.length === 0) {
            section.classList.add('d-none');
            grid.innerHTML = '';
            return;
        }

        section.classList.remove('d-none');
        grid.innerHTML = blogs.map(blog => blogCardHtml(blog)).join('');
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
        renderBlogs(data);
    }

    function renderPagination(data) {
        const pagEl = document.getElementById('srPagination');
        if (!pagEl) return;

        const total = data.total || 0;
        const page = data.page || 1;
        const limit = data.limit || 9;
        const totalPages = Math.ceil(total / limit);

        if (totalPages <= 1) {
            pagEl.classList.add('d-none');
            pagEl.innerHTML = '';
            return;
        }

        pagEl.classList.remove('d-none');
        let html = '';

        if (page > 1) {
            html += `<a href="#" class="sr-page-link" data-page="${page - 1}"><i class="fas fa-arrow-left"></i> Prev</a>`;
        }

        for (let i = 1; i <= totalPages; i++) {
            if (i === page) {
                html += `<span class="sr-page-num active">${i}</span>`;
            } else {
                if (totalPages > 6 && Math.abs(i - page) > 2 && i !== 1 && i !== totalPages) {
                    if (i === 2 || i === totalPages - 1) {
                        html += `<span class="sr-page-dots" style="color:#383e42;">...</span>`;
                    }
                    continue;
                }
                html += `<a href="#" class="sr-page-num" data-page="${i}">${i}</a>`;
            }
        }

        if (page < totalPages) {
            html += `<a href="#" class="sr-page-link" data-page="${page + 1}">Next <i class="fas fa-arrow-right"></i></a>`;
        }

        pagEl.innerHTML = html;

        pagEl.querySelectorAll('[data-page]').forEach(el => {
            el.addEventListener('click', (e) => {
                e.preventDefault();
                const p = parseInt(el.dataset.page);
                ns.applyFiltersAndSearch(p);
                document.getElementById('srGrid')?.scrollIntoView({ behavior: 'smooth' });
            });
        });
    }

    function showLoading() {
        const grid = document.getElementById('srGrid');
        if (grid) {
            grid.innerHTML =
                '<div class="col-12 text-center py-5" id="srLoadingIndicator"><i class="fas fa-spinner fa-spin fa-2x"></i><h5 class="mt-2">Searching...</h5></div>';
        }
        showRelatedLoading();
    }

    function gatherParams(page = 1) {
        const filters = {};
        const pt = document.querySelector('[data-filter-type="product_type"] .ap-chip.selected');
        if (pt) filters.product_type = pt.dataset.value;

        const sp = document.querySelector('[data-filter-type="space"] .ap-chip.selected');
        if (sp) filters.space = sp.dataset.value;

        const col = document.querySelector('[data-filter-type="color"] .ap-chip.selected');
        if (col && col.dataset.value) filters.color = col.dataset.value;

        const mat = document.querySelector('[data-filter-type="material"] .ap-chip.selected');
        if (mat) filters.material = mat.dataset.value;

        const br = document.querySelector('[data-filter-type="brand"] .ap-chip.selected');
        if (br) filters.brand = br.dataset.value;

        const priceSlider = document.getElementById('apPrice');
        if (priceSlider) {
            filters.max_price = priceSlider.value;
            filters.min_price = 0;
        }

        let sort = 'relevance';
        const activeSort = document.querySelector('#apSortGrid .ap-sort-btn.active');
        if (activeSort) sort = activeSort.dataset.sort;

        return {
            filters,
            sort,
            page,
            limit: 9
        };
    }

    ns.applyFiltersAndSearch = function (page = 1) {
        const params = gatherParams(page);
        if (currentSearchMode === 'text') {
            ns.runTextSearch(currentQuery, params).catch(console.error);
        } else if (currentSearchMode === 'image' || currentSearchMode === 'scene') {
            ns.runImageSearch(currentImageFile, params, currentSceneCoords).catch(console.error);
        }
    };

    ns.runTextSearch = async function (query, params) {
        currentSearchMode = 'text';
        currentQuery = query;
        currentImageFile = null;
        currentSceneCoords = null;
        
        const finalParams = params && params.page ? params : gatherParams(1);
        currentPage = finalParams.page || 1;

        showLoading();
        const data = await ns.searchText({
            query,
            filters: finalParams.filters || null,
            sort: finalParams.sort || 'relevance',
            page: currentPage,
            limit: finalParams.limit || 9,
        });
        renderResults(data);
        renderPagination(data);
    };

    ns.runImageSearch = async function (file, params, sceneCoords) {
        if (sceneCoords) {
            currentSearchMode = 'scene';
            currentSceneCoords = sceneCoords;
        } else {
            currentSearchMode = 'image';
            currentSceneCoords = null;
        }
        currentImageFile = file;

        const finalParams = params && params.page ? params : gatherParams(1);
        currentPage = finalParams.page || 1;

        showLoading();
        const data = sceneCoords
            ? await ns.searchScene(file, sceneCoords, finalParams)
            : await ns.searchImage(file, finalParams);
        renderResults(data);
        renderPagination(data);
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

    ns.initHeaderSearch = function () {
        const textBtn = document.getElementById('headerAiSearchTextBtn');
        const queryInput = document.getElementById('headerAiSearchQuery');
        const imageInput = document.getElementById('headerAiSearchImageInput');
        const modalEl = document.getElementById('aiSearchModal');

        if (textBtn && queryInput) {
            const runSearch = () => {
                const q = queryInput.value.trim();
                if (!q) return;
                if (document.getElementById('srGrid')) {
                    bootstrap.Modal.getInstance(modalEl)?.hide();
                    const url = new URL(window.location.href);
                    url.searchParams.set('q', q);
                    url.searchParams.set('mode', 'text');
                    window.history.replaceState({}, '', url);
                    ns.runTextSearch(q, {}).catch(console.error);
                    return;
                }
                window.location.href = `/search-results?q=${encodeURIComponent(q)}&mode=text`;
            };
            textBtn.addEventListener('click', runSearch);
            queryInput.addEventListener('keydown', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    runSearch();
                }
            });
        }

        if (imageInput) {
            imageInput.addEventListener('change', () => {
                window.location.href = '/search-results?mode=image';
            });
        }

        if (modalEl) {
            modalEl.addEventListener('shown.bs.modal', () => {
                queryInput?.focus();
            });
        }
    };

    ns.initSearchBar = function () {
        const textBtn = document.getElementById('aiSearchTextBtn');
        const queryInput = document.getElementById('aiSearchQuery');
        const imageInput = document.getElementById('aiSearchImageInput');

        document.querySelectorAll('[data-ai-quick]').forEach((chip) => {
            chip.addEventListener('click', () => {
                const q = chip.getAttribute('data-ai-quick') || '';
                if (queryInput) queryInput.value = q;
                if (textBtn && q) textBtn.click();
            });
        });

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
    if (document.getElementById('headerAiSearchBar')) {
        TtoAiSearch.initHeaderSearch();
    }
});
