<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PostVisitSurvey extends Mailable
{
    use Queueable, SerializesModels;

    public Booking $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Thank You For Your Visit - The Total Office',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.post-visit-survey',
            with: [
                'booking' => $this->booking,
            ],
        );
    }
}
