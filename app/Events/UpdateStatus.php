<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateStatus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $team;
    public $attack_amount;
    public $receiver_id;
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($team, $attack_amount)
    {
        $this->team = $team;
        $this->attack_amount = $attack_amount;
        $this->receiver_id = $team->id;
        $this->message = "<tr><td><p><b>[ATTACK]</b><small> ".date('H:i:s')."</small><br><span>Berhasil melancarkan serangan sebesar ".$attack_amount."</span></p></td></tr>";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('update-status.'.$this->receiver_id);
    }
}
