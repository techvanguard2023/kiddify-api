<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GuardianInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $inviter;
    public string $acceptUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(User $inviter, string $acceptUrl)
    {
        $this->inviter = $inviter;
        $this->acceptUrl = $acceptUrl;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Você foi convidado para gerenciar uma família no Kiddify!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Este será o template do nosso e-mail
        return new Content(
            view: 'emails.guardian-invitation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}