@extends('frontend.layouts.master')

@section('title', $industry->name . ' - The Total Office')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/hospitality.css') }}?v={{ time() }}">
    <style>
        .hp-breadcrumb a {
            text-decoration: none;
            color: inherit;
        }
        .hp-breadcrumb a:hover {
            text-decoration: none;
            color: inherit;
            opacity: 0.8;
        }
    </style>

    <!-- 1) Hero -->
    <section class="hp-hero">
        <div class="container">
            <div class="hp-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('shop.by.industry') }}">Shop By Industry</a> / {{ $industry->name }}</div>
            <h1 class="hp-hero-title">{{ $industry->name }}</h1>
            <p class="hp-hero-sub">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia.</p>
        </div>
    </section>

    <!-- 2) Intro + Benefits -->
    <section class="hp-intro">
        <div class="container">
            <div class="row g-5 align-items-start mb-4">
                <div class="col-lg-6">
                    <div class="hp-kicker">Intro</div>
                    <h2 class="hp-intro-title mb-2">Arcu neque risus<br>porta ultricies auctor<br>lacus.</h2>
                    <p class="hp-intro-desc">Experience a new standard of productivity and workspace harmony with our premium collections designed specifically for {{ $industry->name }}. We blend functionality with world-class design to create outstanding work and service spaces.</p>
                    <button class="hp-btn" onclick="window.location.href='{{ route('industry.categories', $industry->slug) }}'">See All Products</button>
                </div>
                <div class="col-lg-6">
                    <p class="hp-intro-desc hp-intro-right">Explore how our customized options for {{ $industry->name }} seamlessly integrate aesthetic sophistication and ergonomic excellence, promoting wellness, collaboration, and ultimate comfort in every space.</p>
                </div>
            </div>

            <div class="hp-benefits">
                <div class="row g-4 hp-benefits-row">
                    <div class="col-12 col-md-8 col-lg-6 mb-4">
                        <h3 class="hp-benefits-title">Benefits</h3>
                        <p class="hp-benefits-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
                <!-- Features Grid -->
                <div class="row g-4 hp-features-grid mt-2">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="hp-feature">
                            <img src="{{ asset('frontend_assets/images/feature-one.png') }}" class="hp-feature-icon" alt="Feature one" />
                            <div>
                                <h6>Feature one</h6>
                                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="hp-feature">
                            <img src="{{ asset('frontend_assets/images/feature-two.png') }}" class="hp-feature-icon" alt="Feature two" />
                            <div>
                                <h6>Feature two</h6>
                                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="hp-feature">
                            <img src="{{ asset('frontend_assets/images/feature-three.png') }}" class="hp-feature-icon" alt="Feature three" />
                            <div>
                                <h6>Feature three</h6>
                                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="hp-feature">
                            <img src="{{ asset('frontend_assets/images/feature-four.png') }}" class="hp-feature-icon" alt="Feature four" />
                            <div>
                                <h6>Feature four</h6>
                                <p>Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3) Brands -->
    <section class="hp-brands">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <h2 class="pt-industry-title mb-2">Brands</h2>
                    <p class="mb-4 pt-brand-desc">Explore the premium international furniture brands that we partner with to craft beautiful workspaces for the {{ $industry->name }} industry.</p>
                </div>
            </div>
            <div class="hp-brand-grid">
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/adreu-world.png') }}" alt="Andreu World" /></div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/studio-tk.png') }}" alt="studio tk" /></div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/arper.png') }}" alt="arper" /></div>
                <div class="hp-brand-item text-brand">Manerba</div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/luum.png') }}" alt="LUUM" /></div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/boss.png') }}" alt="boss" /></div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/emmegi.png') }}" alt="emmegi" /></div>
                <div class="hp-brand-item text-brand" style="font-size: 40px; font-style: italic;">wi</div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/kong-nelrah.png') }}" alt="KÖNIG + NEURATH" /></div>
                <div class="hp-brand-item"><img src="{{ asset('frontend_assets/images/peadrali.png') }}" alt="PEDRALI" /></div>
            </div>
            
            <div class="hp-dots">
                <div class="hp-dot"></div>
                <div class="hp-dot"></div>
                <div class="hp-dot active"></div>
                <div class="hp-dot"></div>
                <div class="hp-dot"></div>
            </div>
        </div>
    </section>

    <!-- 4) Examples slider -->
    <section class="hp-examples" style="overflow-x: hidden;">
        <div class="container">
            <h3 class="hp-examples-title">Examples</h3>
            <p class="hp-examples-desc">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint.<br>Velit officia consequat duis enim velit mollit. Exercitation veniam<br>consequat sunt nostrud amet.</p>
        </div>
        <div class="hp-ex-viewport mt-5">
            <button class="hp-ex-btn prev" id="hpExPrev"><i class="fas fa-chevron-left"></i></button>
            <div class="hp-ex-track" id="hpExTrack">
                <div class="hp-ex-card">
                    <img src="{{ asset('frontend_assets/images/expample_left.png') }}" class="hp-ex-img" alt="Example Left">
                    <div class="hp-ex-overlay"></div>
                </div>
                <div class="hp-ex-card">
                    <img src="{{ asset('frontend_assets/images/example_center.png') }}" class="hp-ex-img" alt="Example Center">
                    <div class="hp-ex-overlay"></div>
                </div>
                <div class="hp-ex-card">
                    <img src="{{ asset('frontend_assets/images/example_right.png') }}" class="hp-ex-img" alt="Example Right">
                    <div class="hp-ex-overlay"></div>
                </div>
            </div>
            <button class="hp-ex-btn next" id="hpExNext"><i class="fas fa-chevron-right"></i></button>
        </div>
    </section>

    <!-- 5) Related products -->
    <section class="hp-related">
        <div class="container">
            <h3 class="hp-related-title">Products for {{ $industry->name }}</h3>
            <div class="row g-4 hp-related-grid">
                @forelse($products as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="hp-prod">
                        <div class="hp-prod-top position-relative">
                            <i class="fa-regular fa-bookmark hp-prod-bookmark text-white" style="text-shadow: 0 0 5px rgba(0,0,0,0.3); cursor:pointer; z-index: 10;" onclick="addToBasket({{ $product->id }})" title="Add to Enquiry Basket"></i>
                            <img src="{{ $product->thumbnail ? asset('storage/'.$product->thumbnail) : asset('frontend_assets/images/banner_img.png') }}" class="hp-prod-img" alt="{{ $product->name }}">
                            <a href="{{ route('product.detail', $product->slug) }}" class="hp-prod-link-overlay"></a>
                        </div>
                        <div class="hp-prod-body">
                            <a href="{{ route('product.detail', $product->slug) }}" class="text-decoration-none text-dark">
                                <div class="hp-prod-name">{{ $product->name }}</div>
                            </a>
                            <div class="hp-prod-price">$ {{ number_format($product->price) }}</div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h5>No related products found.</h5>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-5"><button class="hp-btn" onclick="window.location.href='{{ route('industry.categories', $industry->slug) }}'">See All</button></div>
        </div>
    </section>

    <!-- 6) CTA banner -->
    @if($nextIndustry)
    <section class="hp-cta">
        <div class="container">
            <h3>{{ $nextIndustry->name }}</h3>
            <p>Discover innovative furniture and workspace design solutions tailored for the {{ $nextIndustry->name }} industry.</p>
            <button class="hp-btn" onclick="window.location.href='{{ route('industry.detail', $nextIndustry->slug) }}'">Explore Now</button>
        </div>
    </section>
    @endif
    <script>
        // Examples slider
        (function() {
            const track = document.getElementById('hpExTrack');
            const prev = document.getElementById('hpExPrev');
            const next = document.getElementById('hpExNext');
            const cards = track.children;
            let i = 1; // Center card (index 1) active on load

            function updateCenter() {
                if(cards.length === 0) return;

                // Toggle active class to manage white overlays on non-active cards
                for (let idx = 0; idx < cards.length; idx++) {
                    if (idx === i) {
                        cards[idx].classList.add('active');
                    } else {
                        cards[idx].classList.remove('active');
                    }
                }

                const card = cards[i];
                const cardWidth = card.getBoundingClientRect().width;
                const trackWidth = track.getBoundingClientRect().width;
                // Center offset = (card's left position within track) - (half track width) + (half card width)
                const targetScrollLeft = card.offsetLeft - (trackWidth / 2) + (cardWidth / 2);

                track.scrollTo({
                    left: targetScrollLeft,
                    behavior: 'smooth'
                });
            }

            function move(dir) {
                i += dir;
                if (i < 0) i = 0;
                if (i > cards.length - 1) i = cards.length - 1;
                updateCenter();
            }

            prev.addEventListener('click', () => move(-1));
            next.addEventListener('click', () => move(1));
            window.addEventListener('resize', updateCenter);
            
            // Initial center on load
            setTimeout(updateCenter, 100);
        })();
    </script>

@endsection
