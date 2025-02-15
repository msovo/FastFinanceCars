

<?php $__env->startSection('content'); ?>
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
    .news-reviews .card {
    margin-bottom: 20px;
    border: none; 
    box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
    transition: transform 0.2s; 
}

.news-reviews .card:hover {
    transform: translateY(-5px); 
}

.news-reviews .card-img-top {
    height: 200px; 
    object-fit: cover; 
}

.news-reviews .card-body {
    padding: 15px;
}

.news-reviews .card-title {
    font-size: 1.2rem;
    margin-bottom: 10px;
}
    .thumbnails {
        display: flex;
        justify-content: center; 
        margin-top: 10px; 
    }

    .thumbnail-image {
       max-height: 59px; 
        object-fit: cover;
        margin: 0 5px; 
        cursor: pointer; 
    }

    .timeline {
        position: relative;
        padding: 20px 0;
        list-style: none;
        text-align: center;
    }

    .timeline:before {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -1px;
        width: 2px;
        background: #C5C5C5;
    }

    .timeline-item {
        position: relative;
        margin: 20px 0;
    }

    .timeline-item:before,
    .timeline-item:after {
        content: '';
        display: table;
    }

    .timeline-item:after {
        clear: both;
    }

    .timeline-item .timeline-img {
        position: absolute;
        left: 50%;
        width: 100px;
        height: 100px;
        margin-left: -50px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #C5C5C5;
        overflow: hidden;
    }

    .timeline-item .timeline-img img {
        width: 100%;
        height: auto;
    }

    .timeline-item .timeline-content {
        position: relative;
        width: 45%;
        padding: 20px;
        background: #fff;
        border: 1px solid #C5C5C5;
        border-radius: 5px;
        text-align: left;
    }

    .timeline-item:nth-child(odd) .timeline-content {
        left: 0;
    }

    .timeline-item:nth-child(even) .timeline-content {
        left: 55%;
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
    top: 13vh;
    left: 10.5%; 
    background-color: #c0392b;
    padding: 20px;
    color: white;
    width: 35%; 
    z-index: 99;
    border-radius: 10px; 
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
</style>

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
            <img src="<?php echo e(asset('storage/images/a.jpg')); ?>" class="d-block w-100" alt="Car 1">
        </div>
        <div class="carousel-item">
            <img src="<?php echo e(asset('storage/images/c.jpg')); ?>" class="d-block w-100" alt="Car 2">
        </div>
        <div class="carousel-item">
            <img src="<?php echo e(asset('storage/images/b.jpg')); ?>" class="d-block w-100" alt="Car 3">
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
<div class="advanced-search">
    <form id="searchForm" action="<?php echo e(route('cars.search')); ?>" method="GET">
        <div class="form-group">
            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Keyword Search (Make, Model, Variant)">
        </div>

        <div class="form-row mt-0">
            <div class="form-group col-12 col-md-6"> 
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="provinceDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Province(s)
                    </button>
                    <div class="dropdown-menu" aria-labelledby="provinceDropdown">
                        <div class="province-checkboxes">
                            <!-- Province checkboxes here -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group col-12 col-md-6"> 
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle w-100" type="button" id="makeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select a Car(s) 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="makeDropdown">
                        <?php $__currentLoopData = $makes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $make): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dropdown-item">
                                <div class="form-check d-flex justify-content-between align-items-center">
                                    <div>
                                        <input class="form-check-input make-checkbox" type="checkbox" name="make[]" id="make-<?php echo e($make); ?>" value="<?php echo e($make); ?>">
                                        <label class="form-check-label" for="make-<?php echo e($make); ?>">
                                            <?php echo e($make); ?>

                                        </label>
                                    </div>
                                    <button type="button" class="btn btn-sm expand-models-btn collapsed" data-make="<?php echo e($make); ?>" data-toggle="collapse" data-target="#models-<?php echo e($make); ?>">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                                <div class="collapse" id="models-<?php echo e($make); ?>">
                                    <!-- Models will be loaded here -->
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                <select class="form-control" id="minYear" name="minYear">
                    <option value="">Select Min Year</option>
                    <?php for($year = date('Y'); $year >= 1990; $year--): ?>
                        <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <select class="form-control" id="maxYear" name="maxYear">
                    <option value="">Select Max Year</option>
                    <?php for($year = date('Y'); $year >= 1990; $year--): ?>
                        <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <select class="form-control" id="minPrice" name="minPrice">
                    <option value="">Select Min Price</option>
                    <!-- Add price options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <select class="form-control" id="maxPrice" name="maxPrice">
                    <option value="">Select Max Price</option>
                    <!-- Add price options here -->
                </select>
            </div>
        </div>

