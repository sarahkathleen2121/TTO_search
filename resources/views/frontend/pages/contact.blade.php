@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/contact.css') }}">
    <!-- Hero -->
    <section class="ct-hero">
        <div class="container">
            <div class="ct-breadcrumb"><a href="{{ route('home') }}">Home</a> / Contact Us</div>
            <h1 class="ct-title">Contact Us</h1>
            <p class="ct-sub">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia
                consequat.</p>
        </div>
    </section>

    <!-- CTA split -->
    <div class="ct-cta">
        <a href="#"><span>Book a call</span> <i class="fas fa-arrow-right"></i></a>
        <a href="#"><span>Schedule a visit</span> <i class="fas fa-arrow-right"></i></a>
    </div>

    <!-- Head office + form -->
    <section class="ct-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-6">
                    <h3 class="ct-h3">Our Head Office</h3>
                    <div class="ct-map">
                        <iframe 
                            src="https://maps.google.com/maps?q=1702%20Grosvenor%20Business%20Tower%2C%20Barsha%20Heights%2C%20Dubai%20UAE&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    <div class="row g-4 mt-3 ct-address">
                        <div class="col-md-6">
                            <h5>Physical address</h5>
                            <p><strong>Dubai Head Office</strong><br />1702, Grosvenor Business Tower<br />Barsha Heights (TECOM)<br />Dubai, UAE</p>
                            <p>Open from 8:30am to 5:30pm (Mon-Fri)</p>
                            <p>Tel: +971 4 450 8700</p>
                            <p>info@thetotaloffice.com</p>
                        </div>
                        <div class="col-md-6">
                            <h5>Abu Dhabi Office</h5>
                            <p>3rd Floor, Al Saman Tower<br />Intersection of Hamdan St. & Muroor St.<br />Abu Dhabi, UAE</p>
                            <p>Open from 8:30am to 5:30pm (Mon-Fri)</p>
                            <p>Tel: +971 2 635 5588</p>
                            <p>abudhabi@thetotaloffice.com</p>
                        </div>
                    </div>

                    <!-- Sharjah -->
                    <div class="ct-address mt-4">
                        <h5>Sharjah Office</h5>
                        <p>Industrial Area 13<br />Sharjah, UAE</p>
                        <p>Open from 8:30am to 5:30pm (Mon-Fri)</p>
                        <p>Tel: +971 6 544 0663</p>
                        <p>sharjah@thetotaloffice.com</p>
                    </div>
                </div>

                <!-- Form -->
                <div class="col-lg-6">
                    <h3 class="ct-h3">Stay In Touch</h3>
                    <form id="contactForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6"><input class="form-control" placeholder="First name" required /></div>
                            <div class="col-md-6"><input class="form-control" placeholder="Last name" required /></div>
                            <div class="col-12"><input type="email" class="form-control" placeholder="Your Email"
                                    required /></div>
                            <div class="col-12"><input class="form-control" placeholder="Subject" /></div>
                            <div class="col-12">
                                <textarea class="form-control" placeholder="Your Message"></textarea>
                            </div>
                            <div class="col-12"><button class="ct-submit" type="submit">Submit</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Middle banner -->
    <section class="ct-section">
        <div class="container">
            <div class="ct-banner" style="background-image: url('{{ asset('frontend_assets/images/contact_team.png') }}');"></div>
        </div>
    </section>

    <!-- Showrooms -->
    <section class="ct-show">
        <div class="container">
            <h4>Showrooms</h4>
            <div class="row g-4 ct-address">
                <div class="col-md-6">
                    <h5>Dubai Showroom</h5>
                    <p>1702, Grosvenor Business Tower<br />Barsha Heights (TECOM)<br />Dubai, UAE</p>
                    <p>Open from 8:30am to 5:30pm (Mon-Fri)</p>
                    <p>Tel: +971 4 450 8700</p>
                    <p>info@thetotaloffice.com</p>
                </div>
                <div class="col-md-6">
                    <h5>Abu Dhabi Showroom</h5>
                    <p>3rd Floor, Al Saman Tower<br />Intersection of Hamdan St. & Muroor St.<br />Abu Dhabi, UAE</p>
                    <p>Open from 8:30am to 5:30pm (Mon-Fri)</p>
                    <p>Tel: +971 2 635 5588</p>
                    <p>abudhabi@thetotaloffice.com</p>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thanks! We\'ll get back to you shortly.');
            this.reset();
        });
    </script>
@endsection
