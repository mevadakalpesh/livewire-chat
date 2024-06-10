<?php

namespace App\Events\ChatApp;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendMessagEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $data = [];

    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastAs()
    {
        return 'SendMessagEvent';
    }

    public function broadcastOn()
    {
        return new Channel('user_message-' . $this->data['receiver_id']);
    }
}
