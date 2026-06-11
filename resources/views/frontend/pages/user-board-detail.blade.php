@extends('frontend.layouts.master')

@section('title', 'Board Detail')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/user-board-detail.css') }}">
@endpush

@section('content')

    <!-- Board Detail Header -->
    <section class="bd-header">
        <div class="container">
            <!-- Back Button -->
            <a href="{{ route('user.profile') }}" class="bd-back-btn">
                <i class="fas fa-arrow-left"></i> All Boards
            </a>

            <!-- Board Title -->
            <h1 class="bd-title">Interior Design</h1>

            <!-- Creator Info & Actions Row -->
            <div class="bd-info-row">
                <div class="bd-creator">
                    <div class="bd-creator-avatar">
                        <i class="far fa-user"></i>
                    </div>
                    <span>Created by John Morison</span>
                </div>
                <div class="bd-actions">
                    <button type="button" class="bd-action-btn" data-bs-toggle="modal" data-bs-target="#shareBoardModal">Share</button>
                    <button type="button" class="bd-action-btn" data-bs-toggle="modal" data-bs-target="#editBoardModal">Edit board</button>
                    <button type="button" class="bd-action-btn">Delete board</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Board Detail Content -->
    <section class="bd-content">
        <div class="container">

            <!-- ========== EMPTY STATE DEMO ========== -->
            <div class="bd-empty-state">
                <h2>No items in this board</h2>
                <p>
                    Add 
                    <a href="#">Projects</a> 
                    <a href="#">Insights</a> 
                    <a href="#">Moodboards</a> 
                    <a href="#">Case Studies</a> 
                    to this board
                </p>
            </div>

            <hr style="border-color: #e1efff; margin: 50px 0;">
            <p style="text-align: center; color: #93c5fd; font-size: 12px; margin-bottom: 40px;"><em>Below is the populated state (when items exist in the board)</em></p>

            <!-- ========== POPULATED STATE DEMO ========== -->
            <!-- Filters Row -->
            <div class="bd-filters">
                <div class="bd-filter-tabs">
                    <a href="#" class="bd-filter-tab active">All</a>
                    <a href="#" class="bd-filter-tab">Products</a>
                    <a href="#" class="bd-filter-tab">Moodboards</a>
                    <a href="#" class="bd-filter-tab">Insights</a>
                    <a href="#" class="bd-filter-tab">Case Studies</a>
                </div>
                <div>
                    <select class="bd-sort-select">
                        <option value="latest">Latest</option>
                        <option value="oldest">Oldest</option>
                    </select>
                </div>
            </div>

            <!-- Cards Grid -->
            <div class="bd-cards-grid">
                <!-- Card 1: Insights -->
                <div class="bd-card">
                    <div class="bd-card-image">
                        <span class="bd-bookmark"><i class="fas fa-bookmark"></i></span>
                        <span class="bd-badge">Insights</span>
                    </div>
                    <h3 class="bd-card-title">Long headline to turn your visitors into users</h3>
                    <p class="bd-card-desc">Lorem ipsum dolor sit amet, consectetur....</p>
                </div>

                <!-- Card 2: Product -->
                <div class="bd-card">
                    <div class="bd-card-image">
                        <span class="bd-bookmark"><i class="fas fa-bookmark"></i></span>
                        <span class="bd-badge">Product</span>
                    </div>
                    <h3 class="bd-card-title">Native Light Chair</h3>
                </div>

                <!-- Card 3: Moodboard -->
                <div class="bd-card">
                    <div class="bd-card-image">
                        <span class="bd-bookmark"><i class="fas fa-bookmark"></i></span>
                        <span class="bd-badge">Moodboard</span>
                    </div>
                    <h3 class="bd-card-title">Moss Upholstery Fabric</h3>
                    <p class="bd-card-desc">Dignissim sed sit sit mattis. Elit adipiscing pretium sed neque nam.</p>
                </div>
            </div>

        </div>
    </section>

    <!-- Edit Board Modal -->
    <div class="modal fade" id="editBoardModal" tabindex="-1" aria-labelledby="editBoardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content" style="border: none; border-radius: 0px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <h2 style="color: #383E42; font-weight: 800; font-size: 24px; margin-bottom: 30px;">Edit board</h2>
                    <form action="#" method="POST" style="text-align: left;">
                        @csrf
                        <div class="mb-4">
                            <input type="text" class="form-control" placeholder="Board Name" value="Interior Design" style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #1e40af;" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mb-2" style="background: #383E42; border: none; padding: 14px; font-weight: 600; font-size: 13px; border-radius: 0;">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Share Board Modal -->
    <div class="modal fade" id="shareBoardModal" tabindex="-1" aria-labelledby="shareBoardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content" style="border: none; border-radius: 0px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.08);">
                <div class="modal-header" style="border-bottom: none; padding: 0; justify-content: flex-end; position: absolute; right: 15px; top: 15px; z-index: 10;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: #383E42; background: #e1efff; width: 32px; height: 32px; border-radius: 50%; opacity: 1; display: flex; align-items: center; justify-content: center; font-size: 14px; margin: 0; padding: 0; box-shadow: none;"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body text-center" style="padding: 0;">
                    <p style="color: #383E42; font-size: 14px; font-weight: 500; margin-bottom: 5px;">Share your board:</p>
                    <h2 style="color: #383E42; font-weight: 800; font-size: 24px; margin-bottom: 30px;">Interior Design</h2>

                    <div style="background: #eff0f0; padding: 30px; margin-bottom: 30px; display: flex; align-items: center; justify-content: center;">
                        <img src="{{ asset('frontend_assets/images/banner_img.png') }}" alt="Board Preview" style="max-width: 80%; max-height: 180px; object-fit: contain;">
                    </div>

                    <div style="display: flex; gap: 10px; align-items: center;">
                        <input type="text" id="shareLinkInput" class="form-control" value="https://diedc.com/j80ZyyDxUbk" readonly style="background: #eff6ff; border: none; padding: 14px 16px; border-radius: 0; font-size: 13px; color: #1e40af; flex: 1;">
                        <button type="button" onclick="copyShareLink()" class="btn btn-primary" style="background: #383E42; border: none; padding: 14px 22px; font-weight: 600; font-size: 13px; border-radius: 0; white-space: nowrap; display: flex; align-items: center; gap: 8px;">
                            <i class="far fa-copy"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyShareLink() {
            const input = document.getElementById('shareLinkInput');
            input.select();
            input.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(input.value);

            // Brief visual feedback
            const btn = event.currentTarget;
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
            setTimeout(() => { btn.innerHTML = originalText; }, 2000);
        }
    </script>

@endsection
