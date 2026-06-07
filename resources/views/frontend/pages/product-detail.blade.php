@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/product-detail.css') }}?v={{ time() }}">

    @php
        $bgImage = ($product && $product->thumbnail) ? asset('storage/' . $product->thumbnail) : asset('frontend_assets/images/banner_img.png');
    @endphp

    <!-- Hero -->
    <section class="pd-hero" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('{{ $bgImage }}');">
        <div class="container h-100 d-flex flex-column justify-content-between">
            <div class="pd-hero-top">
                <div class="pd-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('products.type') }}">Products</a> / {{ $product ? $product->name : 'Moss upholstery fabric' }}</div>
                <div class="pd-share">
                    <span class="share-label">Share:</span>
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fas fa-link"></i></a>
                </div>
            </div>
            <div class="pd-hero-center">
                <h1 class="pd-title">{{ $product ? $product->name : 'Moss Upholstery Fabric' }}</h1>
            </div>
            <div class="pd-cta-wrap">
                <button class="pd-btn primary" onclick="addToBasket({{ $product ? $product->id : 0 }})">Add to Enquiry Basket</button>
                <button class="pd-btn outline"><i class="fa-solid fa-heart me-1"></i> Add to Favorites</button>
            </div>
        </div>
    </section>

    <!-- Visual section (two boxes) -->
    <section class="py-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="pd-visual-illus">
                        <img src="{{ asset('frontend_assets/images/product_1.png') }}" alt="Product Image" class="pd-visual-img">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pd-visual-illus">
                        <img src="{{ asset('frontend_assets/images/product_2.png') }}" alt="Product Image" class="pd-visual-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Specification with Tabs -->
    <section class="pd-spec">
        <div class="container">
            <h2>Specification</h2>
            <ul class="nav nav-pills justify-content-center pd-tabs" id="specTabs" role="tablist">
                <li class="nav-item" role="presentation"><button class="nav-link active" data-bs-toggle="pill"
                        data-bs-target="#pinfo" type="button">Product Information</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                        data-bs-target="#materials" type="button">Materials</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                        data-bs-target="#assets" type="button">Assets</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                        data-bs-target="#care" type="button">Care Instructions</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                        data-bs-target="#assembly" type="button">Assembly Instructions</button></li>
                <li class="nav-item" role="presentation"><button class="nav-link" data-bs-toggle="pill"
                        data-bs-target="#sustain" type="button">Sustainability</button></li>
            </ul>
            <div class="tab-content mt-4">
                <div class="tab-pane fade show active" id="pinfo">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <div class="fw-bold text-primary mb-2">Description</div>
                            <p class="muted">{{ $product && $product->description ? strip_tags($product->description) : 'Product description not available.' }}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="materials">Materials tab content...</div>
                <div class="tab-pane fade" id="assets">Assets tab content...</div>
                <div class="tab-pane fade" id="care">Care instructions...</div>
                <div class="tab-pane fade" id="assembly">Assembly instructions...</div>
                <div class="tab-pane fade" id="sustain">Sustainability details...</div>
            </div>
        </div>
    </section>

    <!-- Product USP style block -->
    <section class="pd-usp">
        <div class="container">
            <div class="row g-5 align-items-start">
                <div class="col-md-5">
                    <h3 class="pd-usp-title">Product USP</h3>
                </div>
                <div class="col-md-7">
                    <div class="fw-bold text-primary mb-2">Short headline</div>
                    <p class="pd-usp-desc">Acme automates your subscription revenue and customer reporting. Just
                        connect your data and Acme will calculate and visualize your most
                        important metrics.</p>
                    <div class="fw-bold text-primary mb-2 mt-4">Start by checking your upgrade</div>
                    <p class="pd-usp-desc">Change the color to match your brand or vision, add your logo,
                        choose the perfect thumbnail, remove the playbar, add speed controls,
                        and more. Increase engagement with CTAs and custom end screens,
                        or keep your video private and password-protected.</p>
                </div>
            </div>
            <!-- <div class="row g-4 mt-4">
                <div class="col-md-6">
                    <div class="pd-illus">
                        <img src="{{ asset('frontend_assets/images/linning_image.png') }}" alt="USP Image" class="pd-illus-img">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pd-illus">
                        <img src="{{ asset('frontend_assets/images/linning_image.png') }}" alt="USP Image" class="pd-illus-img">
                    </div>
                </div>
            </div> -->
        </div>
    </section>

    <!-- Sustainability icon cards -->
    <section class="pd-sustain-cards">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-md-6">
                    <div class="pd-sustain-card">
                        <div class="pd-sustain-card-img-wrap">
                            <img src="{{ asset('frontend_assets/images/project_1.png') }}" alt="Sustainable" class="pd-sustain-card-img">
                        </div>
                        <div class="pd-sustain-card-body">
                            <img src="{{ asset('frontend_assets/images/sustainabillity.png') }}" alt="Sustainable" class="pd-sustain-card-icon">
                            <div class="pd-sustain-card-title">Sustainable</div>
                            <p class="pd-sustain-card-desc">Our products a made form 100% recycled material.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="pd-sustain-card">
                        <div class="pd-sustain-card-img-wrap">
                            <img src="{{ asset('frontend_assets/images/project_2.png') }}" alt="Low Waste" class="pd-sustain-card-img">
                        </div>
                        <div class="pd-sustain-card-body">
                            <img src="{{ asset('frontend_assets/images/low_waste.png') }}" alt="Low Waste" class="pd-sustain-card-icon">
                            <div class="pd-sustain-card-title">Low Waste</div>
                            <p class="pd-sustain-card-desc">Our goal is to have zero carbon footprint by 2030.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sustainability section -->
    <section class="pd-sustain">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h3 class="pd-sustain-title">Sustainability</h3>
                    <p class="pd-sustain-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam.</p>
                    <div class="pd-sustain-features">
                        <div class="pd-sustain-feat">
                            <img src="{{ asset('frontend_assets/images/recycles.png') }}" alt="Recycles" class="pd-sustain-feat-icon">
                            <p>Our products a made from 100% recycled material.</p>
                        </div>
                        <div class="pd-sustain-feat">
                            <img src="{{ asset('frontend_assets/images/sustainabillity.png') }}" alt="Sustainable" class="pd-sustain-feat-icon">
                            <p>Our goal is to have zero carbon footprint by 2030.</p>
                        </div>
                        <div class="pd-sustain-feat">
                            <img src="{{ asset('frontend_assets/images/low_waste.png') }}" alt="Low Waste" class="pd-sustain-feat-icon">
                            <p>All our products made with sustainability in mind.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="pd-sustain-side-wrap">
                        <img src="{{ asset('frontend_assets/images/sustainability_side.png') }}" alt="Sustainability" class="pd-sustain-side-img">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery section -->
    <section class="pd-gallery">
        <h3 class="pd-gallery-title">Gallery</h3>
        <div class="pd-gallery-viewport">
            <div class="pd-gallery-track">
                <div class="pd-gallery-slide side">
                    <img src="{{ asset('frontend_assets/images/product_left.png') }}" alt="Gallery Left">
                    <div class="pd-gallery-overlay"></div>
                </div>
                <div class="pd-gallery-slide center">
                    <img src="{{ asset('frontend_assets/images/product_center.png') }}" alt="Gallery Center">
                </div>
                <div class="pd-gallery-slide side">
                    <img src="{{ asset('frontend_assets/images/product_right.png') }}" alt="Gallery Right">
                    <div class="pd-gallery-overlay"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paired products + banner + next -->
    <section class="pd-paired">
        <div class="container">
            <h3 class="pd-paired-title">Can be paired with</h3>
            <div class="row g-4">
                @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                    @foreach($relatedProducts as $related)
                    <div class="col-md-6 col-lg-4">
                        <div class="pd-card">
                            <div class="pd-card-top position-relative">
                                <i class="fa-regular fa-bookmark pd-card-fav text-white" style="text-shadow: 0 0 5px rgba(0,0,0,0.3); cursor:pointer;" onclick="addToBasket({{ $related->id }})" title="Add to Enquiry Basket"></i>
                                <a href="{{ route('product.detail', $related->slug) }}">
                                    <img src="{{ $related->thumbnail ? asset('storage/'.$related->thumbnail) : asset('frontend_assets/images/banner_img.png') }}" class="pd-card-img" alt="{{ $related->name }}">
                                </a>
                            </div>
                            <div class="pd-card-body px-0">
                                <a href="{{ route('product.detail', $related->slug) }}" class="text-decoration-none text-dark">
                                    <div class="pd-card-name">{{ $related->name }}</div>
                                </a>
                                <div class="pd-card-brand">{{ $related->brand ? $related->brand->name : 'Manufacturer Brand' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12"><p class="text-muted">No related products found.</p></div>
                @endif
            </div>
            
            <div class="pd-banner">
                <div class="pd-banner-text">The Ideal workspace<br /><span >Our six step unique process</span></div>
                <button class="pd-btn primary">Explore More</button>
            </div>
        </div>
    </section>
    <!-- Next section -->
    <section class="pd-next-section">
        <h3 class="pd-next-heading">Next</h3>
        <div class="pd-next">
            <div class="row g-0">
                <div class="col-md-4">
                    <div class="pd-next-tile" style="background-image: url('{{ asset('frontend_assets/images/next_1.png') }}');">
                        <div class="pd-next-tile-text">Paola Wood<br>Chair</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pd-next-tile" style="background-image: url('{{ asset('frontend_assets/images/next_2.png') }}');">
                        <div class="pd-next-tile-text">Native White<br>Chair</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pd-next-tile" style="background-image: url('{{ asset('frontend_assets/images/next_3.png') }}');">
                        <div class="pd-next-tile-text">Studio<br>Acoustics</div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @endsection
