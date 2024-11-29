<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Log;
use App\Notifications\CustomVerifyEmail;
use App\Models\Vehicle;
use App\Models\News;

class AuthController extends Controller
{
    public function showSignupForm()
    {
        return view('auth.signup');
    }
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'email' => 'required|string|email|max:255|unique:users,email',
            'user_type' => 'required|string',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->user_type = $request->user_type;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;

        if ($request->hasFile('profile_image')) {
            $file = $request->file('profile_image');
            $path = $file->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        Auth::login($user);

        $sponsoredCars = Vehicle::whereHas('listing', function ($query) {
            $query->where('listing_status', 'active')->where('sponsored', true);
        })->with('images')->take(3)->get();
        

        $news = News::orderBy('published_at', 'desc')->take(2)->get();

        Log::info('Sending email verification notification to user: ' . $user->email);
        $user->notify(new CustomVerifyEmail($user, $sponsoredCars, $news));
        Log::info('Email verification notification sent.');

        return redirect()->route('verification.notice');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.profile', compact('user'));
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->country = $request->country;

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }
            $file = $request->file('profile_image');
            $path = $file->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('user.profile', $id);
    }

    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect('/dashboard');
    }


    public function resendVerificationEmail(Request $request)
    {
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        // Fetch the latest sponsored cars and news
        $sponsoredCars = Vehicle::whereHas('listing', function ($query) {
            $query->where('listing_status', 'active')->where('sponsored', true);
        })->take(3)->get();

        $news = News::orderBy('published_at', 'desc')->take(2)->get();

        Log::info('Resending email verification notification to user: ' . $user->email);
        $user->notify(new CustomVerifyEmail($user, $sponsoredCars, $news));
        Log::info('Email verification notification resent.');

        return back()->with('message', 'Verification link sent!');
    }
}
