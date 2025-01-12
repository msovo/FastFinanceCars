<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Variant;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Listing;
use App\Models\News;
use App\Models\Inquiry;
use App\Models\Category;
use DataTables;
use App\Models\VehicleImage;
use App\Models\NewsTag;
use App\Models\Feature;
use App\Models\Comments;
use App\Models\NewsCategory;
use Illuminate\Support\Facades\Auth;
use App\Models\NewsImage;
use App\Models\Dealer;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;




class DealerController extends Controller
{

    public function dashboard(Request $request)
    {
        $userId = auth()->id();
        $filterDate = $request->input('date');
    
        // 1. Bar graph for cars per make with sales line
        $makeCounts = Listing::selectRaw('categories.category_name, COUNT(listings.listing_id) as total_listings, SUM(CASE WHEN listings.listing_status = "sold" THEN 1 ELSE 0 END) as total_sales')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('categories', 'vehicles.make', '=', 'categories.category_name')
            ->where('listings.user_id', $userId)
            ->when($filterDate, function ($query, $date) {
                return $query->whereDate('listings.created_at', $date);
            })
            ->groupBy('categories.category_name')
            ->get();
    
        $makeLabels = $makeCounts->pluck('category_name');
        $totalListingsData = $makeCounts->pluck('total_listings');
        $totalSalesData = $makeCounts->pluck('total_sales');
    
        // 2. Bar graph for lead statuses
        $leadStatuses = Inquiry::selectRaw('status, COUNT(*) as count')
            ->whereHas('listing', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($filterDate, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->groupBy('status')
            ->get();
    
        $leadStatusLabels = $leadStatuses->pluck('status'); 
        $leadStatusCounts = $leadStatuses->pluck('count');
    
        // 3. Analysis table for listings per category
        $categoryTypes = Category::distinct('category_type')->where('category_type', '!=', 'Make')->pluck('category_type');
        $categoryData = [];
        $modelsData = [];
        $makes = Listing::join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.user_id', $userId)
            ->distinct()
            ->pluck('vehicles.make');
    
        foreach ($makes as $make) {
            foreach ($categoryTypes as $type) {
                $categoryCounts = Listing::selectRaw('cat.category_name, COUNT(*) as count')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->join('categories as cat', function ($join) use ($type) {
                        switch ($type) {
                            case 'Body Type':
                                $join->on('vehicles.body_type', '=', 'cat.category_name');
                                break;
                            case 'Engine Size':
                                $join->on('vehicles.engine_size', '=', 'cat.category_name');
                                break;
                            case 'Transmission':
                                $join->on('vehicles.transmission', '=', 'cat.category_name');
                                break;
                            case 'Fuel Type':
                                $join->on('vehicles.fuel_type', '=', 'cat.category_name');
                                break;
                            case 'Condition':
                                $join->on('vehicles.car_condition', '=', 'cat.category_name');
                                break;
                        }
                    })
                    ->where('listings.user_id', $userId)
                    ->where('vehicles.make', $make)
                    ->when($filterDate, function ($query, $date) {
                        return $query->whereDate('listings.created_at', $date);
                    })
                    ->groupBy('cat.category_name')
                    ->get();
    
                $categoryData[$make][$type] = $categoryCounts;
            }
    
            $models = Listing::selectRaw('vehicles.model, COUNT(*) as count')
                ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                ->where('listings.user_id', $userId)
                ->where('vehicles.make', $make)
                ->groupBy('vehicles.model')
                ->get();
    
            $modelsData[$make] = $models;
        }
    
        $totalSold = Listing::where('user_id', $userId)
            ->where('listing_status', 'sold')
            ->when($filterDate, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->with('vehicle')
            ->get()
            ->sum(function ($listing) {
                return $listing->vehicle->price;
            });
    
        $totalActive = Listing::where('user_id', $userId)
            ->where('listing_status', 'active')
            ->when($filterDate, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->with('vehicle')
            ->get()
            ->sum('vehicle.price'); 
    
        $monthlyCounts = Vehicle::selectRaw('MONTH(listed_at) as month, YEAR(listed_at) as year, COUNT(*) as count')
            ->whereHas('listing', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($filterDate, function ($query, $date) {
                return $query->whereYear('listed_at', date('Y', strtotime($date)));
            })
            ->groupByRaw('YEAR(listed_at), MONTH(listed_at)')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
    
        $totalLeads = Inquiry::whereHas('listing', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
    
        $totalListings = Listing::where('user_id', $userId)->count();
        $totalSales = Listing::where('user_id', $userId)->where('listing_status', 'sold')->count();
    
        $averagePrice = Listing::where('user_id', $userId)
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->avg('vehicles.price');
    
        $monthlyLabels = $monthlyCounts->map(function ($item) {
            return date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year)); 
        });
        $monthlyCarCounts = $monthlyCounts->pluck('count');
    
        $hasData = $makeCounts->isNotEmpty() || $leadStatuses->isNotEmpty() || $totalListings > 0;
    
        return view('dealer.dashboard', compact(
            'makeLabels', 
            'totalListingsData', 
            'totalSalesData',
            'leadStatusLabels', 
            'leadStatusCounts',
            'categoryTypes', 
            'categoryData',
            'totalSold',       
            'totalActive',     
            'monthlyLabels', 
            'monthlyCarCounts',
            'totalLeads',
            'totalSales',
            'averagePrice',
            'totalListings',
            'makes',
            'modelsData',
            'hasData'
        ));
    }
    


public function manageSales()
{
    $sales = Listing::with('vehicle')
        ->where('user_id', auth()->id())
        ->where('listing_status', 'sold') 
        ->get();

    return view('dealer.manage_sales', compact('sales'));
}

    public function manageLeads()
    {
        $leads = Inquiry::whereHas('listing', function($query) {
            $query->where('user_id', auth()->id());
        })->get();
        return view('dealer.manage_leads', compact('leads'));
    }

    public function addCars()
    {
        $categories = Category::all(); // Assuming you have a Category model
        $Makes=CarBrand::all();
        $Models = CarModel::all();
        $Variants=Variant::all();

        return view('dealer.add_cars', compact('categories','Models','Variants','Makes'));
    }
    public function storeCar(Request $request)
    {
        \Log::info('Attempting to create vehicle');
    
        // Validate the request
        $request->validate([
            'make' => 'nullable|string|max:50',
            'model' => 'nullable|string|max:50',
            'year' => 'required|integer',
            'price' => 'nullable|numeric',
            'mileage' => 'nullable|integer',
            'fuel_type' => 'required|string',
            'transmission' => 'required|string',
            'body_type' => 'required|string',
            'car_condition' => 'nullable|string',
            'variant' => 'nullable|string',
            'color' => 'required|string|max:30',
            'custom_color' => 'required_if:color,Other|nullable|string|max:30',
            'engine_size' => 'required|string',
            'custom_engine_size' => 'required_if:engine_size,Other|nullable|string',
            'description' => 'nullable|string',
            'car_model_id' => 'nullable|integer',
            'car_brand_id' => 'required|integer',
            'variant_id' => 'nullable|integer',
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
    
            // Handle manual input for model and variant
            if (!empty($request->model)) {
                // Store the model if model_id is not provided
                if (empty($request->model_id)) {
                    $carModel = CarModel::create(['car_brand_id' => $data['car_brand_id'], 'name' => $request->model]);
                    $data['car_model_id'] = $carModel->id;
                } else {
                    $data['car_model_id'] = $request->model_id;
                }
            }
       // Store the variant with the associated model ID if variant is provided
       \Log::info('Attempting to create variant for variant ' . $request->variant);

       if (!empty($request->variant)) {

           $variant = Variant::create([
               'name' => $request->variant,
               'car_model_id' => $data['car_model_id'],
           ]);
           $data['variant_id'] = $variant->id;
       }

            \Log::info('Attempting to create vehicle with data:', $data);
            $vehicle = Vehicle::create($data);
            \Log::info('Vehicle created successfully with ID: ' . $vehicle->vehicle_id);
    
            // Update listing_status in listings table
            Listing::create([
                'user_id' => auth()->id(), // Assuming the user is authenticated
                'vehicle_id' => $vehicle->vehicle_id, // Corrected property name
                'listing_status' => 'active',
                'featured' => 0,
                'sponsored' => 0,
            ]);
    
            return redirect()->route('dealer.vehicles.view', $vehicle->vehicle_id)
                ->with('success', 'Vehicle created successfully. Please add images to your vehicle listing.');
        } catch (\Exception $e) {
            \Log::error('Failed to create vehicle: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create vehicle.']);
        }
    }
    public function unlistVehicle(Request $request, $id)
    {
        $listing = Listing::where('vehicle_id', $id)->firstOrFail();
        $listing->listing_status = 'inactive'; 
        $listing->save();
    
        return redirect()->back()->with('success', 'Vehicle unlisted successfully!');
    }
    public function listVehicle(Request $request, $id)
    {
        $listing = Listing::where('vehicle_id', $id)->firstOrFail();
        $listing->listing_status = 'active'; 
        $listing->save();
    
        return redirect()->back()->with('success', 'Vehicle listed successfully!');
    }
  

  
    public function manageListings()
    {
        $listings = Listing::where('user_id', auth()->id())->get();
        return view('dealer.manage_listings', compact('listings'));
    }
 
public function addCarImages()
{
    return view('dealer.add_car_images');
}

public function storeCarImages(Request $request)
{
    // Custom validation messages
    $messages = [
        'images.*.required' => 'Each image is required.',
        'images.*.image' => 'Each file must be an image.',
        'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, webp.',
        'images.*.max' => 'Each image may not be greater than 2MB.',
        'features.required' => 'The features field is required.',
        'features.string' => 'The features field must be a string.',
    ];

    // Validate the request with custom messages
    $request->validate([
        'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'features' => 'required|string',
    ], $messages);

    // Handle file uploads and save features
    $images = $request->file('images');
    foreach ($images as $image) {
        // Convert the image to WebP format
        $webpImage = Image::make($image)->encode('webp', 90);
        
        // Generate a unique file name
        $filename = uniqid() . '.webp';
        
        // Store the image in the public storage
        $path = 'vehicles/' . $filename;
        Storage::disk('public')->put($path, $webpImage);
        
        // Save the image path to the database
        VehicleImage::create([
            'vehicle_id' => $request->vehicle_id,
            'image_url' => $path,
        ]);
    }

    $features = $request->input('features');
    // Save features

    return redirect()->route('dealer.manage.listings')->with('success', 'Car images and features added successfully!');
}
// DealerController.php

// DealerController.php

public function manageVehicles()
{
    $vehicles = Vehicle::whereHas('listing', function ($query) { 
        $query->where('user_id', auth()->id());
    })->get();

    return view('dealer.manage_vehicles', compact('vehicles'));
}


// DealerController.php

public function destroyVehicle($id)
{
 

    try {
        $vehicle = Vehicle::findOrFail($id);
        // Delete related inquiries
          $vehicle->listing->inquiries()->delete(); 

        // Delete the listing
                $vehicle->listing()->delete(); 
        $vehicle->delete();

        return redirect()->back()->with('success', 'Vehicle deleted successfully!'); 
    } catch (\Exception $e) {
        return redirect()->back()->with('failed', 'Failed to delete the vehicle!'); 
    }
}
public function getVehiclesData()
{
    $listings = Listing::with('vehicle')
        ->where('user_id', auth()->id())
        ->get();

    $vehicles = $listings->map(function ($listing) {
        return $listing->vehicle;
    });

    return response()->json($vehicles);
}

    public function viewVehicle($id)
    {
        $vehicle = Vehicle::with('images', 'features', 'listing')->findOrFail($id);
        return view('dealer.view_vehicle', compact('vehicle'));
    }

    public function editVehicle($id)
    {
        $vehicle = Vehicle::with('images', 'features')->findOrFail($id);
        $categories = Category::all();
        return view('dealer.edit_vehicle', compact('vehicle', 'categories'));
    }

    public function updateVehicle(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, webp.',
            'images.*.max' => 'Each image may not be greater than 2MB.',
        ]);
    
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->update($request->all());
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Convert the image to WebP format
                $webpImage = Image::make($file)->encode('webp', 90);
                
                // Generate a unique file name
                $filename = uniqid() . '.webp';
                
                // Store the image in the public storage
                $path = 'vehicles/' . $filename;
                Storage::disk('public')->put($path, $webpImage);
                
                // Save the image path to the database
                VehicleImage::create([
                    'vehicle_id' => $vehicle->vehicle_id,
                    'image_url' => $path,
                ]);
            }
        }
    
        return redirect()->route('dealer.vehicles.view', $vehicle->vehicle_id)->with('success', 'Vehicle updated successfully');
    }
    public function addVehicleImages(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'images.*.required' => 'Each image is required.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, webp.',
            'images.*.max' => 'Each image may not be greater than 2MB.',
        ]);
    
        $vehicle = Vehicle::findOrFail($id);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                // Convert the image to WebP format
                $webpImage = Image::make($file)->encode('webp', 90);
                
                // Generate a unique file name
                $filename = uniqid() . '.webp';
                
                // Store the image in the public storage
                $path = 'vehicles/' . $filename;
                Storage::disk('public')->put($path, $webpImage);
                
                // Save the image path to the database
                VehicleImage::create([
                    'vehicle_id' => $vehicle->vehicle_id,
                    'image_url' => $path,
                ]);
            }
        }
    
        return redirect()->route('dealer.vehicles.view', $vehicle->vehicle_id)->with('success', 'Images added successfully');
    }
    
    

    public function addVehicleFeatures(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $features = explode(',', $request->input('features'));

        foreach ($features as $feature) {
            Feature::create([
                'vehicle_id' => $vehicle->vehicle_id,
                'feature' => trim($feature),
            ]);
        }

        return redirect()->route('dealer.vehicles.view', $vehicle->vehicle_id)->with('success', 'Features added successfully');
    }


    public function sponsorVehicle(Request $request, $id)
{
    $listing = Listing::where('vehicle_id', $id)->firstOrFail();
    $listing->sponsored= 1; 
    $listing->save();

    // Future implementation: Handle payment processing here if needed

    return redirect()->back()->with('success', 'Vehicle sponsored successfully!');
}

