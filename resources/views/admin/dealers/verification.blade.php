@extends('layouts.admin')

@section('title', 'Dealer Verifications')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    <style>
    /* Layout Adjustments */
    .container-fluid {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
        margin-left: 15%!important; /* Adjust this value based on your sidebar width */
        width: calc(100% - 14rem); /* Adjust based on sidebar width */
        transition: all 0.3s ease;
    }

    /* When sidebar is collapsed */
    body.sidebar-toggled .container-fluid {
        margin-left: 6.5rem; /* Adjust this value based on your collapsed sidebar width */
        width: calc(100% - 6.5rem);
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container-fluid {
            margin-left: 0;
            width: 100%;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        body.sidebar-toggled .container-fluid {
            margin-left: 0;
            width: 100%;
        }
    }

    /* Card Grid Adjustments */
    .row {
        margin-right: -0.75rem;
        margin-left: -0.75rem;
    }

    .col-xl-4, .col-md-6, .col-12 {
        padding-right: 0.75rem;
        padding-left: 0.75rem;
    }

    /* Stats Cards Spacing */
    .card {
        margin-bottom: 1.5rem;
    }

    /* Filter Card Adjustments */
    .card-header {
        padding: 1rem 1.25rem;
    }

    .card-body {
        padding: 1.25rem;
    }

    /* Dealer Card Grid */
    #dealersList {
        margin-top: 1rem;
    }

    .dealer-card {
        height: 100%;
        margin-bottom: 1.5rem;
    }

    /* Your existing CSS styles continue below... */
    /* General Card Styling */
    .dealer-card {
        transition: all 0.3s ease;
        border: none;
        overflow: hidden;
    }

    .hover-shadow:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    /* Avatar Styling */
    .avatar-circle {
        width: 80px;
        height: 80px;
        background-color: #4e73df;
        border-radius: 50%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .avatar-initials {
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-transform: uppercase;
    }

    /* Info Icons Styling */
    .info-icon {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(78, 115, 223, 0.1);
        margin-right: 10px;
    }

    .info-content {
        flex: 1;
        min-width: 0; /* For text-truncate to work */
    }

    /* Stats Section Styling */
    .stat-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05);
    }

    .stat-card:hover {
        background-color: #4e73df !important;
        color: white;
    }

    .stat-card:hover .text-primary {
        color: white !important;
    }

    .stat-card:hover .text-muted {
        color: rgba(255,255,255,0.8) !important;
    }

    /* Custom Checkbox Styling */
    .custom-control-input:checked ~ .custom-control-label::before {
        border-color: #4e73df;
        background-color: #4e73df;
    }

    .custom-control-input:focus ~ .custom-control-label::before {
        box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
    }

    /* Badge Styling */
    .badge-pill {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    /* Loading Overlay */
    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255, 255, 255, 0.8);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    /* Select2 Custom Styling */
    .select2-container--default .select2-selection--single {
        height: calc(1.5em + 0.75rem + 2px);
        border: 1px solid #d1d3e2;
        border-radius: 0.35rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: calc(1.5em + 0.75rem);
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.75rem);
    }

    /* Button Group Styling */
    .btn-group .btn {
        position: relative;
        overflow: hidden;
    }

    .btn-group .btn::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background-color: rgba(255,255,255,0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.3s ease, height 0.3s ease;
    }

    .btn-group .btn:hover::after {
        width: 200%;
        height: 200%;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dealer-card {
        animation: fadeIn 0.5s ease forwards;
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .stat-value {
        animation: pulse 2s infinite;
    }

    /* Status Indicators */
    .status-indicator {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .status-indicator.pending {
        background-color: #f6c23e;
        box-shadow: 0 0 0 rgba(246, 194, 62, 0.4);
        animation: pulse-warning 2s infinite;
    }

    @keyframes pulse-warning {
        0% {
            box-shadow: 0 0 0 0 rgba(246, 194, 62, 0.4);
        }
        70% {
            box-shadow: 0 0 0 10px rgba(246, 194, 62, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(246, 194, 62, 0);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dealer-card {
            margin-bottom: 1rem;
        }

        .avatar-circle {
            width: 60px;
            height: 60px;
        }

        .avatar-initials {
            font-size: 1.2rem;
        }

        .info-icon {
            width: 25px;
            height: 25px;
        }

        .btn-group .btn {
            padding: 0.375rem 0.5rem;
        }
    }

    /* Dark Mode Support */
    @media (prefers-color-scheme: dark) {
        .dealer-card {
            background-color: #2c3e50;
            color: #ecf0f1;
        }

        .stat-card {
            background-color: #34495e !important;
        }

        .text-muted {
            color: #bdc3c7 !important;
        }

        .info-icon {
            background-color: rgba(255,255,255,0.1);
        }
    }

    /* Custom Scrollbar */
    .card-body::-webkit-scrollbar {
        width: 8px;
    }

    .card-body::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .card-body::-webkit-scrollbar-thumb {
        background: #4e73df;
        border-radius: 4px;
    }

    .card-body::-webkit-scrollbar-thumb:hover {
        background: #224abe;
    }

    /* Tooltip Custom Styling */
    .tooltip {
        font-size: 0.8rem;
    }

    .tooltip-inner {
        max-width: 200px;
        padding: 0.5rem 1rem;
        background-color: #4e73df;
        border-radius: 0.35rem;
    }

    .bs-tooltip-top .arrow::before {
        border-top-color: #4e73df;
    }
</style>
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-user-check fa-sm text-primary"></i> Dealer Verifications
        </h1>
        <div class="d-flex">
            <button class="btn btn-success btn-sm mr-2" id="verifyAllSelected" disabled>
                <i class="fas fa-check-circle"></i> Verify Selected
                <span class="selected-count badge badge-light ml-1">0</span>
            </button>
            <button class="btn btn-danger btn-sm" id="rejectAllSelected" disabled>
                <i class="fas fa-times-circle"></i> Reject Selected
                <span class="selected-count badge badge-light ml-1">0</span>
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendingDealers->total() }}
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
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Listings
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendingDealers->sum('listings_count') }}
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Inquiries
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $pendingDealers->sum('inquiries_count') }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-envelope fa-2x text-gray-300"></i>
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
                                Average Listings
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ number_format($pendingDealers->avg('listings_count'), 1) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Card -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter"></i> Filters
            </h6>
            <button type="submit" class="btn btn-primary">
            <i class="fas fa-filter"></i> Apply Filters
         </button>
            <button class="btn btn-sm btn-outline-primary" id="resetFilters">
                <i class="fas fa-sync-alt"></i> Reset
            </button>
            
        </div>
        <div class="card-body">
            <form id="filterForm" class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status">
                            <i class="fas fa-toggle-on"></i> Status
                        </label>
                        <select class="form-control select2" id="status" name="status">
                            <option value="all">All Statuses</option>
                            <option value="Pending" {{ request()->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Verified" {{ request()->status == 'Verified' ? 'selected' : '' }}>Verified</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="province">
                            <i class="fas fa-map-marker-alt"></i> Province
                        </label>
                        <select class="form-control select2" id="province" name="province">
                            <option value="all">All Provinces</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province }}" {{ request()->province == $province ? 'selected' : '' }}>
                                    {{ $province }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="sort">
                            <i class="fas fa-sort"></i> Sort By
                        </label>
                        <select class="form-control select2" id="sort" name="sort">
                            <option value="created_at" {{ request()->sort == 'created_at' ? 'selected' : '' }}>Date</option>
                            <option value="listings_count" {{ request()->sort == 'listings_count' ? 'selected' : '' }}>Listings</option>
                            <option value="inquiries_count" {{ request()->sort == 'inquiries_count' ? 'selected' : '' }}>Inquiries</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="direction">
                            <i class="fas fa-arrow-up"></i> Order
                        </label>
                        <select class="form-control select2" id="direction" name="direction">
                            <option value="asc" {{ request()->direction == 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request()->direction == 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Dealer Cards Grid -->
<div class="row" id="dealersList">
    @forelse($pendingDealers as $dealer)
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card dealer-card h-100 shadow-sm hover-shadow">
            <!-- Card Header with Status and Checkbox -->
            <div class="card-header bg-transparent py-2">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input dealer-checkbox" 
                               id="dealer{{ $dealer['id'] }}" value="{{ $dealer['id'] }}">
                        <label class="custom-control-label" for="dealer{{ $dealer['id'] }}">
                            Select
                        </label>
                    </div>
                    <div class="dealer-status">
                        <span class="badge badge-pill badge-{{ $dealer['status_color'] }} px-3 py-2">
                            <i class="fas fa-{{ $dealer['status'] === 'Verified' ? 'check-circle' : 'clock' }}"></i>
                            {{ $dealer['status'] }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                <!-- Dealer Info Section -->
                <div class="dealer-info-section mb-4">
                    <div class="text-center mb-3">
                        <div class="dealer-avatar mb-3">
                            <div class="avatar-circle">
                                <span class="avatar-initials">
                                <img src="{{ $dealer['logo'] ? Storage::url($dealer['logo']) : asset('default-profile.png') }}" alt="logo" class="img-thumbnail" >
                                </span>
                            </div>
                        </div>
                        <h5 class="dealer-name mb-1">{{ $dealer['name'] }}</h5>
                        <p class="text-muted mb-0">
                            <small>Member since {{ \Carbon\Carbon::parse($dealer['created_at'])->format('M d, Y') }}</small>
                        </p>
                    </div>

                    <!-- Contact Information -->
                    <div class="contact-info">
                        <div class="info-item d-flex align-items-center mb-2">
                            <div class="info-icon">
                                <i class="fas fa-registered text-primary"></i>
                            </div>
                            <div class="info-content text-truncate">
                                <a href="mailto:{{ $dealer['email'] }}" class="text-muted">
                                    {{ $dealer['email'] }}
                                </a>
                            </div>
                        </div>
                        <div class="info-item d-flex align-items-center mb-2">
                            <div class="info-icon">
                                <i class="fas fa-phone text-primary"></i>
                            </div>
                            <div class="info-content">
                                <a href="tel:{{ $dealer['phone'] }}" class="text-muted">
                                    {{ $dealer['phone'] }}
                                </a>
                            </div>
                        </div>
                        <div class="info-item d-flex align-items-center mb-2">
                            <div class="info-icon">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                            </div>
                            <div class="info-content text-truncate">
                                <span class="text-muted">{{ $dealer['address'] }}</span>
                            </div>
                        </div>
                        <div class="info-item d-flex align-items-center">
                            <div class="info-icon">
                                <i class="fas fa-map text-primary"></i>
                            </div>
                            <div class="info-content">
                                <span class="text-muted">{{ $dealer['province'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="stats-section">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="stat-card p-2 rounded bg-light">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-car text-primary"></i>
                                </div>
                                <div class="stat-value font-weight-bold">
                                    {{ number_format($dealer['listings_count']) }}
                                </div>
                                <div class="stat-label small text-muted">
                                    Listings
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-card p-2 rounded bg-light">
                                <div class="stat-icon mb-2">
                                    <i class="fas fa-comments text-primary"></i>
                                </div>
                                <div class="stat-value font-weight-bold">
                                    {{ number_format($dealer['inquiries_count']) }}
                                </div>
                                <div class="stat-label small text-muted">
                                    Inquiries
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Footer with Action Buttons -->
            <div class="card-footer bg-transparent">
                <div class="btn-group d-flex" role="group">
                <form class="verify-form d-inline" onsubmit="return verifyDealer(event, {{ $dealer['id'] }})">
                        @csrf
                        <button type="submit" 
                                class="btn btn-outline-success" 
                                data-id="{{ $dealer['id'] }}"
                                data-toggle="tooltip"
                                title="Verify Dealer">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                    <a href="{{ route('admin.dealers.show', $dealer['id']) }}" 
                    class="btn btn-outline-primary"
                    data-toggle="tooltip"
                    title="Review Details">
                        <i class="fas fa-search"></i>
                    </a>
                    <button type="button" 
                            class="btn btn-outline-danger reject-dealer" 
                            data-id="{{ $dealer['id'] }}"
                            data-toggle="tooltip"
                            title="Reject Dealer">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info d-flex align-items-center" role="alert">
            <i class="fas fa-info-circle fa-2x mr-3"></i>
            <div>
                <h5 class="alert-heading mb-0">No Pending Verifications</h5>
                <p class="mb-0">There are currently no dealers waiting for verification.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>

<!-- Pagination -->
@if($pendingDealers->hasPages())
<div class="row">
    <div class="col-12">
        <div class="dealer-pagination d-flex justify-content-center">
            {{ $pendingDealers->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endif

<!-- Loading Overlay -->
<div id="loadingOverlay" class="loading-overlay d-none">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<!-- Modals -->
@include('admin.dealers.partials.verification-modals')


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Initialize Toastr options -->
    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };
    </script>
<script>

    
$(document).ready(function() {
    // Initialize Select2

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Global variables
    let selectedDealers = new Set();
    const loadingOverlay = $('#loadingOverlay');

    // Handle checkbox selection
    $('.dealer-checkbox').on('change', function() {
        const dealerId = $(this).val();
        if (this.checked) {
            selectedDealers.add(dealerId);
        } else {
            selectedDealers.delete(dealerId);
        }
        updateBulkActionButtons();
    });

    // Update bulk action buttons state
    function updateBulkActionButtons() {
        const count = selectedDealers.size;
        $('.selected-count').text(count);
        $('#verifyAllSelected, #rejectAllSelected').prop('disabled', count === 0);
    }

    // Handle filter changes
    $('#filterForm select').on('change', function() {
        applyFilters();
    });

    // Reset filters
    $('#resetFilters').on('click', function(e) {
        e.preventDefault();
        $('#filterForm')[0].reset();
        $('.select2').trigger('change');
        applyFilters();
    });

    // Apply filters function
    function applyFilters() {
        showLoading();
        const queryParams = new URLSearchParams({
            status: $('#status').val(),
            province: $('#province').val(),
            sort: $('#sort').val(),
            direction: $('#direction').val()
        });

        window.location.href = `${window.location.pathname}?${queryParams.toString()}`;
    }

     // Verify single dealer
    $('.verify-dealer').on('click', function() {
        const dealerId = $(this).data('id');
        const card = $(this).closest('.dealer-card');

        Swal.fire({
            title: 'Verify Dealer',
            text: 'Are you sure you want to verify this dealer?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return verifyDealer(dealerId);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                card.fadeOut(400, function() {
                    $(this).remove();
                    checkEmptyState();
                });
            }
        });
    }); 

    // Reject single dealer
    $('.reject-dealer').on('click', function() {
        const dealerId = $(this).data('id');
        const card = $(this).closest('.dealer-card');

        Swal.fire({
            title: 'Reject Dealer',
            text: 'Please provide a reason for rejection:',
            input: 'textarea',
            inputPlaceholder: 'Enter rejection reason...',
            inputAttributes: {
                'aria-label': 'Rejection reason'
            },
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Reject',
            cancelButtonText: 'Cancel',
            showLoaderOnConfirm: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to provide a reason for rejection!';
                }
            },
            preConfirm: (reason) => {
                return rejectDealer(dealerId, reason);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                card.fadeOut(400, function() {
                    $(this).remove();
                    checkEmptyState();
                });
            }
        });
    });

    // Bulk verify dealers
    $('#verifyAllSelected').on('click', function() {
        if (selectedDealers.size === 0) return;

        Swal.fire({
            title: 'Verify Selected Dealers',
            text: `Are you sure you want to verify ${selectedDealers.size} dealers?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify all',
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return verifyMultipleDealers(Array.from(selectedDealers));
            }
        }).then((result) => {
            if (result.isConfirmed) {
                selectedDealers.forEach(id => {
                    $(`#dealer${id}`).closest('.dealer-card').fadeOut(400, function() {
                        $(this).remove();
                    });
                });
                selectedDealers.clear();
                updateBulkActionButtons();
                checkEmptyState();
            }
        });
    });

    // Bulk reject dealers
    $('#rejectAllSelected').on('click', function() {
        if (selectedDealers.size === 0) return;

        Swal.fire({
            title: 'Reject Selected Dealers',
            text: 'Please provide a reason for rejection:',
            input: 'textarea',
            inputPlaceholder: 'Enter rejection reason...',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: `Reject ${selectedDealers.size} dealers`,
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to provide a reason for rejection!';
                }
            },
            showLoaderOnConfirm: true,
            preConfirm: (reason) => {
                return rejectMultipleDealers(Array.from(selectedDealers), reason);
            }
        }).then((result) => {
            if (result.isConfirmed) {
                selectedDealers.forEach(id => {
                    $(`#dealer${id}`).closest('.dealer-card').fadeOut(400, function() {
                        $(this).remove();
                    });
                });
                selectedDealers.clear();
                updateBulkActionButtons();
                checkEmptyState();
            }
        });
    });

    // API calls
    function verifyDealer(event, id) {
    event.preventDefault(); // Prevent form submission

    Swal.fire({
        title: 'Verify Dealer',
        text: 'Are you sure you want to verify this dealer?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#1cc88a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, verify',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            const form = event.target;
            const formData = new FormData(form);

            $.ajax({
                url: `/admin/dealers/${id}/verify`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    toastr.success('Dealer verified successfully');
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    toastr.error('Error verifying dealer');
                }
            });
        }
    });

    return false; // Prevent form submission
}

    async function rejectDealer(id, reason) {
        try {
            const response = await $.ajax({
                url: `/admin/dealers/${id}/reject`,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    reason: reason
                }
            });
            toastr.success('Dealer rejected successfully');
            return response;
        } catch (error) {
            throw new Error(error.responseJSON?.message || 'Error rejecting dealer');
        }
    }

    async function verifyMultipleDealers(ids) {
        try {
            const response = await $.ajax({
                url: '/admin/dealers/verify-multiple',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    dealer_ids: ids
                }
            });
            toastr.success('Selected dealers verified successfully');
            return response;
        } catch (error) {
            throw new Error(error.responseJSON?.message || 'Error verifying dealers');
        }
    }

    async function rejectMultipleDealers(ids, reason) {
        try {
            const response = await $.ajax({
                url: '/admin/dealers/reject-multiple',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    dealer_ids: ids,
                    reason: reason
                }
            });
            toastr.success('Selected dealers rejected successfully');
            return response;
        } catch (error) {
            throw new Error(error.responseJSON?.message || 'Error rejecting dealers');
        }
    }

    // Utility functions
    function showLoading() {
        loadingOverlay.removeClass('d-none');
    }

    function hideLoading() {
        loadingOverlay.addClass('d-none');
    }

    function checkEmptyState() {
        if ($('.dealer-card').length === 0) {
            $('#dealersList').html(`
                <div class="col-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="fas fa-info-circle fa-2x mr-3"></i>
                        <div>
                            <h5 class="alert-heading mb-0">No Pending Verifications</h5>
                            <p class="mb-0">There are currently no dealers waiting for verification.</p>
                        </div>
                    </div>
                </div>
            `);
        }
    }

    // Error handler
    $(document).ajaxError(function(event, jqXHR, settings, error) {
        toastr.error('An error occurred while processing your request');
        hideLoading();
    });

    // Success handler
    $(document).ajaxSuccess(function() {
        hideLoading();
    });

    // Initialize any dealer cards animations
    $('.dealer-card').each(function(index) {
        $(this).css({
            'animation-delay': `${index * 0.1}s`
        });
    });
});

