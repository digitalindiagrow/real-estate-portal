<?php

namespace App\Mail;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PropertyEnquiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Property $property,
        public string $enquirerName,
        public string $enquirerPhone,
        public ?string $enquiryMessage,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "New enquiry for {$this->property->title}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.property-enquiry',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
