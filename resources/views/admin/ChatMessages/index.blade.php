@php
    use App\Models\ChatMessage;
@endphp

@extends('layouts.admin')

@section('content')
<style>
    /* General container styling */
.container {
    margin-top: 20px;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    font-family: 'Arial', sans-serif;
}

/* Header Styling */
.container h1 {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
    text-align: center;
}

.header-details {
    text-align: center;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border-radius: 8px;
}

.header-details span {
    display: block;
    font-size: 16px;
    margin: 5px 0;
}

/* List group styling */
.list-group {
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-group-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 8px;
    box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
    cursor: pointer;
}

.list-group-item:hover {
    background-color: #f1f1f1;
}

/* User image and details */
.list-group-item div:first-child {
    display: flex;
    align-items: center;
}

.list-group-item img {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    margin-right: 15px;
    object-fit: cover;
    border: 2px solid #ddd;
}

.list-group-item .fa-user-circle {
    font-size: 50px;
    color: #aaa;
    margin-right: 15px;
}

/* Message and timestamp styling */
.list-group-item div:nth-child(2) {
    flex: 1;
    margin: 0 10px;
}

.list-group-item div:nth-child(2) small {
    display: block;
    font-size: 14px;
    color: #555;
}

.list-group-item div:nth-child(3) {
    text-align: right;
}

.list-group-item .badge-primary {
    background-color: #007bff;
    color: #fff;
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
}

/* Timestamp */
.list-group-item small:last-child {
    font-size: 12px;
    color: #888;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .list-group-item {
        flex-direction: column;
        align-items: flex-start;
    }

    .list-group-item div:nth-child(3) {
        text-align: left;
        margin-top: 10px;
    }
}

.time_div-chat{
    text-align:right !important;
    color:red;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="container">
    <h1>Chat Messages</h1>
    <ul class="list-group">
        @php
            $groupedMessages = $chatMessages->groupBy(function ($chat) {
                return $chat->user_id ?? $chat->guest_id;
            });
        @endphp

        @foreach($groupedMessages as $group)
            @php
                $chat = $group->sortByDesc('created_at')->first();
            @endphp
            <li style="cursor:pointer" class="list-group-item" onclick="window.location='{{ route('admin.chats.show', $chat->user_id ?? $chat->guest_id) }}'">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <div>
                        @if($chat->user && $chat->user->profile_image)
                            <img src="{{ asset('storage/' . $chat->user->profile_image) }}" alt="Profile Picture" class="rounded-circle" width="40">
                        @else
                            <i class="fa fa-user-circle" style="font-size: 40px;"></i>
                        @endif
                        <script>
                            var x=@json($chatMessages)
                        </script>
                        {{ $user->username ?? $chatMessages[0]->guest_alias }}
                    </div>
                    <div style="overflow:hidden;">
                        <small>
                            {{  $chat->lastMessage->message  }}
                            <br>
                            <strong>{{ $chat->lastMessage->is_admin ? 'Agent' : 'Customer' }}</strong>
                        </small>
                    </div>
                    <div class="time_div_chat">
                        <span class="badge badge-primary">
                            {{ ChatMessage::where('user_id', $chat->user_id)->where('seen', false)->count() }} Unseen
                        </span>
                        <small>{{ $chat->lastMessage->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
@endsection