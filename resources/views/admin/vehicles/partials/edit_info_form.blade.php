<!-- resources/views/admin/vehicles/partials/edit_info_form.blade.php -->

<div class="card mt-4">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Edit Vehicle Information</h5>
    </div>
    <div class="card-body">
        <form id="editVehicleForm" action="{{ route('admin.vehicles.update', $vehicle->vehicle_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <!-- Make -->
                    <div class="form-group">
                        <label for="brand_id">Make</label>
                        <input type="text" class="form-control" id="brand_id" name="brand_id"  required>
                    </div>
                    <!-- Model -->
                    <div class="form-group">
                        <label for="model_id">Model</label>
                        <input type="text" class="form-control" id="model_id" name="model_id"  required>

        
                    </div>
                    <!-- Year -->
                    <div class="form-group">
                        <label for="year">Year</label>
                        <input type="number" class="form-control" id="year" name="year" value="{{ $vehicle->year }}" required>
                    </div>
                    <!-- Price -->
                    <div class="form-group">
                        <label for="price">Price (R)</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $vehicle->price }}" required>
                    </div>
                    <!-- Mileage -->
                    <div class="form-group">
                        <label for="mileage">Mileage (km)</label>
                        <input type="number" class="form-control" id="mileage" name="mileage" value="{{ $vehicle->mileage }}">
                    </div>
                </div>
                <!-- Right Column -->
                <div class="col-md-6">
                    <!-- Fuel Type -->
                    <div class="form-group">
                        <label for="fuel_type">Fuel Type</label>
                        <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="{{ $vehicle->fuel_type }}">
                    </div>
                    <!-- Transmission -->
                    <div class="form-group">
                        <label for="transmission">Transmission</label>
                        <input type="text" class="form-control" id="transmission" name="transmission" value="{{ $vehicle->transmission }}">
                    </div>
                    <!-- Body Type -->
                    <div class="form-group">
                        <label for="body_type">Body Type</label>
                        <input type="text" class="form-control" id="body_type" name="body_type" value="{{ $vehicle->body_type }}">
                    </div>
                    <!-- Color -->
                    <div class="form-group">
                        <label for="color">Color</label>
                        <input type="text" class="form-control" id="color" name="color" value="{{ $vehicle->color }}">
                    </div>
                    <!-- Engine Size -->
                    <div class="form-group">
                        <label for="engine_size">Engine Size (L)</label>
                        <input type="text" class="form-control" id="engine_size" name="engine_size" value="{{ $vehicle->engine_size }}">
                    </div>
                </div>
            </div>
            <!-- Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $vehicle->description }}</textarea>
            </div>
            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Update Vehicle</button>
        </form>
    </div>
</div>