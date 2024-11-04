<?php

namespace App\Mail;

use App\Models\Faq;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class faqmail extends Mailable
{
    use Queueable, SerializesModels;

    public $faq; // Esta propiedad contendrá la información del FAQ

    /**
     * Create a new message instance.
     *
     * @param Faq $faq
     */
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Información de contacto - Nueva Pregunta Frecuente'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.faq-mail', // Asegúrate de que esta vista existe
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return []; // Si necesitas adjuntar archivos, puedes hacerlo aquí
    }
}
