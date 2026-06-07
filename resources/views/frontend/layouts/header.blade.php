<header class="main_header">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-4 px-lg-5 align-items-end">
            <!-- Left side: Logo -->
            <a class="navbar-brand m-0 p-0" href="{{ route('home') }}">
                <img class="logo_img" src="{{ asset('frontend_assets/images/logo.png') }}" alt="Logo">
            </a>

            <!-- Mobile toggle button -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Right side: Menu and Icons -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex flex-column align-items-lg-end w-100 ms-lg-auto mt-3 mt-lg-0">
                    
                    <!-- Top Icons Row -->
                    <div class="navbar-icons mb-2 mt-2 mb-lg-3 d-flex align-items-center justify-content-start justify-content-lg-end gap-2 gap-lg-3">
                        <a href="{{ route('search.results') }}" class="search-btn text-decoration-none">
                            <i class="fas fa-search"></i> Search
                        </a>
                        <a href="{{ route('enquiry.basket') }}" class="cart-btn position-relative">
                            <img src="{{ asset('frontend_assets/images/cart.png') }}" alt="Cart">
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="basket-badge" style="font-size: 0.6rem; {{ count(session('enquiry_basket', [])) == 0 ? 'display: none;' : '' }}">
                                {{ array_sum(array_column(session('enquiry_basket', []), 'qty')) }}
                            </span>
                        </a>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" class="user-btn">
                            <img src="{{ asset('frontend_assets/images/user.png') }}" alt="User">
                        </a>
                    </div>

                    <!-- Bottom Menu Row -->
                    <ul class="navbar-nav align-items-start align-items-lg-center mt-2">
                        <li class="nav-item">
                            <a id="navServices" class="nav-link" href="{{ route('services') }}">Services</a>
                        </li>
                        <li class="nav-item">
                            <a id="navProducts" class="nav-link" href="{{ route('products.type') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('initiatives') }}">Initiatives</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('resources') }}">Journal/Blog</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                            <button class="btn btn-book">Book a visit/call</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- Header/Navbar -->

