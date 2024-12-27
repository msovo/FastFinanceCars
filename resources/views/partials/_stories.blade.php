    <!-- Stories Section -->
    <div class="stories-section mb-4">
    <div class="d-flex overflow-auto align-items-center">
        @auth
            <!-- Upload Story -->
            <div class="story-upload text-center me-3">
            <button id="uploadStoryBtn" class="btn btn-outline-primary rounded-circle d-flex justify-content-center align-items-center"
                style="width: 60px; height: 60px;">
            <i class="bi bi-camera"></i>
        </button>
        <small>Upload Story</small>
            </div>
        @endauth

        <!-- Existing Stories -->
        @php
    $groupedStories = $stories->groupBy('user.user_id');
@endphp

@forelse($groupedStories as $userStories)
    @php
        $story = $userStories->first();
        $segmentSize = 360 / count($userStories);
    @endphp
    <div class="story text-center me-3">
        <div class="story-thumb position-relative border rounded-circle overflow-hidden" 
             data-user-stories="{{ count($userStories) }}" data-user-Id="{{ $story->user->user_id }}">
            <div class="progress-ring">
                <!-- Dynamic Segmented Lines -->
                <svg width="60" height="60" class="position-absolute" style="top: 0; left: 0;">
                    <circle cx="30" cy="30" r="29" stroke-dasharray="{{ 100 / count($userStories) }}" stroke-dashoffset="0"></circle>
                </svg>
            </div>
            <img src="{{ $story->media_path ? Storage::url($story->media_path) : asset('images/default_story.jpg') }}" 
                 alt="Story" class="img-fluid">
        </div>
        <small class="text-truncate" style="max-width: 60px;">{{ $story->user->username ?? 'Unknown User' }}</small>
    </div>
@empty
    <p class="text-muted">No stories available.</p>
@endforelse
    </div>
</div>