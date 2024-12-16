<div class="feeds" style="text-align:center;">
        @forelse($feeds as $feed)
            <div class="feed card mb-4 shadow-sm">
                <div class="card-header d-flex align-items-center">
                    <img src="{{asset('storage/'. $feed->user->profile_image) ?? asset('images/default_avatar.jpg') }}" alt="User" class="rounded-circle me-2" width="40" height="40">
                    <strong>{{ $feed->user->username ?? 'Unknown User' }}</strong>
                    @if($feed->created_at)
             <small class="text-muted ms-auto">{{ $feed->created_at->diffForHumans() }}</small>
             <button class="btn btn-primary send-message-btn" 
              data-type="general" 
                data-feed-id="" 
                data-story-id="">
            Send General Message
        </button>
            @else
                <small class="text-muted ms-auto">No date available</small>
            @endif                </div>
                <div class="card-body" >
                    <div class="feed-media mb-3">
                        @if(Str::contains($feed->media_path, ['.mp4', '.mov', '.avi']))
                            <video src="{{ Storage::url($feed->media_path) }}" controls class="w-100"></video>
                        @else
                
                            <img src="{{ asset('storage/'.$feed->media_path) }}" alt="Feed Media" class="img-fluid">
                        @endif
                    </div>
                    <p class="card-text">{{ $feed->caption }}</p>
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
                    <i class="fa fa-message"></i>
                    </button>
                    </div>
                <div id="comments-{{ $feed->id }}" class="comments mt-3" style="display: none;">
                    @auth
                    <form action="{{ route('Ccomments.store', ['feed' => $feed->id]) }}" method="POST" class="mb-2">
                    @csrf
                            <input type="text" name="comment" class="form-control" placeholder="Add a comment">
                        </form>
                    @endauth

                    @forelse($feed->comments as $comment)
                        <div class="comment mb-2">
                            <strong>{{ $comment->user->username }}</strong>
                            <p>{{ $comment->comment }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No comments yet.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <p class="text-muted">No feeds available.</p>
        @endforelse
    </div>