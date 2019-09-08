<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReservationItem
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    public $item;
    public function __construct($item , $data)
    {
        $this->data = $data;
        $this->item = $item;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
