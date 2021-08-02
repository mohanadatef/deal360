<?php

namespace App\Events\Api\Setting;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ViewEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id, $type,$auth_id,$ip_address;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id,$type,$ip_address,$auth_id)
    {
        $this->id=$id; //data of user
        $this->type=$type; // body email
        $this->auth_id=$auth_id; // body email
        $this->ip_address=$ip_address; // body email
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
