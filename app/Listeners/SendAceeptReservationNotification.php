<?php

namespace App\Listeners;

use App\Events\AceeptReservation;
use App\Item;
use App\Notifications\Reservation;
use App\Notifications\ReservationAccept;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAceeptReservationNotification
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
     * @param  AceeptReservation  $event
     * @return void
     */
    public function handle(AceeptReservation $event)
    {
        $user = User::findOrFail($event->data->user_id);
        $user->notify(new ReservationAccept($event->data));
    }
}
