<?php
use function App\Helpers\getTurnoverClass;
use function App\Helpers\getPerformanceColor;


?>

@extends('layouts.admin')

@section('title', 'Dealer Metrics & Reports')

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet">
<style>
    .chart-container {
    min-height: 300px;
    position: relative;
    margin-bottom: 1rem;
}
    .metric-card {
        transition: transform 0.2s;
    }
    .metric-card:hover {
        
        transform: translateY(-5px);
    }
    .chart-container {
        min-height: 300px;
        margin-bottom: 1rem;
    }
    .performance-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }
    .trend-up { color: #28a745; }
    .trend-down { color: #dc3545; }
    .custom-tab {
        cursor: pointer;
        padding: 10px 15px;
        border-radius: 5px;
        transition: all 0.3s;
    }
    .custom-tab.active {
        background-color: #4e73df;
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dealer Metrics & Reports</h1>
        <div>
            <button class="btn btn-primary btn-sm" id="exportReport">
                <i class="fas fa-download fa-sm"></i> Export Report
            </button>
            <div class="btn-group btn-group-sm ml-2">
                <button type="button" class="btn btn-outline-primary active" data-period="daily">Daily</button>
                <button type="button" class="btn btn-outline-primary" data-period="weekly">Weekly</button>
                <button type="button" class="btn btn-outline-primary" data-period="monthly">Monthly</button>
                <button type="button" class="btn btn-outline-primary" data-period="yearly">Yearly</button>
            </div>
        </div>
    </div>

    <!-- Date Range Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="dateRange">Date Range:</label>
                        <input type="text" class="form-control" id="dateRange" name="dateRange">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-0">
                        <label for="dealerFilter">Filter by Dealer:</label>
                        <select class="form-control" id="dealerFilter">
                            <option value="">All Dealers</option>
                            @foreach($dealers as $dealer)
                                <option value="{{ $dealer->id }}">{{ $dealer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary btn-block" id="applyFilters">
                        <i class="fas fa-filter"></i> Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Overview Metrics -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2 metric-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Dealers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['total_dealers']) }}
                            </div>
                            <div class="text-xs mt-2 {{ $metrics['dealer_growth'] >= 0 ? 'trend-up' : 'trend-down' }}">
                                <i class="fas fa-{{ $metrics['dealer_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($metrics['dealer_growth']) }}% from last period
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-store fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2 metric-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Revenue
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                R{{ number_format($metrics['total_revenue'], 2) }}
                            </div>
                            <div class="text-xs mt-2 {{ $metrics['revenue_growth'] >= 0 ? 'trend-up' : 'trend-down' }}">
                                <i class="fas fa-{{ $metrics['revenue_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($metrics['revenue_growth']) }}% from last period
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2 metric-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Active Listings
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['active_listings']) }}
                            </div>
                            <div class="text-xs mt-2 {{ $metrics['listing_growth'] >= 0 ? 'trend-up' : 'trend-down' }}">
                                <i class="fas fa-{{ $metrics['listing_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($metrics['listing_growth']) }}% from last period
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2 metric-card">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Conversion Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['conversion_rate'], 1) }}%
                            </div>
                            <div class="text-xs mt-2 {{ $metrics['conversion_growth'] >= 0 ? 'trend-up' : 'trend-down' }}">
                                <i class="fas fa-{{ $metrics['conversion_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($metrics['conversion_growth']) }}% from last period
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percent fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row">
        <!-- Sales Performance Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Performance</h6>
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-outline-primary active" data-chart="sales">Sales</button>
                        <button type="button" class="btn btn-outline-primary" data-chart="revenue">Revenue</button>
                        <button type="button" class="btn btn-outline-primary" data-chart="listings">Listings</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Distribution Charts -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Market Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="distributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Performers Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Top Performing Dealers</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="topPerformersTable">
                    <thead>
                        <tr>
                            <th>Dealer</th>
                            <th>Total Sales</th>
                            <th>Revenue</th>
                            <th>Listings</th>
                            <th>Conversion Rate</th>
                            <th>Avg Response Time</th>
                            <th>Performance Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($metrics['top_performers'] as $dealer)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $dealer->logo_url }}" alt="Logo" class="rounded-circle mr-2" width="30">
                                    {{ $dealer->name }}
                                </div>
                            </td>
                            <td>{{ number_format($dealer->total_sales) }}</td>
                            <td>R{{ number_format($dealer->total_revenue, 2) }}</td>
                            <td>{{ number_format($dealer->active_listings) }}</td>
                            <td>{{ number_format($dealer->conversion_rate, 1) }}%</td>
                            <td>{{ $dealer->avg_response_time }} hrs</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-{{ getPerformanceColor($dealer->performance_score) }}" 
                                         role="progressbar" 
                                         style="width: {{ $dealer->performance_score }}%">
                                        {{ number_format($dealer->performance_score, 1) }}%
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detailed Analytics Tabs -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="nav nav-pills">
                <a class="nav-link active custom-tab" data-toggle="tab" href="#salesAnalysis">Sales Analysis</a>
                <a class="nav-link custom-tab" data-toggle="tab" href="#customerBehavior">Customer Behavior</a>
                <a class="nav-link custom-tab" data-toggle="tab" href="#inventoryMetrics">Inventory Metrics</a>
                <a class="nav-link custom-tab" data-toggle="tab" href="#dealerPerformance">Dealer Performance</a>
            </div>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <!-- Sales Analysis Tab -->
                <div class="tab-pane fade show active" id="salesAnalysis">
                    <!-- Sales Analysis Content -->'
                     <!-- Sales Analysis Tab -->
