<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    
    <!-- Custom CSS -->
    <style>
        /* General Styling */
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        body {
            overflow: hidden; /* Prevent body scrolling */
        }
        .container{width: 80%;margin-top:20px;}
        .container-fluid {
            width: 90%;
            margin-top: 20px;
        }
        /* Navbar Styling */
        .navbar {
            background-color: #2c3e50 !important;
            padding: 0.5rem 1rem;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar .nav-link {
            color: #ecf0f1 !important;
        }

        .navbar .navbar-text {
            color: #ecf0f1;
            font-size: 1rem;
        }

        .navbar .navbar-text span {
            margin-left: 10px;
        }

        /* Sidebar Styling */
        #sidebarMenu {
            position: fixed;
            top: 56px; /* Height of navbar */
            bottom: 0;
            left: 0;
            width: 20%;
            overflow-y: auto;
            background-color: #34495e;
            padding-top: 1rem;

        }

        .sidebar .nav-link,
        .sidebar .list-group-item {
            color: #ecf0f1;
        }

        .sidebar .nav-link .fas,
        .sidebar .list-group-item .fas {
            margin-right: 10px;
        }
        #sidebar ul li a {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .sidebar .nav-link:hover,
        .sidebar .list-group-item:hover {
            background-color: #3b5998;
            color: #fff;
        }

        .sidebar .collapse .list-group-item {
            margin-left: 20px;
            background-color: #2c3e50;
        }
        .nav-item{
            margin-bottom: 10px;
            border: 1px solid #2c3e50;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            &:hover {
                background-color: #3b5998;
            }
            .fas {
                margin-right: 5px;
            }
            .badge {
                margin-left: auto;
            }
            .badge.badge-danger {
                background-color: #e74c3c;
            }
            .badge.badge-success {
                background-color: #2ecc71;
            }

        }
        /* Main Content Styling */
        main {
            margin-left: 250px; /* Same as sidebar width */
            padding: 20px;
            overflow-y: auto;
            height: calc(100vh - 56px); /* Adjust for navbar height */
            background-color: #ecf0f1;
            width: 80%;
        }
        #content {
            width: calc(100% - 240px);
            margin-left: 240px;
        }
        #sidebar.active + #content {
            width: 100%;
            margin-left: 0;
        }
        /* Adjustments for smaller screens */
        @media (max-width: 768px) {
            #sidebarMenu {
                width: 100%;
                height: auto;
                position: relative;
                top: 0;
            }

            main {
                margin-left: 0;
            }
        }

        .list-group-item{
            display: block !important;
            width: 90% !important;
        }

        .collapse-inner {
    padding: 0.5rem 0;
    margin: 0 0.5rem;
    border-radius: 0.35rem;
    background-color: #fff;
}

.collapse-item {
    display: block;
    padding: 0.5rem 1rem;
    margin: 0 0.5rem;
    color: #3a3b45;
    text-decoration: none;
    border-radius: 0.35rem;
    white-space: nowrap;
}

.collapse-item:hover {
    background-color: #eaecf4;
    text-decoration: none;
}

.collapse-item.active {
    color: #4e73df;
    font-weight: 600;
    background-color: #eaecf4;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    color: #3a3b45;
}

.nav-link i {
    margin-right: 0.5rem;
}

.nav-link .fa-angle-down {
    margin-left: auto;
    transition: transform 0.2s;
}

.nav-link[aria-expanded="true"] .fa-angle-down {
    transform: rotate(180deg);
}
    </style>

    @yield('styles') <!-- For additional page-specific styles -->
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="#">
            <i class="fas fa-car"></i> Admin Dashboard
        </a>

        <!-- Toggler for Mobile View -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content -->
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <!-- Left Side Empty or Add Links Here -->
        </div>

        <!-- Right Side -->
        <div class="navbar-text ml-auto d-none d-lg-block">
            Welcome, {{ Auth::user()->name ?? 'Admin' }} 
            <span id="currentDateTime"></span>
        </div>

        <!-- Logout Link -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <!-- Logout Form -->
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>
    <button type="button" id="sidebarCollapse" class="btn">
    <i class="fas fa-bars"></i>
