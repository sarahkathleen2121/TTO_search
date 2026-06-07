@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/homepage.css') }}">
        <!-- Hero -->
    <section class="ab-hero">
      <div class="container">
        <div class="ab-breadcrumb"><a href="{{ route('home') }}">Home</a> / Our Story</div>
        <h1 class="ab-hero-title">About Total Office</h1>
        <div class="ab-hero-sub">
          <b>N/A</b>
        Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet
          sint. Velit officia consequat.
        </div>
      </div>
    </section>

    <!-- About Us with varying image widths/heights -->
    <section class="ab-about">
      <div class="container">
        <div class="row g-4 mb-2">
          <div class="col-lg-6">
            <h3>About Us</h3>
            <p style="color: #383E42">
              For over 28 years, <b>The Total Office</b> has been at the forefront of delivering dynamic workplace and commercial solutions across the region. Our experience reflects decades of industry knowledge, refined expertise, and a deep understanding of how modern businesses work and evolve.
            </p>
            <p style="color: #383E42">
              We believe workspaces are not static environments but dynamic ecosystems that adapt to the needs of people, technology, and culture. Our vision is to set the benchmark in the workspace industry by driving sustainability, innovation, and operational excellence. We achieve this by building meaningful partnerships, delivering locally produced and integrated solutions, and empowering high-performing teams to continuously enhance the workplace experience, creating lasting value for our clients and communities.
            </p>
            <p style="color: #383E42">Sustainability is central to everything we do. With the majority of our suppliers sourcing wood from FSC or PEFC-certified forests and LEED-accredited facilities in Dubai and Abu Dhabi, we support responsible sourcing and green building practices. Through partnerships with globally certified manufacturers and recycling initiatives with BEE’AH Tandeef, we continue to reduce environmental impact while creating workspaces that balance design, functionality, and environmental responsibility.</p>
          </div>
          <div class="col-lg-6">
            <h3>Sustainability Approach</h3>
            <p style="color: #383E42">
             At The Total Office, sustainability isn’t just a practice, it’s part of who we are. Our people bring expertise and credibility, including three LEED Green Associate certifications and a WELL AP, and a commitment to continual learning in the sustainability space. Our places reflect this dedication, with LEED-certified offices in Abu Dhabi since 2010 and Dubai since 2011.
            </p>
            <p style="color: #383E42">
             Our products are carefully curated with sustainability in mind, supported by a robust database of certificates integrated into every quote. Across our practice, we adhere to international standards with ISO 14001, ISO 9001, and ISO 45001 Environmental Management Systems, ensuring every process aligns with environmental responsibility.

            </p>
            <p style="color: #383E42">Our promise is clear: we are committed to achieving Net Zero Emissions by 2045 while continuously reducing our environmental impact, shaping a better future for our people, our clients, and the planet.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Category Slider (same as homepage) -->
    <section class="slider-section">
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

    <!-- USP Tabs -->
    <section class="ab-usp">
      <div class="container">
        <h3><b>N/A</b>  USP's</h3>
        <div class="ab-usp-sub">
          With the new AirPlay 2, you can control your home audio system and the
          speakers throughout your house 4 You can play a song in the living room
          and your kitchen at the same time.
        </div>

        <div class="row g-4">
          <div class="col-md-4">
            <div class="usp-title">USP 1</div>
            <p class="usp-desc">
              Eget neque lorem commodo sit. Viverra ut posuere consequat
              nunc.
            </p>
          </div>
          <div class="col-md-4">
            <div class="usp-title">USP 2</div>
            <p class="usp-desc">
              Cum lacinia magna aliquet metus. Arcu tortor, nisi id dui
              amet ac eu. Turpis erat ornare mauris, aliquet arcu.
              facilisis eleifend.
            </p>
          </div>
          <div class="col-md-4">
            <div class="usp-title">USP 3</div>
            <p class="usp-desc">
              Id senectus semper id lacus. Risus a, erat arcu morbi
              tortor. Nisl, vel mauris vulputate arcu venenatis.
            </p>
          </div>
        </div>

        <div class="row g-4 mt-2">
          <div class="col-md-4">
            <div class="ab-pattern ab-box-sm"></div>
          </div>
          <div class="col-md-8">
            <div class="ab-pattern ab-box-lg"></div>
          </div>
        </div>
      </div>
    </section>

    <!-- History with tabs + timeline -->
    <section class="ab-history">
      <div class="container">
        <div class="mb-2" style="color: #383E42; font-weight: 800">
          Our History
        </div>
        <ul class="nav nav-pills" id="histTabs" role="tablist">
          <li class="nav-item">
            <button
              class="nav-link active"
              data-bs-toggle="pill"
              data-bs-target="#hist1"
            >
              Our History
            </button>
          </li>
          <li class="nav-item">
            <button
              class="nav-link"
              data-bs-toggle="pill"
              data-bs-target="#hist2"
            >
              Future Roadmap
            </button>
          </li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="hist1">
            <h2>1997: The Foundation</h2>
            <div class="row g-4">
              <div class="col-md-4">
                <p style="color: #383E42">
                <b>Company Inception:</b> Established in the UAE with a mission to redefine the workplace experience.
                </p>
              </div>
              <div class="col-md-4">
                <p style="color: #383E42">
                <b>The Original Team:</b> Started as a lean 4-person operation.
                </p>
              </div>
              <div class="col-md-4">
                <p style="color: #383E42">
                <b>Teknion Partnership:</b> Launched primarily as a <b>Teknion Dealership</b>, introducing the region to high-end architectural and ergonomic furniture.
                </p>
              </div>
              <div class="col-md-12">
                <h4 style="color: #383E42">Late 1990s: Landmark Achievements</h4>
                <p style="color: #383E42">
               <b> The Emirates NBD HQ:</b> Secured its first landmark project—the Emirates NBD Headquarters. This success set the standard for the company’s future in large-scale corporate interiors.
                </p>
              </div>
            </div>
            <div class="ab-timeline row g-4 mt-3">
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2000s – 2010s: Growth & Evolution</div>
                <ul class="list-unstyled" style="color: #383E42">
                  <li><b>Regional Authority:</b> Expanded its portfolio to include global brands across acoustics, flooring, and lighting.</li>
                  <li class="mt-2">
                    <b>Human-Centric Design: </b> Shifted focus toward wellness-oriented workspaces, incorporating ergonomic research and sustainable materials into every project.
                  </li>
                </ul>
              </div>
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2020 – 2023: Adaptation & Resilience</div>
                <ul class="list-unstyled" style="color: #383E42">
                  <li><b>The Hybrid Shift:</b> Successfully guided clients through the pandemic-era transition to hybrid and agile work models.</li>
                  <li class="mt-2">
                    <b>Sustainability Leadership:</b> Deepened commitment to LEED and WELL-certified standards, positioning the company as a leader in green workplace design.
                  </li>
                </ul>
              </div>
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2024: Strategic Expansion to KSA</div>
                <ul class="list-unstyled" style="color: #383E42">
                  <li><b>The Saudi Launch:</b> In response to the massive growth of Vision 2030, The Total Office officially expanded into Saudi Arabia (KSA).</li>
                  <li class="mt-2">
                    <b>Regional Headquarters:</b> Establishing a presence in the Kingdom allowed the company to directly support the surge of multinational corporations setting up their regional HQs in Riyadh and beyond.
                  </li>
                </ul>
              </div>
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2025: Innovation & The Future of Work</div>
                <ul class="list-unstyled" style="color: #383E42">
                  <li><b>Smart Office Integration:</b> (Current/Upcoming) Deploying AI-driven space utilization tools and IoT-integrated furniture to help firms optimize their real estate.</li>
                  <li class="mt-2">
                   <b> Net-Zero Focus:</b> Aiming to become the primary consultant for companies looking to achieve carbon-neutral workplaces through circular economy furniture practices.
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="hist2">
            <h2>Future Roadmap</h2>
            <div class="ab-timeline row g-4 mt-3">
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2025</div>
                <p>Key milestone one.</p>
              </div>
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2026</div>
                <p>Key milestone two.</p>
              </div>
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2027</div>
                <p>Key milestone three.</p>
              </div>
              <div class="col-6 col-md-3 ab-time-item">
                <div class="year">2030</div>
                <p>Key milestone four.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Team with tabs and stacked images groups -->
    <section class="ab-team">
      <div class="container">
        <h3>The Team</h3>
        <div class="d-flex justify-content-center mb-3">
          <ul class="nav nav-pills" id="teamTabs" role="tablist">
            <li class="nav-item">
              <button
                class="nav-link active"
                data-bs-toggle="pill"
                data-bs-target="#board"
              >
                Board Members
              </button>
            </li>
            <li class="nav-item">
              <button
                class="nav-link"
                data-bs-toggle="pill"
                data-bs-target="#mgmt"
              >
                Management
              </button>
            </li>
          </ul>
        </div>
        <div class="tab-content">
          <div class="tab-pane fade show active" id="board">
            <div class="row g-4 text-primary">
              <div class="col-6 col-lg-3 ab-team-group">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team 1</div>
              </div>
              <div class="col-6 col-lg-3 ab-team-group ab-stagger">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team 2</div>
              </div>
              <div class="col-6 col-lg-3 ab-team-group">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team 3</div>
              </div>
              <div class="col-6 col-lg-3 ab-team-group ab-stagger">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team 4</div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="mgmt">
            <div class="row g-4 text-primary">
              <div class="col-6 col-lg-3 ab-team-group">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team A</div>
              </div>
              <div class="col-6 col-lg-3 ab-team-group ab-stagger">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team B</div>
              </div>
              <div class="col-6 col-lg-3 ab-team-group">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team C</div>
              </div>
              <div class="col-6 col-lg-3 ab-team-group ab-stagger">
                <div class="ab-stack">
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                  <div class="ab-card"></div>
                </div>
                <div class="ab-team-name">Team D</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Sustainability list -->
    <section class="ab-sus">
      <div class="container">
        <h3>Sustainability</h3>
        <div class="ab-srow row g-3 align-items-start">
          <div class="col-2 col-md-1 ab-snum">01</div>
          <div class="col-10 col-md-5 ab-sname">Low Waste</div>
          <div class="col-12 col-md-6 ab-sdesc">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
          </div>
        </div>
        <div class="ab-srow row g-3 align-items-start">
          <div class="col-2 col-md-1 ab-snum">02</div>
          <div class="col-10 col-md-5 ab-sname">
            Our products are made from 100% <br/> recycled material.
          </div>
          <div class="col-12 col-md-6 ab-sdesc">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
          </div>
        </div>
        <div class="ab-srow row g-3 align-items-start">
          <div class="col-2 col-md-1 ab-snum">03</div>
          <div class="col-10 col-md-5 ab-sname">
            Our goal is to have zero carbon <br/> footprint by 2030.
          </div>
          <div class="col-12 col-md-6 ab-sdesc">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
          </div>
        </div>
        <div class="ab-srow row g-3 align-items-start">
          <div class="col-2 col-md-1 ab-snum">04</div>
          <div class="col-10 col-md-5 ab-sname">
            All our products made with <br/> sustainability in mind
          </div>
          <div class="col-12 col-md-6 ab-sdesc">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
          </div>
        </div>
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

    <script>
        (function() {
            const sliderWrapper = document.getElementById('sliderWrapper');
            if (!sliderWrapper) return;
            const dotsContainer = document.getElementById('dotsContainer');
            const cardsContainer = sliderWrapper;

            // Clone all cards for infinite loop
            const originalCards = Array.from(cardsContainer.children);
            if (originalCards.length === 0) return;
            
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

            const dots = dotsContainer.querySelectorAll('.dot');

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
        })();
    </script>
@endsection
