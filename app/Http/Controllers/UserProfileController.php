<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserProfileController extends Controller
{
    public function showProfile()
    {
        $user = Auth::user();
        // Add logic to fetch user engagement metrics
        $engagementMetrics = [
            'cars_viewed' => 10, // Example data
            'cars_listed' => 5, // Example data
            'news_read' => 20, // Example data
            'days_signed_in' => 30, // Example data
            'subscriptions' => 2, // Example data
        ];
        return view('profile', compact('user', 'engagementMetrics'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users')->ignore(Auth::user()->user_id, 'user_id')
            ],
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user = Auth::user();
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
    
        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');}

    public function deleteProfile(Request $request)
    {
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/')->with('success', 'Account deleted successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.profile')->with('success', 'Password changed successfully.');
    }
}
