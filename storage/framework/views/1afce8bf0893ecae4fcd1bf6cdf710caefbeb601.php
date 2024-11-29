<?php $__env->startSection('content'); ?>
<h2>Hello, <?php echo e($user->username); ?></h2>
<p>Welcome to Fast Finance Cars! Please verify your email address by clicking the button below:</p>
<a href="<?php echo e($verificationUrl); ?>" class="button">Verify Email</a>
<p>If you did not create an account, no further action is required.</p>

<h2>Sponsored Cars</h2>
<?php $__currentLoopData = $sponsoredCars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $car): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="car-listing">
        <img src="<?php echo e(asset('storage/' . $car->image_url)); ?>" alt="<?php echo e($car->model); ?>">

        <h3><?php echo e($car->make); ?> <?php echo e($car->model); ?></h3>
        <p><?php echo e($car->description); ?></p>
        <a href="<?php echo e(route('cars.show', $car->vehicle_id)); ?>">View Listing</a>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<h2>Latest News</h2>
<?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="news-item">
    <img id="mainImageNews<?php echo e($newsItem->news_id); ?>" src="<?php echo e(asset('storage/' . $newsItem->image_url)); ?>" alt="News Image" >
        <h3><?php echo e($newsItem->title); ?></h3>
        <p><?php echo e(Str::limit($newsItem->content, 150)); ?></p>
        <a href="<?php echo e(route('news.show', $newsItem->news_id)); ?>" class="btn btn-primary">Read More</a>
        </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<p>Thank you,<br>Fast Finance Cars Team</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('vendor.mail.html.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/vendor/mail/html/message.blade.php ENDPATH**/ ?>