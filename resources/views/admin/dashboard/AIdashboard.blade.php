<?php
use function App\Helpers\getMetricIcon;

?>
@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts/dist/apexcharts.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<style>
    .metric-card {
        transition: transform 0.2s;
    }
    .metric-card:hover {
        transform: translateY(-5px);
    }
    .chart-container {
        min-height: 300px;
    }
    .data-table {
        font-size: 0.9rem;
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <div class="d-flex">
            <div class="date-range-picker mr-2">
                <input type="text" class="form-control" id="dateRange">
            </div>
            <button class="btn btn-primary mr-2" id="refreshData">
                <i class="fas fa-sync"></i> Refresh
            </button>
            <button class="btn btn-success" id="exportData">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>

    <!-- Key Metrics Section -->
    <div class="row mb-4">
        @foreach($platformStats['total_stats'] as $key => $value)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2 metric-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ ucwords(str_replace('_', ' ', $key)) }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @if(str_contains($key, 'revenue'))
                                        R{{ number_format($value, 2) }}
                                    @elseif(str_contains($key, 'rate'))
                                        {{ number_format($value, 1) }}%
                                    @else
                                        {{ number_format($value) }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-{{\App\Helpers\DashboardHelper:: getMetricIcon($key) }} fa-2x text-gray-300"></i>            
                                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Sales Analytics Section -->
    <div class="row mb-4">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Trends</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="salesTrendDropdown" 
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                            <a class="dropdown-item" href="#" data-chart-period="daily">Daily</a>
                            <a class="dropdown-item" href="#" data-chart-period="weekly">Weekly</a>
                            <a class="dropdown-item" href="#" data-chart-period="monthly">Monthly</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Sales Distribution</h6>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="salesDistributionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Market Analysis Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Market Analysis</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="marketShareChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="priceTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dealer Performance Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Performing Dealers</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered data-table" id="dealersTable">
                            <thead>
                                <tr>
                                    <th>Dealer</th>
                                    <th>Total Listings</th>
                                    <th>Active Listings</th>
                                    <th>Sales</th>
                                    <th>Revenue</th>
                                    <th>Avg. Response Time</th>
                                    <th>Performance Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dealerMetrics['top_performers'] as $dealer)
                                    <tr>
                                        <td>{{ $dealer->name }}</td>
                                        <td>{{ number_format($dealer->total_listings) }}</td>
                                        <td>{{ number_format($dealer->active_listings) }}</td>
                                        <td>{{ number_format($dealer->sold_listings) }}</td>
                                        <td>R{{ number_format($dealer->total_revenue, 2) }}</td>
                                        <td>{{ $dealer->avg_response_time }} hrs</td>
                                        <td>
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" 
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
        </div>
    </div>

    <!-- Predictive Analytics Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Predictions & Forecasts</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="salesForecastChart"></canvas>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="marketTrendPredictionChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Part 1: Core Configuration and Utilities

// Constants
const CHART_COLORS = {
    primary: {
        main: 'rgb(75, 192, 192)',
        light: 'rgba(75, 192, 192, 0.2)',
        border: 'rgba(75, 192, 192, 1)'
    },
    secondary: {
        main: 'rgb(54, 162, 235)',
        light: 'rgba(54, 162, 235, 0.2)',
        border: 'rgba(54, 162, 235, 1)'
    },
    tertiary: {
        main: 'rgb(255, 206, 86)',
        light: 'rgba(255, 206, 86, 0.2)',
        border: 'rgba(255, 206, 86, 1)'
    },
    quaternary: {
        main: 'rgb(255, 99, 132)',
        light: 'rgba(255, 99, 132, 0.2)',
        border: 'rgba(255, 99, 132, 1)'
    }
};

const DEFAULT_CHART_OPTIONS = {
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
        legend: {
            position: 'top'
        },
        tooltip: {
            callbacks: {
                label: function(context) {
                    return context.parsed.y.toLocaleString();
                }
            }
        }
    }
};

