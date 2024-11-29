<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Finance Cars</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            left: auto;
            right: 0;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0, 0, 0, 0.2); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #e0f7fa; /* Light blue-green background */
            margin: 15% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Could be more or less, depending on screen size */
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        #financeCalculator .form-group label {
            color: #00796b; /* Dark green text */
        }

        #financeCalculator .form-control, #financeCalculator .form-control-range {
            border: 1px solid #00796b; /* Dark green border */
            border-radius: 0.25rem;
        }

        #financeCalculator .btn-primary {
            background-color: #00796b; /* Dark green button */
            border-color: #00796b;
        }

        #monthlyPayment, #balloonPaymentInfo {
            font-size: 1.25rem;
            color: #004d40; /* Darker green text */
            font-weight: bold;
        }

        /* Ensure the navbar doesn't extend the page when collapsed */
        .navbar-collapse.collapsing {
            height: 80px;
            transition: height 0.3s ease;
        }

        .navbar-collapse.collapse.show {
            height: auto;
            transition: height 0.3s ease;
        }

        /* Style for the profile image */
        .navbar-nav .nav-link img.rounded-circle {
            border: 2px solid #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 768px) {
            .container {
                width: 98%; /* Adjust container width on smaller screens */
                padding: 1%;
            }

            body {
                font-size: 14px; /* Adjust base font size for smaller screens */
            }

            p {
                font-size: 0.9em;
            }

            .h5, h5 {
                font-size: 1rem;
            }

            h2, h3 {
                font-size: 1.3rem;
                text-align: center;
            }

            h4, h4 {
                font-size: 1.1rem;
            }

            .section-title {
                text-align: center;
            }
        }

        .offcanvas-menu {
        display: none; /* Hide by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: white;
        z-index: 1050;
        overflow-y: auto;
    }
    .offcanvas-menu.show {
        display: block; /* Show when toggled */
    }
    .navbar-collapse {
        display: none; /* Hide desktop menu by default */
    }
    @media (min-width: 992px) {
        .navbar-collapse {
            display: flex; /* Show desktop menu on larger screens */
        }
        .offcanvas-menu {
            display: none !important; /* Hide mobile menu on larger screens */
        }
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 30px;
        font-size: 30px;
        border:1px solid red;
        border-bottom: 100%;
        cursor: pointer;
        z-index: 1100; /* Ensure it is above other elements */
    }

    .nav-custom{
        height: 70px !important;
        background-color: white !important;
        color: black !important;
        text-align: center !important;
    }


    </style>
