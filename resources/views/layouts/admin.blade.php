<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .full-width-container {
            width: 99%;
            margin: 0;
            padding: 0;
        }

        .full-width-column {
            width: 99%;
        }

        .collapse .list-group-item {
            margin-left: 20px;
            color: blue;
        }

        .dashboard-overview {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .dashboard-overview .overview-item {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #ddd;
            margin-right: 10px;
            height: 50px;
            color: #fff;
        }

        .overview-item.bg-primary {
            background-color: #007bff;
        }

        .overview-item.bg-success {
            background-color: #28a745;
        }

        .overview-item.bg-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .overview-item.bg-danger {
            background-color: #dc3545;
        }

        .overview-label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Dashboard</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid full-width-container mt-5">
        <div class="dashboard-overview">
            <div class="overview-item bg-primary">
                <span class="overview-label">Total Users:</span>
                <span>{{ $totalUsers ?? 'N/A' }}</span>
            </div>
            <div class="overview-item bg-success">
                <span class="overview-label">Total Listings:</span>
                <span>{{ $totalListings ?? 'N/A' }}</span>
            </div>
            <div class="overview-item bg-warning">
                <span class="overview-label">Total Enquiries:</span>
                <span>{{ $totalEnquiries ?? 'N/A' }}</span>
            </div>
            <div class="overview-item bg-danger">
                <span class="overview-label">Total Reviews:</span>
                <span>{{ $totalReviews ?? 'N/A' }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#userManagement" class="list-group-item list-group-item-action" data-toggle="collapse">User Management</a>
                    <div class="collapse" id="userManagement">
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">View All Users</a>
                        <a href="{{ route('admin.users.create') }}" class="list-group-item list-group-item-action">Add New User</a>
                    </div>
                    <a href="#listingsManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Listings Management</a>
                    <div class="collapse" id="listingsManagement">
                        <a href="{{ route('admin.listings.index') }}" class="list-group-item list-group-item-action">View All Listings</a>
                        <a href="{{ route('admin.listings.create') }}" class="list-group-item list-group-item-action">Add New Listing</a>
                    </div>
                    <a href="#categoriesManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Categories Management</a>
                    <div class="collapse" id="categoriesManagement">
                        <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">View All Categories</a>
                        <a href="{{ route('admin.categories.create') }}" class="list-group-item list-group-item-action">Add New Category</a>
                    </div>
                    <a href="#vehiclesManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Vehicles Management</a>
                    <div class="collapse" id="vehiclesManagement">
                        <a href="{{ route('admin.vehicles.index') }}" class="list-group-item list-group-item-action">View All Vehicles</a>
                        <a href="{{ route('admin.vehicles.create') }}" class="list-group-item list-group-item-action">Add New Vehicle</a>
                    </div>
                    <a href="#newsManagement" class="list-group-item list-group-item-action" data-toggle="collapse">News Management</a>
    <div class="collapse" id="newsManagement">
        <a href="{{ route('admin.newsCategory.index') }}" class="list-group-item list-group-item-action">View All News Categories</a>
        <a href="{{ route('admin.newsCategory.create') }}" class="list-group-item list-group-item-action">Add New News Category</a>
        <a href="{{ route('admin.news.index') }}" class="list-group-item list-group-item-action">View All News</a>
        <a href="{{ route('admin.news.create') }}" class="list-group-item list-group-item-action">Add New News</a>
    </div>
                    <a href="#reviewsManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Reviews Management</a>
                    <div class="collapse" id="reviewsManagement">
                        <a href="{{ route('admin.reviews.index') }}" class="list-group-item list-group-item-action">View All Reviews</a>
                        <a href="{{ route('admin.reviews.create') }}" class="list-group-item list-group-item-action">Add New Review</a>
                    </div>
                    <a href="#serviceProvidersManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Service Providers Management</a>
                    <div class="collapse" id="serviceProvidersManagement">
                        <a href="{{ route('admin.serviceproviders.index') }}" class="list-group-item list-group-item-action">View All Service Providers</a>
                        <a href="{{ route('admin.serviceproviders.create') }}" class="list-group-item list-group-item-action">Add New Service Provider</a>
                    </div>
                    <a href="#toolsManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Tools Management</a>
                    <div class="collapse" id="toolsManagement">
                        <a href="{{ route('admin.tools.index') }}" class="list-group-item list-group-item-action">View All Tools</a>
                        <a href="{{ route('admin.tools.create') }}" class="list-group-item list-group-item-action">Add New Tool</a>
                    </div>
                    <a href="#transactionsManagement" class="list-group-item list-group-item-action" data-toggle="collapse">Transactions Management</a>
                    <div class="collapse" id="transactionsManagement">
                        <a href="{{ route('admin.transactions.index') }}" class="list-group-item list-group-item-action">View All Transactions</a>
                        <a href="{{ route('admin.transactions.create') }}" class="list-group-item list-group-item-action">Add New Transaction</a>
                    </div>
                    <a href="#reportsAnalytics" class="list-group-item list-group-item-action" data-toggle="collapse">Reports and Analytics</a>
                    <div class="collapse" id="reportsAnalytics">
                        <a href="{{ route('admin.reports.index') }}" class="list-group-item list-group-item-action">Generate Reports</a>
                        <a href="{{ route('admin.reports.analytics') }}" class="list-group-item list-group-item-action">View Analytics</a>
                    </div>
                </div>
            </div>
            <div class="col-md-9 full-width-column">
                <div id="adminContent">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        
    $(document).ready(function(){
      
        $('#vehicles-table').DataTable({
        paging: true,
        searching: true,
        info: true,
        autoWidth: false,
        responsive: true
    });

    $('#categories').DataTable({
        paging: true,
        searching: true,
        info: true,
        autoWidth: false,
        responsive: true
    });
    });

  
    function toggleCustomColorInput() {
    const colorSelect = document.getElementById('color');
    const customColorInput = document.getElementById('custom_color');
    if (colorSelect.value === 'Other') {
        customColorInput.style.display = 'block';
        customColorInput.required = true;
    } else {
        customColorInput.style.display = 'none';
        customColorInput.required = false;
    }
}

function toggleCustomEngineSizeInput() {
    const engineSizeSelect = document.getElementById('engine_size');
    const customEngineSizeInput = document.getElementById('custom_engine_size');
    if (engineSizeSelect.value === 'Other') {
        customEngineSizeInput.style.display = 'block';
        customEngineSizeInput.required = true;
    } else {
        customEngineSizeInput.style.display = 'none';
        customEngineSizeInput.required = false;
    }
}
$(document).ready(function() {
    $('#btnEditInfo').on('click', function() {
        $('#imageSlider').hide();
        $('#thumbnailImages').hide();
        $('#editInfoForm').show();
        $('#addImagesForm').hide();
        $('#addFeaturesForm').hide();
    });

    $('#btnAddImages').on('click', function() {
        $('#imageSlider').hide();
        $('#thumbnailImages').hide();
        $('#editInfoForm').hide();
        $('#addImagesForm').show();
        $('#addFeaturesForm').hide();
    });

    $('#btnAddFeatures').on('click', function() {
        $('#imageSlider').hide();
        $('#thumbnailImages').hide();
        $('#editInfoForm').hide();
        $('#addImagesForm').hide();
        $('#addFeaturesForm').show();
    });

    $('#btnRefresh').on('click', function() {
        location.reload();
    });
      $('#btnListIt').on('click', function() {
        @if(isset($vehicle))
                const vehicleId = {{ $vehicle->vehicle_id }};
            @else
                const vehicleId = null;
            @endif
        const action = $(this).text() === 'List It' ? 'list' : 'unlist';
        $.ajax({
            url: `/admin/vehicles/${vehicleId}/${action}`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'active') {
                    $('#btnListIt').text('Unlist');
                } else if (response.status === 'expired') {
                    $('#btnListIt').text('List It');
                }
                alert(response.message);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('#btnSold').on('click', function() {
        @if(isset($vehicle))
                const vehicleId = {{ $vehicle->vehicle_id }};
            @else
                const vehicleId = null;
            @endif
        $.ajax({
            url: `/admin/vehicles/${vehicleId}/sold`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('#images').on('change', function() {
        const files = this.files;
        $('#imagePreview').empty();
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').append('<img src="' + e.target.result + '" class="img-thumbnail" width="150">');
            }
            reader.readAsDataURL(files[i]);
        }
    });

    $('.clickable-image').on('click', function() {
        const slideTo = $(this).data('slide-to');
        $('#imageSlider').carousel(slideTo);
    });
});
    </script>



</body>
</html>
