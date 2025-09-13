<?php
namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSentEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender;       // sender user object
    public $receiverId;   // receiver user ID
    public $message;

    public $name;

    public function __construct($sender, $receiverId, $message,$name)
    {
        $this->sender = $sender;
        $this->receiverId = $receiverId; // set receiver ID
        $this->message = $message;
        $this->name = $name;
    }

    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('chat.' . $this->receiverId);
    }

    public function broadcastAs(): string
    {
        return 'message.sent';
    }

    public function broadcastWith(): array
    {
        return [
            'message' => $this->message,
            'sender' => [
                'id' => $this->sender->id ?? null,
                'name' => $this->name ?? 'Guest',
            ],
        ];
    }
}
