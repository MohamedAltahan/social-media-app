<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class FriendRequestEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $friendId;

    /**
     * Create a new event instance.
     */
    public function __construct($friendId)
    {
        $this->friendId = $friendId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            //userPostId is our parameter
            new PrivateChannel('notify_channel.' . $this->friendId),
        ];
    }

    //send this data with broadcast to pusher
    public function broadcastWith(): array
    {
        return [
            'senderId' => Auth::user()->id,
            'senderName' => Auth::user()->name,
            'senderAvatar' => Auth::user()->avatar,
            'eventType' => 'sent you friend request',
            //send my profile url to a friend
            'notificationUrl' => route('time-line.index', Auth::user()->id),
            'created_at' => now()->toDateTimeString()
        ];
    }
}
