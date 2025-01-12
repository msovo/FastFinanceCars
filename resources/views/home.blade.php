@extends('layouts.index')

@section('content')
<style>
    body{
        background:gainsboro;
    }
    /* ... (Your existing CSS styles) ... */
    #toggleMoreFilters {
            color: white;
            background-color: rgba(128, 128, 128, 0.5);
            border-radius: 15px;
            padding: 10px 20px;
            margin-bottom:15px;
            text-decoration: none;
            
        }
        .more-filters {
            position: fixed;
            top: 0;
            left: -300px; /* Start off-screen */
            width: 300px;
            height: 100%;
            background-color: #f8f9fa;
            overflow-y: auto;
            transition: left 0.3s ease;
            z-index: 1050;
            box-shadow: 2px 0 5px rgba(0,0,0,0.5);
            padding: 20px;
            margin-bottom: 5px;
        }
        .more-filters.show {
            left: 0; /* Slide in */
            color:black;
            display:none;
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(128, 128, 128, 0.5); /* Grey and transparent */
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .category-section {
            margin-bottom: 10px;
        }
        .category-header {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .card {
            margin-bottom: 10px;
        }
    .dropdown-item {
        width: 100%;
    }
    .expand-models-btn {
        background: none;
        border: none;
        padding: 0;
        margin: 0;
    }
    .expand-models-btn i {
        font-size: 1rem;
    }
    .carousel-inner {
        height: 59vh;
        width: 100%;
        margin-bottom:50px;
    }
    .carousel-item img {
        height: 100%;
        object-fit: cover;
    }

    .car-listing {
        margin-top: 120px;
    }
    .car-card {
        margin-bottom: 20px;
    }
    .services, .news-reviews, .sponsored-cars {
        margin-top: 40px;
    }
    .section-title {
        margin-bottom: 20px;
    }
    .car-card .card-img-top {
        height: 200px; /* Set a fixed height */
        object-fit: cover; /* Ensure the image covers the entire area */
    }
    .services { /* Styling for "Our Services" section */
        background-color: #c0392b; /* Red background */
        color: white; 
        padding: 20px;
        font-family: 'Arial', sans-serif; /* Changed font */
    }
    .category-section {
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f8f9fa;
    padding: 15px;
}

.category-header {
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
}

.card-img-top img {
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
}
    .carousel-inner {
    height: 59vh;
    width: 100%;
}
.carousel-item img {
    height: 100%;
    object-fit: cover;
}
.advanced-search {
    position: absolute;
    top: 18vh;
    left: 10.5%; 
    background-color: #c0392b;
    padding: 20px;
    color: white;
    width: 35%; 
    z-index: 99;
    border-radius: 10px; 
    font-size: 14px !important;
}

@media (max-width: 768px) { 
    .section-title{
        text-align: center;
    }
    .advanced-search {
        width: 90%; 
        left: 50%; 
        transform: translateX(-50%); 
        top: 10vh; 
        font: size 0.5em!important;
    }
}
.news-reviews .card {
    margin-bottom: 20px; 
}
.news-reviews .news-grid {
        margin-top: 20px; 
    }

    .news-reviews .news-item {
        margin-bottom: 20px; 
    }
    .category-section {
    padding: 15px;
}

.category-header {
    position: relative;
    margin-bottom: 15px;
}

.view-all-btn {
    position: absolute;
    top: 0;
    right: 0;
    margin: 10px;
}

.card-img-top img {
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
}

.card-body {
    background-color: transparent;
}

.card-title, .card-text {
    color: inherit;
}
    @media (min-width: 768px) { 
        .news-reviews .news-grid {
            display: none; 
        }
    }
    .jumbotron, 
.advanced-search, 
.car-listing, 
.services, 
.news-reviews, 
.sponsored-cars, 
.latest-cars, 
.make-analysis {
    margin-bottom: 30px; 
}


/* ... other styles ... */

@media (max-width: 768px) { 
 

    .news-reviews .news-item .col-4 {
        width: 30%; 
    }

    .news-reviews .news-item .col-8 {
        width: 70%; 
    }
}
@media (max-width: 768px) { 
    .advanced-search {
        width: 90%; 
        left: 50%; 
        transform: translateX(-50%); 
        top: 10vh; 
        padding: 10px; 
    }

    .advanced-search .form-row {
        display: flex; 
        flex-wrap: wrap; 
    }

    .advanced-search .form-group.col-md-6 { 
        width: 50%; 
        flex: 0 0 50%; 
        max-width: 50%; 
    }

    .advanced-search h3 {
        font-size: 1.5rem; 
    }

    .advanced-search p {
        font-size: 0.5rem; 
    }
}
/* ... other styles ... */

.make-analysis {
    margin-top: 30px; 
    margin-bottom: 30px; 
}

@media (max-width: 768px) { 
    .make-analysis canvas {
        width: 100% !important; 
    }
}
.card {
        height: 100%;
        display: flex;
        flex-direction: column;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        height: 200px; /* Adjust the height as needed */
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
       
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
        width: 100%;
        max-height: 59px;
    }
/* ... other styles ... */


/* ... other styles ... */

.carCarousel{
    position: absolute;
    width: 100%;
    height: 70vh;
}

.car-listing , .make-analysis{
        width:59.9% !important;
        margin-left: 20% !important;
        margin-top: 30px !important;
    }

    .nav-engagement {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
        .nav-engagement button {
            background-color: white;
            border: 2px solid red;
            color: red;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }
        .nav-engagement button.active {
            background-color: darkred;
            color: white;
        }
        .engagement-customer {
            margin-bottom: 20px;
        }
        .no-engagement {
            text-align: center;
            color: gray;
        }
        .no-engagement .warning-icon {
            font-size: 50px;
            color: red;
        }
        .no-engagement button {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        h2 {
        font-size: 20px !important;
        color:#213740 !important;
        margin-bottom: 5px !important;
        }

        h5 {
    font-size: 17px !important;
    color: #213740 !important;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

        .card-text {
        font-size: 14px !important;
        color:#213740 !important;
        margin-bottom: 0;
        padding-bottom: 0;;
        }

        .card-text-price {
        font-size: 17px !important;
        font-weight: bolder;
        margin-bottom: 0;
        padding-bottom: 0;;
        }

        .card-body{
            padding-bottom: 0 !important;
        }

        .advanced-search .btn {
        background-color: #ff6a00;
        color: white;
        padding: 8px 16px;
        border-radius: 5px;
        font-size: 15px;
    }

    
</style>


<div class="CustomcontainerHome">
<div id="carCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#carCarousel" data-slide-to="1"></li>
        <li data-target="#carCarousel" data-slide-to="2"></li>

    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('storage/images/a.jpg') }}" class="d-block w-100" alt="Car 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('storage/images/c.jpg') }}" class="d-block w-100" alt="Car 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('storage/images/b.jpg') }}" class="d-block w-100" alt="Car 3">
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
<div class="filter-container">
<div class="advanced-search" >
    <form id="searchForm" action="{{ route('cars.search') }}" method="GET">
        <div class="form-group">
            <input  type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword Search (Make, Model, Variant)">
            <div id="search-results" class="dropdown-menu" style="height:50vh;overflow-y:scroll; position:absolute; top:59px;left:0; width:100%;height:240px;">
    <!-- Filtered results will be displayed here -->
    </div>
    <ul id='appendlistofSelcted' style="height:50vh;overflow-y:scroll; position:absolute; top:59px;right:0; width:35%;height:240px;z-index:9999;color:grey;display:none;"></ul>

        </div>
                        <?php
                $provinces = [
                    "Eastern Cape",
                    "Free State",
                    "Gauteng",
                    "KwaZulu-Natal",
                    "Limpopo",
                    "Mpumalanga",
                    "Northern Cape",
                    "North West",
                    "Western Cape"
                ];
                ?>
        <div class="form-row mt-0">
            <div class="form-group col-12 col-md-6"> 
                <div class="dropdownP">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="provinceDropdown" aria-haspopup="true" aria-expanded="false">
                        Select Province(s)
                    </button>
                    <div class="dropdown-menu dropdown-menuProvince" aria-labelledby="provinceDropdown" style="height:50vh;overflow-y:scroll;">
                        <div class="province-checkboxes">
                       
        <?php foreach ($provinces as $province): ?>
            <div class="dropdown-item">
                <div class="form-check d-flex justify-content-between align-items-center">
                    <div>
                        <input onchange='getSelectedCheckFilterOnSearchProvince("<?php echo $province; ?>", "province", "<?php echo $province; ?>", "filter")' class="form-check-input province-checkbox" type="checkbox" name="province[]" id="province-<?php echo str_replace(' ', '-', $province); ?>" value="<?php echo $province; ?>">
                        <label id="province<?php echo str_replace(' ', '', $province); ?>" class="form-check-label" for="province-<?php echo str_replace(' ', '-', $province); ?>">
                            <?php echo $province; ?>
                        </label>
                    </div>
                    <button type="button" onclick="getModelID('<?php echo $province; ?>')" class="btn-sm expand-models-btn collapsed" data-province="<?php echo $province; ?>" data-toggle="collapse" data-target="#models-<?php echo str_replace(' ', '-', $province); ?>">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 col-md-6"> 
    <div class="dropdownr">
        <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="makeDropdown"  aria-haspopup="true" aria-expanded="false">Select a Car(s) </button>
        <div class="dropdown-menu dropdown-menuFilter"  aria-labelledby="makeDropdown" style="height:50vh;overflow-y:scroll;">
            @foreach ($carBrands as $make)
                <div class="dropdown-item">
                    <div class="form-check d-flex justify-content-between align-items-center">
                        <div>           
                            <input onchange='getSelectedCheckFilterOnSearch({{$make->id }}, "brand","{{$make->name}}","filter")' class="form-check-input make-checkbox" type="checkbox" name="car_brand_id[]" id="brand-{{ $make->id }}" value="{{ $make->id }}">
                            <label id="brand{{ $make->id }}" class="form-check-label" for="brand-{{ $make->name }}">
                                {{ $make->name }} ( {{ $make->vehicle_count }})
                            </label>
                        </div>
                        <button type="button" onclick="getModelID({{ $make->id }})" class=" btn-sm expand-models-btn collapsed" data-make="{{ $make->id }}" data-toggle="collapse" data-target="#models-{{ $make->id }}">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="collapse" id="models-{{ $make->id }}">
                        <!-- Models will be loaded here -->
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByPrice" value="price" checked>
                    <label class="form-check-label" for="searchByPrice">
                        Price
                    </label>
                </div>
            </div>
            <div class="form-group col-md-6">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="searchBy" id="searchByMonthlyPayment" value="monthlyRepayment">
                    <label class="form-check-label" for="searchByMonthlyPayment">
                        Monthly Repayment
                    </label>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <select onchange="getFormDataAndSubmit()" class="form-control" id="minYear" name="minYear">
                    <option value="">Select Min Year</option>
                    @for ($year = date('Y'); $year >= 1990; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group col-md-6">
                <select onchange="getFormDataAndSubmit()" class="form-control" id="maxYear" name="maxYear">
                    <option value="">Select Max Year</option>
                    @for ($year = date('Y'); $year >= 1990; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <select onchange="getFormDataAndSubmit()" class="form-control" id="minPrice" name="minPrice">
                    <option value="">Select Min Price</option>
                    <!-- Add price options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <select onchange="getFormDataAndSubmit()" class="form-control" id="maxPrice" name="maxPrice">
                    <option value="">Select Max Price</option>
                    <!-- Add price options here -->
                </select>
            </div>
        </div>


            <!--  <a href="#" id="toggleMoreFilters">More Filters</a>-->

        <div class="more-filters">
            <button class="close-btn" id="closeFilters">×</button>
            @foreach ($categoryTypes as $categoryType)
                <div class="category-section">
                    <div class="category-header">{{ $categoryType }}</div>
                    <div class="category-body">
                        @foreach ($categories[$categoryType] as $category)
                            <button type="button" class="btn btn-outline-secondary filter-btn" data-filter-name="{{ str_replace(' ', '_', strtolower($categoryType)) }}" data-filter-value="{{ $category->category_name }}">
                                {{ $category->category_name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
<div class="row">
        <button type="submit" class="btn btn-primary col">Search Cars</button>
        <button type="button" onclick="resetFormAdvanced()" class="btn btn-secondary col" id="resetFilters">Reset Filters</button>
        </div>
    </form>
</div>
</div>
    <div class="car-listing">
    <div class="engagement-customer">
            <h2>Your Engagement</h2>
            <nav class="nav-engagement">
                <button onclick="showSection('recently-viewed-cars')" class="active">Recently Viewed Cars</button>
                <button onclick="showSection('recent-searches')">Recent Searches</button>
                <button onclick="showSection('view-news')">View News</button>
            </nav>
        </div>

        <div id="recently-viewed-cars" class="engagement-section">
            <h2>Recently Viewed Cars</h2>
            <div class="row" id="recently-viewed-cars-list">
                <!-- Recently viewed cars will be appended here by JavaScript -->
            </div>
            <div id="pagination-controls"></div>

        </div>

        <div id="recent-searches" class="engagement-section" style="display: none;">
            <h2>Recent Searches</h2>
            <div class="no-engagement">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <p>You have no recent searches yet.</p>
                <button onclick="startSearching()">Start Searching</button>
            </div>
        </div>

        <div id="view-news" class="engagement-section" style="display: none;">
            <h2>View News</h2>
            <div class="no-engagement">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <p>You have no news engagements yet.</p>
                <button onclick="startSearching()">Start Searching</button>
            </div>
        </div>
  
    



<div class="sponsored-cars">
    <h2 class="section-title">Sponsored Cars</h2>
    <div class="row">
        @foreach($sponsoredCars->take(3) as $car)
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='{{ route('cars.show', $car->vehicle_id) }}';" style="cursor: pointer;">
                    @if($car->images->isNotEmpty())
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img-top main-image" alt="{{ $car->make }} {{ $car->model }}" style="width: 100%;">
                            <span class="image-count" style="bottom: 20px; left: 0;">
                                <i class="fas fa-camera"></i> {{ $car->images->count() }}
                            </span>
                        </div>
                    @else
                        <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image" style="width: 100%; height: auto;">
                    @endif
                    <div class="row thumbnails">
                        @foreach ($car->images->slice(1, 3) as $image)
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-image" alt="{{ $car->make }} {{ $car->model }} thumbnail" style="width: 100%;">
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-alt"></i> {{ $car->year }}   
                            {{ $car->car_brand->name }} {{$car->car_model->name}} {{$car->variant->name}}
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-cogs"></i> {{ $car->transmission }}   
                            <i class="fas fa-road"></i> {{ $car->mileage }} km   
                        </p>
                        <p class="card-text-price text-danger">
                          
                          R{{ number_format($car->price, 2) }} &nbsp;
                      </p>

                        <p class="card-text-p text-danger">
                            R{{ number_format(calculateMonthlyPayment($car->price), 2) }} p/m 
                            <span class="badge" style="background-color: {{ $car->car_condition == 'Used' ? 'red' : 'blue' }};color:white;">
                                {{ ucfirst($car->car_condition) }}
                            </span>
                        </p>
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

    
    <div class="latest-cars">
    <h2>Latest Cars</h2>
    <div class="row">
        @foreach ($latestCars->take(3) as $car) 
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='{{ route('cars.show', $car->vehicle_id) }}';" style="cursor: pointer;">
                    @if($car->images->isNotEmpty())
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $car->images->first()->image_url) }}" class="card-img-top main-image" alt="{{ $car->make }} {{ $car->model }}" style="width: 100%;">
                            <span class="position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 0; left: 0;">
                                <i class="fas fa-camera"></i> {{ $car->images->count() }}
                            </span>
                        </div>
                    @else
                        <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image" style="width: 100%; height: auto;">
                    @endif
                    <div class="row thumbnails">
                        @foreach ($car->images->slice(1, 3) as $image)
                            <div class="col-4">
                                <img src="{{ asset('storage/' . $image->image_url) }}" class="thumbnail-image" alt="{{ $car->make }} {{ $car->model }} thumbnail" style="width: 100%;">
                            </div>
                        @endforeach
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-alt"></i> {{ $car->year }}   
                            {{ $car->car_brand->name }} {{$car->car_model->name}} {{$car->variant->name}}
                        </h5>
                        <p class="card-text">
                            <i class="fas fa-cogs"></i> {{ $car->transmission }}   
                            <i class="fas fa-road"></i> {{ $car->mileage }} km   
                        </p>
                        <p class="card-text-price text-danger">
                          
                          R{{ number_format($car->price, 2) }} &nbsp;
                      </p>

                        <p class="card-text-p text-danger">
                            R{{ number_format(calculateMonthlyPayment($car->price), 2) }} p/m 
                            <span class="badge" style="background-color: {{ $car->car_condition == 'Used' ? 'red' : 'blue' }};color:white;">
                                {{ $car->car_condition }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



<h2>Latest Articles</h2>
@foreach($news as $categoryName => $articles)
    <div class="category-section mb-4">
        <div class="category-header p-2">
            <h5>{{ $categoryName }}</h5>
<form action="{{ route('newssearch') }}" method="GET" class="d-flex align-items-center">
    <input type="hidden" name="category" value="{{ $articles->first()->category_id }}" />
    <button type="submit" class="btn btn-primary view-all-btn">View All {{ $categoryName }} Articles</button>
</form>

        </div>
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-4">
                    <a href="{{ route('news.show', parameters: $article->news_id) }}" class="card mb-3 text-decoration-none text-dark">
                        <div class="card-img-top">
                            @if($article->thumbnail_url)
                                <img src="{{ asset('storage/' . $article->thumbnail_url) }}" alt="Thumbnail" class="img-fluid">
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ Str::limit($article->content, 100) }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endforeach

<div class="text-center mt-4">
    <a href="{{ route('news.index') }}" class="btn btn-primary">View All News</a>
</div>

</div>



<div class="container mt-5">
        <h1 class="text-center mb-4">Car Brands</h1>
        
        <div class="row row-cols-4 g-3">
            @foreach ($carBrands as $brand)
                <div class="col">
                    <button type="button" class="btn btn-outline-dark w-100" onclick="submitForm('{{ $brand->id }}')">
                        {{ $brand->name }}
                    </button>
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
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', 
                    'rgba(54, 162, 235, 0.2)', 
                    'rgba(255, 206, 86, 0.2)', 
                    'rgba(75, 192, 192, 0.2)', 
                    'rgba(153, 102, 255, 0.2)', 
                    'rgba(255, 159, 64, 0.2)'  
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            indexAxis: 'y', 
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Cars'
                    }
                },
                y: { 
                    title: {
                        display: true,
                        text: 'Make'
                    }
                }
            }
        }
    });

