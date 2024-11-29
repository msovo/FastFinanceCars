@extends('layouts.admin')

@section('title', 'Edit Vehicle')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header">Edit Vehicle</div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="btn-group mb-3" role="group">
                <button type="button" class="btn btn-primary" id="btnEditInfo">Edit Car Information</button>
                <button type="button" class="btn btn-secondary" id="btnAddImages">Add Images</button>
                <button type="button" class="btn btn-success" id="btnAddFeatures">Add Features</button>
                <button type="button" class="btn btn-info" id="btnRefresh">Refresh</button>
                @if ($vehicle->isListed() )
                    <button type="button" class="btn btn-warning" id="btnListIt">Unlist</button>
                @else
                    <button type="button" class="btn btn-warning" id="btnListIt">List It</button>
                @endif
                @if ($vehicle->isSold())
                    <button type="button" class="btn btn-danger" id="btnSold" disabled>Sold</button>
                @else
                    <button type="button" class="btn btn-danger" id="btnSold">Sold</button>
                @endif
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-4">
                            <p><strong>Make:</strong> {{ $vehicle->make }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Model:</strong> {{ $vehicle->model }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Year:</strong> {{ $vehicle->year }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Price:</strong> {{ $vehicle->price }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Mileage:</strong> {{ $vehicle->mileage }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Fuel Type:</strong> {{ $vehicle->fuel_type }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Transmission:</strong> {{ $vehicle->transmission }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Body Type:</strong> {{ $vehicle->body_type }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Color:</strong> {{ $vehicle->color }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Engine Size:</strong> {{ $vehicle->engine_size }}</p>
                        </div>
                        <div class="col-md-4">
                            <p><strong>Description:</strong> {{ $vehicle->description }}</p>
                        </div>
                    </div>

                    <div id="imageSlider" class="carousel slide" data-ride="carousel" style="width: 100%; margin: auto;">
                        <div class="carousel-inner">
                            @foreach($vehicle->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#imageSlider" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#imageSlider" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                    <div class="mt-3" id="thumbnailImages">
                        <div class="row">
                            @foreach($vehicle->images as $image)
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail clickable-image" data-target="#imageSlider" data-slide-to="{{ $loop->index }}" alt="...">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h3>Features</h3>
                    <ul>
                        @foreach($vehicle->features as $feature)
                            <li>{{ $feature->feature }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div id="editInfoForm" style="display: none;">
                <form id="editVehicleForm" action="{{ route('admin.vehicles.update', $vehicle->vehicle_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="make">Make</label>
                                <input type="text" class="form-control" id="make" name="make" value="{{ $vehicle->make }}" required>
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
                                <label for="engine_size">Engine Size</label>
                                <input type="text" class="form-control" id="engine_size" name="engine_size" value="{{ $vehicle->engine_size }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mileage">Mileage</label>
                                <input type="number" class="form-control" id="mileage" name="mileage" value="{{ $vehicle->mileage }}">
                            </div>
                            <div class="form-group">
                                <label for="fuel_type">Fuel Type</label>
                                <input type="text" class="form-control" id="fuel_type" name="fuel_type" value="{{ $vehicle->fuel_type }}" required>
                            </div>
                            <div class="form-group">
                                <label for="transmission">Transmission</label>
                                <input type="text" class="form-control" id="transmission" name="transmission" value="{{ $vehicle->transmission }}" required>
                            </div>
                            <div class="form-group">
                                <label for="body_type">Body Type</label>
                                <input type="text" class="form-control" id="body_type" name="body_type" value="{{ $vehicle->body_type }}" required>
                            </div>
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="text" class="form-control" id="color" name="color" value="{{ $vehicle->color }}">
                            </div>
                        
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ $vehicle->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Vehicle</button>
                </form>
            </div>

            <div id="addImagesForm" style="display: none;">
                <form id="addImagesForm" action="{{ route('admin.vehicles.update', $vehicle->vehicle_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="images">Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>
                        <div id="imagePreview" class="mt-2"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Images</button>
                </form>
            </div>

            <div id="addFeaturesForm" style="display: none;">
                <form id="addFeaturesForm" action="{{ route('admin.vehicles.addFeatures', $vehicle->vehicle_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="features">Features</label>
                        <textarea class="form-control" id="features" name="features"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Features</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
      $('#btnListIt').on('click', function() {
        const vehicleId = {{ $vehicle->vehicle_id }};
        const action = $(this).text() === 'List It' ? 'list' : 'unlist';
        $.ajax({
            url: `/admin/vehicles/${vehicleId}/${action}`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'active') {
                    $('#btnListIt').text('Unlist');
                } else if (response.status === 'expired') {
                    $('#btnListIt').text('List It');
                }
                alert(response.message);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('#btnSold').on('click', function() {
        const vehicleId = {{ $vehicle->vehicle_id }};
        $.ajax({
            url: `/admin/vehicles/${vehicleId}/sold`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert(response.message);
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    });

    $('#images').on('change', function() {
        const files = this.files;
        $('#imagePreview').empty();
        for (let i = 0; i < files.length; i++) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').append('<img src="' + e.target.result + '" class="img-thumbnail" width="150">');
            }
            reader.readAsDataURL(files[i]);
        }
    });

    $('.clickable-image').on('click', function() {
        const slideTo = $(this).data('slide-to');
        $('#imageSlider').carousel(slideTo);
    });

</script>
@endpush
@endsection
