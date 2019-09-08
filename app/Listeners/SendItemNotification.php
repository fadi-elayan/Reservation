<?php

namespace App\Listeners;

use App\Events\ItemUpload;
use App\Mail\SendEmilItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SendItemNotification
{

    public function __construct()
    {
        //
    }


    public function handle(ItemUpload $event)
    {
      //  Mail::to(Auth::user()->email)->send(new SendEmilItem($event->item));
    }
}
