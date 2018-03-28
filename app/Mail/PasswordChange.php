<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordChange extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $userInfo;

    public $password;

    public function __construct($userInfo, $password)
    {
        $this->userInfo = $userInfo;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@novocars.com','Novo Cars')
            ->subject('Password Change')
            ->markdown('emails.PasswordChange');
    }
}
