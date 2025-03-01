<div class="row mb-4">
    @foreach([
        ['title' => 'Total Revenue', 'value' => $platformStats['total_stats']['total_revenue'], 'icon' => 'dollar-sign', 'color' => 'primary'],
        ['title' => 'Active Listings', 'value' => $platformStats['total_stats']['active_listings'], 'icon' => 'car', 'color' => 'success'],
        ['title' => 'Total Sales', 'value' => $platformStats['total_stats']['total_sales'], 'icon' => 'shopping-cart', 'color' => 'info'],
        ['title' => 'Conversion Rate', 'value' => $platformStats['total_stats']['conversion_rate'], 'icon' => 'chart-line', 'color' => 'warning']
    ] as $metric)
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-{{ $metric['color'] }} shadow h-100 py-2 metric-card">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-{{ $metric['color'] }} text-uppercase mb-1">
                            {{ $metric['title'] }}
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            @if(str_contains($metric['title'], 'Revenue'))
                                R{{ number_format($metric['value'], 2) }}
                            @elseif(str_contains($metric['title'], 'Rate'))
                                {{ number_format($metric['value'], 1) }}%
                            @else
                                {{ number_format($metric['value']) }}
                            @endif
                        </div>
                        @if(isset($platformStats['growth_rates'][strtolower(str_replace(' ', '_', $metric['title']))]))
                            <div class="mt-2 text-xs {{ $platformStats['growth_rates'][strtolower(str_replace(' ', '_', $metric['title']))] > 0 ? 'text-success' : 'text-danger' }}">
                                <i class="fas fa-{{ $platformStats['growth_rates'][strtolower(str_replace(' ', '_', $metric['title']))] > 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                                {{ abs($platformStats['growth_rates'][strtolower(str_replace(' ', '_', $metric['title']))]) }}% from last period
                            </div>
                        @endif
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-{{ $metric['icon'] }} fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>