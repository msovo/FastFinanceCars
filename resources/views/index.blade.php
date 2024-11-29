<!-- @extends('layouts.index')

@section('content')
<style>
<style>
    .carousel-inner {
        height: 40vh;
        width: 100%;
    }

    .carousel-item img {
        height: 100%;
        object-fit: cover;
    }

    .advanced-search {
        margin-top: 20px;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 5px;
    }

    .car-listing {
        margin-top: 20px;
    }

    .car-card {
        margin-bottom: 20px;
    }

    .services, .news-reviews, .sponsored-cars, .latest-cars {
        margin-top: 40px;
    }

    .section-title {
        margin-bottom: 20px;
    }

    .services { /* Styling for "Our Services" section */
        background-color: #c0392b; /* Red background */
        color: white; 
        padding: 20px;
        font-family: 'Arial', sans-serif; /* Changed font */
    }

    .news-reviews .card { /* Improved news display */
        margin-bottom: 20px;
        border: none; 
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .news-reviews .card-body {
        padding: 15px;
    }

    .news-reviews .card-title {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    /* Responsive Styles (adjust as needed) */
    @media (max-width: 768px) { 
        .advanced-search .form-row {
            flex-direction: column; 
        }
        .advanced-search .form-group {
            margin-bottom: 15px;
        }
    }</style>

<div class="jumbotron text-center">
    <h1>Welcome to Fast Finance Cars</h1>
    <p>Your one-stop solution for buying, selling, and valuing cars.</p>
</div>

<div id="carCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#carCarousel" data-slide-to="1"></li>
        <li data-target="#carCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('storage/images/gettyimages-1356380307-612x612.jpg') }}" class="d-block w-100" alt="Car 1">
        </div>
        </div>
    <a class="carousel-control-prev" href="#carCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="container mt-5">
    <div class="advanced-search">
        <h3>Find New & Used Cars for Sale</h3>
        <form action="{{ route('index') }}" method="GET">
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="make">Make</label>
                    <input type="text" class="form-control" id="make" name="make" placeholder="Make">
                </div>
                <div class="form-group col-md-3">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Model">
                </div>
                <div class="form-group col-md-3">
                    <label for="minPrice">Min Price</label>
                    <input type="number" class="form-control" id="minPrice" name="minPrice" placeholder="Min Price">
                </div>
                <div class="form-group col-md-3">
                    <label for="maxPrice">Max Price</label>
                    <input type="number" class="form-control" id="maxPrice" name="maxPrice" placeholder="Max Price">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="sort">Sort By</label>
                    <select class="form-control" id="sort" name="sort">
                        <option value="date_d">Date (Newest)</option>
                        <option value="date_a">Date (Oldest)</option>
                        <option value="price_d">Price (Highest)</option>
                        <option value="price_a">Price (Lowest)</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="location">Location</label>
                    <input type="text" class="form-control" id="location" name="location" placeholder="Location">
                </div>
                <div class="form-group col-md-3">
                    <label for="bodyType">Body Type</label>
                    <input type="text" class="form-control" id="bodyType" name="bodyType" placeholder="Body Type">
                </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary mt-4">Search</button>
                </div>
            </div>
        </form>
    </div>

    <div class="car-listing">
    <h2>Featured Cars</h2>
    <div class="row">
        @foreach($featuredCars->take(3) as $car)
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='{{ route('cars.show', $car->id) }}';" style="cursor: pointer;">
                    <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img-top main-image" alt="{{ $car->make }} {{ $car->model }}" style="width: 100%; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
                        <p class="card-text">
                            <span><i class="fas fa-calendar-alt"></i> {{ $car->year }}</span> 
                            <span><i class="fas fa-road"></i> {{ $car->mileage }} km</span> 
                            <span class="text-danger">R{{ number_format(calculateMonthlyPayment($car->price), 2) }} p/m</span> 
                        </p>
                        <p class="card-text">
                            <span>Dealership: {{ $car->dealership->name }}</span> <br>
                            <span><i class="fas fa-map-marker-alt"></i> {{ $car->dealership->city_town }}</span> 
                        </p>
                    </div>
                    <div class="thumbnails">
                        @foreach ($car->images->take(3) as $image)
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-image" alt="{{ $car->make }} {{ $car->model }} thumbnail" style="width: 100%; height: auto;">
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    <div class="services">
        <h2 class="section-title">Our Services</h2>
        <div class="row">
            <div class="col-md-4">
                <h4><i class="fas fa-car"></i> Sell Your Car</h4>
                <p>Sell your car quickly and easily with our trusted platform.</p>
            </div>
            <div class="col-md-4">
                <h4><i class="fas fa-shopping-cart"></i> Buy a Car</h4>
                <p>Find your dream car from thousands of listings by dealers and private sellers.</p>
            </div>
            <div class="col-md-4">
                <h4><i class="fas fa-dollar-sign"></i> Car Valuation</h4>
                <p>Get an accurate valuation for your car with our expert tools.</p>
            </div>
        </div>
    </div>

    <div class="news-reviews">
        <h2 class="section-title">News & Reviews</h2>
        <div class="row">
            @foreach($news as $article)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                            <a href="{{ route('news.show', $article->id) }}" class="btn btn-secondary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="sponsored-cars">
    <h2 class="section-title">Sponsored Cars</h2>
    <div class="row">
        @foreach($sponsoredCars->take(3) as $car)
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='{{ route('cars.show', $car->id) }}';" style="cursor: pointer;">
                    <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img-top" alt="{{ $car->make }} {{ $car->model }}" style="width: 100%; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
                        <p class="card-text">{{ $car->year }} - R{{ number_format($car->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<div class="latest-cars">
    <h2>Latest Cars</h2>
    <div class="row">
        @foreach ($latestCars->take(3) as $car)
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='{{ route('cars.show', $car->id) }}';" style="cursor: pointer;">
                    <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img-top" alt="{{ $car->make }} {{ $car->model }}" style="width: 100%; height: auto;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
                        <p class="card-text">{{ $car->year }} - R{{ number_format($car->price, 2) }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


    <div class="make-analysis">
        <h2>Make Analysis</h2>
        <canvas id="makeAnalysisChart"></canvas>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // JavaScript to handle thumbnail clicks
    const mainImages = document.querySelectorAll('.main-image');
    const thumbnailImages = document.querySelectorAll('.thumbnail-image');

    thumbnailImages.forEach(thumbnail => {
        thumbnail.addEventListener('click', () => {
            const carCard = thumbnail.closest('.car-card'); 
            const mainImage = carCard.querySelector('.main-image'); 
            mainImage.src = thumbnail.src; 
        });
    });

    // Chart.js code for the Make Analysis chart
    const makeAnalysisCtx = document.getElementById('makeAnalysisChart').getContext('2d');
    const makeAnalysisChart = new Chart(makeAnalysisCtx, {
        type: 'bar',
        data: {
            labels: @json($makeLabels), 
            datasets: [{
                label: 'Number of Listings',
                data: @json($makeCounts), 
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Cars'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Make'
                    }
                }
            }
        }
    });
</script>
@endsection -->