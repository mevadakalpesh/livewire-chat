<?php

namespace App\Listeners\ChatApp;

use App\Models\Message;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendMessageListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $eventData = $event->data;

        $messageData = [
            'sender_id' => $eventData['sender_id'],
            'receiver_id' => $eventData['receiver_id'],
            'message' => $eventData['message'],
        ];
        Message::create($messageData);
    }
}
