@extends('frontend.layouts.master')

@section('title', 'Careers')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/careers.css') }}?v={{ time() }}">

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
                    <h1 class="crs-title">Shape the Future of Work. Join the Team Behind It.</h1>
                    <p class="crs-lead">
                    Nearly three decades of redefining workspaces across the Middle East — and we're still just getting started. At The Total Office, we don't just design offices. We build careers worth showing up for.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Who We Are -->
    <section class="crs-who">
        <div class="container">
            <h3>Who We Are</h3>
            <p class="crs-who-text">We are a team of more than 75 people across Dubai, Abu Dhabi, Sharjah in UAE and Riyadh in KSA — designers, sales professionals, marketers, technicians, warehouse staff, and everything in between. What ties us together is not just what we do, but how we do it. We are human-centric by design — not just in the workspaces we create, but in the culture we have built internally. At TTO, every voice carries weight, every idea gets a platform, and every person has room to grow.</p>
        </div>
    </section>

    <!-- Core Values -->
    <section class="crs-values">
        <div class="container">
            <h3>Why The TTO</h3>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">01</div>
                <div class="col-10 col-md-4 crs-vname">Flat Hierarchy, Real Impact</div>
                <div class="col-12 col-md-7 crs-vdesc">
                At The Total Office, titles don't define who gets heard. We operate with a flat structure that encourages open dialogue at every level. If you have an idea, you'll have a platform to share it — and a team ready to back it.
                </div>
            </div>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">02</div>
                <div class="col-10 col-md-4 crs-vname">Freedom to Perform</div>
                <div class="col-12 col-md-7 crs-vdesc">
                We hire talented people and then trust them to deliver. You won't find micromanagement here. What you will find is the freedom to take ownership, the space to innovate, and a leadership team that measures performance by outcomes, not hours.
                </div>
            </div>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">03</div>
                <div class="col-10 col-md-4 crs-vname">Always Learning</div>
                <div class="col-12 col-md-7 crs-vdesc">
                From LEED and WELL accreditations to the latest in AI-driven space utilisation, our industry never stands still — and neither do we. We invest in our people's growth, exposing them to cutting-edge projects, global brands, and the kind of challenges that genuinely sharpen careers.
                </div>
            </div>
            <div class="crs-vrow row g-3 align-items-start">
                <div class="col-2 col-md-1 crs-num">04</div>
                <div class="col-10 col-md-4 crs-vname">People First, Always</div>
                <div class="col-12 col-md-7 crs-vdesc">
                Human-centric design is not just our product philosophy — it's our people philosophy. We care about the wellbeing, development, and experience of every person on our team, from our office staff to our warehouse and technical teams. When our people thrive, everything else follows.
                </div>
            </div>
        </div>
    </section>

    <!-- Workplace experts with gallery thumbs -->
    <section class="crs-experts">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-6">
                    <h3>Who We're Looking For</h3>
                    <p style="color: #383E42">
                    We are always interested in connecting with exceptional people, even when we are not actively recruiting. If you are an experienced workspace designer, a driven sales professional, a creative marketer, or a graduate ready to build something meaningful — we want to hear from you.
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

    <!-- Resume form (Closing CTA) -->
    <section class="crs-form">
        <div class="container">
            <div class="col-lg-7 mx-auto">
                <h3>Think you belong here? We'd love to start a conversation.</h3>
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
                        <button type="submit" class="crs-submit">Send Us Your CV</button>
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
