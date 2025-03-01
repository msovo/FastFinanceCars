
<div class="feeds-container">
    @forelse($feeds as $feed)
        <article class="feed" data-feed-id="{{ $feed->id }}">
            <div class="feed-header">
                <div class="feed-user">
                    <img src="{{ Storage::url($feed->user->profile_image) }}" 
                         alt="{{ $feed->user->username }}"
                         class="feed-user-avatar">
                    <div class="user-info">
                        <a href="#" class="feed-username">{{ $feed->user->username }}</a>
                        <span class="feed-location">{{ $feed->location ?? '' }}</span>
                    </div>
                </div>
                <button class="feed-more-btn">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
            </div>

            <div class="media-gallery {{ $feed->images->count() > 1 ? 'has-multiple' : '' }}">
    @foreach($feed->images as $index => $image)
        <div class="media-item {{ $index === 0 ? 'active' : '' }}">
            <img src="{{ asset('storage/' . $image->media_path) }}"
                 alt="Post image"
                 loading="lazy">
        </div>
    @endforeach
    
    @if($feed->images->count() > 1)
        <div class="media-nav">
            <button class="prev-btn">‹</button>
            <button class="next-btn">›</button>
        </div>
        <div class="media-dots">
            @foreach($feed->images as $index => $image)
                <span class="dot {{ $index === 0 ? 'active' : '' }}"></span>
            @endforeach
        </div>
    @endif
</div>

            <div class="feed-actions row">
                <div class="primary-actions">
                <button class="action-btn like-btn " id="handlefeedlike-{{ $feed->id }}">
                    <i class="far fa-heart {{ $feed->is_liked_by_user ? 'liked-btn' : '' }}"></i>
                </button>
                    <button class="action-btn comment-btn" id="toggleComments-{{ $feed->id }}">
                        <i class="far fa-comment"> {{ $feed->comments_count ?? 0 }} </i>
                   
                    </button>
                    <button class="action-btn share-btn">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </div>
               <!--  <button class="action-btn save-btn col-2" >
                    <i class="far fa-bookmark"></i>
                </button> -->
            </div>

            <div class="feed-engagement">
                <div class="likes-count-{{ $feed->id }}" id="likes-count-{{ $feed->id }}">
                    <strong>{{ $feed->total_likes ?? 0 }}</strong> likes
                </div>
                
                <div class="feed-caption">
                    <strong>{{ $feed->user->username }}</strong> 
                    <span>{{ $feed->caption }}</span>
                </div>

                <div class="feed-comments">
    <div id="comments-{{ $feed->id }}" class="comments-container" style="display: none;">
        <!-- Mobile comment modal -->
        <div class="mobile-comment-modal">
            <div class="modal-header">
                <button class="close-modal">&times;</button>
                <h4>Comments</h4>
            </div>
            
            <div class="comments-wrapper">
                <div class="comments-list" id="commentsList-{{ $feed->id }}">
                    <!-- Comments loaded dynamically -->
                </div>
                
                <div class="loading-spinner" style="display: none;">
                    <div class="spinner"></div>
                </div>
            </div>
            
            @auth
            <form class="comment-form" id="commentForm-{{ $feed->id }}" action="{{ route('Ccomments.store', ['feed' => $feed->id]) }}" data-feed-id="{{ $feed->id }}">
                <input type="text" 
                    class="comment-input" 
                    placeholder="Add a comment..."
                    name="comment">
                <button type="submit" class="comment-submit">Post</button>
            </form>
        @endauth
        </div>
    </div>
</div>




                <div class="feed-timestamp">
                    {{ $feed->created_at->diffForHumans() }}
                </div>
            </div>
        </article>
    @empty
        <div class="no-feeds">
            <p>No posts yet</p>
        </div>
    @endforelse
</div>

<style>
/* Enhanced Feed Styles */
.feeds-container {
    max-width: 470px; /* Instagram-like width */
    margin: 0 auto;
}

.feed {
    background: white;
    border: 1px solid #dbdbdb;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* Header Styles */
.feed-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
}

.feed-user {
    display: flex;
    align-items: center;
    gap: 10px;
}

.feed-user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    object-fit: cover;
    border: none;
}

