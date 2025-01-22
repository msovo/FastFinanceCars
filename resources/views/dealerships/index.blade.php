@extends('layouts.index')

@section('content')

<style>
    .sponsored-car-card {
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .sponsored-car-card:hover {
        transform: scale(1.05);
    }
    .province-item.active {
        background-color: #f0f0f0;
        font-weight: bold;
    }
    .province-item:hover {
        cursor: pointer;
    }
    .dealership-card {
        cursor: pointer;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        transition: box-shadow 0.3s ease;
    }
    .dealership-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .dealership-logo {
        width: 120px;
        height: auto;
        margin-bottom: 10px;
    }
    .dealership-card .icon {
        color: #6c757d;
        margin-right: 5px;
    }
    .card-body p {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .dealership-card h5 {
        margin-bottom: 10px;
        font-weight: bold;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <!-- Search and Provinces Filter -->
        <div class="col-md-3">
        <button class="btn btn-primary mb-3" onclick="window.location.reload();">Clear Search</button>

            <input type="text" id="searchDealerships" oninput="searchDealerships()" class="form-control mb-3" placeholder="Search Dealerships">
            <ul class="list-group" id="provinceList">
                @foreach($provinces as $province)
                    <li class="list-group-item d-flex justify-content-between align-items-center province-item" onclick="filterByProvince('{{ $province->province }}')">
                        {{ $province->province }}
                        <span class="badge badge-primary badge-pill">{{ $province->total }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Dealerships List -->
        <div class="col-md-6">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <button id="sortAZ" class="btn btn-outline-secondary"><i class="fas fa-sort-alpha-down"></i> Sort A-Z</button>
                    <button id="sortZA" class="btn btn-outline-secondary"><i class="fas fa-sort-alpha-down-alt"></i> Sort Z-A</button>
                </div>
                {{ $dealerships->links() }}
            </div>
            <div id="dealershipList">
                @foreach($dealerships as $dealership)
                    <div class="card dealership-card mb-3" onclick="location.href='{{ route('dealerships.show', $dealership->dealer_id) }}'">
                    <div class="me-3">
                                @if($dealership->verified)
                                    <span class="badge badge-success"><i class="fas fa-check-circle"></i> Verified</span>
                                @else
                                    <span class="badge badge-warning"><i class="fas fa-exclamation-circle"></i> Not Verified</span>
                                @endif
                                
                            </div>
                    <div class="card-body">
                            <div class="text-center mb-3">
                               
                                @if($dealership->logo)
                                    <img src="{{ asset('storage/' . $dealership->logo) }}" alt="{{ $dealership->dealership_name }}" class="dealership-logo rounded">
                                @else
                                    <p>No Logo</p>
                                @endif
                            </div>
                            <h5 class="card-title text-center">{{ $dealership->dealership_name }}</h5>
                            <div class="row">
                                <div class="col-6">
                                    <p><i class="fas fa-map-marker-alt icon"></i> {{ $dealership->address }}</p>
                                    <p><i class="fas fa-car icon"></i> Total Cars: {{ $dealership->total_cars }}</p>
                                    <p><i class="fas fa-phone icon"></i> Contact: {{ $dealership->contact }}</p>
                                </div>
                                <div class="col-6">
                                    <p><i class="fas fa-car-side icon"></i> Car Makes: {{ $dealership->car_makes_count }}</p>
                                    <p><i class="fas fa-car-alt icon"></i> Car Models: {{ $dealership->car_models_count }}</p>
                                    <p><i class="fas fa-clock icon"></i> Registered: {{ $dealership->created_at->diffInDays() }} days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $dealerships->links() }}
            </div>
        </div>

        <!-- Sponsored Cars -->
        <div class="col-md-3">
            <h5>Sponsored Cars</h5>
            @foreach($sponsoredCars as $car)
                <div class="card mb-3 sponsored-car-card" onclick="location.href='{{ route('cars.show', $car->vehicle_id) }}'">
                    <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img-top" alt="{{ $car->vehicle->model }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->vehicle->make }} {{ $car->vehicle->model }}</h5>
                        <p class="card-text">{{ $car->vehicle->year }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function searchDealerships(province='') {
    const query = document.getElementById('searchDealerships').value;
  

    fetch(`/dealerships.search?query=${query}&province=${province}`)
        .then(response => {
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            document.getElementById('dealershipList').innerHTML = data.html;
        })
        .catch(error => console.error('Error fetching dealership data:', error));
}



function filterByProvince(province) {
    searchDealerships(province)
}
</script>
@endsection
