

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
        width: 100%;
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
</style>
<div class="container" style="background: linear-gradient(to right, #f8f9fa, #e9ecef); ">
    <!-- Latest Featured Vehicles Row -->

    <div class="col-md-8">
    <h2>News</h2>
    <hr style="border-top: 2px solid blue;">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-4">
                    <div class="card" style="height: 100%;">
                        <?php if($item->images->first()): ?>
                        <img id="mainImageNews<?php echo e($item->news_id); ?>" src="<?php echo e(asset('storage/' . $item->images->first()->image_url)); ?>" class="d-block w-100 main-image" alt="News Image" style="height: 30vh; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($item->title); ?></h5>
                            <p class="card-text"><?php echo e(Str::limit($item->content, 150)); ?></p>
                            <a href="<?php echo e(route('news.show', $item->news_id)); ?>" class="btn btn-primary">Read More</a>
                            <p><strong>Author:</strong> <?php echo e($item->author->name); ?></p>
                            <p><strong>Category:</strong> <?php echo e($item->category_name); ?></p>
                            <p><strong>Published At:</strong> <?php echo e($item->published_at); ?></p>
                        </div>
                        <div class="carousel-thumbnails mt-2 d-flex justify-content-center">
                            <?php $__currentLoopData = $item->images->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($image->image_url): ?>
                            <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail thumbnail" alt="Thumbnail" style="width: 80px; height: 80px; cursor: pointer; border: none;" data-main-image-id="mainImageNews<?php echo e($item->news_id); ?>">
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php if($item->images->count() > 3): ?>
                            <div class="more-images">
                                <a href="<?php echo e(route('news.show', ['id' => $item->news_id])); ?>" class="btn btn-link">+<?php echo e($item->images->count() - 3); ?> more</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="advanced-search" style="background: linear-gradient(to bottom, red, blue); padding: 20px; color: white;">
                <h4>Advanced Search</h4>
                <form>
                    <div class="form-group">
                        <label for="sort">Sort By</label>
                        <select class="form-control" id="sort">
                            <option>Newest</option>
                            <option>Oldest</option>
                            <option>Most Popular</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filter">Filter</label>
                        <select class="form-control" id="filter">
                            <option>All</option>
                            <option>Category 1</option>
                            <option>Category 2</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-light">Apply</button>
                </form>
            </div>
            <div class="google-ad mt-4" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/300x250?text=Ad" alt="Ad" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
