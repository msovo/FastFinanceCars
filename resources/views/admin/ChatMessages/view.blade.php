@extends('layouts.admin')

@section('content')

<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f9;
    color: #333;
}

.container {
    max-width: 800px;
    margin: 30px auto;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden;
}

/* Header */
.container h1 {
    font-size: 24px;
    background: #007bff;
    color: #fff;
    margin: 0;
    padding: 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.header-info {
    font-size: 14px;
    color: #fff;
    text-align: left;
}

.header-info span {
    display: block;
    margin-bottom: 5px;
}

/* Chat Box */
.chat-box {
    padding: 20px;
    max-height: 500px;
    overflow-y: auto;
    background: #f9f9f9;
    border-top: 1px solid #e6e6e6;
}

.message {
    padding: 15px 20px;
    margin: 20px 0;
    border-radius: 15px;
    max-width: 70%;
    word-wrap: break-word;
    display: flex;
    align-items: center;
    position: relative;
}

.user-message {
    background: #e1f5fe;
    align-self: flex-start;
    margin-left: auto;
    text-align: left;
}

.admin-message {
    background: #dcedc8;
    align-self: flex-end;
    margin-right: auto;
    text-align: right;
}

.message p {
    margin: 0 10px;
    flex: 1;
    font-size: 14px;
}

.message small {
    font-size: 12px;
    color: #666;
    margin-top: 5px;
    display: block;
}

.message time {
    position: absolute;
    bottom: -20px;
    right: 15px;
    font-size: 12px;
    color: #999;
}

/* Profile Image */
.message img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: 2px solid #ccc;
}

.message .fa-user-circle {
    font-size: 35px;
    color: #ccc;
}

/* Input Area */
.input-group {
    padding: 15px;
    display: flex;
    border-top: 1px solid #e6e6e6;
    background: #fff;
}

.input-group input {
    flex: 1;
    border: 1px solid #ccc;
    border-radius: 20px;
    padding: 10px 15px;
    font-size: 14px;
    outline: none;
    transition: border 0.3s;
}

.input-group input:focus {
    border-color: #007bff;
}

.input-group button {
    margin-left: 10px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 20px;
    padding: 10px 20px;
    font-size: 14px;
    cursor: pointer;
    transition: background 0.3s;
}

.input-group button:hover {
    background: #0056b3;
}

/* Typing Indicator */
#typing-indicator {
    font-size: 12px;
    color: #999;
    margin: 10px;
    text-align: center;
    display: none;
}

/* Responsive Design */
@media (max-width: 768px) {
    .container {
        margin: 15px;
    }

    .message {
        max-width: 90%;
    }
}

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <h1>Chat with {{ $user->username ?? $messages[0]->guest_alias }}</h1>
    <div class="header-details">
    @if($messages[0]->user_id)
        <span><strong>User Type:</strong> {{ $user->user_type }}</span>
        <span><strong>Phone:</strong> {{ $user->phone }}</span>
        <span><strong>Email:</strong> {{ $user->email }}</span>
    @else
        <span><strong>Guest User</strong></span>
    @endif
</div>

    <div class="chat-box" id="chat-box">
        @foreach($messages as $message)
            <div class="message {{ $message->is_admin ? 'admin-message' : 'user-message' }}">
                <p>{{ $message->message }}</p>
                <small>{{ $message->created_at->diffForHumans() }} - {{ $message->is_admin ? 'Admin' : $user->name ?? $message->guest_alias }}</small>
            </div>
        @endforeach
    </div>
    <div class="input-group mt-3">
        <input type="text" id="message-input" class="form-control" placeholder="Type a message...">
        <button id="send-button" class="btn btn-primary">Send</button>
    </div>
    <div id="typing-indicator" style="display: none;">User is typing...</div>
</div>
@endsection
@section('scripts')


<script>
    
    const adminId = {{ auth('admin')->id() }};
    const userId = "{{ $user->user_id ?? $messages[0]->guest_id }}";
    const userName = "{{ $user->username ?? $messages[0]->guest_alias }}";
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.getElementById('send-button').addEventListener('click', function() {
        let message = document.getElementById('message-input').value;
        if (message.trim() !== '') {
            let xhr = new XMLHttpRequest();
            xhr.open('POST', `/admin/chat-messages/${userId}/send-message`, true);
            xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('message-input').value = '';
                    fetchMessages();
                }
            };
            xhr.send(JSON.stringify({ message: message, is_admin: true, admin_id: adminId }));
        }
    });

    function fetchMessages() {
        let xhr = new XMLHttpRequest();
        xhr.open('GET', `/admin/chat-messages/${userId}/messages`, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let chatBox = document.getElementById('chat-box');
                chatBox.innerHTML = '';
                let messages = JSON.parse(xhr.responseText);
                messages.forEach(message => {
                    let newMessage = document.createElement('div');
                    newMessage.classList.add('message', message.is_admin ? 'admin-message' : 'user-message');
                    newMessage.innerHTML = `<p>${message.message}</p><small>${new Date(message.created_at).toLocaleString()} - ${message.is_admin ? 'Admin' : userName}</small>`;
                    chatBox.appendChild(newMessage);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        };
        xhr.send();
    }

    setInterval(fetchMessages, 5000);
</script>
@endsection