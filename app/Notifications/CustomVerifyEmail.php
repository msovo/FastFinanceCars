<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class CustomVerifyEmail extends Notification
{
    protected $user;
    protected $sponsoredCars;
    protected $news;

    public function __construct($user, $sponsoredCars, $news)
    {
        $this->user = $user;
        $this->sponsoredCars = $sponsoredCars;
        $this->news = $news;
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        // Log the user and verification URL for debugging
        Log::info('CustomVerifyEmail Notification: User - ', ['user' => $this->user]);
        Log::info('CustomVerifyEmail Notification: Verification URL - ', ['url' => $verificationUrl]);

        return (new MailMessage)
            ->subject('Verify Your Email Address')
            ->view('vendor.mail.html.message', [
                'user' => $this->user,
                'verificationUrl' => $verificationUrl,
                'sponsoredCars' => $this->sponsoredCars,
                'news' => $this->news,
            ]);
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(60),
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        Log::info('Resending email verification notification to user: ' . $user->email);
        $user->sendEmailVerificationNotification();
        Log::info('Email verification notification resent.');

        return back()->with('message', 'Verification link sent!');
    }
}
