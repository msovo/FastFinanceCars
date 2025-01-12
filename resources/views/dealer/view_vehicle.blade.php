@extends('layouts.dealer')

@section('title', 'View Vehicle')

@section('content')
    <div>

  

    <h1>
        {{ $vehicle->make . ' ' . $vehicle->model . ' (' . $vehicle->year . ')' }}
        @if ($vehicle->listing)
            -
            @if ($vehicle->listing->is_featured && $vehicle->listing->is_sponsored)
                <span class="badge badge-success">Featured</span> <span class="badge badge-warning">Sponsored</span>
            @elseif ($vehicle->listing->is_featured)
                <span class="badge badge-success">Featured</span>
            @elseif ($vehicle->listing->is_sponsored)
                <span class="badge badge-warning">Sponsored</span>
            @else
                <span class="badge badge-secondary">Active</span>
            @endif
        @endif
    </h1>
    @if (session('success')) 
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="btn-group end-0 m-3">
            <a href="{{ route('dealer.vehicles.edit', $vehicle->vehicle_id) }}" class="btn btn-primary">Edit</a>
            <button class="btn btn-secondary" data-toggle="modal" data-target="#addImagesModal">Add Images</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#addFeaturesModal">Add Features</button>
            <button class="btn btn-warning" data-toggle="modal" data-target="#sponsorModal">Sponsor Car</button>
            <button class="btn btn-info" data-toggle="modal" data-target="#featureModal">Feature Car</button>


        </div>
    </div>
    @if ($vehicle->listing && !$vehicle->listing->is_featured && !$vehicle->listing->is_sponsored)
        <div class="alert alert-info">
            <p>Consider sponsoring or featuring your listing to increase visibility and attract more potential buyers.</p>
            <ul>
                <li><strong>Sponsored listings</strong> appear at the top of search results.</li>
                <li><strong>Featured listings</strong> are highlighted in special sections.</li>
            </ul>
        </div>
    @endif


    <div class="row mt-4">
        <div class="col-md-8">
            @if ($vehicle->images->isNotEmpty())
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
            @endif
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
                    <td>{{ $vehicle->car_brand->name }}</td>
                </tr>
                <tr>
                    <th>Model:</th>
                    <td>{{ $vehicle->car_model->name }}</td>
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
                    <td>{{ $vehicle->variant->name }}</td>
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
                                <label for="features">Feature (one at a time)</label>
                                <input type="text" class="form-control" id="features" name="features">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primarybtn-primary">Add Feature</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        @if ($vehicle->listing)
            <button class="btn btn-warning" data-toggle="modal" data-target="#sponsorModal">Sponsor Car</button>
            <div class="modal fade" id="sponsorModal" tabindex="-1" role="dialog" aria-labelledby="sponsorModalLabel" aria-hidden="true">
                <div class="modal-dialog" 
 role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="sponsorModalLabel">Sponsor 
 Car</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Sponsoring this car will promote it on various platforms, including:</p>
                            <ul>
                                <li>Google Ads</li>
                                <li>Internal ads (e.g., new user registration emails)</li>
                                <li>Other relevant platforms</li>
                            </ul>
                            <p>This will increase the visibility of your listing and attract more potential buyers.</p>
                            <p><strong>Note:</strong> Sponsoring is currently free, but may become a paid premium feature in the future.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('dealer.vehicles.sponsor',$vehicle->vehicle_id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Confirm Sponsor</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <button class="btn btn-info" data-toggle="modal" data-target="#featureModal">Feature Car</button>
            <div class="modal fade" id="featureModal" tabindex="-1" role="dialog" aria-labelledby="featureModalLabel" aria-hidden="true">
                <div class="modal-dialog" 
 role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="featureModalLabel">Feature 
 Car</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div 
 class="modal-body">
                            <p>Featuring 
 this car will highlight it in special sections of the website, giving it more exposure to potential buyers.</p>
                            <p><strong>Note:</strong> Featuring is currently free, but may become a paid premium feature in the future.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="{{ route('dealer.vehicles.feature',$vehicle->vehicle_id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-info">Confirm Feature</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
 
@endsection
@section('scripts')
    <script>
        // Initialize the image slider
        $('#vehicleImageSlider').carousel();
    </script>
@endsection