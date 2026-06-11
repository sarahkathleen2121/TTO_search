@extends('frontend.layouts.master')

@section('title', 'Corporate Social Responsibility')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/csr.css') }}?v={{ time() }}">
    <!-- Hero Section (Grayscale Left-Edge layout) -->
    <section class="csr-hero-wrapper">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-center">
                <!-- Left side: Image (touches left edge) -->
                <div class="col-lg-6">
                    <div class="csr-img-container">
                        <img src="{{ asset('frontend_assets/images/csr.png') }}" class="csr-img" alt="Corporate Social Responsibility">
                    </div>
                </div>
                <!-- Right side: Content -->
                <div class="col-lg-6">
                    <div class="csr-content-container">
                        <div class="csr-breadcrumb"><a href="{{ route('home') }}">Home</a> / CSR</div>
                        <h1 class="csr-title">Corporate Social<br />Responsibility</h1>
                        <p class="csr-text">At The Total Office, our commitment to people and planet goes beyond the products we supply. We believe business done right means giving back - to communities, to the environment, and to the people who make it all possible. From global water initiatives to local community events, doing right by people is part of who we are.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Introduction -->
    <section class="csr-intro">
        <div class="container">
            <h3 class="csr-intro-title">Introduction</h3>
            <div class="row mt-4 g-4 align-items-start">
                <div class="col-md-6">
                    <p class="csr-intro-text">The Total Office is dedicated to operating responsibly across every dimension of our business. From the suppliers we partner with to the workplaces we help design, our decisions are guided by a commitment to safety, equality, and environmental stewardship. We don't just build better workspaces - we strive to be a better business.</p>
                </div>
                <div class="col-md-6">
                    <p class="csr-intro-text">Our commitments to Health & Safety, Equal Opportunity, and Environmental management are not just policies on paper - they are actively upheld, reviewed annually, and embedded into how we work every day. We hold ourselves accountable to the communities we serve, the teams we employ, and the environment we all share.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Accomplishments list -->
    <section class="csr-acc">
        <div class="container">
            <h3>Our Commitments</h3>
            <div class="csr-row row g-3 align-items-start">
                <div class="col-2 col-md-1 csr-num">01</div>
                <div class="col-10 col-md-3 csr-name">Clean Water for Communities</div>
                <div class="col-12 col-md-8 csr-desc">The Total Office has proudly supported SURGE since 2013, when its Middle East Chapter was first established. SURGE is dedicated to delivering sustainable safe water, sanitation, and hygiene solutions to underserved communities - changing the world, one drop at a time. Their work spans the Dominican Republic, Haiti, the Philippines, and Uganda, addressing some of the most critical water and sanitation challenges facing communities today. Our support is a long-standing commitment we are proud to continue year after year.</div>
            </div>
            <div class="csr-row row g-3 align-items-start">
                <div class="col-2 col-md-1 csr-num">02</div>
                <div class="col-10 col-md-3 csr-name">Community Events & Giving</div>
                <div class="col-12 col-md-8 csr-desc">We are strong believers in the power of community, which is why we actively participate in charity events and initiatives alongside the Sparkle Foundation. Whether it's the Hatta Hike, 5K and 10K runs, padel tournaments, or cricket matches - when industry events are hosted in partnership with Sparkle, The Total Office shows up. With 10 to 20 team members participating in each event, TTO covers all participation fees and contributes through sponsorships and donations to support the causes behind every event. It's not just about the activity - it's about showing up for something bigger.</div>
            </div>
            <div class="csr-row row g-3 align-items-start">
                <div class="col-2 col-md-1 csr-num">03</div>
                <div class="col-10 col-md-3 csr-name">Health & Safety First</div>
                <div class="col-12 col-md-8 csr-desc">The wellbeing of our people is non-negotiable. The Total Office is committed to providing and maintaining a healthy, safe, and secure working environment for every employee, visitor, and partner who walks through our doors. We proactively identify hazards, assess risks, and put measures in place to protect everyone connected to our business. Our teams are regularly informed, trained, and supported - and our Health & Safety policies are reviewed annually to ensure we are always improving, always adapting, and never complacent.</div>
            </div>
            <div class="csr-row row g-3 align-items-start">
                <div class="col-2 col-md-1 csr-num">04</div>
                <div class="col-10 col-md-3 csr-name">Equal Opportunity Employer</div>
                <div class="col-12 col-md-8 csr-desc">At The Total Office, we believe the best ideas come from diverse teams. We are firmly committed to equal opportunity in employment - regardless of age, gender, marital status, disability, race, nationality, or ethnic origin. This commitment applies at every stage: recruitment, training, promotion, and beyond. We advertise roles widely, evaluate candidates on merit alone, and hold every member of our team to the same standard of respect and fairness. Discrimination and harassment of any kind are taken extremely seriously and have no place in our culture.</div>
            </div>
        </div>
    </section>

    <!-- Closing CTA Section -->
    <section class="csr-cta">
        <div class="container text-center">
            <p class="csr-cta-text">We're always open to collaborating on meaningful causes. If you're organising a community initiative or charitable event and would like The Total Office to be part of it, we'd love to hear from you.</p>
            <a href="{{ route('contact') }}" class="csr-cta-btn">Get In Touch</a>
        </div>
    </section>

@endsection
