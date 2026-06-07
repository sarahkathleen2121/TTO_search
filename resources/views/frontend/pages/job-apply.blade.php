@extends('frontend.layouts.master')
@section('title', 'Apply Now - ACI (Internship)')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/job-apply.css') }}">

    <!-- Hero -->
    <section class="ja-hero">
        <div class="container">
            <h1 class="ja-title">Apply now</h1>
            <div class="ja-subtitle">ACI (Internship)</div>
        </div>
    </section>

    <!-- Form -->
    <section class="ja-form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <form class="ja-form" action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="ja-field">
                            <input type="text" placeholder="Full name" required />
                        </div>
                        <div class="ja-field">
                            <input type="email" placeholder="Your Email" required />
                        </div>
                        <div class="ja-field">
                            <input type="tel" placeholder="Phone" />
                        </div>
                        <div class="ja-field">
                            <textarea placeholder="Cover letter" rows="5"></textarea>
                        </div>
                        <div class="ja-attach">
                            <label class="ja-attach-btn">
                                <i class="fas fa-paperclip"></i> Attach CV
                                <input type="file" id="cvFile" accept=".pdf,.doc,.docx" hidden />
                            </label>
                            <span class="ja-file-name" id="jaFileName"></span>
                        </div>
                        <button type="submit" class="ja-submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Show attached file name
        document.getElementById('cvFile').addEventListener('change', function() {
            const nameEl = document.getElementById('jaFileName');
            if (this.files.length > 0) {
                nameEl.innerHTML = this.files[0].name + ' <span class="ja-remove-file" onclick="removeFile()">&times;</span>';
            }
        });
        function removeFile() {
            document.getElementById('cvFile').value = '';
            document.getElementById('jaFileName').innerHTML = '';
        }
    </script>
@endsection
