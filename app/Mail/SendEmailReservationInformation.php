<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailReservationInformation extends Mailable
{
    use Queueable, SerializesModels;

    public $items;
    public function __construct($item)
    {
        $this->items = $item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.sendReservationItemEmail' , compact('price'));
    }
}
