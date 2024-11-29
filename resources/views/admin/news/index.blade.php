<!-- resources/views/admin/news/index.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>News Management</h1>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Add New News</a>
    <table id="newsTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Category</th>
                <th>Thumbnail</th>
                <th>Published At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->content }}</td>
                <td>{{ $item->author->name }}</td>
                <td>{{ $item->category }}</td>
                <td>
                    @if($item->thumbnail_url)
                        <img src="{{ asset('storage/' . $item->thumbnail_url) }}" alt="Thumbnail" width="50">
                    @endif
                </td>
                <td>{{ $item->published_at }}</td>
                <td>
                    <a href="{{ route('admin.news.edit', $item->news_id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('admin.news.destroy', $item->news_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this news item?');">
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
    $('#newsTable').DataTable({
        responsive: true,
        buttons: [
            'copy', 'excel', 'pdf'
        ]
    });
});
</script>
@endsection
