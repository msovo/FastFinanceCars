@if($cars->isEmpty())
    <p>No cars found matching your criteria.</p>
@else
    <div class="row">
        @foreach($cars as $car)
            <div class="col-md-12 car-card">
                <div class="card" onclick="location.href='{{ route('cars.show', $car->vehicle_id) }}';" style="cursor: pointer;">
                    <div class="love-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="row no-gutters">
                        <div class="col">
                            @if($car->images->isNotEmpty())
                                <div class="main-image-container">
                                    <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img main-image" alt="{{ $car->make }} {{ $car->model }}">
                                    <span class="image-count" style="bottom: 20px; left: 0;">
                                        <i class="fas fa-camera"></i> {{ $car->images->count() }}
                                    </span>
                                </div>
                                <div class="row thumbnails">
                                    @foreach ($car->images->slice(1, 3) as $image)
                                        <div class="col-4">
                                            <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-image" alt="{{ $car->make }} {{ $car->model }} thumbnail" style="width: 100%;">
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="main-image-container">
                                    <img src="{{ asset('storage/images/default-car.jpg') }}" class="card-img main-image" alt="Default Image">
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <div class="card-body car-details">
                                <h5>
                                    <i class="fas fa-calendar-alt"></i> {{ $car->year }} 
                                    {{ $car->make }} {{ $car->model }}
                                </h5>
                                <h6 class="price">R{{ number_format($car->price, 2) }}</h6>
                                <div class="specs">
                                    <div>
                                        <i class="fas fa-cogs"></i>    <!-- Transmission -->
                                        <span>{{ $car->transmission }}</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-tachometer-alt"></i>    <!-- Mileage -->
                                        <span>{{ $car->mileage }} km</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-gas-pump"></i>   <!-- Fuel Type -->
                                        <span>{{ $car->fuel_type }}</span>
                                    </div>
                                </div>
                                <p class="card-text text-danger">
                                    R{{ number_format(calculateMonthlyPayment($car->price), 2) }} p/m 
                                    <span class="badge" style="background-color: {{ $car->car_condition == 'Used' ? 'red' : 'blue' }};color:white;">
                                        {{ ucfirst($car->car_condition) }}
                                    </span>
                                </p>
                                @if($car->listing && $car->listing->listing_status == 'active')
                                    @if($car->listing->featured)
                                        <div class="ribbon"><span>Featured</span></div>
                                    @elseif($car->listing->sponsored)
                                        <div class="ribbon"><span>Sponsored</span></div>
                                    @elseif($car->created_at && $car->created_at->diffInDays() <= 7)
                                        <div class="ribbon"><span>Recently Listed</span></div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

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


<?php

function calculateMonthlyPayment($price) {
    $interestRate = 0.15; 
    $financeFeeRate = 0.10; 
    $loanTermYears = 5.9; 

    $totalPrice = $price * (1 + $financeFeeRate);
    $monthlyInterestRate = $interestRate / 12;
    $numPayments = $loanTermYears * 12;
    $monthlyPayment = ($totalPrice * $monthlyInterestRate) / (1 - pow(1 + $monthlyInterestRate, -$numPayments));

    return round($monthlyPayment, 2);
}

?>