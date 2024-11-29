@extends('layouts.dealer')

@section('content')
    <h1>News Management</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('dealer.store.news') }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" required></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category" required>
                <option value="">Select
 Category</option> 
                @foreach ($categories as $category)
                    <option value="{{$category->category_name }}">
                        {{ $category->category_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="thumbnail_url">Thumbnail</label> 
            <input type="file" class="form-control-file" id="thumbnail_url" name="thumbnail_url" required>
        </div>
       
        <button type="submit" class="btn btn-primary">Add News</button>
    </form>

    <h2>Existing News</h2>
    <table id="news-table" class="table table-bordered table-striped"> 
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $newsItem)
                <tr>
                    <td>{{ $newsItem->title }}</td>
                    <td>
                        <a href="{{ route('dealer.news.edit', $newsItem->news_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('dealer.news.destroy', $newsItem->news_id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-news">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#news-table').DataTable();

            $(document).on('click', '.delete-news', function(e) {
                e.preventDefault();
                if (confirm("Are you sure you want to delete this news item?")) {
                    $(this).closest('form').submit();
                }
            });
        });
    </script>
@endsection