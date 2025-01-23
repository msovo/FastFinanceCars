<div class="modal fade" id="storyUploadModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Story</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="{{ route('stories.store') }}" 
                      method="POST" 
                      enctype="multipart/form-data"
                      id="storyUploadForm">
                    @csrf
                    
                    <div class="upload-area" id="uploadArea">
                        <input type="file" 
                               id="storyMedia" 
                               name="media" 
                               accept="image/*,video/*" 
                               class="media-input"
                               required>
                        <div class="upload-placeholder">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Drag and drop or click to upload</p>
                            <span class="file-limits">Photos or videos up to 100MB</span>
                        </div>
                    </div>
                    
                    <div id="mediaPreview" class="preview-area" style="display: none;">
                        <div class="preview-container"></div>
                        <button type="button" class="remove-btn">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    
                    <div class="story-options">
                        <textarea name="caption" 
                                  class="caption-input" 
                                  placeholder="Write a caption..."
                                  rows="3"></textarea>
                                  
                        <div class="additional-options">
                            <button type="button" class="option-btn">
                                <i class="fas fa-palette"></i>
                            </button>
                            <button type="button" class="option-btn">
                                <i class="fas fa-music"></i>
                            </button>
                            <button type="button" class="option-btn">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" form="storyUploadForm" class="btn btn-primary">
                    Share Story
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.upload-area {
    border: 2px dashed var(--ig-border);
    border-radius: 8px;
    padding: 32px;
    text-align: center;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: var(--ig-primary);
}

.media-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
}

.upload-placeholder {
    color: var(--ig-text-light);
}

.upload-placeholder i {
    font-size: 48px;
    margin-bottom: 16px;
}

.file-limits {
    font-size: 12px;
    display: block;
    margin-top: 8px;
}

.preview-area {
    position: relative;
    margin-top: 16px;
}

.preview-container {
    aspect-ratio: 9/16;
    background: #000;
    border-radius: 8px;
    overflow: hidden;
}

.preview-container img,
.preview-container video {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

.remove-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(0, 0, 0, 0.5);
    border: none;
    color: white;
    padding: 8px;
    border-radius: 50%;
}

.story-options {
    margin-top: 16px;
}

.caption-input {
    width: 100%;
    border: 1px solid var(--ig-border);
    border-radius: 4px;
    padding: 8px;
    margin-bottom: 16px;
    resize: none;
}

.additional-options {
    display: flex;
    gap: 16px;
}

.option-btn {
    background: none;
    border: none;
    color: var(--ig-text);
    font-size: 20px;
}

/* Add more styles as needed */
</style>