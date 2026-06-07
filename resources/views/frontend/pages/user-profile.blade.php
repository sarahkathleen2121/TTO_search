@extends('frontend.layouts.master')

@section('title', 'User Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/user-profile.css') }}">
@endpush

@section('content')

    <!-- Profile Header Section -->
    <section class="profile-header-section">
        <div class="container position-relative">
            <div class="row">
                <div class="col-12">
                    <div class="profile-user-info">
                        <div class="profile-avatar">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="profile-details">
                            <h1>John Morrison</h1>
                            <p>Design & Build Contractor</p>
                        </div>
                    </div>
                    
                    <div class="profile-header-actions">
                        <a href="#" class="btn btn-profile-outline">Edit cover photo</a>
                        <a href="#" class="btn btn-profile-outline">Edit profile</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Content Section -->
    <section class="profile-tabs-section">
        <div class="container">
            <!-- Tabs -->
            <div class="row">
                <div class="col-12">
                    <div class="profile-tabs">
                        <button type="button" class="profile-tab active" onclick="switchProfileTab(event, 'tab-boards')">Boards</button>
                        <button type="button" class="profile-tab" onclick="switchProfileTab(event, 'tab-insights')">Insights</button>
                        <button type="button" class="profile-tab" onclick="switchProfileTab(event, 'tab-products')">Products</button>
                        <button type="button" class="profile-tab" onclick="switchProfileTab(event, 'tab-profile')">My Profile</button>
                    </div>
                </div>
            </div>

            <!-- Boards Tab Content -->
            <div id="tab-boards" class="profile-tab-content">
                <!-- Empty State (No Boards) -->
                <div class="empty-state-boards" style="text-align: center; padding: 60px 0;">
                    <h2 style="color: #383E42; font-weight: 700; font-size: 24px; margin-bottom: 20px;">You don't have any saved boards</h2>
                    <p style="color: #383E42; font-size: 13px; font-weight: 500;">
                        Add 
                        <a href="#" style="color: #383E42; text-decoration: underline; font-weight: 700;">Projects</a> 
                        <a href="#" style="color: #383E42; text-decoration: underline; font-weight: 700; margin: 0 5px;">Insights</a> 
                        <a href="#" style="color: #383E42; text-decoration: underline; font-weight: 700; margin: 0 5px;">Moodboards</a> 
                        <a href="#" style="color: #383E42; text-decoration: underline; font-weight: 700;">Case Studies</a> 
                        to this board
                    </p>
                </div>

                <!-- Boards Grid (Populated State - hidden for demo of empty state, or backend logic will control visibility) -->
                <!-- <div class="row"> ... existing boards ... </div> -->
                <div class="row mt-5" style="opacity: 0.5;">
                    <div class="col-12 mb-3">
                        <small class="text-muted"><em>Demo: The above shows the empty state. Below are the populated cards (dulled out for demonstration).</em></small>
                    </div>
                    <!-- Board 1 -->
                    <div class="col-md-6">
                        <div class="board-card">
                            <a href="{{ route('user.board.detail') }}" style="text-decoration: none;">
                                <div class="board-card-images">
                                    <div class="board-main-image"></div>
                                    <div class="board-sub-image"></div>
                                    <div class="board-sub-image"></div>
                                    <div class="board-sub-image"></div>
                                </div>
                                <h3 class="board-title">Interior Design</h3>
                            </a>
                            <div class="board-meta">
                                <div class="board-meta-stats">
                                    <span>0 Projects</span>
                                    <span>0 Insights</span>
                                    <span>0 Moodboards</span>
                                    <span>0 Case Studies</span>
                                </div>
                                <div class="board-meta-date">
                                    <span>Apr 14, 2022</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Board 2 -->
                    <div class="col-md-6">
                        <div class="board-card">
                            <a href="{{ route('user.board.detail') }}" style="text-decoration: none;">
                                <div class="board-card-images">
                                    <div class="board-main-image"></div>
                                    <div class="board-sub-image"></div>
                                    <div class="board-sub-image"></div>
                                    <div class="board-sub-image"></div>
                                </div>
                                <h3 class="board-title">Interior Design</h3>
                            </a>
                            <div class="board-meta">
                                <div class="board-meta-stats">
                                    <span>0 Projects</span>
                                    <span>0 Insights</span>
                                    <span>0 Moodboards</span>
                                    <span>0 Case Studies</span>
                                </div>
                                <div class="board-meta-date">
                                    <span>Apr 14, 2022</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- My Profile Tab Content -->
            <div id="tab-profile" class="profile-tab-content d-none">
                <div class="row">
                    <!-- Profile Photo Editor -->
                    <div class="col-12 mb-5">
                        <div class="d-flex align-items-center gap-4">
                            <div class="profile-avatar" style="width: 140px; height: 140px;">
                                <i class="far fa-user" style="font-size: 60px;"></i>
                            </div>
                            <div>
                                <h3 style="color: #383E42; font-weight: 700; font-size: 20px; margin-bottom: 15px;">Profile photo</h3>
                                <div class="d-flex gap-3">
                                    <button type="button" class="btn btn-outline-primary" style="border: 1px solid #93c5fd; color: #383E42; padding: 10px 20px; font-weight: 600; font-size: 12px; border-radius: 0;">Edit profile photo</button>
                                    <button type="button" class="btn btn-outline-primary" style="border: 1px solid #93c5fd; color: #383E42; padding: 10px 20px; font-weight: 600; font-size: 12px; border-radius: 0;">Delete photo</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Forms Wrapper -->
                    <div class="row">
                        <!-- Account Info Form -->
                        <div class="col-md-6 mb-5">
                            <h3 style="color: #383E42; font-weight: 700; font-size: 18px; margin-bottom: 25px;">Account info</h3>
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="First Name" value="John" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" placeholder="Last Name" value="Morrison" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control" placeholder="Email" value="user@example.com" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <div class="mb-4">
                                    <input type="text" class="form-control" placeholder="Position" value="Manager" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <button type="submit" class="btn btn-primary w-100" style="background: #383E42; border: none; padding: 16px; font-weight: 600; font-size: 13px; border-radius: 0;">
                                    Update profile
                                </button>
                            </form>
                            
                            <!-- Delete Profile -->
                            <div class="mt-5 pt-3">
                                <button type="button" class="btn btn-outline-primary w-100" style="border: 1px solid #93c5fd; color: #383E42; background: transparent; padding: 16px; font-weight: 600; font-size: 13px; border-radius: 0;">
                                    Delete profile
                                </button>
                            </div>
                        </div>

                        <!-- Password Form -->
                        <div class="col-md-6 mb-5">
                            <h3 style="color: #383E42; font-weight: 700; font-size: 18px; margin-bottom: 25px;">Password</h3>
                            <form action="#" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="Current Password" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" placeholder="New Password" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <div class="mb-4">
                                    <input type="password" class="form-control" placeholder="Confirm New Password" style="background: #eff6ff; border: none; padding: 16px; border-radius: 0; font-size: 13px; color: #383E42;">
                                </div>
                                <!-- Note: Mockup doesn't explicitly show an 'update password' button but usually one is needed, I am omitting since it wasn't in the mockup exactly, leaving form tags ready. -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>

@endsection

@push('scripts')
<script>
    function switchProfileTab(e, targetId) {
        // Remove active class from all tabs
        const tabs = document.querySelectorAll('.profile-tab');
        tabs.forEach(tab => tab.classList.remove('active'));
        
        // Add active class to clicked tab
        e.currentTarget.classList.add('active');

        // Hide all tab contents
        const contents = document.querySelectorAll('.profile-tab-content');
        contents.forEach(content => content.classList.add('d-none'));

        // Show targeted tab content
        const target = document.getElementById(targetId);
        if (target) {
            target.classList.remove('d-none');
        }
    }
</script>
@endpush
