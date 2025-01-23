<!-- Feed Upload Modal -->
 <!-- Add the specific class to the modal -->
<div class="modal fade  feed-upload-modal" id="feedUploadModal" tabindex="-1" aria-labelledby="feedUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedUploadModalLabel">Create new post</h5>
                <button type="button" class="close-modal-btn" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body p-0">
                <form id="feed-upload-form" enctype="multipart/form-data">
                    @csrf
                    <div class="upload-container">
                        <!-- Upload Stage -->
                        <div class="upload-stage" id="uploadStage">
                            <div class="upload-area" id="uploadArea">
                                <input type="file" 
                                       class="file-input" 
                                       id="feed-media" 
                                       name="media[]" 
                                       accept="image/*,video/*" 
                                       multiple 
                                       required>
                                <div class="upload-content">
                                    <div class="media-icon">
                                        <i class="far fa-images fa-2x"></i>
                                    </div>
                                    <h3>Drag photos and videos here</h3>
                                    <button type="button" class="select-btn">
                                        Select from computer
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Preview Stage -->
                        <div class="preview-stage" id="previewStage" style="display: none;">
                            <div class="preview-container">
                                <div class="preview-gallery" id="previewGallery">
                                    <!-- Preview images will be inserted here -->
                                </div>
                                <div class="preview-controls">
                                    <button type="button" class="nav-btn prev-btn">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button type="button" class="nav-btn next-btn">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="edit-container">
                                <div class="edit-header">
                                    <div class="user-info">
                                        <img src="{{ Auth::user()->profile_image }}" 
                                             alt="{{ Auth::user()->username }}" 
                                             class="user-avatar">
                                        <span class="username">{{ Auth::user()->username }}</span>
                                    </div>
                                </div>

                                <div class="edit-content">
                                    <textarea name="caption" 
                                              class="caption-input" 
                                              placeholder="Write a caption..."
                                              maxlength="2200"></textarea>
                                    
                                    <div class="edit-options">
                                        <div class="option-item">
                                            <button type="button" class="option-btn" data-bs-toggle="collapse" data-bs-target="#locationCollapse">
                                                <i class="fas fa-map-marker-alt"></i>
                                                Add location
                                            </button>
                                            <div class="collapse" id="locationCollapse">
                                                <input type="text" 
                                                       name="location" 
                                                       class="form-control" 
                                                       placeholder="Add location">
                                            </div>
                                        </div>

                                        <div class="option-item">
                                            <button type="button" class="option-btn" data-bs-toggle="collapse" data-bs-target="#accessibilityCollapse">
                                                <i class="fas fa-universal-access"></i>
                                                Accessibility
                                            </button>
                                            <div class="collapse" id="accessibilityCollapse">
                                                <input type="text" 
                                                       name="alt_text" 
                                                       class="form-control" 
                                                       placeholder="Write alt text...">
                                            </div>
                                        </div>

                                        <div class="option-item">
                                            <button type="button" class="option-btn" data-bs-toggle="collapse" data-bs-target="#advancedCollapse">
                                                <i class="fas fa-cog"></i>
                                                Advanced settings
                                            </button>
                                            <div class="collapse" id="advancedCollapse">
                                                <div class="form-check">
                                                    <input type="checkbox" 
                                                           class="form-check-input" 
                                                           id="hideComments" 
                                                           name="hide_comments">
                                                    <label class="form-check-label" for="hideComments">
                                                        Turn off commenting
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <div class="upload-progress" style="display: none;">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="feed-upload-form" class="btn btn-primary">Share</button>
            </div>
        </div>
    </div>
</div>

<style>
/* Modal Styles */
.modal-content {
    border-radius: 12px;
    border: none;
    overflow: hidden;
}

.modal-header {
    padding: 12px 16px;
    border-bottom: 1px solid var(--ig-border);
    background: white;
}

.modal-title {
    font-size: 16px;
    font-weight: 600;
    flex: 1;
    text-align: center;
}

.close-modal-btn {
    background: none;
    border: none;
    font-size: 18px;
    padding: 4px;
    color: var(--ig-text);
}

/* Upload Container */
.upload-container {
    display: flex;
    height: 70vh;
    max-height: 800px;
}

/* Upload Stage */
.upload-stage {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fafafa;
}

