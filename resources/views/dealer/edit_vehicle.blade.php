@extends('layouts.dealer')

@section('title', 'Edit Vehicle')

@section('content')
    <h1>Edit Vehicle</h1>

    <form action="{{ route('dealer.vehicles.update', $vehicle->vehicle_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="make">Make</label>
                    <select class="form-control" id="make" name="make" required>
                        <option value="">Select Make</option>
                        @foreach ($categories->where('category_type', 'Make') as $category)
                            <option value="{{ $category->category_name }}" {{ $vehicle->make == $category->category_name ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" name="model" value="{{ $vehicle->model }}" required>
                </div>
                
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" class="form-control" id="year" name="year" value="{{ $vehicle->year }}" required>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $vehicle->price }}">
                </div>
                <div class="form-group">
                    <label for="mileage">Mileage</label>
                    <input type="number" class="form-control" id="mileage" name="mileage" value="{{ $vehicle->mileage }}">
                </div>
                <div class="form-group">
                    <label for="fuel_type">Fuel Type</label>
                    <select class="form-control" id="fuel_type" name="fuel_type" required>
                        <option value="">Select Fuel Type</option>
                        @foreach ($categories->where('category_type', 'Fuel Type') as $category)
                            <option value="{{ $category->category_name }}" {{ $vehicle->fuel_type == $category->category_name ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="transmission">Transmission</label>
                    <select class="form-control" id="transmission" name="transmission" required>
                        <option value="">Select Transmission</option>
                        @foreach ($categories->where('category_type', 'Transmission') as $category)
                            <option value="{{ $category->category_name }}" {{ $vehicle->transmission == $category->category_name ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="body_type">Body Type</label>
                    <select class="form-control" id="body_type" name="body_type" required>
                        <option value="">Select Body Type</option>
                        @foreach ($categories->where('category_type', 'Body Type') as $category)
                            <option value="{{ $category->category_name }}" {{ $vehicle->body_type == $category->category_name ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="{{ $vehicle->color }}" required>
                </div>
                <div class="form-group">
                    <label for="engine_size">Engine Size</label>
                    <input type="text" class="form-control" id="engine_size" name="engine_size" value="{{ $vehicle->engine_size }}" required>
                </div>
                <div class="form-group">
                    <label for="car_condition">Condition</label>
                    <select class="form-control" id="car_condition" name="car_condition" required>
                        <option value="">Select Condition</option>
                        @foreach ($categories->where('category_type', 'Condition') as $category)
                            <option value="{{ $category->category_name }}" {{ $vehicle->car_condition == $category->category_name ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="variant">Variant</label>
                    <input type="text" class="form-control" id="variant" name="variant" value="{{ $vehicle->variant }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $vehicle->description }}</textarea>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Vehicle</button>
    </form>
@endsection