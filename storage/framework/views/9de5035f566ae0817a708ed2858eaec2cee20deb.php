

<?php $__env->startSection('title', 'Manage Vehicles'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('failed')): ?> 
        <div class="alert alert-danger">   
 
            <?php echo e(session('failed')); ?>

        </div>
    <?php endif; ?>   

    <h1>Manage Vehicles</h1>

    <table id="vehicles-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th> 
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td> 
                        <?php if($vehicle->images->isNotEmpty()): ?>
                            <img src="<?php echo e(asset('storage/' . $vehicle->images[0]->image_url)); ?>" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;">
                        <?php else: ?>
                            No Image
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($vehicle->make); ?></td>
                    <td><?php echo e($vehicle->model); ?></td>
                    <td><?php echo e($vehicle->year); ?></td>
                    <td>
                        <a href="<?php echo e(route('dealer.vehicles.view', $vehicle->vehicle_id)); ?>" class="btn btn-sm btn-primary mr-2">View</a>
                        <form method="POST" action="<?php echo e(route('dealer.vehicles.destroy', $vehicle->vehicle_id)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="button" class="btn btn-sm btn-danger delete-vehicle">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>

$(document).ready(function() {
            $('#vehicles-table').DataTable(); 

            });
            $(document).on('click', '.delete-vehicle', function(e) {
                e.preventDefault();
                if (confirm("Are you sure you want to delete this vehicle?")) {
                    $(this).closest('form').submit();
                }
        
        });



    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/manage_vehicles.blade.php ENDPATH**/ ?>