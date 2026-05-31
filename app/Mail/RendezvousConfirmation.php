<?php

namespace App\Mail;

use App\Models\Rendezvous;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RendezvousConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Rendezvous $rendezvous)
    {
        $this->rendezvous->load(['patient', 'medecin', 'service']);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Confirmation de Rendez-vous'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.rendezvous-confirmation',
        );
    }
}
