<!-- resources/views/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body text-center">
                        <h5>Welcome, {{ Auth::user()->username }}</h5>
                        @if (Auth::user()->profile_image)
                            <img src="{{ asset('storage/' . Auth::user()->profile_image) }}" class="img-thumbnail" alt="Profile Image" width="150">
                        @else
                            <img src="https://via.placeholder.com/150" class="img-thumbnail" alt="Profile Image">
                        @endif
                        <a href="{{ route('user.profile', Auth::user()->user_id) }}" class="btn btn-primary mt-3">View Profile</a>
                        <a href="{{ route('logout') }}" class="btn btn-danger mt-3"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