<div class="tab-pane fade show active" id="salesAnalysis">
    <div class="row">
        <!-- Daily Sales Trend -->
        <div class="col-xl-8 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daily Sales Trend</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                            <a class="dropdown-item" href="#" data-range="7">Last 7 Days</a>
                            <a class="dropdown-item" href="#" data-range="30">Last 30 Days</a>
                            <a class="dropdown-item" href="#" data-range="90">Last 90 Days</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="dailySalesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sales Summary -->
        <div class="col-xl-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Summary</h6>
                </div>
                <div class="card-body">
                    <div class="mt-4 text-center small">
                        @foreach($metrics['sales_analysis']['sales_by_category'] as $category)
                        <div class="mb-4">
                            <span class="mr-2">
                                <i class="fas fa-circle text-{{ $category['color'] }}"></i> {{ $category['name'] }}
                            </span>
                            <h4 class="mb-0">{{ number_format($category['total']) }}</h4>
                            <small class="text-muted">{{ $category['percentage'] }}% of total sales</small>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Average Sale Value -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Average Sale Value</h6>
                </div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                R{{ number_format($metrics['sales_analysis']['average_sale_value'], 2) }}
                            </div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Per Vehicle
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peak Sales Periods -->
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peak Sales Periods</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Period</th>
                                    <th>Sales</th>
                                    <th>Revenue</th>
                                    <th>Trend</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($metrics['sales_analysis']['peak_sales_periods'] as $period)
                                <tr>
                                    <td>{{ $period['period'] }}</td>
                                    <td>{{ number_format($period['sales']) }}</td>
                                    <td>R{{ number_format($period['revenue'], 2) }}</td>
                                    <td>
                                        <span class="text-{{ $period['trend'] > 0 ? 'success' : 'danger' }}">
                                            <i class="fas fa-arrow-{{ $period['trend'] > 0 ? 'up' : 'down' }}"></i>
                                            {{ abs($period['trend']) }}%
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>

                <!-- Customer Behavior Tab -->
                <div class="tab-pane fade" id="customerBehavior">
                    <!-- Customer Behavior Content -->