// Utility Functions
const ChartUtils = {
    safeJsonParse(data, defaultValue = []) {
        try {
            return JSON.parse(data) || defaultValue;
        } catch (e) {
            console.error('Error parsing JSON:', e);
            return defaultValue;
        }
    },

    getSafeData(data, path, defaultValue = []) {
        try {
            return _.get(data, path, defaultValue);
        } catch (e) {
            console.error(`Error getting data for path: ${path}`, e);
            return defaultValue;
        }
    },

    validateChartData(data) {
        return Array.isArray(data) ? data : [];
    },

    showLoading(chartId) {
        $(`#${chartId}`).parent().append(`
            <div class="loading-overlay">
                <div class="spinner-border text-primary"></div>
            </div>
        `);
    },

    hideLoading(chartId) {
        $(`#${chartId}`).parent().find('.loading-overlay').remove();
    },

    formatCurrency(value) {
        return 'R' + value.toLocaleString();
    },

    formatPercentage(value) {
        return value.toFixed(1) + '%';
    },

    getDateRange() {
        return $('#dateRange').val().split(' - ');
    },

    getDealerId() {
        return $('#dealerFilter').val();
    },

    getPeriod() {
        return $('.btn-group [data-period].active').data('period');
    }
};

// Date Range Configuration
const DATE_RANGE_CONFIG = {
    startDate: moment().subtract(29, 'days'),
    endDate: moment(),
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), 
                      moment().subtract(1, 'month').endOf('month')]
    }
};

// DataTable Configuration
const DATATABLE_CONFIG = {
    pageLength: 10,
    order: [[6, 'desc']],
    dom: 'Bfrtip',
    buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    responsive: true,
    language: {
        search: "Search:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        infoEmpty: "Showing 0 to 0 of 0 entries",
        infoFiltered: "(filtered from _MAX_ total entries)"
    }
};


// Part 2: Chart Initialization Functions

