<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use App\Notifications\CustomResetPassword;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No user found with this email address.']);
        }

        $token = Password::createToken($user);

        Log::info('Sending password reset notification to user: ' . $user->email);
        $user->notify(new CustomResetPassword($token, $user));
        Log::info('Password reset notification sent.');

        return back()->with('status', 'Password reset link sent!');
    }
}



