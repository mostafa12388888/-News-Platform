<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $comment, $post;
    public function __construct($comment, $post)
    {
        $this->comment = $comment;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toBroadcast(object $notifiable): array
    {
        return [
            "user_id" => $this->comment->user_id,
            "post_title" => $this->post->title,
            "user_name" => auth()->user()->name,
            "comment" => $this->comment->comment,
            "link" => route('frontend.post.show', $this->post->slug),
        ];
    }
    public function toDatabase(object $notifiable): array
    {
        return [
            "user_id" => $this->comment->user_id,
            "post_title" => $this->post->title,
            "user_name" => auth()->user()->name,
            "comment" => $this->comment->comment,
            "link" => route('frontend.post.show', $this->post->slug),
        ];
    }
    /**
     * Get the type of the notification being broadcast.
     */
    public function broadcastType(): string
    {
        return 'NewCommentNotify';
    }
    /**
     * Get the notification's database type.
     *
     * @return string
     */
    public function databaseType(object $notifiable): string
    {
        return 'NewCommentNotify';
    }
}
