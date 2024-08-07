<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendLeaveApplyEmail extends Notification
{
    use Queueable;

        private $details;
     function __construct($details)
    {
        $this->details=$details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->greeting($this->details['Greeting'])
                    ->line($this->details['Intro'])
                    ->line($this->details['User'])
                    ->line($this->details['Leave Type'])
                    ->line($this->details['Reason'])
                    ->line($this->details['From'])
                    ->line($this->details['To']);
                   
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