const ChartInitializer = {
    // Performance Chart
    initializePerformanceChart() {
        if (!document.getElementById('performanceChart')) return;

        const ctx = document.getElementById('performanceChart').getContext('2d');
        window.performanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ChartUtils.getSafeData(window.metrics, 'performance_data.labels', []),
                datasets: [{
                    label: 'Sales',
                    data: ChartUtils.getSafeData(window.metrics, 'performance_data.sales', []),
                    borderColor: CHART_COLORS.primary.main,
                    backgroundColor: CHART_COLORS.primary.light,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                ...DEFAULT_CHART_OPTIONS,
                plugins: {
                    title: {
                        display: true,
                        text: 'Performance Overview'
                    }
                }
            }
        });
    },

    // Daily Sales Chart
    initializeDailySalesChart() {
        if (!document.getElementById('dailySalesChart')) return;

        const ctx = document.getElementById('dailySalesChart').getContext('2d');
        window.dailySalesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ChartUtils.getSafeData(window.metrics, 'sales_analysis.daily_sales', [])
                    .map(item => item.date),
                datasets: [{
                    label: 'Daily Sales',
                    data: ChartUtils.getSafeData(window.metrics, 'sales_analysis.daily_sales', [])
                        .map(item => item.sales),
                    borderColor: CHART_COLORS.secondary.main,
                    backgroundColor: CHART_COLORS.secondary.light,
                    tension: 0.1
                }]
            },
            options: DEFAULT_CHART_OPTIONS
        });
    },

    // Conversion Funnel Chart
    initializeConversionFunnelChart() {
        if (!document.getElementById('conversionFunnelChart')) return;

        const ctx = document.getElementById('conversionFunnelChart').getContext('2d');
        window.conversionFunnelChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Views', 'Inquiries', 'Sales'],
                datasets: [{
                    label: 'Customer Journey',
                    data: [
                        ChartUtils.getSafeData(window.metrics, 'customer_behavior.conversion_funnel.views', 0),
                        ChartUtils.getSafeData(window.metrics, 'customer_behavior.conversion_funnel.inquiries', 0),
                        ChartUtils.getSafeData(window.metrics, 'customer_behavior.conversion_funnel.sales', 0)
                    ],
                    backgroundColor: [
                        CHART_COLORS.primary.light,
                        CHART_COLORS.secondary.light,
                        CHART_COLORS.tertiary.light
                    ],
                    borderColor: [
                        CHART_COLORS.primary.border,
                        CHART_COLORS.secondary.border,
                        CHART_COLORS.tertiary.border
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...DEFAULT_CHART_OPTIONS,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Conversion Funnel'
                    }
                }
            }
        });
    },

    // Peak Hours Chart
    initializePeakHoursChart() {
        if (!document.getElementById('peakHoursChart')) return;

        const ctx = document.getElementById('peakHoursChart').getContext('2d');
        window.peakHoursChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ChartUtils.getSafeData(window.metrics, 'customer_behavior.peak_activity_hours', [])
                    .map(item => item.hour),
                datasets: [{
                    label: 'Activity by Hour',
                    data: ChartUtils.getSafeData(window.metrics, 'customer_behavior.peak_activity_hours', [])
                        .map(item => item.total_inquiries),
                    borderColor: CHART_COLORS.primary.main,
                    backgroundColor: CHART_COLORS.primary.light,
                    tension: 0.1,
                    fill: true
                }]
            },
            options: {
                ...DEFAULT_CHART_OPTIONS,
                plugins: {
                    title: {
                        display: true,
                        text: 'Peak Activity Hours'
                    }
                }
            }
        });
    },

    // Inventory Aging Chart
    initializeInventoryAgingChart() {
        if (!document.getElementById('inventoryAgingChart')) return;

        const ctx = document.getElementById('inventoryAgingChart').getContext('2d');
        window.inventoryAgingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ChartUtils.getSafeData(window.metrics, 'inventory_metrics.aging_analysis', [])
                    .map(item => item.age_range),
                datasets: [{
                    label: 'Vehicle Count',
                    data: ChartUtils.getSafeData(window.metrics, 'inventory_metrics.aging_analysis', [])
                        .map(item => item.count),
                    backgroundColor: Object.values(CHART_COLORS).map(color => color.light),
                    borderColor: Object.values(CHART_COLORS).map(color => color.border),
                    borderWidth: 1
                }]
            },
            options: {
                ...DEFAULT_CHART_OPTIONS,
                plugins: {
                    title: {
                        display: true,
                        text: 'Inventory Aging Analysis'
                    }
                }
            }
        });
    },

    // Initialize all charts
    initializeAllCharts() {
        this.initializePerformanceChart();
        this.initializeDailySalesChart();
        this.initializeConversionFunnelChart();
        this.initializePeakHoursChart();
        this.initializeInventoryAgingChart();
    }
};

// Part 3: Chart Update Functions

