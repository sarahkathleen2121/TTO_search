@extends('frontend.layouts.master')

@section('title', 'Search Results')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/search-results.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/all-products.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/ai-search.css') }}">
@endpush

@section('content')
    <section style="padding: 0;">
        <div class="container">
            <div class="sr-tabs">
                <a href="#" class="sr-tab active">Products</a>
            </div>

            @include('frontend.components.ai-search-bar', ['style' => 'clean'])

            <div class="sr-toolbar">
                <div class="sr-results-count" id="srResultsCount">Search results</div>
                <div class="sr-view-toggles">
                    <img src="{{ asset('frontend_assets/images/grid_icon.png') }}" class="sr-view-icon active" id="srGridView3" alt="3 Column Grid" style="width: 24px; height: 24px; cursor: pointer; object-fit: contain;" onclick="switchGrid(3)">
                    <img src="{{ asset('frontend_assets/images/grid-2.png') }}" class="sr-view-icon" id="srGridView2" alt="2 Column Grid" style="width: 20px; height: 20px; cursor: pointer; object-fit: contain;" onclick="switchGrid(2)">
                </div>
                <button class="sr-filter-btn" id="srToggle">FILTER & SORT</button>
            </div>

            <div id="srEmptyState" class="sr-empty-state d-none">
                <h5>No products found</h5>
                <p id="srEmptyMessage">Try a different query or upload a clearer product image.</p>
            </div>

            <div class="sr-grid" id="srGrid">
                @if(request('q') && request('mode', 'text') !== 'image')
                    <div class="sr-loading col-12"><i class="fas fa-spinner fa-spin"></i> Searching...</div>
                @endif
            </div>

            <div class="sr-pagination d-none" id="srPagination"></div>

            <div class="sr-related-block d-none" id="srRelatedSection">
                <hr class="sr-related-divider" />
                <h2 class="sr-related-title" id="srRelatedHeading">Related Products</h2>
                <p class="sr-related-subtext" id="srRelatedSubtext">Complementary items curated for your search</p>
                <div class="sr-grid sr-related-grid" id="srRelatedGrid"></div>
            </div>
        </div>
    </section>

    @if($featuredProducts->isNotEmpty())
    <section class="container py-5" id="srFeaturedSection">
        <h2 class="text-center mb-4" style="color: #383E42; font-weight: 700;">Featured Products</h2>
        <div class="sr-grid">
            @foreach($featuredProducts as $product)
            <div class="sr-card">
                <div class="sr-card-top">
                    <a href="{{ route('product.detail', $product->slug) }}">
                        <img src="{{ $product->referenceImageUrl() ?? asset('frontend_assets/images/banner_img.png') }}" class="sr-card-img" alt="{{ $product->name }}" loading="lazy">
                    </a>
                </div>
                <div class="sr-card-body">
                    <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                        <div class="sr-card-name">{{ $product->name }}</div>
                    </a>
                    @if($product->price)
                    <div class="sr-card-price">$ {{ number_format($product->price) }}</div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <div class="ap-sidebar-overlay" id="srOverlay"></div>
    <aside class="ap-sidebar" id="srSidebar">
        <div class="ap-sidebar-header">
            <span class="ap-sidebar-back" id="srBack">RESET FILTERS</span>
            <span class="ap-sidebar-title">Filter & Sort</span>
            <span class="ap-sidebar-done" id="srDone">CLOSE</span>
        </div>
        <div class="ap-filter-group">
            <div class="ap-filter-label">Category</div>
            <div class="ap-chip-wrap" id="srFilterCategories"></div>
        </div>
        <div class="ap-filter-group">
            <div class="ap-filter-label">Brand</div>
            <div class="ap-chip-wrap" id="srFilterBrands"></div>
        </div>
        <div class="ap-filter-group">
            <div class="ap-filter-label">Sort by</div>
            <div class="ap-sort-grid">
                <button class="ap-sort-btn active" data-sort="relevance">Relevance</button>
                <button class="ap-sort-btn" data-sort="category">Category</button>
                <button class="ap-sort-btn" data-sort="price">Price</button>
            </div>
        </div>
    </aside>

    <script>
        function switchGrid(cols) {
            const grid = document.getElementById('srGrid');
            const view3 = document.getElementById('srGridView3');
            const view2 = document.getElementById('srGridView2');
            if (!grid) return;
            if (cols === 2) {
                grid.classList.add('view-2');
                view2?.classList.add('active');
                view3?.classList.remove('active');
            } else {
                grid.classList.remove('view-2');
                view3?.classList.add('active');
                view2?.classList.remove('active');
            }
        }

        (function() {
            const toggle = document.getElementById('srToggle');
            const sidebar = document.getElementById('srSidebar');
            const overlay = document.getElementById('srOverlay');
            const done = document.getElementById('srDone');
            const back = document.getElementById('srBack');

            function openSidebar() {
                sidebar?.classList.add('open');
                overlay?.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            function closeSidebar() {
                sidebar?.classList.remove('open');
                overlay?.classList.remove('open');
                document.body.style.overflow = '';
            }
            toggle?.addEventListener('click', openSidebar);
            overlay?.addEventListener('click', closeSidebar);
            done?.addEventListener('click', closeSidebar);
            back?.addEventListener('click', () => {
                sidebar?.querySelectorAll('.ap-chip.selected').forEach(c => c.classList.remove('selected'));
            });

            TtoAiSearch.getFilters?.().then(data => {
                const catWrap = document.getElementById('srFilterCategories');
                const brandWrap = document.getElementById('srFilterBrands');
                (data.categories || []).slice(0, 12).forEach(v => {
                    const chip = document.createElement('span');
                    chip.className = 'ap-chip';
                    chip.textContent = v;
                    chip.dataset.filterCategory = v;
                    chip.addEventListener('click', () => chip.classList.toggle('selected'));
                    catWrap?.appendChild(chip);
                });
                (data.brands || []).slice(0, 12).forEach(v => {
                    const chip = document.createElement('span');
                    chip.className = 'ap-chip';
                    chip.textContent = v;
                    chip.dataset.filterBrand = v;
                    chip.addEventListener('click', () => chip.classList.toggle('selected'));
                    brandWrap?.appendChild(chip);
                });
            }).catch(() => {});
        })();
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('frontend_assets/js/ai-search/api.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/suggestions.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/search.js') }}"></script>
@endpush
