@extends('frontend.layouts.master')
@section('title', 'Sustainability')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/sustainability.css') }}?v={{ time() }}">

    <!-- Hero Section (Left-Edge layout) -->
    <section class="su-hero-wrapper">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-center">
                <!-- Left side: Image (touches left edge) -->
                <div class="col-lg-6">
                    <div class="su-img-container">
                        <img src="{{ asset('frontend_assets/images/sustainability_hero.png') }}" class="su-img" alt="Sustainability">
                    </div>
                </div>
                <!-- Right side: Content -->
                <div class="col-lg-6">
                    <div class="su-content-container">
                        <div class="su-breadcrumb"><a href="{{ route('home') }}">Home</a> / Sustainability</div>
                        <h1 class="su-title">Sustainability</h1>
                        <p class="su-text">At The Total Office, sustainability is not an afterthought - it is a standard we hold ourselves and our partners to at every level of our business. From certified supply chains to accredited facilities, we are committed to delivering workspaces that are as responsible as they are exceptional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="su-intro">
        <div class="container">
            <h3 class="su-intro-title">Introduction</h3>
            <div class="row mt-4 g-4 align-items-start">
                <div class="col-md-6">
                    <p class="su-intro-text">Our approach to sustainability is built on measurable commitments. 80% of our suppliers source wood from FSC or PEFC certified forests, our facilities in Dubai and Abu Dhabi are LEED accredited, and the manufacturers we represent carry internationally recognised green building certifications. Every product we specify and every space we deliver is held to a standard that goes beyond aesthetics.</p>
                </div>
                <div class="col-md-6">
                    <p class="su-intro-text">Sustainability also lives within our own operations. All our facilities operate active recycling programs in partnership with BEE'AH Tandeef, ensuring responsible waste management across our business. Our in-house team includes 7 LEED Green Associates and 2 WELL AP accredited professionals - ensuring that the advice and solutions we bring to our clients are backed by certified expertise, not just good intentions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Accomplishments list -->
    <section class="su-acc">
        <div class="container">
            <h3>Our Sustainability Standards</h3>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">01</div>
                <div class="col-10 col-md-3 su-name">Certified Supply Chain</div>
                <div class="col-12 col-md-8 su-desc">Responsible sourcing is the foundation of everything we do. 80% of our suppliers use wood sourced exclusively from FSC or PEFC certified forests - meaning the materials behind our products come from responsibly managed sources that protect biodiversity, workers' rights, and the long-term health of our forests. We actively evaluate and select manufacturing partners based on their environmental credentials, ensuring our supply chain reflects the same standards we promote to our clients.</div>
            </div>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">02</div>
                <div class="col-10 col-md-3 su-name">LEED Accredited Facilities</div>
                <div class="col-12 col-md-8 su-desc">Our facilities in both Dubai and Abu Dhabi are LEED accredited, reflecting our commitment to operating out of spaces that meet the highest green building standards. LEED accreditation is one of the most widely recognised marks of sustainable building performance globally - covering energy efficiency, water conservation, indoor environmental quality, and responsible material use. We don't just specify green buildings for our clients - we operate in them.</div>
            </div>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">03</div>
                <div class="col-10 col-md-3 su-name">Qualified Sustainability Professionals</div>
                <div class="col-12 col-md-8 su-desc">Sustainability expertise at The Total Office goes beyond policy - it is represented by our people. Our team includes 7 LEED Green Associates and 2 WELL AP accredited professionals, equipping us to provide informed, credible guidance on green building and human-centric design. Whether advising on product specifications, certification requirements, or sustainable workspace strategies, our team brings accredited knowledge to every client engagement.</div>
            </div>
            <div class="su-row row g-3 align-items-start">
                <div class="col-2 col-md-1 su-num">04</div>
                <div class="col-10 col-md-3 su-name">Recycling & Waste Management</div>
                <div class="col-12 col-md-8 su-desc">In partnership with BEE'AH Tandeef, all Total Office facilities operate structured recycling programs designed to minimise waste and reduce our environmental footprint. We recognise that sustainability does not end at the product level - it extends to how we run our day-to-day operations. From responsible disposal of materials to minimising single-use waste across our offices, we are committed to continuous improvement in how we manage our environmental impact.</div>
            </div>
        </div>
    </section>

    <!-- Manufacturer Certifications -->
    <section class="su-certs">
        <div class="container">
            <h3>Our Partners' Green Credentials</h3>
            <p class="su-certs-intro">The manufacturers we represent are held to the same sustainability standards we uphold internally. Below is a selection of our manufacturing partners and their recognised certifications.</p>
            
            <div class="su-table-responsive">
                <table class="su-table">
                    <thead>
                        <tr>
                            <th>Manufacturer</th>
                            <th>Sustainability Certifications</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Andreu World</strong></td>
                            <td>ISO & GRI, FSC, BIFMA Level, Indoor Air Quality, C2C & OK Biobased</td>
                        </tr>
                        <tr>
                            <td><strong>Arper</strong></td>
                            <td>ISO & EPD, FSC, GreenGuard & GECA</td>
                        </tr>
                        <tr>
                            <td><strong>B&T Design</strong></td>
                            <td>ISO, FSC, Indoor Air Quality, Individual Product Certificates</td>
                        </tr>
                        <tr>
                            <td><strong>Boss Design</strong></td>
                            <td>ISO, FSC, PEFC, Declare, Intertek Clean Air Gold & BIFMA/ANSI Compliant</td>
                        </tr>
                        <tr>
                            <td><strong>Humanscale</strong></td>
                            <td>ISO 26000 & GRI, FSC, BIFMA Level, Declare, Living Product Challenge, SCS Indoor Advantage Gold, HPD & LCA</td>
                        </tr>
                        <tr>
                            <td><strong>Inclass</strong></td>
                            <td>ISO, FSC & GreenGuard</td>
                        </tr>
                        <tr>
                            <td><strong>Orangebox</strong></td>
                            <td>ISO, FSC, PEFC, Intertek Clean Air, FIRA & SCS Product Certification</td>
                        </tr>
                        <tr>
                            <td><strong>Patra</strong></td>
                            <td>ISO, GreenGuard, CATAS, ANSI/BIFMA & Various Product Awards</td>
                        </tr>
                        <tr>
                            <td><strong>Pedrali</strong></td>
                            <td>ISO & Carbon Footprint, FSC & GreenGuard</td>
                        </tr>
                        <tr>
                            <td><strong>Teknion</strong></td>
                            <td>ISO, FSC, DfE, GreenGuard, BIFMA Level, Declare, SCS Green Certificates</td>
                        </tr>
                        <tr>
                            <td><strong>Wilkhahn</strong></td>
                            <td>ISO, FSC & GreenGuard</td>
                        </tr>
                        <tr>
                            <td><strong>Woven Image</strong></td>
                            <td>EPD & Global Green Tag</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Closing CTA Section -->
    <section class="su-cta">
        <div class="container text-center">
            <p class="su-cta-text">Looking to achieve green building certification for your next project? Our accredited team is here to help you specify the right products and make informed, sustainable choices from the start.</p>
            <a href="{{ route('contact') }}" class="su-cta-btn">Speak to Our Team</a>
        </div>
    </section>

@endsection
