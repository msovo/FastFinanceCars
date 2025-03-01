<!-- resources/views/admin/vehicles/edit.blade.php -->

@extends('layouts.admin')

@section('title', 'Edit Vehicle')

@section('content')

<div class="container-fluid mt-4">
    <!-- Vehicle Title and Dealer Info -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                Edit Vehicle: {{ $vehicle->car_brand->name }} {{ $vehicle->car_model->name }} ({{ $vehicle->year }})
            </h4>
        </div>
        <div class="card-body">
            <h5><strong>Dealership Information:</strong></h5>
            @php
                $dealer = $vehicle->listing ? $vehicle->listing->dealer : null;
            @endphp
            @if ($dealer)
                <p><strong>Name:</strong> {{ $dealer->dealership_name }}</p>
                <p><strong>Contact:</strong> {{ $dealer->contact }}</p>
                <p><strong>Address:</strong> {{ $dealer->address }}</p>
            @else
                <p>No dealership information available.</p>
            @endif
        </div>
    </div>

    <!-- Buttons for Actions -->
    <div class="btn-group mb-3" role="group">
        <button type="button" class="btn btn-secondary" id="btnEditInfo">Edit Car Information</button>
        <button type="button" class="btn btn-secondary" id="btnAddImages">Manage Images</button>
        <button type="button" class="btn btn-secondary" id="btnAddFeatures">Manage Features</button>
        <button type="button" class="btn btn-info" id="btnRefresh">Refresh</button>
        @if ($vehicle->isListed())
            <button type="button" class="btn btn-warning" id="btnListIt">Unlist</button>
        @else
            <button type="button" class="btn btn-success" id="btnListIt">List It</button>
        @endif
        @if ($vehicle->isSold())
            <button type="button" class="btn btn-danger" id="btnSold" disabled>Sold</button>
        @else
            <button type="button" class="btn btn-danger" id="btnSold">Mark as Sold</button>
        @endif
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Vehicle Details and Images -->
    <div class="row">
        <!-- Vehicle Details -->
        <div class="col-md-8">
            <!-- Vehicle Information -->
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Vehicle Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <p><strong>Make:</strong> {{ $vehicle->car_brand->name }}</p>
                            <p><strong>Model:</strong> {{ $vehicle->car_model->name }}</p>
                            <p><strong>Year:</strong> {{ $vehicle->year }}</p>
                            <p><strong>Price:</strong> R{{ number_format($vehicle->price, 2) }}</p>
                            <p><strong>Mileage:</strong> {{ $vehicle->mileage }} km</p>
                            <p><strong>Fuel Type:</strong> {{ $vehicle->fuel_type }}</p>
                        </div>
                        <!-- Right Column -->
                        <div class="col-md-6">
                            <p><strong>Transmission:</strong> {{ $vehicle->transmission }}</p>
                            <p><strong>Body Type:</strong> {{ $vehicle->body_type }}</p>
                            <p><strong>Color:</strong> {{ $vehicle->color }}</p>
                            <p><strong>Engine Size:</strong> {{ $vehicle->engine_size }} L</p>
                            <p><strong>Description:</strong> {{ $vehicle->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Vehicle Images -->
            <div class="card mt-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Vehicle Images</h5>
                </div>
                <div class="card-body">
                    <div id="imageSlider" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($vehicle->images as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="d-block w-100" alt="Vehicle Image">
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

                    <!-- Thumbnails -->
                    <div class="mt-3">
                        <div class="row">
                            @foreach($vehicle->images as $image)
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail clickable-image" data-target="#imageSlider" data-slide-to="{{ $loop->index }}" alt="Vehicle Thumbnail">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Features -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Features</h5>
                </div>
                <div class="card-body">
                    @if ($vehicle->features->isNotEmpty())
                        <ul>
                            @foreach($vehicle->features as $feature)
                                <li>{{ $feature->feature }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No features added.</p>
                    @endif
                </div>
            </div>

            <!-- Inquiries -->
            <div class="card mt-3">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Inquiries ({{ $vehicle->listing ? $vehicle->listing->inquiries->count() : 0 }})</h5>
                </div>
                <div class="card-body">
                    @if ($vehicle->listing && $vehicle->listing->inquiries->isNotEmpty())
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehicle->listing->inquiries as $inquiry)
                                    <tr>
                                        <td>{{ $inquiry->name }}</td>
                                        <td>
                                            Email: {{ $inquiry->email }}<br>
                                            Phone: {{ $inquiry->phone }}
                                        </td>
                                        <td>{{ Str::limit($inquiry->message, 50) }}</td>
                                        <td>{{ $inquiry->created_at ? $inquiry->created_at : 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <a href="{{ route('admin.inquiries.showByVehicle', $vehicle->vehicle_id) }}" class="btn btn-primary btn-sm">View All Inquiries</a>
                    @else
                        <p>No inquiries for this vehicle.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

   
</div>

<!-- JavaScript -->
@section('scripts')
<script>
    $(document).ready(function() {
        // Toggle Forms
        $('#btnEditInfo').on('click', function() {
            $('#editInfoForm').toggle();
            $('#addImagesForm').hide();
            $('#addFeaturesForm').hide();
        });

        $('#btnAddImages').on('click', function() {
            $('#addImagesForm').toggle();
            $('#editInfoForm').hide();
            $('#addFeaturesForm').hide();
        });

        $('#btnAddFeatures').on('click', function() {
            $('#addFeaturesForm').toggle();
            $('#editInfoForm').hide();
            $('#addImagesForm').hide();
        });

        $('#btnRefresh').on('click', function() {
            location.reload();
        });

        // List/Unlist Vehicle
        $('#btnListIt').on('click', function() {
            const vehicleId = {{ $vehicle->vehicle_id }};
            const action = $(this).text().trim() === 'List It' ? 'list' : 'unlist';
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

        // Mark as Sold
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

        // Image Preview
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

        // Thumbnail Image Click
        $('.clickable-image').on('click', function() {
            const slideTo = $(this).data('slide-to');
            $('#imageSlider').carousel(slideTo);
        });
    });
</script>
@endsection

@endsection