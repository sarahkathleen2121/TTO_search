@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/moodboards.css') }}?v={{ time() }}">
    <!-- Hero -->
    <section class="mb-hero">
        <div class="container">
            <div class="mb-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('moodboards') }}">Bespoke Solutions</a> / Moodboards</div>
            <h1 class="mb-title mb-0">Moodboards</h1>
        </div>
    </section>

    <div class="container">
        <!-- Filters -->
        <div class="mb-filters">
            <div class="dropdown">
                <button class="btn mb-filter-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">
                    <span>By Space</span>
                    <i class="fa-solid fa-chevron-down ms-2" style="font-size: 11px;"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Office</a></li>
                    <li><a class="dropdown-item" href="#">Hospitality</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn mb-filter-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">
                    <span>By Color</span>
                    <i class="fa-solid fa-chevron-down ms-2" style="font-size: 11px;"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Blue</a></li>
                    <li><a class="dropdown-item" href="#">Neutral</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn mb-filter-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">
                    <span>By Brand</span>
                    <i class="fa-solid fa-chevron-down ms-2" style="font-size: 11px;"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Brand A</a></li>
                    <li><a class="dropdown-item" href="#">Brand B</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn mb-filter-btn dropdown-toggle" data-bs-toggle="dropdown" type="button">
                    <span>By Product Type</span>
                    <i class="fa-solid fa-chevron-down ms-2" style="font-size: 11px;"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Furniture</a></li>
                    <li><a class="dropdown-item" href="#">Fabric</a></li>
                </ul>
            </div>
        </div>

        <!-- Cards grid -->
        <div class="mb-grid">
            @foreach($moodboards as $index => $moodboard)
            <div class="mb-card" onclick="window.location.href='{{ route('moodboard.detail') }}'" style="cursor: pointer;">
                <div class="mb-card-top">
                    @if($index === 0)
                        <i class="fa-solid fa-heart mb-pin"></i>
                    @else
                        <i class="fa-regular fa-bookmark mb-pin"></i>
                    @endif
                    @if($moodboard->image)
                        <img src="{{ $moodboard->imageUrl() }}" alt="{{ $moodboard->title }}">
                    @endif
                </div>
                <div class="mb-card-body">
                    <h4 class="mb-card-title">{{ $moodboard->title }}</h4>
                    <div class="mb-card-desc">{{ $moodboard->description }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>




@endsection