<div class="tab-pane fade" id="customerBehavior">
    <!-- Inquiry Overview Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Inquiries
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['customer_behavior']['inquiry_stats']->total_inquiries) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Conversion Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['customer_behavior']['inquiry_stats']->conversion_rate, 1) }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percent fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Quick Response Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format(($metrics['customer_behavior']['inquiry_stats']->quick_responses / 
                                   $metrics['customer_behavior']['inquiry_stats']->total_inquiries) * 100, 1) }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Unique Customers
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['customer_behavior']['inquiry_stats']->unique_users) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Conversion Funnel & Peak Hours Row -->
    <div class="row">
        <!-- Conversion Funnel -->
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Journey Funnel</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="conversionFunnelChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Peak Activity Hours -->
        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Peak Activity Hours</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="peakHoursChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Engagement Metrics Row -->
<!-- Replace the existing engagement metrics section with this -->
<div class="row">
    <div class="col-12 mb-4">
        <div class="card shadow h-100">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Engagement Metrics</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    @if(isset($metrics['customer_behavior']['engagement_metrics']))
                        <div class="col-md-3 mb-4">
                            <div class="text-center">
                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($metrics['customer_behavior']['engagement_metrics']['total_interactions']) }}
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Interactions
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="text-center">
                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($metrics['customer_behavior']['engagement_metrics']['return_visitor_rate'], 1) }}%
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Return Visitor Rate
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="text-center">
                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($metrics['customer_behavior']['engagement_metrics']['unique_users']) }}
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Unique Users
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <div class="text-center">
                                <div class="h4 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($metrics['customer_behavior']['engagement_metrics']['conversion_rate'], 1) }}%
                                </div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Conversion Rate
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-12">
                            <div class="alert alert-info">
                                Engagement metrics data is not available.
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>>
                </div>
                <div class="chart-container">
                    <canvas id="performanceChart"></canvas>
                </div>
                                <!-- Inventory Metrics Tab -->
                <div class="tab-pane fade" id="inventoryMetrics">
                    <!-- Inventory Metrics Content -->
                     <!-- Inventory Metrics Tab -->
