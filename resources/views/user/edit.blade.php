<!-- resources/views/user/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Profile</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update', $user->user_id) }}" enctype="multipart/form-data">
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
                                @if ($user->profile_image)
                                    <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-thumbnail mt-2" alt="Profile Image" width="150">
                                @else
                                    <img src="https://via.placeholder.com/150" class="img-thumbnail mt-2" alt="Profile Image">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('user.profile', $user->user_id) }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
