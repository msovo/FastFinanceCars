@extends('layouts.index')

@section('content')
<style type="text/css">
    body{
        background:gainsboro;
    }
 .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        height: 200px; /* Adjust the height as needed */
    }
    .main-image-container img {
        width: 100%;
        height: auto;
    }
    .carousel-thumbnails {
        display: flex;
        overflow-x: auto;
        margin-top: 10px;
    }
    .carousel-thumbnails img {
        max-height: 150px;
        cursor: pointer;
    }
    .image-count {
        position: absolute;
        bottom: 20px; /* Adjusted to be 20px from the bottom */
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px;
        border-radius: 3px;
    }
    .car-details ul {
        list-style: none;
        padding: 0;
    }
    .car-details ul li {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
    }
    .car-details .specs {
        display: flex;
        flex-wrap: wrap;
    }
    .car-details .specs div {
        flex: 1 1 33%;
        display: flex;
        align-items: center;
    }
    .car-details .specs div i {
        margin-right: 5px;
    }
    .car-details .features {
        display: flex;
        flex-wrap: wrap;
    }
    .car-details .features li {
        flex: 1 1 33%;
        display: flex;
        align-items: center;
    }
    .car-details .features li i {
        margin-right: 5px;
    }
.card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        height: 200px; /* Adjust the height as needed */
    }
    .main-image-container img {
        width: 100%;
        height: auto;
    }
    .card-body {
        flex: 1;
    }
    .thumbnails {
        margin-top: 10px;
    }
    .thumbnail-image {
        height: auto;
    }
    .image-count {
        position: absolute;
        bottom: 20px; /* Adjusted to be 20px from the bottom */
        left: 0;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px;
        border-radius: 3px;
    }
.cardimg {
    height: 300px;
    overflow: hidden;
}

.main-image {
    width: 100%;
    height: auto;
}

.additional-images {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin-top: 10px;
    height: 100px;
    overflow: hidden;

}

.thumbnail-img {
    cursor: pointer;
    margin-bottom: 5px;
    max-height: 100px; /* Ensure thumbnails do not exceed a certain height */
    object-fit: cover; /* Ensure thumbnails fit within the specified height */
}

.card-body {
    background-color: white; /* Remove red background */
}

.card-text strong {
    color: red;
}


#financeCalculator {
      background-color: #ffffff;
      padding: 20px;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #financeCalculator .form-group {
      margin-bottom: 15px;
    }

    #financeCalculator .form-group label {
      color: #495057;
      font-weight: bold;
    }

    #financeCalculator .form-control,
    #financeCalculator .form-control-range {
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
    }

    #financeCalculator .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      color: #fff;
      font-weight: bold;
    }

    #paymentInfo {
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 20px;
      margin-top: 30px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #paymentInfo h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    .output-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      border-bottom: 1px solid #dee2e6;
    }

    .output-row:last-child {
      border-bottom: none;
    }

    .output-row span {
      font-weight: bold;
    }

    .disclaimer {
      font-size: 12px;
      color: #6c757d;
      margin-top: 20px;
      text-align: center;
    }
