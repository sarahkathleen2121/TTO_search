@extends('frontend.layouts.master')

@section('title', 'Home - Welcome')

@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/ideal-workspace.css') }}">


  <section class="iw-hero">
    <div class="container">
      <div class="iw-breadcrumb"><a href="{{ route('home') }}">Home</a> / <a href="{{ route('moodboards') }}">Bespoke Solutions</a> / The Ideal workspace</div>
      <h1 class="iw-title">The Ideal workspace</h1>
    </div>
  </section>

  <section class="iw-process-wrap">
    <div class="container">
      <h3 class="iw-process-heading">Our six step unique process</h3>

      <div class="iw-step open">
        <div class="iw-step-header" data-iw-toggle>
          <div class="row w-100 g-3 align-items-start m-0">
            <div class="col-md-4">
              <div class="iw-step-title">The Workspace Primer</div>
            </div>
            <div class="col-md-7">
              <div class="iw-step-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat Lorem ipsum dolor sit amet...</div>
            </div>
            <div class="col-md-1 d-flex justify-content-end">
              <div class="iw-step-icon">—</div>
            </div>
          </div>
        </div>
      </div>

      <div class="iw-step">
        <div class="iw-step-header" data-iw-toggle>
          <div class="row w-100 g-3 align-items-start m-0">
            <div class="col-md-4">
              <div class="iw-step-title">The Imagination Showcase</div>
            </div>
            <div class="col-md-7">
              <div class="iw-step-desc">Details about this step. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</div>
            </div>
            <div class="col-md-1 d-flex justify-content-end">
              <div class="iw-step-icon">+</div>
            </div>
          </div>
        </div>
      </div>

      <div class="iw-step">
        <div class="iw-step-header" data-iw-toggle>
          <div class="row w-100 g-3 align-items-start m-0">
            <div class="col-md-4">
              <div class="iw-step-title">The Three Haves</div>
            </div>
            <div class="col-md-7">
              <div class="iw-step-desc">Details about this step. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</div>
            </div>
            <div class="col-md-1 d-flex justify-content-end">
              <div class="iw-step-icon">+</div>
            </div>
          </div>
        </div>
      </div>

      <div class="iw-step">
        <div class="iw-step-header" data-iw-toggle>
          <div class="row w-100 g-3 align-items-start m-0">
            <div class="col-md-4">
              <div class="iw-step-title">The Communication Links</div>
            </div>
            <div class="col-md-7">
              <div class="iw-step-desc">Details about this step. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</div>
            </div>
            <div class="col-md-1 d-flex justify-content-end">
              <div class="iw-step-icon">+</div>
            </div>
          </div>
        </div>
      </div>

      <div class="iw-step">
        <div class="iw-step-header" data-iw-toggle>
          <div class="row w-100 g-3 align-items-start m-0">
            <div class="col-md-4">
              <div class="iw-step-title">Expected Delivered</div>
            </div>
            <div class="col-md-7">
              <div class="iw-step-desc">Details about this step. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</div>
            </div>
            <div class="col-md-1 d-flex justify-content-end">
              <div class="iw-step-icon">+</div>
            </div>
          </div>
        </div>
      </div>

      <div class="iw-step">
        <div class="iw-step-header" data-iw-toggle>
          <div class="row w-100 g-3 align-items-start m-0">
            <div class="col-md-4">
              <div class="iw-step-title">Day 2 - Training</div>
            </div>
            <div class="col-md-7">
              <div class="iw-step-desc">Details about this step. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</div>
            </div>
            <div class="col-md-1 d-flex justify-content-end">
              <div class="iw-step-icon">+</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    @include('frontend.partials.call_to_action')
  </section>
   <script>
    (function () {
      document.querySelectorAll('[data-iw-toggle]').forEach(function (h) {
        h.addEventListener('click', function () {
          var step = h.closest('.iw-step');
          var open = step.classList.contains('open');
          document.querySelectorAll('.iw-step').forEach(function (s) { 
              s.classList.remove('open'); 
              var icon = s.querySelector('.iw-step-icon');
              if(icon) icon.textContent = '+'; 
          });
          if (!open) { 
              step.classList.add('open'); 
              var icon = step.querySelector('.iw-step-icon'); 
              if (icon) icon.textContent = '—'; 
          }
        });
      });
    })();
  </script>
    @endsection
