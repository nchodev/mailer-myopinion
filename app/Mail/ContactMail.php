<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public string $type;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data, string $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->data['subject'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->getTemplate(),
            with: [
                'data' => $this->data
            ],
        );
    }

  

    /**
     * Load view template depending on mail type.
     */
    private function getTemplate(): string
    {
        return match ($this->type) {
            'standard'     => 'emails.standard',
            'prospects'     => 'emails.prospects',
            'marketing'     => 'emails.marketing',
            'support'       => 'emails.support',
            'notification'  => 'emails.notification',
            default         => 'emails.contact',
        };
    }

    /**
     * Attachments
     */
    public function attachments(): array
    {
        return [];
    }
}
