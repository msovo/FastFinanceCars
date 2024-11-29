

<?php $__env->startSection('content'); ?>

<style>
    .card {
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .main-image-container {
        position: relative;
        overflow: hidden;
        max-height: 300px; /* Adjust the height as needed */
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
        max-height: 80px;
        overflow: hidden;
    }
    .thumbnail-image {
        width: 100%;
        max-height: auto;
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



    .car-listing {
        margin-top: 20px;
    }
    .car-card {
        margin-bottom: 20px;
        position: relative;
    }
    .ribbon {
        position: absolute;
        top: 23px;
        right: -5px;
        z-index: 1;
        overflow: hidden;
        width: 75px;
        height: 75px;
        text-align: right;
    }
    .ribbon span {
        font-size: 10px;
        font-weight: bold;
        color: #FFF;
        text-transform: uppercase;
        text-align: center;
        line-height: 20px;
        width: 100px;
        display: block;
        background: #79A70A;
        background: linear-gradient(#2989d8 0%, #1e5799 100%);
        box-shadow: 0 3px 10px -5px rgba(0, 0, 0, 1);
        position: absolute;
        top: 19px;
        left: -21px;
    }
    .ribbon span::before {
        content: "";
        position: absolute;
        left: 0px;
        top: 100%;
        z-index: -1;
        border-left: 3px solid #1e5799;
        border-right: 3px solid transparent;
        border-bottom: 3px solid transparent;
        border-top: 3px solid #1e5799;
    }
    .ribbon span::after {
        content: "";
        position: absolute;
        right: 0px;
        top: 100%;
        z-index: -1;
        border-left: 3px solid transparent;
        border-right: 3px solid #1e5799;
        border-bottom: 3px solid transparent;
        border-top: 3px solid #1e5799;
    }
    .ads {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }
    .filter-section h3 {
        font-size: 1.25rem;
        margin-bottom: 1rem;
    }
    .filter-section .filter-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .filter-section .filter-item img {
        width: 24px;
        height: 24px;
        margin-right: 0.5rem;
    }
    .filter-section .filter-item label {
        margin: 0;
    }
    .car-details h5 {
        margin-bottom: 0.5rem;
    }
    .car-details .price {
        color: red;
        font-weight: bold;
    }
    .car-details .specs {
        display: flex;
        justify-content: space-between;
    }
    .car-details .specs div {
        display: flex;
        align-items: center;
    }
    .car-details .specs img {
        width: 16px;
        height: 16px;
        margin-right: 0.25rem;
    }
    .love-icon {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        color: red;
        cursor: pointer;
    }
</style>
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
 
.advanced-search {
    position: absolute;
    top: 20vh;
    left: 0; 
    background-color: #cccccc;
    padding: 20px;
    color: white;
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

</style>
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

       <div class="form-row">
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
        </div> 

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
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
          
        </div>

        <div class="col-md-8">
        <div class="car-listing">
    <h2>Search Results</h2>
    <?php if($cars->isEmpty()): ?>
        <p>No cars found matching your criteria.</p>
    <?php else: ?>

    <div class="row">
    <?php $__currentLoopData = $cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-12 car-card">
            <div class="card" onclick="location.href='<?php echo e(route('cars.show', $car->vehicle_id)); ?>';" style="cursor: pointer;">
                <div class="love-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="row no-gutters">
                    <div class="col">
                        <?php if($car->images->isNotEmpty()): ?>
                            <div class="main-image-container">
                                <img src="<?php echo e(asset('storage/' . $car->images->first()->image_url)); ?>" class="card-img main-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?>">
                                <span class="image-count" style="bottom: 20px; left: 0;">
                                    <i class="fas fa-camera"></i> <?php echo e($car->images->count()); ?>

                                </span>
                            </div>
                            <div class="row thumbnails">
                        <?php $__currentLoopData = $car->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-4">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="thumbnail-image" alt="<?php echo e($car->make); ?> <?php echo e($car->model); ?> thumbnail" style="width: 100%;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <?php else: ?>
                            <div class="main-image-container">
                                <img src="<?php echo e(asset('storage/images/default-car.jpg')); ?>" class="card-img main-image" alt="Default Image">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <div class="card-body car-details">
                            <h5>
                                <i class="fas fa-calendar-alt"></i> <?php echo e($car->year); ?> 
                                <?php echo e($car->make); ?> <?php echo e($car->model); ?>

                            </h5>
                            <h6 class="price">R<?php echo e(number_format($car->price, 2)); ?></h6>
                            <div class="specs">
                                <div>
                                    <i class="fas fa-cogs"></i>    <!-- Transmission -->
                                    <span><?php echo e($car->transmission); ?></span>
                                </div>
                            
                                <div>
                                    <i class="fas fa-tachometer-alt"></i>    <!-- Mileage -->
                                    <span><?php echo e($car->mileage); ?> km</span>
                                </div>
                                <div>
                                    <i class="fas fa-gas-pump"></i>   <!-- Fuel Type -->
                                    <span><?php echo e($car->fuel_type); ?></span>
                                </div>
                            </div>
                            <p class="card-text text-danger">
                                R<?php echo e(number_format(calculateMonthlyPayment($car->price), 2)); ?> p/m 
                                <span class="badge" style="background-color: <?php echo e($car->car_condition == 'Used' ? 'red' : 'blue'); ?>;color:white;">
                                    <?php echo e(ucfirst($car->car_condition)); ?>

                                </span>
                            </p>
                            <?php if($car->listing && $car->listing->listing_status == 'active'): ?>
                                <?php if($car->listing->featured): ?>
                                    <div class="ribbon"><span>Featured</span></div>
                                <?php elseif($car->listing->sponsored): ?>
                                    <div class="ribbon"><span>Sponsored</span></div>
                                <?php elseif($car->created_at && $car->created_at->diffInDays() <= 7): ?>
                                    <div class="ribbon"><span>Recently Listed</span></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

        <div class="d-flex justify-content-center">
            <?php echo e($cars->links()); ?>

        </div>
    <?php endif; ?>
</div>

</div>

        <div class="col-md-1">
            <div class="ads">
                <h3>Advertisements</h3>
                <p>Placeholder for Google ads</p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/cars/index.blade.php ENDPATH**/ ?>