.user-info {
    display: flex;
    flex-direction: column;
}

.feed-username {
    font-weight: 600;
    color: #262626;
    text-decoration: none;
    font-size: 14px;
    line-height: 18px;
}

.feed-location {
    font-size: 12px;
    color: #262626;
    line-height: 15px;
}

.feed-more-btn {
    padding: 8px;
    background: none;
    border: none;
    cursor: pointer;
    color: #262626;
}

/* Media Gallery Styles */
.media-gallery {
    position: relative;
    width: 100%;
    aspect-ratio: 1/1;
    background: #000;
    overflow: hidden;
}

.media-item {
    position: absolute;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.media-item.active {
    opacity: 1;
    z-index: 1;
}

.media-item img {
    width: 100%;
    height: 100%;
    object-fit: contain;
}

/* Multiple Images Indicator */
.media-counter {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(0, 0, 0, 0.75);
    color: white;
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    z-index: 2;
}

/* Navigation Buttons */
.media-nav {
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    transform: translateY(-50%);
    display: flex;
    justify-content: space-between;
    padding: 0 8px;
    z-index: 2;
}

.media-nav button {
    width: 30px;
    height: 30px;
    background: rgba(255, 255, 255, 0.9);
    border: none;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #262626;
    transition: opacity 0.2s;
}

.media-nav button:hover {
    opacity: 0.8;
}

/* Dots Navigation */
.media-dots {
    position: absolute;
    bottom: 12px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 4px;
    z-index: 2;
}

.dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    transition: all 0.3s ease;
}

.dot.active {
    background: #0095f6;
    transform: scale(1.2);
}

/* Actions Section */
.feed-actions {
    padding: 6px 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.primary-actions {
    display: flex;
    gap: 16px;
}



.action-btn:hover {
    transform: scale(1.1);
}

.like-btn.active i {
    color: #ed4956;
    font-weight: 600;
}
.liked-btn{
    color: #ed4956;
    font-weight: 600;
}
/* Engagement Section */
.feed-engagement {
    padding: 0 16px 16px;
}

.likes-count {
    font-size: 14px;
    margin-bottom: 8px;
}

.feed-caption {
    font-size: 14px;
    line-height: 18px;
    margin-bottom: 8px;
}

.feed-caption strong {
    font-weight: 600;
    margin-right: 4px;
}

/* Comments Section */
.container {
    border-top: 1px solid #efefef;
    margin-top: 8px;
    padding-top: 8px;
}

/* Add these styles to your existing CSS */

/* Core Variables */
:root {
    --ig-primary: #0095f6;
    --ig-text: #262626;
    --ig-secondary-text: #8e8e8e;
    --ig-border: #dbdbdb;
    --ig-background: #ffffff;
    --ig-error: #ed4956;
    --modal-height: 90vh;
    --header-height: 44px;
    --comment-form-height: 60px;
}

/* Feed Container */
.feeds-container {
    max-width: 470px;
    margin: 0 auto;
    padding: 0 16px;
}

/* Comments Section */
.feed-comments {
    position: relative;
    background: var(--ig-background);
}

/* Mobile Comment Modal */
.mobile-comment-modal {
    display: none;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    height: var(--modal-height);
    background: var(--ig-background);
    z-index: 1000;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    flex-direction: column;
}

.mobile-comment-modal.active {
    display: flex;
    animation: slideUp 0.3s ease-out forwards;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}

/* Modal Header */
.modal-header {
    height: var(--header-height);
    padding: 0 16px;
    border-bottom: 1px solid var(--ig-border);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    background: var(--ig-background);
}

.modal-header h4 {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
    color: var(--ig-text);
}

.close-modal {
    position: absolute;
    left: 8px;
    height: 44px;
    width: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: none;
    border: none;
    cursor: pointer;
    font-size: 24px;
    color: var(--ig-text);
}

/* Comments Wrapper */
.comments-wrapper {
    flex: 1;
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
    padding: 16px;
    background: var(--ig-background);
}

/* Comment Styles */
.comment {
    display: flex;
    margin-bottom: 16px;
    padding: 0;
}

.comment:last-child {
    margin-bottom: var(--comment-form-height);
}

.comment-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    margin-right: 12px;
}

