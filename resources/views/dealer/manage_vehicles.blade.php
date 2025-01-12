@extends('layouts.dealer')

@section('title', 'Manage Vehicles')

@section('content')
@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('failed')) 
        <div class="alert alert-danger">   
 
            {{ session('failed') }}
        </div>
    @endif   

    <h1>Manage Vehicles</h1>

    <table id="vehicles-table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Image</th> 
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td> 
                        @if ($vehicle->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $vehicle->images[0]->image_url) }}" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $vehicle->car_brand->name }}</td>
                    <td>{{ $vehicle->car_model->name }}</td>
                    <td>{{ $vehicle->year }}</td>
                    <td>
                        <a href="{{ route('dealer.vehicles.view', $vehicle->vehicle_id) }}" class="btn btn-sm btn-primary mr-2">View</a>
                        <form method="POST" action="{{ route('dealer.vehicles.destroy', $vehicle->vehicle_id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger delete-vehicle">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script>

$(document).ready(function() {
            $('#vehicles-table').DataTable(); 

            });
            $(document).on('click', '.delete-vehicle', function(e) {
                e.preventDefault();
                if (confirm("Are you sure you want to delete this vehicle?")) {
                    $(this).closest('form').submit();
                }
        
        });



    </script>

@endsection