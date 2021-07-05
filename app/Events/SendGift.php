<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendGift implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $receiver_id;
    public $message;
    public $id_material;
    public $amount;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($receiver_id, $message, $id_material, $amount)
    {
        $this->receiver_id = $receiver_id;
        $this->message = $message;
        $this->id_material = $id_material;
        $this->amount = $amount;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('send-gift.'.$this->receiver_id);
    }
}
