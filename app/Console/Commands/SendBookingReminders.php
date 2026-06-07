<?php

namespace App\Console\Commands;

use App\Mail\BookingReminder;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendBookingReminders extends Command
{
    protected $signature = 'bookings:send-reminders';
    protected $description = 'Send reminder emails for bookings happening tomorrow';

    public function handle()
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $bookings = Booking::whereDate('date', $tomorrow)->get();

        $count = 0;
        foreach ($bookings as $booking) {
            if ($booking->email) {
                Mail::to($booking->email)->send(new BookingReminder($booking));
                $count++;
            }
        }

        $this->info("Sent {$count} reminder email(s) for bookings on {$tomorrow}.");

        return Command::SUCCESS;
    }
}
