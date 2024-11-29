<!-- resources/views/user/profile.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $user->username }}'s Profile</div>
                    <div class="card-body">
                        <p>Email: {{ $user->email }}</p>
                        <p>Phone: {{ $user->phone }}</p>
                        <p>Address: {{ $user->address }}</p>
                        <p>City: {{ $user->city }}</p>
                        <p>Country: {{ $user->country }}</p>
                        <a href="{{ route('user.edit', $user->user_id) }}" class="btn btn-primary">Edit Profile</a>
                        <form method="POST" action="{{ route('user.destroy', $user->user_id) }}" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Account</button>
                        </form>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
