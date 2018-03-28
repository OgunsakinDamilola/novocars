<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingSuccessful extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $userInfo;

    public $bookingInfo;

    public $bookingPaymentInfo;

    public function __construct($userInfo, $bookingInfo, $bookingPaymentInfo)
    {
        $this->userInfo           = $userInfo;
        $this->bookingInfo        = $bookingInfo;
        $this->bookingPaymentInfo = $bookingPaymentInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@novocars.com','Novo Cars')
        ->subject('Booking Successful')
        ->markdown('emails.BookingSuccessful');
    }
}
