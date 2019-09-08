<?php

namespace App\Listeners;

use App\Events\ItemUpload;
use App\Item;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddItem
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
     * @param  ItemUpload  $event
     * @return void
     */
    public function handle(ItemUpload $event)
    {
        Item::insertItem($event->request , $event->item);
    }
}
