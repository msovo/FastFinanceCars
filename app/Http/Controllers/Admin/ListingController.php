<?php
// app/Http/Controllers/Admin/ListingController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Log;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::all();
        return view('admin.listings.index', compact('listings'));
    }

    public function create()
    {
        return view('admin.listings.create');
    }
   public function store(Request $request)
    {
        try {
            $request->validate([
                'user_id' => 'required|integer',
                'vehicle_id' => 'required|integer',
                'listing_status' => 'required|string',
                'featured' => 'boolean',
                'sponsored' => 'boolean',
            ]);
    
            Listing::create($request->all());
    
            return redirect()->route('admin.listings.index')->with('success', 'Listing created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating listing: ' . $e->getMessage());
    
            return redirect()->route('admin.listings.index')->with('error', 'Failed to create listing.');
        }
    }
    public function edit(Listing $listing)
    {
        return view('admin.listings.edit', compact('listing'));
    }

    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'vehicle_id' => 'required|integer',
            'listing_status' => 'required|string',
            'featured' => 'boolean',
        ]);

        try {
            $listing->update($request->all());
            return redirect()->route('admin.listings.index')->with('success', 'Listing updated successfully.');
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error updating listing: ' . $e->getMessage(), [
                'listing_id' => $listing->id,
                'user_id' => $request->user_id,
                'vehicle_id' => $request->vehicle_id,
                'listing_status' => $request->listing_status,
                'featured' => $request->featured,
            ]);

            // Redirect back with an error message
            return redirect()->route('admin.listings.index')->with('error', 'Failed to update listing. Please try again.');
        }
    }    public function destroy(Listing $listing)
    {
        $listing->delete();
        return redirect()->route('admin.listings.index')->with('success', 'Listing deleted successfully.');
    }
}
