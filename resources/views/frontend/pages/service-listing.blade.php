@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/service-listing.css') }}">

  <!-- Hero / Breadcrumb -->
  <section class="hero-bar">
    <div class="container">
      <div class="title_bg">
        <div class="breadcrumb-mini"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('services') }}">Services</a> / Service Listing</div>
        <h1 class="page-title mb-0">Service Listing</h1>
      </div>
    </div>
  </section>

  <!-- Filters Row -->
  <div class="container">
    <div class="d-flex flex-wrap filters-wrap">
      <div class="dropdown">
        <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          By Type
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Consulting</a></li>
          <li><a class="dropdown-item" href="#">Installation</a></li>
          <li><a class="dropdown-item" href="#">Maintenance</a></li>
        </ul>
      </div>
      <div class="dropdown">
        <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          By Space
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Office</a></li>
          <li><a class="dropdown-item" href="#">Hospitality</a></li>
          <li><a class="dropdown-item" href="#">Education</a></li>
        </ul>
      </div>
      <div class="dropdown">
        <button class="btn filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          By Size
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Small</a></li>
          <li><a class="dropdown-item" href="#">Medium</a></li>
          <li><a class="dropdown-item" href="#">Large</a></li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Services List -->
  <div class="container mt-2">
    <!-- Card 1 -->
    <div class="service-card">
      <div class="row g-3 align-items-start">
        <div class="col-md-3">
          <div class="service-title">Service #1</div>
        </div>
        <div class="col-md-7">
          <div class="service-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat Lorem ipsum dolor sit amet...</div>
          <a class="service-link" href="#">Explore <i class="fa-solid fa-angle-right ms-1"></i></a>
        </div>
      </div>
    </div>
    <!-- Card 2 -->
    <div class="service-card">
      <div class="row g-3 align-items-start">
        <div class="col-md-3">
          <div class="service-title">Service #2</div>
        </div>
        <div class="col-md-7">
          <div class="service-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat...</div>
          <a class="service-link" href="#">Explore <i class="fa-solid fa-angle-right ms-1"></i></a>
        </div>
      </div>
    </div>
    <!-- Card 3 -->
    <div class="service-card">
      <div class="row g-3 align-items-start">
        <div class="col-md-3">
          <div class="service-title">Service #3</div>
        </div>
        <div class="col-md-7">
          <div class="service-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat...</div>
          <a class="service-link" href="#">Explore <i class="fa-solid fa-angle-right ms-1"></i></a>
        </div>
      </div>
    </div>
    <div class="service-card">
      <div class="row g-3 align-items-start">
        <div class="col-md-3">
          <div class="service-title">Service #4</div>
        </div>
        <div class="col-md-7">
          <div class="service-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat...</div>
          <a class="service-link" href="#">Explore <i class="fa-solid fa-angle-right ms-1"></i></a>
        </div>
      </div>
    </div>
    <div class="service-card">
      <div class="row g-3 align-items-start">
        <div class="col-md-3">
          <div class="service-title">Service #5</div>
        </div>
        <div class="col-md-7">
          <div class="service-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
            laboris nisi ut aliquip ex ea commodo consequat...</div>
          <a class="service-link" href="#">Explore <i class="fa-solid fa-angle-right ms-1"></i></a>
        </div>
      </div>
    </div>
    <div class="page-spacer"></div>
  </div>
    @include('frontend.partials.call_to_action')

    @endsection
