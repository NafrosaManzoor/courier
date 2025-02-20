<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrackingMailSend extends Mailable
{
    use Queueable, SerializesModels;

    public $referenceNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Parcel Tracking Number')
                    ->view('emails.tracking_mail');
    }
}