<!--         <div class="form-row">
            <div class="form-group col-md-6">
                <label for="minMileage">Min Mileage</label>
                <select class="form-control" id="minMileage" name="minMileage">
                    <option value="">Select Min Mileage</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="maxMileage">Max Mileage</label>
                <select class="form-control" id="maxMileage" name="maxMileage">
                    <option value="">Select Max Mileage</option>
                 
                </select>
            </div>
        </div> -->

        <a href="#" id="toggleMoreFilters">More Filters</a>

        <div class="more-filters">
            <button class="close-btn" id="closeFilters">×</button>
            <?php $__currentLoopData = $categoryTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="category-section">
                    <div class="category-header"><?php echo e($categoryType); ?></div>
                    <div class="category-body">
                        <?php $__currentLoopData = $categories[$categoryType]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="button" class="btn btn-outline-secondary filter-btn" data-filter-name="<?php echo e(str_replace(' ', '_', strtolower($categoryType))); ?>" data-filter-value="<?php echo e($category->category_name); ?>">
                                <?php echo e($category->category_name); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
<div class="row">
        <button type="submit" class="btn btn-primary col">Search Cars</button>
        <button type="button" class="btn btn-secondary col" id="resetFilters">Reset Filters</button>
        </div>
    </form>
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
  
    


    <div class="car-listingFeture">
    <h2>Featured Cars</h2>
    <div class="row">
        <?php $__currentLoopData = $featuredCars->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='<?php echo e(route('cars.show', $car->vehicle_id)); ?>';" style="cursor: pointer;">
                    <?php if($car->images->isNotEmpty()): ?>
                        <div class="main-image-container">
                            <img src="<?php echo e(asset('storage/' . $car->images->first()->image_url)); ?>" class="card-img-top main-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>">
                            <span class="image-count" style="bottom: 20px; left: 0;">
                                <i class="fas fa-camera"></i> <?php echo e($car->images->count()); ?>

                            </span>
                        </div>
                    <?php else: ?>
                        <div class="main-image-container">
                            <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image">
                        </div>
                    <?php endif; ?>
                    <div class="row thumbnails">
                        <?php $__currentLoopData = $car->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-4">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="thumbnail-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?> thumbnail">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-alt"></i> <?php echo e($car->year); ?> &nbsp; 
                            <?php echo e($car->make); ?> <?php echo e($car->model); ?>

                        </h5>
                        <p class="card-text">
                            <i class="fas fa-cogs"></i> <?php echo e($car->transmission); ?> &nbsp; 
                            <i class="fas fa-road"></i> <?php echo e($car->mileage); ?> km &nbsp; 
                        </p>
                        <p class="card-text-price text-danger">
                       R<?php echo e(number_format($car->price, 2)); ?> &nbsp;
                        </p>
                        <p class="card-text-p text-danger">
                            R<?php echo e(number_format(calculateMonthlyPayment($car->price), 2)); ?> p/m 
                            <span class="badge" style="background-color: <?php echo e($car->car_condition == 'Used' ? 'red' : 'blue'); ?>;color:white;">
                                <?php echo e($car->car_condition); ?>

                            </span>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<div class="sponsored-cars">
    <h2 class="section-title">Sponsored Cars</h2>
    <div class="row">
        <?php $__currentLoopData = $sponsoredCars->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='<?php echo e(route('cars.show', $car->vehicle_id)); ?>';" style="cursor: pointer;">
                    <?php if($car->images->isNotEmpty()): ?>
                        <div class="position-relative">
                            <img src="<?php echo e(asset('storage/' . $car->images->first()->image_url)); ?>" class="card-img-top main-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>" style="width: 100%;">
                            <span class="image-count" style="bottom: 20px; left: 0;">
                                <i class="fas fa-camera"></i> <?php echo e($car->images->count()); ?>

                            </span>
                        </div>
                    <?php else: ?>
                        <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image" style="width: 100%; height: auto;">
                    <?php endif; ?>
                    <div class="row thumbnails">
                        <?php $__currentLoopData = $car->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-4">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="thumbnail-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?> thumbnail" style="width: 100%;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-alt"></i> <?php echo e($car->year); ?>   
                            <?php echo e($car->make); ?> <?php echo e($car->model); ?>

                        </h5>
                        <p class="card-text">
                            <i class="fas fa-cogs"></i> <?php echo e($car->transmission); ?>   
                            <i class="fas fa-road"></i> <?php echo e($car->mileage); ?> km   
                        </p>
                        <p class="card-text-price text-danger">
                          
                          R<?php echo e(number_format($car->price, 2)); ?> &nbsp;
                      </p>

                        <p class="card-text-p text-danger">
                            R<?php echo e(number_format(calculateMonthlyPayment($car->price), 2)); ?> p/m 
                            <span class="badge" style="background-color: <?php echo e($car->car_condition == 'Used' ? 'red' : 'blue'); ?>;color:white;">
                                <?php echo e(ucfirst($car->car_condition)); ?>

                            </span>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php $__currentLoopData = $latestCars->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
            <div class="col-md-4 car-card">
                <div class="card" onclick="location.href='<?php echo e(route('cars.show', $car->vehicle_id)); ?>';" style="cursor: pointer;">
                    <?php if($car->images->isNotEmpty()): ?>
                        <div class="position-relative">
                            <img src="<?php echo e(asset('storage/' . $car->images->first()->image_url)); ?>" class="card-img-top main-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>" style="width: 100%;">
                            <span class="position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 0; left: 0;">
                                <i class="fas fa-camera"></i> <?php echo e($car->images->count()); ?>

                            </span>
                        </div>
                    <?php else: ?>
                        <img src="default-image.jpg" class="card-img-top main-image" alt="Default Image" style="width: 100%; height: auto;">
                    <?php endif; ?>
                    <div class="row thumbnails">
                        <?php $__currentLoopData = $car->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-4">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="thumbnail-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?> thumbnail" style="width: 100%;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-calendar-alt"></i> <?php echo e($car->year); ?>   
                            <?php echo e($car->make); ?> <?php echo e($car->model); ?>

                        </h5>
                        <p class="card-text">
                            <i class="fas fa-cogs"></i> <?php echo e($car->transmission); ?>   
                            <i class="fas fa-road"></i> <?php echo e($car->mileage); ?> km   
                        </p>
                        <p class="card-text-price text-danger">
                          
                          R<?php echo e(number_format($car->price, 2)); ?> &nbsp;
                      </p>

                        <p class="card-text-p text-danger">
                            R<?php echo e(number_format(calculateMonthlyPayment($car->price), 2)); ?> p/m 
                            <span class="badge" style="background-color: <?php echo e($car->car_condition == 'Used' ? 'red' : 'blue'); ?>;color:white;">
                                <?php echo e($car->car_condition); ?>

                            </span>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>






