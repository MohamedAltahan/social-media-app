<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CommentNotification extends Notification
{
    use Queueable;

    public $postId;
    /**
     * Create a new notification instance.
     */

    public function __construct($postId)
    {
        $this->postId = $postId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'senderId' => Auth::user()->id,
            'senderName' => Auth::user()->name,
            'senderAvatar' => Auth::user()->avatar,
            'eventType' => 'commented on your post',
            'notificationUrl' => route('post.show', $this->postId)

        ];
    }
}