public function featureVehicle(Request $request, $id)
{
    $listing = Listing::where('vehicle_id', $id)->firstOrFail();
    $listing->featured = 1; 
    $listing->save();

    // Future implementation: Handle payment processing here if needed

    return redirect()->back()->with('success', 'Vehicle featured successfully!');
}


public function newsManagement()
{
    \Log::debug("News Item retrieved" );
    $news = News::where('author_id', auth()->id())->get();

    $categories = NewsCategory::all();


    return view('dealer.news_management', compact('news', 'categories'));
}

public function editNews($id)
{
    $newsItem = News::with([
        'comments' => function ($query) { 
            $query->with('user:user_id,username'); 
        }
    ])->findOrFail($id);
    $categories = NewsCategory::all();

    // Debugging: Check the relationships
    \Log::debug("News Item: " . $newsItem->title);
    \Log::debug("Comments Count: " . $newsItem->comments->count());
    foreach ($newsItem->comments as $comment) {
        \Log::debug("- Comment: " . $comment->content);
    }


    return view('dealer.edit_news', compact('newsItem', 'categories'));
}
public function storeNews(Request $request)
{
    // Validate the request
    $validatedData = $request->validate([
        
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'required|string|max:255',
        'thumbnail_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // For image upload
    ]);

    // Handle thumbnail upload
    if ($request->hasFile('thumbnail_url')) {
        $path = $request->file('thumbnail_url')->store('news_thumbnails', 'public');
        $validatedData['thumbnail_url'] = $path;
    }
    $news = new News($request->except('thumbnail_url'));
    $news->author_id = Auth::id(); // Set the author to the currently authenticated user;
    $news->save();

    return redirect()->route('dealer.news.management')->with('success', 'News created successfully!');
}

