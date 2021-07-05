<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BroadcastVideo implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $broadcast_winner;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($broadcast_winner)
    {
        $this->broadcast_winner = $broadcast_winner;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('videoChannel');
    }

    public function broadcastAs()
    {
        return 'broadcast';
    }
}