// ... (other JavaScript code) ...

// Handle Make checkbox changes (to show/hide models)

// ... (rest of your JavaScript code) ...
</script>

<script>
    $('#toggleMoreFilters').on('click', function(e) {
            e.preventDefault();
            $('.more-filters').toggleClass('show');
        });

        $('#closeFilters').on('click', function(e) {
            e.preventDefault();
            $('.more-filters').removeClass('show');
        });

        // Hide the more-filters div when clicking outside of it
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.more-filters, #toggleMoreFilters').length) {
                $('.more-filters').removeClass('show');
            }
        });
        document.getElementById('resetFilters').addEventListener('click', function() {
    document.getElementById('searchForm').reset();
    
    // Reset dropdowns and other custom elements if necessary
    document.querySelectorAll('.dropdown-toggle').forEach(function(dropdown) {
        dropdown.innerHTML = dropdown.getAttribute('aria-labelledby') === 'provinceDropdown' ? 'Select Province(s)' : 'Select a Car(s)';
    });
    
    // Collapse any expanded model sections
    document.querySelectorAll('.collapse').forEach(function(collapse) {
        collapse.classList.remove('show');
    });
});

                   
function submitForm(brand) {
            // Create a form element dynamically
            const form = document.createElement('form');
            form.method = 'GET';
            form.action = "{{ route('cars.search') }}";

            // Add a hidden input to the form with the 'make' value
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'car_brand';
            input.value = parseInt(brand);
            input.id = 'brand'

            form.appendChild(input);

            // Add the form to the body and submit it
            document.body.appendChild(form);
            form.submit();
        }

