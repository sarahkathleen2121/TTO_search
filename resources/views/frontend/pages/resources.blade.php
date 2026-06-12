@extends('frontend.layouts.master')
@section('title', 'Home - Welcome')
@section('content')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/resources.css') }}">

     <!-- Hero -->
    <section class="rc-hero">
      <div class="container">
        <div class="rc-breadcrumb"><a href="{{ route('home') }}">Home</a> / Resources</div>
        <h1 class="rc-title">Resources</h1>
        <p class="rc-sub">Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat.</p>
      </div>
    </section>

    <section>
      <div class="container">
        <!-- Toolbar -->
        <div class="rc-toolbar">
          <form class="rc-search" action="{{ route('resources') }}" method="GET">
            @if(request('category'))
              <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <input type="text" name="search" placeholder="Search" value="{{ request('search') }}" />
            <button type="submit" aria-label="search"><i class="fa fa-magnifying-glass"></i></button>
          </form>
          
          <div class="rc-select-wrapper">
             <i class="fa fa-chevron-down rc-select-arrow"></i>
             <select class="form-select rc-select" onchange="location = this.value;">
                <option value="{{ route('resources', ['category' => 'All']) }}" {{ request('category') == 'All' || !request('category') ? 'selected' : '' }}>Show: All</option>
                @foreach($categories as $cat)
                    <option value="{{ route('resources', ['category' => $cat->slug]) }}" {{ request('category') == $cat->slug ? 'selected' : '' }}>Show: {{ $cat->name }}</option>
                @endforeach
              </select>
          </div>

          <div class="rc-select-wrapper">
             <i class="fa fa-chevron-down rc-select-arrow"></i>
             <select class="form-select rc-select">
                <option selected>Sort By</option>
                <option>Newest</option>
                <option>Oldest</option>
                <option>A — Z</option>
                <option>Z — A</option>
             </select>
          </div>
        </div>

        <!-- Grid -->
        <div class="row g-4">
          @forelse($blogs as $blog)
            @if($loop->index == 0)
              {{-- First card is larger --}}
              <div class="col-lg-8">
                <div class="rc-card">
                  <a href="{{ route('resource.detail', $blog->slug) }}" class="rc-card-link-overlay"></a>
                  <div class="rc-card-top">
                    <i class="fa-regular fa-bookmark rc-pin"></i>
                    @if($blog->categories && $blog->categories->isNotEmpty())
                      <div class="position-absolute d-flex flex-wrap gap-1" style="right: 15px; top: 15px; z-index: 5; justify-content: flex-end; max-width: calc(100% - 60px);">
                        @foreach($blog->categories as $cat)
                          <span class="rc-badge position-static" style="margin: 0; padding: 4px 8px; font-size: 10px;">{{ $cat->name }}</span>
                        @endforeach
                      </div>
                    @endif
                    <img src="{{ $blog->featuredImageUrl() }}" alt="{{ $blog->image_alt }}">
                  </div>
                  <div class="rc-card-body">
                    <h4 class="rc-name">{{ $blog->title }}</h4>
                    <p class="rc-desc">{{ Str::limit(strip_tags($blog->content), 150) }}</p>
                    <a class="rc-link" href="{{ route('resource.detail', $blog->slug) }}">Read More <i class="fa-solid fa-chevron-right ms-1" style="font-size: 12px"></i></a>
                  </div>
                </div>
              </div>
            @elseif($loop->index == 1)
              {{-- Second card is smaller --}}
              <div class="col-lg-4">
                <div class="rc-card">
                  <a href="{{ route('resource.detail', $blog->slug) }}" class="rc-card-link-overlay"></a>
                  <div class="rc-card-top">
                    <i class="fa-regular fa-bookmark rc-pin"></i>
                    @if($blog->categories && $blog->categories->isNotEmpty())
                      <div class="position-absolute d-flex flex-wrap gap-1" style="right: 15px; top: 15px; z-index: 5; justify-content: flex-end; max-width: calc(100% - 60px);">
                        @foreach($blog->categories as $cat)
                          <span class="rc-badge position-static" style="margin: 0; padding: 4px 8px; font-size: 10px;">{{ $cat->name }}</span>
                        @endforeach
                      </div>
                    @endif
                    <img src="{{ $blog->featuredImageUrl() }}" alt="{{ $blog->image_alt }}">
                  </div>
                  <div class="rc-card-body">
                    <h5 class="rc-name">{{ $blog->title }}</h5>
                    <p class="rc-desc">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                    <a class="rc-link" href="{{ route('resource.detail', $blog->slug) }}">Read More <i class="fa-solid fa-chevron-right ms-1" style="font-size: 12px"></i></a>
                  </div>
                </div>
              </div>
            @else
              {{-- All subsequent cards are standard size --}}
              <div class="col-md-6 col-lg-4">
                <div class="rc-card">
                  <a href="{{ route('resource.detail', $blog->slug) }}" class="rc-card-link-overlay"></a>
                  <div class="rc-card-top">
                    <i class="fa-regular fa-bookmark rc-pin"></i>
                    @if($blog->categories && $blog->categories->isNotEmpty())
                      <div class="position-absolute d-flex flex-wrap gap-1" style="right: 15px; top: 15px; z-index: 5; justify-content: flex-end; max-width: calc(100% - 60px);">
                        @foreach($blog->categories as $cat)
                          <span class="rc-badge position-static" style="margin: 0; padding: 4px 8px; font-size: 10px;">{{ $cat->name }}</span>
                        @endforeach
                      </div>
                    @endif
                    <img src="{{ $blog->featuredImageUrl() }}" alt="{{ $blog->image_alt }}">
                  </div>
                  <div class="rc-card-body">
                    <h5 class="rc-name">{{ $blog->title }}</h5>
                    <p class="rc-desc">{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                    <a class="rc-link" href="{{ route('resource.detail', $blog->slug) }}">Read More <i class="fa-solid fa-chevron-right ms-1" style="font-size: 12px"></i></a>
                  </div>
                </div>
              </div>
            @endif
          @empty
          <div class="col-12 text-center py-5">
            <h4 class="text-primary">No resources found.</h4>
          </div>
          @endforelse
        </div>
        <div class="d-flex justify-content-center my-5">
          {{ $blogs->links('pagination::bootstrap-4') }}
        </div>
      </div>
    </section>
    @endsection
