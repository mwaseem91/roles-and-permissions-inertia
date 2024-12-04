<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReferralStatusChanged extends Notification
{
    use Queueable;

    protected $referral;

    // Constructor to pass referral object
    public function __construct($referral)
    {
        $this->referral = $referral;
    }

    // Define the channels this notification will be sent through
    public function via($notifiable)
    {
        return ['mail'];
    }

    // Define the content of the email
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Referral Status Changed')
                    ->line('The status of your referral has been updated.')
                    ->line('Referral ID: ' . $this->referral->id)
                    ->line('New Status: ' . $this->referral->status)
                    ->line('Thank you for using our application!');
    }
}
