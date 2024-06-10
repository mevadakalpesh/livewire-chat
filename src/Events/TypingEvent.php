<?php

namespace App\Events\ChatApp;

use App\Events\ChatApp\ReceiverTypingEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TypingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data = [];

    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        ReceiverTypingEvent::dispatch($this->data);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('typing-' . $this->data['receiver_id'] . '-' . $this->data['sender_id']),
        ];
    }

    public function broadcastAs()
    {
        return 'TypingEvent';
    }
}
