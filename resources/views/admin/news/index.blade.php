<!-- resources/views/admin/news/index.blade.php -->
@extends('layouts.admin')

@section('title', 'News Management')

@section('content')
<div class="container-fluid mt-5">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-newspaper"></i> News Management</h4>
        <a href="{{ route('admin.news.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New News
        </a>
    </div>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <!-- News Table -->
    <div class="card">
        <div class="card-body">
            <table id="newsTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Thumbnail</th>
                        <th>Published At</th>
                        <th width="150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <!-- Limit content display -->
                        <td>{{ Str::limit(strip_tags($item->content), 50, '...') }}</td>
                        <td>{{ $item->author->name }}</td>
                        <td>{{ $item->categories->category_name }}</td>
                        <td>
                            @if($item->thumbnail_url)
                                <img src="{{ asset('storage/' . $item->thumbnail_url) }}" alt="Thumbnail" width="50">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{ $item->published_at ? $item->published_at : 'N/A' }}</td>
                        <td>
                            <a href="{{ route('admin.news.edit', $item->news_id) }}" class="btn btn-warning btn-sm mb-1">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.news.destroy', $item->news_id) }}" method="POST" style="display:inline;" 
                                  onsubmit="return confirm('Are you sure you want to delete this news item?');">
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
        $('#newsTable').DataTable({
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
                { orderable: false, targets: [4, 6] }, // Disable ordering on Thumbnail and Actions columns
            ]
        });
    });
</script>
@endsection

@endsection