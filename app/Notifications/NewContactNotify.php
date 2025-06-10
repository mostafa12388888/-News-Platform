<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactNotify extends Notification
{
    use Queueable;

    public $contact;
    /**
     * Create a new notification instance.
     */
    public function __construct($contact)
    {
        $this->contact=$contact;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database','broadcast'];
    }



    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            "contact_title" => $this->contact->title,
            "contact_name" => $this->contact->name,
            "created_at"=>date('Y-m-d h:m a'),
            "link" => route('admin.contacts.show', $this->contact->id),
        ];
    }

     /**
     * Get the type of the notification being broadcast.
     */
    public function broadcastType(): string
    {
        return 'NewContactNotify';
    }
    /**
     * Get the notification's database type.
     *
     * @return string
     */
    public function databaseType(object $notifiable): string
    {
        return 'NewContactNotify';
    }
}