.car-details-mobile{
    display: none;
}
@media (max-width: 768px) { 
    .section-title{
        text-align: center;
    }
    .car-details-mobile{
    display: block;
}
    .car-details-pc{
        display: none;
    }

    .social-share {
      display: flex;
      gap: 15px;
      justify-content: center;
      margin: 20px;
    }
    .social-share a {
      text-decoration: none;
      color: white;
      padding: 12px;
      border-radius: 50%;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      width: 50px;
      height: 50px;
      transition: transform 0.2s ease, background-color 0.3s ease;
    }
    .social-share a:hover {
      transform: scale(1.1);
    }
    .social-share .whatsapp { background-color: #25D366; padding:4px; }
    .social-share .facebook { background-color: #3b5998; padding:4px ;}
    .social-share .x { background-color: #1da1f2; }
    .social-share .instagram { background: linear-gradient(45deg, #f58529, #dd2a7b, #8134af, #515bd4);padding:4px ; }
  
}
#paymentInfo {
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
      width: 300px;
      margin: auto;
    }
    #paymentInfo h3 {
      text-align: center;
      color: #343a40;
    }
    .output-row {
      display: flex;
      justify-content: space-between;
      padding: 10px 0;
      font-size: 16px;
      border-bottom: 1px solid #dee2e6;
    }
    .output-row:last-child {
      border-bottom: none;
    }
    .disclaimer {
      font-size: 12px;
      color: #6c757d;
      margin-top: 20px;
    }

    .recently-viewed-scroll {
    display: flex;
    overflow-x: auto;
    gap: 16px;
    padding: 10px;
    scroll-behavior: smooth;
}

.recently-viewed-scroll::-webkit-scrollbar {
    height: 5px;
    background: transparent;
}

.recently-viewed-scroll::-webkit-scrollbar-thumb {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 10px;
}

.car-card {
    flex: 0 0 auto;
    width: 200px;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.car-card .image-container {
    width: 100%;
    height: 120px;
    overflow: hidden;
}

.car-card .image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.car-card .details {
    padding: 10px;
}

.car-card .details h5 {
    font-size: 14px;
    margin: 0 0 5px;
}

.car-card .details p {
    font-size: 12px;
    margin: 0;
    color: #555;
}
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
    font-family: Arial, sans-serif;
}

.page-item {
    margin: 0 5px;
}

.page-item a,
.page-item span {
    display: inline-block;
    padding: 10px 15px;
    text-decoration: none;
    border: 1px solid #ddd;
    border-radius: 4px;
    color: #007bff;
    transition: all 0.2s ease;
}

.page-item.active span {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item a:hover {
    background-color: #007bff;
    color: white;
    border-color: #007bff;
}

.page-item.disabled span {
    color: #ccc;
    pointer-events: none;
}
.custom-card-body {
    padding: 20px;
    margin-bottom: 10px;
}

.custom-card-body h4 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
}

.custom-card-body .badge-primary {
    background-color: #007bff;
    color: #fff;
    font-size: 0.9rem;
    margin-left: 10px;
}

.custom-card-body .img-fluid {
    border: 2px solid #ddd;
    padding: 5px;
    background-color: #fff;
}


.card:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.card-title {
    font-size: 1.25rem;
}

.card-text-dealer {
    font-size: 0.7rem;
    color: black;
}

</style>
<div class="container mt-5">
    <div class="card row">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    </div>
    <div class="custom-card-body">
    <div class="row align-items-center">
        <div class="col-md" >
            <h4>
                Supplied By {{ $listing->dealer->dealership_name }}
                @if($listing->dealer->verified)
                    <span class="badge badge-primary">
                        <i class="fas fa-check-circle"></i> Verified
                    </span>
                @endif
            </h4>
        </div>
        <div class="col-md" style="float:left">
            <img src="{{ asset('storage/' . $listing->dealer->logo) }}" alt="Dealership Logo" class="img-fluid rounded-circle" style="max-width: 100px;">
        </div>
    </div>
</div>
    <div class="row">
    <div class="col-md-8">
        <h4>
            <i class="fas fa-calendar-alt"></i> {{ $car->year }} &nbsp; 
            {{ $car->car_brand->name }} {{ $car->car_model->name }} {{ $car->variant->name }}
        </h4>
        <h5 class="price">
             R{{ number_format($car->price, 2) }} &nbsp;
            <span class="text-danger">R{{ number_format(calculateMonthlyPayment($car->price), 2) }} p/m</span>
        </h5>
        <div id="imageSlider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" style="max-height:700px;overflow:hidden;">
                @foreach($car->images as $image)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="carousel-thumbnails mt-3">
            @foreach($car->images as $image)
                <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail clickable-image" data-target="#imageSlider" data-slide-to="{{ $loop->index }}" alt="...">
            @endforeach
        </div>
    </div>

 
    <div class="col-md-4" style=" background:white;border-radius:8px;">
    <h3>Interested in this car?</h3>
    <p><span class="btn-danger">{{ $listing->dealer->dealership_name }}</span> would love to hear from you, so please complete this form and we'll get in touch.</p>
<div class="dealership-contact mt-3 w-100" style="border-radius:5px; text-align:center; background-color: white; color:blue; padding-top:5px;">
    <p>Contact: <span id="dealership-contact">{{ substr($listing->dealer->contact, 0, 4) }}****</span> 
    <button id="show-contact-btn" onclick="showContact()" class="btn btn-outline-dark">Show Number</button></p>
    <div id="contact-methods" style="display: none;">
        <p>Select a method to contact the dealer:</p>
        <a href="tel:{{ $listing->dealer->contact }}" class="btn btn-outline-primary">
            <i class="fas fa-phone"></i> Call
        </a>
        <a href="https://api.whatsapp.com/send?phone={{ $listing->dealer->contact }}&text=Hi, I am interested in this car: {{ route('cars.show', $listing->vehicle->vehicle_id) }}" class="btn btn-outline-success">
            <i class="fab fa-whatsapp"></i> WhatsApp
        </a>
    </div>
</div>

    <form action="{{ route('inquiries.store') }}" method="POST">
        @csrf
        @guest
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
        @else
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->username }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}" readonly>
            </div>
            <input type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
            <input type="hidden" name="dealername" value="{{$listing->dealer->dealership_name }}">
            <input type="hidden" name="dealercontact" value="{{ $listing->dealer->contact }}">

            
        @endguest
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required>Hi. I am contacting you regarding this vehicle, I would like to know more about the process.</textarea>
        </div>
        <input type="hidden" name="listing_id" value="{{ $listing_id }}">
        <div class="row form-group">
            <div class="col"> <label class="col-sm-2 control-label">Subscribe</label></div>
            <div class="col"> <label for="car-alert">Car alert</label>
                <input type="checkbox" name="car-alert" id="car-alert"/>
            </div>
            <div class="col"> <label for="car-news">Car News</label>
                <input type="checkbox" name="car-news" id="car-news"/>
            </div>
        </div>
        <button type="submit" class="btn btn-primary w-100">Submit Inquiry</button>
        <br/>
        <button type="button" class="btn btn-outline-success w-100" onclick="window.location.href='https://api.whatsapp.com/send?phone={{ $listing->dealer->contact }}&text=Hi, I am interested in this car: {{ route('cars.show', $listing->vehicle->vehicle_id) }}'">WhatsApp Dealer</button>
        <p>By submitting your contact to the dealer you accept our terms and conditions and policy rules</p>
    </form>
    <div class="row" style="text-align:center">
        <div class="col" style="text-align:right;">Share</div>
        <div class="social-share col" style="text-align:left">
            <a class="whatsapp" href="https://api.whatsapp.com/send?text=Check%20this%20out, affordable cars available :%20{{ route('cars.show', $listing->vehicle->vehicle_id) }}" target="_blank">
                <i class="fab fa-whatsapp btn-outline-success" style="font-size:22px;"></i>
            </a>
            <a class="facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ route('cars.show', $listing->vehicle->vehicle_id) }}" target="_blank">
                <i class="fab fa-facebook-f btn-outline-primary" style="font-size:22px;"></i>
            </a>
            <a class="x" href="https://twitter.com/intent/tweet?url={{ route('cars.show', $listing->vehicle->vehicle_id) }}" target="_blank">
                <i class="fab fa-x-twitter btn-outline-dark" style="font-size:22px;"></i>
            </a>
            <a class="instagram" href="https://www.instagram.com/" target="_blank">
                <i class="fab fa-instagram btn-outline-danger" style="font-size:22px;"></i>
            </a>
        </div>
    </div>
    <div class="dealership-contact mt-3">
        <p>Address: {{ $listing->dealer->address }}, {{ $listing->dealer->city_town }}, {{ $listing->dealer->province }}</p>
    </div>
</div>
    <div class="col-md-4 car-details-mobile">
        <div class="car-details">
            <div class="specs">
                <div>
                    <i class="fas fa-tachometer-alt"></i> {{ $car->mileage }} km
                </div>
                <div>
                    <i class="fas fa-cogs"></i> {{ $car->transmission }}
                </div>
                <div>
                    <i class="fas fa-gas-pump"></i> {{ $car->fuel_type }}
                </div>
                <div>
                    <i class="fas fa-palette"></i> {{ $car->color }}
                </div>
                <div>
                    <i class="fas fa-car"></i> {{ ucfirst($car->car_condition) }}
                </div>
                <div>
                    <i class="fas fa-car-side"></i> {{ $car->body_type }}
                </div>
                <div>
                    <i class="fas fa-cube"></i> {{ $car->engine_size }}
                </div>
            </div>
            <div class="description mt-3">
                <h6><i class="fas fa-info-circle"></i> Description</h6>
                <p>{{ $car->description }}</p>
            </div>
            <h6><i class="fas fa-list"></i> Features</h6>
            <div class="features mt-3">
                <ul class="features">
                    @foreach($car->features as $feature)
                        <li>
                            <i class="fas fa-check"></i> {{ $feature->feature }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="col-md-10 car-details-pc">
        <div class="car-details">
            <div class="specs">
                <div>
                    <i class="fas fa-tachometer-alt"></i> {{ $car->mileage }} km
                </div>
                <div>
                    <i class="fas fa-cogs"></i> {{ $car->transmission }}
                </div>
                <div>
                    <i class="fas fa-gas-pump"></i> {{ $car->fuel_type }}
                </div>
                <div>
                    <i class="fas fa-palette"></i> {{ $car->color }}
                </div>
                <div>
                    <i class="fas fa-car"></i> {{ ucfirst($car->car_condition) }}
                </div>
                <div>
                    <i class="fas fa-car-side"></i> {{ $car->body_type }}
                </div>
                <div>
                    <i class="fas fa-cube"></i> {{ $car->engine_size }}
                </div>
            </div>
            <div class="description mt-3">
                <h6><i class="fas fa-info-circle"></i> Description</h6>
                <p>{{ $car->description }}</p>
            </div>
            <h6><i class="fas fa-list"></i> Features</h6>
            <div class="features mt-3">
                <ul class="features">
                    @foreach($car->features as $feature)
                        <li>
                            <i class="fas fa-check"></i> {{ $feature->feature }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>


        <!-- Row 1: Finance Calculator -->
        <div class="row mt-4">
        <!-- Column 1: Finance Form -->
        <div class="col-md-6">
            <form id="financeCalculator" class="bg-light p-4 rounded shadow-sm">
                <h4 class="text-primary">Finance Calculator</h4>
                <div class="form-group">
                    <label for="price">Car Price</label>
                    <input oninput="calculatePayment()" type="number" class="form-control" id="price" name="price" value={{$car->price}} required>
                </div>
                <div class="form-group">
                    <label for="deposit">Deposit Amount</label>
                    <input oninput="calculatePayment()"  type="number" class="form-control" id="deposit" name="deposit" value="0" required>
                </div>
                <div class="form-group">
                    <label for="tradeInValue">Trade-In Value</label>
                    <input oninput="calculatePayment()"  type="number" class="form-control" id="tradeInValue" name="tradeInValue" value="0">
                </div>
                <div class="form-group">
                    <label for="interestRate">Interest Rate (%)</label>
                    <input onchange="calculatePayment()"  type="range" class="form-control-range" id="interestRate" name="interestRate" min="9" max="20" value="13.75" oninput="updateInterestRateValue(this.value)">
                    <span id="interestRateValue">15%</span>
                </div>
                <div class="form-group">
                    <label for="loanTerm">Loan Term (months)</label>
                    <input onchange="calculatePayment()"  type="range" class="form-control-range" id="loanTerm" name="loanTerm" min="45" max="90" value="72" step="3" oninput="updateLoanTermValue(this.value)">
                    <span id="loanTermValue">60 months</span>
                </div>
                <div class="form-group">
                    <label for="balloonPayment">Balloon Payment (%)</label>
                    <input onchange="calculatePayment()"  type="range" class="form-control-range" id="balloonPayment" name="balloonPayment" min="0" max="50" value="0" oninput="updateBalloonPaymentValue(this.value)">
                    <span id="balloonPaymentValue">0%</span>
                </div>
            </form>
        </div>

        <!-- Column 2: Results Section -->
        <div class="col-md-6 card mt-4">
            <div class="card-header bg-dark text-white">
                <h5 class="card-title">Payment Summary</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <table  class="table table-dark table-bordered w-100" style="color:white">
                       <tr> <td>Monthly Payment: </td> <td id="monthlyPayment">R0.00</td></tr>
                       <tr>   <td>Total Loan Value: </td> <td id="totalLoanValue">R0.00</td></tr>
                       <tr>  <td>Total Interest: </td> <td  id="totalInterest">R0.00</td></tr>
                   
                       <tr>  <td>Total Payment: </td> <td  id="totalPayment">R0.00</td></tr>
                       <tr>  <td>Balloon Payment Due: </td> <td id="balloonPaymentDue">R0.00</td></tr>
                       <tr>  <td>Trade-In Value: </td> <td id="tradeInValueCal">R0.00</td></tr>
                    </table>
                </div>
            </div>
            <p class="mt-3 text-muted">
                <strong>Note:</strong> The loan and trade-in calculations provided are estimates. Actual values may vary depending on financial providers. It is advisable to consult financial institutions for precise values. Use the car filter above to find vehicles within the calculated loan range.
            </p>
        </div>
    </div>

  <!-- Graph Section -->
  <div class="row mt-5">
        <div class="col-12">
            <div class="p-4 bg-light rounded shadow-sm">
                <h4>Payment Over Time & Predicted Depreciation</h4>
                <canvas id="paymentGraph" height="100"></canvas>
            </div>
        </div>
    </div>

   
</div>
 
    </div>


<div class="container mt-5">
    <div class="row">
  

    <div class="col-md-3">
    <!-- Search, Sort, and Filter Form -->

  
        <div class="card-header bg-primary text-white">
            <h5 class="text-center m-0">Discover Cars From {{ $listing->dealer->dealership_name }}</h5>
        </div>
        <div class="card-body">
            @foreach($dealershipCars as $dcar)
                <div class="card mb-3 border-0 shadow-sm" 
                     onclick="location.href='{{ route('cars.show', $dcar->vehicle_id) }}';" 
                     style="cursor: pointer; transition: transform 0.2s;">
                    <img src="{{ asset('storage/' . $dcar->vehicle->images->first()->image_url) }}" 
                         class="card-img-top rounded-top" 
                         alt="Car Image" 
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold">{{ $dcar->vehicle->name }}</h5>
                        <p class="card-text mb-2"><strong>Price:</strong> R{{ $dcar->vehicle->price }}</p>
                        <p class="card-text mb-2"><strong>Model:</strong> {{ $dcar->vehicle->model }}</p>
                        <p class="card-text mb-2"><strong>Year:</strong> {{ $dcar->vehicle->year }}</p>
                        <p class="card-text mb-2"><strong>Mileage:</strong> {{ number_format($dcar->vehicle->mileage) }} km</p>
                        <p class="card-text"><strong>Condition:</strong> {{ $dcar->vehicle->car_condition }}</p>
                    </div>
                </div>
            @endforeach
        </div>
   
</div>

        <!-- Main Content Area -->
        <div class="col-md-9">
    <div class="mt-5" id="sponsored-cars-section">
        <h3>Featured and Sponsored Cars</h3>
        <div class="row">
            @foreach($featuredCars as $listing)
                <div class="col-md-4">
                    <div class="card" onclick="location.href='{{ route('cars.show', $listing->vehicle->vehicle_id) }}';" style="cursor: pointer;">
                        @if($listing->vehicle->images->isNotEmpty())
                            <div class="main-image-container">
                                <img src="{{ asset('storage/' . $listing->vehicle->images->first()->image_url) }}" class="card-img-top main-image" alt="{{ $listing->vehicle->make }} {{ $listing->vehicle->model }}">
                                <span class="image-count">
                                    <i class="fas fa-camera"></i> {{ $listing->vehicle->images->count() }}
                                </span>
                            </div>
                        @else
                            <div class="main-image-container">
                                <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image">
                            </div>
                        @endif
                        <div class="row thumbnails">
                            @foreach($listing->vehicle->images->slice(1, 3) as $image)
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail thumbnail-image" alt="{{ $listing->vehicle->make }} {{ $listing->vehicle->model }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-calendar-alt"></i> {{ $listing->vehicle->year }} &nbsp; 
                                {{ $listing->vehicle->make }} {{ $listing->vehicle->model }}
                            </h5>
                            <p class="card-text">
                                <i class="fas fa-money-bill-wave"></i> R{{ number_format($listing->vehicle->price, 2) }} &nbsp;
                            </p>
                            <p class="card-text text-danger">
                                R{{ calculateMonthlyPayment($listing->vehicle->price) }} p/m 
                                <span class="badge" style="background-color: {{ $listing->vehicle->condition == 'used' ? 'red' : 'blue' }};">
                                    {{ ucfirst($listing->vehicle->condition) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($sponsoredCars as $listing)
                <div class="col-md-4">
                    <div class="card" onclick="location.href='{{ route('cars.show', $listing->vehicle->vehicle_id) }}';" style="cursor: pointer;">
                        @if($listing->vehicle->images->isNotEmpty())
                            <div class="main-image-container">
                                <img src="{{ asset('storage/' . $listing->vehicle->images->first()->image_url) }}" class="card-img-top main-image" alt="{{ $listing->vehicle->make }} {{ $listing->vehicle->model }}">
                                <span class="image-count">
                                    <i class="fas fa-camera"></i> {{ $listing->vehicle->images->count() }}
                                </span>
                            </div>
                        @else
                            <div class="main-image-container">
                                <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image">
                            </div>
                        @endif
                        <div class="row thumbnails">
                            @foreach($listing->vehicle->images->slice(1, 3) as $image)
                                <div class="col-4">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail thumbnail-image" alt="{{ $listing->vehicle->make }} {{ $listing->vehicle->model }}">
                                </div>
                            @endforeach
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-calendar-alt"></i> {{ $listing->vehicle->year }} &nbsp; 
                                {{ $listing->vehicle->make }} {{ $listing->vehicle->model }}
                            </h5>
                            <p class="card-text">
                                <i class="fas fa-money-bill-wave"></i> R{{ number_format($listing->vehicle->price, 2) }} &nbsp;
                            </p>
                            <p class="card-text text-danger">
                                R{{ calculateMonthlyPayment($listing->vehicle->price) }} p/m 
                                <span class="badge" style="background-color: {{ $listing->vehicle->car_condition == 'used' ? 'red' : 'blue' }};">
                                    {{ ucfirst($listing->vehicle->car_condition) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrapper">
    {{ $sponsoredCars->links('pagination::bootstrap-4') }}
</div>
<p class="text-muted" style="text-align:center">
    Showing {{ $sponsoredCars->firstItem() }} to {{ $sponsoredCars->lastItem() }} of {{ $sponsoredCars->total() }} results
</p>
    </div>

    <div class="recently-viewed mt-5">
    <h3>Recently Viewed</h3>
    <div id="recently-viewed-container" class="recently-viewed-scroll">
        <!-- JavaScript will populate cars here -->
    </div>
</div>

@if($news && $news->count() > 0)
    <div class="mt-5">
        <h3>Related News</h3>
        @foreach($news as $article)
            @if(isset($article->id, $article->title, $article->content, $article->published_at)) <!-- Ensure data exists -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->content, 150) }}</p>
                        <p class="card-text">
                            <small class="text-muted">Published on {{ $article->published_at }}</small>
                        </p>
                        <a href="{{ route('news.show', $article->id) }}" class="btn btn-primary">Read More</a>
                    </div>
                    <div class="card-footer">
                        <h6>Comments</h6>
                        @if($article->comments && $article->comments->count() > 0)
                            @foreach($article->comments as $comment)
                                @if(isset($comment->user->name, $comment->content))
                                    <p><strong>{{ $comment->user->name }}:</strong> {{ $comment->content }}</p>
                                @endif
                            @endforeach
                        @else
                            <p>No comments available.</p>
                        @endif
                        <h6>
                            Average Rating: 
                            {{ $article->ratings->count() > 0 ? round($article->ratings->avg('rating'), 1) : 'No ratings yet' }}
                        </h6>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endif
   
</div>

</div>

            <!-- Inquiry Form -->

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    
let chart; // Declare the chart variable in the outer scope

function showContact() {
    var contactSpan = document.getElementById('dealership-contact');
    var showContactBtn = document.getElementById('show-contact-btn');
    var contactMethods = document.getElementById('contact-methods');

    if (contactSpan.textContent.includes('****')) {
        contactSpan.textContent = '{{ $listing->dealer->contact }}';
        showContactBtn.textContent = 'Contact Dealer';
        contactMethods.style.display = 'block';
    } else {
        contactMethods.style.display = 'block';
    }
}

function formatToZAR(amount) {
    return new Intl.NumberFormat('en-ZA', { style: 'currency', currency: 'ZAR' }).format(amount);
}
function displayVariantDetails() {
    const variantId = document.getElementById('variant').value;
    if (variantId) {
        fetch(`/api/variant/details/${variantId}`)
            .then(response => response.json())
            .then(data => {
                let content = `
                    <h4>Variant Details:</h4>
                    <p><strong>Price:</strong> R${data.price}</p>
                    <p><strong>Color:</strong> ${data.color}</p>
                    <p><strong>Engine Size:</strong> ${data.engine_size}</p>
                `;
                document.getElementById('dynamicContent').innerHTML = content;
            })
            .catch(error => console.error('Error fetching variant details:', error));
    }
}
function updateInterestRateValue(value) {
    document.getElementById('interestRateValue').innerText = value + '%';
}

function updateLoanTermValue(value) {
    document.getElementById('loanTermValue').innerText = value + ' months';
}

function updateBalloonPaymentValue(value) {
    document.getElementById('balloonPaymentValue').innerText = value + '%';
}
function calculatePayment() {
    const price = parseFloat(document.getElementById('price').value);
    const deposit = parseFloat(document.getElementById('deposit').value);
    const interestRate = parseFloat(document.getElementById('interestRate').value) / 100;
    const loanTerm = parseInt(document.getElementById('loanTerm').value);
    const balloonPayment = parseFloat(document.getElementById('balloonPayment').value) / 100;
    const tradeInAssetValue=parseFloat(document.getElementById('tradeInValue').value);
    // Calculate loan amount (Price - Deposit)
    const loanAmount = price - (deposit + tradeInAssetValue);

    // Balloon payment (based on percentage of loan amount)
    const balloon = loanAmount * balloonPayment;

    // Monthly payment calculation (simplified formula)
    const principal = loanAmount - balloon;
    const monthlyInterestRate = interestRate / 12;
    const monthlyPayment = (principal * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -loanTerm));

    // Total loan value, total interest, and other results
    const totalLoanValue = principal + balloon;
    const totalInterest = (monthlyPayment * loanTerm) - principal;
    const totalPayment = totalLoanValue + totalInterest;

    // Depreciation and Trade-In calculation
    const depreciationRate = 0.15; // Example: 15% annual depreciation
    const depreciationValue = price * Math.pow(1 - depreciationRate, loanTerm / 12);  // Depreciation value after loanTerm years
    const tradeInValue = price * Math.pow(1 - depreciationRate * 0.85, loanTerm / 12); // Adjusted for trade-in prediction (lower depreciation rate)

    // Update the DOM with calculated values
    document.getElementById('monthlyPayment').textContent = `${formatToZAR(monthlyPayment)}`;
    document.getElementById('totalLoanValue').textContent = `${formatToZAR(totalLoanValue)}`;
    document.getElementById('totalInterest').textContent = `${formatToZAR(totalInterest)}`;
    document.getElementById('totalPayment').textContent = `${formatToZAR(totalPayment)}`;
    document.getElementById('balloonPaymentDue').textContent = `${formatToZAR(balloon)}`;
    document.getElementById('tradeInValueCal').textContent = `${formatToZAR(tradeInAssetValue)}`;

    // Update the graph for Payment Over Time & Predicted Depreciation and Trade-In
    setDepreciationAndTradeInGraph(depreciationValue, tradeInValue, monthlyPayment, loanTerm);
}


function setDepreciationAndTradeInGraph(depreciationValue, tradeInValue, monthlyPayment, loanTerm) {
    // Data for the graph
    const months = Array.from({ length: loanTerm }, (_, i) => i + 1); // Loan term months
    const depreciationValues = months.map(month => depreciationValue * Math.pow(1 - 0.15, month / 12));
    const tradeInValues = months.map(month => tradeInValue * Math.pow(1 - 0.15 * 0.85, month / 12));

    // Loan repayment over time
    const loanRepaymentValues = months.map((_, i) => monthlyPayment * (i + 1));

    // Create the chart
    const ctx = document.getElementById('paymentGraph').getContext('2d');

    // Destroy the existing chart instance if it exists
    if (chart) {
        chart.destroy();
    }

    // Clear the canvas content
    $("#paymentGraph").html('');

    // Create a new chart instance
    chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Depreciation Value',
                    data: depreciationValues,
                    borderColor: 'red',
                    fill: false
                },
                {
                    label: 'Trade-In Value (Predicted)',
                    data: tradeInValues,
                    borderColor: 'green',
                    fill: false
                },
                {
                    label: 'Loan Repayment Value',
                    data: loanRepaymentValues,
                    borderColor: 'blue',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Months'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Value (R)'
                    }
                }
            }
        }
    });
}


