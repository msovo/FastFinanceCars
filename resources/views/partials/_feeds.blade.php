
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

            <div class="feed-actions">
                <div class="primary-actions">
                    <button class="action-btn like-btn" data-feed-id="{{ $feed->id }}">
                        <i class="far fa-heart"></i>
                    </button>
                    <button class="action-btn comment-btn" onclick="toggleComments({{ $feed->id }})">
                        <i class="far fa-comment"> {{ $feed->comments_count ?? 0 }} </i>
                   
                    </button>
                    <button class="action-btn share-btn">
                        <i class="far fa-paper-plane"></i>
                    </button>
                </div>
                <button class="action-btn save-btn">
                    <i class="far fa-bookmark"></i>
                </button>
            </div>

            <div class="feed-engagement">
                <div class="likes-count">
                    <strong>{{ $feed->likes_count ?? 0 }}</strong> likes
                </div>
                
                <div class="feed-caption">
                    <strong>{{ $feed->user->username }}</strong> 
                    <span>{{ $feed->caption }}</span>
                </div>

                <div class="feed-comments">
                    <div id="comments-{{ $feed->id }}" class="comments-container" style="display: none;">
                        <div class="comments-list" id="commentsList-{{ $feed->id }}">
                            <!-- Comments loaded dynamically -->
                        </div>
                        
                        @auth
                            <form class="comment-form" id="commentForm-{{ $feed->id }}">
                                <input type="text" 
                                       class="comment-input" 
                                       placeholder="Add a comment..."
                                       name="comment">
                                <button type="submit" class="comment-submit">Post</button>
                            </form>
                        @endauth
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
.comments-container {
    border-top: 1px solid #efefef;
    margin-top: 8px;
    padding-top: 8px;
}

.comment-form {
    display: flex;
    gap: 12px;
    padding: 16px 0 0;
    border-top: 1px solid #efefef;
}

.comment-input {
    flex: 1;
    border: none;
    outline: none;
    padding: 0;
    font-size: 14px;
}

.comment-submit {
    background: none;
    border: none;
    color: #0095f6;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    opacity: 0.5;
}

.comment-submit:hover {
    opacity: 1;
}

/* Timestamp */
.feed-timestamp {
    font-size: 12px;
    color: #8e8e8e;
    margin-top: 8px;
}
/* Add more styles as needed */
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
</script>