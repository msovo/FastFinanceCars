<!-- resources/views/admin/users/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Add New User')

@section('content')
<div class="container-fluid mt-4">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-user-plus"></i> Add New User</h4>
        </div>
        <div class="card-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5><i class="fas fa-exclamation-triangle"></i> There were some problems with your input:</h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- User Creation Form -->
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Username -->
                <div class="form-group">
                    <label for="username"><strong>Username <span class="text-danger">*</span></strong></label>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           id="username" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="email"><strong>Email <span class="text-danger">*</span></strong></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- User Type -->
                <div class="form-group">
                    <label for="user_type"><strong>User Type <span class="text-danger">*</span></strong></label>
                    <select class="form-control @error('user_type') is-invalid @enderror" 
                            id="user_type" name="user_type" required>
                        <option value="" disabled selected>-- Select User Type --</option>
                        <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="dealer" {{ old('user_type') == 'dealer' ? 'selected' : '' }}>Dealer</option>
                        <option value="customer" {{ old('user_type') == 'customer' ? 'selected' : '' }}>Customer</option>
                        <!-- Add more user types as needed -->
                    </select>
                    @error('user_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Phone and Profile Image -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="phone"><strong>Phone</strong></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                               id="phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="profile_image"><strong>Profile Image</strong></label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('profile_image') is-invalid @enderror" 
                                   id="profile_image" name="profile_image" accept="image/*">
                            <label class="custom-file-label" for="profile_image">Choose file</label>
                            @error('profile_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address"><strong>Address</strong></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" 
                              id="address" name="address" rows="2">{{ old('address') }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- City and Country -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="city"><strong>City</strong></label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" 
                               id="city" name="city" value="{{ old('city') }}">
                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="country"><strong>Country</strong></label>
                        <input type="text" class="form-control @error('country') is-invalid @enderror" 
                               id="country" name="country" value="{{ old('country') }}">
                        @error('country')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Divider -->
                <hr>

                <!-- Password -->
                <div class="form-group">
                    <label for="password"><strong>Password <span class="text-danger">*</span></strong></label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation"><strong>Confirm Password <span class="text-danger">*</span></strong></label>
                    <input type="password" class="form-control" 
                           id="password_confirmation" name="password_confirmation" required>
                </div>

                <!-- Form Actions -->
                <div class="form-group d-flex justify-content-end">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> Back to Users
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-user-plus"></i> Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Custom Script -->
@section('scripts')
<script>
    // Show selected file name in the custom file input label
    document.getElementById('profile_image').addEventListener('change', function(event){
        let fileName = event.target.files[0].name;
        let label = event.target.nextElementSibling;
        label.innerText = fileName;
    });
</script>
@endsection

@endsection