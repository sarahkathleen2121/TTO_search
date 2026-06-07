@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/job-aci.css') }}">
    <!-- Hero -->
    <section class="jd-hero">
        <div class="container">
            <div class="jd-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('careers') }}">Careers</a> / <a href="{{ route('careers') }}">Vacancies listing</a> / {{ $vacancy['title'] }}</div>
            <h1 class="jd-title">{{ $vacancy['title'] }}</h1>
        </div>
    </section>

    <!-- Job content -->
    <section class="jd-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <h4>Job Description</h4>
                    <p class="jd-par">{{ $vacancy['long_description'] }}</p>

                    <h4>Profile</h4>
                    <ul class="jd-list">
                        @foreach($vacancy['profile'] as $req)
                            <li>{{ $req }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-4">
                    <div class="jd-apply">
                        <h6>Apply for this Position</h6>
                        <p class="jd-par">Submit your application for this position.</p>
                        <a class="btn w-100" href="{{ route('make.enquiry', $vacancy['slug']) }}">Apply Now</a>
                    </div>
                </div>
            </div>

            <!-- Relevant Vacancies -->
            <div class="d-flex align-items-center justify-content-between jd-rel">
                <h4>Relevant Vacancies</h4>
                <div class="jd-nav">
                    <button class="jd-btn" id="jdPrev"><i class="fas fa-chevron-left"></i></button>
                    <button class="jd-btn" id="jdNext"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
            <div class="jd-viewport" id="jdViewport">
                <div class="jd-track" id="jdTrack">
                    @foreach($vacancies as $otherJob)
                        @if($otherJob['slug'] !== $vacancy['slug'])
                        <div class="jd-card">
                            <div class="d-flex justify-content-between">
                                <h6>{{ $otherJob['title'] }}</h6>
                                <div class="jd-date">{{ $otherJob['date'] }}</div>
                            </div>
                            <div class="jd-desc">{{ $otherJob['description'] }}</div>
                            <a class="jd-link" href="{{ route('job.aci', $otherJob['slug']) }}">Learn More ›</a>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <script>
        // Relevant vacancies slider
        (function() {
            const viewport = document.getElementById('jdViewport');
            const track = document.getElementById('jdTrack');
            const prev = document.getElementById('jdPrev');
            const next = document.getElementById('jdNext');
            let index = 0;

            function step() {
                const first = track.children[0];
                const gap = 18;
                return first.getBoundingClientRect().width + gap;
            }

            function perView() {
                return Math.max(1, Math.floor(viewport.clientWidth / step()));
            }

            function max() {
                return Math.max(0, track.children.length - perView());
            }

            function update() {
                track.style.transform = `translateX(${-index*step()}px)`;
            }
            prev.addEventListener('click', () => {
                index = Math.max(0, index - 1);
                update();
            });
            next.addEventListener('click', () => {
                index = index + 1 > max() ? 0 : index + 1;
                update();
            });
            window.addEventListener('resize', update);
            update();
        })();
    </script>
@endsection
