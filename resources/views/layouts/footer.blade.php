<footer class="bg-light text-dark mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-3 col-6 mb-4">
                <h5>About Us</h5>
                <ul class="list-unstyled">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Frequently Asked Questions</a></li>
                    <li><a href="#">Industry Reports</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5>Dealers</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Manage</a></li>
                    <li><a href="#">Products & Offers</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5>Other Vehicles</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Used & New Cars</a></li>
                    <li><a href="#">Bikes</a></li>
                    <li><a href="#">Trucks, Tractors, Vans & More</a></li>
                    <li><a href="#">Boats & Caravans</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-6 mb-4">
                <h5>Services</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Car Finance Calculator</a></li>
                    <li><a href="#">Car Finance</a></li>
                    <li><a href="#">Car Insurance</a></li>
                    <li><a href="#">K53 Help Guides</a></li>
                </ul>
            </div>
        </div>
        <div class="row mt-4" style="background-color: #b22222; height: 200px;">
            <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-center">
                <h5 class="text-white">Register for Newsletters</h5>
                <form class="newsletter-form w-75">
                    <input type="email" class="form-control mb-2" placeholder="Enter your email" required>
                    <button type="submit" class="btn btn-primary w-100">Subscribe</button>
                </form>
            </div>
            <div class="col-md-6 col-12 d-flex flex-column justify-content-center align-items-center">
                <h5 class="text-white">Affordability Calculator</h5>
                <a href="{{ route('affordability') }}" class="btn btn-primary w-75">Calculate Affordability</a>
            </div>
        </div>
    </div>
    <div class="bg-dark text-white text-center py-2">
        <p>© 2024 Fast Finance Cars. All rights reserved.</p>
    </div>
</footer>

<style>
    footer {
        background-color: #b22222; /* Firebrick red */
        color: white;
        font-family: 'Helvetica Neue', sans-serif;
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
        background-color: #b22222;
        color: white;
    }
    .newsletter-form button {
        border-radius: 8px;
        background-color: blue;
        color: white;
    }
    @media (max-width: 767px) {
        footer .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
</style>
