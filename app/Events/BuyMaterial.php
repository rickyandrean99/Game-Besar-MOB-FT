<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BuyMaterial implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $receiver_id;
    public $material_list;
    public $message;
    public $coin;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($receiver_id, $material_list, $message, $coin)
    {
        $this->receiver_id = $receiver_id;
        $this->material_list = $material_list;
        $this->message = $message;
        $this->coin = $coin;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('buy-material.'.$this->receiver_id);
    }
}
