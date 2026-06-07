@extends('frontend.layouts.master')

@section('title', '404 - Page Not Found')

@section('content')

    <section style="min-height: 70vh; display: flex; align-items: center; justify-content: center; background: #eff0f0;">
        <div style="text-align: center; padding: 60px 20px;">
            <p style="color: #383E42; font-size: 16px; font-weight: 500; margin-bottom: 10px;">error 404</p>
            <h1 style="color: #383E42; font-size: 42px; font-weight: 800; line-height: 1.3; margin-bottom: 25px;">
                Lost?<br>
                There's no place<br>
                like <a href="{{ route('home') }}" style="color: #383E42; text-decoration: underline; text-underline-offset: 4px;">home</a>.
            </h1>
            <p style="color: #383E42; font-size: 14px; font-weight: 400;">
                Breathe in, and on the out breath, go back and try again.
            </p>
        </div>
    </section>

@endsection
