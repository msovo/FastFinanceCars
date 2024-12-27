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
small.text-truncate {
    display: block;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.modal-body {
    background-color: #000;
    color: #fff;
    text-align: center;
}
.swiper-slide img {
    max-width: 100%;
    height: auto;
    border-radius: 15px;
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

    .story-thumb {
    width: 60px;
    height: 60px;
    position: relative;
}
.progress-ring svg {
    fill: none;
    stroke:#aa0101; /* Progress line color */
    stroke-width: 2;
    transform: rotate(-90deg);
    transform-origin: 50% 50%;
    top: -1px!important;
    left: -1px!important;

}
.story-viewer {
    position: relative;
    height: 80vh;
    width: 100%;
    display: flex;
    overflow: hidden;
}

.story-preview {
    opacity: 0.6;
    transition: all 0.3s ease;
}

.story-active {
    flex: 1;
    text-align: center;
}

.story-actions {
    margin-top: 20px;
}

.modal .modal-footer {
    display: flex;
    align-items: center;
    gap: 10px;
}

.modal-content {
    width: 80%;
}
/* General Styles */
body {
    color: black;
    background-color: white;
}

.modal-content {
    background-color: white;
    color: black;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 0;
    margin: 0;
}

.modal-header .btn-close {
    background-color: black;
    color: white;
    border: none;
    border-radius: 50%;
    padding: 5px 10px;
    cursor: pointer;
}

.modal-header .btn-close:hover {
    background-color: #333;
}

.story-thumb {
    width: 60px;
    height: 60px;
    position: relative;
}

.story-viewer {
    position: relative;
    height: 80vh;
    width: 100%;
    display: flex;
    overflow: hidden;
    padding: 0;
    margin: 0;
}

.story-preview {
    opacity: 0.6;
    transition: all 0.3s ease;
}

.story-active {
    flex: 1;
    text-align: center;
}

.story-actions {
    margin-top: 10px;
    padding: 0;
}

/* Progress Bar Styles */
.progress-bars {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    top: 10px;
    left: 0;
    right: 0;
    padding: 0 10px;
    gap: 5px;
}

.progress-bar {
    flex: 1;
    height: 4px;
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar .progress {
    height: 100%;
    background-color: green;
    width: 0;
    transition: width 0.1s linear;
}

/* Story Content Styles */
.story-content {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: auto;
    padding: 0;
    margin: 0;
}

.story-content img {
    max-height: 100%;
    max-width: 100%;
    object-fit: cover;
}

.story-caption,
.story-timestamp {
    color: black;
    font-size: 14px;
    margin: 5px 0;
}

/* Modal Footer Styles */
.modal-footer {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 0;
    margin: 0;
}

.story-actions {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    width: 100%;
    padding: 0;
    margin: 0;
}

.story-actions .btn {
    padding: 5px 10px;
    font-size: 14px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.story-actions .btn:hover {
    background-color: #0056b3;
}

.reaction-options .btn {
    margin: 0 5px;
    font-size: 14px;
}

</style>

<div class="container mt-4">
    <h1 class="text-center mb-4">Car Media</h1>

    <div id="stories-container">
    @include('partials._stories', ['stories' => $stories])
    </div>

<!-- Story Modal -->

<div id="modalStoryPlaceholder"></div>



<!-- Modal for Comments -->
<div id="commentsModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Comments</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="commentsContent">
                <!-- Dynamically loaded comments -->
            </div>
            <div class="modal-footer">
                <input type="text" id="commentInput" placeholder="Write a comment..." class="form-control">
                <button class="btn btn-primary" id="submitComment">Post</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Messaging -->
<div id="messageModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Send a Message</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <textarea id="messageInput" placeholder="Type your message..." class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="sendMessage">Send</button>
            </div>
        </div>
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
    <form id="feed-form" enctype="multipart/form-data">
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
                <style>

            </style>
                <div class="progress mb-3" style="display: none;">
                    <div id="upload-progress" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <input type="hidden" name="ajax" value="ajax"/>
            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary w-50">Post Feed</button>
            </div>
        </div>
    </form>
</div>
    @endauth

    <div id="feeds-container">
    @include('partials._feeds',  ['feeds' => $feeds])
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
    const MAX_FILES = 8;

    function previewFeedMedia() {
    const previewContainer = document.getElementById('feed-preview-container');
    const previewSection = document.getElementById('feed-preview');
    const files = document.getElementById('feed-media').files;

    // Add new files to the selectedFiles array
    for (let i = 0; i < files.length; i++) {
        if (selectedFiles.length < MAX_FILES) {
            selectedFiles.push(files[i]);
        } else {
            alert('You can only upload up to ' + MAX_FILES + ' files.');
            break;
        }
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
    selectedFiles=[];
    previewFeedMedia();
}

$('#feed-form').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        var formData = new FormData(this);
        var progressBar = $('#upload-progress');
        var progressContainer = $('.progress');

        $.ajax({
            url: '{{ route('feeds.store') }}',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener('progress', function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
                        console.log('Progress:', percentComplete); // Debugging line
                        progressBar.css('width', percentComplete + '%');
                        progressBar.attr('aria-valuenow', percentComplete);
                    } else {
                        console.log('Unable to compute progress information since the total size is unknown.');
                    }
                }, false);
                return xhr;
            },
            beforeSend: function() {
                progressContainer.show();
                progressBar.css('width', '0%');
                progressBar.attr('aria-valuenow', '0');
            },
            success: function(response) {
                // Handle the response data
                $('#feeds-container').html(response);
                $('#feed-form')[0].reset();
                $('#feed-preview').hide();
                progressContainer.hide();
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                // Optionally, you can show an error message
                progressContainer.hide();
            }
        });
    });

    function toggleComments(id) {
        const comments = document.getElementById('comments-' + id);
        comments.style.display = comments.style.display === 'none' ? 'block' : 'none';
    }
