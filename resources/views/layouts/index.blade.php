<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast Finance Cars</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />


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
/* Mobile-First Responsive Design */
@media (max-width: 768px) {
    /* Navbar Adjustments */
    .navbar-wrapper {
        padding: 5px 0;
    }

    .navbar {
        padding: 10px;
        flex-direction: column;
    }

    .navbar-brand {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .navbar-nav {
        width: 100%;
        flex-direction: column;
    }

    .nav-item {
        margin-bottom: 10px;
        width: 100%;
    }

    .nav-link {
        text-align: center;
        padding: 10px;
    }

    /* Dropdown Menus */
    .dropdown-menu {
        position: static;
        display: none;
        background-color: transparent;
        border: none;
        box-shadow: none;
        text-align: center;
    }

    .dropdown-item {
        color: #333;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .dropdown-toggle::after {
        margin-left: 5px;
    }

    /* Mobile Menu Offcanvas */
    .offcanvas-menu {
        width: 100%;
        background-color: white;
        z-index: 1050;
        padding: 20px;
        overflow-y: auto;
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 30px;
        cursor: pointer;
    }

    /* Chat Button and Box */
    #chat-button {
        bottom: 15px;
        left: 15px;
        width: 50px;
        height: 50px;
        font-size: 16px;
    }

    #chat-box {
        width: 90%;
        height: 70%;
        bottom: 10%;
        left: 5%;
        right: 5%;
    }

    #messages {
        height: 60%;
    }

    /* Form and Input Adjustments */
    .form-control {
        font-size: 14px;
        padding: 8px;
    }

    .btn {
        font-size: 14px;
        padding: 8px 12px;
    }

    /* Typography */
    body {
        font-size: 14px;
    }

    h1 { font-size: 1.8rem; }
    h2 { font-size: 1.6rem; }
    h3 { font-size: 1.4rem; }
    h4 { font-size: 1.2rem; }
    h5 { font-size: 1rem; }

    /* Container Adjustments */
    .container, .container-fluid {
        padding: 0 10px;
    }

    /* Profile and Authentication */
    .navbar-nav .nav-link img.rounded-circle {
        width: 25px;
        height: 25px;
    }

    /* Guest Info and Chat */
    .guest-info input {
        width: 100%;
        margin: 5px 0;
    }

    .guest-info button {
        width: 100%;
    }

    /* Responsive Images */
    img {
        max-width: 100%;
        height: auto;
    }
}

/* Ultra Small Devices */
@media (max-width: 480px) {
    .navbar-brand {
        font-size: 1.3rem;
    }

    #chat-box {
        width: 95%;
        left: 2.5%;
        right: 2.5%;
    }

    .message {
        max-width: 90%;
    }
}

/* Landscape Orientation */
@media (max-width: 768px) and (orientation: landscape) {
    #chat-box {
        height: 80%;
    }

    #messages {
        height: 70%;
    }
}
    </style>

</head>
<body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Load Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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



