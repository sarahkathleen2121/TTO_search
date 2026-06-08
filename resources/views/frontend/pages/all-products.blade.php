@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/all-products.css') }}?v={{ time() }}">

    <!-- Hero -->
    <section class="ap-hero">
        <div class="container">
            <div class="ap-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('products.type') }}">Products</a> / Product Type</div>
            <h1 class="ap-title">All Products</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="ap-content">
        <div class="container">
            <link rel="stylesheet" href="{{ asset('frontend_assets/css/ai-search.css') }}">
            @include('frontend.components.ai-search-bar', ['style' => 'clean'])
            <!-- Results toolbar -->
            <div class="ap-toolbar">
                <div class="ap-results">{{ $products->total() }} Results</div>
                <div class="ap-view-toggles">
                    <img src="{{ asset('frontend_assets/images/grid_icon.png') }}" class="ap-view-icon active" id="gridView3" alt="3 Column Grid" style="width: 24px; height: 24px; cursor: pointer; object-fit: contain;">
                    <img src="{{ asset('frontend_assets/images/grid-2.png') }}" class="ap-view-icon" id="gridView2" alt="2 Column Grid" style="width: 20px; height: 20px; cursor: pointer; object-fit: contain;">
                </div>
                <button id="apToggle" class="ap-toggle">FILTER & SORT</button>
            </div>

            <!-- Products grid: 3 cols × 3 rows = 9 cards -->
            <div class="row g-4 ap-grid">
                @forelse($products as $product)
                <div class="col-sm-6 col-lg-4">
                    <div class="ap-card">
                        <div class="ap-card-top">
                            <i class="fa-regular fa-heart ap-card-fav" style="cursor:pointer; z-index: 10;" onclick="addToBasket({{ $product->id }})" title="Add to Enquiry Basket"></i>
                            <img src="{{ $product->referenceImageUrl() ?? asset('frontend_assets/images/banner_img.png') }}" class="ap-card-img" alt="{{ $product->name }}">
                            <a href="{{ route('product.detail', $product->slug) }}" class="ap-card-link-overlay"></a>
                        </div>
                        <div class="ap-card-body">
                            <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                                <div class="ap-card-name">{{ $product->name }}</div>
                            </a>
                            <div class="ap-card-price">{{ $product->brand ? $product->brand->name : '$ '.number_format($product->price) }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h5>No products found matching your criteria.</h5>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </section>

    <!-- Filter & Sort Sidebar (slides in from right) -->
    <div class="ap-sidebar-overlay" id="apOverlay"></div>
    <aside class="ap-sidebar" id="apSidebar">
        <div class="ap-sidebar-header">
            <span class="ap-sidebar-back" id="apBack">RESET FILTERS</span>
            <span class="ap-sidebar-title">Filter & Sort</span>
            <span class="ap-sidebar-done" id="apDone">CLOSE</span>
        </div>

        <div class="ap-sidebar-search">
            <input type="text" placeholder="Search products" />
            <button><i class="fas fa-magnifying-glass"></i></button>
        </div>

        <!-- Product type -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">Product type</div>
            <div class="ap-chip-wrap">
                @foreach($productTypes as $type)
                <span class="ap-chip {{ request('product_type') == $type->slug ? 'selected' : '' }}" onclick="window.location.href='{{ request()->fullUrlWithQuery(['product_type' => $type->slug]) }}'">{{ $type->name }}</span>
                @endforeach
            </div>
        </div>

        <!-- By Industry -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">By Industry</div>
            <div class="ap-chip-wrap">
                @foreach($industries as $industry)
                <span class="ap-chip {{ request('industry') == $industry->slug ? 'selected' : '' }}" onclick="window.location.href='{{ request()->fullUrlWithQuery(['industry' => $industry->slug]) }}'">{{ $industry->name }}</span>
                @endforeach
            </div>
        </div>

        <!-- By Space -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">By Space</div>
            <div class="ap-chip-wrap">
                @foreach($spaces as $space)
                <span class="ap-chip {{ request('space') == $space->slug ? 'selected' : '' }}" onclick="window.location.href='{{ request()->fullUrlWithQuery(['space' => $space->slug]) }}'">{{ $space->name }}</span>
                @endforeach
            </div>
        </div>

        <!-- Colors -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">Colors</div>
            <div class="ap-chip-wrap mb-2">
                <span class="ap-chip">All</span>
            </div>
            <div class="ap-chip-wrap">
                @foreach($colors->take(6) as $color)
                <span class="ap-chip">{{ $color->name }}</span>
                @endforeach
            </div>
            <div class="ap-see-all">+ See All</div>
        </div>

        <!-- Material -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">Material</div>
            <div class="ap-chip-wrap">
                @foreach($materials->take(6) as $material)
                <span class="ap-chip">{{ $material->name }}</span>
                @endforeach
            </div>
            <div class="ap-see-all">+ See All</div>
        </div>

        <!-- By Brand -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">By Brand</div>
            <div class="ap-chip-wrap">
                @foreach($brands->take(6) as $brand)
                <span class="ap-chip {{ request('brand') == $brand->slug ? 'selected' : '' }}" onclick="window.location.href='{{ request()->fullUrlWithQuery(['brand' => $brand->slug]) }}'">{{ $brand->name }}</span>
                @endforeach
            </div>
            <div class="ap-see-all">+ See All</div>
        </div>

        <!-- Price -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">Price</div>
            <input id="apPrice" class="ap-range" type="range" min="17" max="815" value="815" />
            <div class="ap-price-row">
                <span>$ 17</span>
                <span id="apPriceLabel">$ 815</span>
            </div>
        </div>

        <!-- Sort by -->
        <div class="ap-filter-group">
            <div class="ap-filter-label">Sort by</div>
            <div class="ap-sort-grid">
                <button class="ap-sort-btn active">Popular First</button>
                <button class="ap-sort-btn">Latest First</button>
                <button class="ap-sort-btn">A — Z</button>
                <button class="ap-sort-btn">Z — A</button>
                <button class="ap-sort-btn">Price High To Low</button>
                <button class="ap-sort-btn">Price Low To High</button>
            </div>
        </div>
    </aside>

    <script>
        // Toggle sidebar
        (function() {
            const toggle = document.getElementById('apToggle');
            const sidebar = document.getElementById('apSidebar');
            const overlay = document.getElementById('apOverlay');
            const back = document.getElementById('apBack');
            const done = document.getElementById('apDone');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }

            const header = sidebar?.querySelector('.ap-sidebar-header');

            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                document.body.style.overflow = '';
                sidebar.scrollTop = 0;
                header?.classList.remove('is-scrolled');
            }

            toggle.addEventListener('click', openSidebar);
            overlay.addEventListener('click', closeSidebar);
            back.addEventListener('click', function() {
                // Reset all chip selections
                document.querySelectorAll('.ap-chip.selected').forEach(c => c.classList.remove('selected'));
                // Reset sort
                document.querySelectorAll('.ap-sort-btn').forEach(b => b.classList.remove('active'));
                document.querySelector('.ap-sort-btn').classList.add('active');
            });
            done.addEventListener('click', closeSidebar);

            // Chip toggle
            document.querySelectorAll('.ap-chip').forEach(chip => {
                chip.addEventListener('click', () => chip.classList.toggle('selected'));
            });

            // Sort button toggle
            document.querySelectorAll('.ap-sort-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.ap-sort-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                });
            });

            // Price range
            const price = document.getElementById('apPrice');
            const priceLabel = document.getElementById('apPriceLabel');
            if (price && priceLabel) {
                price.addEventListener('input', () => {
                    priceLabel.textContent = '$ ' + price.value;
                });
            }

            // Grid view toggle (3 col vs 2 col)
            const grid = document.querySelector('.ap-grid');
            const view3 = document.getElementById('gridView3');
            const view2 = document.getElementById('gridView2');

            view3.addEventListener('click', () => {
                grid.classList.remove('view-2');
                view3.classList.add('active');
                view2.classList.remove('active');
            });

            view2.addEventListener('click', () => {
                grid.classList.add('view-2');
                view2.classList.add('active');
                view3.classList.remove('active');
            });

            // Sticky sidebar header background on scroll
            sidebar?.addEventListener('scroll', () => {
                header?.classList.toggle('is-scrolled', sidebar.scrollTop > 4);
            });
        })();
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('frontend_assets/js/ai-search/api.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/suggestions.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/search.js') }}"></script>
@endpush