function getModelID(id){

        var model_id = $(this).data('make');
        var modelsContainer = $('#models-' + id);

        // Toggle the collapse
        modelsContainer.collapse('toggle');

        if (modelsContainer.find('.models-list').length === 0) {
            // AJAX call to fetch models

                var modelsArr=@json($Carmodels)
                
                //modelsArr=JSON.parse(modelsArr)
                models=modelsArr.filter(function(model) {
                    return model.car_brand_id === id;
                })

                    var modelsHtml = '<div class="models-list" style="margin-left:10px;">';
                    $.each(models, function(index, model) {
                        modelsHtml += '<div class="form-check d-flex justify-content-between align-items-center">';
                        modelsHtml += '<div>';
                        modelsHtml +=`<input onchange='getSelectedCheckFilterOnSearch(${model.id }, "model","${model.name}","filter")' class="form-check-input" type="checkbox" name="car_model_id[]" id="model-${ model.id }" value="${ model.id }">`;
                        modelsHtml += '<label  class="form-check-label" for="model-' + model.name + '">' + model.name + '(' + model.vehicle_count +')' + '</label>';
                        modelsHtml += '</div>';

                        modelsHtml += '<button type="button" onclick="getVariantID('+ model.id + ')" style="border:none;background:none;" class="expand-variants-btn collapsed" data-make="' + model.id + '" data-model="' + model.id + '" data-toggle="collapse" data-target="#variants-' + model.car_brand_id + '-' + model.id + '">';
                        modelsHtml += '<i class="fas fa-chevron-right"></i>';
                        modelsHtml += '</button>';
                        modelsHtml += '</div>';
                        modelsHtml += '<div class="collapse" id="variants-' + model.id + '-' + model.id + '">';
                        modelsHtml += '</div>';
                    });
                    modelsHtml += '</div>';
                    modelsContainer.html(modelsHtml);
                }
        
        }

