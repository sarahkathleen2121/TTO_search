<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Frontend - Website')</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/6cbdf8a9b4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/style.css') }}">
    @stack('styles')
    <style>
        /* Global breadcrumbs link reset - keep original color and remove underline */
        [class*="breadcrumb"] a, .breadcrumb-mini a {
            text-decoration: none !important;
            color: inherit !important;
            transition: opacity 0.15s ease;
        }
        [class*="breadcrumb"] a:hover, .breadcrumb-mini a:hover {
            text-decoration: none !important;
            color: inherit !important;
            opacity: 0.75;
        }
    </style>
</head>

<body>
    <!-- Global Notification Toast -->
    <div id="globalNotification" style="position: fixed; bottom: 30px; left: 30px; z-index: 1050; display: none; background: #fff; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border: 1px solid #e1efff; padding: 20px; width: 340px; border-radius: 0px;">
        <div style="display: flex; gap: 15px; align-items: center;">
            <div style="width: 80px; height: 60px; background: #eff0f0; display: flex; align-items: center; justify-content: center;">
                <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="Board" style="max-width: 60%; opacity: 0.5;">
            </div>
            <div>
                <h4 style="color: #383E42; font-weight: 700; font-size: 14px; margin: 0 0 8px; line-height: 1.4;">Your favorite boards<br>have been updated</h4>
                <a href="#" onclick="openMyBoardFromToast(event)" style="color: #383E42; font-weight: 700; font-size: 11px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                    Go to your boards <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <button onclick="hideNotification()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: #a0aec0; cursor: pointer; font-size: 14px;"><i class="fas fa-times"></i></button>
    </div>

    <!-- Basket Notification Toast -->
    <div id="basketNotification" style="position: fixed; bottom: 30px; right: 30px; z-index: 1050; display: none; background: #fff; box-shadow: 0 10px 40px rgba(0,0,0,0.1); border: 1px solid #e1efff; padding: 20px; width: 340px; border-radius: 0px; border-left: 4px solid #383E42;">
        <div style="display: flex; gap: 15px; align-items: center;">
            <div style="width: 50px; height: 50px; background: #383E42; color: #fff; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 20px;">
                <i class="fa-solid fa-check"></i>
            </div>
            <div>
                <h4 style="color: #383E42; font-weight: 700; font-size: 14px; margin: 0 0 8px; line-height: 1.4;" id="basketNotificationMsg">Item added to basket!</h4>
                <a href="{{ route('enquiry.basket') }}" style="color: #383E42; font-weight: 700; font-size: 11px; text-decoration: none; display: flex; align-items: center; gap: 5px;">
                    View Enquiry Basket <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        <button onclick="hideBasketNotification()" style="position: absolute; top: 10px; right: 10px; background: none; border: none; color: #a0aec0; cursor: pointer; font-size: 14px;"><i class="fas fa-times"></i></button>
    </div>

    @include('frontend.layouts.header')
    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>
    @include('frontend.layouts.footer')

    <style>
        /* Book Modal Custom Styles */
        #bookModal .modal-content {
            border: none;
            border-radius: 0;
            padding: 10px;
            position: relative;
            overflow: visible;
        }
        #bookModal .modal-header {
            border-bottom: none;
            padding: 20px 20px 0;
            justify-content: flex-end;
        }
        #bookModal .bm-close {
    background: none;
    border: none;
    color: #383E42;
    font-size: 18px;
    cursor: pointer;
    padding: 0;
    line-height: 1;
    position: absolute;
    top: -15px;
    background-color: #eff0f0;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    right: -15px;
}
.modal-backdrop {
    background-color: #383E42a1;   /* apna color yahan set karo */
}
        #bookModal .bm-close:hover {
            color: #0b4fc0;
        }
        #bookModal .bm-title {
            color: #383E42;
            font-weight: 800;
            font-size: 32px;
            margin: 0 0 8px;
            line-height: 1.2;
        }
        #bookModal .bm-subtitle {
            color: #383E42;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        #bookModal .bm-option {
            display: block;
            width: 100%;
            background: #fff;
            border: 1px solid #d1e2ff;
            border-radius: 0;
            padding: 18px 24px;
            color: #383E42;
            font-weight: 700;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 12px;
        }
        #bookModal .bm-option:hover {
            background: #eff0f0;
            border-color: #383E42;
        }
        #bookModal .modal-step-title {
            color: #383E42;
            font-weight: 800;
        }
        #bookModal .btn-back {
            background: none;
            border: none;
            color: #383E42;
            font-size: 18px;
            cursor: pointer;
            padding: 0;
        }
        #bookModal .btn-primary {
            background: #383E42;
            border: none;
            border-radius: 0;
            font-weight: 700;
            padding: 14px;
        }
        #bookModal .btn-primary:hover {
            background: #383E42;
        }
        #bookModal .form-control,
        #bookModal .form-select {
            border-radius: 0;
            border: 1px solid #d1e2ff;
        }
        #bookModal .form-control:focus,
        #bookModal .form-select:focus {
            border-color: #383E42;
            box-shadow: none;
        }
        /* Person Cards Grid */
        #bookModal .bm-person-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 20px;
        }
        #bookModal .bm-person-card {
            border: 1px solid #d1e2ff;
            border-radius: 0px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        #bookModal .bm-person-card:hover {
            border-color: #383E42;
        }
        #bookModal .bm-person-card.selected {
            background: #383E42;
            border-color: #383E42;
        }
        #bookModal .bm-person-card.selected .bm-person-name,
        #bookModal .bm-person-card.selected .bm-person-role {
            color: #fff;
        }
        #bookModal .bm-person-card.selected .bm-person-icon {
            background: #fff;
            color: #383E42;
        }
        #bookModal .bm-person-icon {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e8f0fe;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #383E42;
            font-size: 14px;
            flex-shrink: 0;
        }
        #bookModal .bm-person-name {
            color: #383E42;
            font-weight: 700;
            font-size: 15px;
            margin: 0;
        }
        #bookModal .bm-person-role {
            color: #383E42;
            font-size: 12px;
            margin: 2px 0 0;
        }
        #bookModal .bm-section-label {
            color: #383E42;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 14px;
        }
        #bookModal .bm-meeting-text {
            color: #383E42;
            font-size: 13px;
            margin-bottom: 10px;
        }
        @media (max-width: 576px) {
            #bookModal .bm-person-grid {
                grid-template-columns: 1fr;
            }
            #bookModal .bm-title {
                font-size: 26px;
            }
            #bookModal .bm-beverage-grid {
                grid-template-columns: 1fr 1fr;
            }
        }
        /* Wide modal for step 3 */
        #bookModal .modal-dialog.bm-wide {
            max-width: 680px;
        }
        #bookModal .bm-two-col {
            display: flex;
            gap: 30px;
        }
        #bookModal .bm-col-left {
            flex: 1;
            min-width: 0;
        }
        #bookModal .bm-col-right {
            width: 220px;
            flex-shrink: 0;
        }
        #bookModal .bm-meeting-info {
            font-weight: 800;
            color: #383E42;
            font-size: 16px;
            margin-bottom: 4px;
        }
        #bookModal .bm-meeting-dur {
            color: #383E42;
            font-size: 13px;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        #bookModal .bm-meeting-dur i {
            font-size: 14px;
        }
        #bookModal .bm-field {
            margin-bottom: 0;
        }
        #bookModal .bm-field input,
        #bookModal .bm-field textarea,
        #bookModal .bm-field select {
                width: 100%;
    border: none;
    border: 1px solid #d1e2ff;
    background: transparent;
    padding: 14px 10px;
    font-size: 14px;
    color: #383E42;
    outline: none;
    font-family: inherit;
    border-radius: 0;
    margin-bottom: 10px;
        }
        #bookModal .bm-field input::placeholder,
        #bookModal .bm-field textarea::placeholder {
            color: #383E42;
            font-weight: 600;
        }
        #bookModal .bm-field input:focus,
        #bookModal .bm-field textarea:focus,
        #bookModal .bm-field select:focus {
            border-bottom-color: #383E42;
        }
        #bookModal .bm-field textarea {
            resize: vertical;
            min-height: 60px;
            border: 1px solid #d1e2ff;
            padding: 12px;
            margin-top: 4px;
        }
        
        /* Specific borders for Step 3 Call form */
        #bookModal .bm-call-input {
            width: 100%;
            border: 1px solid #d1e2ff;
            background: #fff;
            padding: 14px 16px;
            font-size: 14px;
            color: #383E42;
            outline: none;
            border-radius: 0;
            margin-bottom: 20px;
        }
        #bookModal .bm-call-input::placeholder {
            color: #383E42;
        }
        #bookModal .bm-call-input:focus {
            border-color: #383E42;
        }
        #bookModal .bm-call-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%231e63e6' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
        }
        #bookModal .bm-date-row {
            display: flex;
            gap: 12px;
        }
        #bookModal .bm-date-row > div {
            flex: 1;
        }
        /* Beverage grid */
        #bookModal .bm-bev-title {
            color: #383E42;
            font-weight: 800;
            font-size: 15px;
            text-align: center;
            margin-bottom: 16px;
        }
        #bookModal .bm-beverage-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        #bookModal .bm-bev-card {
            text-align: center;
            cursor: pointer;
        }
        #bookModal .bm-bev-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            border: 2px solid #d1e2ff;
            object-fit: cover;
            transition: border-color 0.2s;
            margin: 0 auto 6px;
            display: block;
        }
        #bookModal .bm-bev-card.selected .bm-bev-img {
            border-color: #383E42;
            border-width: 3px;
        }
        #bookModal .bm-bev-label {
            color: #383E42;
            font-size: 12px;
            font-weight: 600;
        }
        @media (max-width: 768px) {
            #bookModal .bm-two-col {
                flex-direction: column;
            }
            #bookModal .bm-col-right {
                width: 100%;
            }
            #bookModal .modal-dialog.bm-wide {
                max-width: 100%;
            }
        }
        #signupModal .form-control,
        #signinModal .form-control,
        #createBoardModal .form-control {
            color: #383E42;
        }
        /* for placeholder color */
        #signupModal .form-control::placeholder,
        #signinModal .form-control::placeholder,
        #createBoardModal .form-control::placeholder {
            color: #383E42;
        }
        /* reschedule modal input fields */
        #rescheduleModal input,
        #rescheduleModal select,
        #rescheduleModal textarea{
            width: 100%;
            border: 1px solid #d1e2ff;
            background: #fff;
            padding: 14px 16px;
            font-size: 14px;
            color: #383E42;
            outline: none;
            border-radius: 0;
            margin-bottom: 20px;
        }

        #rescheduleModal .form-control,
        #rescheduleModal .form-control input::placeholder,
        #rescheduleModal .form-control select::placeholder,
        #rescheduleModal .form-control textarea::placeholder {
            color: #383E42 !important;
        }
    </style>

    <div class="modal fade" id="bookModal" tabindex="-1" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="type" id="bookingType">
                    <input type="hidden" name="staff_member" id="bookingStaff">
                    <input type="hidden" name="date" id="bookingDate">
                    <input type="hidden" name="time" id="bookingTime">
                    <input type="hidden" name="name" id="bookingName">
                    <input type="hidden" name="email" id="bookingEmail">
                    <input type="hidden" name="phone" id="bookingPhone">
                    <input type="hidden" name="company_name" id="bookingCompany">

                    <div class="modal-header">
                        <button type="button" class="bm-close" data-bs-dismiss="modal" aria-label="Close">
                            <img src="{{ asset('frontend_assets/images/cross.png') }}" width="14px" alt="Close">
                        </button>
                    </div>

                    <!-- Step 1: Choose Visit or Call -->
                    <div class="modal-step" id="step1">
                        <div class="modal-body" style="padding: 0 30px 30px;">
                            <h3 class="bm-title">Want to reach out<br>to us?</h3>
                            <p class="bm-subtitle">Please select desirable way to contact us below</p>
                            <button type="button" class="bm-option"
                                onclick="setBookingType('visit'); showStep(2, 'visit')">
                                Book a Visit
                            </button>
                            <button type="button" class="bm-option"
                                onclick="setBookingType('call'); showStep(2, 'call')">
                                Book a Call
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Select a Person (Visit) -->
                    <div class="modal-step d-none" id="step2-visit">
                        <div class="modal-body" style="padding: 0 30px 30px;">
                            <h3 class="bm-title">Book a Visit</h3>
                            <p class="bm-subtitle">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat.</p>

                            <div class="bm-section-label">Select a person</div>

                            <div class="bm-person-grid">
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'John Doe', 'visit')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">John Doe</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'Mike Shake', 'visit')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">Mike Shake</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'John Doe', 'visit')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">John Doe</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'John Doe', 'visit')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">John Doe</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                            </div>

                            <p class="bm-meeting-text" id="visitMeetingText"></p>
                            <button type="button" class="btn btn-primary" style="padding: 12px 30px; border-radius: 0; font-weight: 600;" onclick="showStep(3, 'visit')">Confirm meeting</button>
                        </div>
                    </div>

                    <!-- Step 2: Select a Person (Call) -->
                    <div class="modal-step d-none" id="step2-call">
                        <div class="modal-body" style="padding: 0 30px 30px;">
                            <h3 class="bm-title">Book a Call</h3>
                            <p class="bm-subtitle">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat.</p>

                            <div class="bm-section-label">Select a person</div>

                            <div class="bm-person-grid">
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'John Doe', 'call')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">John Doe</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'Mike Shake', 'call')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">Mike Shake</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'John Doe', 'call')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">John Doe</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                                <div class="bm-person-card" onclick="selectPersonCard(this, 'John Doe', 'call')">
                                    <div class="bm-person-icon"><i class="fas fa-user"></i></div>
                                    <div>
                                        <p class="bm-person-name">John Doe</p>
                                        <p class="bm-person-role">Senior manager at Dubai office</p>
                                    </div>
                                </div>
                            </div>

                            <p class="bm-meeting-text" id="callMeetingText"></p>
                            <button type="button" class="btn btn-primary" style="padding: 12px 30px; border-radius: 0; font-weight: 600;" onclick="showStep(3, 'call')">Confirm meeting</button>
                        </div>
                    </div>

                    <!-- Step 3: Enter Details + Beverage (Visit) -->
                    <div class="modal-step d-none" id="step3-visit">
                        <div class="modal-body" style="padding: 0 30px 30px;">
                            <h3 class="bm-title">Book a Visit</h3>
                            <p class="bm-subtitle">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat.</p>

                            <div class="bm-two-col">
                                <div class="bm-col-left">
                                    <div class="bm-meeting-info">60 Minute Meeting</div>
                                    <div class="bm-meeting-dur"><i class="far fa-clock"></i> 1 Hour</div>

                                    <div class="bm-field">
                                        <input type="text" placeholder="First Name *" oninput="updateHidden('bookingName', this.value)" required />
                                    </div>
                                    <div class="bm-field">
                                        <input type="email" placeholder="Email Address" oninput="updateHidden('bookingEmail', this.value)" />
                                    </div>
                                    <div class="bm-date-row">
                                        <div class="bm-field">
                                            <input type="date" onchange="updateHidden('bookingDate', this.value)" style="color: #383E42;" />
                                        </div>
                                        <div class="bm-field">
                                            <select onchange="updateHidden('bookingTime', this.value)" style="color: #383E42; background: transparent;">
                                                <option value="">Select a time</option>
                                                <option>09:00 AM</option>
                                                <option>10:00 AM</option>
                                                <option>11:00 AM</option>
                                                <option>01:00 PM</option>
                                                <option>02:00 PM</option>
                                                <option>03:00 PM</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="bm-field">
                                        <textarea placeholder="Message" rows="3"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary" style="padding: 12px 30px; margin-top: 16px;">Submit</button>
                                </div>
                                <div class="bm-col-right">
                                    <div class="bm-bev-title">Choose Your Beverage</div>
                                    <div class="bm-beverage-grid">
                                        <div class="bm-bev-card selected" onclick="selectBeverage(this, 'Cappuccino')">
                                            <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="bm-bev-img" alt="Cappuccino" />
                                            <div class="bm-bev-label">Cappuccino</div>
                                        </div>
                                        <div class="bm-bev-card" onclick="selectBeverage(this, 'Black')">
                                            <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="bm-bev-img" alt="Black" />
                                            <div class="bm-bev-label">Black</div>
                                        </div>
                                        <div class="bm-bev-card" onclick="selectBeverage(this, 'Expresso')">
                                            <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="bm-bev-img" alt="Expresso" />
                                            <div class="bm-bev-label">Expresso</div>
                                        </div>
                                        <div class="bm-bev-card" onclick="selectBeverage(this, 'Tea')">
                                            <img src="{{ asset('frontend_assets/images/banner_img.png') }}" class="bm-bev-img" alt="Tea" />
                                            <div class="bm-bev-label">Tea</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Enter Details (Call) -->
                    <div class="modal-step d-none" id="step3-call">
                        <div class="modal-body" style="padding: 0 40px 40px;">
                            <h3 class="bm-title">Book a Call</h3>
                            <p class="bm-subtitle">Amet minim mollit non deserunt ullamco est sit<br>aliqua dolor do amet sint. Velit officia consequat.</p>

                            <div style="margin-bottom: 30px; margin-top: 30px;">
                                <h5 style="color: #383E42; font-weight: 800; font-size: 20px; margin-bottom: 8px;">60 Minute Call</h5>
                                <p style="color: #383E42; font-size: 13px; margin: 0; font-weight: 600;"><i class="fas fa-clock" style="color: #383E42; margin-right: 6px;"></i> 1 Hour</p>
                            </div>

                            <input type="text" class="bm-call-input" placeholder="First Name *" name="name" id="callName" oninput="updateHidden('bookingName', this.value)" required>
                            <input type="tel" class="bm-call-input" placeholder="Your Phone Number" name="phone" id="callPhone" oninput="updateHidden('bookingPhone', this.value)" required>
                            
                            <div class="row" style="margin-bottom: 20px; row-gap: 20px;">
                                <div class="col-md-6">
                                    <input type="date" class="bm-call-input" id="callDate" onchange="updateHidden('bookingDate', this.value)" style="margin-bottom: 0;" required>
                                </div>
                                <div class="col-md-6">
                                    <select class="bm-call-input bm-call-select" id="callTime" onchange="updateHidden('bookingTime', this.value)" style="margin-bottom: 0;" required>
                                        <option value="" selected disabled>Select a time</option>
                                        <option>09:00 AM</option>
                                        <option>10:00 AM</option>
                                        <option>11:00 AM</option>
                                        <option>01:00 PM</option>
                                        <option>02:00 PM</option>
                                    </select>
                                </div>
                            </div>
                            
                            <textarea class="bm-call-input" rows="4" placeholder="Message" id="callMessage" style="resize: none;"></textarea>

                            <button type="submit" class="btn btn-primary" style="padding: 12px 40px; border-radius: 0; font-weight: 600; width: auto; min-width: 140px;">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Initialize modal
        let bookModal = null;
        let selectedPerson = null;

        // Wait for DOM to be fully loaded
        document.addEventListener("DOMContentLoaded", function() {
            // Initialize modal
            bookModal = new bootstrap.Modal(document.getElementById("bookModal"));

            // Add click event to the book button
            document
                .querySelector(".btn-book")
                .addEventListener("click", function() {
                    showStep(1);
                    bookModal.show();
                });

            // Set minimum date to today for date inputs
            const today = new Date().toISOString().split("T")[0];
            document.querySelectorAll('input[type="date"]').forEach((input) => {
                input.min = today;
            });
        });

        function setBookingType(type) {
            document.getElementById('bookingType').value = type;
        }

        function updateHidden(id, value) {
            document.getElementById(id).value = value;
        }

        // Select person card (new grid style)
        function selectPersonCard(el, name, type) {
            const grid = el.closest('.bm-person-grid');
            grid.querySelectorAll('.bm-person-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
            selectedPerson = name;
            document.getElementById('bookingStaff').value = name;
            const textEl = document.getElementById(type + 'MeetingText');
            if (textEl) {
                textEl.textContent = 'Meeting with ' + name;
            }
        }

        // Select beverage card
        function selectBeverage(el, name) {
            const grid = el.closest('.bm-beverage-grid');
            grid.querySelectorAll('.bm-bev-card').forEach(c => c.classList.remove('selected'));
            el.classList.add('selected');
        }

        // Show specific step in the modal
        function showStep(step, type = "") {
            // Hide all steps first
            document.querySelectorAll(".modal-step").forEach((el) => {
                el.classList.add("d-none");
                // Disable inputs in hidden steps so they don't trigger HTML5 validation
                el.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = true;
                });
            });

            // Toggle wide modal for step 3 visit
            const dialog = document.querySelector('#bookModal .modal-dialog');
            if (step === 3 && type === 'visit') {
                dialog.classList.add('bm-wide');
            } else {
                dialog.classList.remove('bm-wide');
            }

            // Show the selected step
            const stepId = type ? `step${step}-${type}` : `step${step}`;
            const stepElement = document.getElementById(stepId);
            if (stepElement) {
                stepElement.classList.remove("d-none");
                // Enable inputs in visible step
                stepElement.querySelectorAll('input, select, textarea').forEach(input => {
                    input.disabled = false;
                });
            }

            // If it's the first step, reset the form
            if (step === 1) {
                resetForm();
            }

            // Scroll to top of modal when step changes
            const modalContent = document.querySelector(".modal-content");
            if (modalContent) {
                modalContent.scrollTop = 0;
            }
        }

        // Select a person
        function selectPerson(element, name) {
            // Remove selected class from all person cards
            document.querySelectorAll(".person-card").forEach((card) => {
                card.classList.remove("selected");
            });

            // Add selected class to clicked card
            element.classList.add("selected");
            selectedPerson = name;
            document.getElementById('bookingStaff').value = name;

            // Update the checkmark icons
            const checkIcons = element.parentElement.querySelectorAll(
                ".fa-check-circle, .fa-circle"
            );
            checkIcons.forEach((icon) => {
                if (icon.classList.contains("fa-check-circle")) {
                    icon.style.display = "block";
                } else {
                    icon.style.display = "none";
                }
            });
        }

        // Reset form
        function resetForm() {
            selectedPerson = null;
            document.getElementById('bookingForm').reset();
            document.querySelectorAll(".person-card").forEach((card) => {
                card.classList.remove("selected");
                const checkIcons = card.querySelectorAll(
                    ".fa-check-circle, .fa-circle"
                );
                checkIcons.forEach((icon) => {
                    if (icon.classList.contains("fa-check-circle")) {
                        icon.style.display = "none";
                    } else {
                        icon.style.display = "block";
                    }
                });
            });
        }

        // Function to open reschedule modal
        function openRescheduleModal() {
            // First close any open modals
            const existingModal = document.getElementById("rescheduleModal");
            if (existingModal) {
                const modal = bootstrap.Modal.getInstance(existingModal);
                if (modal) modal.hide();
                existingModal.remove();
            }

            // Create and append the modal
            const modalHTML = `
      <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="rescheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 500px;">
          <div class="modal-content" style="border: none; border-radius: 0; padding: 20px 40px 40px;">
            <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" style="padding: 20px 0 0;">
              <h3 style="color: #383E42; font-weight: 800; font-size: 32px; margin-bottom: 20px; letter-spacing: -0.5px;">Reschedule the call</h3>
              
              <div style="margin-bottom: 30px;">
                <p style="color: #383E42; font-size: 12px; margin-bottom: 12px;">Your previous meeting was at</p>
                <p style="color: #383E42; font-size: 11px; margin: 0;">Date & Time: <strong>3 March 2021, 01:30 PM</strong></p>
                <p style="color: #383E42; font-size: 11px; margin: 0;">Phone: <strong>35 478 90 00</strong></p>
              </div>

              <div style="margin-bottom: 24px;">
                <h5 style="color: #383E42; font-weight: 800; font-size: 18px; margin-bottom: 8px;">60 Minute Call</h5>
                <p style="color: #383E42; font-size: 11px; margin: 0; font-weight: 600;"><i class="fas fa-clock" style="color: #383E42; margin-right: 4px;"></i> 1 Hour</p>
              </div>

              <div style="margin-bottom: 16px;">
                <input type="text" class="bm-call-input" placeholder="First Name *" style="margin-bottom: 0;" required>
              </div>
              <div style="margin-bottom: 16px;">
                <input type="tel" class="bm-call-input" placeholder="Your Phone Number" style="margin-bottom: 0;">
              </div>
              <div class="row" style="margin-bottom: 16px; row-gap: 16px;">
                <div class="col-md-6">
                    <input type="date" class="bm-call-input" id="rescheduleDate" style="margin-bottom: 0; color: #383E42;">
                </div>
                <div class="col-md-6">
                    <select class="bm-call-input bm-call-select" id="rescheduleTime" style="margin-bottom: 0; color: #383E42;">
                        <option value="">Select a time</option>
                        <option>09:00 AM</option>
                        <option>10:00 AM</option>
                        <option>11:00 AM</option>
                        <option>01:00 PM</option>
                        <option>02:00 PM</option>
                        <option>03:00 PM</option>
                    </select>
                </div>
              </div>
              <div style="margin-bottom: 24px;">
                <textarea class="bm-call-input" rows="4" placeholder="Message" style="resize: none; margin-bottom: 0;"></textarea>
              </div>

              <button type="button" class="btn btn-primary" onclick="submitReschedule()" style="padding: 12px 40px; background: #383E42; border: none; border-radius: 0; font-weight: 600;">Submit</button>
            </div>
          </div>
        </div>
      </div>`;

            // Add modal to body
            document.body.insertAdjacentHTML("beforeend", modalHTML);

            // Initialize and show the modal
            const modalElement = document.getElementById("rescheduleModal");
            const modal = new bootstrap.Modal(modalElement);
            modal.show();

            // Set minimum date to today
            const today = new Date().toISOString().split("T")[0];
            document.getElementById("rescheduleDate").min = today;
        }

        // Auto-open logic for reschedule
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('reschedule')) {
                // Short timeout to ensure other init elements are ready
                setTimeout(openRescheduleModal, 500);
            }
            if (urlParams.has('cancel')) {
                setTimeout(openCancelModal, 500);
            }
        });

        // Function to handle reschedule submission
        function submitReschedule() {
            const date = document.getElementById("rescheduleDate").value;
            const time = document.getElementById("rescheduleTime").value;

            if (!date || !time) {
                alert("Please select both date and time");
                return;
            }

            // Here you would typically send this data to your server
            console.log("Rescheduling to:", date, time);

            // Show success message
            alert("Your appointment has been rescheduled successfully!");

            // Close the modal
            const modal = bootstrap.Modal.getInstance(
                document.getElementById("rescheduleModal")
            );
            if (modal) modal.hide();
        }

        // Function to open cancel confirmation modal
        function openCancelModal() {
            // First close any open modals
            const existingModal = document.getElementById("cancelModal");
            if (existingModal) {
                const modal = bootstrap.Modal.getInstance(existingModal);
                if (modal) modal.hide();
                existingModal.remove();
            }

            // Create and append the modal
            const modalHTML = `
      <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 550px;">
          <div class="modal-content" style="border: none; border-radius: 0; padding: 20px 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
            </div>
            <div class="modal-body" style="padding: 20px 0 10px;">
              <p style="color: #383E42; font-size: 11px; margin-bottom: 8px;">Your meeting details:</p>
              
              <div style="display: flex; gap: 40px; margin-bottom: 24px; color: #383E42; font-size: 11px;">
                <p style="margin: 0;">Date: <strong>3 March 2021, 01:30 PM</strong></p>
                <p style="margin: 0;">Phone: <strong>35 478 90 00</strong></p>
              </div>
              
              <h3 style="color: #383E42; font-weight: 800; font-size: 34px; margin-bottom: 40px; letter-spacing: -0.5px;">Cancel the call</h3>
              
              <p style="color: #383E42; font-size: 12px; margin-bottom: 12px;">You can cancel your meeting by clicking the button below</p>

              <button type="button" class="btn btn-outline-primary w-100" onclick="confirmCancellation()" style="border: 1px solid #d1e2ff; color: #383E42; background: #fff; padding: 14px; font-weight: 600; font-size: 13px; border-radius: 0; transition: background 0.2s;">
                Cancel a Meeting
              </button>
            </div>
          </div>
        </div>
      </div>`;

            // Add modal to body
            document.body.insertAdjacentHTML("beforeend", modalHTML);

            // Initialize and show the modal
            const modalElement = document.getElementById("cancelModal");
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }

        // Function to handle cancellation confirmation
        function confirmCancellation() {
            // Here you would typically send cancellation to your server
            console.log("Cancelling appointment...");

            // Show success message
            alert("Your appointment has been cancelled successfully.");

            // Close the modal
            const modal = bootstrap.Modal.getInstance(
                document.getElementById("cancelModal")
            );
            if (modal) modal.hide();

            // Optionally, redirect or refresh the page
            // window.location.reload();
        }
    </script>
    <script src="{{ asset('frontend_assets/js/main.js') }}"></script>
    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content" style="border: none; border-radius: 0px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <h2 style="color: #383E42; font-weight: 800; font-size: 32px; margin-bottom: 8px;">Sign Up</h2>
                    <p style="color: #383E42; font-size: 12px; margin-bottom: 30px;">To add this item to the favorite board</p>

                    <!-- Google Button -->
                    <button type="button" onclick="googleSignUp()" class="btn btn-outline-primary w-100 mb-4" style="border: 1px solid #93c5fd; color: #383E42; background: #fff; padding: 12px; font-weight: 500; font-size: 13px; border-radius: 0; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fab fa-google"></i> Sign Up with Google
                    </button>

                    <!-- Divider -->
                    <div style="display: flex; align-items: center; text-align: center; color: #60a5fa; font-size: 11px; margin-bottom: 24px;">
                        <div style="flex: 1;"></div>
                        <span style="padding: 0 10px; color: #383E42;">Or</span>
                        <div style="flex: 1;"></div>
                    </div>

                    <!-- Form Content -->
                    <form action="#" method="POST" style="text-align: left;">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" placeholder="Full Name" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Your Email" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                        </div>
                        <div class="mb-3">
                            <select class="form-select" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42; box-shadow: none;">
                                <option selected disabled>Position</option>
                                <option value="Manager">Manager</option>
                                <option value="Employee">Employee</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" placeholder="Password" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                        </div>

                        <div class="mb-4 form-check d-flex align-items-center mb-0 px-0">
                            <!-- Custom checkbox styling -->
                            <input type="checkbox" class="form-check-input mt-0 me-2" id="termsCheck" style="border-radius: 0; border: 1px solid #bfdbfe; width: 16px; height: 16px; cursor: pointer; flex-shrink: 0; margin-left: 0;">
                            <label class="form-check-label" for="termsCheck" style="color: #383E42; font-size: 14px; cursor: pointer;">
                                I agree to the terms & conditions
                            </label>
                        </div>

                        <button type="button" onclick="handleSignUp(event)" class="btn btn-primary w-100 mt-4 mb-4" style="background: #383E42; border: none; padding: 14px; font-weight: 600; font-size: 13px; border-radius: 0;">
                            Sign Up
                        </button>

                        <div class="text-center" style="font-size: 14px; color: #383E42;">
                            Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signinModal" data-bs-dismiss="modal" style="color: #383E42; text-decoration: none; font-weight: 700;">Sign In</a>
                        </div>
                    </form>

                    <script>
                        function showCreateBoardModal() {
                            const signupModal = bootstrap.Modal.getInstance(document.getElementById('signupModal'));
                            if(signupModal) signupModal.hide();
                            
                            const createBoardModal = new bootstrap.Modal(document.getElementById('createBoardModal'));
                            createBoardModal.show();
                        }
                    
                        function googleSignUp() {
                            // Integrate with Google API here. On success:
                            showCreateBoardModal();
                        }
                        
                        function handleSignUp(e) {
                            e.preventDefault();
                            // Validate and submit signup data here. On success:
                            showCreateBoardModal();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Signin Modal -->
    <div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content" style="border: none; border-radius: 0px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <h2 style="color: #383E42; font-weight: 800; font-size: 32px; margin-bottom: 8px;">Sign In</h2>
                    <p style="color: #383E42; font-size: 12px; margin-bottom: 30px;">To add this item to the favorite board</p>

                    <!-- Google Button -->
                    <button type="button" onclick="googleSignIn()" class="btn btn-outline-primary w-100 mb-4" style="border: 1px solid #93c5fd; color: #383E42; background: #fff; padding: 12px; font-weight: 500; font-size: 13px; border-radius: 0; display: flex; align-items: center; justify-content: center; gap: 8px;">
                        <i class="fab fa-google"></i> Sign In with Google
                    </button>

                    <!-- Divider -->
                    <div style="display: flex; align-items: center; text-align: center; color: #60a5fa; font-size: 11px; margin-bottom: 24px;">
                        <div style="flex: 1;"></div>
                        <span style="padding: 0 10px; color: #383E42;">Or</span>
                        <div style="flex: 1;"></div>
                    </div>

                    <!-- Form Content -->
                    <form action="#" method="POST" style="text-align: left;">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" placeholder="Email" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                        </div>
                        <div class="mb-4">
                            <input type="password" class="form-control" placeholder="Password" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                        </div>

                        <div class="mb-4 form-check d-flex align-items-center mb-0 px-0">
                            <!-- Custom checkbox styling -->
                            <input type="checkbox" class="form-check-input mt-0 me-2" id="signinTermsCheck" style="border-radius: 0; border: 1px solid #bfdbfe; width: 16px; height: 16px; cursor: pointer; flex-shrink: 0; margin-left: 0;">
                            <label class="form-check-label" for="signinTermsCheck" style="color: #383E42; font-size: 14px; cursor: pointer;">
                                I agree to the terms & conditions
                            </label>
                        </div>

                        <button type="button" onclick="handleSignIn(event)" class="btn btn-primary w-100 mt-4 mb-4" style="background: #383E42; border: none; padding: 14px; font-weight: 600; font-size: 13px; border-radius: 0;">
                            Log In
                        </button>

                        <div class="text-center" style="font-size: 14px; color: #383E42;">
                            Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal" style="color: #383E42; text-decoration: none; font-weight: 700;">Sign Up</a>
                        </div>
                    </form>

                    <script>
                        function googleSignIn() {
                            // Integrate with Google API here. On success:
                            window.location.href = "{{ route('user.profile') }}";
                        }
                        
                        function handleSignIn(e) {
                            e.preventDefault();
                            // Validate and submit signin data here. On success:
                            window.location.href = "{{ route('user.profile') }}";
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Board Modal -->
    <div class="modal fade" id="createBoardModal" tabindex="-1" aria-labelledby="createBoardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content" style="border: none; border-radius: 0px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <h2 style="color: #383E42; font-weight: 800; font-size: 24px; margin-bottom: 30px;">Create new board</h2>

                    <form action="#" method="POST" style="text-align: left;" onsubmit="handleCreateBoard(event)">
                        @csrf
                        <div class="mb-4">
                            <input type="text" class="form-control" placeholder="Board Name" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #383E42;" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-2" style="background: #383E42; border: none; padding: 14px; font-weight: 600; font-size: 13px; border-radius: 0;">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- My Board Modal -->
    <div class="modal fade" id="myBoardModal" tabindex="-1" aria-labelledby="myBoardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content" style="border: none; border-radius: 0px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <h2 style="color: #383E42; font-weight: 800; font-size: 24px; margin-bottom: 30px;">My Board</h2>

                    <div style="text-align: left; margin-bottom: 30px;">
                        <!-- List Item 1 -->
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="width: 60px; height: 45px; background: #eff0f0; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="" style="max-width: 60%; opacity: 0.5;">
                                </div>
                                <span style="color: #383E42; font-weight: 600; font-size: 13px;">Interior Design</span>
                            </div>
                            <i class="fas fa-check-circle" style="color: #383E42; font-size: 20px;"></i>
                        </div>

                        <!-- List Item 2 -->
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="width: 60px; height: 45px; background: #eff0f0; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="" style="max-width: 60%; opacity: 0.5;">
                                </div>
                                <span style="color: #383E42; font-weight: 600; font-size: 13px;">Architecture</span>
                            </div>
                        </div>

                        <!-- List Item 3 -->
                        <div style="display: flex; align-items: center; justify-content: space-between;">
                            <div style="display: flex; align-items: center; gap: 15px;">
                                <div style="width: 60px; height: 45px; background: #eff0f0; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ asset('frontend_assets/images/logo.png') }}" alt="" style="max-width: 60%; opacity: 0.5;">
                                </div>
                                <span style="color: #383E42; font-weight: 600; font-size: 13px;">Corporate interior</span>
                            </div>
                        </div>
                    </div>

                    <hr style="border-color: #e1efff; margin-bottom: 25px;">

                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <a href="#" onclick="openCreateBoardFromMyBoard(event)" style="color: #383E42; font-weight: 600; font-size: 13px; text-decoration: none; display: flex; align-items: center; gap: 8px;">
                            <span style="display: inline-flex; align-items: center; justify-content: center; width: 24px; height: 24px; background: #e1efff; border-radius: 50%;"><i class="fas fa-plus" style="font-size: 10px;"></i></span> Create new board
                        </a>
                        <a href="{{ route('user.profile') }}" class="btn btn-primary" style="background: #383E42; border: none; padding: 12px 40px; font-weight: 600; font-size: 13px; border-radius: 0;">
                            Save
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleCreateBoard(e) {
            e.preventDefault();
            // Close the modal
            const createBoardModal = bootstrap.Modal.getInstance(document.getElementById('createBoardModal'));
            if(createBoardModal) createBoardModal.hide();
            
            // Show notification
            showNotification();
        }

        function openMyBoardFromToast(e) {
            e.preventDefault();
            hideNotification();
            const myBoardModal = new bootstrap.Modal(document.getElementById('myBoardModal'));
            myBoardModal.show();
        }

        function openCreateBoardFromMyBoard(e) {
            e.preventDefault();
            const myBoardModal = bootstrap.Modal.getInstance(document.getElementById('myBoardModal'));
            if(myBoardModal) myBoardModal.hide();
            
            const createBoardModal = new bootstrap.Modal(document.getElementById('createBoardModal'));
            createBoardModal.show();
        }

        function showNotification() {
            const toast = document.getElementById('globalNotification');
            toast.style.display = 'block';
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                hideNotification();
            }, 5000);
        }

        function hideNotification() {
            const toast = document.getElementById('globalNotification');
            toast.style.display = 'none';
        }

        // --- GLOBAL CART FUNCTIONS ---
        function updateBadge() {
            fetch('{{ route("enquiry.basket.count") }}')
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('basket-badge');
                    if(badge) {
                        if(data.count > 0) {
                            badge.style.display = 'block';
                            badge.textContent = data.totalQty;
                        } else {
                            badge.style.display = 'none';
                        }
                    }
                });
        }

        function showBasketNotification(message) {
            const toast = document.getElementById('basketNotification');
            const msgEl = document.getElementById('basketNotificationMsg');
            if(msgEl) msgEl.textContent = message || "Item added to basket!";
            toast.style.display = 'block';
            
            // Auto hide after 3 seconds
            setTimeout(() => {
                hideBasketNotification();
            }, 3000);
        }

        function hideBasketNotification() {
            const toast = document.getElementById('basketNotification');
            if(toast) toast.style.display = 'none';
        }

        function addToBasket(productId, qty = 1) {
            fetch('{{ route("enquiry.basket.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ product_id: productId, qty: qty })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    updateBadge();
                    showBasketNotification(data.message);
                }
            })
            .catch(err => console.error("Error adding to basket", err));
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>