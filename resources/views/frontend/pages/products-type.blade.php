@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/products-type.css') }}">

  <!-- Hero with static content -->
  <section class="pt-hero">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="pt-breadcrumb"><a href="{{ route('home') }}">Home</a> / Products</div>
          <h1 class="pt-title">What product type<br>do you need?</h1>
        </div>
        <div class="col-lg-8">
          <div class="pt-breakout">
            <!-- Boxes slider (with background images and overlays) -->
            <div class="pt-box-viewport">
              <div class="pt-box-track" id="ptBoxTrack">
                <a href="{{ route('all.products') }}" class="pt-box">
                  <img src="{{ asset('frontend_assets/images/view_all.png') }}" class="pt-box-bg" alt="View All">
                  <div class="pt-box-overlay"></div>
                  <span>View All</span>
                </a>
                @foreach($productTypes as $type)
                @php
                    $imageMap = [
                        'furniture' => 'product_type.png',
                        'acustic-products' => 'acoustic_product.png',
                        'writable-surfaces' => 'writable.png',
                        'fabrics' => 'fabrics.png',
                        'greenwalls' => 'greenwalls.png',
                    ];
                    $imageName = $imageMap[$type->slug] ?? 'view_all.png';
                @endphp
                <a href="{{ route('product_type.detail', $type->slug) }}" class="pt-box">
                  <img src="{{ asset('frontend_assets/images/' . $imageName) }}" class="pt-box-bg" alt="{{ $type->name }}">
                  <div class="pt-box-overlay"></div>
                  <span>{{ $type->name }}</span>
                </a>
                @endforeach
              </div>
              <!-- Only next button needed as per design -->
              <button class="pt-next" id="ptNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Industry Products Section -->
  <section class="pt-industry">
    <div class="container">
      <h2 class="pt-industry-title">Explore our products<br>based on Industry</h2>
      
      <div class="pt-industry-list">
        @foreach($industries as $industry)
          <div class="pt-industry-card">
            <div class="row align-items-center">
              <div class="col-md-3">
                <h3 class="pt-industry-name">{{ $industry->name }}</h3>
              </div>
              <div class="col-md-9 pt-industry-content">
                <p>Explore products crafted for the {{ $industry->name }} sector, with tailored solutions and design-led expertise.</p>
                <a href="{{ route('industry.detail', $industry->slug) }}" class="pt-industry-link">Explore <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Brands section -->
  <section class="pt-brands">
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
      <h2 class="pt-industry-title mb-2">Brands</h2>
      <p class="mb-4 pt-brand-desc">Separated they live in Bookmarks right at the coast of the famous Semantics, large language ocean Separated they live in Bookmarks right </p>

        </div>
      </div>
      <div class="pt-brand-grid mt-5">
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/adreu-world.png') }}" alt="Andreu World" /></div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/studio-tk.png') }}" alt="studio tk" /></div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/arper.png') }}" alt="arper" /></div>
        <div class="pt-brand-item text-brand">Manerba</div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/luum.png') }}" alt="LUUM" /></div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/boss.png') }}" alt="boss" /></div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/emmegi.png') }}" alt="emmegi" /></div>
        <div class="pt-brand-item text-brand" style="font-size: 40px; font-style: italic;">wi</div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/kong-nelrah.png') }}" alt="KÖNIG + NEURATH" /></div>
        <div class="pt-brand-item"><img src="{{ asset('frontend_assets/images/peadrali.png') }}" alt="PEDRALI" /></div>
      </div>
      
      <div class="pt-dots">
        <div class="pt-dot"></div>
        <div class="pt-dot"></div>
        <div class="pt-dot active"></div>
        <div class="pt-dot"></div>
        <div class="pt-dot"></div>
      </div>
    </div>
  </section>

  <script>
    // Boxes slider (text only, manual)
    (function () {
      const track = document.getElementById('ptBoxTrack');
      const next = document.getElementById('ptNext');
      let offset = 0;
      function itemStep() {
        const first = track.children[0];
        const gap = 20; // set in CSS
        return first.getBoundingClientRect().width + gap;
      }
      function slide(dir) {
        offset += dir * itemStep();
        const max = Math.max(0, track.scrollWidth - track.clientWidth);
        if (offset < 0) offset = 0; if (offset > max) offset = max;
        track.scrollTo({ left: offset, behavior: 'smooth' });
      }
      if(next) next.addEventListener('click', () => slide(1));
      window.addEventListener('resize', () => { offset = track.scrollLeft; });
    })();
  </script>
    @endsection
