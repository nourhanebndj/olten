<?php

namespace App\Notifications;

use App\Mail\ResetPasswordMail;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new ResetPasswordMail($this->token, $notifiable->email, $notifiable->name))
                    ->to($notifiable->email);
    }
}
