

<?php $__env->startSection('content'); ?>
    <h1>Manage Dealership</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($dealership): ?>
        <div class="card">
            <div class="card-header">Dealership Information</div>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Dealership Name:</th>
                            <td><?php echo e($dealership->dealership_name); ?></td>
                        </tr>
                        <tr>
                            <th>License Number:</th>
                            <td><?php echo e($dealership->license_number); ?></td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td><?php echo e($dealership->address); ?></td>
                        </tr>
                        <tr>
                            <th>City/Town:</th>
                            <td><?php echo e($dealership->city_town); ?></td>
                        </tr>
                        <tr>
                            <th>Postal Code:</th>
                            <td><?php echo e($dealership->postal_code); ?></td>
                        </tr>
                        <tr>
                            <th>Logo:</th>
                            <td>
                                <?php if($dealership->logo): ?>
                                    <img src="<?php echo e(asset('storage/' . $dealership->logo)); ?>" alt="Dealership Logo" style="max-width: 100px;"> 
                                <?php else: ?>
                                    No Logo
                                <?php endif; ?>
                            </td>
                        </tr>
                        </div>
                    </tbody>
                </table>
                <a href="<?php echo e(route('dealer.dealership.edit')); ?>" class="btn btn-primary">Edit Dealership</a>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">
            You haven't set up your dealership information yet.
        </div>
        <a href="<?php echo e(route('dealer.dealership.create')); ?>" class="btn btn-primary">Create Dealership</a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/manage_dealership.blade.php ENDPATH**/ ?>