</head>
<body>



    <nav class="navbar navbar-expand-lg navbar-light bg-light nav-custom">
    <a class="navbar-brand" href="{{ url('/') }}">Fast Finance Cars</a>

    <button class="navbar-toggler" type="button" data-toggle="offcanvas" data-target="#mobileMenu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav"> 
      <ul class="navbar-nav mr-auto">
        
        <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="buyCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Buy a Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="buyCarDropdown">
                    <form id="searchForm" action="{{ route('cars.search') }}" method="GET">
                    <input type="text" class="hide" style="display:none" id="conditions" name="conditions" value="New" />

                    <button type="submit" class="dropdown-item" href="#">New Cars</button>

                    </form>


                    <form id="searchForm" action="{{ route('cars.search') }}" method="GET">
                    <input type="text" class="hide" style="display:none" id="conditions" name="conditions" value="Used" />

                    <button type="submit" class="dropdown-item" href="#">Used Cars</button>

                    </form>
                       
                        
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sellCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sell my Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="sellCarDropdown">
                        <a class="dropdown-item" href="{{ route('signup') }}">Sell Privately</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="valueCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Value my Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="valueCarDropdown">
                        <a class="dropdown-item" href="#">Car Valuation</a>
                        <a class="dropdown-item" href="#">Get an Offer</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Car Subscriptions</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="newsReviewsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        News & Reviews
                    </a>
                    <div class="dropdown-menu" aria-labelledby="newsReviewsDropdown">
                        <a class="dropdown-item" href="#">Latest News</a>
                        <a class="dropdown-item" href="#">Car Reviews</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="toolsServicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools & Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="toolsServicesDropdown">
                        <a class="dropdown-item" href="#" onclick="openModal()">Loan Calculator</a>
                        <a class="dropdown-item" href="#">Insurance Quotes</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route(name: 'login') }}">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('signup') }}">Sign Up</a>
                </li>
                @else
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('storage/'. Auth::user()->profile_image) }}" class="rounded-circle" alt="Profile Image" width="30" height="30">
                        {{ Auth::user()->name }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                        <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                        @if(Auth::user()->user_type == 'dealer')
                        <a class="dropdown-item" href="{{ route('dealer.dashboard') }}">Manage Dealership</a>
                        @elseif(Auth::user()->user_type == 'seller')
                        <a class="dropdown-item" href="{{ route('seller.listings') }}">Manage Your Listings</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

<div class="offcanvas-menu" id="mobileMenu">
    <span class="close-button" data-toggle="offcanvas" data-target="#mobileMenu">&times;</span>
    <div class="container">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#buyCarCollapse" role="button" aria-expanded="false" aria-controls="buyCarCollapse">
                    Buy a Car
                </a>
                <div class="collapse" id="buyCarCollapse">
                    <a class="dropdown-item" href="#">New Cars</a>
                    <a class="dropdown-item" href="#">Used Cars</a>
                    <a class="dropdown-item" href="#">Certified Pre-Owned</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#sellCarCollapse" role="button" aria-expanded="false" aria-controls="sellCarCollapse">
                    Sell my Car
                </a>
                <div class="collapse" id="sellCarCollapse">
                    <a class="dropdown-item" href="#">Sell Privately</a>
                    <a class="dropdown-item" href="#">Trade-In</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#valueCarCollapse" role="button" aria-expanded="false" aria-controls="valueCarCollapse">
                    Value my Car
                </a>
                <div class="collapse" id="valueCarCollapse">
                    <a class="dropdown-item" href="#">Car Valuation</a>
                    <a class="dropdown-item" href="#">Get an Offer</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Car Subscriptions</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#newsReviewsCollapse" role="button" aria-expanded="false" aria-controls="newsReviewsCollapse">
                    News & Reviews
                </a>
                <div class="collapse" id="newsReviewsCollapse">
                    <a class="dropdown-item" href="#">Latest News</a>
                    <a class="dropdown-item" href="#">Car Reviews</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#toolsServicesCollapse" role="button" aria-expanded="false" aria-controls="toolsServicesCollapse">
                    Tools & Services
                </a>
                <div class="collapse" id="toolsServicesCollapse">
                    <a class="dropdown-item" href="#" onclick="openModal()">Loan Calculator</a>
                    <a class="dropdown-item" href="#">Insurance Quotes</a>
                </div>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Sign In</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('signup') }}">Sign Up</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#accountCollapse" role="button" aria-expanded="false" aria-controls="accountCollapse">
                    <img src="{{ asset('storage/'. Auth::user()->profile_image) }}" class="rounded-circle" alt="Profile Image" width="30" height="30">
                    {{ Auth::user()->name }}
                </a>
                <div class="collapse" id="accountCollapse">
                    <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a>
                    <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                    @if(Auth::user()->user_type == 'dealer')
                    <a class="dropdown-item" href="{{ route('dealer.dashboard') }}">Manage Dealership</a>
                    @elseif(Auth::user()->user_type == 'seller')
                    <a class="dropdown-item" href="{{ route('seller.listings') }}">Manage Your Listings</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</div>


    <div class="Customcontainer">
        @yield('content')
    </div>
    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Search form submission
            $('#searchForm').on('submit', function(event) {
                event.preventDefault();
                window.location.href = $(this).attr('action') + '?' + $(this).serialize();
            });

            $('[data-toggle="offcanvas"]').on('click', function() {
        $('#mobileMenu').toggleClass('show');
        $('.navbar-toggler-icon').toggleClass('d-none');
        $('.navbar-collapse').toggleClass('d-none'); // Hide desktop menu when mobile menu is shown
    });

    // Ensure collapse elements are initialized properly
    $('.collapse').collapse();

            // Thumbnail image click
            $('.thumbnail').on('click', function() {
                $('#' + $(this).data('main-image-id')).attr('src', $(this).attr('src'));
            });

            // View car AJAX request
            $('.view-car').on('click', function() {
                $.ajax({
                    url: '{{ route("cars.view") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        car_id: $(this).data('car-id')
                    },
                    success: function(response) {
                        console.log('Car viewed:', response);
                    }
                });
            });

            // Initialize carousel
            $('.carousel').carousel();
        });

        // Related image click for carousel
        document.querySelectorAll('.related-image').forEach(image => {
            image.addEventListener('click', function() {
                document.querySelector('.carousel-item.active').classList.remove('active');
                document.querySelector(`.carousel-item:nth-child(${parseInt(this.dataset.slideTo) + 1})`).classList.add('active');
            });
        });

      
           
</script>

  
@yield('scripts')
</body>
</html>