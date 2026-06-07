@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/initiatives.css') }}?v={{ time() }}">
    <!-- Header/Hero -->
    <div class="in-hero-bg">
        <section class="in-nav">
            <div class="container">
                <div class="in-breadcrumb"><a href="{{ route('home') }}">Home</a> / Initiatives</div>
                <h1 class="in-title">Initiatives</h1>
            </div>
        </section>
    </div>

    <!-- Content -->
    <div class="container py-5">
        <div class="in-wrap">
            <div class="in-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <h4 class="in-card-title">CSR</h4>
                    </div>
                    <div class="col-md-9">
                        <p class="in-card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Lorem ipsum dolor sit amet...</p>
                        <a href="{{ route('csr') }}" class="in-link">Explore <span class="ms-1">›</span></a>
                    </div>
                </div>
            </div>

            <div class="in-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <h4 class="in-card-title">Sustainaibility</h4>
                    </div>
                    <div class="col-md-9">
                        <p class="in-card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Lorem ipsum dolor sit amet...</p>
                        <a href="{{ route('sustainability') }}" class="in-link">Explore <span class="ms-1">›</span></a>
                    </div>
                </div>
            </div>
            <div class="in-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <h4 class="in-card-title">ESG</h4>
                    </div>
                    <div class="col-md-9">
                        <p class="in-card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Lorem ipsum dolor sit amet...</p>
                        <a href="{{ route('esg') }}" class="in-link">Explore <span class="ms-1">›</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
