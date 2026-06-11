@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/initiatives.css') }}?v={{ time() }}">
    <!-- Header/Hero -->
    <div class="in-hero-bg">
        <section class="in-nav">
            <div class="container">
                <div class="in-breadcrumb"><a href="{{ route('home') }}">Home</a> / Initiatives</div>
                <h1 class="in-title">Initiatives</h1>
            </div>
        </section>
    </div>

    <!-- Content -->
    <div class="container py-5">
        <div class="in-wrap">
            <div class="in-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <h4 class="in-card-title">CSR</h4>
                    </div>
                    <div class="col-md-9">
                        <p class="in-card-text">At The Total Office, corporate responsibility is woven into the fabric of how we do business. Since 2013, we have supported SURGE in delivering clean water and sanitation to underserved communities across four countries. Closer to home, our team actively participates in charity events and community initiatives alongside the Sparkle Foundation — showing up, giving back, and making an impact beyond the workplace.</p>
                        <a href="{{ route('csr') }}" class="in-link">Explore <span class="ms-1">›</span></a>
                    </div>
                </div>
            </div>

            <div class="in-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <h4 class="in-card-title">Sustainability</h4>
                    </div>
                    <div class="col-md-9">
                        <p class="in-card-text">Sustainability is a standard we hold ourselves and our partners to at every level. 80% of our suppliers source from FSC or PEFC certified forests, our Dubai and Abu Dhabi facilities are LEED accredited, and our team includes 7 LEED Green Associates and 2 WELL AP professionals. Every product we specify and every space we deliver is backed by certified expertise and a genuine commitment to responsible practice.</p>
                        <a href="{{ route('sustainability') }}" class="in-link">Explore <span class="ms-1">›</span></a>
                    </div>
                </div>
            </div>
            <div class="in-card">
                <div class="row g-3">
                    <div class="col-md-3">
                        <h4 class="in-card-title">ESG</h4>
                    </div>
                    <div class="col-md-9">
                        <p class="in-card-text">At The Total Office, ESG is not an initiative — it is how we operate. From reducing our carbon footprint and responsible sourcing, to employee wellbeing and ethical governance, our ESG framework is built on measurable commitments aligned with the UAE's vision for sustainable development. In FY2025, we recorded total emissions of 48.02 tCO₂e and we remain focused on continuous year-on-year improvement across all three pillars.</p>
                        <a href="{{ route('esg') }}" class="in-link">Explore <span class="ms-1">›</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
