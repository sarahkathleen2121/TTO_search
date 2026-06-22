@extends('frontend.layouts.master')

@section('title', 'Search Results')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/search-results.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/all-products.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/ai-search.css') }}">
@endpush

@section('content')
    <section style="padding: 0;">
        <div class="container">
            <div class="sr-tabs">
                <a href="#" class="sr-tab active">Products</a>
            </div>

            @include('frontend.components.ai-search-bar', ['style' => 'clean'])

            <div class="ap-toolbar">
                <div class="ap-results" id="srResultsCount">Search results</div>
                <div class="ap-view-toggles">
                    <img src="{{ asset('frontend_assets/images/grid_icon.png') }}" class="ap-view-icon active" id="srGridView3" alt="3 Column Grid" style="width: 24px; height: 24px; cursor: pointer; object-fit: contain;">
                    <img src="{{ asset('frontend_assets/images/grid-2.png') }}" class="ap-view-icon" id="srGridView2" alt="2 Column Grid" style="width: 20px; height: 20px; cursor: pointer; object-fit: contain;">
                </div>
                <button class="ap-toggle" id="srToggle">FILTER & SORT</button>
            </div>

            <div id="srEmptyState" class="sr-empty-state d-none text-center py-5">
                <h5>No products found</h5>
                <p id="srEmptyMessage">Try a different query or upload a clearer product image.</p>
            </div>

            <div class="row g-4 ap-grid" id="srGrid">
                @if(request('q') && request('mode', 'text') !== 'image')
                    <div class="col-12 text-center py-5" id="srLoadingIndicator">
                        <i class="fas fa-spinner fa-spin fa-2x"></i> <h5 class="mt-2">Searching...</h5>
                    </div>
                @endif
            </div>

            <div class="sr-pagination d-none" id="srPagination"></div>

            <div class="sr-related-block d-none" id="srRelatedSection">
                <hr class="sr-related-divider" />
                <h2 class="sr-related-title" id="srRelatedHeading">Related Products</h2>
                <p class="sr-related-subtext" id="srRelatedSubtext">Complementary items curated for your search</p>
                <div class="row g-4 ap-grid" id="srRelatedGrid"></div>
            </div>

            {{-- Related Blogs Section --}}
            <div class="sr-blogs-block d-none" id="srBlogsSection">
                <hr class="sr-related-divider" />
                <h2 class="sr-blogs-title">Related Articles</h2>
                <p class="sr-blogs-subtext">Insights and guides related to your search</p>
                <div class="row g-4" id="srBlogsGrid"></div>
                <div class="sr-blogs-cta">
                    <a href="{{ route('resources') }}" class="sr-blogs-view-all">View All Articles <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>

    @if($featuredProducts->isNotEmpty())
    <section class="container py-5" id="srFeaturedSection">
        <h2 class="text-center mb-4" style="color: #383E42; font-weight: 700;">Featured Products</h2>
        <div class="row g-4 ap-grid">
            @foreach($featuredProducts as $product)
            <div class="col-sm-6 col-lg-4">
                <div class="ap-card">
                    <div class="ap-card-top">
                        <img src="{{ $product->referenceImageUrl() ?? asset('frontend_assets/images/banner_img.png') }}" class="ap-card-img" alt="{{ $product->name }}">
                        <a href="{{ route('product.detail', $product->slug) }}" class="ap-card-link-overlay"></a>
                    </div>
                    <div class="ap-card-body">
                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                            <div class="ap-card-name">{{ $product->name }}</div>
                        </a>
                        @if($product->brand)
                        <div class="ap-card-price">{{ $product->brand->name }}</div>
                        @endif
                    </div>
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

        <!-- Product type -->
        <div class="ap-filter-group" data-filter-type="product_type">
            <div class="ap-filter-label">Product type</div>
            <div class="ap-chip-wrap">
                @foreach($productTypes as $type)
                <span class="ap-chip" data-value="{{ $type->slug }}">{{ $type->name }}</span>
                @endforeach
            </div>
        </div>

        <!-- By Space -->
        <div class="ap-filter-group" data-filter-type="space">
            <div class="ap-filter-label">By Space</div>
            <div class="ap-chip-wrap">
                @foreach($spaces as $space)
                <span class="ap-chip" data-value="{{ $space->slug }}">{{ $space->name }}</span>
                @endforeach
            </div>
        </div>

        <!-- Colors -->
        <div class="ap-filter-group" data-filter-type="color">
            <div class="ap-filter-label">Colors</div>
            <div class="ap-chip-wrap mb-2">
                <span class="ap-chip selected" data-value="">All</span>
            </div>
            <div class="ap-chip-wrap">
                @foreach($colors->take(6) as $color)
                <span class="ap-chip" data-value="{{ $color->name }}">{{ $color->name }}</span>
                @endforeach
            </div>
            <div class="ap-see-all">+ See All</div>
        </div>

        <!-- Material -->
        <div class="ap-filter-group" data-filter-type="material">
            <div class="ap-filter-label">Material</div>
            <div class="ap-chip-wrap">
                @foreach($materials->take(6) as $material)
                <span class="ap-chip" data-value="{{ $material->name }}">{{ $material->name }}</span>
                @endforeach
            </div>
            <div class="ap-see-all">+ See All</div>
        </div>

        <!-- By Brand -->
        <div class="ap-filter-group" data-filter-type="brand">
            <div class="ap-filter-label">By Brand</div>
            <div class="ap-chip-wrap">
                @foreach($brands->take(6) as $brand)
                <span class="ap-chip" data-value="{{ $brand->slug }}">{{ $brand->name }}</span>
                @endforeach
            </div>
            <div class="ap-see-all">+ See All</div>
        </div>

        <!-- Sort by -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">Sort by</div>
            <div class="ap-sort-grid" id="apSortGrid">
                <button class="ap-sort-btn active" data-sort="relevance">Popular First</button>
                <button class="ap-sort-btn" data-sort="latest">Latest First</button>
                <button class="ap-sort-btn" data-sort="name_asc">A — Z</button>
                <button class="ap-sort-btn" data-sort="name_desc">Z — A</button>
            </div>
        </div>
    </aside>

    <script>
        // Grid switching logic
        (function() {
            const grid = document.getElementById('srGrid');
            const view3 = document.getElementById('srGridView3');
            const view2 = document.getElementById('srGridView2');

            function switchGrid(cols) {
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

            view3?.addEventListener('click', () => switchGrid(3));
            view2?.addEventListener('click', () => switchGrid(2));
        })();

        // Sidebar and filters logic
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
            const header = sidebar?.querySelector('.ap-sidebar-header');

            function closeSidebar() {
                sidebar?.classList.remove('open');
                overlay?.classList.remove('open');
                document.body.style.overflow = '';
                if (sidebar) sidebar.scrollTop = 0;
                header?.classList.remove('is-scrolled');
            }
            toggle?.addEventListener('click', openSidebar);
            overlay?.addEventListener('click', closeSidebar);
            done?.addEventListener('click', closeSidebar);

            // Handle chip selection toggle
            document.querySelectorAll('.ap-sidebar .ap-chip').forEach(chip => {
                chip.addEventListener('click', () => {
                    const group = chip.closest('.ap-filter-group');
                    if (!group) return;
                    
                    group.querySelectorAll('.ap-chip').forEach(c => {
                        if (c !== chip) c.classList.remove('selected');
                    });
                    chip.classList.toggle('selected');
                    
                    // Trigger search
                    window.TtoAiSearch.applyFiltersAndSearch?.();
                });
            });

            // Handle sort button toggle
            document.querySelectorAll('.ap-sort-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.ap-sort-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    
                    // Trigger search
                    window.TtoAiSearch.applyFiltersAndSearch?.();
                });
            });

            // Reset filters
            back?.addEventListener('click', () => {
                sidebar?.querySelectorAll('.ap-chip.selected').forEach(c => c.classList.remove('selected'));
                // Set 'All' chip to selected in Color section
                const colorAllChip = sidebar?.querySelector('[data-filter-type="color"] [data-value=""]');
                colorAllChip?.classList.add('selected');

                sidebar?.querySelectorAll('.ap-sort-btn').forEach(b => b.classList.remove('active'));
                sidebar?.querySelector('.ap-sort-btn').classList.add('active');

                window.TtoAiSearch.applyFiltersAndSearch?.();
            });

            // Sticky sidebar header background on scroll
            sidebar?.addEventListener('scroll', () => {
                header?.classList.toggle('is-scrolled', sidebar.scrollTop > 4);
            });
        })();
    </script>
@endsection