.comment-content {
    flex: 1;
    min-width: 0;
}

.comment-user {
    font-weight: 600;
    color: var(--ig-text);
    margin-right: 4px;
}

.comment-text {
    color: var(--ig-text);
    margin: 0;
    word-wrap: break-word;
}

/* Comment Actions */
.comment-actions {
    display: flex;
    gap: 16px;
    margin-top: 8px;
}

.comment-like,
.comment-reply-button {
    background: none;
    border: none;
    padding: 0;
    font-size: 12px;
    color: var(--ig-secondary-text);
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 4px;
}

.comment-like.liked {
    color: var(--ig-error);
}

/* Reply Section */
.replies {
    margin-left: 44px;
    margin-top: 8px;
}

.reply {

    margin-bottom: 12px;
}

/* Forms */
.comment-form {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 8px 16px;
    background: var(--ig-background);
    border-top: 1px solid var(--ig-border);
    display: flex;
    gap: 12px;
    align-items: center;
    height: var(--comment-form-height);
    z-index: 1001;
}

.reply-form {
    margin-left: 44px;
    margin-top: 8px;
    padding: 8px 0;
    display: none;
    gap: 12px;
    align-items: center;
}

.reply-form.active {
    display: flex;
}

.comment-input,
.reply-input {
    flex: 1;
    border: 1px solid var(--ig-border);
    border-radius: 22px;
    padding: 8px 16px;
    font-size: 14px;
    outline: none;
    background: var(--ig-background);
}

.comment-submit,
.reply-form button[type="submit"] {
    background: none;
    border: none;
    color: var(--ig-primary);
    font-weight: 600;
    cursor: pointer;
    padding: 0 8px;
    opacity: 0.5;
}

.comment-input:valid ~ .comment-submit,
.reply-input:valid ~ button[type="submit"] {
    opacity: 1;
}

/* Loading States */
.loading-spinner {
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.spinner {
    width: 24px;
    height: 24px;
    border: 2px solid var(--ig-border);
    border-top-color: var(--ig-primary);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Desktop Styles */
@media (min-width: 768px) {
    .mobile-comment-modal {
        position: static;
        height: auto;
        max-height: 400px;
        transform: none;
        border-radius: 0;
        box-shadow: none;
        display: block;
    }

    .modal-header {
        display: none;
    }

    .comments-wrapper {
        max-height: 300px;
    }

    .comment-form {
        position: static;
        border-top: 1px solid var(--ig-border);
    }

    .comment:last-child {
        margin-bottom: 16px;
    }
}

/* Overlay for mobile */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    z-index: 999;
}

.modal-overlay.active {
    display: block;
}

/* Hide scrollbar on body when modal is open */
body.modal-open {
    overflow: hidden;
}
.reply-input {
color:black !important;
}


/* Default style for the like reply button */
.reply-like-button {
    background-color: transparent;
    border: none;
    color: #555;
    cursor: pointer;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 5px;
}

/* Style for the like reply button when the user has liked the reply */
.reply-like-button.liked {
    color: #e74c3c; /* Red color for liked state */
}

/* Additional styles for the like count */
.reply-like-button span {
    font-weight: bold;
}


</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize all galleries
    document.querySelectorAll('.media-gallery.has-multiple').forEach(gallery => {
        initializeGallery(gallery);
    });
});

function initializeGallery(gallery) {
    const items = gallery.querySelectorAll('.media-item');
    const dots = gallery.querySelectorAll('.dot');
    const prevBtn = gallery.querySelector('.prev-btn');
    const nextBtn = gallery.querySelector('.next-btn');
    let currentIndex = 0;

    // Add image counter
    const counter = document.createElement('div');
    counter.className = 'media-counter';
    counter.textContent = `1/${items.length}`;
    gallery.appendChild(counter);

    // Show first image
    items[0].classList.add('active');
    
    // Update navigation state
    function updateNavigation() {
        // Update counter
        counter.textContent = `${currentIndex + 1}/${items.length}`;
        
        // Update dots
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentIndex);
        });
        
        // Update images
        items.forEach((item, index) => {
            item.classList.toggle('active', index === currentIndex);
        });
    }

    // Navigation functions
    function showNext() {
        if (currentIndex < items.length - 1) {
            currentIndex++;
            updateNavigation();
        }
    }

    function showPrev() {
        if (currentIndex > 0) {
            currentIndex--;
            updateNavigation();
        }
    }

    // Event listeners
    if (prevBtn) prevBtn.addEventListener('click', showPrev);
    if (nextBtn) nextBtn.addEventListener('click', showNext);

    // Touch events for swipe
    let touchStartX = 0;
    let touchEndX = 0;

    gallery.addEventListener('touchstart', e => {
        touchStartX = e.changedTouches[0].screenX;
    });

    gallery.addEventListener('touchend', e => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                showNext();
            } else {
                showPrev();
            }
        }
    }
}