</script>

<script>

function closeModalStory(){
    $('#storyModal').hide();
    $('.modal-backdrop').hide();
    
}
document.addEventListener("DOMContentLoaded", () => {
    const users = @json($stories); // Backend data with nested stories
    const thumbs = document.querySelectorAll(".story-thumb");
    const modalPlaceholder = document.getElementById("modalStoryPlaceholder");
    let currentTimer = null;
    const storageBasePath = "{{ asset('storage/') }}";
    // Clear Timer Function
    const clearExistingTimer = () => {
        if (currentTimer) {
            clearTimeout(currentTimer);
            currentTimer = null;
        }
    };

    // Create and Render Modal Function
    const renderModal = (userStories, username) => {
        clearExistingTimer();
        const modalHTML = `
            <div class="modal fade" id="storyModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">${username}'s Stories</h5>
                            <button type="button" class="btn-close" onclick="closeModalStory()" data-bs-dismiss="modal" aria-label="Close">X</button>
                        </div>
                        <div class="modal-body">
                            <div class="swiper" id="storySwiper">
                                <div class="swiper-wrapper">
                                    ${userStories.map(story => `
                                        <div class="swiper-slide">
                                            <div class="story-content">
                                                <img src ='${storageBasePath}/${story.media_path}' alt="Story Image" class="img-fluid">
                                                <div class="story-caption">${story.caption || ""}</div>
                                                <div class="story-timestamp">${humanizeTimestamp(story.created_at)}</div>
                                            </div>
                                        </div>
                                    `).join('')}
                                </div>
                            </div>
                            <div class="progress-bars">
                                ${userStories.map(() => `<div class="progress-bar"><div class="progress"></div></div>`).join('')}
                            </div>
                        </div>
                        <div class="modal-footer">
                              <div class="story-actions d-flex justify-content-between align-items-center mt-3">
                                        <div class="reactions">
                                            <button class="btn btn-outline-primary reaction-btn">React</button>
                                            <div class="reaction-options d-none">
                                                <button class="btn btn-outline-primary reaction" data-reaction="love">❤️</button>
                                                <button class="btn btn-outline-success reaction" data-reaction="like">👍</button>
                                                <button class="btn btn-outline-warning reaction" data-reaction="sad">😢</button>
                                                <button class="btn btn-outline-info reaction" data-reaction="laugh">😂</button>
                                            </div>
                                        </div>
                                      <button class="btn btn-light comment-btn">Comment</button>
                                  <button class="btn btn-light dm-btn">DM</button>
                           </div>
                    </div>
                </div>
            </div>`;

        modalPlaceholder.innerHTML = modalHTML;
        initializeSwiper(userStories.length);

        const modalElement = document.getElementById("storyModal");
        const modalInstance = new bootstrap.Modal(modalElement, { backdrop: "static" });
        modalInstance.show();

        modalElement.addEventListener("hidden.bs.modal", () => {
            clearExistingTimer();
            modalPlaceholder.innerHTML = ""; // Clear modal content
        });

        setupReactions();
    };

    // Initialize Swiper with Logic
    const initializeSwiper = (storyCount) => {
        const swiper = new Swiper("#storySwiper", {
            loop: false,
            allowTouchMove: true,
        });

        const progressBars = document.querySelectorAll(".progress-bar .progress");
        let currentStoryIndex = 0;

        const updateProgressBar = () => {
            progressBars.forEach((bar, index) => {
                bar.style.width = index === currentStoryIndex ? "0%" : "0%";
            });
            const activeBar = progressBars[currentStoryIndex];
            let progress = 0;

            clearExistingTimer();
            currentTimer = setInterval(() => {
                progress += 2;
                if (progress > 100) {
                    clearInterval(currentTimer);
                    currentStoryIndex++;

                    if (currentStoryIndex < storyCount) {
                        swiper.slideTo(currentStoryIndex);
                        updateProgressBar();
                    } else {
                        swiper.slideTo(0);
                        const modalElement = document.getElementById("storyModal");
                        const modalInstance = bootstrap.Modal.getInstance(modalElement);
                        modalInstance.hide();
                    }
                } else {
                    activeBar.style.width = `${progress}%`;
                }
            }, 100);
        };

        swiper.on("slideChange", () => {
            currentStoryIndex = swiper.activeIndex;
            updateProgressBar();
        });

        updateProgressBar(); // Start for the first story
    };

    // Setup Reaction Buttons
    const setupReactions = () => {
        const reactionButtons = document.querySelectorAll(".reaction");
        reactionButtons.forEach(button => {
            button.addEventListener("click", () => {
                const reactionType = button.dataset.reaction;
                console.log(`Reacted with: ${reactionType}`);
            });
        });

        document.querySelector(".comment-btn").addEventListener("click", () => {
            console.log("Comment button clicked.");
        });

        document.querySelector(".dm-btn").addEventListener("click", () => {
            console.log("DM button clicked.");
        });
    };

    // Convert Timestamp to Human Readable Format
    const humanizeTimestamp = (timestamp) => {
        const date = new Date(timestamp);
        return `${date.toLocaleDateString()} ${date.toLocaleTimeString()}`;
    };

    // Click Event for Thumbnails
    thumbs.forEach(thumb => {
        thumb.addEventListener("click", () => {
            const userId = thumb.dataset.userId;
            const groupedUsers = users.reduce((acc, row) => {
                const { user, ...story } = row;
                const existingUser = acc.find(u => u.user_id === user.user_id);

                if (existingUser) {
                    existingUser.stories.push(story);
                } else {
                    user.stories = [story];
                    acc.push(user);
                }

                return acc;
                }, []);

                const user = groupedUsers.find(user => user.user_id == userId);

            if (user && user.stories.length > 0) {
                renderModal(user.stories, user.username);
            } else {
                alert("No stories available for this user.");
            }
        });
    });
});