$(document).ready(function() {
    calculatePayment()
})


$(document).ready(function() {
    $('.clickable-image').on('click', function() {
        const slideTo = $(this).data('slide-to');
        $('#imageSlider').carousel(slideTo);
    });
    document.querySelectorAll('.thumbnail-img').forEach(thumbnail => {
    thumbnail.addEventListener('click', function() {
        const mainImage = this.closest('.card').querySelector('.main-image');
        mainImage.src = this.src;
    });

  
   
});

var description= `{{ $car->description }}`
var car = @json($car);

    appendCarToCookie(car);

    calculatePayment()
});

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function appendCarToCookie(car) {
    var cars = getCookie("recentlyViewedCars");
    if (cars) {
        cars = JSON.parse(cars);
    } else {
        cars = [];
    }

    // Check if the car already exists in the array
    var carExists = cars.some(function(existingCar) {
        return existingCar.vehicle_id === car.vehicle_id;
    });

    if (!carExists) {
        cars.push(car);
        setCookie("recentlyViewedCars", JSON.stringify(cars), 7); // Store for 7 days
    } else {
        
    }
}

 const currentURL = encodeURIComponent(window.location.href);
    document.querySelectorAll('.social-share a').forEach(link => {
      const href = link.getAttribute('href');
      if (href.includes("?")) {
        link.setAttribute('href', `${href}${currentURL}`);
      }
    });
    const recentlyViewedCarsJSON = getCookie('recentlyViewedCars');
