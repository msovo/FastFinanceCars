@extends('layouts.dealer')

@section('title', 'View Vehicle')

@section('content')
    <h1>
        {{ $vehicle->make . ' ' . $vehicle->model . ' (' . $vehicle->year . ')' }}
        @if ($vehicle->listing)
            ({{ $vehicle->listing->listing_status }})
        @endif
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div id="vehicleImageSlider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($vehicle->images as $index => $image)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="Vehicle Image">
                        </div>
                    @endforeach
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
                    @foreach ($vehicle->images as $image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail" alt="Vehicle Image">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h2>Features</h2>
            <ul>
                @foreach ($vehicle->features as $feature)
                    <li>{{ $feature->feature }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="mt-4">
        <h2>Vehicle Information</h2>
        <table class="table">
            <tbody>
                <tr>
                    <th>Make:</th>
                    <td>{{ $vehicle->make }}</td>
                </tr>
                <tr>
                    <th>Model:</th>
                    <td>{{ $vehicle->model }}</td>
                </tr>
                <tr>
                    <th>Year:</th>
                    <td>{{ $vehicle->year }}</td>
                </tr>
                <tr>
                    <th>Price:</th>
                    <td>{{ $vehicle->price }}</td>
                </tr>
                <tr>
                    <th>Mileage:</th>
                    <td>{{ $vehicle->mileage }}</td>
                </tr>
                <tr>
                    <th>Fuel Type:</th>
                    <td>{{ $vehicle->fuel_type }}</td>
                </tr>
                <tr>
                    <th>Transmission:</th>
                    <td>{{ $vehicle->transmission }}</td>
                </tr>
                <tr>
                    <th>Body Type:</th>
                    <td>{{ $vehicle->body_type }}</td>
                </tr>
                <tr>
                    <th>Color:</th>
                    <td>{{ $vehicle->color }}</td>
                </tr>
                <tr>
                    <th>Engine Size:</th>
                    <td>{{ $vehicle->engine_size }}</td>
                </tr>
                <tr>
                    <th>Condition:</th>
                    <td>{{ $vehicle->car_condition }}</td>
                </tr>
                <tr>
                    <th>Variant:</th>
                    <td>{{ $vehicle->variant }}</td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td>{{ $vehicle->description }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('dealer.vehicles.edit', $vehicle->vehicle_id) }}" class="btn btn-primary">Edit Car Information</a>

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
                    <form action="{{ route('dealer.vehicles.images.add', $vehicle->vehicle_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                    <form action="{{ route('dealer.vehicles.features.add', $vehicle->vehicle_id) }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="features">Features (comma-separated)</label>
                                <input type="text" class="form-control" id="features" name="features">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Features</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize the image slider
        $('#vehicleImageSlider').carousel();
    </script>
@endsection