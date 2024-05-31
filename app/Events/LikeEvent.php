<?php

namespace App\Events;

use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class LikeEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $postId;
    public $userPostId;
    /**
     * Create a new event instance.
     */
    public function __construct($post)
    {
        $this->postId = $post->id;
        $this->userPostId = $post->user->id;
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
            new PrivateChannel('notify_channel.' . $this->userPostId),
        ];
    }

    //send this data with broadcast to pusher
    public function broadcastWith(): array
    {
        return [
            'senderId' => Auth::user()->id,
            'senderName' => Auth::user()->name,
            'senderAvatar' => Auth::user()->avatar,
            'eventType' => 'liked your post',
            'notificationUrl' => route('post.show', $this->postId),
            'created_at' => now()->toDateTimeString()
        ];
    }
}
