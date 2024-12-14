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




    /* Chat button fixed at the bottom-left corner */
    #chat-button {
        position: fixed;
        bottom: 20px;
        left: 20px;
        background-color: #ff4500; /* Orange color */
        color: white;
        border: none;
        padding: 15px;
        cursor: pointer;
        border-radius: 50%;
        z-index: 9999; /* Make sure the button is always on top */
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Chat box container with subtle gradient background */
    #chat-box {
        display: none;
        position: fixed;
        bottom: 80px;
        left: 20px;
        width: 350px;
        height: 450px;
        background-color: #ff4500; /* Orange color */
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 9999; /* Ensures it's on top of everything */
        overflow-y: scroll-y;
    }

    /* Display the chat box when open */
    #chat-box.open {
        display: block;
    }

    /* Message container with scrollable content */
    #messages {
        height: 280px;
        overflow-y: auto;
        margin-bottom: 15px;
        padding-right: 10px;
    }

    /* Input field for typing messages */
    #message-input {
        width: 100%;
        padding: 10px;
        margin-top: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        margin-bottom: 10px;
    }

    /* Send button */
    #send-button {
        background-color: #2196f3; /* Lighter Blue */
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
        margin-top: 10px;
        width: 100%;
    }

    /* Header of the chat box with user icon */
    .chat-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 20px;
    }

    .chat-header img {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .chat-header h5 {
        margin: 0;
        font-size: 18px;
        color: white;
    }

    /* Container for user info (name and email input) */
    .guest-info {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;

        position: relative;
        bottom: 100px;
    }

    .guest-info input {
        width: 90%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .guest-info button {
        background-color: #ff5722; /* Coral */
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        border-radius: 5px;
        width: 100%;
        margin-top: 10px;
    }

    #chat-box {
    border: 1px solid #ccc;
    width: 300px;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
    border-radius: 8px;
    position: fixed;
    bottom: 20px;
    right: 20px;
    display: none;
    flex-direction: column;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

#chat-box.open {
    display: flex;
}

.chat-header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    border-radius: 8px 8px 0 0;
    display: flex;
    align-items: center;
}

.chat-header h5 {
    margin: 0 0 0 10px;
    font-size: 16px;
}

#messages {
    padding: 10px;
    overflow-y: auto;
    max-height: 200px;
    flex-grow: 1;
}

.chat-message {
    background-color: #e6e6e6;
    margin-bottom: 5px;
    padding: 8px;
    border-radius: 5px;
}

#message-input,
#guest-info input {
    width: 90%;
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

#send-button,
#register-button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 8px 16px;
    border-radius: 5px;
    cursor: pointer;
}

#send-button:hover,
#register-button:hover {
    background-color: #444;
}
#close-button {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    float:right !important; 
}

#close-button:hover {
    color: #ff4500; /* Highlight color on hover */
}

.text-chat-header{
    font-size: 24px;
    font-weight: bold;
    color: white !important;
}

.message-status {
    margin-left: 10px;
    color: green;
    font-weight: bold;
}

    </style>

