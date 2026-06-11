<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\Auth\AdminLoginController;
use App\Http\Controllers\Backend\DashboardController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/booking', [App\Http\Controllers\Frontend\BookingController::class, 'store'])->name('booking.store');

// Legacy basket URL → contact page
Route::redirect('/enquiry-basket', '/contact', 301);
Route::redirect('/enquiry-basket/{any}', '/contact', 301)->where('any', '.*');

// Static Pages
Route::controller(App\Http\Controllers\Frontend\PageController::class)->group(function () {
    Route::get('/old-about', 'oldAbout')->name('old.about');
    Route::get('/about', 'about')->name('about');
    Route::get('/all-products', 'allProducts')->name('all.products');
    Route::get('/careers', 'careers')->name('careers');
    Route::get('/case-studies', 'caseStudies')->name('case.studies');
    Route::get('/case-study-detail', 'caseStudyDetail')->name('case.study.detail');
    Route::get('/conference-room-tables', 'conferenceRoomTables')->name('conference.room.tables');
    Route::get('/conference-rooms', 'conferenceRooms')->name('conference.rooms');
    Route::get('/space/{slug}', 'spaceDetail')->name('space.detail');
    Route::get('/brand/{slug}', 'brandDetail')->name('brand.detail');
    Route::get('/space/{space_slug}/{type_slug}', 'spaceProducts')->name('space.products');
    Route::get('/brand/{brand_slug}/{type_slug}', 'brandProducts')->name('brand.products');
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/csr', 'csr')->name('csr');
    Route::get('/esg', 'esg')->name('esg');
    Route::get('/ideal-workspace', 'idealWorkspace')->name('ideal.workspace');
    Route::get('/initiatives', 'initiatives')->name('initiatives');
    Route::get('/job-aci/{slug?}', 'jobAci')->name('job.aci');
    Route::get('/job-apply', 'jobApply')->name('job.apply');
    Route::get('/thank-you', 'thankYou')->name('thank.you');
    Route::get('/post-feedback', 'postFeedback')->name('post.feedback');
    Route::get('/make-enquiry/{slug?}', 'makeEnquiry')->name('make.enquiry');
    Route::get('/moodboard-detail', 'moodboardDetail')->name('moodboard.detail');
    Route::get('/moodboards', 'moodboards')->name('moodboards');
    Route::get('/product-detail/{slug?}', 'productDetail')->name('product.detail');
    Route::get('/products', 'productsType')->name('products.type');
    Route::get('/product/{slug}', 'productTypeDetail')->name('product_type.detail');
    Route::get('/product/{product_type_slug}/{space_slug}', 'productTypeSpace')->name('product_type.space');
    
    // Blog Frontend Routes
    Route::get('/blogs', 'resources')->name('resources');
    Route::get('/new-blogs/{slug}', 'resourceDetail')->name('resource.detail');
    
    Route::get('/service-detail', 'serviceDetail')->name('service.detail');
    Route::get('/service-listing', 'serviceListing')->name('service.listing');
    Route::get('/services', 'services')->name('services');
    Route::get('/shop-by-space', 'shopBySpace')->name('shop.by.space');
    Route::get('/shop-by-brands', 'shopByBrands')->name('shop.by.brands');
    Route::get('/sustainability', 'sustainability')->name('sustainability');
    Route::get('/team-member', 'teamMember')->name('team.member');
    Route::get('/user-dashboard', 'userDashboard')->name('user.dashboard');
    Route::get('/user-profile', 'userProfile')->name('user.profile');
    Route::get('/user-board-detail', 'userBoardDetail')->name('user.board.detail');
    Route::get('/search-results', 'searchResults')->name('search.results');
    Route::get('/privacy-policy', 'privacyPolicy')->name('privacy.policy');
    Route::get('/terms-conditions', 'termsConditions')->name('terms.conditions');
    Route::get('/return-refund-policy', 'returnRefundPolicy')->name('return.refund.policy');
    
    // Catch-all for other static pages
    Route::get('/page/{page}', 'show')->name('page.show');
});

// Legacy industry URLs → all products
Route::redirect('/shop-by-industry', '/all-products', 301);
Route::redirect('/hospitality', '/all-products', 301);
Route::redirect('/industry/{any}', '/all-products', 301)->where('any', '.*');

/*
|--------------------------------------------------------------------------
| Backend (Admin) Routes
|--------------------------------------------------------------------------
*/

// Admin Login Routes (Guest)
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
});

// Admin Protected Routes
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('bookings', App\Http\Controllers\Backend\BookingController::class)->only(['index', 'show']);
    
    // Content Management
    Route::post('blogs/upload-image', [App\Http\Controllers\Backend\BlogController::class, 'uploadImage'])->name('blogs.upload');
    Route::resource('blogs', App\Http\Controllers\Backend\BlogController::class);
    Route::resource('blog-categories', App\Http\Controllers\Backend\BlogCategoryController::class);
    Route::resource('moodboards', App\Http\Controllers\Backend\MoodboardController::class);
    
    // Catalog Management
    Route::resource('brands', App\Http\Controllers\Backend\BrandController::class);
    Route::resource('product-types', App\Http\Controllers\Backend\ProductTypeController::class);
    Route::resource('spaces', App\Http\Controllers\Backend\SpaceController::class);
    Route::resource('materials', App\Http\Controllers\Backend\MaterialController::class);
    Route::resource('colors', App\Http\Controllers\Backend\ColorController::class);
    Route::resource('products', App\Http\Controllers\Backend\ProductController::class);
    
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});