<!-- Services Mega Panel -->
<div id="servicesPanel" class="mega-panel">
    <div class="container custom-mega-container">
        <div class="row px-3">
            <div class="col-lg-4 service-column ps-0">
                <div class="mega-card-title">Service Listing</div>
                <div class="mega-card-desc">
                    Sed et mollis massa, vitae rhoncus nibh. Sed accumsan tincidunt.
                </div>
                <a href="{{ route('service.listing') }}" class="mega-card-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px;"></i></a>
            </div>
            <div class="col-lg-4 service-column">
                <div class="mega-card-title">
                    The Ideal workspace :<br>Our six step unique process
                </div>
                <div class="mega-card-desc">
                    Sed et mollis massa, vitae rhoncus nibh. Sed accumsan tincidunt.
                </div>
                <a href="{{ route('ideal.workspace') }}" class="mega-card-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px;"></i></a>
            </div>
            <div class="col-lg-4 service-column">
                <div class="mega-card-title">Moodboards</div>
                <div class="mega-card-desc">
                    Sed et mollis massa, vitae rhoncus nibh. Sed accumsan tincidunt.
                </div>
                <a href="{{ route('moodboards') }}" class="mega-card-link">Learn More <i class="fas fa-chevron-right" style="font-size: 11px; margin-left: 4px;"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="main-container">
    <div class="custom-mega-container">
        <div class="dropdown-menu-custom hide" id="productsDropdown">
            <div class="mega-sidebar">
                <a href="{{ route('products.type') }}" class="mega-sidebar-item active" data-target="mega-products" onmouseover="switchMegaMenu(event, 'mega-products')">
                    <span class="minus-icon"></span> Shop by Product
                </a>
                <a href="{{ route('shop.by.industry') }}" class="mega-sidebar-item" data-target="mega-industry" onmouseover="switchMegaMenu(event, 'mega-industry')">
                    <span class="minus-icon"></span> Shop by Industry
                </a>
                <a href="{{ route('shop.by.brands') }}" class="mega-sidebar-item" data-target="mega-brand" onmouseover="switchMegaMenu(event, 'mega-brand')">
                    <span class="minus-icon"></span> Shop by Brand
                </a>
                <a href="{{ route('shop.by.space') }}" class="mega-sidebar-item" data-target="mega-space" onmouseover="switchMegaMenu(event, 'mega-space')">
                    <span class="minus-icon"></span> Shop by Space
                </a>
                <div class="mega-see-all-wrapper mt-4">
                    <button class="btn w-100 rounded-0" onclick="window.location.href='{{ route('all.products') }}'" style="padding: 12px; font-weight: 600; font-size: 14px; background-color: #383E42; color: white; border: none;">See All</button>
                </div>
            </div>

            <!-- Hardcoded Content Lists -->
            <div class="mega-content-area">
                
                <!-- Shop by Product -->
                <div id="mega-products" class="mega-content-list active-content">
                    <a href="{{ route('all.products') }}" class="mega-dropdown-item active"><span class="minus-icon" style="display:block;"></span> Discover All</a>
                    @foreach($productTypes as $type)
                    <a href="{{ route('product_type.detail', $type->slug) }}" class="mega-dropdown-item"><span class="minus-icon"></span> {{ $type->name }}</a>
                    @endforeach
                </div>

                <!-- Shop by Industry -->
                <div id="mega-industry" class="mega-content-list">
                    @foreach($industries as $industry)
                    <a href="{{ route('industry.detail', $industry->slug) }}" class="mega-dropdown-item"><span class="minus-icon"></span> {{ $industry->name }}</a>
                    @endforeach
                </div>

                <!-- Shop by Brand -->
                <div id="mega-brand" class="mega-content-list">
                    @foreach($brands as $brand)
                    <a href="{{ route('brand.detail', $brand->slug) }}" class="mega-dropdown-item"><span class="minus-icon"></span> {{ $brand->name }}</a>
                    @endforeach
                </div>

                <!-- Shop by Space -->
                <div id="mega-space" class="mega-content-list">
                    @foreach($spaces as $space)
                    <a href="{{ route('space.detail', $space->slug) }}" class="mega-dropdown-item"><span class="minus-icon"></span> {{ $space->name }}</a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    // Hover-driven dropdowns for navbar
    (function() {
        const servicesLink = document.getElementById("navServices");
        const productsLink = document.getElementById("navProducts");
        const servicesPanel = document.getElementById("servicesPanel");
        const productsPanel = document.querySelector(".main-container");
        const productsDropdown = document.getElementById("productsDropdown");

        let hideServicesTO, hideProductsTO;

        function showServices() {
            clearTimeout(hideServicesTO);
            servicesPanel.classList.add("show");
        }

        function hideServices() {
            hideServicesTO = setTimeout(
                () => servicesPanel.classList.remove("show"),
                120
            );
        }

        function showProducts() {
            clearTimeout(hideProductsTO);
            // ensure inner dropdown visible
            productsDropdown && productsDropdown.classList.remove("hide");
            productsPanel.classList.add("show");
        }

        function hideProducts() {
            hideProductsTO = setTimeout(
                () => productsPanel.classList.remove("show"),
                120
            );
        }

        // Services hover
        if (servicesLink && servicesPanel) {
            servicesLink.addEventListener("mouseenter", () => {
                showServices();
                // hide products if open
                productsPanel.classList.remove("show");
            });
            servicesLink.addEventListener("mouseleave", hideServices);
            servicesPanel.addEventListener("mouseenter", showServices);
            servicesPanel.addEventListener("mouseleave", hideServices);
        }

        // Products hover
        if (productsLink && productsPanel) {
            productsLink.addEventListener("mouseenter", () => {
                showProducts();
                servicesPanel.classList.remove("show");
            });
            productsLink.addEventListener("mouseleave", hideProducts);
            productsPanel.addEventListener("mouseenter", showProducts);
            productsPanel.addEventListener("mouseleave", hideProducts);
        }
    })();

    // Testimonials slider state
    let currentTestimonialIndex = 0;
    const testimonialCards = document.querySelectorAll(".testimonial-card");
    const totalTestimonials = testimonialCards.length;

    function updateTestimonialSlider() {
        const slider = document.getElementById("testimonialsSlider");
        const offset = -currentTestimonialIndex * 100;
        slider.style.transform = `translateX(${offset}%)`;
    }

    function slideTestimonialLeft() {
        currentTestimonialIndex =
            (currentTestimonialIndex - 1 + totalTestimonials) % totalTestimonials;
        updateTestimonialSlider();
    }

    function slideTestimonialRight() {
        currentTestimonialIndex =
            (currentTestimonialIndex + 1) % totalTestimonials;
        updateTestimonialSlider();
    }

    // Case Studies slider functions
    function slideLeft() {
        const slider = document.getElementById("caseStudiesSlider");
        slider.scrollBy({
            left: -400,
            behavior: "smooth",
        });
    }

    function slideRight() {
        const slider = document.getElementById("caseStudiesSlider");
        slider.scrollBy({
            left: 400,
            behavior: "smooth",
        });
    }

    function playVideo() {
        // Replace with your actual video URL
        const videoUrl = "https://www.youtube.com/embed/dQw4w9WgXcQ";
        const modal = document.createElement("div");
        modal.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            `;

        const videoFrame = document.createElement("div");
        videoFrame.style.cssText = `
                width: 90%;
                max-width: 900px;
                aspect-ratio: 22 / 9;
                position: relative;
            `;

        videoFrame.innerHTML = `
                <button onclick="this.closest('div').parentElement.remove()" style="
                    position: absolute;
                    top: -40px;
                    right: 0;
                    background: white;
                    border: none;
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                    cursor: pointer;
                    font-size: 24px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">×</button>
                <iframe width="100%" height="100%" src="${videoUrl}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            `;

        modal.appendChild(videoFrame);
        document.body.appendChild(modal);

        modal.onclick = function(e) {
            if (e.target === modal) modal.remove();
        };
    }

    function toggleMainContainer(event) {
        event.preventDefault();
        const mainContainer = document.querySelector(".main-container");
        mainContainer.classList.toggle("show");
    }

    function switchMegaMenu(event, targetId) {
        event.preventDefault();

        // Remove active class from all side items
        document.querySelectorAll(".mega-sidebar-item").forEach((item) => {
            item.classList.remove("active");
        });
        
        // Add active class to hovered item
        event.target.closest(".mega-sidebar-item").classList.add("active");

        // Hide all lists, show target
        document.querySelectorAll('.mega-content-list').forEach(list => {
            list.classList.remove('active-content');
        });
        
        document.getElementById(targetId).classList.add('active-content');
    }
</script>