const ChartUpdater = {
    // Performance Chart Updates
    updatePerformanceChart(data) {
        if (!window.performanceChart || !data) return;

        ChartUtils.showLoading('performanceChart');
        
        try {
            window.performanceChart.data.labels = data.labels;
            window.performanceChart.data.datasets[0].data = data.sales;
            window.performanceChart.update('show');
        } catch (error) {
            console.error('Error updating performance chart:', error);
        } finally {
            ChartUtils.hideLoading('performanceChart');
        }
    },

    // Inventory Charts Updates
    updateInventoryCharts(metrics) {
        if (!metrics) return;

        this.updateAgingChart(metrics.aging_analysis);
        this.updatePriceDistributionChart(metrics.price_distribution);
        this.updateCategoriesChart(metrics.popular_categories);
    },

    updateAgingChart(agingData) {
        if (!window.inventoryAgingChart || !agingData) return;

        ChartUtils.showLoading('inventoryAgingChart');
        
        try {
            window.inventoryAgingChart.data.labels = agingData.map(item => item.age_range);
            window.inventoryAgingChart.data.datasets[0].data = agingData.map(item => item.count);
            window.inventoryAgingChart.update('show');
        } catch (error) {
            console.error('Error updating aging chart:', error);
        } finally {
            ChartUtils.hideLoading('inventoryAgingChart');
        }
    },

    updatePriceDistributionChart(priceData) {
        if (!window.priceDistributionChart || !priceData) return;

        ChartUtils.showLoading('priceDistributionChart');
        
        try {
            window.priceDistributionChart.data.labels = priceData.ranges;
            window.priceDistributionChart.data.datasets[0].data = priceData.percentages;
            window.priceDistributionChart.update('show');
        } catch (error) {
            console.error('Error updating price distribution chart:', error);
        } finally {
            ChartUtils.hideLoading('priceDistributionChart');
        }
    },

    updateCategoriesChart(categoriesData) {
        if (!window.categoriesChart || !categoriesData) return;

        ChartUtils.showLoading('popularCategoriesChart');
        
        try {
            window.categoriesChart.data.labels = categoriesData.map(item => item.category_name);
            window.categoriesChart.data.datasets[0].data = categoriesData.map(item => item.total);
            window.categoriesChart.update('show');
        } catch (error) {
            console.error('Error updating categories chart:', error);
        } finally {
            ChartUtils.hideLoading('popularCategoriesChart');
        }
    },

    // Customer Behavior Charts Updates
    updateCustomerBehaviorCharts(metrics) {
        if (!metrics) return;

        this.updateConversionFunnelChart(metrics.conversion_funnel);
        this.updatePeakHoursChart(metrics.peak_activity_hours);
    },

    updateConversionFunnelChart(funnelData) {
        if (!window.conversionFunnelChart || !funnelData) return;

        ChartUtils.showLoading('conversionFunnelChart');
        
        try {
            window.conversionFunnelChart.data.datasets[0].data = [
                funnelData.views,
                funnelData.inquiries,
                funnelData.sales
            ];
            window.conversionFunnelChart.update('show');
        } catch (error) {
            console.error('Error updating conversion funnel chart:', error);
        } finally {
            ChartUtils.hideLoading('conversionFunnelChart');
        }
    },

    updatePeakHoursChart(peakHoursData) {
        if (!window.peakHoursChart || !peakHoursData) return;

        ChartUtils.showLoading('peakHoursChart');
        
        try {
            window.peakHoursChart.data.labels = peakHoursData.map(item => item.hour);
            window.peakHoursChart.data.datasets[0].data = peakHoursData.map(item => item.total_inquiries);
            window.peakHoursChart.update('show');
        } catch (error) {
            console.error('Error updating peak hours chart:', error);
        } finally {
            ChartUtils.hideLoading('peakHoursChart');
        }
    },

    // Dashboard Overview Updates
    updateDashboardOverview(metrics) {
        if (!metrics) return;

        try {
            // Update overview cards
            $('.total-dealers').text(metrics.total_dealers.toLocaleString());
            $('.total-revenue').text(ChartUtils.formatCurrency(metrics.total_revenue));
            $('.active-listings').text(metrics.active_listings.toLocaleString());
            $('.conversion-rate').text(ChartUtils.formatPercentage(metrics.conversion_rate));

            // Update all charts
            this.updatePerformanceChart(metrics.performance_data);
            this.updateInventoryCharts(metrics.inventory_metrics);
            this.updateCustomerBehaviorCharts(metrics.customer_behavior);
        } catch (error) {
            console.error('Error updating dashboard overview:', error);
        }
    },

    // Chart Type Updates
    updateChartType(chartType) {
        if (!window.performanceChart) return;

        const datasets = {
            sales: ChartUtils.getSafeData(window.metrics, 'performance_data.sales', []),
            revenue: ChartUtils.getSafeData(window.metrics, 'performance_data.revenue', []),
            listings: ChartUtils.getSafeData(window.metrics, 'performance_data.listings', [])
        };

        try {
            window.performanceChart.data.datasets[0].data = datasets[chartType] || [];
            window.performanceChart.data.datasets[0].label = chartType.charAt(0).toUpperCase() + chartType.slice(1);
            window.performanceChart.update('show');
        } catch (error) {
            console.error('Error updating chart type:', error);
        }
    }
};

// Part 4: Event Handlers and Initialization

