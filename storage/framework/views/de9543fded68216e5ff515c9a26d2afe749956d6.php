

<?php $__env->startSection('content'); ?>
<style>

.main-image-container {
    position: relative;
}

.thumbnails {
    overflow-x: auto;
    white-space: nowrap;
}

.thumbnail-image {
    display: inline-block;
    margin-right: 5px;
    max-width: 100px; /* Adjust the size as needed */
    max-height: 100px; /* Adjust the size as needed */
}
.thumbnail-image {
        display: flex;
        overflow-x: auto;
        margin-top: 10px;
    }
    .thumbnail-image  img {
        width: 100%;
        max-height: 150px;
        cursor: pointer;
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
<div class="container">
<h1><?php echo e($news->title); ?></h1>
<div class="row">
    <!-- Main Image Slider -->
    <div class="col-md-8">
        <div id="newsCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php if($news->thumbnail_url): ?>
                <div class="carousel-item active">
                    <img id="mainImage" src="<?php echo e(asset('storage/' . $news->thumbnail_url)); ?>" class="d-block w-100" alt="Main Image" style="height: 50vh; object-fit: cover;">
                </div>
                <?php endif; ?>
                <?php $__currentLoopData = $news->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($image->image_url): ?>
                <div class="carousel-item">
                    <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="d-block w-100" alt="News Image" style="height: 50vh; object-fit: cover;">
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- Thumbnails -->
        <div class="carousel-thumbnails mt-2">
            <div class="row">
                <?php if($news->thumbnail_url): ?>
                <div class="col">
                    <img src="<?php echo e(asset('storage/' . $news->thumbnail_url)); ?>" class="img-thumbnail related-image" alt="Thumbnail" style="height: 12.5vh; object-fit: cover; cursor: pointer;" data-target="#newsCarousel" data-slide-to="0">
                </div>
                <?php endif; ?>
                <?php $__currentLoopData = $news->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($image->image_url): ?>
                <div class="col">
                    <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail related-image" alt="Thumbnail" style="height: 12.5vh; object-fit: cover; cursor: pointer;" data-target="#newsCarousel" data-slide-to="<?php echo e($index + 1); ?>">
                </div>
                <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- News Metadata -->
    <div class="col-md-4">
        <div class="news-metadata mt-4">
            <p><strong>Author:</strong> <?php echo e($news->author->username); ?></p>
            <p><strong>Category:</strong> <?php echo e($news->category); ?></p>
            <p><strong>Updated At:</strong> <?php echo e($news->updated_at); ?></p>
            <p><strong>Average Rating:</strong> <?php echo e(number_format($averageRating, 1)); ?> / 5</p>
        </div>
    </div>
</div>
<!-- News Content -->
<div class="row mt-4">
    <div class="col-12">
        <div class="news-content">
            <p><?php echo e($news->content); ?></p>
        </div>
    </div>
</div>

    <!-- Sponsored Vehicles -->
    <div class="row mt-4">
    <div class="col-12">
        <h2>Sponsored Vehicles</h2>
        <div class="row">
            <?php $__currentLoopData = $sponsoredVehicles->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card" onclick="location.href='<?php echo e(route('cars.show', $vehicle->vehicle_id)); ?>';" style="cursor: pointer;">
                        <?php if($vehicle->images->isNotEmpty()): ?>
                            <div class="main-image-container">
                                <img src="<?php echo e(asset('storage/' . $vehicle->images->first()->image_url)); ?>" class="d-block w-100 main-image" alt="Sponsored Vehicle Image">
                                <span class="position-absolute bottom-0 start-0 bg-dark text-white px-2 py-1" style="bottom: 20px; left: 0;">
                                    <i class="fas fa-camera"></i> <?php echo e($vehicle->images->count()); ?>

                                </span>
                            </div>
                        <?php else: ?>
                            <div class="main-image-container">
                                <img src="default-image.jpg" class="d-block w-100 main-image" alt="Default Image">
                            </div>
                        <?php endif; ?>
                        <div class="row thumbnails mt-2">
                            <?php $__currentLoopData = $vehicle->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-4">
                                    <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail thumbnail-image" alt="Thumbnail">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="fas fa-car"></i> <?php echo e($vehicle->make); ?> <?php echo e($vehicle->model); ?>

                            </h5>
                            <p class="card-text">
                                <i class="fas fa-calendar-alt"></i> <?php echo e($vehicle->year); ?>   
                                <i class="fas fa-road"></i> <?php echo e($vehicle->mileage); ?> km   
                                <i class="fas fa-money-bill-wave"></i> R<?php echo e(number_format($vehicle->price, 2)); ?>  
                            </p>
                            <p class="card-text text-danger">
                                R<?php echo e(number_format(calculateMonthlyPayment($vehicle->price), 2)); ?> p/m 
                                <span class="badge" style="background-color: <?php echo e($vehicle->car_condition == 'Used' ? 'red' : 'blue'); ?>;">
                                    <?php echo e(ucfirst($vehicle->car_condition)); ?>

                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>


    <!-- Related News -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Related News</h2>
            <div class="row">
                <?php $__currentLoopData = $relatedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="height: 100%;">
                        <img src="<?php echo e(asset('storage/' . $newsItem->images->first()->image_url)); ?>" class="d-block w-100" alt="Related News Image" style="height: 30vh; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($newsItem->title); ?></h5>
                            <p class="card-text"><?php echo e(Str::limit($newsItem->content, 150)); ?></p>
                            <a href="<?php echo e(route('news.show', $newsItem->news_id)); ?>" class="btn btn-primary">Read More</a>
                            <p><strong>Author:</strong> <?php echo e($newsItem->author->name); ?></p>
                            <p><strong>Category:</strong> <?php echo e($newsItem->category); ?></p>
                            <p><strong>Published At:</strong> <?php echo e($newsItem->published_at); ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Ad Placeholders -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="google-ad" style="background-color: red; padding: 20px; text-align: center;">
                <a href="https://www.cars.co.za" target="_blank">
                    <img src="https://via.placeholder.com/728x90?text=Ad" alt="Ad" class="img-fluid">
                </a>
            </div>
        </div>
    </div>

    <!-- User Comments and Ratings -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Comments and Ratings</h2>
            <form action="<?php echo e(route('news.comment', ['news' => $news->news_id])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="comment">Leave a Comment:</label>
                    <textarea class="form-control" id="comment" name="content" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <form action="<?php echo e(route('news.rate', ['news' => $news->news_id])); ?>" method="POST" class="mt-4">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="rating">Rate this Article:</label>
                    <select class="form-control" id="rating" name="rating">
                        <option value="1">1 Star</option>
                        <option value="2">2 Stars</option>
                        <option value="3">3 Stars</option>
                        <option value="4">4 Stars</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="comments mt-4">
                <h3>Comments</h3>
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="comment mb-2">
                    <p><strong><?php echo e($comment->user->username); ?>:</strong> <?php echo e($comment->content); ?></p>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>

    <!-- Polls -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Poll</h2>
            <?php if($poll): ?>
            <form action="<?php echo e(route('poll.vote', ['pollOption' => $poll->options->first()->id])); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <p><?php echo e($poll->question); ?></p>
                <?php $__currentLoopData = $poll->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="poll_option_id" id="option<?php echo e($option->id); ?>" value="<?php echo e($option->id); ?>">
                    <label class="form-check-label" for="option<?php echo e($option->id); ?>">
                        <?php echo e($option->option); ?>

                    </label>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <button type="submit" class="btn btn-primary mt-2">Vote</button>
            </form>
            <?php else: ?>
            <p>No active polls at the moment.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Social Media Sharing    <!-- Social Media Sharing Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <h2>Share this Article</h2>
            <div class="social-buttons">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->fullUrl())); ?>" class="btn btn-primary" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->fullUrl())); ?>" class="btn btn-info" target="_blank"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo e(urlencode(request()->fullUrl())); ?>" class="btn btn-primary" target="_blank"><i class="fab fa-linkedin-in"></i> LinkedIn</a>
                <a href="mailto:?subject=I wanted to share this article with you&body=<?php echo e(urlencode(request()->fullUrl())); ?>" class="btn btn-secondary" target="_blank"><i class="fas fa-envelope"></i> Email</a>
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
<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/public/news/show.blade.php ENDPATH**/ ?>