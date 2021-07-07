<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateHitpoint implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $receiver_id;
    public $health;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($receiver_id, $health, $message)
    {
        $this->receiver_id = $receiver_id;
        $this->health = $health;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('update-hitpoint.'.$this->receiver_id);
    }
}
