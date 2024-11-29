@extends('layouts.dealer')

@section('title', 'Add Car Images and Features')

@section('content')
    <h1>Add Car Images and Features</h1>
    <form action="{{ route('dealer.store_car_images') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="images">Car Images</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple required>
        </div>
        <div class="form-group">
            <label for="features">Features</label>
            <textarea class="form-control" id="features" name="features" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
