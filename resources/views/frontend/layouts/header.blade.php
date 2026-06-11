<header class="main_header">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid px-4 px-lg-5 align-items-end">
            <!-- Left side: Logo -->
            <a class="navbar-brand m-0 p-0" href="{{ route('home') }}">
                <img class="logo_img" src="{{ asset('frontend_assets/images/logo.png') }}" alt="Logo">
            </a>

            <!-- Mobile: quick icons + hamburger -->
            <div class="header-mobile-actions d-flex d-lg-none align-items-center ms-auto">
                <button type="button" class="mobile-icon-btn header-ai-search-btn" data-bs-toggle="modal" data-bs-target="#aiSearchModal" aria-label="AI Search">
                    <i class="fas fa-wand-magic-sparkles"></i>
                </button>
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <!-- Right side: Menu and Icons -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="d-flex flex-column align-items-lg-end w-100 ms-lg-auto mt-1 mt-lg-0">
                    
                    <!-- AI Search (desktop) -->
                    <div class="navbar-icons mb-2 mt-2 mb-lg-3 d-none d-lg-flex align-items-center justify-content-lg-end">
                        <button type="button" class="header-ai-search-btn header-ai-search-btn--desktop" data-bs-toggle="modal" data-bs-target="#aiSearchModal" aria-label="AI Search">
                            <i class="fas fa-wand-magic-sparkles"></i>
                            <span>AI Search</span>
                        </button>
                    </div>

                    <!-- Bottom Menu Row -->
                    <ul class="navbar-nav align-items-start align-items-lg-center mt-2">
                        <li class="nav-item">
                            <a id="navServices" class="nav-link d-none d-lg-block" href="{{ route('services') }}">Services</a>
                            <button type="button" class="nav-link mobile-nav-toggle d-lg-none" data-submenu="mobileServicesSubmenu" aria-expanded="false">
                                Services <i class="fas fa-chevron-down mobile-nav-chevron"></i>
                            </button>
                            <ul class="mobile-submenu d-lg-none" id="mobileServicesSubmenu">
                                <li><a href="{{ route('service.listing') }}">Service Listing</a></li>
                                <li><a href="{{ route('ideal.workspace') }}">The Ideal Workspace</a></li>
                                <li><a href="{{ route('moodboards') }}">Moodboards</a></li>
                                <li><a href="{{ route('services') }}" class="mobile-submenu-view-all">View All Services</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a id="navProducts" class="nav-link d-none d-lg-block" href="{{ route('products.type') }}">Products</a>
                            <button type="button" class="nav-link mobile-nav-toggle d-lg-none" data-submenu="mobileProductsSubmenu" aria-expanded="false">
                                Products <i class="fas fa-chevron-down mobile-nav-chevron"></i>
                            </button>
                            <ul class="mobile-submenu d-lg-none" id="mobileProductsSubmenu">
                                <li><a href="{{ route('products.type') }}">Shop by Product</a></li>
                                <li><a href="{{ route('shop.by.brands') }}">Shop by Brand</a></li>
                                <li><a href="{{ route('shop.by.space') }}">Shop by Space</a></li>
                                <li><a href="{{ route('all.products') }}" class="mobile-submenu-view-all">See All Products</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('initiatives') }}">Initiatives</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">About</a>
                        </li>
                        <li class="nav-item ms-lg-3 mt-3 mt-lg-0 nav-item--book">
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
    // Hover-driven dropdowns for navbar (desktop only)
    (function() {
        const servicesLink = document.getElementById("navServices");
        const productsLink = document.getElementById("navProducts");
        const servicesPanel = document.getElementById("servicesPanel");
        const productsPanel = document.querySelector(".main-container");
        const productsDropdown = document.getElementById("productsDropdown");
        const navbarCollapse = document.getElementById("navbarNav");
        const mainHeader = document.querySelector("header.main_header");
        const desktopMq = window.matchMedia("(min-width: 992px)");

        let hideServicesTO, hideProductsTO;

        function isDesktopNav() {
            return desktopMq.matches;
        }

        function updateHeaderHeight() {
            if (!mainHeader) return;
            document.documentElement.style.setProperty("--header-height", mainHeader.offsetHeight + "px");
        }

        updateHeaderHeight();
        window.addEventListener("resize", updateHeaderHeight);

        function showServices() {
            if (!isDesktopNav()) return;
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
            if (!isDesktopNav()) return;
            clearTimeout(hideProductsTO);
            productsDropdown && productsDropdown.classList.remove("hide");
            productsPanel.classList.add("show");
        }

        function hideProducts() {
            hideProductsTO = setTimeout(
                () => productsPanel.classList.remove("show"),
                120
            );
        }

        function closeMegaPanels() {
            servicesPanel && servicesPanel.classList.remove("show");
            productsPanel && productsPanel.classList.remove("show");
        }

        // Services hover
        if (servicesLink && servicesPanel) {
            servicesLink.addEventListener("mouseenter", () => {
                showServices();
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

        // Mobile submenu toggles
        document.querySelectorAll(".mobile-nav-toggle").forEach((toggle) => {
            toggle.addEventListener("click", () => {
                const submenuId = toggle.getAttribute("data-submenu");
                const submenu = document.getElementById(submenuId);
                const isOpen = toggle.getAttribute("aria-expanded") === "true";

                document.querySelectorAll(".mobile-nav-toggle").forEach((other) => {
                    if (other !== toggle) {
                        other.setAttribute("aria-expanded", "false");
                        const otherSub = document.getElementById(other.getAttribute("data-submenu"));
                        otherSub && otherSub.classList.remove("open");
                    }
                });

                toggle.setAttribute("aria-expanded", isOpen ? "false" : "true");
                submenu && submenu.classList.toggle("open", !isOpen);
            });
        });

        function closeMobileMenu() {
            if (!navbarCollapse || isDesktopNav() || !navbarCollapse.classList.contains("show")) return;
            const bsCollapse = bootstrap.Collapse.getInstance(navbarCollapse) || new bootstrap.Collapse(navbarCollapse, { toggle: false });
            bsCollapse.hide();
        }

        // Close mobile menu on navigation or CTA click
        if (navbarCollapse) {
            navbarCollapse.querySelectorAll(".mobile-submenu a, .nav-link:not(.mobile-nav-toggle), .btn-book").forEach((link) => {
                link.addEventListener("click", closeMobileMenu);
            });
        }

        desktopMq.addEventListener("change", () => {
            closeMegaPanels();
            document.querySelectorAll(".mobile-submenu").forEach((sub) => sub.classList.remove("open"));
            document.querySelectorAll(".mobile-nav-toggle").forEach((toggle) => toggle.setAttribute("aria-expanded", "false"));
            document.body.classList.remove("mobile-menu-open");
        });

        if (navbarCollapse) {
            navbarCollapse.addEventListener("shown.bs.collapse", () => {
                if (!isDesktopNav()) {
                    updateHeaderHeight();
                    document.body.classList.add("mobile-menu-open");
                }
            });
            navbarCollapse.addEventListener("hidden.bs.collapse", () => {
                document.body.classList.remove("mobile-menu-open");
                document.querySelectorAll(".mobile-submenu").forEach((sub) => sub.classList.remove("open"));
                document.querySelectorAll(".mobile-nav-toggle").forEach((toggle) => toggle.setAttribute("aria-expanded", "false"));
            });
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
