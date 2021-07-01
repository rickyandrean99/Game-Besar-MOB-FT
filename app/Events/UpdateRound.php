<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateRound implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $round;
    public $action;
    public $minutes;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($round, $action, $minutes)
    {
        $this->round = $round;
        $this->action = $action;
        $this->minutes = $minutes;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('roundChannel');
    }

    public function broadcastAs()
    {
        return 'update';
    }
}
