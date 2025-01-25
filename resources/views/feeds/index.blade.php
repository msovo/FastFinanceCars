@extends('layouts.index')

@section('content')
<!-- Core Styles -->
<style>
:root {
    --ig-primary: #0095f6;
    --ig-secondary: #262626;
    --ig-background: #fafafa;
    --ig-border: #dbdbdb;
    --ig-text: #262626;
    --ig-text-light: #8e8e8e;
    --ig-gradient: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
}

/* Base Layout */
body {
    background-color: var(--ig-background);
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.container {
    max-width: 935px;
    margin: 0 auto;
    padding: 20px;
}

/* Stories Section */
.stories-section {
    background: white;
    border: 1px solid var(--ig-border);
    border-radius: 8px;
    padding: 16px 0;
    margin-bottom: 24px;
    overflow: hidden;
}

.stories-container {
    display: flex;
    overflow-x: auto;
    gap: 16px;
    padding: 0 16px;
    scrollbar-width: none;
}

.stories-container::-webkit-scrollbar {
    display: none;
}

.story-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 80px;
}

.story-thumb {
    width: 66px;
    height: 66px;
    border-radius: 50%;
    padding: 2px;
    background: var(--ig-gradient);
    margin-bottom: 8px;
    position: relative;
    cursor: pointer;
}

.story-thumb img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 3px solid white;
    object-fit: cover;
}

/* Feed Styles */
.feed {
    background: white;
    border: 1px solid var(--ig-border);
    border-radius: 8px;
    margin-bottom: 24px;
}

.feed-header {
    padding: 14px 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.feed-user {
    display: flex;
    align-items: center;
    gap: 12px;
}

.feed-user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
}

.feed-username {
    font-weight: 600;
    color: var(--ig-text);
}

.feed-media {
    position: relative;
    aspect-ratio: 1/1;
    overflow: hidden;
}

.feed-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.feed-actions {
    padding: 12px 16px;
    border-top: 1px solid var(--ig-border);
}

.action-buttons {
    display: flex;
    justify-content: space-between;
}

.primary-actions {
    display: flex;
    gap: 16px;
}

.action-btn {
    background: none;
    border: none;
    padding: 8px;
    cursor: pointer;
    transition: all 0.2s;
}

.action-btn:hover {
    transform: scale(1.1);
}

/* Comments Section */


/* Story Modal */
.story-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.9);
    z-index: 1050;
    display: none;
    align-items: center;
    justify-content: center;
}

.story-modal.active {
    display: flex;
}

.story-container {
    max-width: 400px;
    width: 100%;
    height: 100vh;
    max-height: 800px;
    position: relative;
}

/* Progress Bar */
.progress-bars {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    gap: 4px;
    padding: 12px;
    z-index: 2;
}

.progress-bar {
    flex: 1;
    height: 2px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 1px;
    overflow: hidden;
}

.progress {
    height: 100%;
    background: white;
    width: 0;
    transition: width 0.1s linear;
}

/* Mobile Optimizations */
@media (max-width: 768px) {
    .container {
        padding: 0;
    }

    .feed {
        border-radius: 0;
        border-left: none;
        border-right: none;
    }

    .story-modal .story-container {
        width: 100vw;
        height: 100vh;
    }
}


/* Create Post Section Styles */
.create-post-section {
    margin-bottom: 24px;
}

.create-post-card {
    background: white;
    border: 1px solid var(--ig-border);
    border-radius: 8px;
    padding: 16px;
}

.post-header {
    display: flex;
    align-items: center;
    gap: 12px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--ig-border);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