@media screen and (max-width: 991px) {
    :root {
        --primary-coral: #FF7F50;
        --dark-coral: #FF6340;
        --light-coral: #FFB5A0;
        --text-dark: #2C3E50;
        --text-light: #ECF0F1;
        --background-light: #FFFFFF;
        --background-dark: #2C3E50;
        --border-color: #E5E5E5;
    }

    .offcanvas-menu {
        position: fixed;
        top: 0;
        left: -100%;
        width: 85%;
        max-width: 320px;
        height: 100vh;
        background: linear-gradient(135deg, var(--background-dark) 0%, #34495E 100%);
        z-index: 1050;
        overflow-y: auto;
        transition: left 0.3s ease-in-out;
        box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
        font-family: 'Poppins', sans-serif;
    }

    .offcanvas-menu.show {
        left: 0;
    }

    .close-button {
        position: absolute;
        right: 15px;
        top: 15px;
        font-size: 28px;
        cursor: pointer;
        z-index: 1051;
        color: var(--text-light);
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }

    .close-button:hover {
        background-color: rgba(255, 255, 255, 0.2);
        transform: rotate(90deg);
    }

    .offcanvas-menu .container {
        padding: 25px 20px;
    }

    .offcanvas-menu .navbar-nav {
        width: 100%;
        margin-top: 20px;
    }

    .offcanvas-menu .nav-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        margin: 5px 0;
    }

    .offcanvas-menu .nav-link {
        padding: 15px 0;
        color: var(--text-light);
        font-size: 16px;
        font-weight: 500;
        letter-spacing: 0.3px;
        transition: all 0.3s ease;
    }

    .offcanvas-menu .nav-link:hover {
        color: var(--primary-coral);
        padding-left: 10px;
    }

    .offcanvas-menu .dropdown-toggle::after {
        float: right;
        margin-top: 8px;
        color: var(--primary-coral);
    }

    .offcanvas-menu .dropdown-menu {
        position: static !important;
        transform: none !important;
        padding: 0;
        margin: 0;
        border: none;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        margin: 5px 0;
    }

    .offcanvas-menu .dropdown-item {
        padding: 12px 25px;
        color: var(--text-light);
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .offcanvas-menu .dropdown-item:active,
    .offcanvas-menu .dropdown-item:hover {
        background-color: var(--primary-coral);
        color: var(--text-light);
        border-radius: 4px;
        margin: 0 5px;
    }

    .offcanvas-menu .navbar-nav.ml-auto {
        margin-top: 30px;
        border-top: 2px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
    }

    .offcanvas-menu .rounded-circle {
        margin-right: 10px;
        border: 2px solid var(--primary-coral);
    }

    .offcanvas-menu form {
        margin: 0;
    }

    .offcanvas-menu .dropdown-item button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 25px;
        color: var(--text-light);
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .offcanvas-menu .dropdown-item button:hover {
        color: var(--text-light);
        background-color: var(--primary-coral);
    }

    .offcanvas-menu .dropdown-menu {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .offcanvas-menu .dropdown-menu.show {
        display: block;
        opacity: 1;
    }

    /* User profile section styling */
    .offcanvas-menu .user-profile {
        display: flex;
        align-items: center;
        padding: 15px;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        margin-bottom: 20px;
    }

    .offcanvas-menu .user-profile img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 15px;
    }

    /* Menu overlay */
    .menu-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 1040;
        opacity: 0;
        transition: opacity 0.3s ease;
        backdrop-filter: blur(4px);
    }

    .menu-overlay.show {
        display: block;
        opacity: 1;
    }

    /* Custom scrollbar */
    .offcanvas-menu::-webkit-scrollbar {
        width: 5px;
    }

    .offcanvas-menu::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .offcanvas-menu::-webkit-scrollbar-thumb {
        background: var(--primary-coral);
        border-radius: 10px;
    }

    .offcanvas-menu .dropdown-menu {
        position: static !important;
        transform: none !important;
        padding: 0;
        margin: 0;
        border: none;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        margin: 5px 0;
        /* Remove display: none from here */
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-out;
    }

    /* When dropdown is active */
    .offcanvas-menu .dropdown-menu.show {
        max-height: 500px; /* Adjust this value based on your content */
        transition: max-height 0.3s ease-in;
    }

    .offcanvas-menu .dropdown-item {
        padding: 12px 25px;
        color: var(--text-light);
        font-size: 15px;
        transition: all 0.3s ease;
        opacity: 1; /* Ensure items are visible */
    }

    /* Style for the dropdown toggle arrow */
    .offcanvas-menu .dropdown-toggle::after {
        float: right;
        margin-top: 8px;
        transition: transform 0.3s ease;
    }

    /* Rotate arrow when dropdown is open */
    .offcanvas-menu .dropdown-toggle[aria-expanded="true"]::after {
        transform: rotate(180deg);
    }

    /* Ensure buttons within dropdowns are visible */
    .offcanvas-menu .dropdown-item button {
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        padding: 12px 25px;
        color: var(--text-light);
        font-size: 15px;
        transition: all 0.3s ease;
        opacity: 1;
    }

    
}

/* Specific adjustments for smaller mobile devices */
@media screen and (max-width: 768px) {
    .offcanvas-menu {
        width: 90%;
    }
    
    .offcanvas-menu .nav-link {
        font-size: 15px;
    }
    
    .offcanvas-menu .dropdown-item {
        font-size: 14px;
    }
}

/* Hide mobile menu on larger screens */
@media screen and (min-width: 992px) {
    .offcanvas-menu, .menu-overlay {
        display: none;
    }
}


