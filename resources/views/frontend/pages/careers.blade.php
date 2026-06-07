@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/careers.css') }}">

    <!-- Hero -->
    <section class="crs-hero">
        <div class="container-fluid px-0">
            <div class="row g-0 align-items-stretch">
                <div class="col-lg-6 crs-left">
                    <div class="crs-ph">
                        <img src="{{ asset('frontend_assets/images/careers_hero.png') }}" alt="Careers Hero">
                    </div>
                </div>
                <div class="col-lg-6 crs-right">
                    <div class="crs-breadcrumb"><a href="{{ route('home') }}">Home</a> / Careers</div>
                    <h1 class="crs-title">Working at<br />Total Office</h1>
                    <p class="crs-lead">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Values -->
    <section class="crs-values">
        <div class="container">
            <h3>Our Core Values</h3>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">01</div>
                <div class="col-10 col-md-4 crs-vname">Human Kind</div>
                <div class="col-12 col-md-7 crs-vdesc">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                </div>
            </div>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">02</div>
                <div class="col-10 col-md-4 crs-vname">Innovation</div>
                <div class="col-12 col-md-7 crs-vdesc">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                </div>
            </div>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">03</div>
                <div class="col-10 col-md-4 crs-vname">Reliable</div>
                <div class="col-12 col-md-7 crs-vdesc">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                </div>
            </div>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">04</div>
                <div class="col-10 col-md-4 crs-vname">Collaborate</div>
                <div class="col-12 col-md-7 crs-vdesc">
                    Lorem Ipsum is simply dummy text of the printing and typesetting
                    industry. Lorem Ipsum has been the industry's standard dummy text
                    ever since the 1500s,
                </div>
            </div>
        </div>
    </section>

    <!-- Workplace experts with gallery thumbs -->
    <section class="crs-experts">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <h3>We are workplace experts</h3>
                    <p style="color: #383E42">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat.
                    </p>
                    <p style="color: #383E42">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                        enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>
                <div class="col-lg-6">
                    <div class="crs-big mb-3">
                        <img src="{{ asset('frontend_assets/images/expert_1.png') }}" alt="Workplace Expert 1">
                    </div>
                    <div class="d-flex gap-3">
                        <div class="flex-fill crs-thumb">
                            <img src="{{ asset('frontend_assets/images/expert_2.png') }}" alt="Workplace Expert 2">
                        </div>
                        <div class="flex-fill crs-thumb">
                            <img src="{{ asset('frontend_assets/images/expert_3.png') }}" alt="Workplace Expert 3">
                        </div>
                        <div class="flex-fill crs-thumb">
                            <img src="{{ asset('frontend_assets/images/expert_4.png') }}" alt="Workplace Expert 4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vacancy Listing -->
    <section class="crs-vac">
        <div class="container">
            <h3>Vacancy Listing</h3>
            <div class="row g-3">
                @foreach($vacancies as $job)
                <div class="col-md-6 col-lg-4">
                    <div class="crs-job">
                        <div class="d-flex justify-content-between mb-3">
                            <h5>{{ $job['title'] }}</h5>
                            <div class="crs-date">{{ $job['date'] }}</div>
                        </div>
                        <div class="crs-jdesc">
                            {{ $job['description'] }}
                        </div>
                        <a class="crs-link" href="{{ route('job.aci', $job['slug']) }}">Learn More ›</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Resume form -->
    <section class="crs-form">
        <div class="container">
            <div class="col-lg-7 mx-auto">
                <h3>Send us your resume</h3>
            <form id="cvForm" novalidate>
                <div class="row g-3">
                    <div class="col-12">
                        <input required class="form-control" placeholder="Full name" />
                    </div>
                    <div class="col-12">
                        <input required class="form-control" placeholder="Department you're interested in" />
                    </div>
                    <div class="col-12">
                        <input required class="form-control" placeholder="Profession you're interested in" />
                    </div>
                    <div class="col-12">
                        <textarea class="form-control" placeholder="Message"></textarea>
                    </div>
                    <div class="col-12">
                        <div class="crs-upload">
                            <label class="crs-file-label" for="cvFile"><i class="fas fa-paperclip"></i> Attach
                                CV</label>
                            <input id="cvFile" class="crs-file" type="file" accept=".pdf,.doc,.docx" />
                            <span id="cvName" class="crs-file-name"></span>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="crs-submit">Submit</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </section>
    <script>
        // Show chosen filename and simple validation
        (function() {
            const file = document.getElementById("cvFile");
            const name = document.getElementById("cvName");
            file.addEventListener("change", () => {
                name.textContent = file.files[0] ? file.files[0].name + " ✕" : "";
            });
            name.addEventListener("click", () => {
                file.value = "";
                name.textContent = "";
            });
            document
                .getElementById("cvForm")
                .addEventListener("submit", function(e) {
                    e.preventDefault();
                    alert("Thanks! Your resume has been submitted.");
                    this.reset();
                    name.textContent = "";
                });
        })();
    </script>
@endsection
