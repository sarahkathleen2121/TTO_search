@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/moodboard-detail.css') }}">

    <!-- Hero -->
    <section class="mbd-hero">
        <div class="container h-100 d-flex flex-column">
            <div class="mbd-hero-top">
                <div class="mbd-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('moodboards') }}">Bespoke Solutions</a> / <a href="{{ route('moodboards') }}">Moodboards & Ideas</a> / The Orange Blossom</div>
                <div class="mbd-share">Share: <a href="#"><i class="fab fa-facebook-square"></i></a><a href="#"><i
                            class="fab fa-whatsapp-square"></i></a><a href="#"><i class="fab fa-twitter-square"></i></a><a
                        href="#"><i class="fas fa-link"></i></a></div>
            </div>
            
            <div class="mbd-hero-center flex-grow-1 d-flex justify-content-center align-items-center py-5">
                <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="mbd-hero-image" alt="Banner">
            </div>

            <div class="mbd-title-row">
                <h1 class="mbd-title">Sophistication Retro</h1>
                <button class="mbd-fav-btn"><i class="fa-solid fa-heart"></i> Add to Favorites</button>
            </div>
        </div>
    </section>

    <!-- Section A -->
    <section class="mbd-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="mbd-box mbd-square">
                        <div class="mbd-square-wrap">
                            <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Banner">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mbd-text">
                        <h3>Magna hendrerit <br/>hendrerit tempus aliquet.</h3>
                        <p>Separated they live in Bookmarks right at the coast of the famous Semantics, large language ocean
                            Separated they live in Bookmarks right</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section B (second image style) -->
    <section class="mbd-section pt-0">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 order-2 order-lg-1">
                    <div class="mbd-text">
                        <h3>Pharetra diam risus eget condimentum lectus neque <br/> proin tincidunt nec. Egestas.</h3>
                        <p>Separated they live in Bookmarks right at the coast of the famous Semantics, large language ocean
                            Separated they live in Bookmarks right</p>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 d-flex justify-content-lg-end">
                    <div class="mbd-box mbd-circle">
                        <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Banner">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Products Slider (autoplay) -->
    <section class="mbd-products" style="overflow: hidden;">
        <div >
            <h3>Products in this moodboard</h3>
            <div class="mbd-slider-container" style="margin-right: calc(-50vw + 50%); padding-right: calc(50vw - 50%);">
                <div class="swiper mbd-swiper">
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide mbd-prod-card">
                            <div class="mbd-prod-top">
                                <i class="fa-regular fa-bookmark mbd-pin"></i>
                                <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Native Light Chair">
                            </div>
                            <div class="mbd-prod-body">
                                <div class="mbd-prod-name">Native Light Chair</div>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide mbd-prod-card">
                            <div class="mbd-prod-top">
                                <i class="fa-regular fa-bookmark mbd-pin"></i>
                                <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Moss Upholstery Fabric">
                            </div>
                            <div class="mbd-prod-body">
                                <div class="mbd-prod-name">Moss Upholstery Fabric</div>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="swiper-slide mbd-prod-card">
                            <div class="mbd-prod-top">
                                <i class="fa-regular fa-bookmark mbd-pin"></i>
                                <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Moss Upholstery Fabric">
                            </div>
                            <div class="mbd-prod-body">
                                <div class="mbd-prod-name">Moss Upholstery Fabric</div>
                            </div>
                        </div>
                        <!-- Slide 4 -->
                        <div class="swiper-slide mbd-prod-card">
                            <div class="mbd-prod-top">
                                <i class="fa-regular fa-bookmark mbd-pin"></i>
                                <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Moss Upholstery Fabric">
                            </div>
                            <div class="mbd-prod-body">
                                <div class="mbd-prod-name">Moss Upholstery Fabric</div>
                            </div>
                        </div>
                        <!-- Slide 5 -->
                        <div class="swiper-slide mbd-prod-card">
                            <div class="mbd-prod-top">
                                <i class="fa-regular fa-bookmark mbd-pin"></i>
                                <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; height:100%; object-fit:contain; padding:20px;" alt="Moss Upholstery Fabric">
                            </div>
                            <div class="mbd-prod-body">
                                <div class="mbd-prod-name">Moss Upholstery Fabric</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Next Moodboard (third image style) -->
    <section class="mbd-next">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6">
                    <div class="mbd-hero-illus d-flex justify-content-center align-items-center">
                        <img src="{{ asset('frontend_assets/images/banner_img.png') }}" style="width:100%; max-width:180px; height:auto; object-fit:contain;" alt="Banner">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mbd-next-title">Next Moodboard</div>
                    <div class="mbd-next-name">Go Green</div>
                    <button class="mbd-go"><i class="fas fa-arrow-right"></i></button>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new Swiper('.mbd-swiper', {
                slidesPerView: 3.4,
                spaceBetween: 24,
                centeredSlides: false,
                loop: true,
                speed: 800,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                breakpoints: {
                    0: { slidesPerView: 1.3 },
                    576: { slidesPerView: 2.3 },
                    992: { slidesPerView: 3.4 }
                }
            });
        });
    </script>
@endsection
