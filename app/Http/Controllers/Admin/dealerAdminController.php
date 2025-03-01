<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Inquiry;
use App\Models\Listing;
use App\Models\Vehicle;

class dealerAdminController extends Controller
{
    public function index()
    {
        $dealers = Dealer::with(['listings', 'soldListings'])
            ->withCount(['listings', 'soldListings'])
            ->get();

        return view('admin.dealers.index', compact('dealers'));
    }
    
    public function create()
    {
        return view('admin.dealers.create');
    }
   // In your controller:
   public function createverify()
   {
       $query = Dealer::where('verified', false)
           ->with(['user', 'user.listings', 'user.listings.inquiries']);
   
       // Sorting functionality
       if (request()->has('sort')) {
           $sort = request()->sort;
           $direction = request()->direction ?? 'asc';
           
           switch($sort) {
               case 'created_at':
                   $query->orderBy('created_at', $direction);
                   break;
               case 'listings_count':
                   $query->withCount('user.listings')
                       ->orderBy('user_listings_count', $direction);
                   break;
               case 'inquiries_count':
                   $query->withCount(['user.listings as inquiries_count' => function($query) {
                       $query->withCount('inquiries');
                   }])
                   ->orderBy('inquiries_count', $direction);
                   break;
               default:
                   $query->orderBy('created_at', 'desc');
           }
       } else {
           $query->orderBy('created_at', 'desc');
       }
   
       // Filter by province
       if (request()->has('province') && request()->province != 'all') {
           $query->whereHas('user', function($q) {
               $q->where('province', request()->province);
           });
       }
   
       // Filter by verification status
       if (request()->has('status')) {
           $query->where('verified', request()->status === 'Verified');
       }
   
       $pendingDealers = $query->paginate(10)
           ->through(function($dealer) {
               return [
                   'id' => $dealer->dealer_id,
                   'user_id' => $dealer->user->user_id,
                   'name' => $dealer->dealership_name,
                   'email' => $dealer->license_number ?? 'No License',
                   'phone' => $dealer->contact ?? 'No Phone',
                   'address' => $dealer->address ?? 'No Address',
                   'province' => $dealer->province ?? 'Unknown',
                   'listings_count' => $dealer->user->listings->count(),
                   'inquiries_count' => $dealer->user->listings->sum(function($listing) {
                       return $listing->inquiries->count();
                   }),
                   'logo' => $dealer->logo ? : 'default.png',
                   'status' => $dealer->verified ? 'Verified' : 'Pending',
                   'status_color' => $dealer->verified ? 'success' : 'warning',
                   'created_at' => $dealer->created_at
               ];
           });

       $provinces = [
           'Eastern Cape',
           'Free State',
           'Gauteng',
           'KwaZulu-Natal',
           'Limpopo',
           'Mpumalanga',
           'North West',
           'Northern Cape',
           'Western Cape'
       ];
   
       return view('admin.dealers.verification', compact('pendingDealers', 'provinces'));
   }
    public function verifyMultiple(Request $request)
{
    try {
        Dealer::whereIn('id', $request->dealer_ids)->update(['verified' => true]);
        return response()->json(['success' => true, 'message' => 'Dealers verified successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error verifying dealers'], 500);
    }
}

public function rejectMultiple(Request $request)
{
    try {
        Dealer::whereIn('id', $request->dealer_ids)->update([
            'verified' => false,
            'rejection_reason' => $request->reason
        ]);
        return response()->json(['success' => true, 'message' => 'Dealers rejected successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error rejecting dealers'], 500);
    }
}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:dealers,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $dealer = Dealer::create($validated);

        if ($request->hasFile('logo')) {
            $dealer->addMediaFromRequest('logo')
                ->toMediaCollection('logos');
        }

