<?php

namespace App\Listeners;

use App\Events\AceeptReservation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReadNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  AceeptReservation  $event
     * @return void
     */
    public function handle($event)
    {
       foreach (Auth::user()->unreadNotifications as $notification)
           if ($notification->id == $event->notify->id)
               $notification->markAsRead();
    }
}
