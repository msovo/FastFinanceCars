<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
        body {
            font-family: sans-serif;
        }

        .dropdown-menu {
            left: auto;
            right: 0;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px; 
            z-index: 100;
            padding: 60px 20px 0;
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
            background: linear-gradient(to bottom, #f5f5f5, #e0e0e0);
            border-radius: 10px;
            transition: transform 0.3s ease-in-out; 
        }

        .sidebar .nav-link {
            color: #333;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background-color: #ddd;
            color: #007bff;
        }

        .navbar {
            border-radius: 10px;
            position: relative;
            z-index: 101; 
        }

        .main-content {
            padding: 20px;
            margin-left: 250px; 
            transition: margin-left 0.3s ease-in-out; 
        }

        .menu-toggler {
            display: none;
            margin: 10px 0;
            z-index: 102; 
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); 
            z-index: 99; 
            display: none;
            transition: opacity 0.3s ease-in-out; 
        }
        .close{
        display: none;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 100%; 
                transform: translateX(-100%); 
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0; 
            }

            .sidebar.open + .main-content {
                margin-left: 70%; 
            }

            .menu-toggler {
                display: block;
            }

            .overlay.show {
                display: block;
                opacity: 1; 
            }

            .overlay {
                opacity: 0; 
            }

            .close{
                display:block;
            position: absolute;
            top: 59px;
            right: 50%;
            font-size: 30px;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            border-radius: 100%;
            border: 2px solid red;
        }
        }

        .btnmenuvisible {
            z-index: 99999;
        }
        
        
    </style>
</head>
<body>
    @include('partials.navbar')
    <button class="menu-toggler btn btn-primary btnmenuvisible w-100" type="button" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle sidebar">
       Here for Management options
    </button>
    <div class="container-fluid">
        <div class="row">
            <div class="overlay"></div>
            <nav class="col-md-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <button type="button" class="close close-sidebar" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.dashboard') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.manage.sales') }}">Manage Sales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.manage.leads') }}">Manage Leads</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.add.cars') }}">Add Cars</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('vehicles.manage') }}">Manage Cars</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.manage.listings') }}">Manage Listings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.news.management') }}">News Management</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dealer.manage.dealership') }}">Manage Dealership</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 main-content">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.close-sidebar').on('click', function() {
                $('.sidebar').toggleClass('open'); 
                $('.overlay').toggleClass('show'); 
            });

            $('.menu-toggler').on('click', function() {
                $('.sidebar').toggleClass('open');
                $('.overlay').toggleClass('show');
            });
        });
    </script>
    @yield('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>