.create-post-btn {
    flex: 1;
    background: var(--ig-background);
    border: 1px solid var(--ig-border);
    border-radius: 20px;
    padding: 8px 16px;
    text-align: left;
    color: var(--ig-text-light);
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.create-post-btn:hover {
    background-color: #f0f0f0;
}

.post-actions {
    display: flex;
    justify-content: space-around;
    padding-top: 12px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: none;
    border: none;
    padding: 8px 16px;
    color: var(--ig-text);
    font-size: 14px;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.2s ease;
}

.action-btn:hover {
    background-color: var(--ig-background);
}

.action-btn i {
    font-size: 20px;
}

.photo-btn {
    color: #45bd62;
}

.story-btn {
    color: #f7b928;
}

.live-btn {
    color: #f5533d;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .create-post-card {
        border-radius: 0;
        border-left: none;
        border-right: none;
    }

    .post-actions {
        flex-wrap: wrap;
        gap: 8px;
    }

    .action-btn {
        flex: 1;
        min-width: 100px;
        justify-content: center;
    }
}

/* Dark Mode Support */
@media (prefers-color-scheme: dark) {
    .create-post-card {
        background: #262626;
        border-color: #363636;
    }

    .create-post-btn {
        background: #363636;
        border-color: #363636;
        color: #a8a8a8;
    }

    .action-btn {
        color: #a8a8a8;
    }

    .action-btn:hover {
        background-color: #363636;
    }
}

/* Animations */
.create-post-card {
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Hover Effects */
.create-post-btn,
.action-btn {
    position: relative;
    overflow: hidden;
}

.create-post-btn::after,
.action-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.05);
    border-radius: inherit;
    transform: translate(-50%, -50%) scale(0);
    opacity: 0;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.create-post-btn:active::after,
.action-btn:active::after {
    transform: translate(-50%, -50%) scale(1);
    opacity: 1;
}

/* Loading State */
.action-btn.loading {
    pointer-events: none;
    opacity: 0.7;
}

.action-btn.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

/* Fix navigation buttons alignment */
.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.9);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 10;
}

.prev-btn {
    left: 16px;
}

.next-btn {
    right: 16px;
}

/* Style ellipsis button */
.more-options-btn {
    background: none;
    border: none;
    padding: 8px;
    cursor: pointer;
    color: var(--ig-text);
    opacity: 0.7;
    transition: opacity 0.2s;
}

.more-options-btn:hover {
    opacity: 1;
}

/* Comments styling */
.comments-count {
    font-size: 14px;
    color: var(--ig-text-light);
    margin-bottom: 8px;
}

.comment {
    display: flex;
    gap: 12px;
    padding: 8px 0;
    align-items: flex-start;
}

.comment-content {
    flex: 1;
}

.comment-content strong {
    margin-right: 8px;
}

.story-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.9);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
}

.story-container {
    max-width: 400px;
    width: 100%;
    height: 100vh;
    max-height: 800px;
    background: #000;
    position: relative;
    display: flex;
    flex-direction: column;
}

.story-header {
    padding: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 2;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    color: white;
}

.user-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 2px solid white;
}

.progress-container {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    display: flex;
    gap: 4px;
    padding: 12px;
    z-index: 2;
}

.progress-bar {
    flex: 1;
    height: 2px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 1px;
    overflow: hidden;
}

.progress {
    height: 100%;
    background: white;
    width: 0;
    transition: width 0.1s linear;
}

.story-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
}

.media-container {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.media-container img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

.nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.1);
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    color: white;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background-color 0.3s;
}

.nav-btn:hover {
    background: rgba(255, 255, 255, 0.2);
}

.prev-btn {
    left: 16px;
}

.next-btn {
    right: 16px;
}

.story-footer {
    padding: 16px;
    background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
}

.reply-container {
    display: flex;
    gap: 12px;
}

.reply-input {
    flex: 1;
    background: rgba(255, 255, 255, 0.1);
    border: none;
    border-radius: 20px;
    padding: 8px 16px;
    color: white;
}

.send-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
}

.story-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.9);
    z-index: 1050;
    display: flex;
    align-items: center;
    justify-content: center;
}

.story-container {
    max-width: 400px;
    width: 100%;
    height: 100vh;
    max-height: 800px;
    background: #000;
    position: relative;
}

.story-controls {
    display: flex;
    gap: 12px;
}

