<?php

namespace App\Listeners;

use App\Events\ReservationItem;
use App\Mail\SendEmailReservationInformation;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReservationItem  $event
     * @return void
     */
    public function handle(ReservationItem $event)
    {
        Mail::to(User::find($event->item->user))->send(new SendEmailReservationInformation($event->item));
    }
}
