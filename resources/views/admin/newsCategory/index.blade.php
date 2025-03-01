<!-- resources/views/admin/newsCategory/index.blade.php -->
@extends('layouts.admin')

@section('title', 'News Categories')

@section('content')
<div class="container-fluid mt-5">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-newspaper"></i> News Categories</h4>
        <a href="{{ route('admin.newsCategory.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Category
        </a>
    </div>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Categories Table -->
    <div class="card">
        <div class="card-body">
            <table id="categoriesTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th width="150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <a href="{{ route('admin.newsCategory.edit', $category->category_id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.newsCategory.destroy', $category->category_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mt-1">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables Scripts -->
@section('scripts')
<script>
    $(document).ready(function() {
        $('#categoriesTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            autoWidth: false,
            columnDefs: [
                { orderable: false, targets: [1] } // Actions column
            ]
        });
    });
</script>
@endsection

@endsection