.pause-btn, .close-btn {
    background: none;
    border: none;
    color: white;
    font-size: 20px;
    cursor: pointer;
    padding: 8px;
    opacity: 0.8;
    transition: opacity 0.3s;
}

.pause-btn:hover, .close-btn:hover {
    opacity: 1;
}

.story-media {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* Add any missing styles from the previous implementation */
</style>

<div class="container">
    <h1 class="text-center mb-4">Car Media</h1>
    
    @auth
        <button class="btn btn-primary upload-story-btn" id="uploadStoryBtn">
            Share Your Story
        </button>
    @else
        <p class="text-center">Please <a href="{{ route('login') }}">login</a> to share your stories.</p>
    @endauth

    <!-- Stories Section -->
    @include('partials._stories', ['stories' => $stories])

    @auth
 
    <div class="modalStoryPlaceholder" id="modalStoryPlaceholder"></div>
<div class="create-post-section">
    <div class="create-post-card">
        <div class="post-header">
            <img src="{{ Auth::user()->profile_image ? Storage::url(Auth::user()->profile_image) : asset('images/default_avatar.jpg') }}" 
                 alt="Profile" 
                 class="user-avatar">
            <button type="button" 
                    class="create-post-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#feedUploadModal">
                What's on your mind, {{ Auth::user()->username }}?
            </button>
        </div>
        <div class="post-actions">
            <button type="button" 
                    class="action-btn photo-btn" 
                    data-bs-toggle="modal" 
                    data-bs-target="#feedUploadModal">
                <i class="far fa-images"></i>
                <span>Photo/Video</span>
            </button>
            <button type="button" 
                    class="action-btn story-btn"
                    data-bs-toggle="modal" 
                    data-bs-target="#storyUploadModal">
                <i class="far fa-clock"></i>
                <span>Story</span>
            </button>
            <button type="button" 
                    class="action-btn live-btn">
                <i class="fas fa-video"></i>
                <span>Go Live</span>
            </button>
        </div>
    </div>
</div>
@endauth
    <!-- Feed Upload Section -->
    @auth
        @include('partials._feed_upload')
    @endauth

    <!-- Feeds Section -->
    <div id="feeds-container">
        @include('partials._feeds', ['feeds' => $feeds])
    </div>
</div>

<!-- Modals -->
@include('partials._story_modal')
@include('partials._image_modal')
@include('partials._comment_modal')

<!-- Scripts -->
<script>

const feedInteractions = new Map();

// Main initialization functions
function initializeStoryViewer() {
    const storyThumbs = document.querySelectorAll('.story-thumb');
    storyThumbs.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const stories = JSON.parse(this.dataset.userStories);
            if (stories && stories.length > 0) {
                openStoryViewer(stories);
            }
        });
    });
}

function initializeFeedInteractions() {
    // Initialize like buttons
    document.querySelectorAll('.reaction').forEach(button => {
        button.addEventListener('click', function() {
            const reaction = this.dataset.reaction;
            const feedId = this.dataset.feedId;
            handleReaction(feedId, reaction);
        });
    });


}

function initializeCommentSystem() {
    // Initialize comment forms
    document.querySelectorAll('.comment-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const feedId = this.closest('.feed').dataset.feedId;
            submitComment(feedId, this);
        });
    });
}


// Main initialization when document is ready
document.addEventListener('DOMContentLoaded', function() {
  //  initializeStoryViewer();
    initializeFeedInteractions();
    initializeCommentSystem();


   
});


document.addEventListener('DOMContentLoaded', () => {
    // Initialize all feeds
    document.querySelectorAll('[data-feed-id]').forEach(feed => {
        const feedId = feed.dataset.feedId;
        feedInteractions.set(feedId, new FeedInteraction(feedId));
    });
});

