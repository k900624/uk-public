<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $feedback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from(config('settings.email_support'))
            ->view('mails.feedback')
            ->subject($this->feedback->subject)
            ->with('feedback', $this->feedback);

        if ($this->feedback->attach) {
            $files = unserialize($this->feedback->attach);
            foreach ($files as $file) {
                $mail->attach(storage_path($file['download_link']), ['as' => $file['original_name']]);
            }
        }
        return $mail;
    }
}
