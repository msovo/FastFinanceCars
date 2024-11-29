@extends('layouts.admin')

@section('content')
<div class="container mt-5">
User Management</div>
    <button class="btn btn-primary mb-3" onclick="location.href='{{ route('admin.users.create') }}'">Add New User</button>
    <table id="usersTable" class="display">
        <thead>
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
                <td>{{ $user->user_type }}</td>
                <td>
                    <button class="btn btn-info" onclick="editUser({{ $user->user_id }})">Edit</button>
                    <button class="btn btn-danger" onclick="confirmDelete({{ $user->user_id }})">Delete</button>
                </td>
            @endforeach
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    $('#usersTable').DataTable();
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
            }
        });
    }
}
</script>
@endsection