        return redirect()
            ->route('admin.dealers.index')
            ->with('success', 'Dealer created successfully');
    }

    public function show(Dealer $dealer)
    {
        $dealer->load(['listings.vehicle', 'inquiries']);
        
        return view('admin.dealers.show', compact('dealer'));
    }

    public function edit(Dealer $dealer)
    {
        return view('admin.dealers.edit', compact('dealer'));
    }

    public function update(Request $request, Dealer $dealer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:dealers,email,' . $dealer->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'logo' => 'nullable|image|max:2048',
        ]);

        $dealer->update($validated);

        if ($request->hasFile('logo')) {
            $dealer->addMediaFromRequest('logo')
                ->toMediaCollection('logos');
        }

        return redirect()
            ->route('admin.dealers.index')
            ->with('success', 'Dealer updated successfully');
    }

    public function destroy(Dealer $dealer)
    {
        $dealer->delete();

        return redirect()
            ->route('admin.dealers.index')
            ->with('success', 'Dealer deleted successfully');
    }

   
    public function reports()
    {
        $metrics = $this->getDealerMetrics();
        $dealers = Dealer::with(['listings', 'soldListings'])
            ->withCount(['listings', 'soldListings'])
            ->get();
            
        try {
        
            return view('admin.dealers.reports', compact('metrics', 'dealers'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error generating report: ' . $e->getMessage());
        }
    }

    public function verify(Dealer $dealer)
    {
        $dealer->update(['verified' => true]);

        // Send notification to dealer
       // $dealer->notify(new DealerVerified());

        return back()->with('success', 'Dealer verified successfully');
    }

    public function suspend(Dealer $dealer)
    {
        $dealer->update(['status' => 'suspended']);

        // Send notification to dealer
       // $dealer->notify(new DealerSuspended());

        return back()->with('success', 'Dealer suspended successfully');
    }

    public function block(Dealer $dealer)
    {
        $dealer->update(['status' => 'blocked']);

        // Send notification to dealer
        //$dealer->notify(new DealerBlocked());

        return back()->with('success', 'Dealer blocked successfully');
    }


// Add these methods for dealer actions
public function verifyDealer(Dealer $dealer)
{
    dd($dealer);
    \Log::info('Verify Dealer Method Called', [
        'dealer_id' => $dealer->id,
        'current_status' => $dealer->verified,
        'timestamp' => now()
    ]);

    try {
        // Log the dealer data before update
        \Log::info('Dealer Data Before Update', [
            'dealer' => $dealer->toArray()
        ]);

        $updated = $dealer->update(['verified' => 1]);

        // Log the update result
        \Log::info('Dealer Update Result', [
            'success' => $updated,
            'new_status' => $dealer->fresh()->verified
        ]);

        if ($updated) {
            \Log::info('Dealer Verification Successful', [
                'dealer_id' => $dealer->id,
                'verified_at' => now()
            ]);

            return response()->json([
                'success' => true, 
                'message' => 'Dealer verified successfully',
                'dealer' => $dealer->fresh()
            ]);
        } else {
            \Log::warning('Dealer Verification Failed - Update Returned False', [
                'dealer_id' => $dealer->id
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update dealer verification status'
            ], 500);
        }

    } catch (\Exception $e) {
        // Log the error details
        \Log::error('Dealer Verification Error', [
            'dealer_id' => $dealer->id,
            'error_message' => $e->getMessage(),
            'error_code' => $e->getCode(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'stack_trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'success' => false,
            'message' => 'Error verifying dealer: ' . $e->getMessage(),
            'error_details' => config('app.debug') ? $e->getMessage() : null
        ], 500);
    } finally {
        // Log the final state regardless of outcome
        \Log::info('Verify Dealer Method Completed', [
            'dealer_id' => $dealer->id,
            'final_status' => $dealer->fresh()->verified,
            'completion_time' => now()
        ]);
    }
}

public function rejectDealer(Dealer $dealer, Request $request)
{
    try {
        $dealer->update([
            'verified' => false,
            'rejection_reason' => $request->reason
        ]);
        return response()->json(['success' => true, 'message' => 'Dealer rejected successfully']);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => 'Error rejecting dealer'], 500);
    }
}

private function getResponseTimes($startDate, $endDate)
{
    return Inquiry::whereBetween('created_at', [$startDate, $endDate])
        ->select(
            DB::raw('AVG(response_time) as avg_response_time'),
            DB::raw('MIN(response_time) as min_response_time'),
            DB::raw('MAX(response_time) as max_response_time'),
            'dealer_id'
        )
        ->groupBy('dealer_id')
        ->get();
}
private function getInventoryAging($startDate, $endDate)
{
    $agingData = DB::table('listings')
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->where('listings.listing_status', 'active')
        ->select(
            DB::raw('
                CASE 
                    WHEN DATEDIFF(CURRENT_DATE, listings.created_at) <= 30 THEN "0-30 days"
                    WHEN DATEDIFF(CURRENT_DATE, listings.created_at) <= 60 THEN "31-60 days"
                    WHEN DATEDIFF(CURRENT_DATE, listings.created_at) <= 90 THEN "61-90 days"
                    ELSE "90+ days"
                END as age_range
            '),
            DB::raw('COUNT(*) as count'),
            DB::raw('AVG(vehicles.price) as average_price'),
            DB::raw('SUM(vehicles.price) as total_value')
        )
        ->groupBy('age_range')
        ->orderBy(DB::raw('MIN(DATEDIFF(CURRENT_DATE, listings.created_at))'))
        ->get();

    return collect($agingData); // Convert to collection
}
private function getInventoryOverview($startDate, $endDate)
{
    // Calculate inventory growth
    $currentInventory = Vehicle::whereBetween('updated_at', [$startDate, $endDate])->count();
    
    // Calculate previous period
    $previousStartDate = Carbon::parse($startDate)->subDays(Carbon::parse($startDate)->diffInDays($endDate));
    $previousInventory = Vehicle::whereBetween('updated_at', [$previousStartDate, $startDate])->count();
    // Calculate growth percentage
    $inventoryGrowth = $previousInventory > 0 
        ? (($currentInventory - $previousInventory) / $previousInventory) * 100 
        : ($currentInventory > 0 ? 100 : 0);

    return [
        'total_inventory' => Vehicle::count(),
        'active_listings' => Listing::where('listing_status', 'active')->count(),
        'sold_inventory' => Listing::where('listing_status', 'sold')
            ->whereBetween('updated_at', [$startDate, $endDate])
            ->count(),
        'new_inventory' => Vehicle::whereBetween('updated_at', [$startDate, $endDate])->count(),
        'average_price' => Vehicle::avg('price'),
        'total_value' => Vehicle::sum('price'),
        'inventory_growth' => $inventoryGrowth // Add this line
    ];
}

// Also update the blade view to handle the case where inventory_growth might not be set




private function getPriceDistribution($startDate, $endDate)
{
    $priceRanges = DB::table('vehicles')
        ->join('listings', 'vehicles.vehicle_id', '=', 'listings.vehicle_id')
        ->where('listings.listing_status', 'active')
        ->whereBetween('listings.created_at', [$startDate, $endDate])
        ->select(
            DB::raw('
                CASE 
                    WHEN price <= 100000 THEN "0-100k"
                    WHEN price <= 250000 THEN "100k-250k"
                    WHEN price <= 500000 THEN "250k-500k"
                    WHEN price <= 1000000 THEN "500k-1M"
                    ELSE "Over 1M"
                END as price_range
            '),
            DB::raw('COUNT(*) as total'),
            DB::raw('AVG(price) as avg_price'),
            DB::raw('SUM(price) as total_value')
        )
        ->groupBy('price_range')  // Changed from 'range' to 'price_range'
        ->orderBy(DB::raw('MIN(price)'))
        ->get();

    $totalVehicles = $priceRanges->sum('total');
    
    return [
        'ranges' => $priceRanges->pluck('price_range')->toArray(),  // Changed from 'range' to 'price_range'
        'percentages' => $priceRanges->map(function($range) use ($totalVehicles) {
            return $totalVehicles > 0 ? ($range->total / $totalVehicles) * 100 : 0;
        })->toArray(),
        'totals' => $priceRanges->pluck('total')->toArray(),
        'avg_prices' => $priceRanges->pluck('avg_price')->toArray(),
        'total_values' => $priceRanges->pluck('total_value')->toArray()
    ];
}

private function getStockTurnover($startDate, $endDate)
{
    $averageInventory = (
        Vehicle::where('updated_at', '<=', $startDate)->count() +
        Vehicle::where('updated_at', '<=', $endDate)->count()
    ) / 2;

    $soldInventory = Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->count();

    return [
        'turnover_rate' => $averageInventory > 0 ? ($soldInventory / $averageInventory) : 0,
        'average_days_to_sell' => $this->calculateAverageDaysToSell($startDate, $endDate),
        'monthly_turnover' => $this->calculateMonthlyTurnover($startDate, $endDate)
    ];
}


private function getPopularCategories($startDate, $endDate)
{
    return DB::table('vehicles')
        ->join('categories', 'vehicles.make', '=', 'categories.category_name')
        ->select(
            'categories.category_name',
            DB::raw('COUNT(*) as total'),
            DB::raw('AVG(price) as average_price'),
            DB::raw('SUM(price) as total_value')
        )
        ->groupBy('categories.category_name')
        ->orderBy('total', 'desc')
        ->take(10)
        ->get();
}



private function calculateGrowthRate($metric, $startDate, $endDate)
{
    // Ensure dates are properly formatted Carbon instances
    $startDate = Carbon::parse($startDate);
    $endDate = Carbon::parse($endDate);
    
    $previousStartDate = $startDate->copy()->subDays(
        $startDate->diffInDays($endDate)
    );

    $currentValue = $this->getMetricValue($metric, $startDate, $endDate);
    $previousValue = $this->getMetricValue($metric, $previousStartDate, $startDate);

    if ($previousValue == 0) {
        return $currentValue > 0 ? 100 : 0;
    }

    return round((($currentValue - $previousValue) / $previousValue) * 100, 2);
}

private function getMetricValue($metric, $startDate, $endDate)
{
    switch ($metric) {
        case 'dealers':
            return User::where('role', 'dealer')
                ->whereBetween('created_at', [$startDate, $endDate])
                ->count();

                case 'revenue':
                    return Listing::where('listing_status', 'sold')
                        ->whereDate('listings.updated_at', '>=', $startDate)
                        ->whereDate('listings.updated_at', '<=', $endDate)
                        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                        ->sum('vehicles.price') ?? 0;

        case 'listings':
            return Listing::whereBetween('created_at', [$startDate, $endDate])
                ->count();

        case 'conversion':
            $totalInquiries = Inquiry::whereBetween('created_at', [$startDate, $endDate])
                ->count();
            $totalSales = Listing::where('listing_status', 'sold')
                ->whereBetween('updated_at', [$startDate, $endDate])
                ->count();
            
            return $totalInquiries > 0 ? ($totalSales / $totalInquiries) * 100 : 0;

        case 'inventory':
            return Vehicle::whereBetween('created_at', [$startDate, $endDate])
                ->count();

        default:
            return 0;
    }
}

private function calculateInventoryGrowth($startDate, $endDate)
{
    $previousStartDate = Carbon::parse($startDate)->subDays(
        Carbon::parse($startDate)->diffInDays($endDate)
    );

    $currentInventory = Vehicle::whereBetween('updated_at', [$startDate, $endDate])->count();
    $previousInventory = Vehicle::whereBetween('updated_at', [$previousStartDate, $startDate])->count();

    if ($previousInventory == 0) {
        return $currentInventory > 0 ? 100 : 0;
    }

    return round((($currentInventory - $previousInventory) / $previousInventory) * 100, 2);
}

private function calculateAverageDaysToSell($startDate, $endDate)
{
    return Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->whereNotNull('created_at')
        ->select(DB::raw('AVG(DATEDIFF(updated_at, created_at)) as avg_days'))
        ->value('avg_days') ?? 0;
}

private function calculateMonthlyTurnover($startDate, $endDate)
{
    $months = Carbon::parse($startDate)->diffInMonths(Carbon::parse($endDate)) + 1;
    
    $monthlyData = [];
    $currentDate = Carbon::parse($startDate);

    for ($i = 0; $i < $months; $i++) {
        $monthStart = $currentDate->copy()->startOfMonth();
        $monthEnd = $currentDate->copy()->endOfMonth();

        $averageInventory = (
            Vehicle::where('updated_at', '<=', $monthStart)->count() +
            Vehicle::where('updated_at', '<=', $monthEnd)->count()
        ) / 2;

        $soldInventory = Listing::where('listing_status', 'sold')
            ->whereBetween('updated_at', [$monthStart, $monthEnd])
            ->count();

        $monthlyData[] = [
            'month' => $monthStart->format('M Y'),
            'turnover' => $averageInventory > 0 ? ($soldInventory / $averageInventory) : 0
        ];

        $currentDate->addMonth();
    }

    return $monthlyData;
}

private function calculateValueTrend($startDate, $endDate)
{
    $months = Carbon::parse($startDate)->diffInMonths(Carbon::parse($endDate)) + 1;
    
    $valueTrend = [];
    $currentDate = Carbon::parse($startDate);

    for ($i = 0; $i < $months; $i++) {
        $monthStart = $currentDate->copy()->startOfMonth();
        $monthEnd = $currentDate->copy()->endOfMonth();

        $totalValue = Vehicle::whereBetween('updated_at', [$monthStart, $monthEnd])
            ->sum('price');

        $valueTrend[] = [
            'month' => $monthStart->format('M Y'),
            'value' => $totalValue
        ];

        $currentDate->addMonth();
    }

    return $valueTrend;
}

private function calculateValueChange($startDate, $endDate)
{
    $previousStartDate = Carbon::parse($startDate)->subDays(
        Carbon::parse($startDate)->diffInDays($endDate)
    );

    $currentValue = Vehicle::whereBetween('updated_at', [$startDate, $endDate])
        ->sum('price');
    
    $previousValue = Vehicle::whereBetween('updated_at', [$previousStartDate, $startDate])
        ->sum('price');

    if ($previousValue == 0) {
        return $currentValue > 0 ? 100 : 0;
    }

    return round((($currentValue - $previousValue) / $previousValue) * 100, 2);
}

private function getValueByCategory($startDate, $endDate)
{
    return DB::table('vehicles')
        ->join('categories', 'vehicles.make', '=', 'categories.category_name')
        ->whereBetween('vehicles.updated_at', [$startDate, $endDate])
        ->select(
            'categories.category_name',
            DB::raw('SUM(price) as total_value'),
            DB::raw('COUNT(*) as count'),
            DB::raw('AVG(price) as average_price')
        )
        ->groupBy('categories.category_name')
        ->orderBy('total_value', 'desc')
        ->get();
}



private function getDateLabels($startDate, $endDate)
{
    $dates = [];
    $currentDate = Carbon::parse($startDate);
    $endDate = Carbon::parse($endDate);

    while ($currentDate <= $endDate) {
        $dates[] = $currentDate->format('Y-m-d');
        $currentDate->addDay();
    }

    return $dates;
}

private function getSalesData($startDate, $endDate)
{
    $salesData = Listing::where('listing_status', 'sold')
        ->whereDate('updated_at', '>=', $startDate)
        ->whereDate('updated_at', '<=', $endDate)
        ->selectRaw('DATE(updated_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->pluck('count', 'date')
        ->toArray();

    // Fill in missing dates with zero
    $allDates = $this->getDateLabels($startDate, $endDate);
    $formattedData = [];

    foreach ($allDates as $date) {
        $formattedData[] = $salesData[$date] ?? 0;
    }

    return $formattedData;
}

private function getRevenueData($startDate, $endDate)
{
    $revenueData = Listing::where('listings.listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->selectRaw('DATE(listings.updated_at) as date, SUM(vehicles.price) as total')
        ->groupBy('date')
        ->pluck('total', 'date')
        ->toArray();

    // Fill in missing dates with zero
    $allDates = $this->getDateLabels($startDate, $endDate);
    $formattedData = [];

    foreach ($allDates as $date) {
        $formattedData[] = $revenueData[$date] ?? 0;
    }

    return $formattedData;
}

private function getListingsData($startDate, $endDate)
{
    $listingsData = Listing::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->pluck('count', 'date')
        ->toArray();

    // Fill in missing dates with zero
    $allDates = $this->getDateLabels($startDate, $endDate);
    $formattedData = [];

    foreach ($allDates as $date) {
        $formattedData[] = $listingsData[$date] ?? 0;
    }

    return $formattedData;
}

private function formatDateRange($startDate, $endDate)
{
    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);

    if ($start->format('Y-m') === $end->format('Y-m')) {
        // Same month
        return $start->format('F Y');
    } elseif ($start->format('Y') === $end->format('Y')) {
        // Same year
        return $start->format('M') . ' - ' . $end->format('M Y');
    } else {
        // Different years
        return $start->format('M Y') . ' - ' . $end->format('M Y');
    }
}

private function getDateRangeType($startDate, $endDate)
{
    $days = Carbon::parse($startDate)->diffInDays($endDate);
    
    if ($days <= 7) {
        return 'daily';
    } elseif ($days <= 31) {
        return 'weekly';
    } elseif ($days <= 365) {
        return 'monthly';
    } else {
        return 'yearly';
    }
}

private function aggregateDataByPeriod($data, $type)
{
    switch ($type) {
        case 'weekly':
            return $this->aggregateByWeek($data);
        case 'monthly':
            return $this->aggregateByMonth($data);
        case 'yearly':
            return $this->aggregateByYear($data);
        default:
            return $data;
    }
}

private function aggregateByWeek($data)
{
    $weeklyData = [];
    foreach ($data as $date => $value) {
        $weekNumber = Carbon::parse($date)->format('W');
        $weekYear = Carbon::parse($date)->format('Y');
        $weekKey = $weekYear . '-W' . $weekNumber;
        
        if (!isset($weeklyData[$weekKey])) {
            $weeklyData[$weekKey] = 0;
        }
        $weeklyData[$weekKey] += $value;
    }
    return $weeklyData;
}

private function aggregateByMonth($data)
{
    $monthlyData = [];
    foreach ($data as $date => $value) {
        $monthKey = Carbon::parse($date)->format('Y-m');
        
        if (!isset($monthlyData[$monthKey])) {
            $monthlyData[$monthKey] = 0;
        }
        $monthlyData[$monthKey] += $value;
    }
    return $monthlyData;
}

private function aggregateByYear($data)
{
    $yearlyData = [];
    foreach ($data as $date => $value) {
        $yearKey = Carbon::parse($date)->format('Y');
        
        if (!isset($yearlyData[$yearKey])) {
            $yearlyData[$yearKey] = 0;
        }
        $yearlyData[$yearKey] += $value;
    }
    return $yearlyData;
}

private function formatChartLabels($data, $type)
{
    $labels = array_keys($data);
    
    switch ($type) {
        case 'weekly':
            return array_map(function($label) {
                list($year, $week) = explode('-W', $label);
                return "Week {$week}, {$year}";
            }, $labels);
            
        case 'monthly':
            return array_map(function($label) {
                return Carbon::createFromFormat('Y-m', $label)->format('M Y');
            }, $labels);
            
        case 'yearly':
            return $labels;
            
        default:
            return array_map(function($label) {
                return Carbon::parse($label)->format('M d, Y');
            }, $labels);
    }

    
}
private function getVehicleDistribution($startDate, $endDate)
{
    return Listing::join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->whereDate('listings.created_at', '>=', $startDate)
        ->whereDate('listings.created_at', '<=', $endDate)
        ->select(
            'vehicles.car_condition',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN listings.listing_status = "sold" THEN 1 ELSE 0 END) as sold'),
            DB::raw('AVG(vehicles.price) as average_price')
        )
        ->groupBy('vehicles.car_condition')
        ->get()
        ->map(function ($item) {
            return [
                'condition' => $item->car_condition,
                'total' => $item->total,
                'sold' => $item->sold,
                'conversion_rate' => $item->total > 0 ? ($item->sold / $item->total) * 100 : 0,
                'average_price' => $item->average_price
            ];
        })
        ->pluck('total')
        ->toArray();
}

// You might also want to add this helper method to get the distribution labels
private function getVehicleDistributionLabels()
{
    return [
        'New',
        'Used',
        'Demo',
        'Classic'
    ];
}
private function getDailySalesData($startDate, $endDate)
{
    return Listing::where('listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->select(
            DB::raw('DATE(listings.updated_at) as date'),
            DB::raw('COUNT(*) as sales'),
            DB::raw('SUM(vehicles.price) as revenue')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->mapWithKeys(function ($item) {
            return [
                $item->date => [
                    'sales' => $item->sales,
                    'revenue' => $item->revenue
                ]
            ];
        })
        ->toArray();
}
private function getSalesByCategory($startDate, $endDate)
{
    $categories = Listing::where('listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->join('categories', 'vehicles.make', '=', 'categories.category_name')
        ->select(
            'categories.category_name as name',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(vehicles.price) as revenue')
        )
        ->groupBy('categories.category_name')
        ->orderBy('total', 'desc')
        ->get();

    $totalSales = $categories->sum('total');

    return $categories->map(function ($category) use ($totalSales) {
        return [
            'name' => $category->name,
            'total' => $category->total,
            'revenue' => $category->revenue,
            'percentage' => $totalSales > 0 ? ($category->total / $totalSales) * 100 : 0,
            'color' => $this->getCategoryColor($category->name) // You might want to add this helper method
        ];
    });
}

private function getCategoryColor($categoryName)
{
    // You can customize these colors based on your needs
    $colors = [
        'primary' => '#4e73df',
        'success' => '#1cc88a',
        'info' => '#36b9cc',
        'warning' => '#f6c23e',
        'danger' => '#e74a3b',
        'secondary' => '#858796'
    ];

    // You can map categories to specific colors or use a default rotation
    $colorIndex = array_keys($colors)[crc32($categoryName) % count($colors)];
    return $colors[$colorIndex];
}

private function getAverageSaleValue($startDate, $endDate)
{
    return Listing::where('listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->avg('vehicles.price') ?? 0;
}

private function getPeakSalesPeriods($startDate, $endDate)
{
    // Ensure dates are Carbon instances
    $startDate = Carbon::parse($startDate);
    $endDate = Carbon::parse($endDate);

    return Listing::where('listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->select(
            DB::raw('DATE_FORMAT(listings.updated_at, "%H:00") as period'),
            DB::raw('COUNT(*) as sales'),
            DB::raw('SUM(vehicles.price) as revenue')
        )
        ->groupBy('period')
        ->orderBy('sales', 'desc')
        ->get()
        ->map(function ($period) use ($startDate, $endDate) {  // Add use ($startDate, $endDate)
            return [
                'period' => $period->period,
                'sales' => $period->sales,
                'revenue' => $period->revenue,
                'trend' => $this->calculatePeriodTrend($period->period, $startDate, $endDate)
            ];
        });
}

private function calculatePeriodTrend($period, $startDate, $endDate)
{
    // Calculate the previous period date range
    $periodLength = $startDate->diffInDays($endDate);
    $previousStartDate = $startDate->copy()->subDays($periodLength);
    $previousEndDate = $startDate->copy()->subDay();

    // Get current period sales
    $currentPeriodSales = Listing::where('listing_status', 'sold')
        ->whereDate('updated_at', '>=', $startDate)
        ->whereDate('updated_at', '<=', $endDate)
        ->whereRaw('DATE_FORMAT(updated_at, "%H:00") = ?', [$period])
        ->count();

    // Get previous period sales
    $previousPeriodSales = Listing::where('listing_status', 'sold')
        ->whereDate('updated_at', '>=', $previousStartDate)
        ->whereDate('updated_at', '<=', $previousEndDate)
        ->whereRaw('DATE_FORMAT(updated_at, "%H:00") = ?', [$period])
        ->count();

    // Calculate trend percentage
    if ($previousPeriodSales == 0) {
        return $currentPeriodSales > 0 ? 100 : 0;
    }

    return round((($currentPeriodSales - $previousPeriodSales) / $previousPeriodSales) * 100, 2);
}



private function getSalesByLocation($startDate, $endDate)
{
    return Listing::where('listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->join('dealers', 'listings.dealer_id', '=', 'dealers.id')
        ->select(
            'dealers.location',
            DB::raw('COUNT(*) as total_sales'),
            DB::raw('SUM(vehicles.price) as total_revenue'),
            DB::raw('AVG(vehicles.price) as average_price')
        )
        ->groupBy('dealers.location')
        ->orderBy('total_sales', 'desc')
        ->get();
}

private function getBestSellingCategories($startDate, $endDate)
{
    return Listing::where('listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->join('categories', 'vehicles.make', '=', 'categories.category_name')
        ->select(
            'categories.category_name',
            DB::raw('COUNT(*) as total_sales'),
            DB::raw('SUM(vehicles.price) as total_revenue'),
            DB::raw('AVG(vehicles.price) as average_price'),
            DB::raw('AVG(DATEDIFF(listings.updated_at, listings.created_at)) as avg_days_to_sell')
        )
        ->groupBy('categories.category_name')
        ->orderBy('total_sales', 'desc')
        ->take(10)
        ->get();
}

private function getComparisonMetrics($startDate, $endDate)
{
    $previousStartDate = Carbon::parse($startDate)->subDays(
        Carbon::parse($startDate)->diffInDays($endDate)
    );

    $currentPeriod = $this->getPeriodMetrics($startDate, $endDate);
    $previousPeriod = $this->getPeriodMetrics($previousStartDate, $startDate);

    return [
        'current_period' => $currentPeriod,
        'previous_period' => $previousPeriod,
        'changes' => [
            'sales' => $this->calculatePercentageChange(
                $previousPeriod['total_sales'], 
                $currentPeriod['total_sales']
            ),
            'revenue' => $this->calculatePercentageChange(
                $previousPeriod['total_revenue'], 
                $currentPeriod['total_revenue']
            ),
            'average_price' => $this->calculatePercentageChange(
                $previousPeriod['average_price'], 
                $currentPeriod['average_price']
            ),
            'conversion_rate' => $this->calculatePercentageChange(
                $previousPeriod['conversion_rate'], 
                $currentPeriod['conversion_rate']
            )
        ]
    ];
}

private function getPeriodMetrics($startDate, $endDate)
{
    $sales = Listing::where('listing_status', 'sold')
        ->whereDate('updated_at', '>=', $startDate)
        ->whereDate('updated_at', '<=', $endDate)
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->select(
            DB::raw('COUNT(*) as total_sales'),
            DB::raw('SUM(vehicles.price) as total_revenue'),
            DB::raw('AVG(vehicles.price) as average_price')
        )
        ->first();

    $totalListings = Listing::whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->count();

    return [
        'total_sales' => $sales->total_sales,
        'total_revenue' => $sales->total_revenue,
        'average_price' => $sales->average_price,
        'conversion_rate' => $totalListings > 0 ? ($sales->total_sales / $totalListings) * 100 : 0
    ];
}

private function calculatePercentageChange($oldValue, $newValue)
{
    if ($oldValue == 0) {
        return $newValue > 0 ? 100 : 0;
    }

    return round((($newValue - $oldValue) / $oldValue) * 100, 2);
}
// Add this method for detailed distribution data
private function getDetailedVehicleDistribution($startDate, $endDate)
{
    return Listing::join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->whereDate('listings.created_at', '>=', $startDate)
        ->whereDate('listings.created_at', '<=', $endDate)
        ->select(
            'vehicles.car_condition',
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN listings.listing_status = "sold" THEN 1 ELSE 0 END) as sold'),
            DB::raw('AVG(vehicles.price) as average_price'),
            DB::raw('MIN(vehicles.price) as min_price'),
            DB::raw('MAX(vehicles.price) as max_price'),
            DB::raw('AVG(DATEDIFF(CASE WHEN listings.listing_status = "sold" 
                THEN listings.updated_at 
                ELSE CURRENT_TIMESTAMP 
                END, listings.created_at)) as avg_days_listed')
        )
        ->groupBy('vehicles.car_condition')
        ->get()
        ->map(function ($item) {
            return [
                'condition' => $item->car_condition,
                'total' => $item->total,
                'sold' => $item->sold,
                'conversion_rate' => $item->total > 0 ? ($item->sold / $item->total) * 100 : 0,
                'average_price' => $item->average_price,
                'min_price' => $item->min_price,
                'max_price' => $item->max_price,
                'avg_days_listed' => round($item->avg_days_listed),
                'percentage' => 0, // Will be calculated below
            ];
        })
        ->each(function ($item, $key) use (&$totalVehicles) {
            $totalVehicles = collect($item)->sum('total');
        })
        ->map(function ($item) use ($totalVehicles) {
            $item['percentage'] = $totalVehicles > 0 
                ? ($item['total'] / $totalVehicles) * 100 
                : 0;
            return $item;
        })
        ->toArray();
}

// Optional: Add a method to get trending conditions
private function getTrendingConditions($startDate, $endDate)
{
    $previousStartDate = Carbon::parse($startDate)->subDays(
        Carbon::parse($startDate)->diffInDays($endDate)
    );

    $currentDistribution = $this->getDetailedVehicleDistribution($startDate, $endDate);
    $previousDistribution = $this->getDetailedVehicleDistribution($previousStartDate, $startDate);

    $trends = [];
    foreach ($currentDistribution as $condition => $current) {
        $previous = collect($previousDistribution)
            ->firstWhere('condition', $condition);

        $trends[$condition] = [
            'growth' => $previous 
                ? (($current['total'] - $previous['total']) / $previous['total']) * 100 
                : 100,
            'conversion_change' => $previous 
                ? $current['conversion_rate'] - $previous['conversion_rate']
                : $current['conversion_rate'],
            'price_change' => $previous && $previous['average_price'] > 0
                ? (($current['average_price'] - $previous['average_price']) / $previous['average_price']) * 100
                : 0
        ];
    }

    return $trends;
}

// You might also want to add a method to get the most profitable conditions
private function getMostProfitableConditions($startDate, $endDate)
{
    return Listing::join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->where('listings.listing_status', 'sold')
        ->whereDate('listings.updated_at', '>=', $startDate)
        ->whereDate('listings.updated_at', '<=', $endDate)
        ->select(
            'vehicles.car_condition',
            DB::raw('COUNT(*) as sales_count'),
            DB::raw('SUM(vehicles.price) as total_revenue'),
            DB::raw('AVG(DATEDIFF(listings.updated_at, listings.created_at)) as avg_days_to_sell')
        )
        ->groupBy('vehicles.car_condition')
        ->orderBy('total_revenue', 'desc')
        ->get()
        ->map(function ($item) {
            return [
                'condition' => $item->car_condition,
                'sales_count' => $item->sales_count,
                'total_revenue' => $item->total_revenue,
                'avg_days_to_sell' => round($item->avg_days_to_sell),
                'revenue_per_day' => $item->avg_days_to_sell > 0 
                    ? $item->total_revenue / ($item->sales_count * $item->avg_days_to_sell)
                    : 0
            ];
        })
        ->toArray();
}

private function calculateAverageViewsBeforeInquiry($startDate, $endDate)
{
    return DB::table('listings')
        ->join('listing_views', 'listings.id', '=', 'listing_views.listing_id')
        ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
        ->whereDate('inquiries.created_at', '>=', $startDate)
        ->whereDate('inquiries.created_at', '<=', $endDate)
        ->whereRaw('listing_views.created_at <= inquiries.created_at')
        ->select(
            'inquiries.id',
            DB::raw('COUNT(DISTINCT listing_views.id) as view_count')
        )
        ->groupBy('inquiries.id')
        ->avg('view_count') ?? 0;
}

private function calculateReturnVisitorRate($startDate, $endDate)
{
    $totalVisitors = DB::table('listing_views')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->distinct('user_id')
        ->count();

    $returnVisitors = DB::table('listing_views')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->groupBy('user_id')
        ->havingRaw('COUNT(DISTINCT listing_id) > 1')
        ->count();

    return $totalVisitors > 0 ? ($returnVisitors / $totalVisitors) * 100 : 0;
}

private function getFavoriteAdditions($startDate, $endDate)
{
    return DB::table('favorites')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->count();
}

private function getSharedListings($startDate, $endDate)
{
    return DB::table('listing_shares')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->count();
}

private function getEngagementMetricsA($startDate, $endDate)
{
    return [
        'average_views_before_inquiry' => $this->calculateAverageViewsBeforeInquiry($startDate, $endDate),
        'return_visitor_rate' => $this->calculateReturnVisitorRate($startDate, $endDate),
        'favorite_additions' => $this->getFavoriteAdditions($startDate, $endDate),
        'shared_listings' => $this->getSharedListings($startDate, $endDate),
        'engagement_details' => $this->getDetailedEngagementMetrics($startDate, $endDate)
    ];
}

private function getDetailedEngagementMetrics($startDate, $endDate)
{
    return [
        'view_duration' => $this->getAverageViewDuration($startDate, $endDate),
        'peak_engagement_hours' => $this->getPeakEngagementHours($startDate, $endDate),
        'popular_features' => $this->getPopularFeatures($startDate, $endDate),
        'interaction_breakdown' => $this->getInteractionBreakdown($startDate, $endDate)
    ];
}

private function getAverageViewDuration($startDate, $endDate)
{
    return DB::table('listing_views')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->whereNotNull('duration')
        ->avg('duration') ?? 0;
}

private function getPeakEngagementHours($startDate, $endDate)
{
    return DB::table('listing_views')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->select(
            DB::raw('HOUR(created_at) as hour'),
            DB::raw('COUNT(*) as count')
        )
        ->groupBy('hour')
        ->orderBy('count', 'desc')
        ->get();
}

private function getPopularFeatures($startDate, $endDate)
{
    return DB::table('listing_interactions')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->select(
            'feature',
            DB::raw('COUNT(*) as interaction_count')
        )
        ->groupBy('feature')
        ->orderBy('interaction_count', 'desc')
        ->take(10)
        ->get();
}

private function getInteractionBreakdown($startDate, $endDate)
{
    return DB::table('listing_interactions')
        ->whereDate('created_at', '>=', $startDate)
        ->whereDate('created_at', '<=', $endDate)
        ->select(
            'interaction_type',
            DB::raw('COUNT(*) as count'),
            DB::raw('COUNT(DISTINCT user_id) as unique_users')
        )
        ->groupBy('interaction_type')
        ->get();
}

private function getDealerMetrics($startDate = null, $endDate = null)
{
    $startDate = $startDate ?? now()->subDays(30);
    $endDate = $endDate ?? now();
    // Calculate total revenue
    $totalRevenue = Listing::where('listing_status', 'sold')
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->sum('vehicles.price');

    // Calculate active listings
    $activeListings = Listing::where('listing_status', 'active')->count();

    // Calculate conversion rate
    $totalListings = Listing::count();
    $soldListings = Listing::where('listing_status', 'sold')->count();
    $conversionRate = $totalListings > 0 ? ($soldListings / $totalListings) * 100 : 0;
    // Calculate max revenue for performance score
    $maxRevenue = Dealer::with(['listings' => function($query) {
        $query->where('listing_status', 'sold')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->selectRaw('listings.user_id, SUM(vehicles.price) as total_revenue')
            ->groupBy('listings.user_id');
    }])
    ->get()
    ->pluck('listings.*.total_revenue')
    ->flatten()
    ->max() ?: 1;

    return [
        // Basic Metrics
        'total_dealers' => Dealer::count(),
        'total_revenue' => $totalRevenue,
        'active_listings' => $activeListings,
        'conversion_rate' => $conversionRate,

        // Growth Metrics
        'dealer_growth' => $this->calculateDealerGrowth($startDate, $endDate),
        'revenue_growth' => $this->calculateRevenueGrowth($startDate, $endDate),
        'listing_growth' => $this->calculateListingGrowth($startDate, $endDate),
        'conversion_growth' => $this->calculateConversionGrowth($startDate, $endDate),
        // Basic Metrics
        'active_dealers' => Dealer::where('status', 'active')->count(),
        'suspended_dealers' => Dealer::where('status', 'suspended')->count(),
        'blocked_dealers' => Dealer::where('status', 'blocked')->count(),
        'pending_verification' => Dealer::where('verified', false)->count(),

        // Performance Data for Charts
        'performance_data' => [
            'labels' => $this->getDateLabels($startDate, $endDate),
            'sales' => $this->getSalesData($startDate, $endDate),
            'revenue' => $this->getRevenueData($startDate, $endDate),
            'listings' => $this->getListingsData($startDate, $endDate)
        ],

        // Distribution Data
        'distribution_data' => [
            'labels' => ['New', 'Used', 'Demo', 'Classic'],
            'values' => $this->getVehicleDistribution($startDate, $endDate),
        ],

        // Top Performers
        'top_performers' => $this->getTopPerformers($maxRevenue),

        // Customer Behavior (Simplified)
        'customer_behavior' => [
            'inquiry_stats' => $this->getInquiryStatistics($startDate, $endDate),
            'peak_activity_hours' => $this->getPeakActivityHours($startDate, $endDate),
            'engagement_metrics' => $this->getEngagementMetrics($startDate, $endDate) ,// Add this line
            'conversion_funnel' => $this->getConversionFunnel($startDate, $endDate) // Add this line

        ],

        // Inventory Metrics
        'inventory_metrics' => [
            'overview' => $this->getInventoryOverview($startDate, $endDate),
            'aging_analysis' => $this->getInventoryAging($startDate, $endDate),
            'stock_turnover' => $this->getStockTurnover($startDate, $endDate),
            'price_distribution' => $this->getPriceDistribution($startDate, $endDate),
            'popular_categories' => $this->getPopularCategories($startDate, $endDate),
            'inventory_value' => $this->getInventoryValue($startDate, $endDate)
        ],

        // Sales Analysis
        'sales_analysis' => [
            'daily_sales' => $this->getDailySalesData($startDate, $endDate),
            'sales_by_category' => $this->getSalesByCategory($startDate, $endDate),
            'sales_trends' => $this->getSalesTrends($startDate, $endDate),
            'average_sale_value' => $this->getAverageSaleValue($startDate, $endDate),
            'peak_sales_periods' => $this->getPeakSalesPeriods($startDate, $endDate) // Add this line

        ]
    ];
}
private function getConversionFunnel($startDate, $endDate)
{
    // Get total listings (views)
    $views = Listing::whereBetween('created_at', [$startDate, $endDate])->count();
    
    // Get total inquiries
    $inquiries = Inquiry::whereBetween('created_at', [$startDate, $endDate])->count();
    
    // Get total sales (sold listings)
    $sales = Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->count();

    return [
        'views' => $views,
        'inquiries' => $inquiries,
        'sales' => $sales,
        'conversion_rates' => [
            'view_to_inquiry' => $views > 0 ? ($inquiries / $views) * 100 : 0,
            'inquiry_to_sale' => $inquiries > 0 ? ($sales / $inquiries) * 100 : 0,
            'overall' => $views > 0 ? ($sales / $views) * 100 : 0
        ]
    ];
}
private function calculateDealerGrowth($startDate, $endDate)
{
    // Get dealer count for current period
    $currentDealers = Dealer::whereBetween('created_at', [$startDate, $endDate])->count();

    // Get dealer count for previous period
    $previousStartDate = Carbon::parse($startDate)->subDays(Carbon::parse($startDate)->diffInDays($endDate));
    $previousDealers = Dealer::whereBetween('created_at', [$previousStartDate, $startDate])->count();

    // Calculate growth percentage
    return $previousDealers > 0 
        ? (($currentDealers - $previousDealers) / $previousDealers) * 100 
        : ($currentDealers > 0 ? 100 : 0);
}
private function getEngagementMetrics($startDate, $endDate)
{
    // Get total inquiries
    $totalInquiries = Inquiry::whereBetween('created_at', [$startDate, $endDate])->count();
    
    // Get unique users who made inquiries
    $uniqueUsers = Inquiry::whereBetween('created_at', [$startDate, $endDate])
        ->distinct('user_id')
        ->count();
    
    // Get total listings
    $totalListings = Listing::whereBetween('created_at', [$startDate, $endDate])->count();
    
    // Get sold listings
    $soldListings = Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->count();

    // Calculate average views before inquiry (simplified since we don't have listing_views)
    $averageViewsBeforeInquiry = 3; // Default placeholder value

    // Calculate return visitor rate (simplified)
    $returnVisitorRate = $uniqueUsers > 0 ? 
        (($totalInquiries - $uniqueUsers) / $uniqueUsers) * 100 : 0;

    // Get favorite additions (simplified since we don't have favorites table)
    $favoriteAdditions = 0;

    // Get shared listings (simplified since we don't have listing_shares table)
    $sharedListings = 0;

    return [
        'average_views_before_inquiry' => $averageViewsBeforeInquiry,
        'return_visitor_rate' => $returnVisitorRate,
        'favorite_additions' => $favoriteAdditions,
        'shared_listings' => $sharedListings,
        'total_interactions' => $totalInquiries,
        'unique_users' => $uniqueUsers,
        'conversion_rate' => $totalListings > 0 ? ($soldListings / $totalListings) * 100 : 0
    ];
}
private function calculateRevenueGrowth($startDate, $endDate)
{
    // Current period revenue
    $currentRevenue = Listing::where('listing_status', 'sold')
        ->whereBetween('listings.updated_at', [$startDate, $endDate])
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->sum('vehicles.price');

    // Previous period revenue
    $previousStartDate = Carbon::parse($startDate)->subDays(Carbon::parse($startDate)->diffInDays($endDate));
    $previousRevenue = Listing::where('listing_status', 'sold')
        ->whereBetween('listings.updated_at', [$previousStartDate, $startDate])
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->sum('vehicles.price');

    // Calculate growth percentage
    return $previousRevenue > 0 
        ? (($currentRevenue - $previousRevenue) / $previousRevenue) * 100 
        : ($currentRevenue > 0 ? 100 : 0);
}

private function calculateListingGrowth($startDate, $endDate)
{
    // Current period listings
    $currentListings = Listing::whereBetween('created_at', [$startDate, $endDate])->count();

    // Previous period listings
    $previousStartDate = Carbon::parse($startDate)->subDays(Carbon::parse($startDate)->diffInDays($endDate));
    $previousListings = Listing::whereBetween('created_at', [$previousStartDate, $startDate])->count();

    // Calculate growth percentage
    return $previousListings > 0 
        ? (($currentListings - $previousListings) / $previousListings) * 100 
        : ($currentListings > 0 ? 100 : 0);
}

private function calculateConversionGrowth($startDate, $endDate)
{
    // Current period conversion rate
    $currentTotalListings = Listing::whereBetween('created_at', [$startDate, $endDate])->count();
    $currentSoldListings = Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->count();
    $currentConversion = $currentTotalListings > 0 
        ? ($currentSoldListings / $currentTotalListings) * 100 
        : 0;

    // Previous period conversion rate
    $previousStartDate = Carbon::parse($startDate)->subDays(Carbon::parse($startDate)->diffInDays($endDate));
    $previousTotalListings = Listing::whereBetween('created_at', [$previousStartDate, $startDate])->count();
    $previousSoldListings = Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$previousStartDate, $startDate])
        ->count();
    $previousConversion = $previousTotalListings > 0 
        ? ($previousSoldListings / $previousTotalListings) * 100 
        : 0;

    // Calculate growth percentage
    return $previousConversion > 0 
        ? (($currentConversion - $previousConversion) / $previousConversion) * 100 
        : ($currentConversion > 0 ? 100 : 0);
}

private function getTopPerformers($maxRevenue)
{
    return Dealer::withCount([
        'listings',
        'listings as sold_listings_count' => function($query) {
            $query->where('listing_status', 'sold');
        }
    ])
    ->withSum(['listings as total_revenue' => function($query) {
        $query->where('listing_status', 'sold')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id');
    }], 'vehicles.price')
    ->get()
    ->map(function($dealer) use ($maxRevenue) {
        $dealer->performance_score = $this->calculatePerformanceScore(
            $dealer->sold_listings_count,
            $dealer->listings_count,
            $dealer->total_revenue ?? 0,
            0, // Response time removed
            $maxRevenue
        );
        $dealer->conversion_rate = $dealer->listings_count > 0 
            ? ($dealer->sold_listings_count / $dealer->listings_count) * 100 
            : 0;
        return $dealer;
    })
    ->sortByDesc('performance_score')
    ->take(10);
}

private function getInquiryStatistics($startDate, $endDate)
{
    return (object)[
        'total_inquiries' => Inquiry::whereBetween('created_at', [$startDate, $endDate])->count(),
        'unique_users' => Inquiry::whereBetween('created_at', [$startDate, $endDate])
            ->distinct('user_id')
            ->count(),
        'conversion_rate' => $this->calculateConversionRate($startDate, $endDate),
        'quick_responses' => 0 // Simplified since we don't have response time tracking
    ];
}

private function getPeakActivityHours($startDate, $endDate)
{
    return Inquiry::whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw('HOUR(created_at) as hour, COUNT(*) as total_inquiries')
        ->groupBy('hour')
        ->orderBy('total_inquiries', 'desc')
        ->get();
}



private function getInventoryValue($startDate, $endDate)
{
    return [
        'current_value' => Vehicle::sum('price'),
        'value_by_category' => DB::table('vehicles')
            ->join('categories', 'vehicles.make', '=', 'categories.category_name')
            ->select(
                'categories.category_name',
                DB::raw('SUM(price) as total_value'),
                DB::raw('COUNT(*) as count'),
                DB::raw('AVG(price) as average_price')
            )
            ->groupBy('categories.category_name')
            ->get()
    ];
}

private function getSalesTrends($startDate, $endDate)
{
    return Listing::where('listings.listing_status', 'sold')  // Specify table name
        ->whereBetween('listings.updated_at', [$startDate, $endDate])  // Specify table name
        ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
        ->selectRaw('
            DATE(listings.updated_at) as date, 
            COUNT(*) as total_sales, 
            SUM(vehicles.price) as total_revenue, 
            AVG(vehicles.price) as average_price
        ')
        ->groupBy('date')
        ->orderBy('date')
        ->get();
}

private function calculateConversionRate($startDate, $endDate)
{
    $inquiries = Inquiry::whereBetween('created_at', [$startDate, $endDate])->count();
    $sales = Listing::where('listing_status', 'sold')
        ->whereBetween('updated_at', [$startDate, $endDate])
        ->count();
    
    return $inquiries > 0 ? ($sales / $inquiries) * 100 : 0;
}

private function calculatePerformanceScore($soldListings, $totalListings, $revenue, $responseTime, $maxRevenue)
{
    // Sales performance (50% weight)
    $salesScore = $totalListings > 0 ? ($soldListings / $totalListings) * 100 : 0;
    
    // Revenue performance (50% weight)
    $revenueScore = ($revenue / $maxRevenue) * 100;
    
    // Calculate weighted score
    return round(($salesScore * 0.5) + ($revenueScore * 0.5));
}
// You might also need these migration files for the new tables:

// create_listing_views_table.php

// create_favorites_table.php


// create_listing_shares_table.php


// create_listing_interactions_table.php

}