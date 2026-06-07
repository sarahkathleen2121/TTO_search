@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/service-detail.css') }}">

  <!-- Hero / Breadcrumb -->
  <section class="hero">
    <div class="container">
      <div class="title_bg">
        <div class="breadcrumb-mini"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('services') }}">Services</a> / <a href="{{ route('service.listing') }}">Service Listing</a> / Service Detail Page</div>
        <h1 class="page-title mb-0">Service Detail Page</h1>
      </div>
    </div>
  </section>

  <!-- Service Overview -->
  <section class="overview">
    <div class="container">
      <div class="row g-5 align-items-start">
        <div class="col-lg-6">
          <h2 class="section-title">Service Overview</h2>
          
        </div>
        <div class="col-lg-6">
          <p class="muted">
            Duis netus dignissim eros dui lorem adipiscing. Viverra dui massa arcu adipiscing quis integer habitasse at.
            Facilisis nulla maecenas malesuada pharetra vel quis. Neque facilisi vel eu risus et sed amet. Molestie
            habitasse
            dui sapien venenatis at. At urna egestas elit eu at vulputate in turpis. Ultrices ullamcorper amet iaculis
            urna velit at.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Included in Service -->
  <section class="included position-relative py-5">
    <div class="visual-box-bg d-none d-lg-block" style="position: absolute; top: 0; right: 0; width: 45vw; height: 100%; background-image: url('{{ asset('frontend_assets/images/include_services.png') }}'); background-size: cover; background-position: center; border-top-left-radius: 24px; border-bottom-left-radius: 24px;"></div>
    <div class="container position-relative" style="z-index: 1;">
      <div class="row g-5 align-items-center">
        <div class="col-lg-6">
          <h2 class="section-title">What is included in service</h2>
          <p class="muted mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

          <div class="accordion" id="serviceAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="h1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c1"
                  aria-expanded="false" aria-controls="c1">
                  Vel leo id eleifend feugia
                </button>
              </h2>
              <div id="c1" class="accordion-collapse collapse" aria-labelledby="h1" data-bs-parent="#serviceAccordion">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="h2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c2"
                  aria-expanded="false" aria-controls="c2">
                  Varius scelerisque ac amet
                </button>
              </h2>
              <div id="c2" class="accordion-collapse collapse" aria-labelledby="h2" data-bs-parent="#serviceAccordion">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="h3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c3"
                  aria-expanded="false" aria-controls="c3">
                  Varius tortor maecenas placerat
                </button>
              </h2>
              <div id="c3" class="accordion-collapse collapse" aria-labelledby="h3" data-bs-parent="#serviceAccordion">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="h4">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#c4"
                  aria-expanded="true" aria-controls="c4">
                  Nunc lacus, gravida
                </button>
              </h2>
              <div id="c4" class="accordion-collapse collapse show" aria-labelledby="h4"
                data-bs-parent="#serviceAccordion">
                <div class="accordion-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                  incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="w-100" style="min-height: 450px;"></div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="gallery-section">
    <div class="container">
      <h3 class="gallery-title">Gallery</h3>
    </div>
    <div class="gallery-viewport">
      <div id="galleryTrack" class="gallery-track">
        <div class="gallery-item"><img src="{{ asset('frontend_assets/images/gallery_left_img.png') }}" alt="Left Gallery"></div>
        <div class="gallery-item"><img src="{{ asset('frontend_assets/images/gallery_center_img.png') }}" alt="Center Gallery"></div>
        <div class="gallery-item"><img src="{{ asset('frontend_assets/images/gallery_right_img.png') }}" alt="Right Gallery"></div>
      </div>
    </div>
  </section>
  <!-- <section class="next-service-section py-5 pb-5" style="background-color: #f8fbff;">
    <div class="container mt-3 mb-3">
      <div class="row align-items-center justify-content-center">
        <div class="col-md-5">
          <img src="{{ asset('frontend_assets/images/banner_img.png') }}" alt="Next Service" style="max-width: 250px;">
        </div>
        <div class="col-md-7 ps-md-4 mt-4 mt-md-0 d-flex flex-column align-items-center align-items-md-start">
          <div style="color: #383E42; font-weight: 700; font-size: 14px; margin-bottom: 8px;">Next Service</div>
          <h2 style="color: #383E42; font-weight: 800; font-size: 36px; margin-bottom: 24px;">Service #5</h2>
          <a href="#" class="btn btn-primary rounded-circle d-inline-flex justify-content-center align-items-center text-white" style="width: 48px; height: 48px; background-color: #383E42; border: none; font-size: 18px; text-decoration: none;">
            <i class="fa-solid fa-arrow-down"></i>
          </a>
        </div>
      </div>
    </div>
  </section> -->
  @include('frontend.partials.call_to_action')
   <script>
    (function () {
      const track = document.getElementById('galleryTrack');
      const items = Array.from(track.children);
      let index = 1; // start with center item active

      function update() {
        if(!items[0]) return;
        const itemWidth = items[0].offsetWidth + 50; // width + gap
        const viewportWidth = track.parentElement.getBoundingClientRect().width;
        const centerOffset = (viewportWidth / 2) - (itemWidth / 2);
        const translate = -index * itemWidth + centerOffset;
        track.style.transform = `translateX(${translate}px)`;
        items.forEach((el, i) => el.classList.toggle('active', i === index));
      }

      window.addEventListener('resize', update);
      // initialize
      setTimeout(update, 100); // Small delay to ensure styles are applied
    })();
  </script>
    @endsection
