<?php
namespace App\Http\Controllers\Admin;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $dateRange = $request->input('date_range', 'month');
        $startDate = $this->getStartDate($dateRange);

        // 1. Overall Platform Statistics
        $platformStats = $this->getPlatformStatistics($startDate);
        
        // 2. Sales & Listing Analytics
        $salesAnalytics = $this->getSalesAnalytics($startDate);
        
        // 3. Dealer Performance Metrics
        $dealerMetrics = $this->getDealerPerformanceMetrics($startDate);
        
        // 4. Vehicle Analytics
        $vehicleAnalytics = $this->getVehicleAnalytics($startDate);
        
        // 5. Market Analysis
        $marketAnalysis = $this->getMarketAnalysis($startDate);
        
        // 6. Lead & Conversion Analytics
        $leadAnalytics = $this->getLeadAnalytics($startDate);
        
        // 7. Financial Metrics
        $financialMetrics = $this->getFinancialMetrics($startDate);
        
        // 8. Predictive Analytics
        $predictions = $this->getPredictiveAnalytics($salesAnalytics);

        return view('admin.dashboard.AIdashboard', compact(
            'platformStats',
            'salesAnalytics',
            'dealerMetrics',
            'vehicleAnalytics',
            'marketAnalysis',
            'leadAnalytics',
            'financialMetrics',
            'predictions'
        ));
    }
public function getMetricIcon($key)
{
    $icons = [
        'dealers' => 'users',
        'active_listings' => 'list',
        'total_sales' => 'shopping-cart',
        'total_revenue' => 'dollar-sign',
        'total_inquiries' => 'envelope',
        'conversion_rate' => 'chart-line',
        'average_response_time' => 'clock'
    ];
    
    return $icons[$key] ?? 'chart-bar';
}
private function getPlatformStatistics($startDate)
{
    return [
        'total_stats' => [
            'dealers' => User::where('role', 'dealer')->count(),
            'active_listings' => Listing::where('listing_status', 'active')->count(),
            'total_sales' => Listing::where('listing_status', 'sold')->count(),
            'total_revenue' => Listing::where('listing_status', 'sold')
                ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                ->sum('vehicles.price'),
            'total_inquiries' => Inquiry::count(),
            'conversion_rate' => $this->calculateConversionRate(),
            'average_response_time' => $this->calculateAverageResponseTime()
        ],
        'period_stats' => [
            'new_dealers' => User::where('role', 'dealer')
                ->where('created_at', '>=', $startDate)
                ->count(),
            'new_listings' => Listing::where('created_at', '>=', $startDate)->count(),
            'period_sales' => Listing::where('listing_status', 'sold')
                ->where('listings.updated_at', '>=', $startDate)
                ->count(),
            'period_revenue' => Listing::where('listing_status', 'sold')
                ->where('listings.updated_at', '>=', $startDate)
                ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                ->sum('vehicles.price'),
            'period_inquiries' => Inquiry::where('created_at', '>=', $startDate)->count()
        ],
        'growth_rates' => $this->calculateGrowthRates($startDate),
    ];
}

private function calculateRevenueGrowth($startDate, $previousPeriod)
{
    try {
        $currentRevenue = Listing::where('listing_status', 'sold')
            ->where('updated_at', '>=', $startDate)
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->sum('vehicles.price');

        $previousRevenue = Listing::where('listing_status', 'sold')
            ->where('updated_at', '>=', $previousPeriod)
            ->where('updated_at', '<', $startDate)
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->sum('vehicles.price');

        return $this->calculatePercentageChange($previousRevenue, $currentRevenue);
    } catch (\Exception $e) {
        \Log::error('Revenue Growth Calculation Error: ' . $e->getMessage());
        return 0;
    }
}

// Other potentially missing methods:






private function getDailyActiveDealers()
{
    try {
        return User::where('role', 'dealer')
            ->whereHas('listings', function($query) {
                $query->where('updated_at', '>=', now()->subDay());
            })
            ->count();
    } catch (\Exception $e) {
        \Log::error('Daily Active Dealers Calculation Error: ' . $e->getMessage());
        return 0;
    }
}








