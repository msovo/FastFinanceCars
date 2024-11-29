<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class CustomResetPassword extends Notification
{
    protected $token;
    protected $user;

    public function __construct($token, $user)
    {
        $this->token = $token;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        // Log the user and reset URL for debugging
        Log::info('CustomResetPassword Notification: User - ', ['user' => $this->user]);
        Log::info('CustomResetPassword Notification: Reset URL - ', ['url' => $resetUrl]);

        return (new MailMessage)
            ->subject('Reset Your Password')
            ->view('vendor.mail.html.password_reset', [
                'user' => $this->user,
                'resetUrl' => $resetUrl
            ]);
    }
}