.upload-area {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.upload-content {
    text-align: center;
}

.media-icon {
    color: var(--ig-text);
    margin-bottom: 16px;
}

.select-btn {
    background: var(--ig-primary);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    font-weight: 600;
    margin-top: 16px;
    cursor: pointer;
}

/* Preview Stage */
.preview-stage {
    width: 100%;
    display: flex;
}

.preview-container {
    width: 60%;
    background: #000;
    position: relative;
}

.preview-gallery {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-item {
    width: 100%;
    height: 100%;
    display: none;
}

.preview-item.active {
    display: block;
}

.preview-item img,
.preview-item video {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.prev-btn {
    left: 16px;
}

.next-btn {
    right: 16px;
}

/* Edit Container */
.edit-container {
    width: 40%;
    border-left: 1px solid var(--ig-border);
    display: flex;
    flex-direction: column;
    background: white;
}

.edit-header {
    padding: 16px;
    border-bottom: 1px solid var(--ig-border);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
}

.username {
    font-weight: 600;
}

.edit-content {
    flex: 1;
    overflow-y: auto;
}

.caption-input {
    width: 100%;
    height: 150px;
    padding: 16px;
    border: none;
    resize: none;
    font-size: 14px;
}

.caption-input:focus {
    outline: none;
}

.edit-options {
    padding: 16px;
    border-top: 1px solid var(--ig-border);
}

.option-item {
    margin-bottom: 16px;
}

.option-btn {
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    padding: 8px 0;
    color: var(--ig-text);
    font-size: 14px;
}

.option-btn i {
    margin-right: 8px;
}

/* Upload Progress */
.upload-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.9);
}

.progress {
    height: 4px;
    border-radius: 2px;
    background: #dbdbdb;
}

.progress-bar {
    background: var(--ig-primary);
    transition: width 0.2s ease;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .preview-stage {
        flex-direction: column;
    }

    .preview-container,
    .edit-container {
        width: 100%;
    }

    .preview-container {
        height: 50vh;
    }
}

/* Feed Upload Modal Specific Styles */
.feed-upload-modal .modal-content {
    border-radius: 12px;
    border: none;
    overflow: hidden;
}

.feed-upload-modal .modal-header {
    padding: 12px 16px;
    border-bottom: 1px solid var(--ig-border);
    background: white;
}

.feed-upload-modal .modal-title {
    font-size: 16px;
    font-weight: 600;
    flex: 1;
    text-align: center;
}

.feed-upload-modal .close-modal-btn {
    background: none;
    border: none;
    font-size: 18px;
    padding: 4px;
    color: var(--ig-text);
}

/* Upload Container */
.feed-upload-modal .upload-container {
    display: flex;
    height: 70vh;
    max-height: 800px;
}

/* Upload Stage */
.feed-upload-modal .upload-stage {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fafafa;
}

.feed-upload-modal .upload-area {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.feed-upload-modal .file-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.feed-upload-modal .upload-content {
    text-align: center;
}

.feed-upload-modal .media-icon {
    color: var(--ig-text);
    margin-bottom: 16px;
}

.feed-upload-modal .select-btn {
    background: var(--ig-primary);
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    font-weight: 600;
    margin-top: 16px;
    cursor: pointer;
}

/* Preview Stage */
.feed-upload-modal .preview-stage {
    width: 100%;
    display: flex;
}

.feed-upload-modal .preview-container {
    width: 60%;
    background: #000;
    position: relative;
}

.feed-upload-modal .preview-gallery {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feed-upload-modal .preview-item {
    width: 100%;
    height: 100%;
    display: none;
}

.feed-upload-modal .preview-item.active {
    display: block;
}

.feed-upload-modal .preview-item img,
.feed-upload-modal .preview-item video {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.feed-upload-modal .nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}

.feed-upload-modal .prev-btn {
    left: 16px;
}

.feed-upload-modal .next-btn {
    right: 16px;
}

/* Edit Container */
.feed-upload-modal .edit-container {
    width: 40%;
    border-left: 1px solid var(--ig-border);
    display: flex;
    flex-direction: column;
    background: white;
}

.feed-upload-modal .edit-header {
    padding: 16px;
    border-bottom: 1px solid var(--ig-border);
}

.feed-upload-modal .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.feed-upload-modal .user-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
}

.feed-upload-modal .username {
    font-weight: 600;
}

.feed-upload-modal .edit-content {
    flex: 1;
    overflow-y: auto;
}

.feed-upload-modal .caption-input {
    width: 100%;
    height: 150px;
    padding: 16px;
    border: none;
    resize: none;
    font-size: 14px;
}

.feed-upload-modal .caption-input:focus {
    outline: none;
}

.feed-upload-modal .edit-options {
    padding: 16px;
    border-top: 1px solid var(--ig-border);
}

.feed-upload-modal .option-item {
    margin-bottom: 16px;
}

.feed-upload-modal .option-btn {
    width: 100%;
    text-align: left;
    background: none;
    border: none;
    padding: 8px 0;
    color: var(--ig-text);
    font-size: 14px;
}

.feed-upload-modal .option-btn i {
    margin-right: 8px;
}

/* Upload Progress */
.feed-upload-modal .upload-progress {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 8px 16px;
    background: rgba(255, 255, 255, 0.9);
}

.feed-upload-modal .progress {
    height: 4px;
    border-radius: 2px;
    background: #dbdbdb;
}

.feed-upload-modal .progress-bar {
    background: var(--ig-primary);
    transition: width 0.2s ease;
}

/* Modal Footer Buttons */
.feed-upload-modal .modal-footer {
    padding: 12px 16px;
    border-top: 1px solid var(--ig-border);
}

.feed-upload-modal .btn {
    padding: 8px 16px;
    border-radius: 4px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
}

.feed-upload-modal .btn-secondary {
    background: none;
    border: none;
    color: var(--ig-text);
}

.feed-upload-modal .btn-primary {
    background: var(--ig-primary);
    border: none;
    color: white;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .feed-upload-modal .preview-stage {
        flex-direction: column;
    }

    .feed-upload-modal .preview-container,
    .feed-upload-modal .edit-container {
        width: 100%;
    }

    .feed-upload-modal .preview-container {
        height: 50vh;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('feed-upload-form');
    const uploadStage = document.getElementById('uploadStage');
    const previewStage = document.getElementById('previewStage');
    const previewGallery = document.getElementById('previewGallery');
    const fileInput = document.getElementById('feed-media');
    let selectedFiles = [];
    let currentPreviewIndex = 0;

    // File Input Change Handler
    fileInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        if (files.length > 0) {
            selectedFiles = files;
            showPreviewStage();
            renderPreviews();
        }
    });

    // Show Preview Stage
    function showPreviewStage() {
        uploadStage.style.display = 'none';
        previewStage.style.display = 'flex';
    }

    // Render Previews
    function renderPreviews() {
        previewGallery.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const preview = document.createElement('div');
            preview.className = `preview-item ${index === 0 ? 'active' : ''}`;
            
            if (file.type.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                preview.appendChild(img);
            } else if (file.type.startsWith('video/')) {
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.controls = true;
                preview.appendChild(video);
            }
            
            previewGallery.appendChild(preview);
        });
        
        updateNavigationButtons();
    }

    // Navigation Buttons
    document.querySelector('.prev-btn').addEventListener('click', () => {
        if (currentPreviewIndex > 0) {
            currentPreviewIndex--;
            updateActivePreview();
        }
    });

    document.querySelector('.next-btn').addEventListener('click', () => {
        if (currentPreviewIndex < selectedFiles.length - 1) {
            currentPreviewIndex++;
            updateActivePreview();
        }
    });

    function updateActivePreview() {
        document.querySelectorAll('.preview-item').forEach((item, index) => {
            item.classList.toggle('active', index === currentPreviewIndex);
        });
        updateNavigationButtons();
    }

    function updateNavigationButtons() {
        document.querySelector('.prev-btn').style.display = 
            currentPreviewIndex > 0 ? 'flex' : 'none';
        document.querySelector('.next-btn').style.display = 
            currentPreviewIndex < selectedFiles.length - 1 ? 'flex' : 'none';
    }

    // Form Submit Handler
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        selectedFiles.forEach(file => {
            formData.append('media[]', file);
        });

        try {
            const response = await fetch('{{ route('feeds.store') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (response.ok) {
                // Handle successful upload
                location.reload();
            } else {
                throw new Error('Upload failed');
            }
        } catch (error) {
            console.error('Error:', error);
            // Handle error
        }
    });
});
</script>