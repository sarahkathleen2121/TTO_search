<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSignups = \App\Models\User::count();
        $totalCalls = \App\Models\Booking::where('type', 'call')->count();
        $totalVisits = \App\Models\Booking::where('type', 'visit')->count();

        return view('backend.pages.dashboard', compact('totalSignups', 'totalCalls', 'totalVisits'));
    }
}
