@extends('layouts.seller')

@section('title', 'Seller Dashboard')

@section('seller-content')
    <h1>Seller Dashboard</h1>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Leads</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalLeads }}</h5>
                    <p class="card-text">Number of leads received.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Listings</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalListings }}</h5>
                    <p class="card-text">Number of car listings.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Total Sales</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalSales }}</h5>
                    <p class="card-text">Number of cars sold.</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Average Price</div>
                <div class="card-body">
                    <h5 class="card-title">${{ $averagePrice }}</h5>
                    <p class="card-text">Average price of listed cars.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Leads Over Time</div>
                <div class="card-body">
                    <canvas id="leadsChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Listings Distribution</div>
                <div class="card-body">
                    <canvas id="listingsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Sales</h5>
                    <p class="card-text">View and manage your sales.</p>
                    <a href="{{ route('manage.sales') }}" class="btn btn-primary">Go to Manage Sales</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Leads</h5>
                    <p class="card-text">View and manage your leads.</p>
                    <a href="{{ route('manage.leads') }}" class="btn btn-primary">Go to Manage Leads</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Add Cars</h5>
                    <p class="card-text">Add new cars to your inventory.</p>
                    <a href="{{ route('add.cars') }}" class="btn btn-primary">Go to Add Cars</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Manage Listings</h5>
                    <p class="card-text">View and manage your car listings.</p>
                    <a href="{{ route('manage.listings') }}" class="btn btn-primary">Go to Manage Listings</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">News Management</h5>
                    <p class="card-text">Manage your news articles.</p>
                    <a href="{{ route('news.management') }}" class="btn btn-primary">Go to News Management</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctxLeads = document.getElementById('leadsChart').getContext('2d');
        var leadsChart = new Chart(ctxLeads, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'],
                datasets: [{
                    label: 'Leads',
                    data: [10, 15, 20, 25, 30],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var ctxListings = document.getElementById('listingsChart').getContext('2d');
        var listingsChart = new Chart(ctxListings, {
            type: 'pie',
            data: {
                labels: ['New', 'Used', 'Certified Pre-Owned'],
                datasets: [{
                    label: 'Listings',
                    data: [5, 10, 15],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
