@extends('frontend.layouts.master')
@section('title', 'Post Visit Feedback')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/post-feedback.css') }}">

    <div class="pf-page-bg">
        <!-- Progress Bar -->
        <div style="position: relative;">
            <div class="pf-progress-bar-container">
                <div class="pf-progress-bar" id="progressBar" style="width: 0%;"></div>
                <div class="pf-progress-text" id="progressText">Current Progress 0%</div>
            </div>
        </div>

        <!-- Logo Area -->
        <div class="pf-logo-container">
            <a href="{{ route('home') }}" class="text-decoration-none">
                <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="The Total Office" style="height: 30px; display: block; margin: 0 auto;">
            </a>
        </div>

        <!-- Feedback Form Card -->
        <div class="pf-card">
            <h1 class="pf-title">Post {{ ucfirst($type) }} Feedback</h1>

            <form action="#" method="POST" id="feedbackForm">
                @csrf
                <input type="hidden" name="booking_id" value="{{ request('booking') }}">

                <!-- Row 1: Names -->
                <div class="row mb-3 gap-3">
                    <div class="col px-0 ps-3">
                        <input type="text" class="pf-input form-track" placeholder="First name" name="first_name" required>
                    </div>
                    <div class="col px-0 pe-3">
                        <input type="text" class="pf-input form-track" placeholder="Last name" name="last_name" required>
                    </div>
                </div>

                <!-- Row 2: Email -->
                <div class="mb-3">
                    <input type="email" class="pf-input form-track" placeholder="Your Email" name="email" required>
                </div>

                <!-- Row 3: Expression -->
                <div class="mb-4">
                    <select class="pf-select form-track" name="expression" required>
                        <option value="" selected disabled>Your expression after the {{ \strtolower($type) }}</option>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>

                <!-- Question 1: Helpful? -->
                <div class="mb-4 form-track-group">
                    <div class="pf-question">Was your {{ \strtolower($type) }} helpful?</div>
                    
                    <label class="d-block m-0">
                        <input type="radio" name="is_helpful" value="Yes" class="pf-radio-input" onchange="updateRadioSelection(this, 'helpful_options')">
                        <div class="pf-option-btn group-helpful_options">Yes</div>
                    </label>
                    <label class="d-block m-0">
                        <input type="radio" name="is_helpful" value="No" class="pf-radio-input" onchange="updateRadioSelection(this, 'helpful_options')">
                        <div class="pf-option-btn group-helpful_options">No</div>
                    </label>
                </div>

                <!-- Question 2: Rating -->
                <div class="mb-4 form-track-group">
                    <div class="pf-question">How would you rated your {{ \strtolower($type) }}?</div>
                    
                    <label class="d-block m-0">
                        <input type="radio" name="rating" value="Great" class="pf-radio-input" onchange="updateRadioSelection(this, 'rating_options')">
                        <div class="pf-option-btn group-rating_options">Great</div>
                    </label>
                    <label class="d-block m-0">
                        <input type="radio" name="rating" value="Could have been better" class="pf-radio-input" onchange="updateRadioSelection(this, 'rating_options')">
                        <div class="pf-option-btn group-rating_options">Could have been better</div>
                    </label>
                    <label class="d-block m-0">
                        <input type="radio" name="rating" value="Not good" class="pf-radio-input" onchange="updateRadioSelection(this, 'rating_options')">
                        <div class="pf-option-btn group-rating_options">Not good</div>
                    </label>
                </div>

                <!-- Question 3: Contact again? -->
                <div class="mb-4 form-track-group">
                    <div class="pf-question">We may like to contact you again, please confirm if we can contact you again in future?</div>
                    
                    <label class="d-block m-0">
                        <input type="radio" name="contact_future" value="Yes" class="pf-radio-input" onchange="updateRadioSelection(this, 'contact_options')">
                        <div class="pf-option-btn group-contact_options">Yes</div>
                    </label>
                    <label class="d-block m-0">
                        <input type="radio" name="contact_future" value="No" class="pf-radio-input" onchange="updateRadioSelection(this, 'contact_options')">
                        <div class="pf-option-btn group-contact_options">No - Prefer not to be contacted</div>
                    </label>
                </div>

                <!-- Note -->
                <div class="mb-4">
                    <textarea class="pf-input form-track" name="note" rows="5" placeholder="Leave a note" style="resize: none;"></textarea>
                </div>

                <button type="submit" class="pf-submit-btn">Submit</button>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function updateRadioSelection(radioInput, groupClass) {
            // Remove 'selected' class from all options in this group
            document.querySelectorAll('.group-' + groupClass).forEach(function(el) {
                el.classList.remove('selected');
            });
            
            // Add 'selected' class to the div sibling of the checked radio
            if (radioInput.checked) {
                radioInput.nextElementSibling.classList.add('selected');
            }
            
            checkProgress();
        }

        function checkProgress() {
            // Define total groups of required/trackable fields
            // 1. first_name 2. last_name 3. email 4. expression 5. is_helpful 6. rating 7. contact_future 8. note (optional but let's count for max width)
            const inputs = document.querySelectorAll('#feedbackForm .form-track');
            const radioGroups = ['is_helpful', 'rating', 'contact_future'];
            
            let totalFields = inputs.length + radioGroups.length;
            let filledFields = 0;

            inputs.forEach(input => {
                if (input.value.trim() !== '') {
                    filledFields++;
                }
            });

            radioGroups.forEach(groupName => {
                const checked = document.querySelector(`input[name="${groupName}"]:checked`);
                if (checked) {
                    filledFields++;
                }
            });

            // Calculate percentage
            let percentage = Math.round((filledFields / totalFields) * 100);
            
            // Set max to 100
            if (percentage > 100) percentage = 100;

            document.getElementById('progressBar').style.width = percentage + '%';
            document.getElementById('progressText').innerText = 'Current Progress ' + percentage + '%';
        }

        // Attach event listeners to all tracking inputs to calculate progress
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('#feedbackForm .form-track');
            inputs.forEach(input => {
                input.addEventListener('input', checkProgress);
                input.addEventListener('change', checkProgress);
            });
            
            checkProgress(); // initial check
        });
    </script>
    @endpush
@endsection
