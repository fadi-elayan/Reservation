<?php

namespace App\Listeners;

use App\Events\ReservationItem;
use App\Notifications\Reservation;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendReservationNotification
{

    public function __construct()
    {
        //
    }


    public function handle(ReservationItem $event)
    {
        $user = User::findOrFail($event->item->user);
        $user->notify(new Reservation($event->item , $event->data));
    }
}
