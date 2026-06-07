<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:visit,call',
            'staff_member' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company_name' => 'nullable|string|max:255',
        ]);

        $booking = Booking::create($request->all());

        // Send confirmation email
        Mail::to($booking->email)->send(new BookingConfirmation($booking));

        return redirect()->route('thank.you')->with([
            'booking_type' => $booking->type,
            'booking_date' => \Carbon\Carbon::parse($booking->date)->format('j F Y'),
            'booking_time' => $booking->time,
            'booking_phone' => $booking->phone,
        ]);
    }
}
