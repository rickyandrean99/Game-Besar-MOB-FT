<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateTable implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $id;
    public $stok;
    public $harga;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($id, $stok, $harga)
    {
        $this->id = $id;
        $this->stok = $stok;
        $this->harga = $harga;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('updateTable');
    }

    public function broadcastAs()
    {
        return 'material';
    }
}
