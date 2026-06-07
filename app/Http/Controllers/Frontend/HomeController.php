<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the frontend homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $industries = \App\Models\Industry::take(4)->get();
        $productTypes = \App\Models\ProductType::withCount('products')->get();
        $featuredProducts = \App\Models\Product::where('is_featured', true)->latest()->take(3)->get();
        $blogs = \App\Models\Blog::latest()->take(3)->get();

        return view('frontend.pages.index', compact('industries', 'productTypes', 'featuredProducts', 'blogs'));
    }
}
