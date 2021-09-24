<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $name;
    public $qntTemp;
    public $qntEp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name,$qntTemp,$qntEp)
    {
        $this->name = $name;
        $this->qntTemp = $qntTemp;
        $this->qntEp = $qntEp;
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
