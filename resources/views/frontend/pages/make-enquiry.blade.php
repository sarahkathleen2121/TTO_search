@extends('frontend.layouts.master')
@section('title', 'Apply Now - ' . $vacancy['title'])
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/make-enquiry.css') }}?v={{ time() }}">

    <main class="me-wrapper">
      <div class="me-container">
        <h1 class="me-title">Apply now</h1>
        <div class="me-subtitle">{{ $vacancy['title'] }}</div>

        <form id="meForm" class="me-form" action="#" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="me-field">
            <input type="text" placeholder="Full name" required />
          </div>
          <div class="me-field">
            <input type="email" placeholder="Your Email" required />
          </div>
          <div class="me-field">
            <input type="tel" placeholder="Phone" />
          </div>
          <div class="me-field">
            <textarea placeholder="Cover letter" rows="5"></textarea>
          </div>
          
          <div class="me-attach">
            <label class="me-attach-btn">
              <i class="fas fa-paperclip"></i> Attach CV
              <input type="file" id="cvFile" accept=".pdf,.doc,.docx" hidden />
            </label>
            <span class="me-file-name" id="meFileName"></span>
          </div>

          <button type="submit" class="me-submit">Sumbit</button>
        </form>
      </div>
    </main>

    <script>
        // Show attached file name and handle file removal
        (function() {
            const fileInput = document.getElementById('cvFile');
            const nameEl = document.getElementById('meFileName');

            fileInput.addEventListener('change', function() {
                if (this.files.length > 0) {
                    nameEl.innerHTML = this.files[0].name + ' <span class="me-remove-file" onclick="removeFile()">&times;</span>';
                }
            });

            document.getElementById('meForm').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Thank you! Your application has been submitted.');
                this.reset();
                nameEl.innerHTML = '';
            });
        })();

        function removeFile() {
            const fileInput = document.getElementById('cvFile');
            const nameEl = document.getElementById('meFileName');
            fileInput.value = '';
            nameEl.innerHTML = '';
        }
    </script>
@endsection