<div class="tab-pane fade" id="inventoryMetrics">
    <!-- Inventory Overview Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Inventory
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['inventory_metrics']['overview']['total_inventory']) }}
                            </div>
                            <div class="text-xs mt-2 {{ $metrics['inventory_metrics']['overview']['inventory_growth'] >= 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-{{ $metrics['inventory_metrics']['overview']['inventory_growth'] >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($metrics['inventory_metrics']['overview']['inventory_growth']) }}% from last period
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-warehouse fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Value
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                R{{ number_format($metrics['inventory_metrics']['overview']['total_value'], 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Average Price
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                R{{ number_format($metrics['inventory_metrics']['overview']['average_price'], 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Turnover Rate
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($metrics['inventory_metrics']['stock_turnover']['turnover_rate'], 2) }}x
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-sync fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Aging Analysis -->
    <div class="row">
        <div class="col-xl-8 col-lg-7 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Inventory Aging Analysis</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="agingDropdown" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                            <a class="dropdown-item" href="#" data-aging-view="count">By Count</a>
                            <a class="dropdown-item" href="#" data-aging-view="value">By Value</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="inventoryAgingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aging Summary</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Age Range</th>
                                    <th>Count</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($metrics['inventory_metrics']['aging_analysis'] as $aging)
                                <tr>
                                    <td>{{ $aging->age_range }}</td>
                                    <td>{{ number_format($aging->count) }}</td>
                                    <td>R{{ number_format($aging->total_value, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Price Distribution and Popular Categories -->
    <div class="row">
        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Price Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="priceDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Popular Categories</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="popularCategoriesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stock Turnover Analysis -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Stock Turnover Analysis</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="turnoverTable">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Turnover Rate</th>
                                    <th>Avg Days to Sell</th>
                                    <th>Current Stock</th>
                                    <th>Stock Value</th>
                                    <th>Performance</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($metrics['inventory_metrics']['popular_categories'] as $category)
                                <tr>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ number_format($category->turnover_rate, 2) }}x</td>
                                    <td>{{ number_format($category->avg_days_to_sell) }} days</td>
                                    <td>{{ number_format($category->total) }}</td>
                                    <td>R{{ number_format($category->total_value, 2) }}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar {{ getTurnoverClass($category->turnover_rate) }}" 
                                                 role="progressbar" 
                                                 style="width: {{ getTurnoverPercentage($category->turnover_rate) }}%">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                </div>

                <!-- Dealer Performance Tab -->
                <div class="tab-pane fade" id="dealerPerformance">
                    <!-- Dealer Performance Content -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>

function updateInventoryCharts(metrics) {
    // Update Aging Chart
    agingChart.data.labels = metrics.aging_analysis.map(item => item.age_range);
    agingChart.data.datasets[0].data = metrics.aging_analysis.map(item => item.count);
    agingChart.update();

    // Update Price Distribution Chart
    priceChart.data.labels = metrics.price_distribution.ranges;
    priceChart.data.datasets[0].data = metrics.price_distribution.percentages;
    priceChart.update();

    // Update Categories Chart
    categoriesChart.data.labels = metrics.popular_categories.map(item => item.category_name);
    categoriesChart.data.datasets[0].data = metrics.popular_categories.map(item => item.total);
    categoriesChart.update();
}

function updateCustomerBehaviorCharts(metrics) {
    // Update Conversion Funnel
    conversionFunnelChart.data.datasets[0].data = [
        metrics.conversion_funnel.views,
        metrics.conversion_funnel.inquiries,
        metrics.conversion_funnel.sales
    ];
    conversionFunnelChart.update();

    // Update Peak Hours
    peakHoursChart.data.labels = metrics.peak_activity_hours.map(item => item.hour);
    peakHoursChart.data.datasets[0].data = metrics.peak_activity_hours.map(item => item.total_inquiries);
    peakHoursChart.update();
}
// Initialize charts and other functionality
$(document).ready(function() {
    // Initialize date range picker
    $('#dateRange').daterangepicker({
        startDate: moment().subtract(29, 'days'),
        endDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Initialize Performance Chart
    const performanceChart = new Chart(
        document.getElementById('performanceChart').getContext('2d'),
        {
            type: 'line',
            data: {
                labels: {!! json_encode($metrics['performance_data']['labels']) !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode($metrics['performance_data']['sales']) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );

    // Initialize Distribution Chart
    const distributionChart = new Chart(
        document.getElementById('distributionChart').getContext('2d'),
        {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($metrics['distribution_data']['labels']) !!},
                datasets: [{
                    data: {!! json_encode($metrics['distribution_data']['values']) !!},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(54, 162, 235, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    );

    // Initialize DataTable
    $('#topPerformersTable').DataTable({
        pageLength: 10,
        order: [[6, 'desc']], // Sort by performance score
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    // Handle Export
     // Handle Filter Changes
     $('#applyFilters').click(function() {
        const dateRange = $('#dateRange').val().split(' - ');
        const dealerId = $('#dealerFilter').val();
        const period = $('.btn-group [data-period].active').data('period');

        $.ajax({
            url: '{{ route("admin.dealers.filter-metrics") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                start_date: dateRange[0],
                end_date: dateRange[1],
                dealer_id: dealerId,
                period: period
            },
            success: function(response) {
                updateDashboard(response.metrics);
            },
            error: function(xhr) {
                alert('Error updating metrics');
            }
        });
    });

    // Handle Period Changes
    $('.btn-group [data-period]').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('#applyFilters').click();
    });

    // Handle Chart Type Changes
    $('.btn-group [data-chart]').click(function() {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        updateChartData($(this).data('chart'));
    });

    // Handle Export
    $('#exportReport').click(function() {
        const dateRange = $('#dateRange').val().split(' - ');
        const dealerId = $('#dealerFilter').val();
        
        window.location.href = `{{ route('admin.dealers.export-report') }}?` + 
            `start_date=${dateRange[0]}&end_date=${dateRange[1]}&dealer_id=${dealerId}`;
    });

    function updateChartData(chartType) {
        const datasets = {
            sales: performanceChart.data.datasets[0].data,
            revenue: {!! json_encode($metrics['performance_data']['revenue']) !!},
            listings: {!! json_encode($metrics['performance_data']['listings']) !!}
        };

        performanceChart.data.datasets[0].data = datasets[chartType];
        performanceChart.data.datasets[0].label = chartType.charAt(0).toUpperCase() + chartType.slice(1);
        performanceChart.update();
    }

    function updateDashboard(metrics) {
        // Update Overview Cards
        $('.total-dealers').text(metrics.total_dealers.toLocaleString());
        $('.total-revenue').text('R' + metrics.total_revenue.toLocaleString());
        $('.active-listings').text(metrics.active_listings.toLocaleString());
        $('.conversion-rate').text(metrics.conversion_rate.toFixed(1) + '%');

        // Update Charts
        updatePerformanceChart(metrics.performance_data);
        updateDistributionChart(metrics.distribution_data);
        updateInventoryCharts(metrics.inventory_metrics);
        updateCustomerBehaviorCharts(metrics.customer_behavior);

        // Update Tables
        updateTopPerformersTable(metrics.top_performers);
        updateTurnoverTable(metrics.inventory_metrics.popular_categories);
    }

    function updatePerformanceChart(data) {
        performanceChart.data.labels = data.labels;
        performanceChart.data.datasets[0].data = data.sales;
        performanceChart.update();
    }

    function updateDistributionChart(data) {
        distributionChart.data.labels = data.labels;
        distributionChart.data.datasets[0].data = data.values;
        distributionChart.update();
    }

    // Initialize all charts
    initializeCharts();
    initializeCustomerBehaviorCharts();
    initializeInventoryMetricsCharts();
});


function initializeCustomerBehaviorCharts() {
    // Conversion Funnel Chart
    const funnelCtx = document.getElementById('conversionFunnelChart').getContext('2d');
    new Chart(funnelCtx, {
        type: 'bar',
        data: {
            labels: ['Views', 'Inquiries', 'Sales'],
            datasets: [{
                label: 'Customer Journey',
                data: [
                    @json($metrics['customer_behavior']['conversion_funnel']['views']),
                    @json($metrics['customer_behavior']['conversion_funnel']['inquiries']),
                    @json($metrics['customer_behavior']['conversion_funnel']['sales'])
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(153, 102, 255, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Peak Hours Chart
    const peakHoursCtx = document.getElementById('peakHoursChart').getContext('2d');
    new Chart(peakHoursCtx, {
        type: 'line',
        data: {
            labels: @json($metrics['customer_behavior']['peak_activity_hours']->pluck('hour')),
            datasets: [{
                label: 'Inquiries by Hour',
                data: @json($metrics['customer_behavior']['peak_activity_hours']->pluck('total_inquiries')),
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // Initialize Response Times DataTable
    $('#responseTimesTable').DataTable({
        order: [[1, 'asc']],
        pageLength: 10
    });
}

// Add this to your existing scripts section
function initializeInventoryMetricsCharts() {
    // Inventory Aging Chart
    const agingCtx = document.getElementById('inventoryAgingChart').getContext('2d');
    const agingChart = new Chart(agingCtx, {
        type: 'bar',
        data: {
            labels: @json($metrics['inventory_metrics']['aging_analysis']->pluck('age_range')),
            datasets: [{
                label: 'Vehicle Count',
                data: @json($metrics['inventory_metrics']['aging_analysis']->pluck('count')),
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `Count: ${context.raw.toLocaleString()}`;
                        }
                    }
                }
            }
        }
    });

    // Price Distribution Chart
    const priceCtx = document.getElementById('priceDistributionChart').getContext('2d');
    const priceChart = new Chart(priceCtx, {
    type: 'doughnut',
    data: {
        labels: {!! json_encode($metrics['inventory_metrics']['price_distribution']['ranges']) !!},
        datasets: [{
            data: {!! json_encode($metrics['inventory_metrics']['price_distribution']['percentages']) !!},
            backgroundColor: [
                'rgba(75, 192, 192, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(255, 99, 132, 0.8)',
                'rgba(153, 102, 255, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `${context.label}: ${context.raw.toFixed(1)}%`;
                    }
                }
            }
        }
    }
});

    // Popular Categories Chart
    const categoriesCtx = document.getElementById('popularCategoriesChart').getContext('2d');
    const categoriesChart = new Chart(categoriesCtx, {
        type: 'bar',
        data: {
            labels: @json($metrics['inventory_metrics']['popular_categories']->pluck('category_name')),
            datasets: [{
                label: 'Vehicle Count',
                data: @json($metrics['inventory_metrics']['popular_categories']->pluck('total')),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Initialize DataTable for Turnover Analysis
    $('#turnoverTable').DataTable({
        pageLength: 10,
        order: [[1, 'desc']],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    // Handle Aging View Toggle
    $('[data-aging-view]').click(function(e) {
        e.preventDefault();
        const view = $(this).data('aging-view');
        updateAgingChart(view);
    });

    // Function to update Aging Chart view
    function updateAgingChart(view) {
        const data = view === 'value' ? 
            @json($metrics['inventory_metrics']['aging_analysis']->pluck('total_value')) :
            @json($metrics['inventory_metrics']['aging_analysis']->pluck('count'));
        
        agingChart.data.datasets[0].data = data;
        agingChart.data.datasets[0].label = view === 'value' ? 'Total Value' : 'Vehicle Count';
        
        if (view === 'value') {
            agingChart.options.scales.y.ticks.callback = function(value) {
                return 'R' + value.toLocaleString();
            };
        } else {
            agingChart.options.scales.y.ticks.callback = function(value) {
                return value.toLocaleString();
            };
        }
        
        agingChart.update();
    }
}

// Add chart initialization to document ready
$(document).ready(function() {
    initializeInventoryMetricsCharts();
});

function initializeConversionFunnelChart() {
    if (!document.getElementById('conversionFunnelChart')) {
        return;
    }

    const funnelData = @json($metrics['customer_behavior']['conversion_funnel'] ?? null);
    
    if (!funnelData) {
        return;
    }

    const ctx = document.getElementById('conversionFunnelChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Views', 'Inquiries', 'Sales'],
            datasets: [{
                label: 'Customer Journey',
                data: [
                    funnelData.views,
                    funnelData.inquiries,
                    funnelData.sales
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y.toLocaleString();
                        }
                    }
                }
            }
        }
    });
}

// Add this to your document ready function
$(document).ready(function() {
    // ... your existing code ...
    initializeConversionFunnelChart();
});

$(document).ready(function() {
    // Initialize all charts when the page loads
    initializeAllCharts();

    // Tab click handlers
    $('.nav-link').on('click', function(e) {
        e.preventDefault();
        const targetId = $(this).attr('href');
        
        // Remove active class from all tabs and add to clicked tab
        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        
        // Hide all tab content and show target content
        $('.tab-pane').removeClass('show active');
        $(targetId).addClass('show active');

        // Reinitialize charts for the active tab
        reinitializeChartsForTab(targetId);
    });
});

function initializeAllCharts() {
    // Performance Chart
    if (document.getElementById('performanceChart')) {
        const performanceCtx = document.getElementById('performanceChart').getContext('2d');
        window.performanceChart = new Chart(performanceCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode($metrics['performance_data']['labels']) !!},
                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode($metrics['performance_data']['sales']) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Daily Sales Chart
    if (document.getElementById('dailySalesChart')) {
        const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
        window.dailySalesChart = new Chart(dailySalesCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_column($metrics['sales_analysis']['daily_sales'], 'date')) !!},
                datasets: [{
                    label: 'Daily Sales',
                    data: {!! json_encode(array_column($metrics['sales_analysis']['daily_sales'], 'sales')) !!},
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Conversion Funnel Chart
    if (document.getElementById('conversionFunnelChart')) {
        const funnelCtx = document.getElementById('conversionFunnelChart').getContext('2d');
        window.conversionFunnelChart = new Chart(funnelCtx, {
            type: 'bar',
            data: {
                labels: ['Views', 'Inquiries', 'Sales'],
                datasets: [{
                    label: 'Customer Journey',
                    data: [
                        @json($metrics['customer_behavior']['conversion_funnel']['views'] ?? 0),
                        @json($metrics['customer_behavior']['conversion_funnel']['inquiries'] ?? 0),
                        @json($metrics['customer_behavior']['conversion_funnel']['sales'] ?? 0)
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Peak Hours Chart
    if (document.getElementById('peakHoursChart')) {
        const peakHoursCtx = document.getElementById('peakHoursChart').getContext('2d');
        window.peakHoursChart = new Chart(peakHoursCtx, {
            type: 'line',
            data: {
                labels: @json($metrics['customer_behavior']['peak_activity_hours']->pluck('hour')),
                datasets: [{
                    label: 'Activity by Hour',
                    data: @json($metrics['customer_behavior']['peak_activity_hours']->pluck('total_inquiries')),
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    // Inventory Aging Chart
    if (document.getElementById('inventoryAgingChart')) {
        const agingCtx = document.getElementById('inventoryAgingChart').getContext('2d');
        window.inventoryAgingChart = new Chart(agingCtx, {
            type: 'bar',
            data: {
                labels: @json($metrics['inventory_metrics']['aging_analysis']->pluck('age_range')),
                datasets: [{
                    label: 'Vehicle Count',
                    data: @json($metrics['inventory_metrics']['aging_analysis']->pluck('count')),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // Price Distribution Chart
    if (document.getElementById('priceDistributionChart')) {
        const priceCtx = document.getElementById('priceDistributionChart').getContext('2d');
        window.priceDistributionChart = new Chart(priceCtx, {
            type: 'doughnut',
            data: {
                labels: @json($metrics['inventory_metrics']['price_distribution']['ranges']),
                datasets: [{
                    data: @json($metrics['inventory_metrics']['price_distribution']['percentages']),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }
}

function reinitializeChartsForTab(tabId) {
    // Destroy existing charts in the tab to prevent duplicates
    if (window.currentTabCharts) {
        window.currentTabCharts.forEach(chart => chart.destroy());
    }
    window.currentTabCharts = [];

    switch(tabId) {
        case '#salesAnalysis':
            if (document.getElementById('dailySalesChart')) {
                const dailySalesCtx = document.getElementById('dailySalesChart').getContext('2d');
                window.currentTabCharts.push(new Chart(dailySalesCtx, {
                    type: 'line',
                    data: {
                        labels: {!! json_encode(array_column($metrics['sales_analysis']['daily_sales'], 'date')) !!},
                        datasets: [{
                            label: 'Daily Sales',
                            data: {!! json_encode(array_column($metrics['sales_analysis']['daily_sales'], 'sales')) !!},
                            borderColor: 'rgb(75, 192, 192)',
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                }));
            }
            break;

            case '#customerBehavior':
    // Initialize customer behavior charts
    if (document.getElementById('conversionFunnelChart')) {
        const funnelCtx = document.getElementById('conversionFunnelChart').getContext('2d');
        window.currentTabCharts.push(new Chart(funnelCtx, {
            type: 'bar',
            data: {
                labels: ['Views', 'Inquiries', 'Sales'],
                datasets: [{
                    label: 'Customer Journey',
                    data: [
                        @json($metrics['customer_behavior']['conversion_funnel']['views'] ?? 0),
                        @json($metrics['customer_behavior']['conversion_funnel']['inquiries'] ?? 0),
                        @json($metrics['customer_behavior']['conversion_funnel']['sales'] ?? 0)
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        }));
    }

    if (document.getElementById('peakHoursChart')) {
        const peakHoursCtx = document.getElementById('peakHoursChart').getContext('2d');
        window.currentTabCharts.push(new Chart(peakHoursCtx, {
            type: 'line',
            data: {
                labels: @json($metrics['customer_behavior']['peak_activity_hours']->pluck('hour')),
                datasets: [{
                    label: 'Inquiries by Hour',
                    data: @json($metrics['customer_behavior']['peak_activity_hours']->pluck('total_inquiries')),
                    borderColor: 'rgb(75, 192, 192)',
                    backgroundColor: 'rgba(75, 192, 192, 0.1)',
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y.toLocaleString()} inquiries`;
                            }
                        }
                    }
                }
            }
        }));
    }
    break;

case '#inventoryMetrics':
    if (document.getElementById('inventoryAgingChart')) {
        const agingCtx = document.getElementById('inventoryAgingChart').getContext('2d');
        window.currentTabCharts.push(new Chart(agingCtx, {
            type: 'bar',
            data: {
                labels: @json($metrics['inventory_metrics']['aging_analysis']->pluck('age_range')),
                datasets: [{
                    label: 'Vehicle Count',
                    data: @json($metrics['inventory_metrics']['aging_analysis']->pluck('count')),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString();
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.parsed.y.toLocaleString()} vehicles`;
                            }
                        }
                    }
                }
            }
        }));
    }

    if (document.getElementById('priceDistributionChart')) {
        const priceCtx = document.getElementById('priceDistributionChart').getContext('2d');
        window.currentTabCharts.push(new Chart(priceCtx, {
            type: 'doughnut',
            data: {
                labels: @json($metrics['inventory_metrics']['price_distribution']['ranges']),
                datasets: [{
                    data: @json($metrics['inventory_metrics']['price_distribution']['percentages']),
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(153, 102, 255, 0.8)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.parsed.toFixed(1)}%`;
                            }
                        }
                    }
                }
            }
        }));
    }
    break;
    }
}

// Add chart type switcher
$('.btn-group [data-chart]').click(function() {
    const chartType = $(this).data('chart');
    const datasets = {
        sales: {!! json_encode($metrics['performance_data']['sales']) !!},
        revenue: {!! json_encode($metrics['performance_data']['revenue']) !!},
        listings: {!! json_encode($metrics['performance_data']['listings']) !!}
    };

    if (window.performanceChart) {
        window.performanceChart.data.datasets[0].data = datasets[chartType];
        window.performanceChart.data.datasets[0].label = chartType.charAt(0).toUpperCase() + chartType.slice(1);
        window.performanceChart.update();
    }
});

function showLoading(chartId) {
    $(`#${chartId}`).parent().append('<div class="loading-overlay"><div class="spinner-border"></div></div>');
}

function hideLoading(chartId) {
    $(`#${chartId}`).parent().find('.loading-overlay').remove();
}

function safeJsonParse(data, defaultValue = []) {
    try {
        return JSON.parse(data) || defaultValue;
    } catch (e) {
        console.error('Error parsing JSON:', e);
        return defaultValue;
    }
}

// Add this at the beginning of your script
function getSafeData(data, path, defaultValue = []) {
    try {
        return _.get(data, path, defaultValue);
    } catch (e) {
        console.error(`Error getting data for path: ${path}`, e);
        return defaultValue;
    }
}

// Then use it in your chart data like this:
data: getSafeData(window.metrics, 'customer_behavior.conversion_funnel.views', 0)

// Add this function
function validateChartData(data) {
    return Array.isArray(data) ? data : [];
}

// Use it when setting chart data
data: validateChartData(@json($metrics['inventory_metrics']['aging_analysis']->pluck('count')))
</script>
@endsection
