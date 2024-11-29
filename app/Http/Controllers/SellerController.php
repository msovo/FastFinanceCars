<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Listing;
use App\Models\News;
use App\Models\Inquiry;
class SellerController extends Controller
{
    public function listings()
    {
        $userId = auth()->id();

        $totalLeads = Inquiry::whereHas('listing', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    
        $totalListings = Listing::where('user_id', $userId)->count();
        $totalSales = Listing::where('user_id', $userId)->where('listing_status', 'sold')->count();
    
        $averagePrice = Listing::where('user_id', $userId)
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->avg('vehicles.price');
    
        return view('seller.listings', compact('totalLeads', 'totalListings', 'totalSales', 'averagePrice'));
    }

    public function manageSales()
    {
        $sales = Listing::where('user_id', auth()->id())->get();
        return view('seller.manage_sales', compact('sales'));
    }

    public function manageLeads()
    {
        $leads = Inquiry::whereHas('listing', function($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('seller.manage_leads', compact('leads'));
    }

    public function addCars()
    {
        return view('seller.add_cars');
    }

    public function storeCar(Request $request)
    {
        $vehicle = Vehicle::create($request->all());
        Listing::create([
            'user_id' => auth()->id(),
            'vehicle_id' => $vehicle->vehicle_id,
            'listing_status' => 'active'
        ]);
        return redirect()->route('manage.listings');
    }

    public function manageListings()
    {
        $listings = Listing::where('user_id', auth()->id())->get();
        return view('seller.manage_listings', compact('listings'));
    }

    public function newsManagement()
    {
        $news = News::where('author_id', auth()->id())->get();
        return view('seller.news_management', compact('news'));
    }

    public function storeNews(Request $request)
    {
        News::create($request->all());
        return redirect()->route('news.management');
    }
}