</button>
    <!-- Sidebar -->
    <nav id="sidebarMenu" class="sidebar">
    <div class="sidebar-sticky pt-3">
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item">
            <a href="{{ route('admin.dashboard.AIdashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard.AIdashboard') ? 'active' : '' }}">                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- User Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" 
                   href="#userManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.users.*') ? 'true' : 'false' }}">
                    <i class="fas fa-users"></i>
                    <span>User Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.users.*') ? 'show' : '' }}" id="userManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.users.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View All Users
                        </a>
                        <a href="{{ route('admin.users.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.users.create') ? 'active' : '' }}">
                            <i class="fas fa-user-plus"></i> Add New User
                        </a>
                    </div>
                </div>
            </li>

            <!-- Chats Management -->
            <li class="nav-item">
                <a href="{{ route('admin.chats.index') }}" 
                   class="nav-link {{ request()->routeIs('admin.chats.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Chats Management</span>
                </a>
            </li>

            <!-- Dealer Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dealers.*') ? 'active' : '' }}" 
                   href="#dealerManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.dealers.*') ? 'true' : 'false' }}">
                    <i class="fas fa-store"></i>
                    <span>Dealer Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.dealers.*') ? 'show' : '' }}" id="dealerManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.dealers.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.dealers.index') ? 'active' : '' }}">
                            <i class="fas fa-list"></i> All Dealers
                        </a>
                        <a href="{{ route('admin.dealers.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.dealers.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add New Dealer
                        </a>
                 
                        <a href="{{ route('admin.dealers.createverify') }}" 
                           class="collapse-item {{ request()->routeIs('admin.dealers.createverify') ? 'active' : '' }}">
                            <i class="fas fa-check-circle"></i> Pending Verifications
                        </a>
                        <a href="{{ route('admin.dealers.reports') }}" 
                           class="collapse-item {{ request()->routeIs('admin.dealers.reports') ? 'active' : '' }}">
                            <i class="fas fa-chart-bar"></i> Dealer Reports
                        </a>
                    </div>
                </div>
            </li>

            <!-- Categories Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" 
                   href="#categoriesManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.categories.*') ? 'true' : 'false' }}">
                    <i class="fas fa-list-alt"></i>
                    <span>Categories Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.categories.*') ? 'show' : '' }}" id="categoriesManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.categories.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View All Categories
                        </a>
                        <a href="{{ route('admin.categories.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.categories.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add New Category
                        </a>
                    </div>
                </div>
            </li>

            <!-- Vehicles Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.vehicles.*') ? 'active' : '' }}" 
                   href="#vehiclesManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.vehicles.*') ? 'true' : 'false' }}">
                    <i class="fas fa-car"></i>
                    <span>Vehicles Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.vehicles.*') ? 'show' : '' }}" id="vehiclesManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.vehicles.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.vehicles.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View All Vehicles
                        </a>
                        <a href="{{ route('admin.vehicles.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.vehicles.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add New Vehicle
                        </a>
                    </div>
                </div>
            </li>

            <!-- News Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.news.*') || request()->routeIs('admin.newsCategory.*') ? 'active' : '' }}" 
                   href="#newsManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.news.*') || request()->routeIs('admin.newsCategory.*') ? 'true' : 'false' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>News Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.news.*') || request()->routeIs('admin.newsCategory.*') ? 'show' : '' }}" 
                     id="newsManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.newsCategory.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.newsCategory.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View News Categories
                        </a>
                        <a href="{{ route('admin.newsCategory.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.newsCategory.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add News Category
                        </a>
                        <a href="{{ route('admin.news.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.news.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View All News
                        </a>
                        <a href="{{ route('admin.news.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.news.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add New News
                        </a>
                    </div>
                </div>
            </li>

            <!-- Reviews Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}" 
                   href="#reviewsManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.reviews.*') ? 'true' : 'false' }}">
                    <i class="fas fa-star"></i>
                    <span>Reviews Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.reviews.*') ? 'show' : '' }}" id="reviewsManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.reviews.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.reviews.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View All Reviews
                        </a>
                        <a href="{{ route('admin.reviews.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.reviews.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add New Review
                        </a>
                    </div>
                </div>
            </li>

            <!-- Service Providers Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.serviceproviders.*') ? 'active' : '' }}" 
                   href="#serviceProvidersManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.serviceproviders.*') ? 'true' : 'false' }}">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Service Providers</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.serviceproviders.*') ? 'show' : '' }}" 
                     id="serviceProvidersManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.serviceproviders.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.serviceproviders.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View Providers
                        </a>
                        <a href="{{ route('admin.serviceproviders.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.serviceproviders.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add Provider
                        </a>
                    </div>
                </div>
            </li>

            <!-- Tools Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.tools.*') ? 'active' : '' }}" 
                   href="#toolsManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.tools.*') ? 'true' : 'false' }}">
                    <i class="fas fa-wrench"></i>
                    <span>Tools Management</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.tools.*') ? 'show' : '' }}" id="toolsManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.tools.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.tools.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View All Tools
                        </a>
                        <a href="{{ route('admin.tools.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.tools.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add New Tool
                        </a>
                    </div>
                </div>
            </li>

            <!-- Transactions Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.transactions.*') ? 'active' : '' }}" 
                   href="#transactionsManagement" 
                   data-toggle="collapse" 
                   aria-expanded="{{ request()->routeIs('admin.transactions.*') ? 'true' : 'false' }}">
                    <i class="fas fa-exchange-alt"></i>
                    <span>Transactions</span>
                    <i class="fas fa-angle-down float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('admin.transactions.*') ? 'show' : '' }}" 
                     id="transactionsManagement">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a href="{{ route('admin.transactions.index') }}" 
                           class="collapse-item {{ request()->routeIs('admin.transactions.index') ? 'active' : '' }}">
                            <i class="fas fa-eye"></i> View Transactions
                        </a>
                        <a href="{{ route('admin.transactions.create') }}" 
                           class="collapse-item {{ request()->routeIs('admin.transactions.create') ? 'active' : '' }}">
                            <i class="fas fa-plus"></i> Add Transaction
                        </a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>

    <!-- Main Content -->
    <main role="main">
        @yield('content')
    </main>

    <!-- JavaScript Libraries -->
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Function to update date and time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long', year: 'numeric', month: 'long',
                day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric'
            };
            const dateTimeString = now.toLocaleDateString('en-US', options);
            document.getElementById('currentDateTime').textContent = " | " + dateTimeString;
        }

        // Update date and time every second
        setInterval(updateDateTime, 1000);
        updateDateTime(); // Initial call
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
        // Initialize DataTables
        $(document).ready(function() {
            // Vehicles Table
  

            // Categories Table
            $('#categories').DataTable({
                paging: true,
                searching: true,
                info: true,
                autoWidth: false,
                responsive: true
            });

            // Other custom scripts can be added here
        });

        // Toggle custom color input
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

        // Toggle custom engine size input
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

        // Additional custom scripts...

        // Button actions (Edit, Add Images, etc.)
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

            // List/Unlist button action
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

            // Mark as Sold button action
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

            // Image preview on file select
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

            // Clickable thumbnail images
            $('.clickable-image').on('click', function() {
                const slideTo = $(this).data('slide-to');
                $('#imageSlider').carousel(slideTo);
            });
        });
    </script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/admin/dashboard.js') }}"></script>
    @yield('scripts') <!-- For additional page-specific scripts -->

</body>
</html>