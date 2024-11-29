

<?php $__env->startSection('title', 'Manage Sales'); ?>

<?php $__env->startSection('content'); ?>

    <h1>Manage Sales</h1>
    <table class="table table-striped" id="sales-table"> 
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th> 
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($sale->vehicle->make); ?></td>
                    <td><?php echo e($sale->vehicle->model); ?></td>
                    <td><?php echo e($sale->vehicle->year); ?></td>
                    <td>R<?php echo e($sale->vehicle->price); ?></td> 
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#sales-table').DataTable(); 
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/manage_sales.blade.php ENDPATH**/ ?>