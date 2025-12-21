<?php

namespace App\Mail;

use App\Models\SavingsSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmSavingsSubmissionMail extends Mailable
{
    use Queueable, SerializesModels;

    public SavingsSubmission $submission;

    /**
     * Create a new message instance.
     */
    public function __construct(SavingsSubmission $submission)
    {
        $this->submission = $submission;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Confirm Your SACCO Submission')
            ->view('emails.confirm-savings-submission');
    }
}