const recentlyViewedCars = recentlyViewedCarsJSON ? JSON.parse(recentlyViewedCarsJSON) : [];

// Function to render the recently viewed cars
function renderRecentlyViewedCars(cars) {
    const container = document.getElementById('recently-viewed-container');
    container.innerHTML = ''; // Clear any existing content

    cars.forEach(car => {
        const carCard = `
            <div class="car-card" onclick="location.href='/cars/${car.vehicle_id}'" style="cursor: pointer;">
                <div class="image-container">
                    <img src="${car.images[0].url}" alt="${car.make} ${car.model}" class="main-image">
                </div>
                <div class="details">
                    <h5>${car.year} ${car.make} ${car.model}</h5>
                    <p>Price: R${Number(car.price).toLocaleString()}</p>
                </div>
            </div>
        `;
        container.innerHTML += carCard;
    });
}

// Call the function to render cars
if (recentlyViewedCars.length > 0) {
    renderRecentlyViewedCars(recentlyViewedCars);
}



document.addEventListener('DOMContentLoaded', function () {
    // Smooth scrolling to the target section if there's a hash in the URL
    const hash = window.location.hash;
    if (hash) {
        const targetElement = document.querySelector(hash);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth' });
        }
    }

    // Append the hash to pagination links dynamically
    const paginationLinks = document.querySelectorAll('.pagination a');
    paginationLinks.forEach(link => {
        // Avoid duplicating the hash
        if (!link.href.includes('#sponsored-cars-section')) {
            link.href += '#sponsored-cars-section';
        }
    });
});

</script>

@endsection

<?php
function calculateMonthlyPayment($price) {
    $interestRate = 0.15; // 15% annual interest rate
    $financeFeeRate = 0.10; // 15% finance fees and services
    $loanTermYears = 5.9; // Loan term in years

    // Add finance fees to the price
    $totalPrice = $price * (1 + $financeFeeRate);

    // Calculate monthly interest rate
    $monthlyInterestRate = $interestRate / 12;

    // Calculate number of payments
    $numPayments = $loanTermYears * 12;

    // Calculate monthly payment using the formula for an installment loan
    $monthlyPayment = ($totalPrice * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numPayments));

    return round($monthlyPayment, 2);
}
?>