const EventHandlers = {
    // Filter Change Handler
    handleFilterChange() {
        const [startDate, endDate] = ChartUtils.getDateRange();
        const dealerId = ChartUtils.getDealerId();
        const period = ChartUtils.getPeriod();

        $.ajax({
            url: '{{ route("admin.dealers.filter-metrics") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                start_date: startDate,
                end_date: endDate,
                dealer_id: dealerId,
                period: period
            },
            beforeSend: function() {
                $('#dashboard-container').addClass('loading');
            },
            success: function(response) {
                ChartUpdater.updateDashboardOverview(response.metrics);
            },
            error: function(xhr) {
                console.error('Error fetching metrics:', xhr);
                toastr.error('Failed to update metrics. Please try again.');
            },
            complete: function() {
                $('#dashboard-container').removeClass('loading');
            }
        });
    },

    // Period Change Handler
    handlePeriodChange(event) {
        $('.btn-group [data-period]').removeClass('active');
        $(event.currentTarget).addClass('active');
        this.handleFilterChange();
    },

    // Chart Type Change Handler
    handleChartTypeChange(event) {
        const chartType = $(event.currentTarget).data('chart');
        $('.btn-group [data-chart]').removeClass('active');
        $(event.currentTarget).addClass('active');
        ChartUpdater.updateChartType(chartType);
    },

    // Export Handler
    handleExport() {
        const [startDate, endDate] = ChartUtils.getDateRange();
        const dealerId = ChartUtils.getDealerId();
        
        const exportUrl = new URL('{{ route("admin.dealers.export-report") }}');
        exportUrl.searchParams.append('start_date', startDate);
        exportUrl.searchParams.append('end_date', endDate);
        exportUrl.searchParams.append('dealer_id', dealerId);

        window.location.href = exportUrl.toString();
    },

    // Tab Change Handler
    handleTabChange(event) {
        event.preventDefault();
        const targetId = $(event.currentTarget).attr('href');
        
        // Update UI
        $('.nav-link').removeClass('active');
        $(event.currentTarget).addClass('active');
        $('.tab-pane').removeClass('show active');
        $(targetId).addClass('show active');
        
        // Reinitialize charts for the active tab
        this.reinitializeChartsForTab(targetId);
    },

    // Tab Chart Reinitialization
    reinitializeChartsForTab(tabId) {
        switch(tabId) {
            case '#salesAnalysis':
                ChartInitializer.initializeDailySalesChart();
                break;
            case '#customerBehavior':
                ChartInitializer.initializeConversionFunnelChart();
                ChartInitializer.initializePeakHoursChart();
                break;
            case '#inventoryMetrics':
                ChartInitializer.initializeInventoryAgingChart();
                break;
        }
    },

    // Initialize all event listeners
    initializeEventListeners() {
        // Filter events
        $('#applyFilters').on('click', this.handleFilterChange.bind(this));
        $('.btn-group [data-period]').on('click', this.handlePeriodChange.bind(this));
        $('.btn-group [data-chart]').on('click', this.handleChartTypeChange.bind(this));
        
        // Export event
        $('#exportReport').on('click', this.handleExport.bind(this));
        
        // Tab events
        $('.nav-link').on('click', this.handleTabChange.bind(this));
        
        // Date range picker events
        $('#dateRange').on('apply.daterangepicker', this.handleFilterChange.bind(this));
    }
};

// Main Initialization
const DashboardInitializer = {
    initializeDateRangePicker() {
        $('#dateRange').daterangepicker({
            ...DATE_RANGE_CONFIG,
            locale: {
                format: 'YYYY-MM-DD',
                separator: ' - ',
                applyLabel: 'Apply',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom Range'
            }
        });
    },

    initializeDataTables() {
        // Top Performers Table
        $('#topPerformersTable').DataTable({
            ...DATATABLE_CONFIG,
            columns: [
                { data: 'dealer_name' },
                { data: 'total_sales' },
                { data: 'total_revenue' },
                { data: 'active_listings' },
                { data: 'conversion_rate' },
                { data: 'avg_response_time' },
                { data: 'performance_score' }
            ]
        });

        // Response Times Table
        $('#responseTimesTable').DataTable({
            ...DATATABLE_CONFIG,
            order: [[1, 'asc']]
        });
    },

    initializeTooltips() {
        $('[data-toggle="tooltip"]').tooltip();
    },

    initializeAll() {
        try {
            // Initialize UI components
            this.initializeDateRangePicker();
            this.initializeDataTables();
            this.initializeTooltips();

            // Initialize charts
            ChartInitializer.initializeAllCharts();

            // Initialize event listeners
            EventHandlers.initializeEventListeners();

            // Initial data load
            EventHandlers.handleFilterChange();

        } catch (error) {
            console.error('Error during dashboard initialization:', error);
            toastr.error('There was an error initializing the dashboard. Please refresh the page.');
        }
    }
};

