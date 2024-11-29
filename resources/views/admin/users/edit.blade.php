@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card-header">Edit User: {{ $user->username }}</div>

    <div class="btn-group mt-3" role="group">
        <button type="button" class="btn btn-secondary" onclick="showSection('editForm')">Edit Profile</button>
        <button type="button" class="btn btn-danger" onclick="showSection('deleteConfirmation')">Delete</button>
        <button type="button" class="btn btn-warning" onclick="showSection('deactivateConfirmation')">Deactivate</button>
        <button type="button" class="btn btn-info" onclick="location.reload()">Refresh</button>
    </div>

    <form id="editForm" action="{{ route('admin.users.update', $user->user_id) }}" method="POST" enctype="multipart/form-data" style="display: none;" class="mt-3">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="user_type">User Type</label>
                    <input type="text" class="form-control" id="user_type" name="user_type" value="{{ $user->user_type }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="profile_image">Profile Image</label>
                    <div class="mb-3">
                        <img src="{{ $user->profile_image ? Storage::url($user->profile_image) : asset('default-profile.png') }}" alt="Profile Image" class="img-thumbnail" width="150">
                    </div>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>

    <div id="deleteConfirmation" style="display: none;" class="mt-3">
        <p>Are you sure you want to delete this user?</p>
        <button class="btn btn-danger" onclick="confirmDelete({{ $user->user_id }})">Yes, Delete</button>
        <button class="btn btn-secondary" onclick="hideSection('deleteConfirmation')">Cancel</button>
    </div>

    <div id="deactivateConfirmation" style="display: none;" class="mt-3">
        <p>Are you sure you want to deactivate this user?</p>
        <button class="btn btn-warning" onclick="deactivateUser({{ $user->user_id }})">Yes, Deactivate</button>
        <button class="btn btn-secondary" onclick="hideSection('deactivateConfirmation')">Cancel</button>
    </div>

    <div id="userEngagements" class="mt-3">
        <h3>User Engagements</h3>
        @if($enquiries->isEmpty() && $dealership->isEmpty() && $products->isEmpty())
            <p>No engagements yet.</p>
        @else
            <div class="mt-3">
                <h4>Enquiries</h4>
                @if($enquiries->isEmpty())
                    <p>No enquiries yet.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Message</th>
                                <th>Created At</th>
                                <th>Vehicle Image</th>
                                <th>Price</th>
                                <th>Make</th>
                                <th>Model</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($enquiries as $enquiry)
                            <tr>

                                <td>{{ $enquiry->message }}</td>
                                <td>{{ $enquiry->created_at }}</td>
                                <td> 
                                    @if($enquiry->listing && $enquiry->listing->vehicle && $enquiry->listing->vehicle->images->first())
                                        <img src="{{ Storage::url($enquiry->listing->vehicle->images->first()->image_url) }}" alt="Vehicle Image" class="img-thumbnail" width="100">
                                    @else
                                        No image available
                                    @endif
                                </td>
                                <td>{{ $enquiry->listing->vehicle->price ?? 'N/A' }}</td>
                                <td>{{ $enquiry->listing->vehicle->make ?? 'N/A' }}</td>
                                <td>{{ $enquiry->listing->vehicle->model ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            <div class="mt-3">
                <h4>Dealership</h4>
                @if($dealership->isEmpty())
                    <p>No dealership yet.</p>
                @else
                    <!-- Display dealership details -->
                @endif
            </div>

            <div class="mt-3">
                <h4>Listing</h4>
                @if($products->isEmpty())
                    <p>No products listed yet.</p>
                @else
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Featured</th>
                                <th>Sponsored</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Vehicle Image</th>
                                <th>Price</th>
                                <th>Make</th>
                                <th>Model</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td>{{ $product->featured ? 'Yes' : 'No' }}</td>
                                <td>{{ $product->sponsored ? 'Yes' : 'No' }}</td>
                                <td>{{ $product->listing_status }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>
                                    @if($product->vehicle && $product->vehicle->images->first())
                                    <img src="{{ Storage::url($product->vehicle->images->first()->image_url) }}"alt="Vehicle Image" class="img-thumbnail" width="100">
                                    @else
                                        No image available
                                    @endif
                                </td>
                                <td>{{ $product->vehicle->price ?? 'N/A' }}</td>
                                <td>{{ $product->vehicle->make ?? 'N/A' }}</td>
                                <td>{{ $product->vehicle->model ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endif
    </div>
</div>

<script>
function showSection(sectionId) {
    // Hide all sections
    document.getElementById('editForm').style.display = 'none';
    document.getElementById('deleteConfirmation').style.display = 'none';
    document.getElementById('deactivateConfirmation').style.display = 'none';
    document.getElementById('userEngagements').style.display = 'none';

    // Show the selected section
    document.getElementById(sectionId).style.display = 'block';
}

function hideSection(sectionId) {
    document.getElementById(sectionId).style.display = 'none';
}

function confirmDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            url: '/admin/users/' + userId,
            type: 'DELETE',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(result) {
                window.location.href = '{{ route('admin.users.index') }}';
            }
        });
    }
}

function deactivateUser(userId) {
    if (confirm('Are you sure you want to deactivate this user?')) {
        // Implement deactivation logic here
    }
}
</script>
@endsection