</head>
<body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.js"></script>
<style>
    /* Wrapper for the entire navigation bar */
    .navbar-wrapper {
        background: linear-gradient(135deg, #ff4e50, #ff6a00); /* Red to orange gradient for a vibrant, automotive feel */
        padding: 10px 0;
    }

    /* Navbar styling */
    .navbar {
        padding: 10px 50px;
        font-size: 16px;
        font-family: 'Arial', sans-serif;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-light .navbar-nav .nav-link {
        color: white !important; /* White text color for the links */
        padding: 10px 20px;
    }

    /* Hover effects for nav links */
    .navbar-light .navbar-nav .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 5px;
    }

    .navbar-light .navbar-nav .nav-item.dropdown:hover > .dropdown-menu {
        display: block;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Navbar brand/logo */
    .navbar-brand {
        font-size: 1.8rem;
        color: white;
        font-weight: bold;
    }

    .navbar-brand:hover {
        color: #fff;
        text-decoration: none;
    }

    /* Navbar dropdown */
    .dropdown-menu {
        background-color: #ffffff;
        border: none;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
    }

    .dropdown-item {
        font-size: 14px;
        padding: 12px 20px;
        color: #333;
    }

    .dropdown-item:hover {
        background-color: #f7f7f7;
        color: #007bff;
    }

    /* Navbar toggle button for mobile */
    .navbar-toggler-icon {
        background-color: white;
    }

    /* Profile image and account dropdown */
    .nav-item img {
        border-radius: 50%;
        margin-right: 8px;
    }

    .nav-item .dropdown-menu a {
        font-size: 14px;
        padding: 8px 12px;
    }

    /* Button background color */


    .btn:hover {
        background-color: #ff4e50;
    }
.message {
    margin: 10px 0;
    padding: 10px;
    border-radius: 5px;
    max-width: 80%;
    word-wrap: break-word;
}

.user-message {
    background-color: #007bff; /* Blue */
    color: white;
    text-align: left;
    margin-left: auto;
}

.admin-message {
    background-color: #f1f1f1; /* Light gray */
    color: #333;
    text-align: left;
    margin-right: auto;
}
/* General message styles */
.message {
    padding: 10px;
    margin: 5px 0;
    max-width: 60%;
    border-radius: 10px;
    word-wrap: break-word;
    display: inline-block;
}

/* Admin messages */
.admin-message {
    background-color: #e6f7ff;
    color: #00529b;
    align-self: flex-start;
    text-align: left;
    border: 1px solid #b3d4fc;
    border-radius: 10px 10px 10px 0; /* Rounded corners */
}

/* Guest messages */
.guest-message {
    background-color: #f1f1f1;
    color: #333;
    align-self: flex-end;
    text-align: right;
    border: 1px solid #ccc;
    border-radius: 10px 10px 0 10px; /* Rounded corners */
}

/* Messages container */
#messages {
    display: flex;
    flex-direction: column;
    gap: 5px;
    padding: 10px;
    overflow-y: auto;
    max-height: 400px;
}

</style>
@if(Auth::check())
        <meta name="user-id" content="{{ Auth::id() }}">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Navbar wrapped in a div -->
<div class="navbar-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="{{ url('/') }}">Fast Finance Cars</a>

        <button class="navbar-toggler" type="button" data-toggle="offcanvas" data-target="#mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <!-- Buy a Car Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="buyCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Buy a Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="buyCarDropdown">
                        <form id="searchFormN" action="{{ route('cars.search') }}" method="GET">
                            <input type="text" class="hide" style="display:none" id="conditions" name="conditions" value="New" />
                            <button type="submit" class="dropdown-item">New Cars</button>
                        </form>

                        <form id="searchFormN" action="{{ route('cars.search') }}" method="GET">
                            <input type="text" class="hide" style="display:none" id="conditions" name="conditions" value="Used" />
                            <button type="submit" class="dropdown-item">Used Cars</button>
                        </form>
                    </div>
                </li>

                <!-- Sell my Car Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="sellCarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Sell my Car
                    </a>
                    <div class="dropdown-menu" aria-labelledby="sellCarDropdown">
                        <a class="dropdown-item" href="{{ route('privateSellerGuide') }}">Sell Privately</a>
                        <a class="dropdown-item" href="{{ route('DealerSellerGuide') }}">As a Dealer</a>

                    </div>
                </li>

                <!-- Value my Car Dropdown -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dealerships.index') }}" id="valueCarDropdown">
                        Dealerships

                    </a>
                    
                </li>

                <!-- CSubscriptions -->
                <li class="nav-item">
                    <a class="nav-link" href="#">Car Subscriptions</a>
                </li>

                <!-- News & Reviews Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="newsReviewsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        News & Reviews
                    </a>
                    <div class="dropdown-menu" aria-labelledby="newsReviewsDropdown">
                    <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value=2 />
                <button class="dropdown-item"  type="submit" > Car Reviews</button>
               </form>
               <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value=3 />
                <button class="dropdown-item" type="submit" > Finances Articles </button>
               </form>
               <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value=1 />
                <button class="dropdown-item" type="submit"> Blogs articles</button>
               </form>
                    </div>
                </li>

                <!-- Tools & Services Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="toolsServicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools & Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="toolsServicesDropdown">
                    <a class="dropdown-item"  href="{{ route('financeCalculator') }}">Car Finance Calculator</a>
                    <a class="dropdown-item"  href="{{ route('finance') }}">Car Finance</a>

                    <a class="dropdown-item" href="#">Insurance Quotes</a>
                    </div>
                </li>
            </ul>

            <!-- Authentication Links -->
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Sign In</a>
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
    </nav>
</div>


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

                <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value=2 />
                <button type="submit" class="dropdown-item"> Car Reviews</button>
               </form>
               <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value=3 />
                <button type="submit" cclass="dropdown-item"> Finances Articles </button>
               </form>
               <form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
                <input type="hidden" name="category" value=1 />
                <button type="submit" class="dropdown-item"> Blogs articles</button>
               </form>
                 
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#toolsServicesCollapse" role="button" aria-expanded="false" aria-controls="toolsServicesCollapse">
                    Tools & Services
                </a>
                <div class="collapse" id="toolsServicesCollapse">
                <a class="dropdown-item"  href="{{ route('financeCalculator') }}">Car Finance Calculator</a>
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
    <button id="chat-button">💬</button>

    <div class="CustomcontainerChat">
<div id="chat-box">
    <div class="row  chat-header">
        <div class="col-2">
        <i class="fa fa-user" aria-hidden="true"></i>

        </div>
        <div class="col-md-8">
    <!-- Placeholder for user icon -->
        <h5 class="text-chat-header">Chat with Us</h5>
        </div>
   <div class="col-md-2">
   <button id="close-button" onclick="hideChatMessage()">×</button> <!-- Close button -->

   </div>

    </div>
    <div id="messages"></div>
    <div class="guest-info" id="guest-info">
        <input type="text" id="guest-name" placeholder="Enter your name">
        <input type="email" id="guest-email" placeholder="Enter your email">
        <button id="register-button">Start Chat</button>
    </div>
    <div class="row">
        <div class="col-md-8">
        <textarea type="text" id="message-input" placeholder="Type your message..." style="display:none;"></textarea>

        </div>
        <div clas="col-md-4">
        <button id="send-button" style="display:none;">Send</button>

        </div>
    </div>
</div>
</div>
    @include('layouts.footer')


    <script>

        function hideChatMessage(){
            $(".CustomcontainerChat").hide();
        }
    let guestId = localStorage.getItem('guestId');
    let guestAlias = localStorage.getItem('guestAlias');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('DOMContentLoaded', () => {
    const chatButton = document.getElementById('chat-button');
    const chatBox = document.getElementById('chat-box');
    const closeButton = document.getElementById('close-button');
    const messageInput = document.getElementById('message-input');
    const sendButton = document.getElementById('send-button');
    const messagesContainer = document.getElementById('messages');
    const guestInfo = document.getElementById('guest-info');
    const registerButton = document.getElementById('register-button');
    const guestNameInput = document.getElementById('guest-name');
    const guestEmailInput = document.getElementById('guest-email');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let guestId = localStorage.getItem('guestId');
    let guestAlias = localStorage.getItem('guestAlias');

    // Hide the guest info form and show chat input if guestId exists
    if (guestId) {
        guestInfo.style.display = 'none';
        messageInput.style.display = 'block';
        sendButton.style.display = 'block';
    }

    chatButton.addEventListener('click', () => {
        $(".CustomcontainerChat").show();
        chatBox.classList.toggle('open');
        if (chatBox.classList.contains('open') && guestId) {
            loadMessages();
        } else if (!guestId) {
            guestInfo.style.display = 'block';
            messageInput.style.display = 'none';
            sendButton.style.display = 'none';
        }
    });

    closeButton.addEventListener('click', () => {
        chatBox.classList.remove('open');
    });

    registerButton.addEventListener('click', () => {
        const name = guestNameInput.value.trim();
        const email = guestEmailInput.value.trim();

        if (name && email) {
            registerGuest(name, email);
        } else {
            alert('Please enter both your name and email.');
        }
    });

    sendButton.addEventListener('click', () => {
        const message = messageInput.value.trim();
        if (message) {
            sendMessageToServer(message);
            messageInput.value = '';
        }
    });
});

function displayMessage(messageObj) {
    const messagesContainer = document.getElementById('messages');

    // Avoid duplicate messages
    if (document.querySelector(`[data-message-id="${messageObj.id}"]`)) {
        return;
    }

    const messageElement = document.createElement('div');
    const isAdmin = messageObj.is_admin === 1;

    messageElement.className = isAdmin ? 'message admin-message' : 'message guest-message';
    messageElement.setAttribute('data-message-id', messageObj.id); // Assign unique ID
    messageElement.textContent = messageObj.message;

    messagesContainer.appendChild(messageElement);
    messagesContainer.scrollTop = messagesContainer.scrollHeight; // Auto-scroll
}

// Define the async function to send messages
async function sendMessageToServer(message) {
    try {
        console.log('Sending message:', message);
        const response = await fetch('/guest-chat-messages', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({
                message: message,
                guest_id: guestId,
                guest_alias: guestAlias,
            }),
        });

        if (!response.ok) {
            const error = await response.text();
            throw new Error(error);
        }

        const result = await response.json();
        console.log('Message saved:', result);

        if (result.status === 'success') {
            // Update the message status to show double ticks
            updateMessageStatus(result.data.id, '✓✓');
        }
    } catch (error) {
        console.error('Error sending message to server:', error);
    }
}

