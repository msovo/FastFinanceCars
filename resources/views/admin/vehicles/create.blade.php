<!-- resources/views/admin/vehicles/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Add New Vehicle')

@section('content')
<div class="container-fluid mt-4">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-car"></i> Add New Vehicle</h4>
        </div>
        <div class="card-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle"></i> There were some problems with your input:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Vehicle Creation Form -->
            <form action="{{ route('admin.vehicles.store') }}" method="POST">
                @csrf
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-6">
                        <!-- Make -->
                        <div class="form-group">
                            <label for="make"><strong>Make <span class="text-danger">*</span></strong></label>
                            <select class="form-control @error('make') is-invalid @enderror" id="make" name="make" required>
                                <option value="">-- Select Make --</option>
                                @foreach ($categories->where('category_type', 'Make') as $category)
                                    <option value="{{ $category->category_name }}" {{ old('make') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('make')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="form-group">
                            <label for="model"><strong>Model <span class="text-danger">*</span></strong></label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model') }}" required>
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Variant -->
                        <div class="form-group">
                            <label for="variant"><strong>Variant</strong></label>
                            <input type="text" class="form-control @error('variant') is-invalid @enderror" id="variant" name="variant" value="{{ old('variant') }}">
                            @error('variant')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Year -->
                        <div class="form-group">
                            <label for="year"><strong>Year <span class="text-danger">*</span></strong></label>
                            <select class="form-control @error('year') is-invalid @enderror" id="year" name="year" required>
                                <option value="">-- Select Year --</option>
                                @for ($year = date('Y'); $year >= 1990; $year--)
                                    <option value="{{ $year }}" {{ old('year') == $year ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                            <label for="price"><strong>Price (R)</strong></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Mileage -->
                        <div class="form-group">
                            <label for="mileage"><strong>Mileage (km)</strong></label>
                            <input type="number" class="form-control @error('mileage') is-invalid @enderror" id="mileage" name="mileage" value="{{ old('mileage') }}" min="0">
                            @error('mileage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Fuel Type -->
                        <div class="form-group">
                            <label for="fuel_type"><strong>Fuel Type <span class="text-danger">*</span></strong></label>
                            <select class="form-control @error('fuel_type') is-invalid @enderror" id="fuel_type" name="fuel_type" required>
                                <option value="">-- Select Fuel Type --</option>
                                @foreach ($categories->where('category_type', 'Fuel Type') as $category)
                                    <option value="{{ $category->category_name }}" {{ old('fuel_type') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('fuel_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-md-6">
                        <!-- Transmission -->
                        <div class="form-group">
                            <label for="transmission"><strong>Transmission <span class="text-danger">*</span></strong></label>
                            <select class="form-control @error('transmission') is-invalid @enderror" id="transmission" name="transmission" required>
                                <option value="">-- Select Transmission --</option>
                                @foreach ($categories->where('category_type', 'Transmission') as $category)
                                    <option value="{{ $category->category_name }}" {{ old('transmission') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('transmission')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Body Type -->
                        <div class="form-group">
                            <label for="body_type"><strong>Body Type <span class="text-danger">*</span></strong></label>
                            <select class="form-control @error('body_type') is-invalid @enderror" id="body_type" name="body_type" required>
                                <option value="">-- Select Body Type --</option>
                                @foreach ($categories->where('category_type', 'Body Type') as $category)
                                    <option value="{{ $category->category_name }}" {{ old('body_type') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('body_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Condition -->
                        <div class="form-group">
                            <label for="car_condition"><strong>Condition <span class="text-danger">*</span></strong></label>
                            <select class="form-control @error('car_condition') is-invalid @enderror" id="car_condition" name="car_condition" required>
                                <option value="">-- Select Condition --</option>
                                @foreach ($categories->where('category_type', 'Condition') as $category)
                                    <option value="{{ $category->category_name }}" {{ old('car_condition') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('car_condition')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Color -->
                        <div class="form-group">
                            <label for="color"><strong>Color</strong></label>
                            <select class="form-control @error('color') is-invalid @enderror" id="color" name="color" onchange="toggleCustomColorInput()">
                                <option value="">-- Select Color --</option>
                                @foreach (['White', 'Black', 'Silver', 'Gray', 'Blue', 'Red', 'Green', 'Yellow', 'Orange', 'Brown', 'Purple', 'Pink', 'Gold', 'Beige', 'Maroon'] as $color)
                                    <option value="{{ $color }}" {{ old('color') == $color ? 'selected' : '' }}>
                                        {{ $color }}
                                    </option>
                                @endforeach
                                <option value="Other" {{ old('color') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <input type="text" class="form-control mt-2 @error('custom_color') is-invalid @enderror" id="custom_color" name="custom_color" placeholder="Enter custom color" style="display: none;" value="{{ old('custom_color') }}">
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('custom_color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Engine Size -->
                        <div class="form-group">
                            <label for="engine_size"><strong>Engine Size</strong></label>
                            <select class="form-control @error('engine_size') is-invalid @enderror" id="engine_size" name="engine_size" onchange="toggleCustomEngineSizeInput()">
                                <option value="">-- Select Engine Size --</option>
                                @foreach ($categories->where('category_type', 'Engine Size') as $category)
                                    <option value="{{ $category->category_name }}" {{ old('engine_size') == $category->category_name ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                                <option value="Other" {{ old('engine_size') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <input type="text" class="form-control mt-2 @error('custom_engine_size') is-invalid @enderror" id="custom_engine_size" name="custom_engine_size" placeholder="Enter custom engine size" style="display: none;" value="{{ old('custom_engine_size') }}">
                            @error('engine_size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('custom_engine_size')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description"><strong>Description</strong></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Form Actions -->
                <div class="form-group d-flex justify-content-end">
                    <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> Back to Vehicles
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-car"></i> Add Vehicle
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Script -->
@section('scripts')
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
            customColorInput.value = '';
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
            customEngineSizeInput.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize custom color and engine size inputs based on old inputs
        toggleCustomColorInput();
        toggleCustomEngineSizeInput();
    });
</script>
@endsection

@endsection