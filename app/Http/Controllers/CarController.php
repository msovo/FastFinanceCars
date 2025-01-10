<?php
namespace App\Http\Controllers;

use App\Models\Car_brand;
use App\Models\Vehicle;
use App\Models\News;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingComment;
use App\Models\CarBrand;
use App\Models\CarModel;
use App\Models\Variant;
use App\Models\Dealer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

use App\Models\newscategory;

use App\Models\ListingRating;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function view(Request $request)
    {
        $carId = $request->input('car_id');
        $car = Vehicle::find($carId);

        if ($car) {
            $viewedCars = session()->get('viewed_cars', []);
            $viewedCars[$carId] = [
                'id' => $car->id,
                'make' => $car->make,
                'model' => $car->model,
                'year' => $car->year,
                'price' => $car->price,
                'image_url' => $car->images->first()->image_url,
            ];
            session()->put('viewed_cars', $viewedCars);

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error'], 404);
    }

public function index()
{

    $makes = Vehicle::distinct()->pluck('make');

    // Get all unique models and variants, grouped by make
    $models = Vehicle::select('make', 'model')
                     ->distinct()
                     ->orderBy('model')
                     ->get()
                     ->groupBy('make');

    $variants = Vehicle::select('make', 'model', 'variant')
                       ->distinct()
                       ->orderBy('variant')
                       ->get()
                       ->groupBy(['make', 'model']); 
     $categoryTypes = Category::where('category_type', '!=', 'Make')
                       ->where('category_type', '!=', 'Model')
                       ->where('category_type', '!=', 'Variant')
                       ->distinct('category_type') 
                       ->pluck('category_type'); 

    $categories = Category::whereNotIn('category_type', ['Make', 'Model', 'Variant'])
                    ->orderBy('category_name')
                    ->get()
                    ->groupBy('category_type'); 

                             
    $featuredCars = Vehicle::whereHas('listing', function ($query) {
        $query->where('listing_status', 'active')->where('featured', true);
    })->get()
    ->take(3);

    $sponsoredCars = Vehicle::whereHas('listing', function ($query) {
        $query->where('listing_status', 'active')->where('sponsored', true);
    })->get()
    ->take(3);;

    $latestCars = Vehicle::whereHas('listing', function ($query) { 
        $query->where('listing_status', 'active');
    })->orderBy('listed_at', 'desc')->take(3)->get();

    $newsCategories = NewsCategory::all();
    $news = [];

    foreach ($newsCategories as $category) {
        $news[$category->category_name] = $category->news()->orderBy('published_at', 'desc')->take(3)->get();
    }

    // Data for the Make Analysis chart
    $makeCounts = DB::table('vehicles')
                    ->select('make', DB::raw('count(*) as count'))
                    ->groupBy('make')
                    ->get();

    $makeLabels = $makeCounts->pluck('make');
    $makeCounts = $makeCounts->pluck('count');

   // $carBrands = CarBrand::all();

   $carBrands = CarBrand::withCount(['vehicles as vehicle_count' => function ($query) {
    $query->whereColumn('vehicles.car_brand_id', 'car_brands.id');}])->get();

    
    // Get all models with their vehicle counts
    $Carmodels = CarModel::withCount(['vehicles as vehicle_count' => function ($query) {
        $query->whereColumn('vehicles.car_model_id', 'car_models.id');
    }])->get();

    // Get all variants with their vehicle counts
    $Carvariants = Variant::withCount(['vehicles as vehicle_count' => function ($query) {
        $query->whereColumn('vehicles.variant_id', 'variants.id');
    }])->get();
   // dd($Carbrands);



    return view('home', compact(
        'featuredCars', 
        'sponsoredCars', 
        'news', 
        'latestCars', 
        'makeLabels', 
        'makeCounts',
        'makes',
        'variants',
        'categoryTypes',
        'models',
        'categories',
        'carBrands',
        'Carvariants',
        'Carmodels',
        'newsCategories'
    ));
    
}



public function getModels(Request $request)
{
    $make = $request->input('make');
    $models = Vehicle::where('make', $make)->distinct()->orderBy('model')->pluck('model');
    return $models;
}

public function getVariants(Request $request)
{
    $make = $request->input('make');
    $model = $request->input('model');
    $variants = Vehicle::where('make', $make)->where('model', $model)->distinct()->orderBy('variant')->pluck('variant');
    return $variants;
}
public function list(Request $request)
    {
        $query = Vehicle::whereHas('listing', function ($query) {
            $query->where('listing_status', 'active');
        });

        if ($request->filled('makeModelVariant')) {
            $query->where(function ($q) use ($request) {
                $q->where('make', 'like', '%' . $request->makeModelVariant . '%')
                  ->orWhere('model', 'like', '%' . $request->makeModelVariant . '%');
            });
        }

        if ($request->filled('minPrice')) {
            $query->where('price', '>=', $request->minPrice);
        }

        if ($request->filled('maxPrice')) {
            $query->where('price', '<=', $request->maxPrice);
        }

        if ($request->filled('minYear')) {
            $query->where('year', '>=', $request->minYear);
        }

        if ($request->filled('maxYear')) {
            $query->where('year', '<=', $request->maxYear);
        }

        if ($request->filled('minMileage')) {
            $query->where('mileage', '>=', $request->minMileage);
        }

        if ($request->filled('maxMileage')) {
            $query->where('mileage', '<=', $request->maxMileage);
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('bodyType')) {
            $query->where('body_type', 'like', '%' . $request->body_type . '%');
        }

        if ($request->filled('transmission')) {
            $query->where('transmission', 'like', '%' . $request->transmission . '%');
        }

        if ($request->filled('fuelType')) {
            $query->where('fuel_type', 'like', '%' . $request->fuel_type . '%');
        }

        if ($request->filled('priceMonthlyRepayment')) {
            // Add logic for monthly repayment if needed
        }

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'date_d':
                    $query->orderBy('updated_at', 'desc');
                    break;
                case 'date_a':
                    $query->orderBy('updated_at', 'asc');
                    break;
                case 'price_d':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_a':
                    $query->orderBy('price', 'asc');
                    break;
            }
        }

        $cars = $query->paginate(12);
        $categories = Category::all();

        return view('cars.index', compact('cars', 'categories'));
}

    public function show($id)
    {
        $car = Vehicle::with('images', 'features')->findOrFail($id);
        $listing_id = DB::table('listings')->where('vehicle_id', $id)->value('listing_id');
        $user_id = DB::table('listings')->where('vehicle_id', $id)->value('user_id');
        $listing = Listing::where('vehicle_id', $id)->firstOrFail();

        $featuredCars = Listing::where('featured', 1)
        ->where('listing_status', 'active')
        ->whereHas('vehicle', function ($query) use ($car) {
            $query->where('model', $car->model);
        })
        ->with('vehicle', 'images')
        ->paginate(3, ['*'], 'featured_page');

    $sponsoredCars = Listing::where('sponsored', 1)
         ->where('listing_status', 'active')
         ->whereHas('vehicle', function ($query) use ($car) {
            $query->where('model', $car->model);
        })        ->with('vehicle', 'images')
        ->paginate(3, ['*'], 'sponsored_page');


        $dealershipCars = Listing::where('user_id', $user_id)
        ->where('listing_status', 'active')
        ->with(['vehicle', 'images', 'dealer' => function ($query) {
            $query->select('user_id', 'dealership_name', 'license_number', 'verified', 'address', 'city_town', 'postal_code', 'logo', 'contact');
        }])
        ->paginate(3, ['*'], 'dealership_page');


   $news = News::where('title', 'like', '%' . $car->make . '%')
                    ->orWhere('title', 'like', '%' . $car->model . '%')
                    ->orWhere('content', 'like', '%' . $car->make . '%')
                    ->orWhere('title', 'like', '%' . $car->variant . '%')

                    ->orWhere('content', 'like', '%' . $car->model . '%')
                    ->orWhere('content', 'like', '%' . $car->variant . '%')

                    ->take(5)
                    ->get();

                    return view('cars.show', compact('car', 'listing_id', 'listing','featuredCars', 'sponsoredCars','dealershipCars'))
                    ->with('news', $news ?: collect());    }

    public function storeComment(Request $request, $listingId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        ListingComment::create([
            'listing_id' => $listingId,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function storeRating(Request $request, $listingId)
    {
        // Rating logic here
    }

    public function affordability()
    {
        return view('affordability');
    }

    public function calculateAffordability(Request $request)
    {
        $netIncome = $request->input('netIncome');
        $currentCarPayments = $request->input('currentCarPayments');
        $otherCreditExpenses = $request->input('otherCreditExpenses');
        $creditScore = $request->input('creditScore');

        $totalExpenses = $currentCarPayments + $otherCreditExpenses;
        $remainingIncome = $netIncome - $totalExpenses;
        $maxAffordablePayment = $remainingIncome * 0.25;

        $affordability = [
            'remainingIncome' => $remainingIncome,
            'creditRating' => $this->estimateCreditRating($remainingIncome, $netIncome, $creditScore),
        ];

        return response()->json($affordability);
    }

    private function estimateCreditRating($remainingIncome, $netIncome, $creditScore)
    {
        if ($creditScore >= 75 && $remainingIncome >= 0.75 * $netIncome) {
            return 'Excellent';
        } elseif ($creditScore >= 50 && $remainingIncome >= 0.50 * $netIncome) {
            return 'Good';
        } elseif ($creditScore >= 25 && $remainingIncome >= 0.25 * $netIncome) {
            return 'Acceptable';
        } else {
            return 'Subpar';
        }
    }

    public function getCarsBasedOnAffordability(Request $request)
{
    $netIncome = $request->input('netIncome');
    $remainingIncome = $request->input('remainingIncome');
    $creditScore = $request->input('creditScore');
    $viewAll = $request->input('viewAll', false);

    $maxAffordablePayment = $remainingIncome * 0.25;

    $affordableCars = Vehicle::whereHas('listing', function ($query) use ($maxAffordablePayment) {
        $query->whereRaw('price / 72 <= ?', [$maxAffordablePayment]);
    })->with('images')->get();

    $riskyCars = Vehicle::whereHas('listing', function ($query) use ($maxAffordablePayment) {
        $query->whereRaw('price / 72 > ?', [$maxAffordablePayment])
              ->whereRaw('price / 72 <= ?', [$maxAffordablePayment * 2]);
    })->with('images')->get();

    return response()->json([
        'affordableCars' => $affordableCars,
        'riskyCars' => $riskyCars,
    ]);
}

// CarsController.php

/* public function search(Request $request)
{
    $keyword = $request->input('keyword');
    $make = $request->input('make');
    $model = $request->input('model');
    $variant = $request->input('variant');
    $province = $request->input('province');
    $searchBy = $request->input('searchBy', 'price');
    $minPrice = $request->input('minPrice');
    $maxPrice = $request->input('maxPrice');
    $minMonthlyPayment = $request->input('minMonthlyPayment');
    $maxMonthlyPayment = $request->input('maxMonthlyPayment');
    $minMileage = $request->input('minMileage');
    $maxMileage = $request->input('maxMileage');
    $minYear = $request->input('minYear');
    $maxYear = $request->input('maxYear');
    $conditions = $request->input('conditions');
    $brand = $request->input('brand');
    $makes = Vehicle::distinct()->pluck('make');
    $models = Vehicle::distinct()->pluck('model'); 
    $variants = Vehicle::distinct()->pluck('variant'); 
    $bodytype=$request->input('body_typefooter');

    $categoryTypes = Category::whereNotIn('category_type', ['Make', 'Model', 'Variant'])->get();
    $bodytype=$request->input('body_typefooter');
    $cars = Vehicle::query();

    // Keyword search
    if ($keyword) {
        $cars->where(function ($query) use ($keyword) {
            $query->where('make', 'like', '%' . $keyword . '%')
                  ->orWhere('model', 'like', '%' . $keyword . '%')
                  ->orWhere('variant', 'like', '%' . $keyword . '%');
        });
    }

    // Make/Model/Variant filter
      // Make/Model/Variant filter
        if ($make) {
            $cars->whereIn('make', $make);
            if ($model) {
                $cars->whereIn('model', $model);
                if ($variant) {
                    $cars->whereIn('variant', $variant);
                }
            }
        }
        if ($conditions) {
            $cars->where('car_condition', $conditions);
        }
        if ($bodytype) {
            $cars->where('body_type', $bodytype);
        }

        if ($brand) {
            $cars->where('make', $brand);
        }
        // Province filter
        if ($province) {
            $cars->whereHas('dealership', function ($query) use ($province) {
                $query->where('province', $province);
            });
        }
    
        // Price/Monthly Payment filter
        if ($searchBy === 'price') {
            if ($minPrice) {
                $cars->where('price', '>=', $minPrice);
            }
            if ($maxPrice) {
                $cars->where('price', '<=', $maxPrice);
            }
        } else { // searchBy === 'monthlyRepayment'
            if ($minMonthlyPayment) {
                $minPrice = $this->monthlyPaymentToPrice($minMonthlyPayment);
                $cars->where('price', '>=', $minPrice);
            }
            if ($maxMonthlyPayment) {
                $maxPrice = $this->monthlyPaymentToPrice($maxMonthlyPayment);
                $cars->where('price', '<=', $maxPrice);
            }
        }
    
        // Mileage filter
        if ($minMileage) {
            $cars->where('mileage', '>=', $minMileage);
        }
        if ($maxMileage) {
            $cars->where('mileage', '<=', $maxMileage);
        }
    
        // Year filter
        if ($minYear) {
            $cars->where('year', '>=', $minYear);
        }
        if ($maxYear) {
            $cars->where('year', '<=', $maxYear);
        }
    
        // More Filters logic
        $selectedFilters = [];
        foreach ($categoryTypes as $categoryType) {
            $filterName = str_replace(' ', '_', strtolower($categoryType->category_type));
            $filterValues = $request->input($filterName);
            if ($filterValues) {
                $cars->where(function ($query) use ($categoryType, $filterValues) {
                    foreach ($filterValues as $value) {
                        $query->orWhere($categoryType->category_type, $value); 
                    }
                });
                $selectedFilters[$categoryType->category_type] = $filterValues;
            }
        }
        $makes = Vehicle::distinct()->pluck('make');
        $cars = $cars->paginate(12);
    
            // Get all unique models and variants, grouped by make
    $models = Vehicle::select('make', 'model')
    ->distinct()
    ->orderBy('model')
    ->get()
    ->groupBy('make');

$variants = Vehicle::select('make', 'model', 'variant')
      ->distinct()
      ->orderBy('variant')
      ->get()
      ->groupBy(['make', 'model']); 
$categoryTypes = Category::where('category_type', '!=', 'Make')
      ->where('category_type', '!=', 'Model')
      ->where('category_type', '!=', 'Variant')
      ->distinct('category_type') 
      ->pluck('category_type'); 

$categories = Category::whereNotIn('category_type', ['Make', 'Model', 'Variant'])
   ->orderBy('category_name')
   ->get()
   ->groupBy('category_type'); 

            
$featuredCars = Vehicle::whereHas('listing', function ($query) {
$query->where('listing_status', 'active')->where('featured', true);
})->get();

$sponsoredCars = Vehicle::whereHas('listing', function ($query) {
$query->where('listing_status', 'active')->where('sponsored', true);
})->get();

$latestCars = Vehicle::whereHas('listing', function ($query) { 
$query->where('listing_status', 'active');
})->orderBy('listed_at', 'desc')->take(3)->get();

$news = News::orderBy('published_at', 'desc')->take(3)->get();

// Data for the Make Analysis chart
$makeCounts = DB::table('vehicles')
   ->select('make', DB::raw('count(*) as count'))
   ->groupBy('make')
   ->get();

$makeLabels = $makeCounts->pluck('make');
$makeCounts = $makeCounts->pluck('count');

        return view('cars.index', compact(
            'cars',
            'makes',
            'models', 
            'variants', 
            'categoryTypes',
            'selectedFilters',
            'featuredCars', 
            'sponsoredCars', 
            'news', 
            'latestCars', 
            'makeLabels', 
            'makeCounts',
            'makes',
            'variants',
            'categoryTypes',
            'models',
            'categories'
        ));
    }
*/

public function search(Request $request)
{
    try {
        // Base query with active listings
        $query = Vehicle::query()->whereHas('listing', function ($query) {
            $query->where('listing_status', 'active');
        });

        // Independent filters
        $query->where(function ($subQuery) use ($request) {
            // Filter by selected brands
            if ($request->filled('car_brand_id')) {
                $subQuery->orWhereIn('car_brand_id', $request->car_brand_id);
            }

            // Filter by selected models
            if ($request->filled('car_model_id')) {
                $subQuery->orWhereIn('car_model_id', $request->car_model_id);
            }

            // Filter by selected variants
            if ($request->filled('variant_id')) {
                $subQuery->orWhereIn('variant_id', $request->variant_id);
            }

            // Price filter
            if ($request->filled('minPrice') && $request->filled('maxPrice')) {
                $subQuery->whereBetween('price', [$request->minPrice, $request->maxPrice]);
            } elseif ($request->filled('minPrice')) {
                $subQuery->where('price', '>=', $request->minPrice);
            } elseif ($request->filled('maxPrice')) {
                $subQuery->where('price', '<=', $request->maxPrice);
            }

            // Year filter
            if ($request->filled('minYear') && $request->filled('maxYear')) {
                $subQuery->whereBetween('year', [$request->minYear, $request->maxYear]);
            } elseif ($request->filled('minYear')) {
                $subQuery->where('year', '>=', $request->minYear);
            } elseif ($request->filled('maxYear')) {
                $subQuery->where('year', '<=', $request->maxYear);
            }

            // Mileage filter
            if ($request->filled('minMileage') && $request->filled('maxMileage')) {
                $subQuery->whereBetween('mileage', [$request->minMileage, $request->maxMileage]);
            } elseif ($request->filled('minMileage')) {
                $subQuery->where('mileage', '>=', $request->minMileage);
            } elseif ($request->filled('maxMileage')) {
                $subQuery->where('mileage', '<=', $request->maxMileage);
            }

            // Body type filter
            if ($request->filled('body_typefooter')) {
                $subQuery->orWhere('body_type', '=', $request->body_typefooter);
            }

            // Condition filter
            if ($request->filled('conditions')) {
                $subQuery->orWhere('car_condition', '=', $request->conditions);
            }

          
            Log::error($request);
            // Province filter
            if ($request->filled('province')) {
                $subQuery->orWhereHas('listing.dealer', function ($locationQuery) use ($request) {
                    $locationQuery->whereIn('province', $request->province);
                });
            }
            
        });

        // Sorting
        switch ($request->input('sortBy')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'year_desc':
                $query->orderBy('year', 'desc');
                break;
            case 'year_asc':
                $query->orderBy('year', 'asc');
                break;
            case 'mileage_asc':
                $query->orderBy('mileage', 'asc');
                break;
            case 'mileage_desc':
                $query->orderBy('mileage', 'desc');
                break;
            default:
                $query->orderBy('listed_at', 'desc');
                break;
        }

        // Include relationships and images
        $query->with('images');

        // Get results with pagination
        $cars = $query->distinct()->paginate(2); // `distinct` ensures no duplicates

        if ($request->ajax()) {
            $html = view('partials._car_list', compact('cars'))->render();
            $pagination = view('partials._pagination', compact('cars'))->render();
            $resultsCount = view('partials._car_count_showing', compact('cars'))->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination,
                'resultsCount' => $resultsCount
            ]);
        }

        // Aggregate additional data
        $carBrands = CarBrand::withCount(['vehicles as vehicle_count' => function ($query) {
            $query->whereColumn('vehicles.car_brand_id', 'car_brands.id');
        }])->get();

        $Carmodels = CarModel::withCount(['vehicles as vehicle_count' => function ($query) {
            $query->whereColumn('vehicles.car_model_id', 'car_models.id');
        }])->get();

        $Carvariants = Variant::withCount(['vehicles as vehicle_count' => function ($query) {
            $query->whereColumn('vehicles.variant_id', 'variants.id');
        }])->get();

        return view('cars.index', compact('cars', 'carBrands', 'Carmodels', 'Carvariants'));
    } catch (\Exception $e) {
        Log::error('Search error: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}



private function monthlyPaymentToPrice($monthlyPayment) {
    $interestRate = 0.15; 
    $financeFeeRate = 0.10; 
    $loanTermYears = 5.9; 

    $monthlyInterestRate = $interestRate / 12;
    $numPayments = $loanTermYears * 12;

    // This is a simplified reversal of the monthly payment formula.
    // You might need to adjust it based on your exact `calculateMonthlyPayment` function.
    $price = $monthlyPayment * (1 - pow(1 + $monthlyInterestRate, -$numPayments)) / ($monthlyInterestRate * (1 + $financeFeeRate)); 

    return round($price, 2);
}
// ... (monthlyPaymentToPrice helper function) ...


public function getMakes()
{
    $makes = CarBrand::all();
    return view('financecalculator', compact('makes'));
}

public function CargetModels($make_id)
{
    $models = CarModel::where('make_id', $make_id)->get();
    return response()->json($models);
}

public function CargetVariants($model_id)
{
    $variants = Variant::where('model_id', $model_id)->get();
    return response()->json($variants);
}



public function showDealerships(Request $request)
{

    $dealerships = Dealer::withCount(['listings as total_cars' => function ($query) {
        $query->where('listing_status', 'active');
    }])
    ->withCount(['listings as car_makes_count' => function ($query) {
        $query->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
              ->select(DB::raw('count(distinct vehicles.make)'));
    }])
    ->withCount(['listings as car_models_count' => function ($query) {
        $query->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
              ->select(DB::raw('count(distinct vehicles.model)'));
    }])
    ->paginate(10);

    $sponsoredCars = Listing::where('sponsored', true)
                            ->latest()
                            ->take(5)
                            ->get();

    $provinces = Dealer::select('province', DB::raw('count(*) as total'))
                       ->groupBy('province')
                       ->get();

    return view('dealerships.index', compact('dealerships', 'sponsoredCars', 'provinces'));
}

public function showDealership($id)
{
    \Log::info(  $id);

    $dealership = Dealer::with(['listings' => function ($query) {
        $query->where('listing_status', 'active')
              ->with(['vehicle', 'images']);
    }])->findOrFail($id);

    return view('dealerships.show', compact('dealership'));
}

public function searchDealer(Request $request)
{
    $query = $request->input('query', '');
    $province = $request->input('province', '');
    \Log::info(  $province);

    $dealerships = Dealer::query()
        ->when($query, function ($queryBuilder) use ($query) {
            $queryBuilder->where('dealership_name', 'like', "%$query%");
        })
        ->when($province, function ($queryBuilder) use ($province) {
            $queryBuilder->where('province', $province);
        })
        ->paginate(10); // Adjust pagination as needed

    $html = View::make('partials.dealership_list', compact('dealerships'))->render();

    return response()->json(['html' => $html]);
}


}