// Document Ready Handler
$(document).ready(function() {
    DashboardInitializer.initializeAll();
});

// Part 5: Additional Utilities and Helper Functions

const DashboardUtils = {
    // Data Formatting Utilities
    formatters: {
        currency(value, currency = 'R') {
            return `${currency}${parseFloat(value).toLocaleString('en-ZA', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })}`;
        },

        percentage(value) {
            return `${parseFloat(value).toFixed(1)}%`;
        },

        number(value) {
            return parseFloat(value).toLocaleString('en-ZA');
        },

        date(value) {
            return moment(value).format('DD MMM YYYY');
        },

        time(value) {
            return moment(value).format('HH:mm');
        },

        duration(minutes) {
            const hours = Math.floor(minutes / 60);
            const remainingMinutes = minutes % 60;
            return hours > 0 ? 
                `${hours}h ${remainingMinutes}m` : 
                `${remainingMinutes}m`;
        }
    },

    // Data Validation Utilities
    validators: {
        isValidNumber(value) {
            return !isNaN(parseFloat(value)) && isFinite(value);
        },

        isValidDate(value) {
            return moment(value).isValid();
        },

        isValidPercentage(value) {
            return this.isValidNumber(value) && value >= 0 && value <= 100;
        },

        isValidArray(value) {
            return Array.isArray(value) && value.length > 0;
        },

        isValidObject(value) {
            return value && typeof value === 'object' && !Array.isArray(value);
        }
    },

    // Chart Data Processors
    chartProcessors: {
        prepareTimeSeriesData(data, dateKey, valueKey) {
            if (!Array.isArray(data)) return { labels: [], values: [] };

            const sortedData = [...data].sort((a, b) => moment(a[dateKey]).diff(moment(b[dateKey])));
            return {
                labels: sortedData.map(item => moment(item[dateKey]).format('DD MMM')),
                values: sortedData.map(item => item[valueKey])
            };
        },

        calculatePercentages(data, total) {
            if (!Array.isArray(data)) return [];
            const calculatedTotal = total || data.reduce((sum, val) => sum + val, 0);
            return data.map(value => (value / calculatedTotal) * 100);
        },

        generateColorPalette(count) {
            const baseColors = Object.values(CHART_COLORS);
            const palette = [];
            
            for (let i = 0; i < count; i++) {
                const baseColor = baseColors[i % baseColors.length];
                palette.push({
                    backgroundColor: baseColor.light,
                    borderColor: baseColor.border
                });
            }
            
            return palette;
        }
    },

    // DOM Manipulation Utilities
    domUtils: {
        showLoadingSpinner(elementId) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const spinner = `
                <div class="loading-overlay">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            `;
            element.insertAdjacentHTML('beforeend', spinner);
        },

        hideLoadingSpinner(elementId) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const overlay = element.querySelector('.loading-overlay');
            if (overlay) overlay.remove();
        },

        updateCardValue(cardId, value, formatter) {
            const element = document.getElementById(cardId);
            if (!element) return;

            const formattedValue = formatter ? 
                this.formatters[formatter](value) : 
                value;
            
            element.textContent = formattedValue;
            
            // Add animation class
            element.classList.add('value-updated');
            setTimeout(() => element.classList.remove('value-updated'), 1000);
        },

        createTooltip(element, content) {
            return new bootstrap.Tooltip(element, {
                title: content,
                placement: 'top',
                trigger: 'hover'
            });
        }
    },

    // Error Handling Utilities
    errorHandlers: {
        handleAjaxError(error, context = '') {
            console.error(`Ajax Error (${context}):`, error);
            
            let errorMessage = 'An error occurred while processing your request.';
            
            if (error.responseJSON && error.responseJSON.message) {
                errorMessage = error.responseJSON.message;
            } else if (error.statusText) {
                errorMessage = `Server Error: ${error.statusText}`;
            }

            toastr.error(errorMessage);
        },

        handleChartError(error, chartId) {
            console.error(`Chart Error (${chartId}):`, error);
            
            const chartCanvas = document.getElementById(chartId);
            if (!chartCanvas) return;

            const errorMessage = `
                <div class="chart-error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>Failed to load chart data</p>
                    <button class="btn btn-sm btn-primary retry-btn">Retry</button>
                </div>
            `;

            chartCanvas.insertAdjacentHTML('afterend', errorMessage);
        }
    },

    // Data Export Utilities
    exportUtils: {
        exportToCsv(data, filename) {
            if (!data || !data.length) return;

            const csvContent = this.convertToCSV(data);
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            
            if (navigator.msSaveBlob) {
                navigator.msSaveBlob(blob, filename);
                return;
            }

            link.href = URL.createObjectURL(blob);
            link.setAttribute('download', filename);
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },

        convertToCSV(data) {
            const headers = Object.keys(data[0]);
            const rows = data.map(row => 
                headers.map(header => 
                    JSON.stringify(row[header] || '')
                ).join(',')
            );

            return [
                headers.join(','),
                ...rows
            ].join('\n');
        }
    },

    // Cache Management
    cacheManager: {
        cache: new Map(),

        set(key, value, expirationMinutes = 5) {
            this.cache.set(key, {
                value,
                expiration: Date.now() + (expirationMinutes * 60 * 1000)
            });
        },

        get(key) {
            const cached = this.cache.get(key);
            if (!cached) return null;

            if (Date.now() > cached.expiration) {
                this.cache.delete(key);
                return null;
            }

            return cached.value;
        },

        clear() {
            this.cache.clear();
        }
    }
};

