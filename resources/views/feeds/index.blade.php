@extends('layouts.index')

@section('content')
<style>
/* General Layout Enhancements */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
}
.modal-backdrop{
        z-index: 0;
    }
.container {
    max-width: 900px;
    margin: 0 auto;
}

h1 {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
}

/* Stories Section */
.stories {
    gap: 1rem;
}

.story-thumb img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.story-thumb img:hover {
    transform: scale(1.1);
}

/* Feed Card Styling */
.feed {
    border: 1px solid #ddd;
    transition: box-shadow 0.3s ease;
}

.feed:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.feed-header img {
    object-fit: cover;
}

.feed img {
    max-height: 400px;
    object-fit: cover;
}

/* Buttons and Forms */
button {
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    transform: translateY(-2px);
}

/* Comments */
.comments {
    background-color: #f1f1f1;
    padding: 10px;
    border-radius: 5px;
}
</style>

<style>
    body {
        background-color: #f0f2f5;
    }
    .feed-upload .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .feed-upload .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #dee2e6;
    }
    .feed-upload .card-title {
        margin-bottom: 0;
    }
    .feed-upload .form-label {
        font-weight: 600;
    }
    .feed-upload .form-control {
        border-radius: 5px;
    }
    .feed-upload .btn-outline-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 10px;
        font-size: 16px;
    }
    .feed-upload .btn-outline-primary i {
        margin-right: 8px;
    }
    .feed-upload .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
    .feed-upload .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }
    .feed-preview-item {
        position: relative;
        display: inline-block;
    }
    .feed-preview-item img, .feed-preview-item video {
        max-width: 100px;
        max-height: 100px;
        border-radius: 5px;
    }
    .feed-preview-item .remove-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }
</style>

<div class="container mt-4">
    <h1 class="text-center mb-4">Car Media</h1>

    <!-- Stories Section -->
    <div class="stories-section mb-4">
    <div class="d-flex overflow-auto align-items-center">
        @auth
            <!-- Upload Story -->
            <div class="story-upload text-center me-3">
            <button id="uploadStoryBtn" class="btn btn-outline-primary rounded-circle d-flex justify-content-center align-items-center"
                style="width: 60px; height: 60px;">
            <i class="bi bi-camera"></i>
        </button>
        <small>Upload Story</small>
            </div>
        @endauth

        <!-- Existing Stories -->
        @forelse($stories as $story)
            <div class="story text-center me-3">
                <div class="story-thumb border rounded-circle overflow-hidden">
                    <img src="{{ $story->media_path ? Storage::url($story->media_path) : asset('images/default_story.jpg') }}" 
                         alt="Story" class="img-fluid">
                </div>
                <small>{{ $story->user->username ?? 'Unknown User' }}</small>
            </div>
        @empty
            <p class="text-muted">No stories available.</p>
        @endforelse
    </div>
</div>



    <div class="modal fade" id="storyUploadModal" tabindex="-1" aria-labelledby="storyUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="storyUploadModalLabel">Share Your Story</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <!-- Column 1: Upload Button -->
                        <div class="col-md-6 d-flex flex-column align-items-center">
                            <label for="story-media" class="btn btn-outline-primary mb-3 w-100">
                                <i class="bi bi-upload"></i> Choose Media
                            </label>
                            <input type="file" class="d-none" id="story-media" name="media" accept="image/*,video/*" onchange="previewStoryMedia()" required>
                            <p class="text-muted small text-center">Max 2 mins for videos.</p>
                        </div>
                        <!-- Column 2: Content Input -->
                        <div class="col-md-6">
                            <label for="story-caption" class="form-label">Add a Caption</label>
                            <input type="text" class="form-control" id="story-caption" name="caption" placeholder="What's on your mind?">
                        </div>
                    </div>
                    <!-- Preview Section -->
                    <div id="story-preview-section" class="mt-4" style="display: none;">
                        <p class="fw-bold">Preview:</p>
                        <div id="story-preview" class="d-flex align-items-center gap-3 flex-wrap">
                            <!-- Preview will dynamically display here -->
                        </div>
                    </div>
                    <!-- Upload Button -->
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary w-50">Post Story</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Feed Upload Section -->
    @auth
    <div class="feed-upload mb-4">
    <form id="feed-form" action="{{ route('feeds.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Share Your Feed</h5>
            </div>
            <div class="card-body">
                <div class="mb-3 text-center">
                    <label for="feed-media" class="btn btn-outline-primary w-100">
                        <i class="bi bi-upload"></i> Choose Media
                    </label>
                    <input type="file" class="d-none" id="feed-media" name="media[]" accept="image/*,video/*" multiple required onchange="previewFeedMedia()">
                    <p class="text-muted small">Max: 5 mins for videos.</p>
                </div>
                <div class="mb-3">
                    <label for="feed-caption" class="form-label">Caption</label>
                    <input type="text" class="form-control" id="feed-caption" name="caption" placeholder="What's on your mind?">
                </div>
                <div id="feed-preview" class="mb-3" style="display: none;">
                    <p class="fw-bold">Preview:</p>
                    <div id="feed-preview-container" class="d-flex gap-2 overflow-auto"></div>
                </div>
            </div>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary w-50">Post Feed</button>
            </div>
        </div>
    </form>
