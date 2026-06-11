@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/services.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/homepage.css') }}">
    <!-- Hero Section -->
    <section class="services-hero">
        <div class="container">
            <div class="services-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / Services
            </div>

            <div class="services-subtitle">
                Select what you are looking for and we will
                prepare appropriate selection for you
            </div>

            <div class="services-main-heading">
                <div class="services-heading-line">
                    <span>I'm looking for</span>
                    <span class="services-highlight">Design</span>
                    <span>Services</span>
                </div>
                <div class="services-heading-line">
                    <span>for a</span>
                    <span class="services-highlight">Open-space</span>
                    <span>Office-type</span>
                </div>
                <div class="services-heading-line">
                    <span>for my</span>
                    <span class="services-highlight">Medium-sized</span>
                    <span>Company</span>
                </div>
            </div>

            <button class="services-btn" onclick="window.location.href='{{ route('contact') }}'">Book a meeting</button>
        </div>
    </section>

    <div class="services-footer-text">
        See our Services for you below
    </div>

    <!-- Services Content Section -->
    <section class="services-content">
        <div class="container">
            <div class="services-content-container">
                <div class="services-content-left">
                    <h2 class="services-content-title">The balance between high-<br>end luxury and top-notch<br>functionality</h2>
                    <p class="services-content-text mt-3">
                        Separated they live in Bookmarks right at the coast of<br>the famous Semantics, large language ocean<br>Separated they live in Bookmarks right
                    </p>
                </div>
                <div class="services-content-right">
                    <div class="services-illustration-circle">
                        <img src="{{ asset('frontend_assets/images/balance_between.png') }}" alt="Illustration" class="services-content-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Content Section Alternate (Mirrored) -->
    <section class="services-content services-content-alt">
        <div class="container">
            <div class="services-content-container services-content-container-alt">
                <div class="services-content-left-alt">
                    <div class="services-content-illustration">
                        <img src="{{ asset('frontend_assets/images/impression.png') }}" alt="Illustration" class="services-content-img" />
                    </div>
                </div>
                <div class="services-content-right-alt">
                    <h2 class="services-content-title">The impression is made from the first seconds</h2>
                    <p class="services-content-text">
                        Separated they live in Bookmarks right at the coast of the famous Semantics, large language ocean
                    
                        Separated they live in Bookmarks right
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services List Section -->
    <section class="services-list-section">
        <div class="container">
            <div class="services-list-container">
                <div class="services-list-left">
                    <h2 class="services-list-title">Services</h2>
                    <p class="services-list-description">
                        Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                    </p>
                    <div class="services-list-columns">
                        <div class="services-list-column">
                            <a href="#" class="services-list-item">
                                <span>Specification & Finishes Selection</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="#" class="services-list-item">
                                <span>Space Planning</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="#" class="services-list-item">
                                <span>MoodBoards</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="#" class="services-list-item">
                                <span>Ergonomics Consultancy</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <div class="services-list-column">
                            <a href="#" class="services-list-item">
                                <span>LEED Process</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="#" class="services-list-item">
                                <span>Procurement and Installation</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                            <a href="#" class="services-list-item">
                                <span>Acoustic Review</span>
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="services-list-right">
                    <div class="services-list-illustration">
                        <img src="{{ asset('frontend_assets/images/services.png') }}" alt="Illustration" class="services-content-img" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Process Section -->
    <section class="services-process-section">
        <div class="container">
            <div class="services-process-container">
                <div class="services-process-left">
                    <div class="services-process-illustration">
                        <img src="{{ asset('frontend_assets/images/ideal_work.png') }}" alt="Illustration" class="services-content-img" />
                    </div>
                </div>
                <div class="services-process-right">
                    <h2 class="services-process-title">The Ideal workspace : Our six step unique process</h2>
                    <p class="services-process-text">
                        Separated they live in Bookmarks right at the coast of the famous Semantics, large language ocean
                    
                        Separated they live in Bookmarks right
                    </p>
                    <a href="{{ route('ideal.workspace') }}" class="services-process-link">
                        <span>Explore More</span>
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    

    <section class="services-slider-section" style="overflow: hidden;">
        <div class="container">
            <div class="services-slider-header">
                <h2 class="services-slider-title">Moodboards</h2>
                <button class="services-slider-btn" onclick="window.location.href='{{ route('moodboards') }}'">SEE ALL</button>
            </div>
        </div>
        <div class="services-slider-container">
            <div class="swiper services-swiper">
                <div class="swiper-wrapper">
                    @foreach($moodboards as $moodboard)
                        <div class="swiper-slide">
                            <div class="moodboard-card">
                                <div class="moodboard-img-container">
                                    @if($moodboard->image)
                                        <img src="{{ $moodboard->imageUrl() }}" alt="{{ $moodboard->title }}">
                                    @endif
                                    <span class="moodboard-bookmark">
                                        <i class="fa-regular fa-bookmark"></i>
                                    </span>
                                </div>
                                <h3 class="moodboard-title">{{ $moodboard->title }}</h3>
                                <p class="moodboard-description">{{ $moodboard->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@include('frontend.partials.call_to_action')
    <script>
        // Testimonials slider state
        let currentTestimonialIndex = 0;
        const testimonialCards = document.querySelectorAll('.testimonial-card');
        const totalTestimonials = testimonialCards.length;

        function updateTestimonialSlider() {
            const slider = document.getElementById('testimonialsSlider');
            const offset = -currentTestimonialIndex * 100;
            slider.style.transform = `translateX(${offset}%)`;
        }

        function slideTestimonialLeft() {
            currentTestimonialIndex = (currentTestimonialIndex - 1 + totalTestimonials) % totalTestimonials;
            updateTestimonialSlider();
        }

        function slideTestimonialRight() {
            currentTestimonialIndex = (currentTestimonialIndex + 1) % totalTestimonials;
            updateTestimonialSlider();
        }

        // Case Studies slider functions
        function slideLeft() {
            const slider = document.getElementById('caseStudiesSlider');
            slider.scrollBy({
                left: -400,
                behavior: 'smooth'
            });
        }

        function slideRight() {
            const slider = document.getElementById('caseStudiesSlider');
            slider.scrollBy({
                left: 400,
                behavior: 'smooth'
            });
        }

        function playVideo() {
            // Replace with your actual video URL
            const videoUrl = 'https://www.youtube.com/embed/dQw4w9WgXcQ';
            const modal = document.createElement('div');
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

            const videoFrame = document.createElement('div');
            videoFrame.style.cssText = `
                width: 90%;
                max-width: 900px;
                aspect-ratio: 16 / 9;
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

            modal.onclick = function (e) {
                if (e.target === modal) modal.remove();
            };
        }

        function toggleMainContainer(event) {
            event.preventDefault();
            const mainContainer = document.querySelector('.main-container');
            mainContainer.classList.toggle('show');

            // Show the first item's dropdown when opening
            if (mainContainer.classList.contains('show')) {
                const firstItem = document.querySelector('.sidebar-item.active');
                if (firstItem) {
                    firstItem.click();
                }
            }
        }

        const dropdownData = {
            products: {
                col1: { title: 'Shop by Product', items: ['Furniture', 'Acoustic Products', 'Writable Surfaces', 'Fabrics', 'Greenwalls'] },
                col2: { title: 'Discover All', items: ['Furniture', 'Acoustic Products', 'Writable Surfaces', 'Fabrics', 'Greenwalls'] },
                text: 'Products'
            },
            brand: {
                col1: { title: 'Shop by Brand', items: ['Patra', 'Emmegi', 'Arper', 'JMM', 'Infiniti Design', 'Teknion', 'Manerba', 'MDD'] },
                col2: { title: '', items: [] },
                text: 'Brands'
            },
            space: {
                col1: { title: 'Shop by Space', items: ['Conference Rooms', 'Office Cabins', 'Work Spaces', 'Cafe Space'] },
                col2: { title: '', items: [] },
                text: 'Spaces'
            }
        };

        function showDropdown(type, event) {
            event.preventDefault();

            // Update sidebar active state
            document.querySelectorAll('.sidebar-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.closest('.sidebar-item').classList.add('active');

            // Update dropdown content
            const dropdown = document.getElementById('productsDropdown');
            const contentText = document.getElementById('contentText');
            const data = dropdownData[type];

            contentText.textContent = data.text;

            // Build dropdown HTML
            let dropdownHTML = `
                <div class="dropdown-column">
                    <div class="dropdown-title">${data.col1.title}</div>
                    ${data.col1.items.map(item => `<a href="#" class="dropdown-item">${item}</a>`).join('')}
                </div>
            `;

            if (data.col2.title) {
                dropdownHTML += `
                <div class="dropdown-column">
                    <div class="dropdown-title">${data.col2.title}</div>
                    ${data.col2.items.map(item => `<a href="#" class="dropdown-item">${item}</a>`).join('')}
                </div>
                `;
            }

            dropdownHTML += `<div class="dropdown-column"><div style="height: 100%; background-color: var(--light-bg); border-radius: 0px;"></div></div>`;

            dropdown.innerHTML = dropdownHTML;
            dropdown.classList.remove('hide');
            dropdown.classList.add('show');
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
                new Swiper('.services-swiper', {
                    slidesPerView: 3.8,
                    spaceBetween: 24,
                    centeredSlides: true,
                    loop: true,
                    initialSlide: 1,
                    speed: 800,
                    autoplay: {
                        delay: 2500,
                        disableOnInteraction: false,
                    },
                    breakpoints: {
                        0: { 
                            slidesPerView: 1.5,
                            spaceBetween: 16
                        },
                        576: { 
                            slidesPerView: 2.5,
                            spaceBetween: 20
                        },
                        992: { 
                            slidesPerView: 3.8,
                            spaceBetween: 24
                        }
                    }
                });
            }
        });
    </script>
    @endsection
