@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Dealer Information -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Dealer Information</h4>
                </div>
                <div class="card-body">
                    <img src="{{ $dealer->logo_url }}" alt="Logo" class="img-fluid mb-3">
                    <h5>{{ $dealer->name }}</h5>
                    <p>{{ $dealer->about }}</p>
                    <div class="dealer-stats">
                        <p>Total Vehicles: {{ $dealer->listings_count }}</p>
                        <p>Cars Sold: {{ $dealer->sold_listings_count }}</p>
                        <p>Member Since: {{ $dealer->created_at->format('M d, Y') }}</p>
                        <p>Status: {{ ucfirst($dealer->status) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dealer Vehicles -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Dealer Vehicles</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="vehicles-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Make/Model</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dealer->listings as $listing)
                            <tr>
                                <td>
                                    <img src="{{ $listing->vehicle->primary_image }}" 
                                         alt="Vehicle" width="50">
                                </td>
                                <td>{{ $listing->vehicle->full_name }}</td>
                                <td>{{ $listing->vehicle->formatted_price }}</td>
                                <td>{{ $listing->listing_status }}</td>
                                <td>
                                    <a href="{{ route('admin.vehicles.show', $listing->vehicle) }}" 
                                       class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Inquiries Summary -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Inquiries Summary</h4>
                </div>
                <div class="card-body">
                    <table class="table" id="inquiries-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Vehicle</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dealer->inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->created_at->format('M d, Y') }}</td>
                                <td>{{ $inquiry->listing->vehicle->full_name }}</td>
                                <td>{{ $inquiry->customer_name }}</td>
                                <td>{{ $inquiry->status }}</td>
                                <td>
                                    <a href="{{ route('admin.inquiries.show', $inquiry) }}" 
                                       class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#vehicles-table, #inquiries-table').DataTable();
    });
</script>
@endpush