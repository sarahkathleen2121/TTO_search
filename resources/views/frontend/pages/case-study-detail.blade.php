@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/case-study-detail.css') }}">

    <!-- Hero -->
    <section class="cd-hero">
        <div class="container position-relative h-100">
            <!-- Top Right: Tags -->
            <div class="cd-badges">
                <div class="cs-tag-group">
                    <span class="cs-tag-label">Colors</span>
                    <div class="cs-tag-circles">
                        <span class="cs-circle cs-color-circle"></span>
                        <span class="cs-circle cs-color-circle" style="background: #a9c6ff;"></span>
                        <span class="cs-circle cs-color-circle"></span>
                    </div>
                </div>
                <div class="cs-tag-group mt-3">
                    <span class="cs-tag-label">Brands</span>
                    <div class="cs-tag-circles">
                        <span class="cs-circle cs-brand-circle">DIOR</span>
                        <span class="cs-circle cs-brand-circle">CHAUMET</span>
                    </div>
                </div>
            </div>

            <!-- Left Center: Content -->
            <div class="cd-hero-content">
                <div class="cd-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('case.studies') }}">Case Studies</a> / Amet minim mollit non deserunt ullamco es</div>
                <h1 class="cd-title">Amet minim mollit non<br>deserunt ullamco es</h1>
            </div>

            <!-- Bottom Right: Add to Favorites Button -->
            <button class="cd-fav">
                <i class="fa-solid fa-heart me-2" style="color: #383E42;"></i> Add to Favorites
            </button>
        </div>
    </section>

    <!-- Spec + description -->
    <section class="cd-spec">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h4>Specifications</h4>
                    <div class="cd-list">
                        <div class="cd-li">
                            <div class="k">Year</div>
                            <div class="v">2018</div>
                        </div>
                        <div class="cd-li">
                            <div class="k">Brands</div>
                            <div class="v">Dior, Chaumet</div>
                        </div>
                        <div class="cd-li">
                            <div class="k">Type of space</div>
                            <div class="v">Office open-space</div>
                        </div>
                        <div class="cd-li">
                            <div class="k">Location</div>
                            <div class="v">Dubai, UAE</div>
                        </div>
                        <div class="cd-li">
                            <div class="k">Category</div>
                            <div class="v">Real Estate</div>
                        </div>
                        <div class="cd-li">
                            <div class="k">Designer</div>
                            <div class="v">Carl Chroesenberg</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h4 class="text-primary fw-bold">Pretium donec elementum sed dictumst mauris. Turpis vitae sodales nulla
                        nunc, ut egestas pharetra, neque.</h4>
                    <p style="color:#383E42">Accumsan id faucibus sed pretium arcu. Eget viverra id massa, vivamus
                        suspendisse. Suspendisse felis venenatis vivamus dictumst. Enim eget turpis faucibus tellus
                        malesuada cras morbi in accumsan. Posuere velit auctor in nibh sed.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Project USPs with accordion + large image -->
    <section class="included position-relative py-5">
    <div class="visual-box-bg d-none d-lg-block" style="position: absolute; top: 0; right: 0; width: 45vw; height: 100%; background-image: url('{{ asset('frontend_assets/images/linning_image.png') }}'); background-size: cover; background-position: center;"></div>
    <div class="container position-relative" style="z-index: 1;">
      <div class="row g-4">
        <div class="col-lg-6">
          <h2 class="section-title">Project USP’s</h2>
          <p class="muted mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

          <div class="accordion" id="serviceAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header" id="h1">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#c1"
                  aria-expanded="false" aria-controls="c1">
                  Vel leo id eleifend feugia
                </button>
              </h2>
              <div id="c1" class="accordion-collapse collapse" aria-labelledby="h1" data-bs-parent="#serviceAccordion">
                <div class="accordion-body">Detailed explanation for this item. Lorem ipsum dolor sit amet, consectetur
                  adipiscing elit.</div>
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
                <div class="accordion-body">Additional details for the second point. Integer posuere erat a ante.</div>
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
                <div class="accordion-body">Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui.</div>
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
                <div class="accordion-body">This section is expanded by default as in the mockup. Maecenas faucibus
                  mollis interdum.</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="w-100" style="min-height: 420px;"></div>
        </div>
      </div>
    </div>
  </section>

    <!-- Gallery slider -->
    <section class="cd-gallery">
        <h3>Gallery</h3>
        <div id="cdCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators cd-carousel-indicators">
                <button type="button" data-bs-target="#cdCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#cdCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#cdCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#cdCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#cdCarousel" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            
            <!-- Slides -->
            <div class="carousel-inner cd-g-box">
                <div class="carousel-item active">
                    <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="d-block mx-auto img-fluid" alt="Gallery Image" style="max-height: 400px; object-fit: contain;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="d-block mx-auto img-fluid" alt="Gallery Image" style="max-height: 400px; object-fit: contain;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="d-block mx-auto img-fluid" alt="Gallery Image" style="max-height: 400px; object-fit: contain;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="d-block mx-auto img-fluid" alt="Gallery Image" style="max-height: 400px; object-fit: contain;">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="d-block mx-auto img-fluid" alt="Gallery Image" style="max-height: 400px; object-fit: contain;">
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev cd-carousel-nav" type="button" data-bs-target="#cdCarousel" data-bs-slide="prev">
                <i class="fa-light fa-chevron-left"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next cd-carousel-nav" type="button" data-bs-target="#cdCarousel" data-bs-slide="next">
                <i class="fa-light fa-chevron-right"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Products -->
    <section class="cd-products">
        <div class="container">
            <h3>Products part of this Case Study</h3>
            <div class="row g-4 justify-content-center">
                @forelse($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="cd-card">
                        <div class="cd-card-top position-relative">
                                <i class="fa-regular fa-bookmark cd-card-bookmark text-white" style="text-shadow: 0 0 5px rgba(0,0,0,0.3); cursor:pointer;" onclick="addToBasket({{ $product->id }})" title="Add to Enquiry Basket"></i>
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <img src="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : asset('frontend_assets/images/banner_img.png') }}" alt="{{ $product->name }}">
                            </a>
                        </div>
                        <div class="cd-card-body">
                            <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                                <div class="cd-name">{{ $product->name }}</div>
                            </a>
                            <div class="cd-price">$ {{ number_format($product->price) }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h5>No products found.</h5>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-5">
                <button class="btn cd-see-all-btn">See All</button>
            </div>
        </div>
    </section>

    <!-- Next case banner -->
    <section class="cd-next">
        <div class="container">
            <div class="row g-4 align-items-center justify-content-center">
                <div class="col-md-5 text-center text-md-end pe-md-5">
                    <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="img-fluid" alt="Next Case Study Image" style="max-height: 280px; object-fit: contain;">
                </div>
                <div class="col-md-5 text-center text-md-start ps-md-5">
                    <div style="color:var(--primary-color); font-weight:700; font-size: 14px; margin-bottom: 8px;">Next Case Study</div>
                    <div class="nm mb-4">Case Study #5</div>
                    <button class="cd-go"><i class="fa-light fa-arrow-down"></i></button>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('.cd-switch').forEach(sw => sw.addEventListener('click', () => sw.classList.toggle(
            'active')));
    </script>

@endsection