function updateMessageStatus(messageId, status) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    if (messageElement) {
        const statusElement = document.createElement('span');
        statusElement.className = 'message-status';
        statusElement.textContent = status;
        messageElement.appendChild(statusElement);
    }
}

async function loadMessages() {
    try {
        const response = await fetch(`/guest-chat-messages?guest_id=${guestId}`);
        if (!response.ok) {
            const error = await response.text();
            throw new Error(error);
        }

        const messages = await response.json();
        const messagesContainer = document.getElementById('messages');
        messagesContainer.innerHTML = ''; // Clear the container before reloading

        // Append each message
        messages.forEach(displayMessage);
    } catch (error) {
        console.error('Error loading messages:', error);
    }
}

// Polling for new messages every 5 seconds
setInterval(async () => {
    try {
        const response = await fetch(`/guest-chat-messages?guest_id=${guestId}`);
        if (!response.ok) {
            throw new Error('Failed to fetch messages');
        }

        const messages = await response.json();
        const messagesContainer = document.getElementById('messages');
        const existingMessages = Array.from(messagesContainer.children).map(
            (el) => el.getAttribute('data-message-id')
        );

        // Add only new messages
        messages.forEach((msg) => {
            if (!existingMessages.includes(msg.id.toString())) {
                displayMessage(msg);
            }
        });
    } catch (error) {
        console.error('Error fetching messages:', error);
    }
}, 5000);

function registerGuest(name, email) {
    fetch('/registerguest', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ name, email }),
    })
        .then(response => response.json())
        .then(data => {
            guestId = data.guest_id;
            localStorage.setItem('guestId', guestId);
            localStorage.setItem('guestAlias', name);

            // Hide guest info form and show chat input
            guestInfo.style.display = 'none';
            messageInput.style.display = 'block';
            sendButton.style.display = 'block';

            loadMessages();
        })
        .catch(error => console.error('Error registering guest:', error));
}

        $(document).ready(function() {
            // Search form submission
            $('#searchFormN').on('submit', function(event) {
                event.preventDefault();
                window.location.href = $(this).attr('action') + '?' + $(this).serialize();
            });

            $('[data-toggle="offcanvas"]').on('click', function() {
        $('#mobileMenu').toggleClass('show');
        $('.navbar-toggler-icon').toggleClass('d-none');
        $('.navbar-collapse').toggleClass('d-none'); // Hide desktop menu when mobile menu is shown
    });

    // Ensure collapse elements are initialized properly
    //$('.collapse').collapse();

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