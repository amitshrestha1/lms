<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendLeaveAnswers extends Notification
{
    use Queueable;

    private $answers;
    public function __construct($answers)
    {
        $this->answers = $answers;
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
                    ->subject($this->answers['Subject'])
                    ->greeting($this->answers['Greetings'])
                    ->line($this->answers['Answer'])
                    ->line($this->answers['Reason'])
                    ->line($this->answers['Thankyou']);
                    
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
