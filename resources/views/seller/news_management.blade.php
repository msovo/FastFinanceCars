@extends('layouts.seller')

@section('seller-content')
    <h1>News Management</h1>
    <form action="{{ route('store.news') }}" method="POST">
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
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="form-group">
            <label for="thumbnail_url">Thumbnail URL</label>
            <input type="text" class="form-control" id="thumbnail_url" name="thumbnail_url" required>
        </div>
        <button type="submit" class="btn btn-primary">Add News</button>
    </form>

    <h2>Existing News</h2>
    <table class="table">
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
                        <a href="#" class="btn btn-warning">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
