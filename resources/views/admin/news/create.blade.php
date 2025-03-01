<!-- resources/views/admin/news/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Add New News')

@section('content')
<div class="container-fluid mt-5">
    <!-- Card Wrapper -->
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="fas fa-newspaper"></i> Add New News Article
            </h4>
        </div>
        <div class="card-body">
            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h5>
                        <i class="fas fa-exclamation-triangle"></i> There were some problems with your input:
                    </h5>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-times-circle"></i> {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- News Creation Form -->
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <div class="form-group">
                    <label for="title"><strong>Title <span class="text-danger">*</span></strong></label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" 
                           value="{{ old('title') }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label for="category_id"><strong>Category <span class="text-danger">*</span></strong></label>
                    <select class="form-control @error('category_id') is-invalid @enderror" 
                            id="category_id" name="category_id" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" 
                                {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Content -->
                <div class="form-group">
                    <label for="content"><strong>Content <span class="text-danger">*</span></strong></label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="6" required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Thumbnail Image -->
                <div class="form-group">
                    <label for="thumbnail_url"><strong>Thumbnail Image</strong></label>
                    <input type="file" 
                           class="form-control-file @error('thumbnail_url') is-invalid @enderror" 
                           id="thumbnail_url" name="thumbnail_url" accept="image/*">
                    @error('thumbnail_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, gif. Max size: 2MB.</small>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary mr-2">
                        <i class="fas fa-arrow-left"></i> Back to News
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Publish News
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Rich Text Editor Script -->
@section('scripts')
<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    // Initialize CKEditor for the content textarea
    CKEDITOR.replace('content');

    // Optional: Handle file input label change
    document.getElementById('thumbnail_url').addEventListener('change', function(event){
        let fileName = event.target.files[0].name;
        event.target.nextElementSibling.innerText = fileName;
    });
</script>
@endsection

@endsection