public function addNewsImages(Request $request, $id)
{
    $request->validate([
        'images' => 'required|array',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $news = News::findOrFail($id);

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $path = $image->store('news_images', 'public'); 
            NewsImage::create([
                'news_id' => $news->news_id,
                'image_url' => $path,
            ]);
        }
    }

    return redirect()->back()->with('success', 'Images added successfully!');
}

public function updateNews(Request $request, $id)
{
    // ... similar validation and file upload handling as in storeNews ...

    $news = News::findOrFail($id);
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category' => 'required|string|max:255',
        'thumbnail_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // For image upload
    ]);

    // Handle thumbnail upload
    if ($request->hasFile('thumbnail_url')) {
        $path = $request->file('thumbnail_url')->store('news_thumbnails', 'public');
        $validatedData['thumbnail_url'] = $path;
    }
    // ... handle tags ...

    return redirect()->route('dealer.news.management')->with('success', 'News updated successfully!');
}

public function destroyNews($id)
{
    $news = News::findOrFail($id);
    $news->delete();

    return redirect()->route('dealer.news.management')->with('success', 'News deleted successfully!');
}



public function addNewsComment(Request $request, $id)
{
    $request->validate([
        'content' => 'required|string',
    ]);

    $news = News::findOrFail($id);

    Comments::create([
        'news_id' => $news->news_id,
        'user_id' => auth()->id(), 
        'content' => $request->content,
    ]);

    return redirect()->back()->with('success', 'Comment added successfully!');
}

