@extends('layouts.admin')

@section('content')
<div class="container mt-5">
<div class="card-header">Add New User</div>
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="user_type">User Type</label>
            <input type="text" class="form-control" id="user_type" name="user_type" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" id="city" name="city">
        </div>
        <div class="form-group">
            <label for="country">Country</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="text" class="form-control" id="profile_image" name="profile_image">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
    </form>
</div>
@endsection
