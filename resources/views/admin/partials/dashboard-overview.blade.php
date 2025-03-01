<!-- resources/views/admin/partials/dashboard-overview.blade.php -->
<style>
    /* Dashboard Overview Styles */
.dashboard-overview {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 30px;
}

.overview-card {
    flex: 1 1 200px;
    display: flex;
    align-items: center;
    padding: 20px;
    border-radius: 10px;
    color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.overview-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
}

.overview-card .icon {
    font-size: 2rem;
    margin-right: 15px;
    opacity: 0.7;
}

.overview-card .text {
    display: flex;
    flex-direction: column;
}

.overview-card .text .label {
    font-size: 0.9rem;
    margin-bottom: 5px;
}

.overview-card .text .value {
    font-size: 1.5rem;
    font-weight: bold;
}

.bg-primary {
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
}

.bg-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-warning {
    background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);
    color: #212529;
}

.bg-danger {
    background: linear-gradient(135deg, #c31432 0%, #240b36 100%);
}

.bg-info {
    background: linear-gradient(135deg, #1f4037 0%, #99f2c8 100%);
}

.bg-dark-custom {
    background: linear-gradient(135deg, #232526 0%, #414345 100%);
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .dashboard-overview {
        flex-direction: column;
    }
    .overview-card {
        flex: 1 1 100%;
    }
}
</style>
<div class="container-fluid mt-4">
    <div class="dashboard-overview">
        <div class="overview-card bg-primary">
            <i class="fas fa-users icon"></i>
            <div class="text">
                <span class="label">Total Users</span>
                <span class="value">{{ $totals['totalUsers'] ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="overview-card bg-success">
            <i class="fas fa-list-alt icon"></i>
            <div class="text">
                <span class="label">Total Listings</span>
                <span class="value">{{ $totals['totalListings'] ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="overview-card bg-warning">
            <i class="fas fa-envelope icon"></i>
            <div class="text">
                <span class="label">Total Enquiries</span>
                <span class="value">{{ $totals['totalEnquiries'] ?? 'N/A' }}</span>
            </div>
        </div>

        <div class="overview-card bg-info">
            <i class="fas fa-shopping-cart icon"></i>
            <div class="text">
                <span class="label">Total Sales</span>
                <span class="value">{{ $totals['totalSales'] ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="overview-card bg-dark-custom">
            <i class="fas fa-building icon"></i>
            <div class="text">
                <span class="label">Total Dealers</span>
                <span class="value">{{ $totals['totalDealerships'] ?? 'N/A' }}</span>
            </div>
        </div>
    </div>
</div>