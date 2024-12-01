@extends('layouts.index')


@section('content')
<style>
    /* Add your CSS styles here */
    .card {
    border-radius: 8px;
    overflow: hidden;
}

.car-card .card-header {
    font-weight: bold;
}

.car-image-container {
    position: relative;
}

.car-image-container .image-count {
    position: absolute;
    bottom: 8px;
    right: 8px;
    padding: 5px 10px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border-radius: 5px;
    font-size: 12px;
}

.car-card p {
    margin-bottom: 5px;
}

.dealership-card {
    background-color: #f9f9f9;
    padding: 15px;
    border-left: 4px solid #007bff;
}
.customerContain{
    margin-top:40px;
}
</style>
<div class="container customerContain">
    <div class="row">
        <!-- Dealership Info -->
        <div class="col-md-4">
            <div class="card dealership-card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title"><i class="fas fa-store"></i> Auto Dealer</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 11011 Nesser Street, Midrand, 1243</p>
                    <p><i class="fas fa-phone-alt"></i> Contact: 06047598745</p>
                    <hr>
                    <p><i class="fas fa-car"></i> Total Cars: <strong>2</strong></p>
                    <p><i class="fas fa-tags"></i> Car Makes: <strong>2</strong></p>
                    <p><i class="fas fa-th-list"></i> Car Models: <strong>2</strong></p>
                    <p><i class="fas fa-calendar-alt"></i> Registered: <strong>4 weeks ago</strong></p>
                </div>
            </div>
        </div>

        <!-- Dealership Cars -->
        <div class="col-md-8">
            <div class="row">
                @foreach($dealership->listings  as $car)
                <div class="col-md-6 mb-4">
                    <div class="card car-card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h6>{{ $car->year }} {{ $car->make }} {{ $car->model }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="car-image-container mb-2">
                                <img src="{{ $car->images->isNotEmpty() ? asset('storage/' . $car->images->first()->image_url) : asset('storage/images/default-car.jpg') }}" 
                                    class="img-fluid" 
                                    alt="{{ $car->make }} {{ $car->model }}">
                                @if($car->images->isNotEmpty())
                                <span class="badge badge-dark image-count">
                                    <i class="fas fa-camera"></i> {{ $car->images->count() }}
                                </span>
                                @endif
                            </div>
                            <h6 class="text-success">R{{ number_format($car->price, 2) }}</h6>
                            <p><i class="fas fa-cogs text-primary"></i> Transmission: {{ $car->transmission }}</p>
                            <p><i class="fas fa-tachometer-alt text-warning"></i> Mileage: {{ $car->mileage }} km</p>
                            <p><i class="fas fa-gas-pump text-danger"></i> Fuel: {{ $car->fuel_type }}</p>
                            <a href="{{ route('cars.show', $car->vehicle_id) }}" class="btn btn-outline-primary btn-block">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Inquiry Form -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h5>Contact the Dealer</h5>
                </div>
                <div class="card-body">
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
                        @endguest
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="3" required>
                                Hi. I am contacting you regarding this vehicle, I would like to know more about the process.
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Submit Inquiry</button>
                        <p class="mt-2">By submitting your contact to the dealer you accept our terms and conditions and policy rules.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function calculateMonthlyPayment(price) {
    var interestRate = 0.15;
    var financeFeeRate = 0.10;
    var loanTermYears = 5.9;

    var totalPrice = price * (1 + financeFeeRate);
    var monthlyInterestRate = interestRate / 12;
    var numPayments = loanTermYears * 12;
    var monthlyPayment = (totalPrice * monthlyInterestRate) / (1 - Math.pow(1 + monthlyInterestRate, -numPayments));

    return monthlyPayment.toFixed(2);
}
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