@media screen and (max-width: 991px) {
    .containerHeaderMenu {
        display: flex;
        justify-content: space-evenly;
        padding: 15px 20px;
        background-color: #ffffff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        align-content: center;
        flex-wrap: nowrap;
        flex-direction: row-reverse;
    }

    /* Brand/Logo Column */
    .containerHeaderMenu .name {
        flex: 1;
    }

    .containerHeaderMenu .navbar-brand {
        color: #FF7F50; /* coral color */
        font-size: 1.5rem;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        text-decoration: none;
        margin: 0;
        padding: 0;
    }

    /* Toggle Button Column */
    .containerHeaderMenu .tooglemenu {
        display: flex;
        justify-content: flex-end;
        align-items: center;
    }

    .containerHeaderMenu .navbar-toggler {
        padding: 0;
        border: none;
        background: transparent;
        cursor: pointer;
        outline: none;
    }

    /* Custom Hamburger Icon */
    .containerHeaderMenu .navbar-toggler-icon {
        display: block;
        width: 24px;
        height: 2px;
        background-color: #FF7F50; /* coral color */
        position: relative;
        transition: all 0.3s ease;
    }

    .containerHeaderMenu .navbar-toggler-icon::before,
    .containerHeaderMenu .navbar-toggler-icon::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 2px;
        background-color: #FF7F50; /* coral color */
        transition: all 0.3s ease;
    }

    .containerHeaderMenu .navbar-toggler-icon::before {
        top: -6px;
    }

    .containerHeaderMenu .navbar-toggler-icon::after {
        bottom: -6px;
    }

    /* Animation for hamburger icon when menu is open */
    .containerHeaderMenu .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
        background-color: transparent;
    }

    .containerHeaderMenu .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
        transform: rotate(45deg);
        top: 0;
    }

    .containerHeaderMenu .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
        transform: rotate(-45deg);
        bottom: 0;
    }

    /* Add some spacing below header for content */
    body {
        padding-top: 60px; /* Adjust this value based on your header height */
    }
}

/* For very small devices */
@media screen and (max-width: 375px) {
    .containerHeaderMenu .navbar-brand {
        font-size: 1.2rem;
    }

    .containerHeaderMenu {
        padding: 12px 15px;
    }
}

/* Optional: Add a transition for smooth scroll when header is fixed */
@media screen and (max-width: 991px) {
    html {
        scroll-behavior: smooth;
    }
}
</style>
@if(Auth::check())
        <meta name="user-id" content="{{ Auth::id() }}">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Navbar wrapped in a div -->
<div class="navbar-wrapper">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="containerHeaderMenu row">
          <div class="name col">
          <a class="navbar-brand" href="{{ url('/') }}">Fast Finance Cars</a>

          </div>  

          <div class="tooglemenu col">
          <button class="navbar-toggler w-100 h-100" type="button" data-toggle="offcanvas" data-target="#mobileMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
          </div>

        </div>
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
                <a href="{{ route('feeds.index') }}" class="nav-link">Car Media</a>
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
                <l class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="toolsServicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools & Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="toolsServicesDropdown">
                    <a class="dropdown-item"  href="{{ route('financeCalculator') }}">Car Finance Calculator</a>
                    <a class="dropdown-item"  href="{{ route('finance') }}">Car Finance</a>
                    <a class="dropdown-item" href="{{ route(name: 'affordability') }}">Calculate Affordability</a>

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
                <a href="{{ route('feeds.index') }}" class="nav-link">Car Media</a>
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
                <l class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="toolsServicesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tools & Services
                    </a>
                    <div class="dropdown-menu" aria-labelledby="toolsServicesDropdown">
                    <a class="dropdown-item"  href="{{ route('financeCalculator') }}">Car Finance Calculator</a>
                    <a class="dropdown-item"  href="{{ route('finance') }}">Car Finance</a>
                    <a class="dropdown-item" href="{{ route(name: 'affordability') }}">Calculate Affordability</a>

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

      
          
          
          document.addEventListener('DOMContentLoaded', function() {
    // Toggle menu
    const toggleButtons = document.querySelectorAll('[data-toggle="offcanvas"]');
    const menu = document.getElementById('mobileMenu');


    // Handle dropdowns
    const dropdownToggles = document.querySelectorAll('.nav-item.dropdown .dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Close all other dropdowns
            dropdownToggles.forEach(otherToggle => {
                if (otherToggle !== toggle) {
                    const otherMenu = otherToggle.nextElementSibling;
                    otherToggle.setAttribute('aria-expanded', 'false');
                    if (otherMenu) {
                        otherMenu.classList.remove('show');
                    }
                }
            });

            // Toggle current dropdown
            const dropdownMenu = this.nextElementSibling;
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            this.setAttribute('aria-expanded', !isExpanded);
            dropdownMenu.classList.toggle('show');
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown')) {
            dropdownToggles.forEach(toggle => {
                toggle.setAttribute('aria-expanded', 'false');
                if (toggle.nextElementSibling) {
                    toggle.nextElementSibling.classList.remove('show');
                }
            });
        }
    });
});


</script>

  
@yield('scripts')



</body>

</html>