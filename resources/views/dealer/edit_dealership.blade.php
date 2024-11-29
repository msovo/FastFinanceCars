@extends('layouts.dealer')

@section('content')
    <h1>Edit Dealership</h1>

    @if ($verified)
        <div class="alert alert-info">
            You cannot modify your dealership information since you have been verified. If you need to make changes, please contact the administrator.
        </div>
    @endif

    <form action="{{ route('dealer.update.dealership') }}" method="POST" enctype="multipart/form-data" @if ($verified) disabled @endif>
        @csrf
        <div class="form-group">
            <label for="dealership_name">Dealership Name</label>
            <input type="text" class="form-control" id="dealership_name" name="dealership_name" value="{{ $dealership->dealership_name }}" required>
        </div>
        <div class="form-group">
            <label for="license_number">License Number</label>
            <input type="text" class="form-control" id="license_number" name="license_number" value="{{ $dealership->license_number }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{ $dealership->address }}" required>
        </div>
        <div class="form-group">
            <label for="city_town">City/Town</label>
            <input type="text" class="form-control" id="city_town" name="city_town" value="{{ $dealership->city_town }}" required>
        </div>
        <div class="form-group">
            <label for="postal_code">Postal Code</label>
            <input type="number" class="form-control" id="postal_code" name="postal_code" value="{{ $dealership->postal_code }}" required>
        </div>
        <div class="form-group">
            <label for="logo">Logo</label>
            <input type="file" class="form-control-file" id="logo" name="logo">
        </div>
        <button type="submit" class="btn btn-primary">Update Dealership</button>
    </form>
@endsection