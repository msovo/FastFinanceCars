<!-- resources/views/admin/newsCategory/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>News Categories</h1>
    <a href="{{ route('admin.newsCategory.create') }}" class="btn btn-primary mb-3">Add New Category</a>
    <table id="categoriesTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Category Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{ $category->category_name }}</td>
                <td>
                    <a href="{{ route('admin.newsCategory.edit', $category->category_id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.newsCategory.destroy', $category->category_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
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

<script>
$(document).ready(function() {
    $('#categoriesTable').DataTable({
        responsive: true,
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
});
</script>
@endsection
