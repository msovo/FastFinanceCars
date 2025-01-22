<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\User;
use App\Models\Listing;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\Inquiry;
use App\Models\Dealer;

use App\Models\Category;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\VehicleController;

// app/Http/Controllers/AdminController.php

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalListings = Listing::count();
        $totalEnquiries = Inquiry::count();
        $totalReviews = Review::count();
        $totalDealerships= Dealer::count();
        $totals = [
            'totalUsers' => $totalUsers,
            'totalListings' => $totalListings,
            'totalEnquiries' => $totalEnquiries,
            'totalReviews' => $totalReviews,
            'totalDealerships' => $totalDealerships,
        ];

        return view('admin.dashboard', compact('totalUsers', 'totalListings', 'totalEnquiries', 'totalReviews','totalDealerships','totals'));
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function loadContent($parameter)
    {
        $totalUsers = User::count();
        $totalListings = Listing::count();
        $totalEnquiries = Inquiry::count();
        $totalReviews = Review::count();
        $totalDealerships = Dealer::count();
    
        $totals = [
            'totalUsers' => $totalUsers,
            'totalListings' => $totalListings,
            'totalEnquiries' => $totalEnquiries,
            'totalReviews' => $totalReviews,
            'totalDealerships' => $totalDealerships,
        ];
    
        view()->share('totals', $totals);
    
        switch ($parameter) {
            case 'user':
                return view('admin.users.create');
            case 'listing':
                return view('admin.listings.create');
            case 'category':
                return view('admin.categories.create');
            case 'vehicle':
                return view('admin.vehicles.create');
            case 'news':
                return view('admin.news.create');
            case 'review':
                return view('admin.reviews.create');
            case 'serviceprovider':
                return view('admin.serviceproviders.create');
            case 'tool':
                return view('admin.tools.create');
            case 'transaction':
                return view('admin.transactions.create');
            case 'analytics':
                return view('admin.reports.analytics');
            case 'categories':
                return app(CategoryController::class)->index();
            case 'vehicles':
                return app(VehicleController::class)->index();
            default:
                return response()->json(['error' => 'Invalid parameter'], 400);
        }
    }
    public function loadVehicleForm()
    {
        // Fetch the categories
        $categories = Category::all();
    
        // Return the processed Blade template without escaping the content
        return view('admin.partials.load-vehicle-form', compact('categories'))->render();
    }
    
}
