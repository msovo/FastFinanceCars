

<?php $__env->startSection('content'); ?>

    <h1>Manage Listings</h1>
    <table class="table table-striped" id="listings-table">
        <thead>
            <tr>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $listings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $listing): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($listing->vehicle->make ?? 'N/A'); ?></td>
                    <td><?php echo e($listing->vehicle->model ?? 'N/A'); ?></td>
                    <td><?php echo e($listing->vehicle->year ?? 'N/A'); ?></td>
                    <td><?php echo e($listing->vehicle->price ?? 'N/A'); ?></td>
                    <td>
                        <?php if($listing->listing_status == 'sold'): ?>
                            Sold
                        <?php else: ?>
                            <?php echo e($listing->listing_status); ?>

                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($listing->listing_status == 'active'): ?>
                            <button class="btn btn-warning btn-sm unlist-btn" data-id="<?php echo e($listing->vehicle_id); ?>" data-toggle="modal" data-target="#unlistModal<?php echo e($listing->vehicle_id); ?>">Unlist</button>
                            <div class="modal fade" id="unlistModal<?php echo e($listing->vehicle_id); ?>" tabindex="-1" role="dialog" aria-labelledby="unlistModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="unlistModalLabel">Confirm Unlist</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to unlist this vehicle?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="<?php echo e(route('dealer.vehicles.unlist', $listing->vehicle_id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <button type="submit" class="btn btn-warning">Unlist</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php elseif($listing->listing_status == 'inactive'): ?>
                            <form action="<?php echo e(route('dealer.vehicles.list', $listing->vehicle_id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PUT'); ?>
                                <button type="submit" class="btn btn-success btn-sm">List</button>
                            </form>
                        <?php endif; ?>

                        <?php if($listing->listing_status != 'sold' && !($listing->featured ?? false)): ?>
                            <button class="btn btn-success btn-sm feature-btn" data-id="<?php echo e($listing->vehicle_id); ?>" data-toggle="modal" data-target="#featureModal<?php echo e($listing->vehicle_id); ?>">Feature</button>
                            <div class="modal fade" id="featureModal<?php echo e($listing->vehicle_id); ?>" tabindex="-1" role="dialog" aria-labelledby="featureModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="featureModalLabel">Confirm Feature</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to feature this vehicle?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="<?php echo e(route('dealer.vehicles.feature', $listing->vehicle_id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-primary">Confirm Feature</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if($listing->listing_status != 'sold' && !($listing->sponsored ?? false)): ?>
                            <button class="btn btn-info btn-sm sponsor-btn" data-id="<?php echo e($listing->vehicle_id); ?>" data-toggle="modal" data-target="#sponsorModal<?php echo e($listing->vehicle_id); ?>">Sponsor</button>
                            <div class="modal fade" id="sponsorModal<?php echo e($listing->vehicle_id); ?>" tabindex="-1" role="dialog" aria-labelledby="sponsorModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sponsorModalLabel">Confirm Sponsor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to sponsor this vehicle?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="<?php echo e(route('dealer.vehicles.sponsor', $listing->vehicle_id)); ?>" method="POST" style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <button type="submit" class="btn btn-info">Confirm Sponsor</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#listings-table').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/manage_listings.blade.php ENDPATH**/ ?>