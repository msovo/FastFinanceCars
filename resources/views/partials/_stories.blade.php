


<div class="stories-section">
    <div class="stories-wrapper">
        @auth
            <div class="story-item upload-story">
                <div class="story-ring upload">
                    <div class="story-avatar">
                        <button id="uploadStoryBtn" class="upload-btn">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <span class="story-username">Add Story</span>
            </div>
        @endauth
        @php
    $groupedStories = $stories->groupBy('user.user_id');
@endphp
        @forelse($groupedStories as $userStories)
            @php
                $story = $userStories->first();
                $hasMultiple = count($userStories) > 1;
                $isSeen = false; // Add your seen logic here
            @endphp
            
            <div class="story-item" 
                 data-user-id="{{ $story->user->user_id }}"
                 data-stories-count="{{ count($userStories) }}">
                <div class="story-ring {{ $isSeen ? 'seen' : '' }}">
                    <div class="story-avatar">
                        <img src="{{ Storage::url($story->user->profile_image) }}" 
                             alt="{{ $story->user->username }}"
                             loading="lazy">
                    </div>
                    @if($hasMultiple)
                        <div class="story-segments">
                            @foreach($userStories as $index => $s)
                                <div class="segment" style="--segment-index: {{ $index }};"></div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <span class="story-username">{{ $story->user->username }}</span>
            </div>
        @empty
            <div class="no-stories">
                <p>No stories yet</p>
            </div>
        @endforelse
    </div>
</div>

<style>
.stories-section {
    background: white;
    border: 1px solid var(--ig-border);
    border-radius: 8px;
    padding: 16px 0;
    margin-bottom: 24px;
    position: relative;
}

.stories-wrapper {
    display: flex;
    overflow-x: auto;
    scrollbar-width: none;
    gap: 16px;
    padding: 0 16px;
}

.stories-wrapper::-webkit-scrollbar {
    display: none;
}

.story-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 66px;
    cursor: pointer;
}

.story-ring {
    width: 66px;
    height: 66px;
    border-radius: 50%;
    padding: 2px;
    background: var(--ig-gradient);
    margin-bottom: 8px;
    position: relative;
}

.story-ring.seen {
    background: #dbdbdb;
}

.story-ring.upload {
    background: #efefef;
}

.story-avatar {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 3px solid white;
    overflow: hidden;
    position: relative;
}

.story-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.upload-btn {
    width: 100%;
    height: 100%;
    border: none;
    background: none;
    color: var(--ig-primary);
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.story-username {
    font-size: 12px;
    color: var(--ig-text);
    max-width: 64px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    text-align: center;
}

.story-segments {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    display: flex;
}

.segment {
    flex: 1;
    position: relative;
    transform: rotate(calc(360deg / var(--segment-count) * var(--segment-index)));
}

.no-stories {
    width: 100%;
    text-align: center;
    color: var(--ig-text-light);
    padding: 20px;
}

@media (max-width: 768px) {
    .stories-section {
        border-radius: 0;
        border-left: none;
        border-right: none;
    }

    .story-item {
        min-width: 60px;
    }

    .story-ring {
        width: 60px;
        height: 60px;
    }
}
</style>