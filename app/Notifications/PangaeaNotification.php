<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PangaeaNotification extends Notification
{
    use Queueable;

    protected $url;
    protected $topic;
    protected $message;
    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $subscriptionData)
    {
        $this->topic = $subscriptionData['topic'];
        $this->url = $subscriptionData['url'];
        $this->message = $subscriptionData['message'];
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('New Article for'. $this->topic)
                    ->line($this->message)
                    ->action('Click to read more', url($this->url))
                    ->line('Thank you!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
