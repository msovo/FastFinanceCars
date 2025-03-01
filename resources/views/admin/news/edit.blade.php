<!-- resources/views/admin/news/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit News Article')

@section('content')
<div class="container-fluid mt-4">
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4><i class="fas fa-edit"></i> Edit News Article</h4>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to News
        </a>
    </div>

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

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

    <!-- Edit News Form -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-edit"></i> Edit News Details</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news->news_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div class="form-group">
                    <label for="title"><strong>Title <span class="text-danger">*</span></strong></label>
                    <input type="text"
                           class="form-control @error('title') is-invalid @enderror"
                           id="title" name="title"
                           value="{{ old('title', $news->title) }}" required>
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
                                {{ old('category_id', $news->category_id) == $category->category_id ? 'selected' : '' }}>
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
                              id="content" name="content" rows="6" required>{{ old('content', $news->content) }}</textarea>
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
                    @if($news->thumbnail_url)
                        <div class="mt-2">
                            <label>Current Thumbnail:</label><br>
                            <img src="{{ asset('storage/' . $news->thumbnail_url) }}" alt="Thumbnail" width="150">
                        </div>
                    @endif
                    <small class="form-text text-muted">Accepted formats: jpg, jpeg, png, gif. Max size: 2MB.</small>
                </div>

                <!-- Form Actions -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update News
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Manage Images -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"><i class="fas fa-images"></i> Manage Images</h5>
        </div>
        <div class="card-body">
            <!-- Existing Images -->
            @if($news->images->count() > 0)
                <div class="row mb-4">
                    @foreach($news->images as $image)
                        <div class="col-md-2 text-center">
                            <img src="{{ asset('storage/' . $image->image_url) }}" class="img-thumbnail mb-2" alt="Image">
                           
                        </div>
                    @endforeach
                </div>
            @else
                <p>No images added.</p>
            @endif

            <!-- Add New Images -->
            <form action="{{ route('admin.news.addImage', $news->news_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="images"><strong>Add Images</strong></label>
                    <input type="file" class="form-control-file @error('images') is-invalid @enderror" id="images" name="images[]" multiple accept="image/*">
                    @error('images')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @error('images.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">You can select multiple images. Accepted formats: jpg, jpeg, png, gif.</small>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Upload Images
                </button>
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
        // Optionally, display the file name
    });
</script>
@endsection

@endsection