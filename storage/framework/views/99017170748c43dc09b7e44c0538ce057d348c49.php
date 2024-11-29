

<?php $__env->startSection('title', 'Add Cars'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Add Car</h1>
    <div class="card-body">
        <div id="confirmationMessage" class="alert alert-success" style="display:none;"></div>
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
        <form id="categoryForm" action="<?php echo e(route('dealer.store.car')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="make">Make</label>
                        <select class="form-control" id="make" name="make" required>
                            <option value="">Select Make</option>
                            <?php $__currentLoopData = $categories->where('category_type', 'Make'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model">Variant</label>
                        <input type="text" class="form-control" id="variant" name="variant" required>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select class="form-control" id="year" name="year" required>
                            <option value="">Select Year</option>
                            <?php for($year = 1990; $year <= date('Y'); $year++): ?>
                                <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" id="price" name="price">
                    </div>
                    <div class="form-group">
                        <label for="mileage">Mileage</label>
                        <input type="number" class="form-control" id="mileage" name="mileage">
                    </div>
                    <div class="form-group">
                        <label for="fuel_type">Fuel Type</label>
                        <select class="form-control" id="fuel_type" name="fuel_type" required>
                            <option value="">Select Fuel Type</option>
                            <?php $__currentLoopData = $categories->where('category_type', 'Fuel Type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transmission">Transmission</label>
                        <select class="form-control" id="transmission" name="transmission" required>
                            <option value="">Select Transmission</option>
                            <?php $__currentLoopData = $categories->where('category_type', 'Transmission'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body_type">Body Type</label>
                        <select class="form-control" id="body_type" name="body_type" required>
                            <option value="">Select Body Type</option>
                            <?php $__currentLoopData = $categories->where('category_type', 'Body Type'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="car_condition">Condition</label>
                        <select class="form-control" id="car_condition" name="car_condition" required>
                            <option value="">Select car Condition</option>
                            <?php $__currentLoopData = $categories->where('category_type', 'Condition'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color">Color</label>
                        <select class="form-control" id="color" name="color" onchange="toggleCustomColorInput()">
                            <option value="">Select Color</option>
                            <option value="White">White</option>
                            <option value="Black">Black</option>
                            <option value="Silver">Silver</option>
                            <option value="Gray">Gray</option>
                            <option value="Blue">Blue</option>
                            <option value="Red">Red</option>
                            <option value="Green">Green</option>
                            <option value="Yellow">Yellow</option>
                            <option value="Orange">Orange</option>
                            <option value="Brown">Brown</option>
                            <option value="Purple">Purple</option>
                            <option value="Pink">Pink</option>
                            <option value="Gold">Gold</option>
                            <option value="Beige">Beige</option>
                            <option value="Maroon">Maroon</option>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="custom_color" name="custom_color" placeholder="Enter custom color" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label for="engine_size">Engine Size</label>
                        <select class="form-control" id="engine_size" name="engine_size" onchange="toggleCustomEngineSizeInput()">
                            <option value="">Select Engine Size</option>
                            <?php $__currentLoopData = $categories->where('category_type', 'Engine Size'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($category->category_name); ?>"><?php echo e($category->category_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <option value="Other">Other</option>
                        </select>
                        <input type="text" class="form-control mt-2" id="custom_engine_size" name="custom_engine_size" placeholder="Enter custom engine size" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Vehicle</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
      function toggleCustomColorInput() {
    const colorSelect = document.getElementById('color');
    const customColorInput = document.getElementById('custom_color');
    if (colorSelect.value === 'Other') {
        customColorInput.style.display = 'block';
        customColorInput.required = true;
    } else {
        customColorInput.style.display = 'none';
        customColorInput.required = false;
    }
}

function toggleCustomEngineSizeInput() {
    const engineSizeSelect = document.getElementById('engine_size');
    const customEngineSizeInput = document.getElementById('custom_engine_size');
    if (engineSizeSelect.value === 'Other') {
        customEngineSizeInput.style.display = 'block';
        customEngineSizeInput.required = true;
    } else {
        customEngineSizeInput.style.display = 'none';
        customEngineSizeInput.required = false;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    initializeForm();
});
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dealer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\FastFinanceCars\resources\views/dealer/add_cars.blade.php ENDPATH**/ ?>