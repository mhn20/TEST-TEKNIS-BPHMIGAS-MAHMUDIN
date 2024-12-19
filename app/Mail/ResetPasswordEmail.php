<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // You can customize the email subject and template here
        return $this->subject('Reset Your Password')
                    ->view('emails.reset-password') // Use a Blade template for the email content
                    ->with([
                        'resetLink' => $this->generateResetLink()
                    ]);
    }

    // Generate the reset password link
    private function generateResetLink()
    {
        // Assuming you have a route named `password.reset` for handling password resets
        // You can generate the URL to this route with the token included as a parameter
        return route('password.reset', ['token' => $this->token]);
    }
}
