<?php

namespace App\Events\Admin\Acl;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailVerifiedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $data, $details;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data,$details)
    {
        $this->data=$data; //data of user
        $this->details=$details; // body email
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
