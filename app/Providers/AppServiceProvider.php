<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Observers\ProductObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::defaultView('vendor.pagination.default');

        Product::observe(ProductObserver::class);

        RateLimiter::for('search', function (Request $request) {
            return Limit::perMinute(30)->by($request->ip());
        });

        \Illuminate\Support\Facades\View::composer('frontend.layouts.header', function ($view) {
            $view->with('productTypes', \App\Models\ProductType::orderBy('name')->get());
            $view->with('brands', \App\Models\Brand::orderBy('name')->get());
            $view->with('spaces', \App\Models\Space::orderBy('name')->get());
        });
    }
}
