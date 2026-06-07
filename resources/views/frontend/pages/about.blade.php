@extends('frontend.layouts.master')

@section('title', 'About - Our Story')

@section('content')
  <!-- Premium Typography: Playfair Display for Serifs, Inter for Sans-Serif -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('frontend_assets/css/about.css') }}?v=1.0.2">
  
  <!-- About scroll wrapper - contains horizontal timeline, footer shows below -->
  <div class="about-scroll-wrapper" id="aboutScrollWrapper">
    <div class="scroll-pin-track" id="scrollPinTrack">
      <!-- Main Horizontal Timeline Track Container -->
      <main class="timeline-container" id="timelineContainer">
        
        <!-- SLIDE 1: HERO SECTION -->
        <section class="timeline-section hero-section">
          <div class="hero-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/first_img.webp') }}" alt="Our Story" class="hero-bg-img">
          </div>
          <div class="hero-overlay-dark"></div>
          
          <div class="hero-content">
            <span class="hero-subtitle">Our Story</span>
            <h1 class="hero-title" style="font-size: 4.5rem; line-height: 1.1;">Nearly 3 Decades in the Making</h1>
            <p class="hero-desc">From a napkin sketch in a hospital to a regional force reshaping how the Middle East works — this is our story.</p>
            <div class="swipe-indicator">
              <span>Scroll down to explore</span>
              <svg class="arrow-icon-animate" viewBox="0 0 24 24" width="20" height="20">
                <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </div>
          </div>
        </section>

        <!-- SLIDE 2: SEGMENT 1 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">01</span>
              <span class="step-duration">1997</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">The Beginning 1997</h2>
              <p class="step-text">The best ideas don't wait for the right moment. Ours was sketched on the back of a napkin in the most unlikely of places — a hospital. From that spark, The Total Office was born in the UAE with a single, unshakeable mission: to redefine what a workplace could be.</p>
            </div>
          </div>
          
          <!-- Sofa Floating Layer -->
          <div class="layer-sofa-top scroll-parallax" data-speed="-0.15">
            <img src="{{ asset('frontend_assets/images/about_images/upper_two.png') }}" alt="The Beginning napkin sketch">
          </div>
        </section>

        <!-- SLIDE 3: SPACER SHOWCASE 1 -->
        <section class="timeline-section spacer-section">
          <div class="section-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/second_img.webp') }}" alt="First corporate space" class="section-bg-img">
          </div>
        </section>

        <!-- SLIDE 4: SEGMENT 2 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">02</span>
              <span class="step-duration">Late 1990s</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">First Landmark Late 1990s</h2>
              <p class="step-text">Ambition needs a stage. Ours was the Emirates NBD Headquarters — our first major project and the blueprint for everything that followed. It set the standard for large-scale corporate interiors and put The Total Office firmly on the map.</p>
            </div>
          </div>
        </section>

        <!-- SLIDE 5: SPACER SHOWCASE 2 -->
        <section class="timeline-section spacer-section">
          <div class="section-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/third_img.webp') }}" alt="Emirates NBD HQ design" class="section-bg-img">
          </div>
        </section>

        <!-- SLIDE 6: SEGMENT 3 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">03</span>
              <span class="step-duration">2000s – 2010s</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">Growth & Evolution 2000s – 2010s</h2>
              <p class="step-text">We didn't stand still. Through two decades of expansion, we grew our portfolio to encompass global brands across acoustics, flooring, and lighting. We pioneered human-centric design in the region — embedding ergonomic research and sustainable materials into every workspace we touched.</p>
            </div>
          </div>
          
          <!-- Fabric Rolls Floating Layer -->
          <div class="floating-layer layer-fabric-top scroll-parallax" data-speed="-0.15">
            <img src="{{ asset('frontend_assets/images/about_images/upper_four_img.webp') }}" alt="Material acoustics and layout expansion">
          </div>
        </section>

        <!-- SLIDE 7: SPACER SHOWCASE 3 -->
        <section class="timeline-section spacer-section">
          <div class="section-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/fourth_img.webp') }}" alt="Ergonomic workstations" class="section-bg-img">
          </div>
        </section>

        <!-- SLIDE 8: SEGMENT 4 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">04</span>
              <span class="step-duration">2020 – 2023</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">Resilience & Reinvention 2020 – 2023</h2>
              <p class="step-text">When the world changed, we led the way forward. We guided clients through the shift to hybrid and agile work — redesigning not just spaces, but how people experience them. We deepened our commitment to LEED and WELL standards, cementing our position as the region's leader in green workplace design.</p>
            </div>
          </div>

          <!-- Shop Drawing Blueprint floating layer -->
          <div class="floating-layer layer-six-right scroll-parallax" data-speed="-0.15">
            <img src="{{ asset('frontend_assets/images/about_images/upper-sixth_img.webp') }}" alt="Acoustic and green design specifications">
          </div>
        </section>

        <!-- SLIDE 9: SPACER SHOWCASE 4 -->
        <section class="timeline-section spacer-section">
          <div class="section-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/fifth-img.webp') }}" alt="Sustainable project overview" class="section-bg-img">
          </div>
          <!-- Spec Sheet Floating Layer -->
          <div class="floating-layer layer-center layer-spec-sheet scroll-parallax" data-speed="0.1">
            <img src="{{ asset('frontend_assets/images/about_images/upper_fifth_img.webp') }}" alt="Green specifications" class="spec-img">
          </div>
        </section>

        <!-- SLIDE 10: SEGMENT 5 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">05</span>
              <span class="step-duration">2024</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">Expansion into KSA 2024</h2>
              <p class="step-text">Vision 2030 is reshaping an entire nation. We showed up for it. The Total Office officially launched in Saudi Arabia, establishing a regional presence to support the wave of multinational corporations building their headquarters in Riyadh and beyond.</p>
            </div>
          </div>
        </section>

        <!-- SLIDE 11: SPACER SHOWCASE 5 -->
        <section class="timeline-section spacer-section">
          <div class="section-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/sixth_img.webp') }}" alt="Saudi Arabia office expansion" class="section-bg-img">
          </div>
        </section>

        <!-- SLIDE 12: SEGMENT 6 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">06</span>
              <span class="step-duration">2026</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">The Future of Work, Now 2026</h2>
              <p class="step-text">The workspace is no longer just physical. We are deploying AI-driven space utilisation tools and IoT-integrated furniture to help businesses optimise how they use every square metre. Sustainability leads the way — with Net Zero Emissions as our 2045 commitment and circular economy principles guiding every recommendation we make.</p>
            </div>
          </div>

          <!-- Wooden Chair floating layer -->
          <div class="floating-layer layer-chair-top scroll-parallax" data-speed="-0.1">
            <img src="{{ asset('frontend_assets/images/about_images/upper_seven_img.png') }}" alt="IoT furniture design chair">
          </div>
        </section>

        <!-- SLIDE 13: SPACER SHOWCASE 6 -->
        <section class="timeline-section spacer-section">
          <div class="section-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/seventh_img.webp') }}" alt="Smart office workspace" class="section-bg-img">
          </div>
        </section>

        <!-- SLIDE 14: SEGMENT 7 -->
        <section class="timeline-section step-section">
          <div class="step-card">
            <div class="step-header">
              <span class="step-number">07</span>
              <span class="step-duration">2026 &amp; Beyond</span>
            </div>
            <div class="step-body">
              <h2 class="step-title">What's Next 2026 & Beyond</h2>
              <p class="step-text">3 decades in, and the most exciting chapter is still ahead. We are investing in smart office technology, deepening our digital capabilities, and evolving into the region's foremost workplace consultancy. From AI-powered space intelligence to carbon-neutral fit-outs — we're not just designing offices. We're designing the future of work. And we're only getting started.</p>
            </div>
          </div>
        </section>

        <!-- SLIDE 15: CTA FULL SCREEN LANDING -->
        <section class="timeline-section cta-section">
          <div class="cta-bg-wrapper">
            <img src="{{ asset('frontend_assets/images/about_images/last_background_img.webp') }}" alt="Designing the Future of Work" class="cta-bg-img">
          </div>
          <div class="cta-overlay-dark"></div>

          <div class="cta-card">
            <span class="cta-subtitle">Nearly 3 Decades in the Making</span>
            <h2 class="cta-title">Designing the Future of Work</h2>
            <p class="cta-text">From a napkin sketch to a regional force. We are only getting started.</p>
            
            <a href="javascript:void(0)" class="download-btn btn-book">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
              </svg>
              <span>Book a Visit / Call</span>
            </a>
          </div>
        </section>

      </main>
    </div><!-- /.scroll-pin-track -->

    <!-- Sticky Left & Right Navigation Arrows (White/Light Theme Optimized) -->
    <div class="navigation-controls">
      <button id="navBtnLeft" class="nav-control-btn left" aria-label="Scroll left">
        <svg viewBox="0 0 24 24" width="24" height="24">
          <path d="M19 12H5M12 19l-7-7 7-7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
      <button id="navBtnRight" class="nav-control-btn right" aria-label="Scroll right">
        <svg viewBox="0 0 24 24" width="24" height="24">
          <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>

    <!-- Custom subtle progress indicator -->
    <div class="progress-bar-container">
      <div class="progress-bar-fill" id="progressBarFill"></div>
    </div>

    <!-- Script tags -->
    <script src="{{ asset('frontend_assets/js/about/script_v2.js') }}?v=1.0.2"></script>
  </div><!-- /.about-scroll-wrapper -->
@endsection
