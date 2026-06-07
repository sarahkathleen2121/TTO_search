@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/reminder-email-template.css') }}">
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="logo.png" alt="Company Logo" class="logo">
        </div>

        <!-- Main Content -->
        <div class="content">
            <h1>Friendly Reminder: Your Upcoming Appointment</h1>
            <p>Hello [Customer Name],</p>
            <p>This is a friendly reminder about your upcoming appointment with us. We're looking forward to seeing you!</p>

            <div class="event-details">
                <p><strong>Event:</strong> [Appointment/Meeting Name]</p>
                <p><strong>Date:</strong> [Date]</p>
                <p><strong>Time:</strong> [Time]</p>
                <p><strong>Location:</strong> [Location or Meeting Link]</p>
            </div>

            <p>If you need to reschedule or have any questions, please don't hesitate to contact us.</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="#" class="button">View Appointment Details</a>
            </div>

            <p>Best regards,<br>The Team</p>

            <div class="divider"></div>

            <p style="font-size: 14px; color: #6c757d;">
                This is an automated reminder. If you've already taken care of this or no longer wish to receive these
                reminders,
                please <a href="#" style="color: #383E42;">update your notification preferences</a>.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>© 2025 Your Company Name. All rights reserved.</p>
            <p>
                <a href="#" style="color: #6c757d; text-decoration: none; margin: 0 10px;">Privacy Policy</a> |
                <a href="#" style="color: #6c757d; text-decoration: none; margin: 0 10px;">Terms of Service</a> |
                <a href="#" style="color: #6c757d; text-decoration: none; margin: 0 10px;">Contact Us</a>
            </p>
            <p>Your Company Address, City, Country</p>
        </div>
    </div>
@endsection