</div>

    @endauth

    <div id="feeds-container">
    @include('partials._feeds', ['feeds' => $feeds])
</div>
    <!-- Feeds Section -->
  
</div>

<script>

    // Function to preview story media and enable delete functionality
    function previewStoryMedia() {
        const input = document.getElementById('story-media');
        const previewSection = document.getElementById('story-preview-section');
        const previewContainer = document.getElementById('story-preview');

        previewContainer.innerHTML = ''; // Clear previous previews

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const url = URL.createObjectURL(file);
            const wrapper = document.createElement('div');
            wrapper.className = 'position-relative';

            const media = document.createElement(file.type.startsWith('image/') ? 'img' : 'video');
            media.src = url;
            media.className = 'rounded border';
            media.style.width = '120px';
            media.style.height = '120px';
            media.controls = file.type.startsWith('video/');

            // Delete button for preview
            const deleteButton = document.createElement('button');
            deleteButton.className = 'btn btn-danger btn-sm position-absolute top-0 end-0';
            deleteButton.innerHTML = '<i class="bi bi-x"></i>';
            deleteButton.onclick = () => {
                input.value = ''; // Clear file input
                wrapper.remove(); // Remove preview
                previewSection.style.display = previewContainer.children.length === 0 ? 'none' : 'block';
            };

            wrapper.appendChild(media);
            wrapper.appendChild(deleteButton);
            previewContainer.appendChild(wrapper);

            previewSection.style.display = 'block';
        }
    }


   
    let selectedFiles = [];

function previewFeedMedia() {
    const previewContainer = document.getElementById('feed-preview-container');
    const previewSection = document.getElementById('feed-preview');
    const files = document.getElementById('feed-media').files;

    // Add new files to the selectedFiles array
    for (let i = 0; i < files.length; i++) {
        selectedFiles.push(files[i]);
    }

    previewContainer.innerHTML = '';
    if (selectedFiles.length > 0) {
        previewSection.style.display = 'block';
    } else {
        previewSection.style.display = 'none';
    }

    selectedFiles.forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const previewItem = document.createElement('div');
            previewItem.classList.add('feed-preview-item');

            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = e.target.result;
                previewItem.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = e.target.result;
                video.controls = true;
                previewItem.appendChild(video);
            }

            const removeBtn = document.createElement('button');
            removeBtn.classList.add('remove-btn');
            removeBtn.innerHTML = '&times;';
            removeBtn.onclick = function() {
                removeMedia(index);
            };
            previewItem.appendChild(removeBtn);

            previewContainer.appendChild(previewItem);
        };
        reader.readAsDataURL(file);
    });
}

function removeMedia(index) {
    selectedFiles.splice(index, 1);

    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.getElementById('feed-media').files = dataTransfer.files;

    previewFeedMedia();
}

document.getElementById('feed-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData();
    selectedFiles.forEach(file => formData.append('media[]', file));
    formData.append('caption', document.getElementById('feed-caption').value);
    formData.append('_token', '{{ csrf_token() }}');

    fetch('{{ route('feeds.store') }}', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(html => {
        document.getElementById('feeds-container').innerHTML = html;
        selectedFiles = [];
        document.getElementById('feed-form').reset();
        document.getElementById('feed-preview').style.display = 'none';
    })
    .catch(error => console.error('Error:', error));
});


    function toggleComments(id) {
        const comments = document.getElementById('comments-' + id);
        comments.style.display = comments.style.display === 'none' ? 'block' : 'none';
    }
</script>

<script>
    // Wait for the DOM to fully load
    document.addEventListener('DOMContentLoaded', function () {
        // Select the button and modal
        const uploadStoryBtn = document.getElementById('uploadStoryBtn');
        const storyUploadModal = new bootstrap.Modal(document.getElementById('storyUploadModal'));

        // Add click event listener to the button
        uploadStoryBtn.addEventListener('click', function () {
            storyUploadModal.show(); // Programmatically show the modal
        });
    });
</script>

@endsection