function getVariantID(id){

    var variantArr=@json($Carvariants)
                
                //modelsArr=JSON.parse(modelsArr)
                variant=variantArr.filter(function(variant) {
                    return variant.car_model_id === id;
                })


        var make = $(this).data('make');
        var model = $(this).data('model');
        var variantsContainer = $('#variants-' + id + '-' + id);

        // Toggle the collapse
        variantsContainer.collapse('toggle');

        if (variantsContainer.find('.variants-list').length === 0) {
            // AJAX call to fetch variants
      
                    var variantsHtml = '<div class="variants-list" style="margin-left:20px;">';
                    $.each(variant, function(index, variant) {
                        variantsHtml += '<div class="form-check">';
                        variantsHtml += `<input onchange='getSelectedCheckFilterOnSearch(${variant.id }, "variant","${variant.name}","filter")' class="form-check-input" type="checkbox" name="variant_id[]" id="variant-${ variant.id }" value=" ${ variant.id } ">`;
                        variantsHtml += '<label class="form-check-label" for="variant-' + variant.id + '">' + variant.name + ' (' + variant.vehicle_count + ')</label>';
                        variantsHtml += '</div>';
                    });
                    variantsHtml += '</div>';
                    variantsContainer.html(variantsHtml);
                }
}


$(document).ready(function() {

        populateSelect("minPrice", 5000, 1500000, 25000);
        populateSelect("maxPrice", 5000, 1500000, 25000);
       /// populateSelect("minMileage", 0, 500000, 5000);
       // populateSelect("maxMileage", 0, 500000, 5000);
    // Handle Make checkbox changes (to show/hide models)

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

            function showSection(sectionId) {
            $('.engagement-section').hide();
            $('#' + sectionId).show();
            $('.nav-engagement button').removeClass('active');
            $('.nav-engagement button[onclick="showSection(\'' + sectionId + '\')"]').addClass('active');
            switch (sectionId) {
           case 'recently-viewed-cars':
            listRecentViewedCars()
            break;
            default:
                console.error('Unknown section:', sectionId);
           
            }



        }

        function startSearching() {
            // Implement your start searching logic here
            alert('Start searching functionality not implemented yet.');
        }
        showSection('recently-viewed-cars')
        function listRecentViewedCars() {
    $("#recently-viewed-cars-list").html(""); // Clear the container
    var recentlyViewedCars = getCookie("recentlyViewedCars");

    if (recentlyViewedCars) {
        recentlyViewedCars = JSON.parse(recentlyViewedCars);
        const carsPerPage = 3; // Number of cars to show per page
        let currentPage = 1;
        const totalPages = Math.ceil(recentlyViewedCars.length / carsPerPage);

        // Function to render a specific page
        function renderPage(page) {
            const start = (page - 1) * carsPerPage;
            const end = start + carsPerPage;
            const carsToDisplay = recentlyViewedCars.slice(start, end);

            // Clear the container and render cars
            $("#recently-viewed-cars-list").html("");
            carsToDisplay.forEach(function (car) {
                //var url=` asset('storage/' . ${car.image.image_url})`
                var carHtml = `
    <div class="col-md-4 car-card" id="content-engagement">
        <div class="card" onclick="location.href='/cars/${car.vehicle_id}';" style="cursor: pointer;">
            ${car.images.length > 0 ? `
            <div class="main-image-container">
                <img src="/storage/${car.images[0].image_url}" class="card-img-top main-image" alt="${car.car_brand.name} ${car.car_model.name}">
                <span class="image-count" style="bottom: 20px; left: 0;">
                    <i class="fas fa-camera"></i> ${car.images.length}
                </span>
            </div>` : `
            <div class="main-image-container">
                <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image">
            </div>`}
            <div class="row thumbnails">
                ${car.images.slice(0, 3).map(image => `
                <div class="col-4">
                    <img src="/storage/${image.image_url}" class="thumbnail-image" alt="${car.car_brand.name} ${car.car_model.name} thumbnail">
                </div>`).join('')}
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-calendar-alt"></i> ${car.year} ${car.car_brand.name} ${car.car_model.name}
                </h5>
                <p class="card-text">
                    <i class="fas fa-cogs"></i> ${car.transmission} 
                    <i class="fas fa-road"></i> ${car.mileage} km 
                </p>
                <p class="card-text-price text-danger">
                    R${parseFloat(car.price).toFixed(2)}
                </p>
                <p class="card-text-p text-danger">
                    R${calculateMonthlyPayment(car.price)} p/m 
                    <span class="badge" style="background-color: ${car.car_condition == 'Used' ? 'red' : 'blue'};color:white;">
                        ${car.car_condition}
                    </span>
                </p>
            </div>
        </div>
    </div>
`;
$("#recently-viewed-cars-list").append(carHtml);
            });

            // Update pagination controls
            updatePaginationControls();
        }

        // Function to update pagination controls
        function updatePaginationControls() {
            let paginationHtml = `
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                            <button class="page-link" onclick="changePage(${currentPage - 1})">Previous</button>
                        </li>
            `;

            for (let i = 1; i <= totalPages; i++) {
                paginationHtml += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <button class="page-link" onclick="changePage(${i})">${i}</button>
                    </li>
                `;
            }

            paginationHtml += `
                        <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                            <button class="page-link" onclick="changePage(${currentPage + 1})">Next</button>
                        </li>
                    </ul>
                </nav>
            `;

            $("#pagination-controls").html(paginationHtml); // Update pagination container
        }

        // Function to change the page
        window.changePage = function (page) {
            if (page >= 1 && page <= totalPages) {
                currentPage = page;
                renderPage(currentPage);
            }
        };

        // Initial render
        renderPage(currentPage);
    } else {
        $("#recently-viewed-cars-list").html(`
            <div class="no-engagement">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <p>You have no recently viewed cars yet.</p>
                <button onclick="startSearching()">Start Searching</button>
            </div>
        `);
    }
}

function populateSelect(elementId, min, max, step) {
            const select = document.getElementById(elementId);
            for (let i = min; i <= max; i += step) {
                const option = document.createElement("option");
                option.value = i;
                option.text = i.toLocaleString();
                select.appendChild(option);
            }
        }

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

<script>
    // Prevent dropdown from closing when clicking inside the dropdown
    document.querySelector('.dropdown-menuFilter').addEventListener('click', function (event) {
        event.stopPropagation();
    });
    document.querySelector('.dropdown-menuProvince').addEventListener('click', function (event) {
        event.stopPropagation();
    });
    // Close dropdown when clicking outside the dropdown
    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('makeDropdown');
        var dropdownMenu = document.querySelector('.dropdown-menuFilter');

        if (!dropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            $(dropdownMenu).removeClass('show');
            $(dropdown).attr('aria-expanded', 'false');
        }
    });
    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('provinceDropdown');
        var dropdownMenu = document.querySelector('.dropdown-menuProvince');

        if (!dropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
            $(dropdownMenu).removeClass('show');
            $(dropdown).attr('aria-expanded', 'false');
        }
    });

    
    document.addEventListener('click', function (event) {
        var dropdown = document.getElementById('search-results');
       // var dropdownMenu = document.querySelector('.dropdown-menu');

        if (!dropdown.contains(event.target)) {
            $(dropdown).removeClass('show');
            $(dropdown).attr('aria-expanded', 'false');
        $("#appendlistofSelcted").hide();
        }
    });
   
    // Toggle dropdown manually
    document.getElementById('makeDropdown').addEventListener('click', function (event) {
        var dropdownMenu = document.querySelector('.dropdown-menuFilter');
        if (dropdownMenu.classList.contains('show')) {
            $(dropdownMenu).removeClass('show');
            $(this).attr('aria-expanded', 'false');
        } else {
            $(dropdownMenu).addClass('show');
            $(this).attr('aria-expanded', 'true');
        }
    });

    document.getElementById('provinceDropdown').addEventListener('click', function (event) {
        var dropdownMenu = document.querySelector('.dropdown-menuProvince');
        if (dropdownMenu.classList.contains('show')) {
            $(dropdownMenu).removeClass('show');
            $(this).attr('aria-expanded', 'false');
        } else {
            $(dropdownMenu).addClass('show');
            $(this).attr('aria-expanded', 'true');
        }
    });
    



    document.getElementById('keyword').addEventListener('input', function() {
    var keyword = this.value.toLowerCase();
    var resultsContainer = document.getElementById('search-results');
    resultsContainer.innerHTML = ''; // Clear previous results
        
    var carBrands=@json($carBrands);
    var carModels=@json($Carmodels);
    var carVariants=@json($Carvariants);

    // Filter car brands
    var filteredBrands = carBrands.filter(function(brand) {
        return brand.name.toLowerCase().includes(keyword);
    });

    // Filter car models
    var filteredModels = carModels.filter(function(model) {
        return model.name.toLowerCase().includes(keyword);
    });

    // Filter variants
    var filteredVariants = carVariants.filter(function(variant) {
        return variant.name.toLowerCase().includes(keyword);
    });

    // Display filtered brands
    filteredBrands.forEach(function(brand) {

        var brandItem = document.createElement('div');
        brandItem.className = 'dropdown-item';
        brandItem.innerHTML = `
            <div class="form-check d-flex justify-content-between align-items-center">
                <div>
                    <input onchange='getSelectedCheckFilterOnSearch(${brand.id}, "brand","${brand.name}")' class="form-check-input make-checkbox" type="checkbox" name="make[]" id="brand-${brand.id}" value="${brand.id}">
                    <label class="form-check-label" for="make-${brand.name}">
                        ${brand.name} (${brand.vehicle_count})
                    </label>
                </div>
            </div>
        `;
        resultsContainer.appendChild(brandItem);
    });

    // Display filtered models
    filteredModels.forEach(function(model) {
        var modelItem = document.createElement('div');
        modelItem.className = 'dropdown-item';
        modelItem.innerHTML = `
            <div class="form-check d-flex justify-content-between align-items-center">
                <div>
                    <input onchange='getSelectedCheckFilterOnSearch(${model.id}, "model","${model.name}")' class="form-check-input" type="checkbox" name="model[]" id="model-${model.id}" value="${model.id}">
                    <label class="form-check-label" for="model-${model.name}">
                        ${model.name} (${model.vehicle_count})
                    </label>
                </div>
            </div>
        `;
        resultsContainer.appendChild(modelItem);
    });

    // Display filtered variants
    filteredVariants.forEach(function(variant) {
        var variantItem = document.createElement('div');
        variantItem.className = 'dropdown-item';
        variantItem.innerHTML = `
            <div class="form-check d-flex justify-content-between align-items-center">
                <div>
                    <input onchange='getSelectedCheckFilterOnSearch(${variant.id}, "variant","${variant.name}")' class="form-check-input" type="checkbox" name="variant[]" id="variant-${variant.id}" value="${variant.id}">
                    <label class="form-check-label" for="variant-${variant.name}">
                        ${variant.name} (${variant.vehicle_count})
                    </label>
                </div>
            </div>
        `;
        resultsContainer.appendChild(variantItem);
    });

    // Show the results container
    resultsContainer.classList.add('show');
    $("#appendlistofSelcted").show();
    
    
});

var selectedFilters=[];
function getSelectedCheckFilterOnSearch(id, typesearch, value,filter=""){
        var getInputToCheckIfChecked=document.getElementById(typesearch + "-" + id);
        if(getInputToCheckIfChecked.checked){
            // Add id to selectedFilters array
            if(selectedFilters.indexOf(id) === -1){ // Check if id is not already in the array
                var obj={}
                obj["key"]=typesearch
                obj["id"]=id
                selectedFilters.push(obj);

                //use this function to clear the button text and set aas per what is selected on the filters
                    $('#makeDropdown').css({
                    'font-size': '11px',
                    'overflow': 'hidden'
                    });
                if(filter=="filter"){
                   var filterdata= $(`#makeDropdown`).text();
                   if(filterdata.includes("Select a Car")){
                        $(`#makeDropdown`).text(''); 
                    $(`#makeDropdown`).text(", "+ value);
                   }else{
                    var filterdata= $(`#makeDropdown`).text(); 
                    $(`#makeDropdown`).text(filterdata + ", " + value);
                   }

                }else{
                    $("#appendlistofSelcted").append( "<li id='"+typesearch+ id +"'>"+ value + "</li>");
                    $("#appendlistofSelcted").show()
                }
             
            }else{
                
            }
        
        }else{
            // Remove id from selectedFilters array
            var selectedid=typesearch + id
            
            var index = -1
           for (let i = 0; i < selectedFilters.length; i++) {
                if (selectedFilters[i].key === typesearch && selectedFilters[i].id === id) {
                    index = i;
                    break;
                }
                }
            if(index!== -1){
                selectedFilters.splice(index, 1);
                if(filter=="filter"){
                    var filterdata= $(`#makeDropdown`).text();
                    var filterdata= filterdata.replace(", " + value, "");
                    $(`#makeDropdown`).val(filterdata);
                    if(filterdata.includes(", ")){
                        $(`#makeDropdown`).text(filterdata.replace(",,", ""));
                    }else{
                        $(`#makeDropdown`).text("Select a Car (s)");
                    }
                }else{
                    $("#"+selectedid).remove();
                }

               
            }
        }
        
    }

    function resetFormAdvanced(){
        // Reset selected filters array
        selectedFilters=[];
        // Reset dropdown text
        $('#makeDropdown').text('Select a Car (s)');
        // Reset checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });
        // Reset search input
        $('#keyword').val('');
        // Reset search results
        var resultsContainer = document.getElementById('search-results');
        resultsContainer.innerHTML = '';
        document.getElementById('searchForm').reset();
        $("#appendlistofSelcted").hide();
        $("#appendlistofSelcted").empty();
        
    }

    $("#searchForm").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Clear previous dynamic inputs
        $(".dynamic-input").remove();

        // Iterate through selectedFilters and create inputs
        for (let i = 0; i < selectedFilters.length; i++) {
            let obj = selectedFilters[i];
            let inputName;
            switch (obj.key) {
                case 'brand':
                    inputName = 'car_brand_id[]';
                    break;
                case 'model':
                    inputName = 'car_model_id[]';
                    break;
                case 'variant':
                    inputName = 'car_variant_id[]';
                    break;
                default:
                    continue; // Skip if key is not recognized
            }

            // Create and append the input element
            let input = $('<input>')
                .attr('type', 'hidden')
                .attr('name', inputName)
                .attr('value', obj.id)
                .addClass('dynamic-input'); // Add a class for easy removal

            $(this).append(input);
        }
        

        // Submit the form
        this.submit();o
    });

    $(document).ready(function(){
            var c= @json($latestCars)
    })

function getSelectedCheckFilterOnSearchProvince(){
    
}


</script>



@endsection

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