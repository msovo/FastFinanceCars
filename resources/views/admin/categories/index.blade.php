<!-- resources/views/admin/categories/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="card mt-3">
    <div class="card-header">Categories</div>
    <div class="card-body">
        <table id="categories" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Type</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->category_id }}</td>
                        <td>{{ $category->category_type }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#categories').DataTable();
});
</script>
@endsection
