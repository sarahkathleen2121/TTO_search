@extends('frontend.layouts.master')
@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description)
@section('meta_keywords', $blog->meta_keywords)

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/resource-detail.css') }}">
    <style>
        .rd-badge-custom {
            background: #fff;
            color: #383E42;
            font-size: 10px;
            border-radius: 0;
            border: 1px solid #383E42;
            padding: 4px 8px;
            font-weight: 700;
        }
        .accordion-button:not(.collapsed) {
            color: #383E42 !important;
            background-color: transparent !important;
            box-shadow: none !important;
        }
        .accordion-button:focus {
            box-shadow: none !important;
        }
    </style>
    <!-- Hero -->
    <section class="rd-hero">
      <div class="container">
        
        <div class="rd-breadcrumb mb-4"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('resources') }}">Resources</a> / {{ Str::limit($blog->title, 40) }}</div>
        
        <div class="d-flex align-items-center mb-3 gap-2" style="color: #383E42; font-size: 14px; font-weight: 600;">
            <span style="width: 8px; height: 8px; background: #cddcfb; border-radius: 50%; display: inline-block; margin-right: 5px;"></span>
            {{ $blog->created_at ? $blog->created_at->format('d M Y') : '' }}
        </div>
        
        <div class="row g-4 align-items-end mb-5">
          <div class="col-md-9">
            <h1 class="rd-title">{!! e($blog->title) !!}</h1>
          </div>
          <div class="col-md-3 text-md-end">
            <button class="rd-fav"><i class="fa-regular fa-bookmark me-2"></i> Add to Boards</button>
          </div>
        </div>

        <div class="rd-cover">
            <img src="{{ $blog->featuredImageUrl() ?: 'https://via.placeholder.com/1200x480' }}" alt="{{ $blog->image_alt ?? $blog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        
      </div>
    </section>

    <!-- Article -->
    <section class="py-5">
      <div class="container">
        <div class="row g-5">
          <div class="col-lg-7">
            <div class="rd-content-body" style="color: #383E42; line-height: 1.8; font-size: 14px;">
                {!! $blog->content !!}
            </div>

            @if($blog->faqs && $blog->faqs->isNotEmpty())
            <div class="mt-5 pt-4 border-top">
                <h3 class="mb-4 fw-bold" style="color: #383E42; font-size: 22px;">{{ $blog->faq_title ?: 'Frequently Asked Questions' }}</h3>
                <div class="accordion accordion-flush" id="faqAccordion">
                    @foreach($blog->faqs as $index => $faq)
                        <div class="accordion-item border-bottom mb-3" style="background: transparent; border-top: none; border-left: none; border-right: none;">
                            <h2 class="accordion-header" id="faqHeading{{ $index }}">
                                <button class="accordion-button collapsed fw-bold px-0 py-3" style="background: transparent; color: #383E42; font-size: 16px; box-shadow: none;" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $index }}" aria-expanded="false" aria-controls="faqCollapse{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="faqCollapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="faqHeading{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body px-0 pt-1 pb-3" style="color: #666; font-size: 14px; line-height: 1.7;">
                                    {!! $faq->answer !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
          </div>
          <div class="col-lg-1"></div>
          <div class="col-lg-4">
            <div class="d-flex align-items-center mb-5 pb-3" style="border-top: 1px solid #eef3ff;padding-top:20px;width: max-content;">
                <span class="me-3" style="color:#383E42; font-size:14px;">Share:</span>
                <div class="rd-share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($blog->title . ' - ' . request()->fullUrl()) }}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($blog->title) }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    <a href="javascript:void(0);" onclick="navigator.clipboard.writeText('{{ request()->fullUrl() }}'); alert('Link copied to clipboard!');"><i class="fa fa-link"></i></a>
                </div>
            </div>
            
            @if($relevantBlogs->isNotEmpty())
            <div class="rd-relbox">
              <div class="fw-bold text-primary mb-4" style="font-size: 14px; letter-spacing: 0.5px; text-transform: uppercase;">RELEVANT ARTICLES</div>
              @foreach($relevantBlogs as $rBlog)
              <div class="item">
                  <div class="rd-thumb">
                      <img src="{{ $rBlog->featuredImageUrl() ?: 'https://via.placeholder.com/150x100' }}" alt="{{ $rBlog->image_alt ?? $rBlog->title }}" class="img-fluid" style="object-fit: cover;">
                  </div>
                  <a class="text-primary fw-bold text-decoration-none" href="{{ route('resource.detail', $rBlog->slug) }}">
                      {{ Str::limit($rBlog->title, 50) }}
                  </a>
              </div>
              @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </section>

    <!-- Relevant slider -->
    @if($sliderBlogs->isNotEmpty())
    <section class="rd-relevant">
      <div class="container">
        <div class="d-flex align-items-center justify-content-between">
          <h3 class="rd-rel-title">Relevant</h3>
          <div class="rd-nav">
            <button class="rd-btn" id="rdPrev"><i class="fas fa-chevron-left"></i></button>
            <button class="rd-btn" id="rdNext"><i class="fas fa-chevron-right"></i></button>
          </div>
        </div>
        <div class="rd-s-viewport mt-2" id="rdViewport">
          <div class="rd-s-track" id="rdTrack">
            @foreach($sliderBlogs as $sBlog)
            <div class="rd-card">
                <div class="rd-card-top">
                    <i class="fa-regular fa-bookmark rd-pin"></i>
                    @if($sBlog->categories && $sBlog->categories->isNotEmpty())
                      <div class="position-absolute d-flex flex-wrap gap-1" style="right: 15px; top: 15px; z-index: 5; justify-content: flex-end; max-width: calc(100% - 60px);">
                        @foreach($sBlog->categories as $cat)
                          <span class="rd-badge-custom">{{ $cat->name }}</span>
                        @endforeach
                      </div>
                    @endif
                    <img src="{{ $sBlog->featuredImageUrl() ?: 'https://via.placeholder.com/300x140' }}" alt="{{ $sBlog->image_alt ?? $sBlog->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="rd-card-body">
                    <div class="rd-name">{{ Str::limit($sBlog->title, 40) }}</div>
                    <div class="rd-desc">{{ Str::limit(strip_tags($sBlog->content), 80) }}</div>
                    <a class="rd-link" href="{{ route('resource.detail', $sBlog->slug) }}">Read More <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>

    <script>
      // Relevant slider controls
      (function(){
        const viewport = document.getElementById('rdViewport');
        const track = document.getElementById('rdTrack');
        const prev = document.getElementById('rdPrev');
        const next = document.getElementById('rdNext');
        if (!track || !viewport || !prev || !next) return;
        
        let index = 0;
        function step(){ const first = track.children[0]; const gap = 18; return first ? (first.getBoundingClientRect().width + gap) : 318; }
        function perView(){ return Math.max(1, Math.floor(viewport.clientWidth / step())); }
        function max(){ return Math.max(0, track.children.length - perView()); }
        function update(){ track.style.transform = `translateX(${-index*step()}px)`; }
        prev.addEventListener('click', ()=> { index = Math.max(0, index-1); update(); });
        next.addEventListener('click', ()=> { index = index+1>max()?0:index+1; update(); });
        window.addEventListener('resize', update);
        update();
      })();
    </script>
    @endif
@endsection
