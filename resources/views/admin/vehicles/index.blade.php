<!-- resources/views/admin/vehicles/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Vehicles')

@section('content')

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-car"></i> Vehicle List</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success mb-3">
                <i class="fas fa-plus"></i> Add New Vehicle
            </a>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Sort Options -->
            <div class="mb-3">
                <label for="sortOptions"><strong>Sort By:</strong></label>
                <select id="sortOptions" class="form-control form-control-sm"
                    style="width: auto; display: inline-block;">
                    <option value="7_desc">Date Added (Newest First)</option>
                    <option value="7_asc">Date Added (Oldest First)</option>
                    <option value="4_desc">Price (High to Low)</option>
                    <option value="4_asc">Price (Low to High)</option>
                    <option value="3_desc">Year (Newest First)</option>
                    <option value="3_asc">Year (Oldest First)</option>
                </select>
            </div>

            <table id="vehicles-table" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Year</th>
                        <th>Price</th>
                        <th>Dealership</th>
                        <th>Contact</th>
                        <th>Inquiries</th>
                        <!-- Hidden Date Added Column for sorting -->
                        <th style="display: none;">Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehicles as $vehicle)
                                        @php
                                            $dealer = $vehicle->listing ? $vehicle->listing->dealer : null;
                                            $inquiriesCount = $vehicle->listing ? $vehicle->listing->inquiries->count() : 0;
                                        @endphp
                                        <tr>
                                            <!-- Image -->
                                            <td>
                                                @if ($vehicle->images->isNotEmpty())
                                                    <img src="{{ asset('storage/' . $vehicle->images[0]->image_url) }}" alt="Vehicle Image"
                                                        style="max-width: 100px; max-height: 100px;">
                                                @else
                                                    No Image
                                                @endif
                                            </td>

                                            <!-- Vehicle Details -->
                                            <td>{{ $vehicle->car_model->name }}</td>
                                            <td>{{ $vehicle->car_brand->name }}</td>
                                            <td>{{ $vehicle->year }}</td>
                                            <td>R{{ number_format($vehicle->price, 2) }}</td>

                                            <!-- Dealership Details -->
                                            <td>{{ $dealer->dealership_name ?? 'N/A' }}</td>
                                            <td>{{ $dealer->contact ?? 'N/A' }}</td>
                                            <td>{{ $inquiriesCount }}</td>
                                            <!-- Inquiries Count -->
                                            
                                            <!-- Hidden Date Added Column -->
                                            <td style="display: none;">
                                                {{ $vehicle->created_at ? $vehicle->created_at->format('Y-m-d H:i:s') : '' }}
                                            </td>

                                            <!-- Actions -->
                                            <td>
                                                <a href="{{ route('admin.vehicles.edit', $vehicle->vehicle_id) }}"
                                                    class="btn btn-warning btn-sm mb-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.vehicles.destroy', $vehicle->vehicle_id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm mb-1"
                                                        onclick="return confirm('Are you sure you want to delete this vehicle?')">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>

                                                @if ($vehicle->listing)
                                                    <a href="{{ route('admin.inquiries.showByVehicle', $vehicle->vehicle_id) }}"
                                                        class="btn btn-info btn-sm mb-1">
                                                        <i class="fas fa-envelope"></i> View Inquiries
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include DataTables scripts -->
@section('scripts')
<script>
    $(document).ready(function () {
        // Initialize DataTable with advanced options
        var table = $('#vehicles-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf', 'print'
        ],
        paging: true,
        searching: true,
        info: true,
        autoWidth: false,
        responsive: true,
        order: [[8, 'desc']], // Now sorting by index 8 (Hidden Date Added)
        columnDefs: [
            { orderable: false, targets: [0, 9] }, // Disables ordering on Image and Actions columns
            { visible: false, targets: 8 } // Hides the Hidden Date Added column
        ]
    });

        // Sorting based on sort options
        $('#sortOptions').change(function () {
            var selectedOption = $(this).val();
            var sortColumn = selectedOption.split('_')[0];
            var sortDirection = selectedOption.split('_')[1];
            table.order([sortColumn, sortDirection]).draw();
        });
    });
</script>
@endsection

@endsection