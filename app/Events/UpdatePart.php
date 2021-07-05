<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatePart implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $collected;
    public $target;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($collected, $target)
    {
        $this->collected = $collected;
        $this->target = $target;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('partChannel');
    }

    public function broadcastAs()
    {
        return 'progress';
    }
}
