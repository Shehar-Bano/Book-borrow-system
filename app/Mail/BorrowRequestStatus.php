<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use App\Models\BorrowRequest;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowRequestStatus extends Mailable
{
    use Queueable, SerializesModels;
    public $borrowRequest;
    public $status;
    /**
     * Create a new message instance.
     */
    public function __construct(BorrowRequest $borrowRequest, $status)
    {
        $this->borrowRequest = $borrowRequest;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Borrow Request Status Update')
            ->view('emails.borrow_request_status');
    }




}