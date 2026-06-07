<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crafting Custom Furniture | Stellar Works’ Bespoke Design Process</title>
  
  <!-- Premium Typography: Playfair Display for Serifs, Inter for Sans-Serif -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="{{ asset('frontend_assets/css/about.css') }}">
  
  <!-- Stellar Works Favicon -->
  <link href="https://cdn.prod.website-files.com/666864cc2e2e84bfc95881ec/66a3c89144867d540c7cda4b_Stellar-Works-Favicon.png" rel="shortcut icon" type="image/x-icon"/>
</head>
<body class="process-body">

  <!-- Main Horizontal Timeline Track Container -->
  <main class="timeline-container" id="timelineContainer">
    
    <!-- SLIDE 1: HERO SECTION -->
    <section class="timeline-section hero-section">
      <div class="hero-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/first_img.webp') }}" alt="Factory Imagery" class="hero-bg-img">
      </div>
      <div class="hero-overlay-dark"></div>
      
      <div class="hero-content">
        <span class="hero-subtitle">Bespoke Production</span>
        <h1 class="hero-title">Process</h1>
        <p class="hero-desc">Discover the detailed journey of crafting custom-tailored luxury furniture solutions, from technical design specifications to final post-delivery support.</p>
        <div class="swipe-indicator">
          <span>Use mouse wheel or arrows to explore</span>
          <svg class="arrow-icon-animate" viewBox="0 0 24 24" width="20" height="20">
            <path d="M5 12h14M12 5l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </div>
      </div>
    </section>

    <!-- SLIDE 2: STEP 1 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">01</span>
          <span class="step-duration">GET STARTED</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Design Specifications</h2>
          <p class="step-text">Provide detailed specifications, drawings, dimensions, and materials to our team. Stellar Works can quote all upholstered, non-upholstered, and case goods FF&amp;E to match your custom aesthetic.</p>
        </div>
        <!-- Card bottom image completely removed as requested, card is pure white -->
      </div>
      
      <!-- Sofa Floating Layer -->
      <div class="layer-sofa-top scroll-parallax" data-speed="-0.15">
        <img src="{{ asset('frontend_assets/images/about_images/upper_two.png') }}" alt="Design specifications sofa cutout">
      </div>
    </section>

    <!-- SLIDE 3: SPACER SHOWCASE 1 (Full Image 2 - second_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/second_img.webp') }}" alt="Full Image Showcase 1" class="section-bg-img">
      </div>
    </section>

    <!-- SLIDE 4: STEP 2 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">02</span>
          <span class="step-duration">1 - 2 WEEKS</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Quotation</h2>
          <p class="step-text">Our dedicated engineering and pricing team reviews materials, structural integrity, and craftsmanship requirements to construct a highly detailed bespoke production quotation tailored specifically to your project requirements.</p>
        </div>
      </div>
    </section>

    <!-- SLIDE 5: SPACER SHOWCASE 2 (Full Image 3 - third_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/third_img.webp') }}" alt="Full Image Showcase 2" class="section-bg-img">
      </div>
    </section>

    <!-- SLIDE 6: STEP 3 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">03</span>
          <span class="step-duration">1 WEEK</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Order Placement</h2>
          <p class="step-text">Upon receiving your official Purchase Order (PO) and initial deposit, our project managers initiate the project kickoff. We immediately schedule resources and begin creating technical shop drawings for your approval.</p>
        </div>
      </div>
      
      <!-- Sofa style sliding layer: Fabric Rolls -->
      <div class="floating-layer layer-fabric-top scroll-parallax" data-speed="-0.15">
        <img src="{{ asset('frontend_assets/images/about_images/upper_four_img.webp') }}" alt="Fabric rolls">
      </div>
    </section>

    <!-- SLIDE 7: SPACER SHOWCASE 3 (Full Image 4 - fourth_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/fourth_img.webp') }}" alt="Full Image Showcase 3" class="section-bg-img">
      </div>
    </section>

    <!-- SLIDE 8: STEP 4 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">04</span>
          <span class="step-duration">2 - 3 WEEKS</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Shop Drawings &amp; Samples</h2>
          <p class="step-text">Our draftspeople create exact shop drawings. Simultaneously, you send physical control samples to Stellar Works to initiate precise matching of wood finishes, lacquer, metal coatings, and custom upholstery textures.</p>
        </div>
      </div>

      <!-- Shop Drawing Blueprint floating layer -->
      <div class="floating-layer layer-six-right scroll-parallax" data-speed="-0.15">
        <img src="{{ asset('frontend_assets/images/about_images/upper-sixth_img.webp') }}" alt="Shop drawings blueprint specification">
      </div>
    </section>

    <!-- SLIDE 9: SPACER SHOWCASE 4 (Full Image 5 - fifth-img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/fifth-img.webp') }}" alt="Full Image Showcase 4" class="section-bg-img">
      </div>
      <!-- Spec Sheet Floating Layer -->
      <div class="floating-layer layer-center layer-spec-sheet scroll-parallax" data-speed="0.1">
        <img src="{{ asset('frontend_assets/images/about_images/upper_fifth_img.webp') }}" alt="Upholstery specification" class="spec-img">
      </div>
    </section>

    <!-- SLIDE 10: STEP 5 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">05</span>
          <span class="step-duration">2 - 4 WEEKS</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Client Review Process</h2>
          <p class="step-text">Collaborate dynamically with Stellar Works' engineers, designers, and project managers. We work together iteratively to review, adjust, and approve every detail of the shop drawings and structural material control blocks.</p>
        </div>
    </section>

    <!-- SLIDE 11: SPACER SHOWCASE 5 (Full Image 6 - sixth_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/sixth_img.webp') }}" alt="Full Image Showcase 5" class="section-bg-img">
      </div>
    </section>

    <!-- SLIDE 12: STEP 6 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">06</span>
          <span class="step-duration">6 - 8 WEEKS</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Prototype Production</h2>
          <p class="step-text">Upon final approval of all shop drawings and materials, we construct physical prototypes for complex items or a Mock-Up Room. This allows real-world validation of sit comfort, proportions, and craftsmanship quality before volume manufacturing.</p>
        </div>
      </div>

      <!-- Interactive floating layer: Custom Wooden Chair -->
      <div class="floating-layer layer-chair-top scroll-parallax" data-speed="-0.1">
        <img src="{{ asset('frontend_assets/images/about_images/upper_seven_img.png') }}" alt="Floating wooden chair structure">
      </div>
    </section>

    <!-- SLIDE 13: SPACER SHOWCASE 6 (Full Image 7 - seventh_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/seventh_img.webp') }}" alt="Full Image Showcase 6" class="section-bg-img">
      </div>
    </section>

    <!-- SLIDE 14: STEP 7 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">07</span>
          <span class="step-duration">8 WEEKS</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Roll Out Production</h2>
          <p class="step-text">This stage marks full-scale manufacturing in our advanced production facilities. We apply hand-finished wood joint details and premium upholstery techniques. Detailed step-by-step progress photos can be provided upon request.</p>
        </div>
      </div>
    </section>

    <!-- SLIDE 15: SPACER SHOWCASE 7 (Full Image 8 - eighth_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/eighth_img.webp') }}" alt="Full Image Showcase 7" class="section-bg-img">
      </div>
    </section>

    <!-- SLIDE 16: STEP 8 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">08</span>
          <span class="step-duration">OCEAN OR AIR</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Transport &amp; Shipping</h2>
          <p class="step-text">We pack each product with maximum-protection packaging material. Choose your preferred transport: 6 weeks via secure ocean freight (global) or fast air freight (1-2 weeks in US) directly to your project destination.</p>
        </div>
      </div>
    </section>

    <!-- SLIDE 17: SPACER SHOWCASE 8 (Full Image 9 - nineth_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/nineth_img.webp') }}" alt="Full Image Showcase 8" class="section-bg-img">
      </div>
      <!-- Spec Sheet Floating Layer -->
      <div class="floating-layer layer-center layer-spec-sheet scroll-parallax nine_img_height" data-speed="0.1">
        <img src="{{ asset('frontend_assets/images/about_images/upper_nine_img.webp') }}" alt="Specification layout nine" class="spec-img">
      </div>
    </section>

    <!-- SLIDE 18: STEP 9 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">09</span>
          <span class="step-duration">UPON ARRIVAL</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Delivery &amp; Installation</h2>
          <p class="step-text">Your dedicated Stellar Works project manager will be on-site or in close communication to assist with final destination logistics, smooth customs clearance, white-glove assembly, troubleshooting, and adjustments.</p>
        </div>
      </div>
    </section>

    <!-- SLIDE 19: SPACER SHOWCASE 9 (Full Image 10 - tenth_img.webp clear in gap) -->
    <section class="timeline-section spacer-section">
      <div class="section-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/tenth_img.webp') }}" alt="Full Image Showcase 9" class="section-bg-img">
      </div>
      <!-- Spec Sheet Floating Layer -->
      <div class="floating-layer layer-center layer-spec-sheet scroll-parallax nine_img_height" data-speed="0.1">
        <img src="{{ asset('frontend_assets/images/about_images/upper_ten_img.webp') }}" alt="Specification layout ten" class="spec-img">
      </div>
    </section>

    <!-- SLIDE 20: STEP 10 (Pure White Card, No Image bottom) -->
    <section class="timeline-section step-section">
      <div class="step-card">
        <div class="step-header">
          <span class="step-number">10</span>
          <span class="step-duration">ONGOING</span>
        </div>
        <div class="step-body">
          <h2 class="step-title">Post Delivery Support</h2>
          <p class="step-text">Our support never stops. Stellar Works stands firmly behind every handcrafted piece, offering an industry-leading standard 5-year commercial furniture structural warranty to ensure lifelong quality.</p>
        </div>
      </div>
    </section>

    <!-- SLIDE 21: CTA FULL SCREEN LANDING (No Card, Last Image as Background with content on top) -->
    <section class="timeline-section cta-section">
      <div class="cta-bg-wrapper">
        <img src="{{ asset('frontend_assets/images/about_images/last_background_img.webp') }}" alt="Bespoke Guide CTA Background" class="cta-bg-img">
      </div>
      <div class="cta-overlay-dark"></div>

      <div class="cta-card glass-glow">
        <span class="cta-subtitle">Ready to Begin?</span>
        <h2 class="cta-title">Bespoke Process Guide</h2>
        <p class="cta-text">Download our detailed PDF guide which aggregates dimensions, material standards, and technical engineering workflows to get started today.</p>
        
        <a href="https://cdn.prod.website-files.com/666864cc2e2e84bfc95881ec/69a8b04a03df4360a539fe64_Ver4_OnePager_compressed%20(1).pdf" target="_blank" class="download-btn">
          <svg viewBox="0 0 24 24" width="20" height="20" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="download-icon">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3"/>
          </svg>
          <span>Download Process PDF</span>
        </a>
      </div>
    </section>

  </main>

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
  <script src="{{ asset('frontend_assets/js/about/script_v2.js') }}"></script>
</body>
</html>

