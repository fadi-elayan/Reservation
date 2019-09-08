<?php

namespace App\Listeners;

use App\Events\AceeptReservation;
use App\Reservation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfarmReservation
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
        Reservation::confiremResrvation($event->data);
    }
}
