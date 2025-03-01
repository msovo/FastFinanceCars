<?php
// app/Http/Controllers/Admin/VehicleController.php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Facades\Image;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::with([
            'car_brand',
            'car_model',
            'images',
            'listing.dealer',
            'listing.inquiries',
        ])->get();

        return view('admin.vehicles.index', compact('vehicles'));
    }
    
    public function create()
    {
        $categories = Category::all();
    return view('admin.vehicles.create', compact('categories'));
    }
    
    public function storeCar(Request $request)
    {
        \Log::info(message: 'Attempting to create vehicle');
    
        // Validate the request
        $request->validate([
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer',
            'price' => 'nullable|numeric',
            'mileage' => 'nullable|integer',
            'fuel_type' => 'required|string',
            'transmission' => 'required|string',
            'body_type' => 'required|string',
            'car_condition' => 'nullable|string',
            'variant' => 'nullable|string',
            // Conditional validation for color
            'color' => 'required|string|max:30', 
            'custom_color' => 'required_if:color,Other|nullable|string|max:30',
            // Conditional validation for engine size
            'engine_size' => 'required|string', 
            'custom_engine_size' => 'required_if:engine_size,Other|nullable|string', 
            'description' => 'nullable|string',
        ]);
    
        try {
            $data = $request->all();
    
            // Handle "Other" selections for color
            if ($request->color === 'Other') {
                $data['color'] = $request->custom_color;
            }
    
            // Handle "Other" selections for engine size
            if ($request->engine_size === 'Other') {
                $data['engine_size'] = $request->custom_engine_size;
            }
    
            \Log::info('Attempting to create vehicle with data:', $data);
            $vehicle = Vehicle::create($data);
            \Log::info('Vehicle created successfully');
    
            // Update listing_status in listings table
            Listing::create([
                'user_id' => auth()->id(), // Assuming the user is authenticated
                'vehicle_id' => $vehicle->id,
                'listing_status' => 'active',
                'featured' => $request->input('featured', false),
                'sponsored' => $request->input('sponsored', false),
            ]);
    
            return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle created successfully.');
        } catch (\Exception $e) {
            \Log::error('Failed to create vehicle: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create vehicle.']);
        }
    }
    
    

    public function edit($id)
    {
        $vehicle = Vehicle::with([
            'images',
            'features',
            'listing.dealer', // Fetch the dealership via the listing
            'listing.inquiries',
             // Fetch inquiries via the listing
        ])->findOrFail($id);
    
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Convert the image to WebP format
                $image = Image::make($file)->encode('webp', 90);
    
                // Generate a unique file name
                $filename = uniqid() . '.webp';
    
                // Store the image in the public storage
                $path = 'vehicles/' . $filename;
                Storage::disk('public')->put($path, $image);
    
                // Save the image path to the database
                VehicleImage::create([
                    'vehicle_id' => $vehicle->vehicle_id,
                    'image_url' => $path,
                ]);
            }
        }
    
        return redirect()->route('admin.vehicles.edit', $vehicle->vehicle_id)->with('success', 'Vehicle updated successfully');
    }
    
    
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully.');
    }

    public function loadVehicleForm()
    {
        // Fetch necessary data
        $categories = Category::all();
    
        // Return the processed Blade template as a response
        return view('admin.partials.vehicle-form', compact('categories'))->render();
    }
    public function addFeatures(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $features = explode(',', $request->input('features'));

        foreach ($features as $feature) {
            Feature::create([
                'vehicle_id' => $vehicle->vehicle_id,
                'feature' => trim($feature),
            ]);
        }

        return redirect()->route('admin.vehicles.edit', $vehicle->vehicle_id)->with('success', 'Features added successfully');
    }public function listVehicle($id)
    {
        \Log::info('Attempting to list vehicle with ID: ' . $id);
    
        try {
            $vehicle = Vehicle::findOrFail($id);
            \Log::info('Vehicle found: ', ['vehicle_id' => $vehicle->vehicle_id]);
    
            $listing = Listing::updateOrCreate(
                ['vehicle_id' => $vehicle->vehicle_id],
                ['user_id' => auth()->id(), 'listing_status' => 'active']
            );
    
            \Log::info('Vehicle listed successfully', ['listing_id' => $listing->id]);
    
            return response()->json(['status' => 'listed', 'message' => 'Vehicle listed successfully']);
        } catch (\Exception $e) {
            \Log::error('Failed to list vehicle: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'An error occurred while listing the vehicle.'], 500);
        }
    }

    public function unlistVehicle($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $listing = Listing::where('vehicle_id', $vehicle->ivehicle_idd)->first();
            if ($listing) {
                $listing->update(['listing_status' => 'expired']);
            }

            return response()->json(['status' => 'unlisted', 'message' => 'Vehicle unlisted successfully']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred while unlisting the vehicle.'], 500);
        }
    }

    public function markAsSold($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $listing = Listing::where('vehicle_id', $vehicle->vehicle_id)->first();
            if ($listing) {
                $listing->update(['listing_status' => 'sold']);
            }

            return response()->json(['message' => 'Vehicle marked as sold']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred while marking the vehicle as sold.'], 500);
        }
    }

    public function isListed($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $isListed = $vehicle->isListed();

        return response()->json(['isListed' => $isListed]);
    }

    
}
