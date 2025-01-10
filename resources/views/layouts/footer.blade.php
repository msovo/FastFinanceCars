<footer class="bg-gradient mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3 col-6 mb-4">
                <h5>About Us</h5>
                <ul class="list-unstyled">
                    <li><a class="dropdown-item" href="#">About Us</a></li>
                    <li><a class="dropdown-item" class="dropdown-item" href="{{ route('faq') }}">Frequently Asked Questions</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5>Dealers</h5>
                <ul class="list-unstyled">
                    @auth
                    <li><a class="dropdown-item" href="{{ route('dealer.dashboard') }}">Manage Dealership</a></li>
                    @else
                    <li><a class="dropdown-item" href="{{ route('login') }}">Manage Dealership</a></li>
                    @endauth
                    <li><a class="dropdown-item" href="{{ route('products') }}">Products and Services</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5>Other Vehicles</h5>
                <ul class="list-unstyled">
                    <!-- Vehicle search forms for different body types -->
                    @foreach (['Hatchback', 'Coupe', 'Trucks', 'Sedan', 'Cabriolet'] as $body_type)
                    <li>
                        <form id="searchForm" action="{{ route('cars.search') }}" method="GET">
                            <input type="text" class="hide" style="display:none" id="body_typefooter" name="body_typefooter" value="{{ $body_type }}" />
                            <button type="submit" class="dropdown-item">{{ $body_type }}</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>


            <div class="col-md-3 col-6 mb-4">
                <h5>Services</h5>
                <ul class="list-unstyled">
                    <li><a class="dropdown-item"  href="{{ route('financeCalculator') }}">Car Finance Calculator</a></li>
                    <li><a class="dropdown-item" href="{{ route(name: 'affordability') }}">Calculate Affordability</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-4" style="background-color: #ff6600; height: 200px;"> <!-- Orange background -->
            <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-center">
                <h5 class="text-white">Register for Newsletters</h5>
                <form class="newsletter-form w-75">
                    <input type="email" class="form-control mb-2" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-dark w-100">Subscribe</button>
                </form>
            </div>
            <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-center">
                <h5 class="text-white">Affordability Calculator</h5>
                <a href="{{ route('affordability') }}" class="btn btn-dark w-75">Calculate Affordability</a>
            </div>
        </div>
    </div>
    <div class="bg-dark text-white text-center py-2">
        <p>© 2024 Fast Finance Cars. All rights reserved.</p>
    </div>
</footer>

<style>
    footer {
        background: gainsboro; /* Gradient mix of dark blue, red, and orange */
        color: black;
        font-family: 'Helvetica Neue', sans-serif;
        border: 2px; solid coral;
    }
    footer h5 {
        font-weight: bold;
    }
    footer a {
        text-decoration: none;
        color: inherit;
    }
    footer a:hover {
        text-decoration: underline;
    }
    footer .col-6 {
        border-radius: 8px;
        padding: 10px;
    }
    .newsletter-form input {
        border-radius: 8px;
        border: 1px solid white;
        background-color: #003366; /* Dark blue for form input */
        color: white;
    }
    .newsletter-form button {
        border-radius: 8px;
        background-color: #b22222; /* Red for subscribe button */
        color: white;
    }
    .btn-dark {
        background-color: #333; /* Dark color for buttons */
        border: none;
        color: white;
    }
    .btn-dark:hover {
        background-color: #444; /* Slightly lighter dark for hover */
    }
    @media (max-width: 767px) {
        footer .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
</style>
