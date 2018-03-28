<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FailedPayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $userInfo;

    public $transactionStatus;


    public function __construct($userInfo, $transactionStatus)
    {
        $this->userInfo          = $userInfo;
        $this->transactionStatus = $transactionStatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@novocars.com','Novo Cars')
                    ->subject('Payment Failed')
                    ->markdown('emails.FailedPayment');
    }
}