</div>


    
    <div class="row mb-4">
    <div class="col-12">
        <h2>Latest Featured Vehicles <a href="<?php echo e(route('cars.index', ['type' => 'featured'])); ?>" class="btn btn-link">View All</a></h2>
    </div>
    <?php $__currentLoopData = $latestFeaturedVehicles->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-4">
            <div class="card" onclick="location.href='<?php echo e(route('cars.show', $listing->vehicle_id)); ?>';" style="cursor: pointer;">
                <?php if($listing->vehicle->images->isNotEmpty()): ?>
                    <div class="main-image-container">
                        <img id="mainImageFeatured<?php echo e($listing->id); ?>" src="<?php echo e(asset('storage/' . $listing->vehicle->images->first()->image_url)); ?>" class="d-block w-100 main-image" alt="Vehicle Image">
                        <span class="image-count">
                            <i class="fas fa-camera"></i> <?php echo e($listing->vehicle->images->count()); ?>

                        </span>
                    </div>
                <?php else: ?>
                    <div class="main-image-container">
                        <img src="default-image.jpg" class="d-block w-100 main-image" alt="Default Image">
                    </div>
                <?php endif; ?>
                <div class="row thumbnails">
                    <?php $__currentLoopData = $listing->vehicle->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-4">
                            <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail thumbnail-image" alt="Thumbnail">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-car"></i> <?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>

                    </h5>
                    <p class="card-text">
                        <i class="fas fa-calendar-alt"></i> <?php echo e($listing->vehicle->year); ?> &nbsp; 
                        <i class="fas fa-road"></i> <?php echo e($listing->vehicle->mileage); ?> km &nbsp; 
                        <i class="fas fa-money-bill-wave"></i> R<?php echo e(number_format($listing->vehicle->price, 2)); ?> &nbsp;
                    </p>
                    <p class="card-text text-danger">
                        R<?php echo e(number_format(calculateMonthlyPayment($listing->vehicle->price), 2)); ?> p/m 
                        <span class="badge" style="background-color: <?php echo e($listing->vehicle->condition == 'used' ? 'red' : 'blue'); ?>;">
                            <?php echo e(ucfirst($listing->vehicle->condition)); ?>

                        </span>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

    <!-- Ad Placeholder -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="google-ad" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/728x90?text=Ad" alt="Ad" class="img-fluid">
                </a>
            </div>
        </div>
    </div>

    <!-- Sponsored Vehicles and News Row -->
    <div class="row mb-4">
    <h2>Sponsored Vehicles</h2>
    <?php $__currentLoopData = $sponsoredVehicles->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-4" onclick="location.href='<?php echo e(route('cars.show', $listing->vehicle_id)); ?>';" style="cursor: pointer;">
            <?php if($listing->vehicle->images->isNotEmpty()): ?>
                <div class="main-image-container">
                    <img id="mainImageSponsored<?php echo e($listing->id); ?>" src="<?php echo e(asset('storage/' . $listing->vehicle->images->first()->image_url)); ?>" class="d-block w-100 main-image" alt="Vehicle Image">
                    <span class="position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 20px; left: 0;">
                    <i class="fas fa-camera"></i> <?php echo e($listing->vehicle->images->count()); ?>

                    </span>
                </div>
            <?php else: ?>
                <div class="main-image-container">
                    <img src="default-image.jpg" class="d-block w-100 main-image" alt="Default Image">
                </div>
            <?php endif; ?>
            <div class="row thumbnails">
                <?php $__currentLoopData = $listing->vehicle->images->slice(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-4">
                        <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail thumbnail-image" alt="Thumbnail">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <i class="fas fa-car"></i> <?php echo e($listing->vehicle->make); ?> <?php echo e($listing->vehicle->model); ?>

                </h5>
                <p class="card-text">
                    <i class="fas fa-calendar-alt"></i> <?php echo e($listing->vehicle->year); ?> &nbsp; 
                    <i class="fas fa-road"></i> <?php echo e($listing->vehicle->mileage); ?> km &nbsp; 
                    <i class="fas fa-money-bill-wave"></i> R<?php echo e(number_format($listing->vehicle->price, 2)); ?> &nbsp;
                </p>
                <p class="card-text text-danger">
                    R<?php echo e(number_format(calculateMonthlyPayment($listing->vehicle->price), 2)); ?> p/m 
                    <span class="badge" style="background-color: <?php echo e($listing->vehicle->condition == 'used' ? 'red' : 'blue'); ?>;">
                        <?php echo e(ucfirst($listing->vehicle->condition)); ?>

                    </span>
                </p>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($sponsoredVehicles->count() < 3): ?>
        <?php for($i = $sponsoredVehicles->count(); $i < 3; $i++): ?>
            <div class="google-ad mb-4" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/300x250?text=Ad" alt="Ad" class="img-fluid">
                </a>
            </div>
        <?php endfor; ?>
    <?php endif; ?>
</div>
</div>

   

    <!-- Car Marketplace Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Explore the Car Marketplace</h2>
            <p>Welcome to our car marketplace, where you can find a wide range of vehicles to suit your needs and preferences. Whether you're looking for the latest models, budget-friendly options, or luxury cars, we have something for everyone. Browse through our extensive listings, compare features, and find the perfect car for you.</p>
            <p>Our marketplace is designed to provide you with a seamless and enjoyable experience. Use our advanced search and filter options to narrow down your choices, and take advantage of our detailed vehicle descriptions and high-quality images to make an informed decision. Happy car hunting!</p>
        </div>
    </div>

    <!-- Viewed Cars Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h2>Cars You've Viewed</h2>
            <div class="row">
                <?php $__currentLoopData = session('viewed_cars', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $viewedCar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo e(asset('storage/' . $viewedCar['image_url'])); ?>" class="d-block w-100" alt="Viewed Car Image" style="height: 30vh; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-car"></i> <?php echo e($viewedCar['make']); ?> <?php echo e($viewedCar['model']); ?></h5>
                            <p class="card-text"><i class="fas fa-calendar-alt"></i> <?php echo e($viewedCar['year']); ?> - <i class="fas fa-dollar-sign"></i> R<?php echo e(number_format($viewedCar['price'], 2)); ?></p>
                            <a href="<?php echo e(route('cars.show', ['id' => $viewedCar['id']])); ?>" class="btn btn-primary">Learn More</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Google Ads Column -->
    <div class="row">
        <div class="col-md-12">
            <h2>Sponsored Ads</h2>
            <div class="google-ad" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/728x90?text=Cars.co.za+Ad" alt="Cars.co.za Ad" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
</div>
</div>
<script>

</script>
<?php $__env->stopSection(); ?>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/public/news/index.blade.php ENDPATH**/ ?>