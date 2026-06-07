@extends('frontend.layouts.master')

@section('title', 'Case Studies')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/case-studies.css') }}">

    <!-- Hero -->
    <section class="cs-hero">
        <div class="container">
            <div class="cs-breadcrumb"><a href="{{ route('home') }}">Home</a> / Case Studies</div>
            <h1 class="cs-title">Case Studies</h1>
        </div>
    </section>

    <section class="cs-content-section">
        <div class="container">
            <!-- Search and Sort -->
            <div class="cs-toolbar">
                <div class="cs-search">
                    <input type="text" placeholder="Search" />
                    <button aria-label="search"><i class="fa fa-magnifying-glass"></i></button>
                </div>
                <div class="cs-sort dropdown">
                    <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
                        Sort By <i class="fa fa-chevron-down ms-2"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Newest</a></li>
                        <li><a class="dropdown-item" href="#">Oldest</a></li>
                        <li><a class="dropdown-item" href="#">A — Z</a></li>
                        <li><a class="dropdown-item" href="#">Z — A</a></li>
                    </ul>
                </div>
            </div>

            <!-- Cases list -->
            <div class="row g-4">
                <!-- Case 1 -->
                <div class="col-12">
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 1</h3>
                                    <p class="case-study-description">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Nisl, diam lectus sagittis, massa aliquam commodo.</p>
                                    <a href="{{ route('case.study.detail') }}" class="case-study-link">Learn More <i
                                            class="fas fa-chevron-right"
                                            style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #e0ecfa;"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 2</h3>
                                    <p class="case-study-description">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Nisl, diam lectus sagittis, massa aliquam commodo.</p>
                                    <a href="{{ route('case.study.detail') }}" class="case-study-link">Learn More <i
                                            class="fas fa-chevron-right"
                                            style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #e0ecfa;"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 3</h3>
                                    <p class="case-study-description">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Nisl, diam lectus sagittis, massa aliquam commodo.</p>
                                    <a href="{{ route('case.study.detail') }}" class="case-study-link">Learn More <i
                                            class="fas fa-chevron-right"
                                            style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #e0ecfa;"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 4</h3>
                                    <p class="case-study-description">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Nisl, diam lectus sagittis, massa aliquam commodo.</p>
                                    <a href="{{ route('case.study.detail') }}" class="case-study-link">Learn More <i
                                            class="fas fa-chevron-right"
                                            style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #e0ecfa;"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="case-study-card">
                        <div class="cs-card-inner">
                            <div class="cs-card-left">
                                <div class="case-study-icon">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="cs-card-content">
                                    <h3 class="case-study-title">Case study 5</h3>
                                    <p class="case-study-description">Lorem ipsum dolor sit amet, consectetur
                                        adipiscing elit. Nisl, diam lectus sagittis, massa aliquam commodo.</p>
                                    <a href="{{ route('case.study.detail') }}" class="case-study-link">Learn More <i
                                            class="fas fa-chevron-right"
                                            style="font-size: 11px; margin-left: 4px"></i></a>
                                </div>
                            </div>
                            <div class="cs-card-right">
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Colors</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-color-circle"></span>
                                        <span class="cs-circle cs-color-circle" style="background: #e0ecfa;"></span>
                                        <span class="cs-circle cs-color-circle"></span>
                                    </div>
                                </div>
                                <div class="cs-tag-group">
                                    <span class="cs-tag-label">Brands</span>
                                    <div class="cs-tag-circles">
                                        <span class="cs-circle cs-brand-circle">DIOR</span>
                                        <span class="cs-circle cs-brand-circle">PROJECT</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