<div class="container news-reviews">
    <h2 class="section-title text-center">News & Reviews</h2>
    <div class="news-grid d-md-none"> 
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row news-item">
                <div class="col-4"> 
                    <?php if($article->thumbnail_url): ?>
                        <img src="<?php echo e(asset('storage/' . $article->thumbnail_url)); ?>" alt="Thumbnail" class="img-fluid">
                    <?php endif; ?>
                </div>
                <div class="col-8"> 
                    <h5><?php echo e($article->title); ?></h5>
                    <p><?php echo e(Str::limit($article->content, 100)); ?></p>
                    <a href="<?php echo e(route('news.show', $article->news_id)); ?>" class="btn btn-secondary">Read More</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    </div>

    <div class="timeline d-none d-md-block"> 
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="timeline-item">
                <div class="timeline-img">
                    <?php if($article->thumbnail_url): ?>
                        <img src="<?php echo e(asset('storage/' . $article->thumbnail_url)); ?>" alt="Thumbnail" class="img-fluid">
                    <?php endif; ?>
                </div>
                <div class="timeline-content">
                    <h4><?php echo e($article->title); ?></h4>
                    <p><?php echo e(Str::limit($article->content, 100)); ?></p>
                    <a href="<?php echo e(route('news.show', $article->news_id)); ?>" class="btn btn-secondary">Read More</a>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="text-center mt-4">
        <a href="<?php echo e(route('news.index')); ?>" class="btn btn-primary">View All News</a>
    </div>
