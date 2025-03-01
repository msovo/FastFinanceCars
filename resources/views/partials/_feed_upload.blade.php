<style>
    /* Variables */
    .modal-backdrop.show {
    opacity: .5;
    z-index: 1;
}

    
:root {
    --primary-color: #0095f6;
    --primary-hover: #1877f2;
    --secondary-color: #8e8e8e;
    --border-color: #dbdbdb;
    --background-light: #fafafa;
    --text-primary: #262626;
    --text-secondary: #8e8e8e;
    --danger-color: #ed4956;
    --success-color: #2ecc71;
    --modal-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    --transition: all 0.3s ease;
}

/* Modal Base Styles */
.feed-upload-modal {
    backdrop-filter: blur(5px);
}

.feed-upload-modal .modal-dialog {
    max-width: 1100px;
    margin: 1.75rem auto;
}

.feed-upload-modal .modal-content {
    border: none;
    border-radius: 16px;
    box-shadow: var(--modal-shadow);
    overflow: hidden;
    background: white;
}

/* Steps Indicator */
.steps-indicator {
    display: flex;
    justify-content: center;
    width: 100%;
    padding: 0 60px;
    position: relative;
}

.steps-indicator .step {
    padding: 12px 24px;
    font-weight: 600;
    color: var(--text-secondary);
    position: relative;
    cursor: pointer;
    transition: var(--transition);
}

.steps-indicator .step::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 100%;
    height: 3px;
    background: transparent;
    transition: var(--transition);
}

.steps-indicator .step.active {
    color: var(--primary-color);
}

.steps-indicator .step.active::after {
    background: var(--primary-color);
}

/* Upload Stage */
.upload-container {
    min-height: 500px;
    display: flex;
    flex-direction: column;
}

.upload-stage {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.upload-area {
    width: 100%;
    height: 100%;
    min-height: 400px;
    border: 2px dashed var(--border-color);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    background: var(--background-light);
}

.upload-area.dragover {
    border-color: var(--primary-color);
    background: rgba(0, 149, 246, 0.05);
}

.upload-content {
    text-align: center;
    padding: 20px;
}

.upload-icon {
    font-size: 48px;
    color: var(--primary-color);
    margin-bottom: 16px;
}

.upload-content h3 {
    font-size: 22px;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 8px;
}

.upload-info {
    color: var(--text-secondary);
    margin-bottom: 24px;
}

.upload-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
}

/* Buttons */
.select-btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
}

.select-btn.primary {
    background: var(--primary-color);
    color: white;
}

.select-btn.primary:hover {
    background: var(--primary-hover);
}

.select-btn.secondary {
    background: white;
    color: var(--text-primary);
    border: 1px solid var(--border-color);
}

.select-btn.secondary:hover {
    background: var(--background-light);
}

/* Preview Stage */
.preview-stage {
    padding: 20px;
}

.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 12px;
    margin-bottom: 16px;
}

.preview-item {
    position: relative;
    aspect-ratio: 1;
    border-radius: 8px;
    overflow: hidden;
}

.preview-item img,
.preview-item video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.preview-item .remove-btn {
    position: absolute;
    top: 8px;
    right: 8px;
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: var(--transition);
}

.preview-item .remove-btn:hover {
    background: rgba(0, 0, 0, 0.8);
}

/* Details Form */
.details-container {
    padding: 20px;
}

.listing-type-selector {
    display: flex;
    gap: 12px;
    margin-bottom: 24px;
    overflow-x: auto;
    padding-bottom: 8px;
}

.type-btn {
    padding: 12px 24px;
    border-radius: 8px;
    border: 1px solid var(--border-color);
    background: white;
    color: var(--text-primary);
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 120px;
}

.type-btn.active {
    background: var(--primary-color);
    color: white;
    border-color: var(--primary-color);
}

/* Form Controls */
.form-group {
    margin-bottom: 20px;
}

