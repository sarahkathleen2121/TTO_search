@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/team-member.css') }}">

       <div class="tm-bg">
      <h2 class="tm-heading">Our  Creative Team</h2>

      <div class="tm-card">
        <button class="tm-close" onclick="history.back()" title="Close"><i class="fas fa-xmark"></i></button>
        <div class="row g-4 align-items-start">
          <div class="col-md-5">
            <div class="tm-left">
              <i class="fa-regular fa-user tm-avatar"></i>
            </div>
          </div>
          <div class="col-md-7">
            <h3 class="tm-name">Member One</h3>
            <div class="tm-role">Managing Partner</div>

            <div class="tm-section-title">Biography</div>
            <div class="tm-bio">
              Id magna nunc sed nulla convallis sagittis tristique tempus. Eget faucibus tellus urna facilisis et feugiat elementum. Dui nascetur tortor velit tincidunt faucibus ornare at nulla porttitor. Mi faucibus, id magna nunc sed nulla convallis sagittis tristique tempus. Eget faucibus tellus urna facilisis et feugiat elementum. Dui nascetur tortor velit tincidunt faucibus ornare at nulla porttitor. Mi faucibus. Dui nascetur tortor velit tincidunt faucibus ornare at nulla porttitor. Mi faucibus.
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-4">
        <div class="row g-3">
          <div class="col-md-6">
            <h4 class="text-primary fw-bold" style="opacity:.4">Name</h4>
            <p style="color:#383E42">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</p>
          </div>
        </div>
      </div>
    </div>
    @endsection
