@extends('layouts.seller')

@section('seller-content')
    <h1>Add Car</h1>
    <form action="{{ route('store.car') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="make">Make</label>
            <input type="text" class="form-control" id="make" name="make" required>
        </div>
        <div class="form-group">
            <label for="model">Model</label>
            <input type="text" class="form-control" id="model" name="model" required>
        </div>
        <div class="form-group">
            <label for="year">Year</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="mileage">Mileage</label>
            <input type="number" class="form-control" id="mileage" name="mileage" required>
        </div>
        <div class="form-group">
            <label for="fuel_type">Fuel Type</label>
            <input type="text" class="form-control" id="fuel_type" name="fuel_type" required>
        </div>
        <div class="form-group">
            <label for="transmission">Transmission</label>
            <input type="text" class="form-control" id="transmission" name="transmission" required>
        </div>
        <div class="form-group">
            <label for="body_type">Body Type</label>
            <input type="text" class="form-control" id="body_type" name="body_type" required>
        </div>
        <div class="form-group">
            <label for="color">Color</label>
            <input type="text" class="form-control" id="color" name="color" required>
        </div>
        <div class="form-group">
            <label for="engine_size">Engine Size</label>
            <input type="text" class="form-control" id="engine_size" name="engine_size" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Car</button>
    </form>
@endsection
