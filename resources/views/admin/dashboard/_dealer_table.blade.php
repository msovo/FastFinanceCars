<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Dealer Performance</h6>
        <div class="actions">
            <button class="btn btn-sm btn-primary" id="exportDealerData">
                <i class="fas fa-download"></i> Export
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dealersTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Dealer Name</th>
                        <th>Total Listings</th>
                        <th>Active Listings</th>
                        <th>Sales</th>
                        <th>Revenue</th>
                        <th>Avg. Response Time</th>
                        <th>Performance Score</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($dealerMetrics['top_performers'] as $dealer)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ $dealer->logo_url }}" alt="Dealer Logo" class="rounded-circle mr-2" width="30">
                                {{ $dealer->name }}
                            </div>
                        </td>
                        <td>{{ number_format($dealer->total_listings) }}</td>
                        <td>{{ number_format($dealer->active_listings) }}</td>
                        <td>{{ number_format($dealer->sold_listings) }}</td>
                        <td>R{{ number_format($dealer->total_revenue, 2) }}</td>
                        <td>{{ $dealer->avg_response_time }} hrs</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar bg-{{ $this->getPerformanceColor($dealer->performance_score) }}" 
                                     role="progressbar" 
                                     style="width: {{ $dealer->performance_score }}%">
                                    {{ number_format($dealer->performance_score, 1) }}%
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.dealers.show', $dealer->id) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <button type="button" 
                                        class="btn btn-sm btn-warning dealer-contact" 
                                        data-dealer-id="{{ $dealer->id }}">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>