.caption-input {
    width: 100%;
    min-height: 150px;
    padding: 16px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    resize: none;
    font-size: 15px;
    transition: var(--transition);
}

.caption-input:focus {
    outline: none;
    border-color: var(--primary-color);
}

.price-input {
    position: relative;
    display: flex;
    align-items: center;
}

.currency {
    position: absolute;
    left: 16px;
    color: var(--text-secondary);
}

.price-input input {
    padding-left: 32px;
}

/* Settings Section */
.settings-container {
    padding: 20px;
}

.settings-section {
    margin-bottom: 32px;
}

.settings-section h4 {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 16px;
    color: var(--text-primary);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 12px;
}

.feature-item {
    display: flex;
    align-items: center;
    padding: 12px;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    cursor: pointer;
    transition: var(--transition);
}

.feature-item:hover {
    border-color: var(--primary-color);
}

.feature-item input[type="checkbox"] {
    display: none;
}

.feature-item input[type="checkbox"]:checked + .feature-content {
    color: var(--primary-color);
}

.feature-content {
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Switches */
.switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 24px;
}

.switch input {
    display: none;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: var(--border-color);
    transition: var(--transition);
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: var(--transition);
    border-radius: 50%;
}

input:checked + .slider {
    background-color: var(--primary-color);
}

input:checked + .slider:before {
    transform: translateX(26px);
}

/* Footer */
.modal-footer {
    border-top: 1px solid var(--border-color);
    padding: 16px;
}