// Story Viewer Enhancement
document.addEventListener('DOMContentLoaded', function() {
    // Initialize story click handlers
    document.querySelectorAll('.story-item').forEach(storyItem => {
        if (!storyItem.classList.contains('upload-story')) { // Skip upload button
            storyItem.addEventListener('click', function() {
                const userId = this.dataset.userId;
                const storiesCount = this.dataset.storiesCount;
                openStoryViewer(userId);
            });
        }
    });
});



async function openStoryViewer(userId) {
    try {
        const stories = @json($stories);
        const userStories = stories.filter(story => story.user.user_id === parseInt(userId));
        const storageBasePath = "{{ asset('storage/') }}";

        const modalHTML = `
            <div class="story-modal" id="storyModal">
                <div class="story-container">
                    <div class="story-header">
                        <div class="user-info">
                            <img src="${userStories[0].user.profile_image}" class="user-avatar">
                            <div class="user-details">
                                <span class="username">${userStories[0].user.username}</span>
                                <span class="time">${formatTime(userStories[0].created_at)}</span>
                            </div>
                        </div>
                        <div class="story-controls">
                            <button class="pause-btn" onclick="togglePause()">
                                <i class="fas fa-pause"></i>
                            </button>
                            <button class="close-btn" onclick="closeStoryViewer()">×</button>
                        </div>
                    </div>

                    <div class="progress-container">
                        ${userStories.map(() => `
                            <div class="progress-bar">
                                <div class="progress"></div>
                            </div>
                        `).join('')}
                    </div>

                    <div class="story-content">
                        <button class="nav-btn prev-btn" onclick="previousStory()">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        
                        <div class="media-container">
                            <img src="${storageBasePath}/${userStories[0].media_path}" alt="Story" class="story-media">
                        </div>

                        <button class="nav-btn next-btn" onclick="nextStory()">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>

                    <div class="story-footer">
                        <div class="reply-container">
                            <input type="text" placeholder="Reply to story..." class="reply-input">
                            <button class="send-btn">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;

        document.getElementById('modalStoryPlaceholder').innerHTML = modalHTML;
        
        // Initialize story viewer with the current user's stories
        initializeStoryViewer(userStories);

        // Add touch events for mobile
        addTouchEvents();
    } catch (error) {
        console.error('Error loading stories:', error);
    }
}

// Global variables for story control
let currentStoryIndex = 0;
let currentUserStories = [];
let storyTimer;
let isPaused = false;

function initializeStoryViewer(stories) {
    currentUserStories = stories;
    currentStoryIndex = 0;
    isPaused = false;
    startStoryProgress();

    // Add keyboard controls
    document.addEventListener('keydown', handleKeyPress);
}

function startStoryProgress() {
    if (storyTimer) clearInterval(storyTimer);
    if (isPaused) return;

    const progressBars = document.querySelectorAll('.progress-bar .progress');
    // Reset previous progress bars
    progressBars.forEach((bar, index) => {
        bar.style.width = index < currentStoryIndex ? '100%' : '0%';
    });

    const currentProgress = progressBars[currentStoryIndex];
    let progress = 0;

    storyTimer = setInterval(() => {
        if (!isPaused) {
            progress += 0.5;
            currentProgress.style.width = `${progress}%`;

            if (progress >= 100) {
                nextStory();
            }
        }
    }, 30);
}

function togglePause() {
    isPaused = !isPaused;
    const pauseBtn = document.querySelector('.pause-btn i');
    pauseBtn.className = isPaused ? 'fas fa-play' : 'fas fa-pause';
    
    if (!isPaused) {
        startStoryProgress();
    }
}


function nextStory() {
    if (currentStoryIndex < currentUserStories.length - 1) {
        currentStoryIndex++;
        updateStoryContent();
    } else {
        // Find next user's stories
        const allStories = @json($stories);
        const currentUserId = currentUserStories[0].user.user_id;
        const nextUserStories = findNextUserStories(allStories, currentUserId);
        
        if (nextUserStories.length > 0) {
            currentUserStories = nextUserStories;
            currentStoryIndex = 0;
            updateStoryContent();
        } else {
            closeStoryViewer();
        }
    }
}

function previousStory() {
    if (currentStoryIndex > 0) {
        currentStoryIndex--;
        updateStoryContent();
    } else {
        // Find previous user's stories
        const allStories = @json($stories);
        const currentUserId = currentUserStories[0].user.user_id;
        const prevUserStories = findPreviousUserStories(allStories, currentUserId);
        
        if (prevUserStories.length > 0) {
            currentUserStories = prevUserStories;
            currentStoryIndex = prevUserStories.length - 1;
            updateStoryContent();
        }
    }
}

function updateStoryContent() {
    const storageBasePath = "{{ asset('storage/') }}";
    const story = currentUserStories[currentStoryIndex];
    
    // Update media
    const mediaContainer = document.querySelector('.media-container');
    mediaContainer.innerHTML = `<img src="${storageBasePath}/${story.media_path}" alt="Story" class="story-media">`;
    
    // Update user info
    document.querySelector('.user-avatar').src = story.user.profile_image;
    document.querySelector('.username').textContent = story.user.username;
    document.querySelector('.time').textContent = formatTime(story.created_at);
    
    // Restart progress
    startStoryProgress();
}

function findNextUserStories(allStories, currentUserId) {
    const userIds = [...new Set(allStories.map(story => story.user.user_id))];
    const currentIndex = userIds.indexOf(currentUserId);
    if (currentIndex < userIds.length - 1) {
        const nextUserId = userIds[currentIndex + 1];
        return allStories.filter(story => story.user.user_id === nextUserId);
    }
    return [];
}

function findPreviousUserStories(allStories, currentUserId) {
    const userIds = [...new Set(allStories.map(story => story.user.user_id))];
    const currentIndex = userIds.indexOf(currentUserId);
    if (currentIndex > 0) {
        const prevUserId = userIds[currentIndex - 1];
        return allStories.filter(story => story.user.user_id === prevUserId);
    }
    return [];
}

function addTouchEvents() {
    const storyContent = document.querySelector('.story-content');
    let touchStartX = 0;
    let touchStartTime = 0;

    storyContent.addEventListener('touchstart', (e) => {
        touchStartX = e.touches[0].clientX;
        touchStartTime = Date.now();
        isPaused = true;
    });

    storyContent.addEventListener('touchend', (e) => {
        const touchEndX = e.changedTouches[0].clientX;
        const touchEndTime = Date.now();
        const touchDuration = touchEndTime - touchStartTime;
        const touchDistance = touchStartX - touchEndX;

        isPaused = false;
        
        // If it's a quick swipe
        if (touchDuration < 300 && Math.abs(touchDistance) > 50) {
            if (touchDistance > 0) {
                nextStory();
            } else {
                previousStory();
            }
        } else {
            // If it's a tap
            const screenWidth = window.innerWidth;
            const touchX = touchEndX;
            
            if (touchX < screenWidth / 3) {
                previousStory();
            } else if (touchX > (screenWidth * 2) / 3) {
                nextStory();
            }
        }
        
        startStoryProgress();
    });
}

function handleKeyPress(e) {
    switch(e.key) {
        case 'ArrowLeft':
            previousStory();
            break;
        case 'ArrowRight':
            nextStory();
            break;
        case ' ':
            togglePause();
            break;
        case 'Escape':
            closeStoryViewer();
            break;
    }
}

function closeStoryViewer() {
    if (storyTimer) clearInterval(storyTimer);
    document.removeEventListener('keydown', handleKeyPress);
    const modal = document.getElementById('storyModal');
    if (modal) modal.remove();
}

function formatTime(timestamp) {
    const date = new Date(timestamp);
    const now = new Date();
    const diff = Math.floor((now - date) / 1000);

    if (diff < 60) return 'just now';
    if (diff < 3600) return `${Math.floor(diff / 60)}m ago`;
    if (diff < 86400) return `${Math.floor(diff / 3600)}h ago`;
    return date.toLocaleDateString();
}



</script>
@endsection