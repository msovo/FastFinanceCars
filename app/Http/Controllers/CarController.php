<?php
namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\News;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingComment;
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
        'categories'
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

        $featuredCars = Listing::where('featured', 1)
        ->where('listing_status', 'active')
        ->with('vehicle', 'images')
        ->paginate(3, ['*'], 'featured_page');

    $sponsoredCars = Listing::where('sponsored', 1)
        ->where('listing_status', 'active')
        ->with('vehicle', 'images')
        ->paginate(3, ['*'], 'sponsored_page');

        $news = News::where('title', 'like', '%' . $car->make . '%')
                    ->orWhere('title', 'like', '%' . $car->model . '%')
                    ->orWhere('content', 'like', '%' . $car->make . '%')
                    ->orWhere('title', 'like', '%' . $car->variant . '%')

                    ->orWhere('content', 'like', '%' . $car->model . '%')
                    ->orWhere('content', 'like', '%' . $car->variant . '%')

                    ->take(5)
                    ->get();

                    return view('cars.show', compact('car', 'listing_id', 'featuredCars', 'sponsoredCars'))
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

public function search(Request $request)
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
    $makes = Vehicle::distinct()->pluck('make');
    $models = Vehicle::distinct()->pluck('model'); 
    $variants = Vehicle::distinct()->pluck('variant'); 
    $categoryTypes = Category::whereNotIn('category_type', ['Make', 'Model', 'Variant'])->get();

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
}
