<div class="modal fade" id="commentsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Comments</h5>
                <button type="button" class="close-btn" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="comments-wrapper">
                    <div class="post-preview">
                        <img src="" alt="Post" class="post-image">
                        <div class="post-details">
                            <div class="user-info">
                                <img src="" alt="" class="user-avatar">
                                <span class="username"></span>
                            </div>
                            <p class="caption"></p>
                        </div>
                    </div>

                    <div class="comments-list" id="modalCommentsList">
                        <!-- Comments loaded dynamically -->
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                @auth
                    <form class="comment-form w-100" id="modalCommentForm">
                        <div class="input-group">
                            <textarea class="form-control comment-input" 
                                      placeholder="Add a comment..."
                                      rows="1"
                                      data-autosize="true"></textarea>
                            <button type="submit" class="btn btn-primary post-btn" disabled>
                                Post
                            </button>
                        </div>
                    </form>
                @else
                    <p class="text-center w-100">
                        Please <a href="{{ route('login') }}">login</a> to comment
                    </p>
                @endauth
            </div>
        </div>
    </div>
</div>

<style>
.modal-content {
    border-radius: 12px;
    border: none;
    overflow: hidden;
}

.modal-header {
    padding: 12px 16px;
    border-bottom: 1px solid var(--ig-border);
}

.modal-title {
    font-size: 16px;
    font-weight: 600;
}

.close-btn {
    background: none;
    border: none;
    font-size: 20px;
    color: var(--ig-text);
    padding: 4px;
}

.comments-wrapper {
    height: 60vh;
    display: flex;
    flex-direction: column;
}

.post-preview {
    padding: 16px;
    border-bottom: 1px solid var(--ig-border);
    display: flex;
    gap: 12px;
}

.post-image {
    width: 44px;
    height: 44px;
    border-radius: 4px;
    object-fit: cover;
}

.comments-list {
    flex: 1;
    overflow-y: auto;
    padding: 16px;
}

.comment-item {
    display: flex;
    gap: 12px;
    margin-bottom: 16px;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

.comment-content {
    flex: 1;
}

.comment-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 4px;
}

.username {
    font-weight: 600;
    color: var(--ig-text);
}

.comment-time {
    font-size: 12px;
    color: var(--ig-text-light);
}

.comment-text {
    margin: 0;
    color: var(--ig-text);
}

.modal-footer {
    padding: 12px 16px;
    border-top: 1px solid var(--ig-border);
}

.comment-form {
    margin: 0;
}

.comment-input {
    border: none;
    resize: none;
    padding: 8px 0;
    max-height: 80px;
}

.comment-input:focus {
    outline: none;
    box-shadow: none;
}

.post-btn {
    background: var(--ig-primary);
    border: none;
    font-weight: 600;
    padding: 8px 16px;
}

.post-btn:disabled {
    background: var(--ig-primary);
    opacity: 0.3;
}
</style>