</div>



    <div class="make-analysis">
        <h2>Make Analysis</h2>
        <canvas id="makeAnalysisChart"></canvas>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
            labels: <?php echo json_encode($makeLabels, 15, 512) ?>, 
            datasets: [{
                label: 'Number of Listings',
                data: <?php echo json_encode($makeCounts, 15, 512) ?>, 
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


$(document).ready(function() {

        populateSelect("minPrice", 5000, 1500000, 25000);
        populateSelect("maxPrice", 5000, 1500000, 25000);
        populateSelect("minMileage", 0, 500000, 5000);
        populateSelect("maxMileage", 0, 500000, 5000);
    // Handle Make checkbox changes (to show/hide models)
    $('.dropdown-menu').on('click', '.expand-models-btn', function() {
        var make = $(this).data('make');
        var modelsContainer = $('#models-' + make);

        // Toggle the collapse
        modelsContainer.collapse('toggle');

        if (modelsContainer.find('.models-list').length === 0) {
            // AJAX call to fetch models
            $.ajax({
                url: '/get-models',
                type: 'GET',
                data: { make: make },
                success: function(response) {
                    var modelsHtml = '<div class="models-list">';
                    $.each(response, function(index, model) {
                        modelsHtml += '<div class="form-check d-flex justify-content-between align-items-center">';
                        modelsHtml += '<div>';
                        modelsHtml += '<input class="form-check-input" type="checkbox" name="model[]" id="model-' + model + '" value="' + model + '">';
                        modelsHtml += '<label class="form-check-label" for="model-' + model + '">' + model + '</label>';
                        modelsHtml += '</div>';
                        modelsHtml += '<button type="button" class="btn btn-sm expand-variants-btn collapsed" data-make="' + make + '" data-model="' + model + '" data-toggle="collapse" data-target="#variants-' + make + '-' + model + '">';
                        modelsHtml += '<i class="fas fa-chevron-right"></i>';
                        modelsHtml += '</button>';
                        modelsHtml += '</div>';
                        modelsHtml += '<div class="collapse" id="variants-' + make + '-' + model + '">';
                        modelsHtml += '</div>';
                    });
                    modelsHtml += '</div>';
                    modelsContainer.html(modelsHtml);
                }
            });
        }

       
    });

    $('.dropdown-menu').on('click', '.expand-variants-btn', function() {
        var make = $(this).data('make');
        var model = $(this).data('model');
        var variantsContainer = $('#variants-' + make + '-' + model);

        // Toggle the collapse
        variantsContainer.collapse('toggle');

        if (variantsContainer.find('.variants-list').length === 0) {
            // AJAX call to fetch variants
            $.ajax({
                url: '/get-variants',
                type: 'GET',
                data: { make: make, model: model },
                success: function(response) {
                    var variantsHtml = '<div class="variants-list">';
                    $.each(response, function(index, variant) {
                        variantsHtml += '<div class="form-check">';
                        variantsHtml += '<input class="form-check-input" type="checkbox" name="variant[]" id="variant-' + variant + '" value="' + variant + '">';
                        variantsHtml += '<label class="form-check-label" for="variant-' + variant + '">' + variant + '</label>';
                        variantsHtml += '</div>';
                    });
                    variantsHtml += '</div>';
                    variantsContainer.html(variantsHtml);
                }
            });
        }
    });

    
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
function listRecentViewedCars()
{
    $("#recently-viewed-cars-list").html('')
    var recentlyViewedCars = getCookie("recentlyViewedCars");
            if (recentlyViewedCars) {
                recentlyViewedCars = JSON.parse(recentlyViewedCars);
                var container = $("#recently-viewed-cars");

                recentlyViewedCars.forEach(function(car) {
                    var carHtml = `
                        <div class="col-md-4 car-card" id="content-engagement">
                            <div class="card" onclick="location.href='/cars/${car.id}';" style="cursor: pointer;">
                                ${car.images.length > 0 ? `
                                <div class="main-image-container">
                                    <img src="${car.images[0].url}" class="card-img-top main-image" alt="${car.make} ${car.model}">
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
                                        <img src="${image.url}" class="thumbnail-image" alt="${car.make} ${car.model} thumbnail">
                                    </div>`).join('')}
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <i class="fas fa-calendar-alt"></i> ${car.year} ${car.make} ${car.model}
                                    </h5>
                                    <p class="card-text">
                                        <i class="fas fa-cogs"></i> ${car.transmission} 
                                        <i class="fas fa-road"></i> ${car.mileage} km 
                                    </p>
                                      <p class="card-text-price text-danger">
                          
                                         R${car.price.toFixed(2)}
                                   </p>
                                    <p class="card-text-p text-danger">
                                        R${calculateMonthlyPayment(car.price)} p/m 
                                        <span class="badge" style="background-color: ${car.car_condition === 'used' ? 'red' : 'blue'};color:white;">
                                            ${car.car_condition}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#recently-viewed-cars-list').append(carHtml)
                   // container.append(carHtml);
                });
            }else {
                $('#recently-viewed-cars-list').html(`
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
<?php $__env->stopSection(); ?>

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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/home.blade.php ENDPATH**/ ?>