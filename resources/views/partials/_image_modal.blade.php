<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="close-btn" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
                
                <div class="image-container">
                    <img src="" id="modalImage" class="modal-image" alt="Full size image">
                </div>
                
                <div class="image-sidebar">
                    <div class="post-header">
                        <div class="user-info">
                            <img src="" class="user-avatar" alt="">
                            <div class="user-details">
                                <span class="username"></span>
                                <span class="location"></span>
                            </div>
                        </div>
                        <button class="more-btn">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </div>
                    
                    <div class="comments-section">
                        <!-- Comments loaded dynamically -->
                    </div>
                    
                    <div class="post-actions">
                        <div class="action-buttons">
                            <button class="action-btn like-btn">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="action-btn comment-btn">
                                <i class="far fa-comment"></i>
                            </button>
                            <button class="action-btn share-btn">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </div>
                        <button class="action-btn save-btn">
                            <i class="far fa-bookmark"></i>
                        </button>
                    </div>
                    
                    <div class="likes-count">
                        <strong>0 likes</strong>
                    </div>
                    
                    <div class="post-time">
                        <time></time>
                    </div>
                    
                    @auth
                        <form class="comment-form">
                            <textarea class="comment-input" 
                                      placeholder="Add a comment..."
                                      rows="1"
                                      data-autosize="true"></textarea>
                            <button type="submit" class="post-btn" disabled>
                                Post
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.modal-dialog {
    margin: 0;
    max-width: 935px;
    width: 100%;
    height: 100%;
    display: flex;
}

.modal-content {
    height: 100%;
    border: none;
    border-radius: 0;
}

.modal-body {
    display: flex;
    height: 100%;
}

.image-container {
    flex: 1;
    background: #000;
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-image {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.image-sidebar {
    width: 340px;
    display: flex;
    flex-direction: column;
    border-left: 1px solid var(--ig-border);
}

.close-btn {
    position: absolute;
    top: 16px;
    right: 16px;
    background: none;
    border: none;
    color: white;
    font-size: 24px;
    z-index: 1;
}

/* Add more styles as needed */
</style>