// Add to window object for global access if needed
window.DashboardUtils = DashboardUtils;


// Part 6: CSS Styles and Animations

// Add this to your stylesheet or in a <style> tag
const dashboardStyles = `
/* Dashboard Layout Styles */
.dashboard-container {
    padding: 20px;
    background-color: #f8f9fa;
    min-height: 100vh;
}

.dashboard-header {
    margin-bottom: 2rem;
}

.dashboard-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

/* Card Styles */
.metric-card {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    padding: 1.5rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.metric-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.metric-card .card-title {
    color: #6c757d;
    font-size: 0.875rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.metric-card .card-value {
    color: #2c3e50;
    font-size: 1.5rem;
    font-weight: 600;
}

/* Value Update Animation */
@keyframes valueUpdate {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.value-updated {
    animation: valueUpdate 0.5s ease;
}

/* Chart Container Styles */
.chart-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    position: relative;
    min-height: 300px;
}

.chart-title {
    color: #2c3e50;
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 1rem;
}

/* Loading Overlay */
.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255,255,255,0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    backdrop-filter: blur(2px);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.loading-overlay {
    animation: fadeIn 0.2s ease;
}

/* Filter Section Styles */
.filter-section {
    background: white;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.filter-group {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

/* Button Styles */
.btn-filter {
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-filter.active {
    background-color: #007bff;
    color: white;
    box-shadow: 0 2px 4px rgba(0,123,255,0.2);
}

/* Table Styles */
.data-table {
    width: 100%;
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

.data-table th {
    background-color: #f8f9fa;
    color: #495057;
    font-weight: 500;
    padding: 1rem;
}

.data-table td {
    padding: 1rem;
    border-top: 1px solid #e9ecef;
}

/* Error Message Styles */
.chart-error-message {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #dc3545;
}

.chart-error-message i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* Tooltip Styles */
.custom-tooltip {
    background-color: #2c3e50;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    font-size: 0.875rem;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Responsive Styles */
@media (max-width: 768px) {
    .dashboard-container {
        padding: 1rem;
    }

    .metric-card {
        margin-bottom: 1rem;
    }

    .chart-container {
        min-height: 250px;
    }

    .filter-group {
        flex-direction: column;
        align-items: stretch;
    }
}

/* Tab Styles */
.nav-tabs {
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 1.5rem;
}

.nav-tabs .nav-link {
    border: none;
    color: #6c757d;
    padding: 1rem 1.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
}

.nav-tabs .nav-link:hover {
    color: #007bff;
    border-bottom: 2px solid #007bff;
}

.nav-tabs .nav-link.active {
    color: #007bff;
    border-bottom: 2px solid #007bff;
    background: transparent;
}

/* Animation Classes */
.fade-enter {
    opacity: 0;
}

.fade-enter-active {
    opacity: 1;
    transition: opacity 200ms ease-in;
}

.fade-exit {
    opacity: 1;
}

.fade-exit-active {
    opacity: 0;
    transition: opacity 200ms ease-out;
}

/* Print Styles */
@media print {
    .dashboard-container {
        padding: 0;
        background: white;
    }

    .filter-section,
    .btn-filter,
    .loading-overlay {
        display: none;
    }

    .chart-container {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #e9ecef;
    }

    .metric-card {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #e9ecef;
    }
}
`;

