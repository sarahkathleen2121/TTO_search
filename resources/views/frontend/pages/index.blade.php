@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/homepage.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/ai-search.css') }}">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <div class="hero-content">
                        <h1 class="hero-title">Total Office<br />Enhancing Workspaces</h1>
                        <p class="hero-description">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisl
                            diam lectus sagittis, massa aliquam commodo blandit viverra. Sem
                            arcu, ullamcorper egestas convallis. In velit sit montes, dol.
                            Egestas et aliquot quis praesent diam.
                        </p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero-image">
                        <img src="{{asset('frontend_assets/images/hero_img.png')}}" alt="Hero Image" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4 mb-5">
        @include('frontend.components.ai-search-bar', ['style' => 'original'])
    </div>

    <!-- Video Section -->
    <section class="container">
        <div class="video-container" onclick="playVideo()">
            <div class="video-play-button">
                <i class="fas fa-play"></i>
            </div>
            <div class="video-text">Watch Our Showreel</div>
        </div>
    </section>
    <!-- Bespoke Solutions Section -->
    <section class="bespoke-section">
        
        <div class="bespoke-container">
            <div class="bespoke-left">
                <h2 class="bespoke-title">Bespoke Solutions</h2>
                <div class="bespoke-icon">
                    <img src="{{ asset('frontend_assets/images/bespoke_sec.png') }}" alt="Bespoke Solutions">
                </div>
            </div>
            <div class="bespoke-right">
                <p class="bespoke-description">
                    Duis netus dignissim eros dui lorem adipiscing. Viverra dui massa
                    arcu adipiscing quis integer habitasse et. Facilisis nulla muscenas
                    malesuada pharetra vel quis. Neque facilisi vel eu risus et sed
                    amet. Molestie habitasse du sapien venenatis at. At urna egestas
                    elit et at valpulate in turpis. Ultrices ullamcorper amet lacus urna
                    velit at.
                </p>
                <button class="bespoke-button">GET STARTED</button>
                <div class="bespoke-industries-title">Industries:</div>
                <div class="bespoke-industries">
                    @foreach($industries as $industry)
                    <div class="industry-item" onclick="window.location.href='{{ route('industry.detail', $industry->slug) }}'" style="cursor:pointer;">
                        <span class="industry-name">{{ $industry->name }}</span>
                        <span class="industry-arrow"><i class="fa-solid fa-arrow-right arrow-icon"></i></span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="testimonial-section">
        <div class="testimonial-container">
            <div class="testimonial-left">
                <div class="testimonial-label">Team Quote</div>
                <h2 class="testimonial-quote">
                    Justo, et, scelerisque cursus quis. A felis, velit orci libero id augue amet. Gravida.
                </h2>
                <div class="testimonial-author">John Doe</div>
                <p class="testimonial-desc">
                    Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                </p>
            </div>
            <div class="testimonial-right">
                <div class="testimonial-image-static">
                    <img src="{{ asset('frontend_assets/images/team_quote.png') }}" alt="Team Quote">
                </div>
            </div>
        </div>
    </section>

    <!-- Case Studies Section -->
    <section class="case-studies-section">
        <div class="case-studies-header">
            <h2 class="case-studies-title">Case Studies</h2>
        </div>

        <div class="case-studies-slider-wrapper">
            <button class="cs-nav-btn cs-nav-prev" onclick="caseStudyPrev()">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="cs-slider-viewport">
                <div class="cs-slider-track" id="caseStudiesSlider">
                    <!-- Case Study Card 1 -->
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 1</h3>
                                    <p class="case-study-description">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nisl, diam lectus sagittis,
                                        massa aliquam commodo.
                                    </p>
                                    <a href="#" class="case-study-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #694A28; z-index:-1"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #8C8175; z-index:-2"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Case Study Card 2 -->
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 2</h3>
                                    <p class="case-study-description">
                                        Viverra dui massa arcu adipiscing quis integer habitasse et.
                                        Facilisis nulla muscenas malesuada pharetra vel quis.
                                    </p>
                                    <a href="#" class="case-study-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Case Study Card 3 -->
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 3</h3>
                                    <p class="case-study-description">
                                        Neque facilisi vel eu risus et sed amet. Molestie habitasse du
                                        sapien venenatis at. At urna egestas elit et.
                                    </p>
                                    <a href="#" class="case-study-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Case Study Card 4 -->
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 4</h3>
                                    <p class="case-study-description">
                                        Ultrices ullamcorper amet lacus urna velit at. Valpulate in turpis
                                        sem arcu ullamcorper egestas convallis.
                                    </p>
                                    <a href="#" class="case-study-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="cs-nav-btn cs-nav-next" onclick="caseStudyNext()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="cs-explore-wrapper">
            <button class="explore-all-btn">Explore All</button>
        </div>
    </section>

    <!-- Explore by Category Section -->
    <section class="slider-section">
        <h1 class="section-title">Explore by Category</h1>

        <div class="slider-container">
            <div class="slider-wrapper" id="sliderWrapper">
                @foreach($productTypes as $index => $type)
                @php
                    $imageMap = [
                        'furniture' => 'furniture.png',
                        'acustic-products' => 'acoustic.png',
                        'writable-surfaces' => 'writable.png',
                        'fabrics' => 'fabrics.png',
                        'greenwalls' => 'greenwalls.png',
                    ];
                    $imageName = $imageMap[$type->slug] ?? 'banner_img.png';
                @endphp
                <div class="category-card" data-index="{{ $index }}" onclick="window.location.href='{{ route('product_type.detail', $type->slug) }}'" style="cursor:pointer;">
                    <div class="card-icon">
                        <img src="{{ asset('frontend_assets/images/' . $imageName) }}" alt="{{ $type->name }}" />
                    </div>
                    <h3 class="card-title">{{ $type->name }}</h3>
                    <p class="card-items">{{ $type->products_count > 0 ? $type->products_count . '+' : '40+' }} items</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="dots-container" id="dotsContainer"></div>

        <div class="text-center">
            <a href="#" class="cta-button">SEE ALL PRODUCTS</a>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products-section">
        <div class="container">
            <div class="featured-products-header">
                <h2 class="featured-products-title">Featured Products</h2>
            </div>

            <div class="row g-4 justify-content-center">
                @foreach($featuredProducts as $product)
                <div class="col-md-6 col-lg-4">
                    <div class="fp-card">
                        <div class="fp-card-top position-relative">
                            <a href="{{ route('product.detail', ['slug' => $product->slug]) }}">
                                <img src="{{ $product->thumbnail ? asset('storage/' . $product->thumbnail) : asset('frontend_assets/images/banner_img.png') }}" alt="{{ $product->name }}" onerror="this.src='{{ asset('frontend_assets/images/banner_img.png') }}'">
                            </a>
                        </div>
                        <div class="fp-card-body">
                            <a href="{{ route('product.detail', ['slug' => $product->slug]) }}" class="text-decoration-none text-dark">
                                <div class="fp-name">{{ $product->name }}</div>
                            </a>
                            <div class="fp-brand">{{ $product->brand->name ?? 'Brand' }}</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Book a Visit Section -->
    <section class="book-visit-section">
        <div class="book-visit-content-wrapper">
            <h2 class="book-visit-title">Visit Our Showroom</h2>
            <button class="book-visit-button">Book a Visit</button>
        </div>
    </section>

    <!-- Testimonials Slider Section -->
    <section class="testi-slider-section">
        <div class="testi-slider-header">
            <h2 class="testi-slider-title">Testimonials</h2>
        </div>

        <div class="testi-slider-wrapper">
            <button class="testi-nav-btn testi-nav-prev" onclick="testiPrev()">
                <i class="fas fa-chevron-left"></i>
            </button>

            <div class="testi-slider-inner">
                <!-- Cards viewport -->
                <div class="testi-cards-viewport">
                    <div class="testi-cards-track" id="testiSliderTrack">
                        <!-- Card 1 -->
                        <div class="testi-slide-card">
                            <p class="testi-slide-quote">
                                "All base UI elements are made using Nested Symbols and shared
                                styles that are logically connected. Gorgeous, high-quality
                                video sharing on desktop, mobile, tablet.
                                All base UI elements are made using Nested Symbols"
                            </p>
                            <div class="testi-slide-author">
                                <img src="{{ asset('frontend_assets/images/testimonial_user.png') }}" class="testi-avatar" alt="avatar">
                                <div>
                                    <div class="testi-name">Name Surname</div>
                                    <div class="testi-company">Founder, Acme Company</div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="testi-slide-card">
                            <p class="testi-slide-quote">
                                "All base UI elements are made using Nested Symbols and shared
                                styles that are logically connected. Gorgeous, high-quality
                                video sharing on desktop, mobile, tablet.
                                All base UI elements are made using Nested Symbols"
                            </p>
                            <div class="testi-slide-author">
                                <img src="{{ asset('frontend_assets/images/testimonial_user.png') }}" class="testi-avatar" alt="avatar">
                                <div>
                                    <div class="testi-name">Name Surname</div>
                                    <div class="testi-company">Founder, Acme Company</div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="testi-slide-card">
                            <p class="testi-slide-quote">
                                "All base UI elements are made using Nested Symbols and shared
                                styles that are logically connected. Gorgeous, high-quality
                                video sharing on desktop, mobile, tablet.
                                All base UI elements are made using Nested Symbols"
                            </p>
                            <div class="testi-slide-author">
                                <img src="{{ asset('frontend_assets/images/testimonial_user.png') }}" class="testi-avatar" alt="avatar">
                                <div>
                                    <div class="testi-name">Name Surname</div>
                                    <div class="testi-company">Founder, Acme Company</div>
                                </div>
                            </div>
                        </div>

                        <!-- Card 4 -->
                        <div class="testi-slide-card">
                            <p class="testi-slide-quote">
                                "All base UI elements are made using Nested Symbols and shared
                                styles that are logically connected. Gorgeous, high-quality
                                video sharing on desktop, mobile, tablet.
                                All base UI elements are made using Nested Symbols"
                            </p>
                            <div class="testi-slide-author">
                                <img src="{{ asset('frontend_assets/images/testimonial_user.png') }}" class="testi-avatar" alt="avatar">
                                <div>
                                    <div class="testi-name">Name Surname</div>
                                    <div class="testi-company">Founder, Acme Company</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button class="testi-nav-btn testi-nav-next" onclick="testiNext()">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <script>
        // Testimonials Slider
        (function() {
            const track = document.getElementById('testiSliderTrack');
            if (!track) return;
            const cards = track.querySelectorAll('.testi-slide-card');
            const totalCards = cards.length;
            let testiIndex = 0;

            function getCardsPerView() {
                if (window.innerWidth <= 576) return 1;
                if (window.innerWidth <= 992) return 2;
                return 3;
            }

            function updateTestiSlider() {
                const perView = getCardsPerView();
                const maxIndex = Math.max(0, totalCards - perView);
                if (testiIndex > maxIndex) testiIndex = maxIndex;
                const pct = (testiIndex / perView) * 100;
                track.style.transform = 'translateX(-' + pct + '%)';
            }

            window.testiNext = function() {
                const perView = getCardsPerView();
                const maxIndex = Math.max(0, totalCards - perView);
                testiIndex = Math.min(testiIndex + 1, maxIndex);
                updateTestiSlider();
            };

            window.testiPrev = function() {
                testiIndex = Math.max(testiIndex - 1, 0);
                updateTestiSlider();
            };

            window.addEventListener('resize', updateTestiSlider);
        })();
    </script>
    <section class="resources-section">
        <div class="resources-header">
            <h2 class="resources-title">Resources</h2>
            <button class="resources-see-all-btn" onclick="window.location.href='{{ route('resources') }}'">See all</button>
        </div>

        <div class="resources-grid">
            @foreach($blogs as $blog)
            <div class="resource-card">
                <div class="resource-image-container">
                    <img src="{{ $blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('frontend_assets/images/banner_img.png') }}" alt="{{ $blog->image_alt }}" class="resource-img" onerror="this.style.display='none'">
                    <span class="resource-bookmark">
                        <i class="fa-regular fa-bookmark"></i>
                    </span>
                    <span class="resource-badge">{{ $blog->category ?? 'Blog' }}</span>
                </div>
                <h3 class="resource-title">
                    {{ Str::limit($blog->title, 50) }}
                </h3>
                <p class="resource-description">
                    {{ Str::limit(strip_tags($blog->content), 80) }}
                </p>
                <a href="{{ route('resource.detail', $blog->slug) }}" class="resource-link">Read More <i class="fas fa-chevron-right" style="font-size: 10px; margin-left: 5px;"></i></a>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Link Cards Section -->
    <section class="link-cards-section">
        <div class="link-cards-grid">
            <a href="{{ route('services') }}" class="link-card">
                <img src="{{ asset('frontend_assets/images/bespoke_solutions.png') }}" alt="Bespoke Solutions" class="link-card-img">
                <h3 class="link-card-title">Bespoke<br>Solutions</h3>
            </a>
            <a href="{{ route('all.products') }}" class="link-card">
                <img src="{{ asset('frontend_assets/images/products.png') }}" alt="Products" class="link-card-img">
                <h3 class="link-card-title">Products</h3>
            </a>
            <a href="{{ route('contact') }}" class="link-card">
                <img src="{{ asset('frontend_assets/images/contact_us.png') }}" alt="Contact Us" class="link-card-img">
                <h3 class="link-card-title">Contact Us</h3>
            </a>
        </div>
    </section>

    <script>
        // Case Studies Slider
        (function() {
            const track = document.getElementById('caseStudiesSlider');
            const cards = track ? track.querySelectorAll('.case-study-card') : [];
            let csIndex = 0;

            window.caseStudyNext = function() {
                if (cards.length === 0) return;
                csIndex = (csIndex + 1) % cards.length;
                track.style.transform = 'translateX(-' + (csIndex * 100) + '%)';
            };

            window.caseStudyPrev = function() {
                if (cards.length === 0) return;
                csIndex = (csIndex - 1 + cards.length) % cards.length;
                track.style.transform = 'translateX(-' + (csIndex * 100) + '%)';
            };
        })();
    </script>
    <script>
        const sliderWrapper = document.getElementById('sliderWrapper');
        const dotsContainer = document.getElementById('dotsContainer');
        const cardsContainer = sliderWrapper;

        // Clone all cards for infinite loop
        const originalCards = Array.from(cardsContainer.children);
        originalCards.forEach(card => {
            const clone = card.cloneNode(true);
            cardsContainer.appendChild(clone);
        });

        const allCards = document.querySelectorAll('.category-card');
        let currentIndex = 0;
        const totalCards = originalCards.length;

        // Calculate card width dynamically based on screen size
        function getCardWidth() {
            if (window.innerWidth <= 480) {
                return 215; // 200px card + 15px gap
            } else if (window.innerWidth <= 768) {
                return 240; // 220px card + 20px gap
            } else if (window.innerWidth <= 992) {
                return 290; // 260px card + 30px gap
            }
            return 310; // 280px card + 30px gap (desktop)
        }

        let cardWidth = getCardWidth();

        // Update card width on window resize
        window.addEventListener('resize', () => {
            cardWidth = getCardWidth();
            updateSlider(false);
        });

        // Create dots
        for (let i = 0; i < totalCards; i++) {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (i === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }

        const dots = document.querySelectorAll('.dot');

        function updateElevatedCard() {
            // Remove elevated class from all cards
            allCards.forEach(card => card.classList.remove('elevated'));

            // Add elevated class to cards in 2nd and 4th positions
            // 2nd visible card is at position currentIndex + 1
            const secondPosition = (currentIndex + 1) % (totalCards * 2);
            // 4th visible card is at position currentIndex + 3
            const fourthPosition = (currentIndex + 3) % (totalCards * 2);

            if (allCards[secondPosition]) {
                allCards[secondPosition].classList.add('elevated');
            }
            if (allCards[fourthPosition]) {
                allCards[fourthPosition].classList.add('elevated');
            }
        }

        function updateSlider(smooth = true) {
            if (!smooth) {
                sliderWrapper.style.transition = 'none';
            } else {
                sliderWrapper.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            }

            // Smooth slide animation
            sliderWrapper.style.transform = `translateX(-${currentIndex * cardWidth}px)`;

            // Update dots (modulo for infinite loop)
            dots.forEach((dot, index) => {
                dot.classList.remove('active');
                if (index === currentIndex % totalCards) {
                    dot.classList.add('active');
                }
            });

            // Update elevated cards based on position
            updateElevatedCard();

            // Handle infinite loop - reset position when reaching cloned cards
            if (currentIndex >= totalCards) {
                setTimeout(() => {
                    currentIndex = 0;
                    updateSlider(false);
                }, 600); // Wait for animation to complete
            }
        }

        function goToSlide(index) {
            currentIndex = index;
            updateSlider();
        }

        // Auto-play slider with infinite loop
        setInterval(() => {
            currentIndex++;
            updateSlider();
        }, 2500); // Auto slides every 2.5 seconds

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = totalCards - 1;
                }
                updateSlider();
            } else if (e.key === 'ArrowRight') {
                currentIndex++;
                updateSlider();
            }
        });

        // Touch/Swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        sliderWrapper.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });

        sliderWrapper.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX - 50) {
                currentIndex++;
                updateSlider();
            }
            if (touchEndX > touchStartX + 50) {
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = totalCards - 1;
                }
                updateSlider();
            }
        }

        // Initialize
        updateSlider();
    </script>
@endsection

@push('scripts')
    <script src="{{ asset('frontend_assets/js/ai-search/api.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/suggestions.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/ai-search/search.js') }}"></script>
@endpush