private function calculateDealerChurnRate($startDate)
{
    try {
        $totalDealers = User::where('role', 'dealer')
            ->where('created_at', '<', $startDate)
            ->count();

        $inactiveDealers = User::where('role', 'dealer')
            ->where('created_at', '<', $startDate)
            ->whereDoesntHave('listings', function($query) use ($startDate) {
                $query->where('updated_at', '>=', $startDate);
            })
            ->count();

        return $totalDealers > 0 ? 
            round(($inactiveDealers / $totalDealers) * 100, 2) : 0;
    } catch (\Exception $e) {
        \Log::error('Dealer Churn Rate Error: ' . $e->getMessage());
        return 0;
    }
}






    private function getSalesAnalytics($startDate)
    {
        return [
            'trends' => Listing::selectRaw('
                DATE(created_at) as date,
                COUNT(*) as new_listings,
                SUM(CASE WHEN listing_status = "sold" THEN 1 ELSE 0 END) as sales,
                AVG(vehicles.price) as avg_price,
                COUNT(DISTINCT user_id) as active_dealers
            ')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.created_at', '>=', $startDate)
            ->groupBy('date')
            ->orderBy('date')
            ->get(),

            'performance_metrics' => [
                'average_time_to_sell' => $this->calculateAverageTimeToSell($startDate),
                'popular_price_ranges' => $this->getPopularPriceRanges($startDate),
                'best_selling_categories' => $this->getBestSellingCategories($startDate),
                'sales_by_location' => $this->getSalesByLocation($startDate)
            ],

            'comparison_metrics' => $this->getComparisonMetrics($startDate)
        ];
    }



    private function getVehicleAnalytics($startDate)
    {
        return [
            'inventory_metrics' => [
                'total_inventory' => Vehicle::count(),
                'active_listings' => Listing::where('listing_status', 'active')->count(),
                'avg_inventory_age' => $this->calculateAverageInventoryAge(),
                'inventory_turnover' => $this->calculateInventoryTurnover($startDate)
            ],
            'category_analysis' => $this->getCategoryAnalysis($startDate),
            'price_analysis' => $this->getPriceAnalysis($startDate),
            'popular_features' => $this->getPopularFeatures($startDate),
            'market_demand' => $this->getMarketDemandMetrics($startDate)
        ];
    }

    private function getMarketAnalysis($startDate)
    {
        return [
            'market_share' => $this->calculateMarketShare($startDate),
            'competitor_analysis' => $this->getCompetitorAnalysis($startDate),
            'price_trends' => $this->getPriceTrends($startDate),
            'demand_supply_metrics' => $this->getDemandSupplyMetrics($startDate),
            //'regional_performance' => $this->getRegionalPerformance($startDate)
        ];
    }
    private function calculateOverallConversionRate($startDate)
    {
        try {
            $inquiries = Inquiry::where('created_at', '>=', $startDate)->count();
            $sales = Listing::where('listing_status', 'sold')
                ->where('updated_at', '>=', $startDate)
                ->count();
    
            return $inquiries > 0 ? round(($sales / $inquiries) * 100, 2) : 0;
        } catch (\Exception $e) {
            \Log::error('Overall Conversion Rate Error: ' . $e->getMessage());
            return 0;
        }
    }

    private function getDealerConversionRates($startDate)
{
    try {
        return DB::table('users')
            ->where('users.role', 'dealer')
            ->leftJoin('listings', 'users.id', '=', 'listings.user_id')
            ->leftJoin('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'users.id',
                'users.name',
                DB::raw('COUNT(DISTINCT inquiries.id) as total_inquiries'),
                DB::raw('COUNT(DISTINCT CASE WHEN listings.listing_status = "sold" THEN listings.id END) as total_sales')
            )
            ->groupBy('users.id', 'users.name')
            ->get()
            ->map(function($dealer) {
                return [
                    'dealer_id' => $dealer->id,
                    'dealer_name' => $dealer->name,
                    'total_inquiries' => $dealer->total_inquiries,
                    'total_sales' => $dealer->total_sales,
                    'conversion_rate' => $dealer->total_inquiries > 0 
                        ? round(($dealer->total_sales / $dealer->total_inquiries) * 100, 2) 
                        : 0
                ];
            });
    } catch (\Exception $e) {
        \Log::error('Dealer Conversion Rates Error: ' . $e->getMessage());
        return collect([]);
    }
}
private function getPriceRangeConversion($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->leftJoin('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                DB::raw('
                    CASE 
                        WHEN vehicles.price <= 100000 THEN "0-100K"
                        WHEN vehicles.price <= 250000 THEN "100K-250K"
                        WHEN vehicles.price <= 500000 THEN "250K-500K"
                        WHEN vehicles.price <= 1000000 THEN "500K-1M"
                        ELSE "1M+"
                    END as price_range
                '),
                DB::raw('COUNT(DISTINCT inquiries.id) as total_inquiries'),
                DB::raw('COUNT(DISTINCT CASE WHEN listings.listing_status = "sold" THEN listings.id END) as total_sales')
            )
            ->groupBy('price_range')
            ->orderBy('price_range')
            ->get()
            ->map(function($range) {
                return [
                    'price_range' => $range->price_range,
                    'total_inquiries' => $range->total_inquiries,
                    'total_sales' => $range->total_sales,
                    'conversion_rate' => $range->total_inquiries > 0 
                        ? round(($range->total_sales / $range->total_inquiries) * 100, 2) 
                        : 0
                ];
            });
    } catch (\Exception $e) {
        \Log::error('Price Range Conversion Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getResponseDistribution($startDate)
{
    try {
        return DB::table('inquiries')
            ->where('inquiries.created_at', '>=', $startDate)
            ->select(
                DB::raw('
                    CASE 
                        WHEN TIMESTAMPDIFF(MINUTE, created_at, updated_at) <= 30 THEN "Under 30min"
                        WHEN TIMESTAMPDIFF(MINUTE, created_at, updated_at) <= 60 THEN "30-60min"
                        WHEN TIMESTAMPDIFF(MINUTE, created_at, updated_at) <= 180 THEN "1-3hrs"
                        WHEN TIMESTAMPDIFF(MINUTE, created_at, updated_at) <= 360 THEN "3-6hrs"
                        WHEN TIMESTAMPDIFF(MINUTE, created_at, updated_at) <= 1440 THEN "6-24hrs"
                        ELSE "Over 24hrs"
                    END as response_time_range
                '),
                DB::raw('COUNT(*) as total_inquiries'),
                DB::raw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_response_time')
            )
            ->whereNotNull('updated_at')
            ->groupBy('response_time_range')
            ->orderBy(DB::raw('MIN(TIMESTAMPDIFF(MINUTE, created_at, updated_at))'))
            ->get()
            ->map(function($range) {
                return [
                    'range' => $range->response_time_range,
                    'count' => $range->total_inquiries,
                    'average_time' => round($range->avg_response_time, 2),
                    'percentage' => 0 // Will be calculated below
                ];
            })
            ->pipe(function($collection) {
                $total = $collection->sum('count');
                return $collection->map(function($item) use ($total) {
                    $item['percentage'] = $total > 0 ? 
                        round(($item['count'] / $total) * 100, 2) : 0;
                    return $item;
                });
            });
    } catch (\Exception $e) {
        \Log::error('Response Distribution Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getInquirySources($startDate)
{
    try {
        return DB::table('inquiries')
            ->where('created_at', '>=', $startDate)
            ->select(
                'source',
                DB::raw('COUNT(*) as total_inquiries'),
                DB::raw('COUNT(DISTINCT listing_id) as unique_listings'),
                DB::raw('COUNT(DISTINCT user_id) as unique_users')
            )
            ->groupBy('source')
            ->orderBy('total_inquiries', 'desc')
            ->get()
            ->map(function($source) {
                return [
                    'source' => $source->source ?? 'Direct',
                    'total_inquiries' => $source->total_inquiries,
                    'unique_listings' => $source->unique_listings,
                    'unique_users' => $source->unique_users,
                    'percentage' => 0 // Will be calculated below
                ];
            })
            ->pipe(function($collection) {
                $total = $collection->sum('total_inquiries');
                return $collection->map(function($item) use ($total) {
                    $item['percentage'] = $total > 0 ? 
                        round(($item['total_inquiries'] / $total) * 100, 2) : 0;
                    return $item;
                });
            });
    } catch (\Exception $e) {
        \Log::error('Inquiry Sources Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getInquiryTypes($startDate)
{
    try {
        return DB::table('inquiries')
            ->where('created_at', '>=', $startDate)
            ->select(
                'type', // Make sure you have a 'type' column in inquiries table
                DB::raw('COUNT(*) as total'),
                DB::raw('COUNT(DISTINCT user_id) as unique_users'),
                DB::raw('COUNT(DISTINCT listing_id) as unique_listings'),
                DB::raw('AVG(CASE WHEN updated_at IS NOT NULL 
                    THEN TIMESTAMPDIFF(MINUTE, created_at, updated_at) 
                    ELSE NULL END) as avg_response_time')
            )
            ->groupBy('type')
            ->orderBy('total', 'desc')
            ->get()
            ->map(function($type) {
                return [
                    'type' => $type->type ?? 'General',
                    'total' => $type->total,
                    'unique_users' => $type->unique_users,
                    'unique_listings' => $type->unique_listings,
                    'avg_response_time' => round($type->avg_response_time ?? 0, 2),
                    'percentage' => 0 // Will be calculated below
                ];
            })
            ->pipe(function($collection) {
                $total = $collection->sum('total');
                return $collection->map(function($item) use ($total) {
                    $item['percentage'] = $total > 0 ? 
                        round(($item['total'] / $total) * 100, 2) : 0;
                    return $item;
                });
            });
    } catch (\Exception $e) {
        \Log::error('Inquiry Types Error: ' . $e->getMessage());
        return collect([]);
    }
}
    private function getLeadAnalytics($startDate)
    {
        return [
            'conversion_metrics' => [
                'overall_conversion_rate' => $this->calculateOverallConversionRate($startDate),
                'dealer_conversion_rates' => $this->getDealerConversionRates($startDate),
                'price_range_conversion' => $this->getPriceRangeConversion($startDate)
            ],
            'response_metrics' => [
                'avg_response_time' => $this->calculateAverageResponseTime(),
                'response_distribution' => $this->getResponseDistribution($startDate)
            ],
            'inquiry_analysis' => [
                'inquiry_sources' => $this->getInquirySources($startDate),
                'inquiry_types' => $this->getInquiryTypes($startDate)
            ],
            'customer_behavior' => $this->getCustomerBehaviorMetrics($startDate)
        ];
    }

    private function getFinancialMetrics($startDate)
    {
        return [
            'revenue_metrics' => [
                'total_revenue' => $this->calculateTotalRevenue($startDate),
                'revenue_by_category' => $this->getRevenueByCategory($startDate),
                'revenue_trends' => $this->getRevenueTrends($startDate)
            ],
            'transaction_metrics' => [
                'avg_transaction_value' => $this->calculateAverageTransactionValue($startDate),
                'transaction_distribution' => $this->getTransactionDistribution($startDate)
            ],
            'profitability_metrics' => [
                'margin_analysis' => $this->getMarginAnalysis($startDate),
                'profit_trends' => $this->getProfitTrends($startDate)
            ]
        ];
    }

    private function getPredictiveAnalytics($salesData)
    {
        return [
            'sales_forecast' => $this->generateSalesForecast($salesData),
            'price_predictions' => $this->generatePricePredictions(),
            'inventory_predictions' => $this->generateInventoryPredictions(),
            'market_trends' => $this->predictMarketTrends(),
            'seasonal_forecasts' => $this->generateSeasonalForecasts()
        ];
    }

        
        private function calculateConversionRate()
        {
            $totalInquiries = Inquiry::count();
            $totalSales = Listing::where('listing_status', 'sold')->count();
            
            return $totalInquiries > 0 ? 
                round(($totalSales / $totalInquiries) * 100, 2) : 0;
        }
    
        private function calculateAverageResponseTime()
        {
            return Inquiry::whereNotNull('updated_at')
                ->selectRaw('AVG(TIMESTAMPDIFF(MINUTE, created_at, updated_at)) as avg_time')
                ->value('avg_time');
        }
    
        private function calculateGrowthRates($startDate)
        {
            $previousPeriod = Carbon::parse($startDate)->subDays(
                Carbon::parse($startDate)->diffInDays(now())
            );
    
            return [
                'dealer_growth' => $this->calculatePercentageChange(
                    User::where('role', 'dealer')
                        ->where('created_at', '<', $startDate)
                        ->count(),
                    User::where('role', 'dealer')
                        ->where('created_at', '>=', $startDate)
                        ->count()
                ),
                'listing_growth' => $this->calculatePercentageChange(
                    Listing::where('created_at', '>=', $previousPeriod)
                        ->where('created_at', '<', $startDate)
                        ->count(),
                    Listing::where('created_at', '>=', $startDate)
                        ->count()
                ),
                'revenue_growth' => $this->calculateRevenueGrowth($startDate, $previousPeriod),
                'inquiry_growth' => $this->calculatePercentageChange(
                    Inquiry::where('created_at', '>=', $previousPeriod)
                        ->where('created_at', '<', $startDate)
                        ->count(),
                    Inquiry::where('created_at', '>=', $startDate)
                        ->count()
                )
            ];
        }
    
        private function calculatePlatformHealth()
        {
            return [
                'system_metrics' => [
                    'average_response_time' => $this->getSystemResponseTime(),
                    'error_rate' => $this->getSystemErrorRate(),
                    'uptime_percentage' => $this->calculateUptime()
                ],
                'user_engagement' => [
                    'daily_active_dealers' => $this->getDailyActiveDealers(),
                    'average_session_duration' => $this->getAverageSessionDuration(),
                    'feature_usage' => $this->getFeatureUsageStats()
                ],
                'data_quality' => [
                    'listing_completion_rate' => $this->calculateListingCompletionRate(),
                    'image_quality_score' => $this->calculateImageQualityScore(),
                    'description_quality_score' => $this->calculateDescriptionQualityScore()
                ]
            ];
        }
    
        // Helper Methods for Sales Analytics
        private function calculateAverageTimeToSell($startDate)
        {
            return Listing::where('listing_status', 'sold')
                ->where('updated_at', '>=', $startDate)
                ->selectRaw('AVG(DATEDIFF(updated_at, created_at)) as avg_days')
                ->value('avg_days');
        }
    
        private function getPopularPriceRanges($startDate)
        {
            return DB::select("
                WITH price_ranges AS (
                    SELECT 
                        CASE 
                            WHEN price <= 100000 THEN '0-100k'
                            WHEN price <= 250000 THEN '100k-250k'
                            WHEN price <= 500000 THEN '250k-500k'
                            ELSE '500k+'
                        END as `range`,
                        COUNT(*) as total,
                        SUM(CASE WHEN l.listing_status = 'sold' THEN 1 ELSE 0 END) as sold
                    FROM vehicles v
                    JOIN listings l ON v.vehicle_id = l.vehicle_id
                    WHERE l.created_at >= ?
                    GROUP BY 
                        CASE 
                            WHEN price <= 100000 THEN '0-100k'
                            WHEN price <= 250000 THEN '100k-250k'
                            WHEN price <= 500000 THEN '250k-500k'
                            ELSE '500k+'
                        END
                )
                SELECT 
                    `range`,
                    total,
                    sold,
                    ROUND((sold * 100.0 / total), 2) as conversion_rate
                FROM price_ranges
                ORDER BY total DESC
            ", [$startDate]);
        }
      
        private function getDealerPerformanceMetrics($startDate)
        {
            return [
                'top_performers' => User::where('role', 'dealer')
                    ->with(['listings', 'listings.vehicle']) // Eager load relationships
                    ->withCount([
                        'listings as total_listings',
                        'listings as active_listings' => function($query) {
                            $query->where('listing_status', 'active');
                        },
                        'listings as sold_listings' => function($query) use ($startDate) {
                            $query->where('listing_status', 'sold')
                                ->where('listings.updated_at', '>=', $startDate);
                        }
                    ])
                    ->withSum(['listings as total_revenue' => function($query) use ($startDate) {
                        $query->where('listing_status', 'sold')
                            ->where('listings.updated_at', '>=', $startDate)
                            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id');
                    }], 'vehicles.price')
                    ->take(10)
                    ->get()
            ];
        }

        private function calculateAverageInventoryAge()
{
    try {
        return Listing::where('listing_status', 'active')
            ->selectRaw('AVG(DATEDIFF(NOW(), created_at)) as avg_age')
            ->value('avg_age') ?? 0;
    } catch (\Exception $e) {
        \Log::error('Average Inventory Age Error: ' . $e->getMessage());
        return 0;
    }
}

private function calculateInventoryTurnover($startDate)
{
    try {
        $soldItems = Listing::where('listing_status', 'sold')
            ->where('updated_at', '>=', $startDate)
            ->count();
        
        $averageInventory = Listing::where('created_at', '>=', $startDate)
            ->count() / 2;

        return $averageInventory > 0 ? round($soldItems / $averageInventory, 2) : 0;
    } catch (\Exception $e) {
        \Log::error('Inventory Turnover Error: ' . $e->getMessage());
        return 0;
    }
}

private function getCategoryAnalysis($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'vehicles.make as category',
                DB::raw('COUNT(*) as total_listings'),
                DB::raw('SUM(CASE WHEN listings.listing_status = "sold" THEN 1 ELSE 0 END) as sold_count'),
                DB::raw('AVG(vehicles.price) as average_price'),
                DB::raw('AVG(DATEDIFF(NOW(), listings.created_at)) as avg_age')
            )
            ->groupBy('vehicles.make')
            ->orderBy('total_listings', 'desc')
            ->get();
    } catch (\Exception $e) {
        \Log::error('Category Analysis Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getPriceAnalysis($startDate)
{
    try {
        return [
            'price_ranges' => $this->getPopularPriceRanges($startDate),
            'average_price' => Listing::join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                ->where('listings.created_at', '>=', $startDate)
                ->avg('vehicles.price') ?? 0,
            'price_trends' => $this->getPriceTrends($startDate)
        ];
    } catch (\Exception $e) {
        \Log::error('Price Analysis Error: ' . $e->getMessage());
        return [
            'price_ranges' => collect([]),
            'average_price' => 0,
            'price_trends' => collect([])
        ];
    }
}

private function getPopularFeatures($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('vehicle_features', 'vehicles.vehicle_id', '=', 'vehicle_features.vehicle_id')
            ->join('features', 'vehicle_features.feature_id', '=', 'features.id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'features.name',
                DB::raw('COUNT(*) as frequency'),
                DB::raw('SUM(CASE WHEN listings.listing_status = "sold" THEN 1 ELSE 0 END) as sold_count')
            )
            ->groupBy('features.name')
            ->orderBy('frequency', 'desc')
            ->limit(10)
            ->get();
    } catch (\Exception $e) {
        \Log::error('Popular Features Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getMarketDemandMetrics($startDate)
{
    try {
        return [
            'high_demand_categories' => $this->getHighDemandCategories($startDate),
            'demand_by_price_range' => $this->getDemandByPriceRange($startDate),
            'seasonal_trends' => $this->getSeasonalTrends($startDate)
        ];
    } catch (\Exception $e) {
        \Log::error('Market Demand Metrics Error: ' . $e->getMessage());
        return [
            'high_demand_categories' => collect([]),
            'demand_by_price_range' => collect([]),
            'seasonal_trends' => collect([])
        ];
    }
}

private function getHighDemandCategories($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'vehicles.make as category',
                DB::raw('COUNT(DISTINCT listings.id) as total_listings'),
                DB::raw('COUNT(DISTINCT inquiries.id) as total_inquiries'),
                DB::raw('COUNT(DISTINCT inquiries.id) / COUNT(DISTINCT listings.id) as inquiry_ratio')
            )
            ->groupBy('vehicles.make')
            ->orderBy('inquiry_ratio', 'desc')
            ->limit(10)
            ->get();
    } catch (\Exception $e) {
        \Log::error('High Demand Categories Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getDemandByPriceRange($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(DB::raw('
                CASE 
                    WHEN vehicles.price <= 100000 THEN "0-100K"
                    WHEN vehicles.price <= 250000 THEN "100K-250K"
                    WHEN vehicles.price <= 500000 THEN "250K-500K"
                    WHEN vehicles.price <= 1000000 THEN "500K-1M"
                    ELSE "1M+"
                END as price_range
            '))
            ->selectRaw('COUNT(DISTINCT listings.id) as total_listings')
            ->selectRaw('COUNT(DISTINCT inquiries.id) as total_inquiries')
            ->selectRaw('COUNT(DISTINCT inquiries.id) / COUNT(DISTINCT listings.id) as inquiry_ratio')
            ->groupBy('price_range')
            ->orderBy('inquiry_ratio', 'desc')
            ->get();
    } catch (\Exception $e) {
        \Log::error('Demand By Price Range Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getSeasonalTrends($startDate)
{
    try {
        return DB::table('listings')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                DB::raw('MONTH(inquiries.created_at) as month'),
                DB::raw('COUNT(*) as inquiry_count'),
                DB::raw('COUNT(DISTINCT listings.id) as listing_count'),
                DB::raw('COUNT(*) / COUNT(DISTINCT listings.id) as inquiry_per_listing')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    } catch (\Exception $e) {
        \Log::error('Seasonal Trends Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getCompetitorAnalysis($startDate)
{
    try {
        return [
            'market_share' => $this->calculateMarketShare($startDate),
            'price_comparison' => $this->getPriceComparison($startDate),
            'listing_quality' => $this->getListingQualityMetrics($startDate)
        ];
    } catch (\Exception $e) {
        \Log::error('Competitor Analysis Error: ' . $e->getMessage());
        return [
            'market_share' => collect([]),
            'price_comparison' => collect([]),
            'listing_quality' => collect([])
        ];
    }
}

private function getPriceComparison($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('users', 'listings.user_id', '=', 'users.id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'vehicles.make',
                'vehicles.model',
                DB::raw('AVG(vehicles.price) as avg_price'),
                DB::raw('MIN(vehicles.price) as min_price'),
                DB::raw('MAX(vehicles.price) as max_price')
            )
            ->groupBy('vehicles.make', 'vehicles.model')
            ->orderBy('avg_price', 'desc')
            ->get();
    } catch (\Exception $e) {
        \Log::error('Price Comparison Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getListingQualityMetrics($startDate)
{
    try {
        return DB::table('listings')
            ->join('users', 'listings.user_id', '=', 'users.id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'users.id as dealer_id',
                'users.name as dealer_name',
                DB::raw('AVG(listings.image_count) as avg_images'),
                DB::raw('AVG(LENGTH(listings.description)) as avg_description_length'),
                DB::raw('COUNT(*) as total_listings')
            )
            ->groupBy('users.id', 'users.name')
            ->orderBy('avg_images', 'desc')
            ->get();
    } catch (\Exception $e) {
        \Log::error('Listing Quality Metrics Error: ' . $e->getMessage());
        return collect([]);
    }
}

private function getPriceTrends($startDate)
{
    try {
        // Get weekly price trends
        $weeklyTrends = DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE_FORMAT(listings.created_at, "%Y-%u") as week'),
                DB::raw('AVG(vehicles.price) as average_price'),
                DB::raw('COUNT(*) as total_listings'),
                DB::raw('SUM(CASE WHEN listing_status = "sold" THEN 1 ELSE 0 END) as sold_listings'),
                DB::raw('MIN(vehicles.price) as min_price'),
                DB::raw('MAX(vehicles.price) as max_price')
            )
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Get price trends by category
        $categoryTrends = DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'vehicles.make as category',
                DB::raw('AVG(vehicles.price) as average_price'),
                DB::raw('COUNT(*) as total_listings'),
                DB::raw('MIN(vehicles.price) as min_price'),
                DB::raw('MAX(vehicles.price) as max_price')
            )
            ->groupBy('vehicles.make')
            ->orderBy('average_price', 'desc')
            ->get();

        // Calculate price volatility
        $priceVolatility = $this->calculatePriceVolatility($weeklyTrends);

        // Get price trends by condition
        $conditionTrends = DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'vehicles.condition',
                DB::raw('AVG(vehicles.price) as average_price'),
                DB::raw('COUNT(*) as total_listings'),
                DB::raw('MIN(vehicles.price) as min_price'),
                DB::raw('MAX(vehicles.price) as max_price')
            )
            ->groupBy('vehicles.condition')
            ->orderBy('average_price', 'desc')
            ->get();

        return [
            'weekly_trends' => $weeklyTrends->map(function($trend) {
                return [
                    'week' => $trend->week,
                    'average_price' => round($trend->average_price, 2),
                    'total_listings' => $trend->total_listings,
                    'sold_listings' => $trend->sold_listings,
                    'min_price' => round($trend->min_price, 2),
                    'max_price' => round($trend->max_price, 2),
                    'price_range' => round($trend->max_price - $trend->min_price, 2)
                ];
            }),
            'category_trends' => $categoryTrends->map(function($trend) {
                return [
                    'category' => $trend->category,
                    'average_price' => round($trend->average_price, 2),
                    'total_listings' => $trend->total_listings,
                    'min_price' => round($trend->min_price, 2),
                    'max_price' => round($trend->max_price, 2),
                    'price_range' => round($trend->max_price - $trend->min_price, 2)
                ];
            }),
            'condition_trends' => $conditionTrends->map(function($trend) {
                return [
                    'condition' => $trend->condition ?? 'Unknown',
                    'average_price' => round($trend->average_price, 2),
                    'total_listings' => $trend->total_listings,
                    'min_price' => round($trend->min_price, 2),
                    'max_price' => round($trend->max_price, 2)
                ];
            }),
            'price_volatility' => $priceVolatility,
            'summary' => [
                'overall_trend' => $this->calculateOverallTrend($weeklyTrends),
                'price_momentum' => $this->calculatePriceMomentum($weeklyTrends),
                'trend_strength' => $this->calculateTrendStrength($weeklyTrends)
            ]
        ];
    } catch (\Exception $e) {
        \Log::error('Price Trends Error: ' . $e->getMessage());
        return [
            'weekly_trends' => collect([]),
            'category_trends' => collect([]),
            'condition_trends' => collect([]),
            'price_volatility' => 0,
            'summary' => [
                'overall_trend' => 'neutral',
                'price_momentum' => 0,
                'trend_strength' => 0
            ]
        ];
    }
}

private function calculatePriceVolatility($weeklyTrends)
{
    try {
        if ($weeklyTrends->isEmpty()) {
            return 0;
        }

        $prices = $weeklyTrends->pluck('average_price')->filter();
        if ($prices->isEmpty()) {
            return 0;
        }

        $mean = $prices->avg();
        $variance = $prices->map(function($price) use ($mean) {
            return pow($price - $mean, 2);
        })->avg();

        return round(sqrt($variance) / $mean * 100, 2); // Return as percentage
    } catch (\Exception $e) {
        \Log::error('Price Volatility Calculation Error: ' . $e->getMessage());
        return 0;
    }
}

private function calculateOverallTrend($weeklyTrends)
{
    try {
        if ($weeklyTrends->isEmpty()) {
            return 'neutral';
        }

        $firstPrice = $weeklyTrends->first()->average_price;
        $lastPrice = $weeklyTrends->last()->average_price;
        $percentageChange = (($lastPrice - $firstPrice) / $firstPrice) * 100;

        if ($percentageChange > 5) {
            return 'upward';
        } elseif ($percentageChange < -5) {
            return 'downward';
        } else {
            return 'neutral';
        }
    } catch (\Exception $e) {
        \Log::error('Overall Trend Calculation Error: ' . $e->getMessage());
        return 'neutral';
    }
}

private function calculatePriceMomentum($weeklyTrends)
{
    try {
        if ($weeklyTrends->count() < 2) {
            return 0;
        }

        $recentWeeks = $weeklyTrends->take(-4); // Last 4 weeks
        $prices = $recentWeeks->pluck('average_price');
        
        $momentum = 0;
        for ($i = 1; $i < $prices->count(); $i++) {
            $momentum += ($prices[$i] - $prices[$i-1]) / $prices[$i-1] * 100;
        }

        return round($momentum / ($prices->count() - 1), 2);
    } catch (\Exception $e) {
        \Log::error('Price Momentum Calculation Error: ' . $e->getMessage());
        return 0;
    }
}

private function calculateTrendStrength($weeklyTrends)
{
    try {
        if ($weeklyTrends->count() < 2) {
            return 0;
        }

        $prices = $weeklyTrends->pluck('average_price');
        $totalChange = abs($prices->last() - $prices->first());
        $averagePrice = $prices->avg();

        return round(($totalChange / $averagePrice) * 100, 2);
    } catch (\Exception $e) {
        \Log::error('Trend Strength Calculation Error: ' . $e->getMessage());
        return 0;
    }
}

private function getDemandSupplyMetrics($startDate)
{
    try {
        // Get supply metrics
        $supply = DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                'vehicles.make',
                DB::raw('COUNT(*) as total_listings'),
                DB::raw('COUNT(CASE WHEN listing_status = "active" THEN 1 END) as active_listings'),
                DB::raw('AVG(vehicles.price) as average_price')
            )
            ->groupBy('vehicles.make')
            ->get();

        // Get demand metrics (based on inquiries)
        $demand = DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('inquiries.created_at', '>=', $startDate)
            ->select(
                'vehicles.make',
                DB::raw('COUNT(DISTINCT inquiries.id) as total_inquiries'),
                DB::raw('COUNT(DISTINCT listings.id) as inquired_listings'),
                DB::raw('COUNT(DISTINCT inquiries.id) / COUNT(DISTINCT listings.id) as inquiry_per_listing')
            )
            ->groupBy('vehicles.make')
            ->get();

        // Calculate demand-supply ratio and market metrics
        $marketMetrics = $supply->map(function($supplyItem) use ($demand) {
            $demandItem = $demand->firstWhere('make', $supplyItem->make);
            
            $totalInquiries = $demandItem->total_inquiries ?? 0;
            $activeListings = $supplyItem->active_listings;
            
            return [
                'category' => $supplyItem->make,
                'supply_metrics' => [
                    'total_listings' => $supplyItem->total_listings,
                    'active_listings' => $activeListings,
                    'average_price' => round($supplyItem->average_price, 2)
                ],
                'demand_metrics' => [
                    'total_inquiries' => $totalInquiries,
                    'inquired_listings' => $demandItem->inquired_listings ?? 0,
                    'inquiry_per_listing' => round($demandItem->inquiry_per_listing ?? 0, 2)
                ],
                'market_metrics' => [
                    'demand_supply_ratio' => $activeListings > 0 ? 
                        round($totalInquiries / $activeListings, 2) : 0,
                    'market_status' => $this->getMarketStatus(
                        $totalInquiries, 
                        $activeListings
                    )
                ]
            ];
        });

        // Get overall market summary
        $marketSummary = [
            'total_supply' => $supply->sum('total_listings'),
            'total_demand' => $demand->sum('total_inquiries'),
            'overall_ratio' => $supply->sum('active_listings') > 0 ? 
                round($demand->sum('total_inquiries') / $supply->sum('active_listings'), 2) : 0,
            'market_temperature' => $this->calculateMarketTemperature($startDate),
            'price_pressure' => $this->calculatePricePressure($startDate)
        ];

        // Get time-based trends
        $trends = $this->getDemandSupplyTrends($startDate);

        return [
            'category_metrics' => $marketMetrics,
            'market_summary' => $marketSummary,
            'trends' => $trends
        ];

    } catch (\Exception $e) {
        \Log::error('Demand Supply Metrics Error: ' . $e->getMessage());
        return [
            'category_metrics' => collect([]),
            'market_summary' => [
                'total_supply' => 0,
                'total_demand' => 0,
                'overall_ratio' => 0,
                'market_temperature' => 'neutral',
                'price_pressure' => 'stable'
            ],
            'trends' => collect([])
        ];
    }
}

private function getMarketStatus($demand, $supply)
{
    if ($supply == 0) return 'insufficient_data';
    
    $ratio = $demand / $supply;
    
    if ($ratio > 2) return 'high_demand';
    if ($ratio > 1) return 'seller_market';
    if ($ratio > 0.5) return 'balanced';
    return 'buyer_market';
}

private function calculateMarketTemperature($startDate)
{
    try {
        // Calculate the change in demand-supply ratio over time
        $currentPeriod = DB::table('listings')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('inquiries.created_at', '>=', $startDate)
            ->select(
                DB::raw('COUNT(DISTINCT inquiries.id) as demand'),
                DB::raw('COUNT(DISTINCT listings.id) as supply')
            )
            ->first();

        $previousPeriod = DB::table('listings')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->whereBetween('inquiries.created_at', [
                Carbon::parse($startDate)->subDays(30),
                $startDate
            ])
            ->select(
                DB::raw('COUNT(DISTINCT inquiries.id) as demand'),
                DB::raw('COUNT(DISTINCT listings.id) as supply')
            )
            ->first();

        $currentRatio = $currentPeriod->supply > 0 ? 
            $currentPeriod->demand / $currentPeriod->supply : 0;
        $previousRatio = $previousPeriod->supply > 0 ? 
            $previousPeriod->demand / $previousPeriod->supply : 0;

        $change = $previousRatio > 0 ? 
            (($currentRatio - $previousRatio) / $previousRatio) * 100 : 0;

        if ($change > 10) return 'hot';
        if ($change > 5) return 'warm';
        if ($change < -10) return 'cold';
        if ($change < -5) return 'cool';
        return 'neutral';

    } catch (\Exception $e) {
        \Log::error('Market Temperature Calculation Error: ' . $e->getMessage());
        return 'neutral';
    }
}

private function calculatePricePressure($startDate)
{
    try {
        $priceChanges = DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->where('listings.updated_at', '>=', $startDate)
            ->select(
                DB::raw('AVG(CASE 
                    WHEN price_changes.new_price > price_changes.old_price THEN 1
                    WHEN price_changes.new_price < price_changes.old_price THEN -1
                    ELSE 0 
                END) as price_direction')
            )
            ->leftJoin('price_changes', 'listings.id', '=', 'price_changes.listing_id')
            ->value('price_direction') ?? 0;

        if ($priceChanges > 0.1) return 'upward';
        if ($priceChanges < -0.1) return 'downward';
        return 'stable';

    } catch (\Exception $e) {
        \Log::error('Price Pressure Calculation Error: ' . $e->getMessage());
        return 'stable';
    }
}

private function getDemandSupplyTrends($startDate)
{
    try {
        return DB::table('listings')
            ->join('inquiries', 'listings.id', '=', 'inquiries.listing_id')
            ->where('listings.created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE_FORMAT(listings.created_at, "%Y-%m-%d") as date'),
                DB::raw('COUNT(DISTINCT listings.id) as new_listings'),
                DB::raw('COUNT(DISTINCT inquiries.id) as new_inquiries'),
                DB::raw('COUNT(DISTINCT CASE WHEN listings.listing_status = "sold" THEN listings.id END) as sales')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

    } catch (\Exception $e) {
        \Log::error('Demand Supply Trends Error: ' . $e->getMessage());
        return collect([]);
    }
}


        public function filterMetrics(Request $request)
        {
            $validated = $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after:start_date',
                'dealer_id' => 'nullable|exists:users,id',
                'period' => 'required|in:daily,weekly,monthly'
            ]);
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $dealerId = $request->dealer_id;
            $period = $request->period;
        
            $metrics = $this->getDealerMetrics($startDate, $endDate, $dealerId);
            
            return response()->json([
                'success' => true,
                'metrics' => $metrics
            ]);
        }

        private function getSalesByLocation($startDate)
{
    try {
        return DB::table('listings')
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->join('users', 'listings.user_id', '=', 'users.id')
            ->where('listings.listing_status', 'sold')
            ->where('listings.updated_at', '>=', $startDate)
            ->select(
                'users.location',
                DB::raw('COUNT(*) as total_sales'),
                DB::raw('SUM(vehicles.price) as total_revenue'),
                DB::raw('AVG(vehicles.price) as average_price')
            )
            ->groupBy('users.location')
            ->orderBy('total_sales', 'desc')
            ->get()
            ->map(function($location) {
                return [
                    'location' => $location->location ?? 'Unknown',
                    'total_sales' => $location->total_sales,
                    'total_revenue' => round($location->total_revenue, 2),
                    'average_price' => round($location->average_price, 2),
                    'percentage' => 0 // Will be calculated below
                ];
            })
            ->each(function($location) use (&$totalSales) {
                $totalSales = collect($location)->sum('total_sales');
                $location['percentage'] = $totalSales > 0 
                    ? round(($location['total_sales'] / $totalSales) * 100, 2) 
                    : 0;
            });
    } catch (\Exception $e) {
        \Log::error('Sales By Location Error: ' . $e->getMessage());
        return collect([]);
    }
}




private function getComparisonMetrics($startDate)
{
    try {
        $previousPeriod = Carbon::parse($startDate)->subDays(
            Carbon::parse($startDate)->diffInDays(now())
        );

        $currentPeriodMetrics = $this->getPeriodMetrics($startDate, now());
        $previousPeriodMetrics = $this->getPeriodMetrics($previousPeriod, $startDate);

        return [
            'sales_growth' => $this->calculatePercentageChange(
                $previousPeriodMetrics['total_sales'],
                $currentPeriodMetrics['total_sales']
            ),
            'revenue_growth' => $this->calculatePercentageChange(
                $previousPeriodMetrics['total_revenue'],
                $currentPeriodMetrics['total_revenue']
            ),
            'avg_price_change' => $this->calculatePercentageChange(
                $previousPeriodMetrics['average_price'],
                $currentPeriodMetrics['average_price']
            ),
            'conversion_rate_change' => $this->calculatePercentageChange(
                $previousPeriodMetrics['conversion_rate'],
                $currentPeriodMetrics['conversion_rate']
            )
        ];
    } catch (\Exception $e) {
        \Log::error('Comparison Metrics Error: ' . $e->getMessage());
        return [
            'sales_growth' => 0,
            'revenue_growth' => 0,
            'avg_price_change' => 0,
            'conversion_rate_change' => 0
        ];
    }
}

private function getPeriodMetrics($startDate, $endDate)
{
    try {
        $listings = Listing::whereBetween('created_at', [$startDate, $endDate])
            ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
            ->select(
                DB::raw('COUNT(*) as total_listings'),
                DB::raw('SUM(CASE WHEN listing_status = "sold" THEN 1 ELSE 0 END) as total_sales'),
                DB::raw('SUM(CASE WHEN listing_status = "sold" THEN vehicles.price ELSE 0 END) as total_revenue'),
                DB::raw('AVG(CASE WHEN listing_status = "sold" THEN vehicles.price ELSE NULL END) as average_price')
            )
            ->first();

        return [
            'total_listings' => $listings->total_listings ?? 0,
            'total_sales' => $listings->total_sales ?? 0,
            'total_revenue' => $listings->total_revenue ?? 0,
            'average_price' => $listings->average_price ?? 0,
            'conversion_rate' => $listings->total_listings > 0 
                ? ($listings->total_sales / $listings->total_listings) * 100 
                : 0
        ];
    } catch (\Exception $e) {
        \Log::error('Period Metrics Error: ' . $e->getMessage());
        return [
            'total_listings' => 0,
            'total_sales' => 0,
            'total_revenue' => 0,
            'average_price' => 0,
            'conversion_rate' => 0
        ];
    }
}
        private function getBestSellingCategories($startDate)
        {
            return Listing::where('listing_status', 'sold')
                ->where('listings.updated_at', '>=', $startDate)
                ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                ->join('categories', 'vehicles.make', '=', 'categories.category_name')
                ->select(
                    'categories.category_name',
                    DB::raw('COUNT(*) as total_sales'),
                    DB::raw('AVG(vehicles.price) as avg_price'),
                    DB::raw('AVG(DATEDIFF(listings.updated_at, listings.created_at)) as avg_days_to_sell')
                )
                ->groupBy('categories.category_name')
                ->orderBy('total_sales', 'desc')
                ->get();
        }
    
        // Helper Methods for Dealer Analytics
        private function getDealerGrowthMetrics($startDate)
        {
            $previousPeriod = Carbon::parse($startDate)->subDays(
                Carbon::parse($startDate)->diffInDays(now())
            );
    
            return [
                'new_dealers' => User::where('role', 'dealer')
                    ->where('created_at', '>=', $startDate)
                    ->count(),
                'churn_rate' => $this->calculateDealerChurnRate($startDate),
                'retention_rate' => $this->calculateDealerRetentionRate($startDate),
                'activation_rate' => $this->calculateDealerActivationRate($startDate)
            ];
        }
    
        private function getDealerPerformanceDistribution()
        {
            return User::where('role', 'dealer')
                ->withCount(['listings as total_listings'])
                ->withCount(['listings as sold_listings' => function($query) {
                    $query->where('listing_status', 'sold');
                }])
                ->get()
                ->groupBy(function($dealer) {
                    if ($dealer->sold_listings == 0) return 'inactive';
                    if ($dealer->sold_listings < 5) return 'low';
                    if ($dealer->sold_listings < 15) return 'medium';
                    return 'high';
                });
        }
    
        // Helper Methods for Market Analysis
        private function calculateMarketShare($startDate)
        {
            $totalListings = Listing::where('created_at', '>=', $startDate)->count();
            
            return Listing::where('created_at', '>=', $startDate)
                ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                ->join('categories', 'vehicles.make', '=', 'categories.category_name')
                ->select(
                    'categories.category_name',
                    DB::raw('COUNT(*) as total'),
                    DB::raw('ROUND((COUNT(*) / ' . $totalListings . '.0) * 100, 2) as market_share')
                )
                ->groupBy('categories.category_name')
                ->orderBy('total', 'desc')
                ->get();
        }
    
        // Helper Methods for Predictive Analytics
        private function generateSalesForecast($salesData)
        {
            // Initialize arrays for the linear regression
            $dates = [];
            $sales = [];
            
            foreach ($salesData['trends'] as $index => $data) {
                $dates[] = $index;
                $sales[] = $data->sales;
            }
    
            // Calculate linear regression coefficients
            $n = count($dates);
            $sumX = array_sum($dates);
            $sumY = array_sum($sales);
            $sumXY = 0;
            $sumXX = 0;
    
            for ($i = 0; $i < $n; $i++) {
                $sumXY += $dates[$i] * $sales[$i];
                $sumXX += $dates[$i] * $dates[$i];
            }
    
            $slope = ($n * $sumXY - $sumX * $sumY) / ($n * $sumXX - $sumX * $sumX);
            $intercept = ($sumY - $slope * $sumX) / $n;
    
            // Generate predictions for next 30 days
            $predictions = [];
            for ($i = 1; $i <= 30; $i++) {
                $predictedSales = max(0, round($slope * ($n + $i) + $intercept));
                $predictions[] = [
                    'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                    'predicted_sales' => $predictedSales,
                ];
            }
    
            return [
                'predictions' => $predictions,
                'trend' => [
                    'slope' => $slope,
                    'intercept' => $intercept
                ],
            ];
        }
        private function calculateTotalRevenue($startDate)
        {
            try {
                return Listing::where('listing_status', 'sold')
                    ->where('updated_at', '>=', $startDate)
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->sum('vehicles.price') ?? 0;
            } catch (\Exception $e) {
                \Log::error('Calculate Total Revenue Error: ' . $e->getMessage());
                return 0;
            }
        }
        
        private function getRevenueByCategory($startDate)
        {
            try {
                return DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->where('listings.listing_status', 'sold')
                    ->where('listings.updated_at', '>=', $startDate)
                    ->select(
                        'vehicles.make as category',
                        DB::raw('COUNT(*) as total_sales'),
                        DB::raw('SUM(vehicles.price) as total_revenue'),
                        DB::raw('AVG(vehicles.price) as average_price')
                    )
                    ->groupBy('vehicles.make')
                    ->orderBy('total_revenue', 'desc')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Revenue By Category Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function getRevenueTrends($startDate)
        {
            try {
                return DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->where('listings.listing_status', 'sold')
                    ->where('listings.updated_at', '>=', $startDate)
                    ->select(
                        DB::raw('DATE(listings.updated_at) as date'),
                        DB::raw('SUM(vehicles.price) as daily_revenue'),
                        DB::raw('COUNT(*) as daily_sales'),
                        DB::raw('AVG(vehicles.price) as average_price')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Revenue Trends Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function calculateAverageTransactionValue($startDate)
        {
            try {
                return Listing::where('listing_status', 'sold')
                    ->where('updated_at', '>=', $startDate)
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->avg('vehicles.price') ?? 0;
            } catch (\Exception $e) {
                \Log::error('Average Transaction Value Error: ' . $e->getMessage());
                return 0;
            }
        }
        
        private function getTransactionDistribution($startDate)
        {
            try {
                return DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->where('listings.listing_status', 'sold')
                    ->where('listings.updated_at', '>=', $startDate)
                    ->select(DB::raw('
                        CASE 
                            WHEN vehicles.price <= 100000 THEN "0-100K"
                            WHEN vehicles.price <= 250000 THEN "100K-250K"
                            WHEN vehicles.price <= 500000 THEN "250K-500K"
                            WHEN vehicles.price <= 1000000 THEN "500K-1M"
                            ELSE "1M+"
                        END as price_range'
                    ))
                    ->selectRaw('COUNT(*) as total_transactions')
                    ->selectRaw('SUM(vehicles.price) as total_revenue')
                    ->selectRaw('AVG(vehicles.price) as average_price')
                    ->groupBy('price_range')
                    ->orderBy('price_range')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Transaction Distribution Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function getMarginAnalysis($startDate)
        {
            try {
                return DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->where('listings.listing_status', 'sold')
                    ->where('listings.updated_at', '>=', $startDate)
                    ->select(
                        'vehicles.make as category',
                        DB::raw('AVG((vehicles.price - vehicles.cost_price) / vehicles.price * 100) as avg_margin'),
                        DB::raw('COUNT(*) as total_sales'),
                        DB::raw('SUM(vehicles.price - vehicles.cost_price) as total_profit')
                    )
                    ->groupBy('vehicles.make')
                    ->orderBy('avg_margin', 'desc')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Margin Analysis Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function getProfitTrends($startDate)
        {
            try {
                return DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->where('listings.listing_status', 'sold')
                    ->where('listings.updated_at', '>=', $startDate)
                    ->select(
                        DB::raw('DATE(listings.updated_at) as date'),
                        DB::raw('SUM(vehicles.price - vehicles.cost_price) as daily_profit'),
                        DB::raw('AVG((vehicles.price - vehicles.cost_price) / vehicles.price * 100) as avg_margin'),
                        DB::raw('COUNT(*) as total_sales')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
            } catch (\Exception $e) {
                \Log::error('Profit Trends Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function generatePricePredictions()
        {
            try {
                // Get historical price data
                $historicalPrices = DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->where('listing_status', 'sold')
                    ->select(
                        DB::raw('DATE(listings.updated_at) as date'),
                        DB::raw('AVG(vehicles.price) as average_price')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
        
                // Simple linear regression for prediction
                $dates = [];
                $prices = [];
                foreach ($historicalPrices as $index => $data) {
                    $dates[] = $index;
                    $prices[] = $data->average_price;
                }
        
                // Calculate trend
                $n = count($dates);
                if ($n < 2) return collect([]);
        
                $slope = $this->calculateTrendSlope($dates, $prices);
                $intercept = $this->calculateTrendIntercept($dates, $prices, $slope);
        
                // Generate predictions for next 30 days
                $predictions = [];
                for ($i = 1; $i <= 30; $i++) {
                    $predictedPrice = max(0, $slope * ($n + $i) + $intercept);
                    $predictions[] = [
                        'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                        'predicted_price' => round($predictedPrice, 2)
                    ];
                }
        
                return collect($predictions);
            } catch (\Exception $e) {
                \Log::error('Price Predictions Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function generateInventoryPredictions()
        {
            try {
                // Get historical inventory data
                $historicalInventory = DB::table('listings')
                    ->select(
                        DB::raw('DATE(created_at) as date'),
                        DB::raw('COUNT(*) as total_listings'),
                        DB::raw('SUM(CASE WHEN listing_status = "active" THEN 1 ELSE 0 END) as active_listings')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
        
                // Calculate average daily change
                $avgDailyChange = $historicalInventory->skip(1)
                    ->map(function($item, $key) use ($historicalInventory) {
                        $previous = $historicalInventory[$key];
                        return $item->active_listings - $previous->active_listings;
                    })
                    ->avg();
        
                // Generate predictions
                $lastInventory = $historicalInventory->last()->active_listings;
                $predictions = [];
        
                for ($i = 1; $i <= 30; $i++) {
                    $predicted = max(0, $lastInventory + ($avgDailyChange * $i));
                    $predictions[] = [
                        'date' => Carbon::now()->addDays($i)->format('Y-m-d'),
                        'predicted_inventory' => round($predicted)
                    ];
                }
        
                return collect($predictions);
            } catch (\Exception $e) {
                \Log::error('Inventory Predictions Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function predictMarketTrends()
        {
            try {
                // Get historical market data
                $historicalData = DB::table('listings')
                    ->join('vehicles', 'listings.vehicle_id', '=', 'vehicles.vehicle_id')
                    ->select(
                        DB::raw('DATE(listings.created_at) as date'),
                        DB::raw('COUNT(*) as total_listings'),
                        DB::raw('AVG(vehicles.price) as average_price'),
                        DB::raw('COUNT(DISTINCT vehicles.make) as unique_makes')
                    )
                    ->groupBy('date')
                    ->orderBy('date')
                    ->get();
        
                // Calculate trends
                $trends = [
                    'market_growth' => $this->calculateMarketGrowth($historicalData),
                    'price_trend' => $this->calculatePriceTrend($historicalData),
                    'market_diversity' => $this->calculateMarketDiversity($historicalData)
                ];
        
                return $trends;
            } catch (\Exception $e) {
                \Log::error('Market Trends Prediction Error: ' . $e->getMessage());
                return [
                    'market_growth' => 0,
                    'price_trend' => 'stable',
                    'market_diversity' => 0
                ];
            }
        }
        
        private function generateSeasonalForecasts()
        {
            try {
                // Get historical seasonal data
                $seasonalData = DB::table('listings')
                    ->select(
                        DB::raw('MONTH(created_at) as month'),
                        DB::raw('COUNT(*) as total_listings'),
                        DB::raw('SUM(CASE WHEN listing_status = "sold" THEN 1 ELSE 0 END) as total_sales')
                    )
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();
        
                // Calculate seasonal indices
                $yearlyAverage = $seasonalData->avg('total_sales');
                $seasonalIndices = $seasonalData->map(function($month) use ($yearlyAverage) {
                    return [
                        'month' => Carbon::create()->month($month->month)->format('F'),
                        'seasonal_index' => $yearlyAverage > 0 ? 
                            ($month->total_sales / $yearlyAverage) : 0,
                        'expected_volume' => round($month->total_sales * 
                            ($month->total_sales / $yearlyAverage))
                    ];
                });
        
                return $seasonalIndices;
            } catch (\Exception $e) {
                \Log::error('Seasonal Forecasts Error: ' . $e->getMessage());
                return collect([]);
            }
        }
        
        private function getCustomerBehaviorMetrics($startDate)
        {
            try {
                return [
                    'inquiry_patterns' => $this->getInquiryPatterns($startDate),
                    'viewing_times' => $this->getViewingTimes($startDate),
                    'response_rates' => $this->getResponseRates($startDate),
                    'engagement_metrics' => $this->getEngagementMetrics($startDate)
                ];
            } catch (\Exception $e) {
                \Log::error('Customer Behavior Metrics Error: ' . $e->getMessage());
                return [
                    'inquiry_patterns' => collect([]),
                    'viewing_times' => collect([]),
                    'response_rates' => collect([]),
                    'engagement_metrics' => collect([])
                ];
            }
        }
        
        // Helper methods for calculations
        private function calculateTrendSlope($x, $y)
        {
            $n = count($x);
            $sumX = array_sum($x);
            $sumY = array_sum($y);
            $sumXY = 0;
            $sumXX = 0;
        
            for ($i = 0; $i < $n; $i++) {
                $sumXY += ($x[$i] * $y[$i]);
                $sumXX += ($x[$i] * $x[$i]);
            }
        
            return ($n * $sumXY - $sumX * $sumY) / ($n * $sumXX - $sumX * $sumX);
        }
        
        private function calculateTrendIntercept($x, $y, $slope)
        {
            return (array_sum($y) - $slope * array_sum($x)) / count($x);
        }
        // Utility Methods
        private function calculatePercentageChange($old, $new)
        {
            if ($old == 0) return $new > 0 ? 100 : 0;
            return round((($new - $old) / $old) * 100, 2);
        }
    
        private function getStartDate($range)
        {
            switch ($range) {
                case 'week':
                    return Carbon::now()->subWeek();
                case 'month':
                    return Carbon::now()->subMonth();
                case 'quarter':
                    return Carbon::now()->subQuarter();
                case 'year':
                    return Carbon::now()->subYear();
                default:
                    return Carbon::now()->subMonth();
            }
        }
    
    
}