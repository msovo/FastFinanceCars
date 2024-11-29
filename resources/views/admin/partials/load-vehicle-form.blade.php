<!-- resources/views/admin/partials/load-vehicle-form.blade.php -->
<div class="card mt-3">
    <div class="card-header">Add New Vehicle</div>
    <div class="card-body">
        <div id="confirmationMessage" class="alert alert-success" style="display:none;"></div>
        <div id="errorMessage" class="alert alert-danger" style="display:none;"></div>
        <form id="categoryForm" action="{{ route('admin.vehicles.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="make">Make</label>
                        <select class="form-control" id="make" name="make" required>
                            <option value="">Select Make</option>
                            @foreach ($categories->where('category_type', 'Make') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select class="form-control" id="year" name="year" required>
                            <option value="">Select Year</option>
                            @for ($year = 1990; $year <= date('Y'); $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
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
                            @foreach ($categories->where('category_type', 'Fuel Type') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="transmission">Transmission</label>
                        <select class="form-control" id="transmission" name="transmission" required>
                            <option value="">Select Transmission</option>
                            @foreach ($categories->where('category_type', 'transmission') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="body_type">Body Type</label>
                        <select class="form-control" id="body_type" name="body_type" required>
                            <option value="">Select Body Type</option>
                            @foreach ($categories->where('category_type', 'Body Type') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
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
                            @foreach ($categories->where('category_type', 'Engine Size') as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
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
</div>


