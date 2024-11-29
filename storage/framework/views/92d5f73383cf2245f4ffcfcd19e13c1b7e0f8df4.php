

<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Create Dealership</h1>

        <form action="<?php echo e(route('dealer.dealership.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="dealership_name">Dealership Name</label>
                <input type="text" class="form-control" id="dealership_name" name="dealership_name" required>
            </div>
            <div class="form-group">
                <label for="license_number">License Number</label>
                <input type="text" class="form-control" id="license_number" name="license_number" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city_town">City/Town</label>
                <input type="text" class="form-control" id="city_town" name="city_town" required>
            </div>
            <div class="form-group">
                <label for="postal_code">Postal Code</label>
                <input type="number" class="form-control" id="postal_code" name="postal_code" required>
            </div>
            <div class="form-group">
                <label for="logo">Logo</label>
                <input type="file" class="form-control-file" id="logo" name="logo" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Dealership</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/create_dealership.blade.php ENDPATH**/ ?>