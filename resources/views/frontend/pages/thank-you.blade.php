@extends('frontend.layouts.master')
@section('title', 'Thank You')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/thank-you.css') }}">

    <section class="ty-section">
        <div class="container">
            <div class="ty-content">
                <h1 class="ty-title">Thank you!</h1>
                
                @if(session('booking_type') === 'call')
                    <p class="ty-info">
                        We booked your call at <strong>{{ session('booking_date', '3 March 2021') }}, {{ session('booking_time', '01:30 PM') }}</strong><br>
                        We will give you a call at your number that you<br>
                        specified as <strong>{{ session('booking_phone', '35 478 90 00') }}</strong>
                    </p>
                    <p class="ty-reminder">We will send you a reminder to your email 1 day before the date</p>
                @else
                    <p class="ty-info">
                        We booked your visit at
                        <strong>{{ session('booking_date', '3 March 2021') }}, {{ session('booking_time', '01:30 PM') }}</strong>
                    </p>
                    <p class="ty-address">Attend to <strong>35 Jsh. street, building 2, office 415</strong></p>
                    <p class="ty-reminder">We will send you a reminder to your email 1 day before the visit</p>
                @endif
                
                <a href="{{ route('home') }}" class="ty-btn">Go back to homepage</a>
            </div>
        </div>
    </section>
@endsection