// Feed Interactions Enhancemen
    
class FeedInteraction {
    constructor(feedId) {
        if (FeedInteraction.instances.has(feedId)) {
            return FeedInteraction.instances.get(feedId);
        }
        
        this.feedId = feedId;
        this.isLoadingComments = false;
        this.lastCommentId = 0;
        this.hasMoreComments = true;
        this.isCommentsVisible = false;
        this.setupEventListeners();
        
        FeedInteraction.instances.set(feedId, this);
    }

    static instances = new Map();

    setupEventListeners() {
        // Remove existing listeners first
        this.removeEventListeners();

        // Reaction handling
    
       const reactionLIKEFeed = document.querySelector(`[id="handlefeedlike-${this.feedId}"]`);
        if (reactionLIKEFeed) {
            reactionLIKEFeed.addEventListener('click', this.handleReaction.bind(this));
        }

        // Comment toggle
        const commentBtn = document.querySelector(`[id="toggleComments-${this.feedId}"]`);
        if (commentBtn) {
            commentBtn.addEventListener('click', this.toggleComments.bind(this));
        }

        // Comment form
        const commentForm = document.querySelector(`#commentForm-${this.feedId}`);
        if (commentForm) {
            commentForm.addEventListener('submit', this.handleCommentSubmit.bind(this));
        }

        // Scroll handler for infinite loading
        const commentsList = document.getElementById(`commentsList-${this.feedId}`);
        if (commentsList) {
            const wrapper = commentsList.closest('.comments-wrapper');
            wrapper.addEventListener('scroll', this.handleScroll.bind(this));
        }

        // Mobile modal close
        const closeBtn = document.querySelector(`#comments-${this.feedId} .close-modal`);
        if (closeBtn) {
            closeBtn.addEventListener('click', this.toggleComments.bind(this));
        }
    }

    removeEventListeners() {
        const commentBtn = document.querySelector(`[id="toggleComments-${this.feedId}"]`);
        if (commentBtn) {
            const newBtn = commentBtn.cloneNode(true);
            commentBtn.parentNode.replaceChild(newBtn, commentBtn);
        }
    }

    toggleComments(e) {
        if (e) e.preventDefault();
        
        const commentsSection = document.getElementById(`comments-${this.feedId}`);
        const isMobile = window.innerWidth < 768;

        if (!this.isCommentsVisible) {
            commentsSection.style.display = 'block';
            if (isMobile) {
               $(".mobile-comment-modal").show();
                document.body.style.overflow = 'hidden';
                commentsSection.classList.add('active');
            }
            this.loadComments();
            this.isCommentsVisible = true;
        } else {
            if (isMobile) {
                const modalComment=document.querySelector('.mobile-comment-modal');
                modalComment.style.display = 'block';
                commentsSection.classList.remove('active');
                document.body.style.overflow = '';
            }
            commentsSection.style.display = 'none';
            this.isCommentsVisible = false;
        }
    }


    async handleCommentSubmit(e) {
    e.preventDefault();
    const form = e.target;
    const input = form.querySelector('input[name="comment"]');
    const comment = input.value.trim();

    if (!comment) return;

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                comment: comment,
                feed_id: form.dataset.feedId
            })
        });

        if (response.ok) {
            const data = await response.json();
            this.addNewComment(data);
            input.value = '';
        }
    } catch (error) {
        console.error('Error submitting comment:', error);
    }
}

