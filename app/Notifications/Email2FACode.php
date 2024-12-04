<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Email2FACode extends Notification
{
    use Queueable;
    private $code;
   
    public function __construct($code)
    {
        $this->code = $code;
    }

   
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

   
    public function toMail(object $notifiable): MailMessage
    {
        
        return (new MailMessage)
                    ->subject('Your 2FA Verification Code')
                    ->line('Your Two-Factor Authentication code is:')
                    ->line($this->code)
                    ->line('This code will expire in 10 minutes.')
                    
                    ->salutation('Thank you for using our application!');
    }

   
    public function toArray(object $notifiable): array
    {
        return [
            'code' => $this->code,
        ];
    }
}