// Function to inject styles
function injectDashboardStyles() {
    const styleElement = document.createElement('style');
    styleElement.textContent = dashboardStyles;
    document.head.appendChild(styleElement);
}

// Add styles when the document is ready
$(document).ready(function() {
    injectDashboardStyles();
});

// Optional: Add dynamic theme support
const ThemeManager = {
    themes: {
        light: {
            backgroundColor: '#f8f9fa',
            cardBackground: 'white',
            textColor: '#2c3e50',
            borderColor: '#e9ecef'
        },
        dark: {
            backgroundColor: '#1a1a1a',
            cardBackground: '#2c2c2c',
            textColor: '#ffffff',
            borderColor: '#404040'
        }
    },

    setTheme(themeName) {
        const theme = this.themes[themeName];
        if (!theme) return;

        document.documentElement.style.setProperty('--background-color', theme.backgroundColor);
        document.documentElement.style.setProperty('--card-background', theme.cardBackground);
        document.documentElement.style.setProperty('--text-color', theme.textColor);
        document.documentElement.style.setProperty('--border-color', theme.borderColor);
    }
};
private function prepareSalesTrendData()
{
    return [
        'labels' => $this->salesAnalytics['trends']->pluck('date'),
        'datasets' => [
            [
                'label' => 'Sales',
                'data' => $this->salesAnalytics['trends']->pluck('sales'),
                'borderColor' => 'rgb(75, 192, 192)',
                'tension' => 0.1
            ],
            [
                'label' => 'Revenue',
                'data' => $this->salesAnalytics['trends']->pluck('avg_price'),
                'borderColor' => 'rgb(54, 162, 235)',
                'tension' => 0.1
            ]
        ]
    ];
}

private function prepareMarketShareData()
{
    return [
        'labels' => $this->marketAnalysis['market_share']->pluck('category_name'),
        'datasets' => [
            [
                'data' => $this->marketAnalysis['market_share']->pluck('market_share'),
                'backgroundColor' => [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 206, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(153, 102, 255)'
                ]
            ]
        ]
    ];
}

private function preparePriceTrendData()
{
    return [
        'labels' => $this->marketAnalysis['price_trends']->pluck('date'),
        'datasets' => [
            [
                'label' => 'Average Price',
                'data' => $this->marketAnalysis['price_trends']->pluck('average_price'),
                'borderColor' => 'rgb(75, 192, 192)',
                'tension' => 0.1
            ]
        ]
    ];
}

private function preparePredictiveData()
{
    return [
        'labels' => $this->predictions['sales_forecast']['predictions']->pluck('date'),
        'datasets' => [
            [
                'label' => 'Predicted Sales',
                'data' => $this->predictions['sales_forecast']['predictions']->pluck('predicted_sales'),
                'borderColor' => 'rgb(75, 192, 192)',
                'tension' => 0.1
            ]
        ]
    ];
}
</script>
@endsection