$(document).ready(function () {
    // Open modal with correct message type and IDs
    $('.send-message-btn').click(function () {
        const messageType = $(this).data('type');
        const feedId = $(this).data('feed-id') || '';
        const storyId = $(this).data('story-id') || '';

        // Set values in the modal
        $('#messageType').val(messageType);
        $('#feedId').val(feedId);
        $('#storyId').val(storyId);

        // Open the modal
        $('#sendMessageModal').modal('show');
    });

    // Handle form submission via Ajax
    $('#sendMessageForm').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: '{{ route("messages.store") }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                alert(response.message);
                $('#sendMessageModal').modal('hide');
                $('#sendMessageForm')[0].reset(); // Clear the form
            },
            error: function (xhr) {
                alert('Error: ' + xhr.responseJSON.message);
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    // Initialize Swiper
    const swiper = new Swiper(".swiper", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        loop: true,
    });

    // Handle Reactions
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("reaction")) {
            const reactionType = event.target.dataset.reaction;
            const storyId = swiper.slides[swiper.activeIndex].dataset.storyId; // Assuming story ID is stored in slide

            // Send Reaction to Backend
            fetch('/api/reactions', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ story_id: storyId, reaction: reactionType }),
            })
                .then(response => response.json())
                .then(data => alert(data.message))
                .catch(error => console.error('Error:', error));
        }
    });
    const activeSlide = swiper.slides[swiper.activeIndex];

    // Handle Comments
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("open-comments")) {
            const storyId = swiper.slides[swiper.activeIndex].dataset.storyId;

            // Show Comment Modal or Load Comments via Ajax
            alert("Comments for Story ID: " + storyId);
        }
    });

    // Handle Direct Messages
    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("dm-user")) {
            const storyId = swiper.slides[swiper.activeIndex].dataset.storyId;

            // Open DM Modal or Redirect
            alert("Message for Story ID: " + storyId);
        }
    });
});
// Pause timer when interacting with the active story


            $("#uploadStoryBtn").on("click", function(){
                $("#storyUploadModal").modal("show");
            })
