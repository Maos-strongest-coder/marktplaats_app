<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Message;
use Illuminate\Notifications\Notifiable;

class MessageReceived extends Notification
{
    use Queueable;
    
    /**
     * Create a new notification instance.
     */
    public function __construct(public Message $message)
    {
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return $notifiable->notifications_enabled ? ['mail'] : [];
    }

    
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject("New message on Mo's Marketplace!")
        ->greeting('Hello, ' . $notifiable->name . ',')
        ->line('You have received a new message.')
        ->action('View Messages', route('messages.inbox', [
            'partner_id' => $this->message->sender_id,
            'advertisement_id' => $this->message->advertisement_id
        ]))
        ->line("Thank you for using Mo's Marketplace!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
