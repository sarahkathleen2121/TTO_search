@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/shop-by-space.css') }}?v={{ time() }}">

    <section class="sp-hero">
        <div class="container">
            <div class="row align-items-center">
                <!-- Left side title & breadcrumb -->
                <div class="col-lg-4">
                    <div class="sp-breadcrumb">
                        <a href="{{ route('home') }}">Home</a> / 
                        @if($type === 'brand')
                            Shop by Brand
                        @else
                            Shop by Space
                        @endif
                    </div>
                    <h1 class="sp-title">
                        @if($type === 'brand')
                            Products for what type of <br/>brand do you need?
                        @else
                            Products for what type of <br/>space do you need?
                        @endif
                    </h1>
                </div>
                
                <!-- Right side slider cards -->
                <div class="col-lg-8">
                    <div class="sp-breakout">
                        <div class="sp-box-viewport">
                            <div class="sp-box-track" id="spBoxTrack">
                                <a href="{{ route('all.products') }}" class="sp-box">
                                    <img src="{{ asset('frontend_assets/images/view_all.png') }}" class="sp-box-bg" alt="View All">
                                    <div class="sp-box-overlay"></div>
                                    <span>View All</span>
                                </a>
                                @foreach($productTypes as $pType)
                                @php
                                    $imageMap = [
                                        'furniture' => 'product_type.png',
                                        'acustic-products' => 'acoustic_product.png',
                                        'writable-surfaces' => 'writable.png',
                                        'fabrics' => 'fabrics.png',
                                        'greenwalls' => 'greenwalls.png',
                                    ];
                                    $imageName = $imageMap[$pType->slug] ?? 'view_all.png';
                                @endphp
                                <a href="{{ route('all.products', ['product_type' => $pType->slug]) }}" class="sp-box">
                                    <img src="{{ asset('frontend_assets/images/' . $imageName) }}" class="sp-box-bg" alt="{{ $pType->name }}">
                                    <div class="sp-box-overlay"></div>
                                    <span>{{ $pType->name }}</span>
                                </a>
                                @endforeach
                            </div>
                            <button class="sp-next" id="spNext" aria-label="Next"><i class="fas fa-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main>
      <div class="container">
        <div class="sp-wrap">
          @forelse($items as $item)
            @php
                $bgImage = asset('frontend_assets/images/conference_room.png');
                if ($type === 'brand') {
                    if (!empty($item->bg_image)) {
                        $bgImage = asset('storage/' . $item->bg_image);
                    } elseif (!empty($item->image)) {
                        $bgImage = asset('storage/' . $item->image);
                    } else {
                        $images = [
                            asset('frontend_assets/images/conference_room.png'),
                            asset('frontend_assets/images/offie_cabins.png'),
                            asset('frontend_assets/images/work_space.png'),
                            asset('frontend_assets/images/cafe_space.png')
                        ];
                        $bgImage = $images[$loop->index % 4];
                    }
                } else {
                    $slug = strtolower($item->slug);
                    if (str_contains($slug, 'conference')) {
                        $bgImage = asset('frontend_assets/images/conference_room.png');
                    } elseif (str_contains($slug, 'cabin') || str_contains($slug, 'office')) {
                        $bgImage = asset('frontend_assets/images/offie_cabins.png');
                    } elseif (str_contains($slug, 'workspace') || str_contains($slug, 'work')) {
                        $bgImage = asset('frontend_assets/images/work_space.png');
                    } elseif (str_contains($slug, 'cafe') || str_contains($slug, 'cafeteria')) {
                        $bgImage = asset('frontend_assets/images/cafe_space.png');
                    } else {
                        $images = [
                            asset('frontend_assets/images/conference_room.png'),
                            asset('frontend_assets/images/offie_cabins.png'),
                            asset('frontend_assets/images/work_space.png'),
                            asset('frontend_assets/images/cafe_space.png')
                        ];
                        $bgImage = $images[$loop->index % 4];
                    }
                }

                if ($type === 'brand') {
                    $exploreLink = route('brand.detail', $item->slug);
                } else {
                    $exploreLink = route('space.detail', $item->slug);
                }
            @endphp
            <div class="sp-card" style="background-image: url('{{ $bgImage }}');">
                <div class="sp-card-overlay"></div>
                <div class="sp-card-content">
                    <h4>{{ $item->name }}</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisl diam lectus sagittis, massa aliquam commodo.</p>
                    <a class="sp-link" href="{{ $exploreLink }}">Explore Products <i class="fas fa-chevron-right ms-1"></i></a>
                </div>
            </div>
          @empty
          <div class="col-12 text-center py-5 w-100">
              <h5>No items found.</h5>
          </div>
          @endforelse
        </div>
      </div>
    </main>

    <script>
      (function() {
          const nextBtn = document.getElementById('spNext');
          const track = document.getElementById('spBoxTrack');
          
          if (nextBtn && track) {
              nextBtn.addEventListener('click', () => {
                  const card = track.querySelector('.sp-box');
                  if (card) {
                      const scrollAmt = card.offsetWidth + 20; // width + gap
                      track.scrollBy({ left: scrollAmt, behavior: 'smooth' });
                  }
              });
          }
      })();
    </script>
    @endsection
