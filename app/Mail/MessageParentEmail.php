<?php

namespace App\Mail;

use App\Models\Students;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use App\Models\Parents;

class MessageParentEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $parent;
    public $mes;
    public $studentName;

    /**
     * Create a new message instance.
     */
    public function __construct(Parents $parent, $mes, $studentName)
    {
        $this->parent = $parent;
        $this->mes = $mes;
        $this->studentName = $studentName;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->view('mail.sentMessage')
            ->with('message', $this->mes);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bonjour Mr/Mlle ' . $this->parent->nom . ' ' . $this->parent->prenom . '. C est par rapport à notre fils ' . $this->studentName
        );
    }
}
