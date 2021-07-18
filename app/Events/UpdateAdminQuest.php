<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateAdminQuest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $team_list;
    public $success;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($team_list, $success)
    {
        $this->team_list = $team_list;
        $this->success = $success;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('adminQuest');
    }

    public function broadcastAs()
    {
        return 'status';
    }
}
