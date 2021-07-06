<?php

namespace App\Events\Api\Setting;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RatingEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id, $type;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id,$type)
    {
        $this->id=$id; //data of user
        $this->type=$type; // body email
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
