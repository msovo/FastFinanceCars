@extends('layouts.admin')

@section('title', 'Vehicles')

@section('content')
<style>
     .limited-text {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 200px; /* Adjust the width as needed */
        display: inline-block;
    }
</style>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
        <div class="card-header">Vehicle List</div>
        <a href="{{ route(name: 'admin.vehicles.create') }}" class="btn btn-primary mb-3">Add New News</a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <table id="vehicles-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price</th>
                      
                        <th>Transmission</th>
                        <th>Body Type</th>
                        <th>Color</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>
                        @if ($vehicle->images->isNotEmpty())
                            <img src="{{ asset(path: 'storage/' . $vehicle->images[0]->image_url) }}" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;">
                        @else
                            No Image
                        @endif 
</td>
                            <td>{{ $vehicle->car_brand->name }}</td>
                            <td>{{ $vehicle->car_model->name }}</td>
                            <td>{{ $vehicle->year }}</td>
                            <td>R{{ $vehicle->price }}</td>
                         
                            <td>{{ $vehicle->transmission }}</td>
                            <td>{{ $vehicle->body_type }}</td>
                            <td>{{ $vehicle->color }}</td>
                            <td>
                                <a href="{{ route('admin.vehicles.edit', $vehicle->vehicle_id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.vehicles.destroy', $vehicle->vehicle_id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vehicle?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="dynamicContent"></div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {

});
</script>
@endpush
@endsection