.footer-content {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.upload-progress {
    flex: 1;
    margin: 0 16px;
}

.progress {
    height: 4px;
    background: var(--border-color);
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar {
    background: var(--primary-color);
    transition: width 0.3s ease;
}

/* Responsive Design */
@media (max-width: 768px) {
    .feed-upload-modal .modal-dialog {
        margin: 0;
        max-width: 100%;
        height: 100%;
    }

    .feed-upload-modal .modal-content {
        height: 100%;
        border-radius: 0;
    }

    .listing-type-selector {
        flex-wrap: nowrap;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        padding-bottom: 16px;
    }

    .type-btn {
        min-width: 140px;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.feed-upload-modal .modal-content {
    animation: fadeIn 0.3s ease;
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
}

.visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    border: 0;
}

.modal-footer{
    top: 0;
    position: absolute;
}

/* Mobile Responsive Styles */
@media screen and (max-width: 768px) {
    /* Modal Structure */
    .feed-upload-modal .modal-dialog {
        margin: 0;
        max-width: 100%;
        height: 100vh;
    }

    .feed-upload-modal .modal-content {
        height: 100vh;
        border-radius: 0;
        display: flex;
        flex-direction: column;
    }

    .modal-body {
        flex: 1;
        overflow-y: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0;
    }

    /* Steps Indicator */
    .steps-indicator {
        padding: 0 10px;
    }

    .steps-indicator .step {
        padding: 8px 12px;
        font-size: 14px;
    }

    /* Upload Area */
    .upload-container {
        min-height: auto;
        padding: 10px;
    }

    .upload-area {
        min-height: 200px;
        margin: 10px;
    }

    .upload-content h3 {
        font-size: 18px;
    }

    .upload-info {
        font-size: 14px;
    }

    /* Upload Buttons */
    .upload-actions {
        flex-direction: column;
        gap: 10px;
    }

    .select-btn {
        width: 100%;
        justify-content: center;
        padding: 12px;
    }

    /* Preview Grid */
    .preview-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        padding: 10px;
    }

    .preview-item {
        aspect-ratio: 1;
    }

    /* Details Form */
    .details-container {
        padding: 15px;
    }

    .listing-type-selector {
        overflow-x: auto;
        padding-bottom: 10px;
        margin: -5px -15px 15px;
        padding: 0 15px 10px;
    }

    .type-btn {
        min-width: 120px;
        padding: 10px 15px;
        font-size: 14px;
        white-space: nowrap;
    }

    /* Form Elements */
    .caption-input {
        min-height: 120px;
    }

    .form-row {
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 15px;
    }

    /* Settings */
    .settings-container {
        padding: 15px;
    }

    .features-grid {
        grid-template-columns: 1fr;
    }

    .feature-item {
        padding: 10px;
    }

    /* Footer */
    .modal-footer {
        padding: 10px;
        position: sticky;
        bottom: 0;
        background: white;
        box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    }

    .footer-content {
        gap: 10px;
    }

    .footer-content button {
        padding: 8px 16px;
        font-size: 14px;
    }

    /* Enhanced Touch Areas */
    .remove-btn {
        width: 30px;
        height: 30px;
    }

    .switch {
        transform: scale(1.1);
    }

    /* Better Scrolling */
    .modal-body::-webkit-scrollbar {
        width: 4px;
    }

    .modal-body::-webkit-scrollbar-thumb {
        background-color: rgba(0,0,0,0.2);
        border-radius: 2px;
    }

    /* Camera Access */
    .select-btn.secondary {
        background: #f8f9fa;
    }

    /* Loading States */
    .upload-progress {
        margin: 0 8px;
    }

    /* Better Touch Feedback */
    .type-btn:active,
    .select-btn:active,
    .feature-item:active {
        transform: scale(0.98);
    }

    /* Safe Area Support */
    .modal-content {
        padding-bottom: env(safe-area-inset-bottom);
    }

    /* Improved File Input */
    input[type="file"] {
        font-size: 16px; /* Prevents zoom on iOS */
    }
}

/* Additional improvements for very small screens */
@media screen and (max-width: 320px) {
    .preview-grid {
        grid-template-columns: 1fr;
    }

    .steps-indicator .step {
        font-size: 12px;
        padding: 6px 8px;
    }
}

/* Landscape Mode */
@media screen and (max-width: 768px) and (orientation: landscape) {
    .preview-grid { 
        grid-template-columns: repeat(4, 1fr);
    }
  
    .upload-actions {
        flex-direction: row;
    }

    .select-btn {
        width: auto;
    }
} 
</style>

<div class="modal fade feed-upload-modal" id="feedUploadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <!-- Header with Steps Indicator -->
            <div class="modal-header">
                <div class="steps-indicator">
                    <div class="step active" data-step="1">Media</div>
                    <div class="step" data-step="2">Details</div>
                    <div class="step" data-step="3">Settings</div>
                </div>
                <button type="button" class="close-modal-btn" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <form id="feed-upload-form" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Step 1: Media Upload -->
                    <div class="step-content active" data-step="1">
                        <div class="upload-container">
                            <div class="upload-stage" id="uploadStage">
                                <div class="upload-area" id="uploadArea">
                                    <input type="file" class="file-input" id="feed-media" name="media[]" accept="image/*,video/*" multiple required>
                                    <div class="upload-content">
                                        <div class="upload-icon">
                                            <i class="far fa-images"></i>
                                        </div>
                                        <h3>Drop your photos and videos here</h3>
                                        <p class="upload-info">Up to 10 photos or videos</p>
                                        <div class="upload-actions">
                                            <button type="button" class="select-btn primary">
                                                <i class="fas fa-folder-open"></i> Browse Files
                                            </button>
                                            <button type="button" class="select-btn secondary">
                                                <i class="fas fa-camera"></i> Use Camera
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="preview-stage" id="previewStage" style="display: none;">
                                <div class="preview-grid" id="previewGrid"></div>
                                <div class="preview-actions">
                                    <button type="button" class="add-media-btn">
                                        <i class="fas fa-plus"></i> Add More
                                    </button>
                                    <button type="button" class="arrange-media-btn">
                                        <i class="fas fa-th-large"></i> Arrange
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Details -->
                    <div class="step-content" data-step="2">
                        <div class="details-container">
                            <!-- Listing Type Selection -->
                            <div class="listing-type-selector">
                                <button type="button" class="type-btn active" data-type="regular">
                                    <i class="fas fa-car"></i>
                                    <span>Regular</span>
                                </button>
                                <button type="button" class="type-btn" data-type="sale">
                                    <i class="fas fa-tag"></i>
                                    <span>Sale</span>
                                </button>
                                <button type="button" class="type-btn" data-type="offer">
                                    <i class="fas fa-percentage"></i>
                                    <span>Special Offer</span>
                                </button>
                                <button type="button" class="type-btn" data-type="clearance">
                                    <i class="fas fa-fire"></i>
                                    <span>Clearance</span>
                                </button>
                            </div>

                            <!-- Main Details -->
                            <div class="details-form">
                                <div class="form-group">
                                    <textarea name="caption" 
                                              class="caption-input" 
                                              placeholder="Describe your listing..."
                                              maxlength="2200"></textarea>
                                    <div class="character-count">0/2200</div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <div class="price-input">
                                            <span class="currency">$</span>
                                            <input type="number" 
                                                   name="price" 
                                                   class="form-control" 
                                                   placeholder="Price">
                                            <div class="price-options">
                                                <label class="checkbox-label">
                                                    <input type="checkbox" name="negotiable">
                                                    Negotiable
                                                </label>
                                                <label class="checkbox-label">
                                                    <input type="checkbox" name="hide_price">
                                                    Hide Price
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <div class="location-input">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <input type="text" 
                                                   name="location" 
                                                   class="form-control" 
                                                   placeholder="Add location"
                                                   id="locationInput">
                                            <div class="location-suggestions" id="locationSuggestions"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 3: Advanced Settings -->
                    <div class="step-content" data-step="3">
                        <div class="settings-container">
                            <!-- Accessibility -->
                            <div class="settings-section">
                                <h4>Accessibility</h4>
                                <div class="form-group">
                                    <label>Alt Text</label>
                                    <input type="text" 
                                           name="alt_text" 
                                           class="form-control" 
                                           placeholder="Describe your images for visually impaired users">
                                </div>
                            </div>

                            <!-- Advanced Features -->
                            <div class="settings-section">
                                <h4>Listing Features</h4>
                                <div class="features-grid">
                                    <label class="feature-item">
                                        <input type="checkbox" name="features[]" value="featured">
                                        <span class="feature-content">
                                            <i class="fas fa-star"></i>
                                            <span>Featured Listing</span>
                                        </span>
                                    </label>
                                    <label class="feature-item">
                                        <input type="checkbox" name="features[]" value="urgent">
                                        <span class="feature-content">
                                            <i class="fas fa-bolt"></i>
                                            <span>Urgent Sale</span>
                                        </span>
                                    </label>
                                    <label class="feature-item">
                                        <input type="checkbox" name="features[]" value="certified">
                                        <span class="feature-content">
                                            <i class="fas fa-certificate"></i>
                                            <span>Certified</span>
                                        </span>
                                    </label>
                                </div>
                            </div>

                            <!-- Interaction Settings -->
                            <div class="settings-section">
                                <h4>Interaction Settings</h4>
                                <div class="settings-options">
                                    <label class="switch-label">
                                        <span>Allow Comments</span>
                                        <div class="switch">
                                            <input type="checkbox" name="allow_comments" checked>
                                            <span class="slider"></span>
                                        </div>
                                    </label>
                                    <label class="switch-label">
                                        <span>Show View Count</span>
                                        <div class="switch">
                                            <input type="checkbox" name="show_views" checked>
                                            <span class="slider"></span>
                                        </div>
                                    </label>
                                    <label class="switch-label">
                                        <span>Allow Sharing</span>
                                        <div class="switch">
                                            <input type="checkbox" name="allow_sharing" checked>
                                            <span class="slider"></span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <div class="footer-content">
                    <button type="button" class="btn btn-secondary prev-step" style="display: none;">
                        <i class="fas fa-arrow-left"></i> Back
                    </button>
                    <div class="upload-progress" style="display: none;">
                        <div class="progress">
                            <div class="progress-bar" role="progressbar"></div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary next-step">
                        Next <i class="fas fa-arrow-right"></i>
                    </button>
                    <button type="submit" form="feed-upload-form" class="btn btn-primary submit-btn" style="display: none;">
                        Share Post
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize variables
    const modal = document.querySelector('.feed-upload-modal');
    const form = document.getElementById('feed-upload-form');
    const uploadArea = document.getElementById('uploadArea');
    const fileInput = document.getElementById('feed-media');
    const previewStage = document.getElementById('previewStage');
    const previewGrid = document.getElementById('previewGrid');
    const uploadStage = document.getElementById('uploadStage');
    let selectedFiles = [];
    let currentStep = 1;

    // Step Navigation
    const steps = document.querySelectorAll('.step');
    const stepContents = document.querySelectorAll('.step-content');
    const nextBtn = document.querySelector('.next-step');
    const prevBtn = document.querySelector('.prev-step');
    const submitBtn = document.querySelector('.submit-btn');

    function updateSteps() {
        steps.forEach((step, index) => {
            step.classList.toggle('active', index + 1 <= currentStep);
        });

        stepContents.forEach((content, index) => {
            content.style.display = index + 1 === currentStep ? 'block' : 'none';
        });

        // Update buttons
        prevBtn.style.display = currentStep > 1 ? 'block' : 'none';
        nextBtn.style.display = currentStep < 3 ? 'block' : 'none';
        submitBtn.style.display = currentStep === 3 ? 'block' : 'none';
    }

    nextBtn.addEventListener('click', () => {
        if (currentStep < 3) {
            currentStep++;
            updateSteps();
        }
    });

    prevBtn.addEventListener('click', () => {
        if (currentStep > 1) {
            currentStep--;
            updateSteps();
        }
    });

    // File Upload Handling
    function handleFiles(files) {
        const validFiles = Array.from(files).filter(file => {
            const isValid = file.type.startsWith('image/') || file.type.startsWith('video/');
            const isWithinLimit = selectedFiles.length + 1 <= 10;
            return isValid && isWithinLimit;
        });

        if (validFiles.length > 0) {
            selectedFiles = [...selectedFiles, ...validFiles];
            renderPreviews();
            showPreviewStage();
        }
    }

    // Drag and Drop
    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    // File Input Change
    fileInput.addEventListener('change', (e) => {
        handleFiles(e.target.files);
    });

    // Preview Rendering
    function renderPreviews() {
        previewGrid.innerHTML = '';
        selectedFiles.forEach((file, index) => {
            const preview = createPreviewItem(file, index);
            previewGrid.appendChild(preview);
        });
    }

    function createPreviewItem(file, index) {
        const div = document.createElement('div');
        div.className = 'preview-item';
        
        if (file.type.startsWith('image/')) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            div.appendChild(img);
        } else if (file.type.startsWith('video/')) {
            const video = document.createElement('video');
            video.src = URL.createObjectURL(file);
            video.controls = true;
            div.appendChild(video);
        }

        const removeBtn = document.createElement('button');
        removeBtn.className = 'remove-btn';
        removeBtn.innerHTML = '<i class="fas fa-times"></i>';
        removeBtn.onclick = () => removeFile(index);
        
        div.appendChild(removeBtn);
        return div;
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        if (selectedFiles.length === 0) {
            showUploadStage();
        } else {
            renderPreviews();
        }
    }

    function showPreviewStage() {
        uploadStage.style.display = 'none';
        previewStage.style.display = 'block';
    }

    function showUploadStage() {
        uploadStage.style.display = 'flex';
        previewStage.style.display = 'none';
    }

    // Post Type Selection
    const typeButtons = document.querySelectorAll('.type-btn');
    typeButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            typeButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.getElementById('postType').value = btn.dataset.type;
        });
    });

    // Character Counter for Caption
    const captionInput = document.querySelector('.caption-input');
    const characterCount = document.querySelector('.character-count');

    captionInput?.addEventListener('input', () => {
        const count = captionInput.value.length;
        characterCount.textContent = `${count}/2200`;
        characterCount.style.color = count > 2000 ? 'var(--danger-color)' : 'var(--text-secondary)';
    });

    // Location Autocomplete
    const locationInput = document.getElementById('locationInput');
    const locationSuggestions = document.getElementById('locationSuggestions');
    let debounceTimer;

    locationInput?.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(() => {
            // Implement your location search API here
            // For example:
            /*
            fetch(`/api/locations/search?q=${locationInput.value}`)
                .then(res => res.json())
                .then(suggestions => {
                    renderLocationSuggestions(suggestions);
                });
            */
        }, 300);
    });

    // Form Submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (selectedFiles.length === 0) {
            alert('Please select at least one media file');
            return;
        }

        const formData = new FormData(form);
        selectedFiles.forEach(file => {
            formData.append('media[]', file);
        });

        const submitButton = form.querySelector('button[type="submit"]');
        const progressBar = document.querySelector('.progress-bar');
        const progressContainer = document.querySelector('.upload-progress');

        try {
            submitButton.disabled = true;
            progressContainer.style.display = 'block';

            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                onUploadProgress: (progressEvent) => {
                    const progress = (progressEvent.loaded / progressEvent.total) * 100;
                    progressBar.style.width = `${progress}%`;
                }
            });

            if (response.ok) {
                // Show success message
                showNotification('Post created successfully!', 'success');
                modal.hide();
                // Optionally reload the feed
                window.location.reload();
            } else {
                throw new Error('Upload failed');
            }
        } catch (error) {
            showNotification('Failed to create post. Please try again.', 'error');
        } finally {
            submitButton.disabled = false;
            progressContainer.style.display = 'none';
        }
    });

    // Notification System
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }, 100);
    }

    // Image Compression (optional but recommended)
    async function compressImage(file) {
        return new Promise((resolve) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    
                    let width = img.width;
                    let height = img.height;
                    
                    // Max dimensions
                    const MAX_WIDTH = 1920;
                    const MAX_HEIGHT = 1080;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob((blob) => {
                        resolve(new File([blob], file.name, {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        }));
                    }, 'image/jpeg', 0.8);
                };
                img.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    }

    // Sort/Reorder Functionality
    let dragSrcEl = null;
    
    function handleDragStart(e) {
        dragSrcEl = this;
        e.dataTransfer.effectAllowed = 'move';
        this.classList.add('dragging');
    }

    function handleDragOver(e) {
        if (e.preventDefault) {
            e.preventDefault();
        }
        e.dataTransfer.dropEffect = 'move';
        return false;
    }

    function handleDragEnter() {
        this.classList.add('over');
    }

    function handleDragLeave() {
        this.classList.remove('over');
    }

    function handleDrop(e) {
        if (e.stopPropagation) {
            e.stopPropagation();
        }

        if (dragSrcEl !== this) {
            const allItems = [...previewGrid.querySelectorAll('.preview-item')];
            const draggedIndex = allItems.indexOf(dragSrcEl);
            const droppedIndex = allItems.indexOf(this);

            // Reorder files array
            const temp = selectedFiles[draggedIndex];
            selectedFiles[draggedIndex] = selectedFiles[droppedIndex];
            selectedFiles[droppedIndex] = temp;

            renderPreviews();
        }

        return false;
    }

    function handleDragEnd() {
        this.classList.remove('dragging');
        previewGrid.querySelectorAll('.preview-item').forEach(item => {
            item.classList.remove('over');
        });
    }
});
</script>