async handleReplySubmit(commentId, event) {
    event.preventDefault();
    const form = event.target;
    const input = form.querySelector('.reply-input');
    const reply = input.value.trim();

    if (!reply) return;

    try {
        const response = await fetch(`/comments/${commentId}/Commentreplies`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ reply })
        });

        if (response.ok) {
            const data = await response.json();
            this.addNewReply(commentId, data.reply);
            input.value = '';
            form.classList.remove('active');
            
            // Update reply count
            const replyCount = document.querySelector(`#comment-${commentId}-reply-count`);
            if (replyCount) {
                replyCount.textContent = parseInt(replyCount.textContent) + 1;
            }
        }
    } catch (error) {
        console.error('Error submitting reply:', error);
    }
}

    async toggleCommentLike(commentId) {
    try {
        const response = await fetch(`/comments/${commentId}/likeComments`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (response.ok) {
            const data = await response.json();
            const likeButton = document.querySelector(`#comment-${commentId}-like-button`);
            const likeCount = document.querySelector(`#comment-${commentId}-likes`);
            
            likeCount.textContent = data.likes_count;
            likeButton.classList.toggle('liked', data.action === 'liked');
        } else {
            console.error('Failed to toggle like:', response.statusText);
        }
    } catch (error) {
        console.error('Error toggling comment like:', error);
    }
}
async toggleReplyLike(replyId) {
    try {
        const response = await fetch(`/replies/${replyId}/repliesLikes`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (response.ok) {
            const data = await response.json();
            const likeButton = document.getElementById(`reply-${replyId}-like-button`);
            const likeCount = document.querySelector(`#reply-${replyId}-likes`);
            
            likeCount.textContent = data.likes_count;
            $(`#reply-${replyId}-like-button`).addClass('liked');
            likeButton.classList.toggle('liked', data.action === 'liked');
        } else {
            console.error('Failed to toggle like:', response.statusText);
        }
    } catch (error) {
        console.error('Error toggling reply like:', error);
    }
}


async loadReplies(commentId) {
    try {
        const response = await fetch(`/comments/${commentId}/replies`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        });

        if (response.ok) {
            const data = await response.json();
            const repliesContainer = document.querySelector(`#renderRepliesForComment-${commentId}`);
            let x = data.replies.map(reply => this.renderReply(reply)).join('');
            repliesContainer.innerHTML = x;
           // $(`#renderRepliesForComment-${commentId}`).html(x);
           
            
            // Setup event listeners for the new replies
            data.replies.forEach(reply => {
                const likeButton = document.querySelector(`#reply-${reply.id}-like-button`);
                if (likeButton) {
                    likeButton.addEventListener('click', (e) => {
                        const replyId = e.currentTarget.dataset.replyId;
                        this.toggleReplyLike(replyId);
                    });
                }
            });
        } else {
            console.error('Failed to load replies:', response.statusText);
        }
    } catch (error) {
        console.error('Error loading replies:', error);
    }
}





toggleReplyForm(commentId) {

    const replyDIv=document.getElementById(`renderRepliesForComment-${commentId}`);

    if(replyDIv.style.display === 'block'){
        replyDIv.style.display = 'none';
    }else{
        this.loadReplies(commentId);
        replyDIv.style.display = 'block';
    }



    // Find all reply forms first
    const allReplyForms = document.querySelectorAll('.reply-form');
    
    // Close any other open reply forms
    allReplyForms.forEach(form => {
        if (form.id !== `replyForm-${commentId}`) {
            form.classList.remove('active');
        }
    });

    // Toggle the selected reply form
    const replyForm = document.querySelector(`#replyForm-${commentId}`);
    if (replyForm) {
        replyForm.classList.toggle('active');
        
        // Focus the input when opening
        if (replyForm.classList.contains('active')) {
            const input = replyForm.querySelector('.reply-input');
            if (input) {
                input.focus();
            }
        }
    }

}
    handleScroll(e) {
        const wrapper = e.target;
        if (wrapper.scrollHeight - wrapper.scrollTop <= wrapper.clientHeight + 100) {
            this.loadComments();
        }
    }

    async handleReaction(reaction) {
        try {
            const response = await fetch('/likeStorefeed', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    description: 'Like',
                    car_media_feed_id: this.feedId
                })
            });

            if (response.ok) {
                const data = await response.json();

                this.updateReactionCount(data);
            }
        } catch (error) {
            console.error('Error handling reaction:', error);
        }
    }

    updateReactionCount(data) {
        const countElement = document.getElementById(`likes-count-${this.feedId}`);
        if (countElement) {
            const currentCount = parseInt(countElement.textContent);
            if(data.length > 0){
                $(`#handlefeedlike-${this.feedId} i`).addClass('liked-btn');
            
                let currentCountA=currentCount + 1 
                countElement.innerHTML ="<strong>" + currentCountA + "</strong> likes" ;
            }else{
                $(`#handlefeedlike-${this.feedId} i`).removeClass('liked-btn');
                let currentCountA=currentCount - 1 
                countElement.innerHTML = "<strong>"  + currentCountA + "</strong> likes";
            }
        }
    }

    async loadComments() {
        if (this.isLoadingComments || !this.hasMoreComments) return;

        this.isLoadingComments = true;
        const spinner = document.querySelector(`#comments-${this.feedId} .loading-spinner`);
        spinner.style.display = 'block';

        try {
            const response = await fetch(`/feeds/${this.feedId}/comments?last_fetched_id=${this.lastCommentId}`);
            const data = await response.json();
            
            if (data.comments.length > 0) {
                this.renderComments(data.comments);
                this.lastCommentId = data.comments[data.comments.length - 1].id;
                this.hasMoreComments = data.has_more;
            } else {
                this.hasMoreComments = false;
            }
        } catch (error) {
            console.error('Error loading comments:', error);
        } finally {
            this.isLoadingComments = false;
            spinner.style.display = 'none';
        }
    }

    humanizeTimestamp(timestamp) {
        const date = new Date(timestamp);
        const now = new Date();
        const seconds = Math.floor((now - date) / 1000);
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        const days = Math.floor(hours / 24);
        const months = Math.floor(days / 30);
        const years = Math.floor(days / 365);

        if (seconds < 60) {
            return 'just now';
        } else if (minutes < 60) {
            return minutes === 1 ? '1 minute ago' : `${minutes} minutes ago`;
        } else if (hours < 24) {
            return hours === 1 ? '1 hour ago' : `${hours} hours ago`;
        } else if (days < 30) {
            return days === 1 ? '1 day ago' : `${days} days ago`;
        } else if (months < 12) {
            return months === 1 ? '1 month ago' : `${months} months ago`;
        } else {
            return years === 1 ? '1 year ago' : `${years} years ago`;
        }
    }

    renderComments(comments) {
        const commentsList = document.getElementById(`commentsList-${this.feedId}`);
        comments.forEach(comment => {
            const commentHTML = `
                <div class="comment" id="comment-${comment.id}">
                    <img src="/storage/${comment.user.profile_image}" alt="${comment.user.username}" class="rounded-circle" width="32" height="32">
                    <div class="comment-content">
                        <strong>${comment.user.username}</strong>
                        <p>${comment.comment}</p>
                        <div class="comment-actions">
                            <button 
                                id="comment-${comment.id}-like-button"
                                class="comment-like ${comment.is_liked_by_user ? 'liked' : ''}"
                                data-comment-id="${comment.id}"
                            >
                                <span id="comment-${comment.id}-likes">${comment.likes_count}</span> likes
                            </button>
                            <button 
                                class="comment-reply-button"
                                data-comment-id="${comment.id}"
                            >
                                <span id="comment-${comment.id}-reply-count">${comment.replies_count}</span> replies
                            </button>
                        </div>
                        <small class="text-muted">${this.humanizeTimestamp(comment.created_at)}</small>
                        
                                <div id="renderRepliesForComment-${comment.id}" style="display:none"></div>
                        
                        <form class="reply-form" id="replyForm-${comment.id}">
                            <input type="text" placeholder="Reply to comment..." class="reply-input">
                            <button type="submit">Reply</button>
                        </form>
                    </div>
                </div>
            `;
            commentsList.insertAdjacentHTML('beforeend', commentHTML);
        });
        
        this.setupCommentEventListeners();
    }
    addNewComment(comment) {
    const commentsList = document.getElementById(`commentsList-${comment.feed_id}`);
    if (!commentsList) {
        console.error(`Comments list element not found for feed_id: ${comment.feed_id}`);
        return;
    }
    const commentHTML = `
        <div class="comment" id="comment-${comment.id}">
            <img src="/storage/${comment.user.profile_image}" alt="${comment.user.username}" class="rounded-circle" width="32" height="32">
            <div class="comment-content">
                <strong>${comment.user.username}</strong>
                <p>${comment.comment}</p>
                <div class="comment-actions">
                    <button 
                        id="comment-${comment.id}-like-button"
                        class="comment-like ${comment.is_liked_by_user ? 'liked' : ''}"
                        data-comment-id="${comment.id}"
                    >
                        <span id="comment-${comment.id}-likes">0</span> likes
                    </button>
                    <button 
                        class="comment-reply-button"
                        data-comment-id="${comment.id}"
                    >
                        <span id="comment-${comment.id}-reply-count">0</span> replies
                    </button>
                </div>
                <small class="text-muted">${comment.time}</small>
                
                <div class="replies" id="replies-${comment.id}">
                
                </div>
                
                <form class="reply-form" id="replyForm-${comment.id}">
                    <input type="text" placeholder="Reply to comment..." class="reply-input">
                    <button type="submit">Reply</button>
                </form>
            </div>
        </div>
    `;
    commentsList.insertAdjacentHTML('beforeend', commentHTML);
    this.setupCommentEventListeners();
}
renderReply(reply) {
    return `
        <div class="reply" id="reply-${reply.id}">
            <img src="/storage/${reply.user.profile_image}" alt="${reply.user.username}" class="rounded-circle" width="24" height="24">
            <div class="reply-content">
                <strong>${reply.user.username}</strong>
                <p>${reply.reply}</p>
                <div class="reply-actions">
                    <button 
                        class="reply-like-button ${reply.is_liked_by_user ? 'liked' : ''}"
                        data-reply-id="${reply.id}"
                        id="reply-${reply.id}-like-button"
                    >
                        <span id="reply-${reply.id}-likes">${reply.likes_count}</span> likes
                    </button>
                </div>
                <small class="text-muted">${this.humanizeTimestamp(reply.created_at)}</small>
            </div>
        </div>
    `;
}

    setupCommentEventListeners() {
        const commentsContainer = document.getElementById(`commentsList-${this.feedId}`);

        // Like button listeners
        commentsContainer.querySelectorAll('.comment-like').forEach(button => {
            button.addEventListener('click', (e) => {
                const commentId = e.currentTarget.dataset.commentId;
                this.toggleCommentLike(commentId);
            });
        });

        // Reply button listeners
        commentsContainer.querySelectorAll('.comment-reply-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const commentId = e.currentTarget.dataset.commentId;
                this.toggleReplyForm(commentId);
            });
        });

        // Reply like button listeners
        commentsContainer.querySelectorAll('.reply-like-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const replyId = e.currentTarget.dataset.replyId;
                this.toggleReplyLike(replyId);
            });
        });

        // Reply form listeners
        commentsContainer.querySelectorAll('.reply-form').forEach(form => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const commentId = form.id.split('-')[1];
                this.handleReplySubmit(commentId, e);
            });
        });
    }

    addNewReply(commentId, reply) {
    const repliesContainer = document.querySelector(`#renderRepliesForComment-${commentId}`);
    const replyHTML = this.renderReply(reply);
    repliesContainer.insertAdjacentHTML('beforeend', replyHTML);
    
    // Setup event listeners for the new reply
    const newReplyElement = repliesContainer.lastElementChild;
    const likeButton = newReplyElement.querySelector('.reply-like-button');
    if (likeButton) {
        likeButton.addEventListener('click', (e) => {
            const replyId = e.currentTarget.dataset.replyId;
            this.toggleReplyLike(replyId);
        });
    }
}
}

// Initialize when the page loads
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-feed-id]').forEach(feed => {
        new FeedInteraction(feed.dataset.feedId);
    });
});
</script>