@extends('frontend.layouts.master')
@section('title', 'Environmental, Social & Governance (ESG) - The Total Office')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/esg.css') }}?v={{ time() }}">

    <!-- Hero Section (Left-Edge layout) -->
    <section class="esg-hero-wrapper">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-center">
                <!-- Left side: Image (touches left edge) -->
                <div class="col-lg-6">
                    <div class="esg-img-container">
                        <img src="{{ asset('frontend_assets/images/esg.png') }}" class="esg-img" alt="Environmental, Social & Governance (ESG)">
                    </div>
                </div>
                <!-- Right side: Content -->
                <div class="col-lg-6">
                    <div class="esg-content-container">
                        <div class="esg-breadcrumb"><a href="{{ route('home') }}">Home</a> / Environmental, Social & Governance (ESG)</div>
                        <h1 class="esg-title">Environmental, Social<br />& Governance (ESG)</h1>
                        <h4 class="esg-subtitle">Our Commitment to Responsible Business:</h4>
                        <p class="esg-text">At The Total Office, sustainability is not an initiative—it is embedded into how we operate, partner, and grow. We are committed to aligning our business practices with the UAE's vision for sustainable development, focusing on...</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ESG Content Sections -->
    <div class="esg-sections-wrapper">
        <!-- 1. Environmental Responsibility -->
        <section class="esg-section">
            <div class="container">
                <h2 class="esg-sec-title">Environmental Responsibility</h2>
                
                <!-- Row 1: Reducing Impact & Sustainable Sourcing -->
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Reducing Our Environmental Impact:</h4>
                            <p class="esg-block-text">We actively work to minimize our environmental footprint across operations, supply chain, and product lifecycle.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Sustainable Sourcing:</h4>
                            <ul class="esg-list">
                                <li>80% of our suppliers source wood from FSC or PEFC certified forests</li>
                                <li>Preference for partners aligned with sustainable manufacturing and green certifications</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Green Buildings & Waste/Recycling -->
                <div class="row g-5 mt-4">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Green Buildings & Operations:</h4>
                            <ul class="esg-list">
                                <li>Facilities in Dubai and Abu Dhabi are LEED accredited</li>
                                <li>Collaboration with manufacturers that support green building-certified products</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Waste & Recycling:</h4>
                            <ul class="esg-list">
                                <li>All facilities operate structured recycling programs in partnership with BEEAH Tandeef</li>
                                <li>Focus on reducing landfill contribution and improving waste segregation</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. Carbon Footprint Disclosure (FY2025) -->
        <section class="esg-section border-top">
            <div class="container">
                <h2 class="esg-sec-title">Carbon Footprint Disclosure (FY2025)</h2>
                <p class="esg-lead-text">We are committed to transparency in measuring and reporting our emissions.</p>
                
                <div class="esg-block mt-4">
                    <h4 class="esg-block-subtitle">Breakdown:</h4>
                    
                    <div class="mt-4">
                        <h5 class="esg-block-subsubtitle">Scope 1 – Direct Emissions (Fleet Fuel Use)</h5>
                        <ul class="esg-list">
                            <li>Total: 32.67 tCO₂e</li>
                            <li>Source: Company-operated vehicles (diesel and petrol)</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h5 class="esg-block-subsubtitle">Scope 2 – Indirect Emissions (Electricity)</h5>
                        <ul class="esg-list">
                            <li>Total: 15.35 tCO₂e</li>
                            <li>Source: Electricity consumption (38,370 kWh)</li>
                        </ul>
                    </div>
                </div>

                <div class="esg-block mt-5 pt-3">
                    <h2 class="esg-sec-title">Our Environmental Commitment</h2>
                    <ul class="esg-list mt-3">
                        <li>Continuous reduction in carbon emissions</li>
                        <li>Increased reliance on sustainable materials</li>
                        <li>Ongoing improvement in energy efficiency</li>
                        <li>Annual review of environmental performance and targets</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- 3. Social Responsibility -->
        <section class="esg-section border-top">
            <div class="container">
                <h2 class="esg-sec-title">Social Responsibility</h2>
                
                <!-- Row 1: Supporting Communities & Employee Wellbeing -->
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Supporting Communities:</h4>
                            <p class="esg-block-text">We believe businesses have a responsibility beyond operations.</p>
                            <p class="esg-block-text mt-3">We proudly support SURGE for Water since the inception of its Middle East chapter.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Employee Wellbeing & Safety:</h4>
                            <p class="esg-block-text">We are committed to providing a safe, inclusive, and supportive workplace.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 2: SURGE Delivers & Health & Safety -->
                <div class="row g-5 mt-4">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">SURGE delivers:</h4>
                            <ul class="esg-list">
                                <li>Safe water access</li>
                                <li>Sanitation infrastructure</li>
                                <li>Hygiene education</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Health & Safety:</h4>
                            <ul class="esg-list">
                                <li>Safe and secure working environment across all operations</li>
                                <li>Proactive risk identification and mitigation</li>
                                <li>Ongoing training and safety awareness programs</li>
                                <li>Emergency preparedness and response procedures</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Across Regions & Equal Opportunity -->
                <div class="row g-5 mt-4">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Across regions including:</h4>
                            <ul class="esg-list">
                                <li>Dominican Republic</li>
                                <li>Haiti</li>
                                <li>Philippines</li>
                                <li>Uganda</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Equal Opportunity:</h4>
                            <p class="esg-block-text">We ensure:</p>
                            <ul class="esg-list">
                                <li>Fair and merit-based recruitment, promotion, and training</li>
                                <li>Zero tolerance for discrimination or harassment</li>
                                <li>Equal opportunities regardless of gender, nationality, or background</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Governance -->
        <section class="esg-section border-top">
            <div class="container">
                <h2 class="esg-sec-title">Governance</h2>
                
                <div class="row g-5">
                    <div class="col-12">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Ethical & Responsible Operations:</h4>
                            <p class="esg-block-text">Strong governance underpins our ESG commitments.</p>
                        </div>

                        <div class="esg-block mt-4">
                            <h4 class="esg-block-subtitle">Key Principles:</h4>
                            <ul class="esg-list">
                                <li>Compliance with all applicable UAE laws and regulations</li>
                                <li>Ethical business conduct and anti-discrimination policies</li>
                                <li>Transparent operational practices</li>
                                <li>Continuous policy review and improvement</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. Environmental Policy Commitment -->
        <section class="esg-section border-top">
            <div class="container">
                <h2 class="esg-sec-title">Environmental Policy Commitment</h2>
                
                <!-- Row 1: We are committed & ESG Approach -->
                <div class="row g-5">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">We are committed to:</h4>
                            <ul class="esg-list">
                                <li>Preventing pollution using best available techniques</li>
                                <li>Meeting and exceeding environmental regulations where possible</li>
                                <li>Training employees and contractors on environmental responsibility</li>
                                <li>Monitoring environmental risks across all projects</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Our ESG Approach:</h4>
                            <p class="esg-block-text">Our ESG strategy is guided by:</p>
                            <ul class="esg-list">
                                <li>Measurable impact</li>
                                <li>Transparent reporting</li>
                                <li>Continuous improvement</li>
                            </ul>
                            <p class="esg-block-text mt-3">We regularly review our policies, performance, and partnerships to ensure alignment with evolving sustainability standards and UAE regulatory expectations.</p>
                        </div>
                    </div>
                </div>

                <!-- Row 2: Looking Ahead & Contact/Enquiries -->
                <div class="row g-5 mt-5">
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Looking Ahead:</h4>
                            <p class="esg-block-text">We are focused on:</p>
                            <ul class="esg-list">
                                <li>Reducing carbon intensity year-on-year</li>
                                <li>Expanding sustainable sourcing beyond 80%</li>
                                <li>Enhancing ESG reporting and disclosures</li>
                                <li>Strengthening community and environmental impact initiatives</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="esg-block">
                            <h4 class="esg-block-subtitle">Contact & ESG Enquiries:</h4>
                            <p class="esg-block-text">For more information about our ESG initiatives, partnerships, or reporting:</p>
                            <p class="esg-company-name">The Total Office LLC</p>
                            <div class="mt-4">
                                <a href="{{ route('contact') }}" class="esg-contact-btn">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
