@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/sustainability.css') }}?v={{ time() }}">

    <!-- Hero Section (Left-Edge layout) -->
    <section class="su-hero-wrapper">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-center">
                <!-- Left side: Image (touches left edge) -->
                <div class="col-lg-6">
                    <div class="su-img-container">
                        <img src="{{ asset('frontend_assets/images/sustainability_hero.png') }}" class="su-img" alt="Sustainability">
                    </div>
                </div>
                <!-- Right side: Content -->
                <div class="col-lg-6">
                    <div class="su-content-container">
                        <div class="su-breadcrumb"><a href="{{ route('home') }}">Home</a> / Sustainability</div>
                        <h1 class="su-title">Sustainability</h1>
                        <p class="su-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="su-intro">
        <div class="container">
            <h3 class="su-intro-title">Introduction</h3>
            <div class="row mt-4 g-4 align-items-start">
                <div class="col-md-6">
                    <p class="su-intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
                <div class="col-md-6">
                    <p class="su-intro-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Accomplishments list -->
    <section class="su-acc">
        <div class="container">
            <h3>Accomplishments</h3>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">01</div>
                <div class="col-10 col-md-3 su-name">Human Kind</div>
                <div class="col-12 col-md-8 su-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
            </div>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">02</div>
                <div class="col-10 col-md-3 su-name">Innovation</div>
                <div class="col-12 col-md-8 su-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
            </div>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">03</div>
                <div class="col-10 col-md-3 su-name">Reliable</div>
                <div class="col-12 col-md-8 su-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
            </div>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">04</div>
                <div class="col-10 col-md-3 su-name">Collaborate</div>
                <div class="col-12 col-md-8 su-desc">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
            </div>
        </div>
    </section>

@endsection
