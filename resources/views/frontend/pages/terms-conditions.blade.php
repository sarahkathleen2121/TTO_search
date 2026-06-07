@extends('frontend.layouts.master')

@section('title', 'Terms & Conditions')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/terms-conditions.css') }}">
@endpush

@section('content')

    <!-- Hero -->
    <section class="tc-hero">
        <div class="container">
            <div class="tc-breadcrumb">
                <a href="{{ route('home') }}">Home</a> / Terms & Conditions
            </div>
            <h1 class="tc-title">Terms & Conditions</h1>
        </div>
    </section>

    <!-- Content -->
    <section class="tc-content">
        <div class="container">

            <div class="tc-section">
                <h2>Ellentesque aliquam rutrum enim eu lorem lacinia.</h2>
                <p>
                    Nullam euismod ex vulputate venenatis mattis. Donec ex eros, efficitur non sagittis eu,
                    tempor in sem. Mauris lacinia eu enim vel fermentum. Phasellus risus quam, varius vel
                    fermentum non, eleifend sit amet ipsum. Proin sollicitudin ornare iaculis.
                </p>
                <p>
                    In et gravida tortor, eu volutpat mauris. Pellentesque habitant morbi tristique senectus
                    et netus et malesuada fames ac turpis egestas. Vivamus urna ex, convallis sit amet
                    arcu in, fermentum sollicitudin lacus. Class aptent taciti sociosqu ad litora torquent per
                    conubia nostra, per inceptos himenaeos. Nulla viverra at velit quis pretium.
                </p>
                <p>
                    Pellentesque et euismod arcu, sit amet sagittis neque. Pellentesque ornare elit at dui
                    vulputate, vel gravida elit aliquam. Quisque condimentum urna et est lobortis ornare.
                    Suspendisse interdum, arcu ut bibendum congue, felis ex bibendum libero, vel venenatis
                    nisi ante non elit.
                </p>
            </div>

            <div class="tc-section">
                <h2>Tempor incididunt ut labore et dolore magna aliqua</h2>
                <p>
                    Nullam euismod ex vulputate venenatis mattis. Donec ex eros, efficitur non sagittis eu,
                    tempor in sem. Mauris lacinia eu enim vel fermentum. Phasellus risus quam, varius vel
                    fermentum non, eleifend sit amet ipsum. Proin sollicitudin ornare iaculis.
                </p>
                <p>
                    In et gravida tortor, eu volutpat mauris. Pellentesque habitant morbi tristique senectus
                    et netus et malesuada fames ac turpis egestas. Vivamus urna ex, convallis sit amet
                    arcu in, fermentum sollicitudin lacus. Class aptent taciti sociosqu ad litora torquent per
                    conubia nostra, per inceptos himenaeos. Nulla viverra at velit quis pretium.
                </p>
                <p>
                    Pellentesque et euismod arcu, sit amet sagittis neque. Pellentesque ornare elit at dui
                    vulputate, vel gravida elit aliquam. Quisque condimentum urna et est lobortis ornare.
                    Suspendisse interdum, arcu ut bibendum congue, felis ex bibendum libero, vel venenatis
                    nisi ante non elit.
                </p>
            </div>

        </div>
    </section>

@endsection
