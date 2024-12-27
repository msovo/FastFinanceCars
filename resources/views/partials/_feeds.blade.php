
<style>
    .modal-body {
        background: none !important;
    }
    .comment-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .comments-container {
    border: 1px solid #ddd;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 5px;
    text-align: right;
}

.comment {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    
}

.comment img {
    border-radius: 50%;
}

.comments-list {
    overflow-y: auto;
    max-height: 250px;
}

</style>


<div class="feeds" style="text-align: center;">
    @forelse($feeds as $feed)
        <div class="feed card mb-4 shadow-sm ">
            <div class="card-header d-flex align-items-center">
                <img src="{{ asset('storage/' . ($feed->user->profile_image ?? 'images/default_avatar.jpg')) }}" alt="User" class="rounded-circle me-2" width="40" height="40">
                <strong>{{ $feed->user->username ?? 'Unknown User' }}</strong>
                @if($feed->created_at)
                    <small class="text-muted ms-auto">{{ $feed->created_at->diffForHumans() }}</small>
                @else
                    <small class="text-muted ms-auto">No date available</small>
                @endif
            </div>
            <div class="card-body">
                <p class="card-text">{{ $feed->caption }}</p>
                <div class="feed-media mb-3">
                    @if($feed->images->isNotEmpty())
                        <div class="row">
                            <div class="col-12 mb-3">
                                <img src="{{ asset('storage/' . $feed->images->first()->media_path) }}" alt="Feed Media" class="img-fluid" data-toggle="modal" data-target="#imageModal" data-src="{{ asset('storage/' . $feed->images->first()->media_path) }}">
                            </div>
                            @if($feed->images->count() > 1)
                                <div class="col-12">
                                    <div class="row">
                                        @foreach($feed->images->slice(1) as $image)
                                            <div class="col-4 mb-4">
                                                <img src="{{ asset('storage/' . $image->media_path) }}" alt="Feed Media" class="img-fluid" data-toggle="modal" data-target="#imageModal" style="max-height:150px;" data-src="{{ asset('storage/' . $image->media_path) }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-muted">No media available.</p>
                    @endif
                </div>
            </div>
            <div class="card-footer d-flex align-items-center">
                @auth
                    <form action="{{ route('likes.store', ['feed' => $feed->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary btn-sm me-2">Like</button>
                    </form>
                @endauth
                <button class="btn btn-outline-secondary btn-sm" onclick="toggleComments({{ $feed->id }})">Comments</button>
                <button class="btn btn-primary send-message-btn" 
                    data-type="feed" 
                    data-feed-id="{{ $feed->id }}" 
                    data-story-id="">
                    <i class="fa fa-message">DM based on feed</i>
                </button>
            </div>
            <div id="comments-{{ $feed->id }}" class="comments mt-3" style="display: none;">
            
                <div id="commentsList-{{ $feed->id }}" class="comment-list" style="max-height: 250px; overflow-y: auto;">
                    @forelse($feed->comments as $comment)
                        <div class="comment mb-3 d-flex align-items-start">
                            <img src="{{ asset('storage/' . ($comment->user->profile_image ?? 'images/default_avatar.jpg')) }}" alt="User" class="rounded-circle me-2" width="30" height="30">
                            <div style="text-align: left;">
                                <strong>{{ $comment->user->username }}</strong>
                                <p>{{ $comment->comment }}</p>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet.</p>
                    @endforelse
                </div>
                @auth
                    <form id="commentFormMedia-{{ $feed->id }}" class="mb-2">
                        @csrf
                        <input type="hidden" name="feed_id" value="{{ $feed->id }}">
                        <input type="text" name="comment" class="form-control" placeholder="Add a comment">
                        <button type="button" onclick="submitComment({{ $feed->id }})" class="btn btn-primary mt-2">Submit</button>
                    </form>
                @endauth
            </div>
        </div>
    @empty
        <p class="text-muted">No feeds available.</p>
    @endforelse
</div>


<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="" id="modalImage" class="img-fluid" alt="Full View">
            </div>
        </div>
    </div>
</div>

<script>
    function toggleComments(feedId) {
        const commentsSection = document.getElementById(`comments-${feedId}`);
        commentsSection.style.display = commentsSection.style.display === 'none' ? 'block' : 'none';
    }

    function submitComment(feedId) {
        const form = document.getElementById(`commentFormMedia-${feedId}`);
        const formData = new FormData(form);

        fetch("{{  route('Ccomments.store', ['feed' => $feed->id])  }}", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            const commentsList = document.getElementById(`commentsList-${feedId}`);
            const newComment = `
                <div class="comment mb-3 d-flex align-items-start">
                    <img src="{{ asset('storage/') }}/${data.user.profile_image}" alt="User" class="rounded-circle me-2" width="30" height="30">
                    <div>
                        <strong>${data.user.username}</strong>
                        <p>${data.comment}</p>
                        <small class="text-muted">${data.time}</small>
                    </div>
                </div>`;
            commentsList.insertAdjacentHTML("afterbegin", newComment);
        });
    }

    setInterval(() => {
        
        // Fetch new comments every 5 seconds for all feeds
        document.querySelectorAll('.comments').forEach(commentSection => {
            const feedId = commentSection.id.split('-')[1];
            const lastFetched = new Date().toISOString(); // Replace with actual timestamp tracking if required
            
            fetch(`/comments/latest/${feedId}?last_fetched=${lastFetched}`)
                .then(response => response.json())
                .then(newComments => {
                    const commentsList = document.getElementById(`commentsList-${feedId}`);
                    newComments.forEach(comment => {
                        const newComment = `
                            <div class="comment mb-3 d-flex align-items-start">
                                <img src="{{ asset('storage/') }}/${comment.user.profile_image}" alt="User" class="rounded-circle me-2" width="30" height="30">
                                <div>
                                    <strong>${comment.user.username}</strong>
                                    <p>${comment.comment}</p>
                                    <small class="text-muted">${new Date(comment.created_at).toLocaleTimeString()}</small>
                                </div>
                            </div>`;
                        commentsList.insertAdjacentHTML("beforeend", newComment);
                    });
                });
        });
    }, 5000);
</script>