</script>
<script>
    $('#imageModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var src = button.data('src');
        var modal = $(this);
        modal.find('#modalImage').attr('src', src);
    });


</script>
<script>
$(document).ready(function () {
    // Toggle comments section
    $(".toggle-comments").on("click", function () {
        const feedId = $(this).data("feed-id");
        $(`#comments-${feedId}`).collapse('toggle');
    });

    // Submit a comment
    $(document).on("click", ".btn-submit-comment", function () {
        const form = $(this).closest("form");
        const feedId = form.data("feed-id");
        const comment = form.find("input[name='comment']").val();

        if (!comment.trim()) return;

        $.ajax({
            url: "/comments",
            method: "POST",
            data: {
                _token: $("meta[name='csrf-token']").attr("content"),
                feed_id: feedId,
                comment: comment
            },
            success: function (response) {
                const commentHtml = `
                    <div class="comment d-flex mb-2">
                        <img src="${response.user.profile_image}" 
                             alt="User" class="rounded-circle me-2" width="30" height="30">
                        <div>
                            <strong>${response.user.username}</strong>
                            <p class="mb-1">${response.comment}</p>
                            <small class="text-muted">${response.time}</small>
                        </div>
                    </div>`;
                $(`#comments-${feedId} .comments-list`).append(commentHtml);
                form.find("input[name='comment']").val("");
            }
        });
    });

    // Fetch new comments every 5 seconds
    setInterval(function () {
        $(".comments-container").each(function () {
            const container = $(this);
            if (!container.hasClass("show")) return;

            const feedId = container.attr("id").split("-")[1];
            const lastComment = container.find(".comment:last");
            const lastFetched = lastComment.data("timestamp") || new Date().toISOString();

            $.ajax({
                url: `/feeds/${feedId}/comments`,
                method: "GET",
                data: { last_fetched: lastFetched },
                success: function (comments) {
                    comments.forEach(comment => {
                        const commentHtml = `
                            <div class="comment d-flex mb-2">
                                <img src="${comment.user.profile_image}" 
                                     alt="User" class="rounded-circle me-2" width="30" height="30">
                                <div>
                                    <strong>${comment.user.username}</strong>
                                    <p class="mb-1">${comment.comment}</p>
                                    <small class="text-muted">${comment.created_at}</small>
                                </div>
                            </div>`;
                        container.find(".comments-list").append(commentHtml);
                    });
                }
            });
        });
    }, 5000);
});

</script>
@endsection


