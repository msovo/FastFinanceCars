@extends('layouts.dealer')

@section('content')

    <h1>Manage Listings</h1>
    <table class="table table-striped" id="listings-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($listings as $listing)
                <tr>
                    <td>
                        @if ($listing->vehicle->images->isNotEmpty())
                            <img src="{{ asset(path: 'storage/' . $listing->vehicle->images[0]->image_url) }}" alt="Vehicle Image" style="max-width: 100px; max-height: 100px;">
                        @else
                            No Image
                        @endif                    
                    <td>{{ $listing->vehicle->car_brand->name ?? 'N/A' }}</td>
                    <td>{{ $listing->vehicle->car_model->name ?? 'N/A' }}</td>
                    <td>{{ $listing->vehicle->year ?? 'N/A' }}</td>
                    <td>{{ $listing->vehicle->price ?? 'N/A' }}</td>
                    <td>
                        @if ($listing->listing_status == 'sold')
                            Sold
                        @else
                            {{ $listing->listing_status }}
                        @endif
                    </td>
                    <td>
                        @if ($listing->listing_status == 'active')
                            <button class="btn btn-warning btn-sm unlist-btn" data-id="{{ $listing->vehicle_id }}" data-toggle="modal" data-target="#unlistModal{{ $listing->vehicle_id }}">Unlist</button>
                            <div class="modal fade" id="unlistModal{{ $listing->vehicle_id }}" tabindex="-1" role="dialog" aria-labelledby="unlistModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="unlistModalLabel">Confirm Unlist</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to unlist this vehicle?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('dealer.vehicles.unlist', $listing->vehicle_id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-warning">Unlist</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($listing->listing_status == 'inactive')
                            <form action="{{ route('dealer.vehicles.list', $listing->vehicle_id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-success btn-sm">List</button>
                            </form>
                        @endif

                        @if ($listing->listing_status != 'sold' && !($listing->featured ?? false))
                            <button class="btn btn-success btn-sm feature-btn" data-id="{{ $listing->vehicle_id }}" data-toggle="modal" data-target="#featureModal{{ $listing->vehicle_id }}">Feature</button>
                            <div class="modal fade" id="featureModal{{ $listing->vehicle_id }}" tabindex="-1" role="dialog" aria-labelledby="featureModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="featureModalLabel">Confirm Feature</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to feature this vehicle?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('dealer.vehicles.feature', $listing->vehicle_id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Confirm Feature</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($listing->listing_status != 'sold' && !($listing->sponsored ?? false))
                            <button class="btn btn-info btn-sm sponsor-btn" data-id="{{ $listing->vehicle_id }}" data-toggle="modal" data-target="#sponsorModal{{ $listing->vehicle_id }}">Sponsor</button>
                            <div class="modal fade" id="sponsorModal{{ $listing->vehicle_id }}" tabindex="-1" role="dialog" aria-labelledby="sponsorModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sponsorModalLabel">Confirm Sponsor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to sponsor this vehicle?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <form action="{{ route('dealer.vehicles.sponsor', $listing->vehicle_id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-info">Confirm Sponsor</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#listings-table').DataTable();
        });
    </script>
@endsection
