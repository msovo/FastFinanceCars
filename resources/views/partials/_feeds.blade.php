
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
                <div id="reactionHtmlLoader-{{$feed->id}}">
    <div class="reactions" style="display: flex; justify-content: space-between; position:absolute; bottom:0; width:100%;">
        @foreach(['love' => '❤️', 'like' => '👍', 'sad' => '😢', 'angry' => '😡', 'cool' => '😎', 'support' => '🙌', 'confused' => '😕', 'laugh' => '😂', 'celebrate' => '🎉', 'thankful' => '🙏', 'curious' => '🤔', 'interested' => '😍'] as $reaction => $emoji)
            <button class="btn btn-outline-primary reaction" data-reaction="{{ $reaction }}" data-feed-id="{{ $feed->id }}">{{ $emoji }} <span class="reaction-count" id="count-{{ $reaction }}-{{ $feed->id }}">0</span></button>
        @endforeach
    </div>
</div>
            </div>

            <div class="card-footer d-flex align-items-center justify-content-between">
                @auth

                    <form action="{{ route('likes.store', ['feed' => $feed->id]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="feed_id" value="{{ $feed->id }}">                        
                        <button type="button" id="reportbtn" onclick="reportPost({{$feed->id}})" class="btn btn-outline-primary btn-sm me-2">Report Feed</button>
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
                   
                </div>
                @auth
                    <form id="commentFormMedia-{{ $feed->id }}" class="mb-2" style="margin-top:20px">
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
    $(document).ready(function() {
        $('.reaction').on('click', function() {
            var reaction = $(this).data('reaction');
            var feedId = $(this).data('feed-id');

            $.ajax({
                url: '{{ route('like.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    description: reaction,
                    car_media_feed_id: feedId
                },
                success: function(response) {
                    if (response.success) {
                        updateReactions(feedId);
                    }
                }
            });
        });

        function updateReactions(feedId) {
            $.ajax({
                url: '{{ route('like.getReactions', '') }}/' + feedId,
                method: 'GET',
                success: function(response) {
                    response.forEach(function(item) {
                        $('#count-' + item.description + '-' + feedId).text(item.count);
                    });
                }
            });
        }

        setInterval(function() {
            $('.reaction').each(function() {
                var feedId = $(this).data('feed-id');
                updateReactions(feedId);
            });
        }, 5000);
    });
</script>


<script>

        
//r
            function reportPost(feed_id){

            }                              


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
            //reset form
            $('#commentFormMedia-'+feedId).trigger("reset");

        });
    }

    // Initialize tracking for each feed
// Initialize tracking for each feed
const feedTracking = {};

setInterval(() => {
    document.querySelectorAll('.comments').forEach(commentSection => {
        const feedId = commentSection.id.split('-')[1];
        
        // Initialize tracking for the feed
        if (!feedTracking[feedId]) {
            feedTracking[feedId] = {
                lastFetchedCount: 0,
                lastFetchedId: 0,
            };
        }

        const { lastFetchedCount, lastFetchedId } = feedTracking[feedId];

        // Fetch the current count of comments for the feed
        fetch(`/feeds/${feedId}/comment-count`)
            .then(response => response.json())
            .then(data => {
                if (data.count > lastFetchedCount) {
                    // Update the count and fetch new comments
                    feedTracking[feedId].lastFetchedCount = data.count;

                    fetch(`/feeds/${feedId}/comments?last_fetched_id=${lastFetchedId}`)
                        .then(response => response.json())
                        .then(newComments => {
                            if (newComments.length > 0) {
                                const commentsList = document.getElementById(`commentsList-${feedId}`);

                                newComments.forEach(comment => {
                                    const newComment = `
                                        <div style="text-align:left" class="comment mb-3 d-flex align-items-start">
                                            <img src="{{ asset('storage/') }}/${comment.user.profile_image}" alt="User" class="rounded-circle me-2" width="30" height="30">
                                            <div>
                                                <strong>${comment.user.username}</strong>
                                                <p>${comment.comment}</p>
                                                <small class="text-muted">${comment.time}</small>
                                            </div>
                                        </div>`;
                                    commentsList.insertAdjacentHTML("beforeend", newComment);
                                });

                                // Update last fetched ID
                                feedTracking[feedId].lastFetchedId = newComments[newComments.length - 1].id;
                            }
                        });
                }
            })
            .catch(error => console.error('Error fetching comment count:', error));
    });
}, 5000);

</script>
