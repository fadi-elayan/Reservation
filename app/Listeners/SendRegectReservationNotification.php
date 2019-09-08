<?php

namespace App\Listeners;

use App\Events\RejectReservation;
use App\Notifications\ReservationReject;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegectReservationNotification
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
     * @param  RejectReservation  $event
     * @return void
     */
    public function handle(RejectReservation $event)
    {
        $user = User::findOrFail($event->data->user_id);
        $user->notify(new ReservationReject($event->data));
    }
}
