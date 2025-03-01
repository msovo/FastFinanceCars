@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
            <h4 class="mb-0">User Management</h4>
            <button class="btn btn-success" onclick="location.href='{{ route('admin.users.create') }}'">
                <i class="fas fa-user-plus me-2"></i>Add New User
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="usersTable" class="table table-striped table-bordered nowrap" style="width:100%">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>User Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->user_type) }}</td>
                            <td>
                                <button class="btn btn-info btn-sm me-2" onclick="editUser({{ $user->user_id }})">
                                    <i class="fas fa-edit me-1"></i>Edit
                                </button>
                                <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $user->user_id }})">
                                    <i class="fas fa-trash-alt me-1"></i>Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome CDN for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-p0vKQ6Z5I0VPLmRw0jVb9japFX6KUlxYF59yZoX5jk6vHBJfIQWy8VnydE7GS+BpnVfjHVi/7xdiasnCr0Smyw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

<script>
$(document).ready(function() {
    $('#usersTable').DataTable({
        responsive: true,
        columnDefs: [
            { orderable: false, targets: 4 } // Make Actions column non-sortable
        ]
    });
});

function editUser(userId) {
    window.location.href = '/admin/users/' + userId + '/edit';
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
                location.reload();
            },
            error: function(xhr) {
                alert('Failed to delete the user. Please try again.');
            }
        });
    }
}
</script>
@endsection