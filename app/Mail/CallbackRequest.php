<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CallbackRequest extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly array $data) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('noreply@scs-technologies.com', 'SCS Technologies Website'),
            subject: 'Call Back Request — SCS Technologies',
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.callback-request');
    }
}