// DealerController.php

// DealerController.php

public function manageDealership()
{
    $dealership = auth()->user()->dealership;

    if (!$dealership) {
        return redirect()->route('dealer.dealership.create');
    }

    return view('dealer.manage_dealership', compact('dealership'));
}

public function createDealership()
{
    return view('dealer.create_dealership');
}


// DealerController.php

public function editDealership()
{
    $dealership = auth()->user()->dealership;

    if (!$dealership) {
        return redirect()->route('dealer.dealership.create');
    }

    $verified = $dealership->verified; // Get the verified status

    return view('dealer.edit_dealership', compact('dealership', 'verified')); 
}
// DealerController.php

// DealerController.php

public function storeDealership(Request $request)
{
    \Log::info('Dealership creation request received', ['user_id' => auth()->id()]); 

    $request->validate([
        'dealership_name' => 'required|string|max:255',
        'license_number' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        'postal_code' => 'required|string|max:255',
        'contact' => 'required|string|max:13',
        'city_town' => 'required|string|max:255',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    \Log::debug('Request data validated', $request->all());

    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('dealership_logos', 'public');
        \Log::debug('Logo uploaded successfully', ['path' => $path]);
    } else {
        $path = null;
        \Log::warning('No logo uploaded'); 
    }

    $dealership = Dealer::create([
        'user_id' => auth()->id(),
        'dealership_name' => $request->dealership_name,
        'license_number' => $request->license_number,
        'address' => $request->address,
        'postal_code' => $request->postal_code,
        'city_town' => $request->city_town,
        'logo' => $path,
    ]);

    \Log::info('Dealership created successfully', ['dealership_id' => $dealership->id]); 

    return redirect()->route('dealer.manage.dealership')->with('success', 'Dealership created successfully!');
}

public function updateDealership(Request $request)
{
    $dealership = auth()->user()->dealership;

    if (!$dealership) {
        return redirect()->route('dealer.dealership.create');
    }

    $request->validate([
        'dealership_name' => 'required|string|max:100',
        'license_number' => 'required|string|max:100',
        'address' => 'required|string|max:255',
        'city_town' => 'required|string|max:50',
        'postal_code' => 'required|integer',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('dealership_logos', 'public');
        $dealership->logo = $path;
        $dealership->save();
    }

    $dealership->update($request->except('logo')); 

    return redirect()->route('dealer.manage.dealership')->with('success', 'Dealership updated successfully!');
}
}

