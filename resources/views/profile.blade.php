<!-- resources/views/profile.blade.php -->
@extends('layouts.index')

@section('content')
<style>
    .modal-backdrop{
        z-index: 0;
    }
</style>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Profile Overview</div>
                <div class="card-body text-center">
                    @if ($user->profile_image)
                        <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-thumbnail" alt="Profile Image" width="150">
                    @else
                        <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Profile Image">
                    @endif
                    <h5>{{ $user->username }}</h5>
                    <p>{{ $user->email }}</p>
                    <p>{{ $user->phone }}</p>
                    <p>{{ $user->address }}, {{ $user->city }}, {{ $user->country }}</p>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteProfileModal">Delete Profile</button>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Engagement Overview</div>
                <div class="card-body">
                    <p>Cars Viewed: {{ $engagementMetrics['cars_viewed'] }}</p>
                    <p>Cars Listed: {{ $engagementMetrics['cars_listed'] }}</p>
                    <p>News Read: {{ $engagementMetrics['news_read'] }}</p>
                    <p>Days Signed In: {{ $engagementMetrics['days_signed_in'] }}</p>
                    <p>Subscriptions: {{ $engagementMetrics['subscriptions'] }}</p>
                    <!-- Add more metrics as needed -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="{{ $user->country }}">
                    </div>
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.change-password') }}">
                    @csrf
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="new_password_confirmation">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Profile Modal -->
<div class="modal fade" id="deleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="deleteProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProfileModalLabel">Delete Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete your profile? This action cannot be undone.</p>
                <form method="POST" action="{{ route('user.delete') }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
