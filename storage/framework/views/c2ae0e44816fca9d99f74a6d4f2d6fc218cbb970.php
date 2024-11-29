

<?php $__env->startSection('title', 'View Vehicle'); ?>

<?php $__env->startSection('content'); ?>
    <div>

  

    <h1>
        <?php echo e($vehicle->make . ' ' . $vehicle->model . ' (' . $vehicle->year . ')'); ?>

        <?php if($vehicle->listing): ?>
            -
            <?php if($vehicle->listing->is_featured && $vehicle->listing->is_sponsored): ?>
                <span class="badge badge-success">Featured</span> <span class="badge badge-warning">Sponsored</span>
            <?php elseif($vehicle->listing->is_featured): ?>
                <span class="badge badge-success">Featured</span>
            <?php elseif($vehicle->listing->is_sponsored): ?>
                <span class="badge badge-warning">Sponsored</span>
            <?php else: ?>
                <span class="badge badge-secondary">Active</span>
            <?php endif; ?>
        <?php endif; ?>
    </h1>
    <?php if(session('success')): ?> 
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <div class="btn-group end-0 m-3">
            <a href="<?php echo e(route('dealer.vehicles.edit', $vehicle->vehicle_id)); ?>" class="btn btn-primary">Edit</a>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#addImagesModal">Add Images</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#addFeaturesModal">Add Features</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#sponsorModal">Sponsor Car</button>
            <button class="btn btn-info" data-toggle="modal" data-target="#featureModal">Feature Car</button>


        </div>
    </div>
    <?php if($vehicle->listing && !$vehicle->listing->is_featured && !$vehicle->listing->is_sponsored): ?>
        <div class="alert alert-info">
            <p>Consider sponsoring or featuring your listing to increase visibility and attract more potential buyers.</p>
            <ul>
                <li><strong>Sponsored listings</strong> appear at the top of search results.</li>
                <li><strong>Featured listings</strong> are highlighted in special sections.</li>
            </ul>
        </div>
    <?php endif; ?>


    <div class="row mt-4">
        <div class="col-md-8">
            <?php if($vehicle->images->isNotEmpty()): ?>
                <div id="vehicleImageSlider" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $vehicle->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php echo e($index == 0 ? 'active' : ''); ?>">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="d-block w-100" alt="Vehicle Image">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <a class="carousel-control-prev" href="#vehicleImageSlider" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#vehicleImageSlider" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="mt-3">
                    <div class="row">
                        <?php $__currentLoopData = $vehicle->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3">
                                <img src="<?php echo e(asset('storage/' . $image->image_url)); ?>" class="img-thumbnail" alt="Vehicle Image">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <h2>Features</h2>
            <ul>
                <?php $__currentLoopData = $vehicle->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($feature->feature); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>

    <div class="mt-4">
        <h2>Vehicle Information</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Make:</th>
                    <td><?php echo e($vehicle->make); ?></td>
                </tr>
                <tr>
                    <th>Model:</th>
                    <td><?php echo e($vehicle->model); ?></td>
                </tr>
                <tr>
                    <th>Year:</th>
                    <td><?php echo e($vehicle->year); ?></td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td><?php echo e($vehicle->price); ?></td>
                </tr>
                <tr>
                    <th>Mileage:</th>
                    <td><?php echo e($vehicle->mileage); ?></td>
                </tr>
                <tr>
                    <th>Fuel Type:</th>
                    <td><?php echo e($vehicle->fuel_type); ?></td>
                </tr>
                <tr>
                    <th>Transmission:</th>
                    <td><?php echo e($vehicle->transmission); ?></td>
                </tr>
                <tr>
                    <th>Body Type:</th>
                    <td><?php echo e($vehicle->body_type); ?></td>
                </tr>
                <tr>
                    <th>Color:</th>
                    <td><?php echo e($vehicle->color); ?></td>
                </tr>
                <tr>
                    <th>Engine Size:</th>
                    <td><?php echo e($vehicle->engine_size); ?></td>
                </tr>
                <tr>
                    <th>Condition:</th>
                    <td><?php echo e($vehicle->car_condition); ?></td>
                </tr>
                <tr>
                    <th>Variant:</th>
                    <td><?php echo e($vehicle->variant); ?></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td><?php echo e($vehicle->description); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="<?php echo e(route('dealer.vehicles.edit', $vehicle->vehicle_id)); ?>" class="btn btn-primary">Edit Car Information</a>

        <button class="btn btn-secondary" data-toggle="modal" data-target="#addImagesModal">Add Images</button>
        <div class="modal fade" id="addImagesModal" tabindex="-1" role="dialog" aria-labelledby="addImagesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addImagesModalLabel">Add Images</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('dealer.vehicles.images.add', $vehicle->vehicle_id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="images">Select Images</label>
                                <input type="file" class="form-control-file" id="images" name="images[]" multiple>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Images</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <button class="btn btn-success" data-toggle="modal" data-target="#addFeaturesModal">Add Features</button>
        <div class="modal fade" id="addFeaturesModal" tabindex="-1" role="dialog" aria-labelledby="addFeaturesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFeaturesModalLabel">Add Features</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?php echo e(route('dealer.vehicles.features.add', $vehicle->vehicle_id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="features">Feature (one at a time)</label>
                                <input type="text" class="form-control" id="features" name="features">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primarybtn-primary">Add Feature</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <?php if($vehicle->listing): ?>
            <button class="btn btn-warning" data-toggle="modal" data-target="#sponsorModal">Sponsor Car</button>
            <div class="modal fade" id="sponsorModal" tabindex="-1" role="dialog" aria-labelledby="sponsorModalLabel" aria-hidden="true">
                <div class="modal-dialog" 
 role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sponsorModalLabel">Sponsor 
 Car</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Sponsoring this car will promote it on various platforms, including:</p>
                            <ul>
                                <li>Google Ads</li>
                                <li>Internal ads (e.g., new user registration emails)</li>
                                <li>Other relevant platforms</li>
                            </ul>
                            <p>This will increase the visibility of your listing and attract more potential buyers.</p>
                            <p><strong>Note:</strong> Sponsoring is currently free, but may become a paid premium feature in the future.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="<?php echo e(route('dealer.vehicles.sponsor',$vehicle->vehicle_id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-warning">Confirm Sponsor</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-info" data-toggle="modal" data-target="#featureModal">Feature Car</button>
            <div class="modal fade" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="featureModalLabel" aria-hidden="true">
                <div class="modal-dialog" 
 role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="featureModalLabel">Feature 
 Car</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div 
 class="modal-body">
                            <p>Featuring 
 this car will highlight it in special sections of the website, giving it more exposure to potential buyers.</p>
                            <p><strong>Note:</strong> Featuring is currently free, but may become a paid premium feature in the future.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="<?php echo e(route('dealer.vehicles.feature',$vehicle->vehicle_id)); ?>" method="POST" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-info">Confirm Feature</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        // Initialize the image slider
        $('#vehicleImageSlider').carousel();
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/view_vehicle.blade.php ENDPATH**/ ?>