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
        $productTypes = \App\Models\ProductType::withCount('products')->get();
        $blogs = \App\Models\Blog::latest()->take(3)->get();

        return view('frontend.pages.index', compact('productTypes', 'blogs'));
    }
}
