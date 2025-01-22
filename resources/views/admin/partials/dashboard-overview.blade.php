<div class="container-fluid full-width-container mt-5">
    <div class="dashboard-overview">
        <div class="overview-item bg-primary">
            <span class="overview-label">Total Users:</span>
            <span>{{ $totals['totalUsers'] ?? 'N/A' }}</span>
        </div>
        <div class="overview-item bg-success">
            <span class="overview-label">Total Listings:</span>
            <span>{{ $totals['totalListings'] ?? 'N/A' }}</span>
        </div>
        <div class="overview-item bg-warning">
            <span class="overview-label">Total Enquiries:</span>
            <span>{{ $totals['totalEnquiries'] ?? 'N/A' }}</span>
        </div>
        <div class="overview-item bg-danger">
            <span class="overview-label">Total Reviews:</span>
            <span>{{ $totals['totalReviews'] ?? 'N/A' }}</span>
        </div>
        <div class="overview-item bg-info">
            <span class="overview-label">Total Sales:</span>
            <span>{{ $totals['totalReviews'] ?? 'N/A' }}</span>
        </div>
        <div class="overview-item bg-dark">
            <span class="overview-label">Total Dealers:</span>
            <span>{{ $totals['totalDealerships'] ?? 'N/A' }}</span>
        </div>
    </div>
</div>