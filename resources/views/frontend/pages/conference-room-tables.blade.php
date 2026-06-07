@extends('frontend.layouts.master')

@section('title', $space->name . ' ' . (isset($productType) ? $productType->name : '') . ' - The Total Office')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/conference-room-tables.css') }}">
    <style>
        .crt-breadcrumb a {
            text-decoration: none;
            color: inherit;
        }
        .crt-breadcrumb a:hover {
            text-decoration: none;
            color: inherit;
            opacity: 0.8;
        }
    </style>
    <!-- Header/Hero -->
    <div class="crt-hero-bg">
        <div class="container">
            <div class="crt-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / 
                @if(isset($context) && $context === 'industry')
                    <a href="{{ route('shop.by.industry') }}">Shop By Industry</a> / <a href="{{ route('industry.categories', $space->slug) }}">{{ $space->name }}</a>
                @elseif(isset($context) && $context === 'brand')
                    <a href="{{ route('shop.by.brands') }}">Shop By Brand</a> / <a href="{{ route('brand.detail', $space->slug) }}">{{ $space->name }}</a>
                @elseif(isset($context) && $context === 'product')
                    <a href="{{ route('products.type') }}">Shop By Product</a> / <a href="{{ route('product_type.detail', $space->slug) }}">{{ $space->name }}</a>
                @else
                    <a href="{{ route('shop.by.space') }}">Shop By Space</a> / <a href="{{ route('space.detail', $space->slug) }}">{{ $space->name }}</a>
                @endif
                @if(isset($productType))
                    / {{ $productType->name }}
                @endif
            </div>
            <h1 class="crt-title">
                {{ $space->name }}
                @if(isset($productType))
                    <span style="font-size: 0.6em; display: block; opacity: 0.8; font-weight: normal; margin-top: 10px;">{{ $productType->name }}</span>
                @endif
            </h1>
        </div>
    </div>

    <!-- The overlapping search bar -->
    <div class="container position-relative crt-search-wrapper" style="z-index: 1050; overflow: visible;">
        <link rel="stylesheet" href="{{ asset('frontend_assets/css/ai-search.css') }}">
        @include('frontend.components.ai-search-bar', ['style' => 'clean'])
    </div>

    <section>
        <div class="container">
            <!-- Results & view toggles -->
            <div class="crt-results-bar d-flex align-items-center justify-content-between">
                <div class="crt-results">{{ $products->count() }} Results</div>
                <div class="crt-grid-toggles d-flex align-items-center gap-3">
                    <img src="{{ asset('frontend_assets/images/grid_icon.png') }}" class="crt-view-icon active" id="crtGridView3" alt="3 Column Grid" style="width: 24px; height: 24px; cursor: pointer; object-fit: contain;">
                    <img src="{{ asset('frontend_assets/images/grid-2.png') }}" class="crt-view-icon" id="crtGridView2" alt="2 Column Grid" style="width: 20px; height: 20px; cursor: pointer; object-fit: contain;">
                </div>
                <button id="crtToggle" class="crt-toggle">FILTER & SORT</button>
            </div>

            <!-- Products grid -->
            <main class="mt-4">
                <div class="row g-3 g-lg-4 crt-grid">
                    @forelse($products as $product)
                    <div class="col-sm-6 col-md-4">
                        <div class="crt-card">
                            <div class="crt-card-top position-relative">
                                <i class="fa-regular fa-heart crt-card-heart text-white" style="text-shadow: 0 0 5px rgba(0,0,0,0.3); cursor:pointer;" onclick="addToBasket({{ $product->id }})" title="Add to Enquiry Basket"></i>
                                <a href="{{ route('product.detail', $product->slug) }}">
                                    <img src="{{ $product->referenceImageUrl() ?? asset('frontend_assets/images/banner_img.png') }}" class="crt-card-img" alt="{{ $product->name }}">
                                </a>
                            </div>
                            <div class="crt-card-body">
                                <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                                    <div class="crt-card-name">{{ $product->name }}</div>
                                </a>
                                <div class="crt-card-brand">{{ $product->brand ? $product->brand->name : 'Manufacturer Brand' }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <h5>No products found.</h5>
                    </div>
                    @endforelse
                </div>
            </main>
        </div>
    </section>
    
    <!-- Filter & Sort Sidebar (slides in from left) -->
    <div class="crt-sidebar-overlay" id="crtOverlay"></div>
    <aside class="crt-sidebar" id="crtSidebar">
        <div class="crt-sidebar-header">
            <span class="crt-sidebar-back" id="crtBack">RESET FILTERS</span>
            <span class="crt-sidebar-title">Filter & Sort</span>
            <span class="crt-sidebar-done" id="crtDone">CLOSE</span>
        </div>

        <div class="crt-sidebar-search">
            <input type="text" placeholder="Search products" />
            <button><i class="fas fa-magnifying-glass"></i></button>
        </div>

        <div class="crt-filter-group">
            <div class="crt-filter-label">Product type</div>
            <div class="crt-chip-wrap">
                @foreach($productTypes as $type)
                    <span class="crt-chip" data-slug="{{ $type->slug }}">{{ $type->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="crt-filter-group">
            <div class="crt-filter-label">Colors</div>
            <div class="crt-chip-wrap">
                <span class="crt-chip selected">All</span>
                @foreach($colors as $color)
                    <span class="crt-chip" data-slug="{{ $color->slug }}">{{ $color->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="crt-filter-group">
            <div class="crt-filter-label">Material</div>
            <div class="crt-chip-wrap">
                @foreach($materials as $material)
                    <span class="crt-chip" data-slug="{{ $material->slug }}">{{ $material->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="crt-filter-group">
            <div class="crt-filter-label">Price</div>
            <input id="crtPrice" class="crt-range" type="range" min="17" max="815" value="417" />
            <div class="crt-price-row">
                <span>$ 17</span>
                <span id="crtPriceLabel">$ 815</span>
            </div>
        </div>

        <div class="crt-filter-group">
            <div class="crt-filter-label">Sort by</div>
            <div class="crt-sort-grid">
                <button class="crt-sort-btn active">Popular First</button>
                <button class="crt-sort-btn">Latest First</button>
                <button class="crt-sort-btn">A — Z</button>
                <button class="crt-sort-btn">Z — A</button>
                <button class="crt-sort-btn">Price High To Low</button>
                <button class="crt-sort-btn">Price Low To High</button>
            </div>
        </div>
    </aside>

    <script>
        (function() {
            const toggle = document.getElementById('crtToggle');
            const sidebar = document.getElementById('crtSidebar');
            const overlay = document.getElementById('crtOverlay');
            const back = document.getElementById('crtBack');
            const done = document.getElementById('crtDone');

            function openSidebar() {
                sidebar.classList.add('open');
                overlay.classList.add('open');
                document.body.style.overflow = 'hidden';
            }
            function closeSidebar() {
                sidebar.classList.remove('open');
                overlay.classList.remove('open');
                document.body.style.overflow = '';
            }

            toggle.addEventListener('click', openSidebar);
            overlay.addEventListener('click', closeSidebar);
            done.addEventListener('click', closeSidebar);
            
            back.addEventListener('click', function() {
                document.querySelectorAll('.crt-chip.selected').forEach(c => c.classList.remove('selected'));
                document.querySelectorAll('.crt-sort-btn').forEach(b => b.classList.remove('active'));
                document.querySelector('.crt-sort-btn').classList.add('active');
            });

            document.querySelectorAll('.crt-chip').forEach(chip => {
                chip.addEventListener('click', () => chip.classList.toggle('selected'));
            });

            document.querySelectorAll('.crt-sort-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.crt-sort-btn').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                });
            });

            const price = document.getElementById('crtPrice');
            const priceLabel = document.getElementById('crtPriceLabel');
            if (price && priceLabel) {
                price.addEventListener('input', () => {
                    priceLabel.textContent = '$ ' + price.value;
                });
            }

            // Grid view toggle (3 col vs 2 col)
            const grid = document.querySelector('.crt-grid');
            const view3 = document.getElementById('crtGridView3');
            const view2 = document.getElementById('crtGridView2');

            if (view3 && view2 && grid) {
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
            }
        })();
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('frontend_assets/js/ai-search/api.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/suggestions.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/search.js') }}"></script>
@endpush
