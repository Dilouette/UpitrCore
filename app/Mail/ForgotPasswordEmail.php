<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ForgotPasswordEmail extends Mailable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $url;
    protected $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, String $url, String $token = null)
    {
        $this->user = $user;
        $this->token = $token;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(ENV('MAIL_FROM_ADDRESS'), ENV('MAIL_FROM_NAME'))
        ->view('mails.account.forgot-password')
        ->subject("Forgot Password")
        ->with([
            "name" => $this->user->firstname,
            "url" => $this->url,
            "token" => $this->token
        ]);
    }
}
