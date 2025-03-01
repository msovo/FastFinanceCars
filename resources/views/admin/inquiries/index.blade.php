<!-- resources/views/admin/inquiries/index.blade.php -->

@extends('layouts.admin')

@section('title', 'Inquiries for ' . $vehicle->car_brand->name . ' ' . $vehicle->car_model->name)

@section('content')

<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">
                <i class="fas fa-envelope"></i> Inquiries for {{ $vehicle->car_brand->name }} {{ $vehicle->car_model->name }}
            </h4>
        </div>
        <div class="card-body">
            <a href="{{ route('admin.vehicles.index') }}" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Back to Vehicles
            </a>

            @if ($inquiries->isEmpty())
                <div class="alert alert-warning">
                    No inquiries found for this vehicle.
                </div>
            @else
                <table id="inquiries-table" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Inquirer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                            <!-- Add more columns as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inquiries as $inquiry)
                            <tr>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->phone }}</td>
                                <td>{{ $inquiry->message }}</td>
                                <td>{{ $inquiry->created_at ? $inquiry->created_at : 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<!-- Include DataTables scripts -->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#inquiries-table').DataTable({
            paging: true,
            searching: true,
            info: true,
            autoWidth: false,
            responsive: true,
            order: [[ 4, 'desc' ]], // Sort by Date descending
        });
    });
</script>
@endsection

@endsection