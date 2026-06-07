@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/conference-rooms.css') }}?v={{ time() }}">
    <style>
        .cr-breadcrumb a {
            text-decoration: none;
            color: inherit;
        }
        .cr-breadcrumb a:hover {
            text-decoration: none;
            color: inherit;
            opacity: 0.8;
        }
    </style>
    <section class="cr-hero">
        <div class="container">
            <div class="cr-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / 
                @if(isset($context) && $context === 'industry')
                    <a href="{{ route('shop.by.industry') }}">Shop By Industry</a>
                @elseif(isset($context) && $context === 'brand')
                    <a href="{{ route('shop.by.brands') }}">Shop By Brands</a>
                @elseif(isset($context) && $context === 'product')
                    <a href="{{ route('products.type') }}">Shop By Product</a>
                @else
                    <a href="{{ route('shop.by.space') }}">Shop By Space</a>
                @endif
                / {{ $space->name }}
            </div>
            <h1 class="cr-title">{{ $space->name }}</h1>
        </div>
    </section>

    <div class="cr-blocks-wrap">
        @forelse($productTypes as $type)
        <!-- Block for {{ $type->name }} -->
        <div class="cr-block" data-slider>
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 d-flex flex-column mb-4 mb-lg-0 py-lg-4">
                        <h2 class="cr-head">{{ $type->name }}</h2>
                        <div class="d-flex gap-3 mt-2">
                            <button class="cr-navbtn" data-prev><i class="fas fa-chevron-left"></i></button>
                            <button class="cr-navbtn" data-next><i class="fas fa-chevron-right"></i></button>
                        </div>
                        <div class="mt-auto pt-5">
                            @if(isset($context) && $context === 'industry')
                                <a href="{{ route('industry.products', ['industry_slug' => $space->slug, 'type_slug' => $type->slug]) }}" class="cr-view-all">View All <i class="fas fa-chevron-right ms-1"></i></a>
                            @elseif(isset($context) && $context === 'brand')
                                <a href="{{ route('brand.products', ['brand_slug' => $space->slug, 'type_slug' => $type->slug]) }}" class="cr-view-all">View All <i class="fas fa-chevron-right ms-1"></i></a>
                            @elseif(isset($context) && $context === 'product')
                                <a href="{{ route('product_type.space', ['product_type_slug' => $space->slug, 'space_slug' => $type->slug]) }}" class="cr-view-all">View All <i class="fas fa-chevron-right ms-1"></i></a>
                            @else
                                <a href="{{ route('space.products', ['space_slug' => $space->slug, 'type_slug' => $type->slug]) }}" class="cr-view-all">View All <i class="fas fa-chevron-right ms-1"></i></a>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="cr-viewport">
                            <div class="cr-track">
                                @forelse($type->products as $product)
                                <div class="cr-card">
                                    <div class="cr-card-top position-relative">
                                        <i class="fa-regular fa-heart cr-card-heart text-white" style="text-shadow: 0 0 5px rgba(0,0,0,0.3); cursor:pointer;" onclick="addToBasket({{ $product->id }})" title="Add to Enquiry Basket"></i>
                                        <a href="{{ route('product.detail', $product->slug) }}">
                                            <img src="{{ $product->referenceImageUrl() ?? asset('frontend_assets/images/banner_img.png') }}" alt="{{ $product->name }}" class="cr-card-img">
                                        </a>
                                    </div>
                                    <div class="cr-card-body px-0">
                                        <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                                            <div class="cr-name">{{ $product->name }}</div>
                                        </a>
                                        <div class="cr-brand">{{ $product->brand ? $product->brand->name : 'Manufacturer Brand' }}</div>
                                    </div>
                                </div>
                                @empty
                                <p class="text-muted p-4">No products available in this category.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="container py-5 text-center">
            <h4>No product types available.</h4>
        </div>
        @endforelse
    </div>

    <script>
        // Reusable, smooth sliders for all [data-slider] blocks
        (function() {
            document.querySelectorAll('[data-slider]').forEach(function(block) {
                const track = block.querySelector('.cr-track');
                const prev = block.querySelector('[data-prev]');
                const next = block.querySelector('[data-next]');
                let index = 0;

                function step() {
                    const first = track.children[0];
                    const gap = 18; // CSS gap
                    return first.getBoundingClientRect().width + gap;
                }

                function maxIndex() {
                    const viewport = block.querySelector('.cr-viewport');
                    const perView = Math.max(1, Math.floor(viewport.clientWidth / track.children[0]
                        .getBoundingClientRect().width));
                    return Math.max(0, track.children.length - perView);
                }

                function update() {
                    const translate = -index * step();
                    track.style.transform = `translateX(${translate}px)`;
                }
                prev.addEventListener('click', () => {
                    index = Math.max(0, index - 1);
                    update();
                });
                next.addEventListener('click', () => {
                    index = (index + 1 > maxIndex()) ? 0 : index + 1;
                    update();
                });
                window.addEventListener('resize', update);
                update();
            });
        })();
    </script>

@endsection