// Add this to your existing JavaScript
$(document).ready(function() {
    // Handle rejection reason change
    $('#rejectionReason').on('change', function() {
        if ($(this).val() === 'other') {
            $('#otherReasonGroup').slideDown();
        } else {
            $('#otherReasonGroup').slideUp();
        }
    });

    // Populate bulk action modal
    function populateSelectedDealersList() {
        const tbody = $('#selectedDealersList');
        tbody.empty();

        selectedDealers.forEach(id => {
            const card = $(`#dealer${id}`).closest('.dealer-card');
            const name = card.find('.dealer-name').text();
            const email = card.find('.info-content a').first().text();
            const listings = card.find('.stat-value').first().text();

            tbody.append(`
                <tr>
                    <td>${name}</td>
                    <td>${email}</td>
                    <td>${listings}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger remove-selected" 
                                data-id="${id}">
                            <i class="fas fa-times"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    }

    // Handle remove selected dealer
    $(document).on('click', '.remove-selected', function() {
        const id = $(this).data('id');
        selectedDealers.delete(id);
        $(`#dealer${id}`).prop('checked', false);
        $(this).closest('tr').remove();
        updateBulkActionButtons();
    });

    // Show success modal
    function showSuccessModal(message) {
        $('#successMessage').text(message);
        $('#successModal').modal('show');
    }
});

$(document).ready(function() {
    console.log('Document ready');

    // Debug selected elements
    console.log('Filter form elements:', $('#filterForm select').length);
    console.log('Verify buttons:', $('.verify-dealer').length);
    console.log('Reject buttons:', $('.reject-dealer').length);

    // Initialize Select2 with event binding


    // Filter form changes
    $('#filterForm select').on('change', function(e) {
        console.log('Filter changed:', e.target.name, e.target.value);
        applyFilters();
    });

    // Reset filters button
    $('#resetFilters').on('click', function(e) {
        console.log('Reset filters clicked');
        e.preventDefault();
        $('#filterForm')[0].reset();
        $('.select2').val('').trigger('change');
        applyFilters();
    });

    // Modified applyFilters function with logging
    function applyFilters() {
        console.log('Applying filters');
        showLoading();
        
        const status = $('#status').val();
        const province = $('#province').val();
        const sort = $('#sort').val();
        const direction = $('#direction').val();

        console.log('Filter values:', { status, province, sort, direction });

        const queryParams = new URLSearchParams({
            status: status || 'all',
            province: province || 'all',
            sort: sort || 'created_at',
            direction: direction || 'desc'
        });

        const url = `${window.location.pathname}?${queryParams.toString()}`;
        console.log('Redirecting to:', url);
        window.location.href = url;
    }

    // Verify dealer button
    $(document).on('click', '.verify-dealer', function(e) {
        console.log('Verify dealer clicked');
        e.preventDefault();
        const dealerId = $(this).data('id');
        console.log('Dealer ID:', dealerId);

        Swal.fire({
            title: 'Verify Dealer',
            text: 'Are you sure you want to verify this dealer?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1cc88a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, verify',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                verifyDealer(dealerId);
            }
        });
    });

    // Reject dealer button
    $(document).on('click', '.reject-dealer', function(e) {
        console.log('Reject dealer clicked');
        e.preventDefault();
        const dealerId = $(this).data('id');
        console.log('Dealer ID:', dealerId);

        Swal.fire({
            title: 'Reject Dealer',
            text: 'Please provide a reason for rejection:',
            input: 'textarea',
            inputPlaceholder: 'Enter rejection reason...',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Reject',
            inputValidator: (value) => {
                if (!value) {
                    return 'You need to provide a reason for rejection!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                rejectDealer(dealerId, result.value);
            }
        });
    });

    function getCsrfToken() {
    let name = 'XSRF-TOKEN=';
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
    // AJAX functions with error handling
    
    function verifyDealer(id) {
    const csrfToken = getCsrfToken();
    const metaToken = $('meta[name="csrf-token"]').attr('content');

    try {
        const response = $.ajax({
            url: `/admin/dealers/${id}/verify`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': metaToken,
                'X-XSRF-TOKEN': csrfToken
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-CSRF-TOKEN', metaToken);
                xhr.setRequestHeader('X-XSRF-TOKEN', csrfToken);
            }
        });
        toastr.success('Dealer verified successfully');
        return response;
    } catch (error) {
        console.error('Verification error:', error);
        toastr.error(error.responseJSON?.message || 'Error verifying dealer');
        throw error;
    }
}
    function rejectDealer(id, reason) {
        console.log('Rejecting dealer:', id, 'Reason:', reason);
        $.ajax({
            url: `/admin/dealers/${id}/reject`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                reason: reason
            },
            success: function(response) {
                console.log('Reject success:', response);
                toastr.success('Dealer rejected successfully');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Reject error:', error);
                toastr.error('Error rejecting dealer');
            }
        });
    }

    // Update your filter form HTML to use button type submit
    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        applyFilters();
    });
});
</script>
@endsection