@php
    use App\Models\ChatMessage;
@endphp

@extends('layouts.admin')

@section('content')
<!-- Font Awesome CDN for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-p0vKQ6Z5I0VPLmRw0jVb9japFX6KUlxYF59yZoX5jk6vHBJfIQWy8VnydE7GS+BpnVfjHVi/7xdiasnCr0Smyw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    /* General Styles */
    .container-custom {
        max-width: 800px;
        margin: 30px auto;
        background: #ffffff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        font-family: 'Arial', sans-serif;
    }

    /* Header Styling */
    .container-custom h1 {
        font-size: 24px;
        background: #007bff;
        color: #fff;
        margin: 0;
        padding: 15px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .header-info {
        text-align: center;
        padding: 10px;
        background-color: #f1f1f1;
        color: #333;
        border-top: 1px solid #ddd;
    }

    .header-info span {
        display: block;
        font-size: 14px;
        margin: 5px 0;
    }

    /* Chat Box Styling */
    .chat-box {
        padding: 20px;
        max-height: 500px;
        overflow-y: auto;
        background: #f9f9f9;
        border-top: 1px solid #e6e6e6;
    }

    .message {
        display: flex;
        align-items: flex-end;
        margin-bottom: 15px;
    }

    .message .avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background-color: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .message .avatar img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
    }

    .message .message-content {
        max-width: 70%;
        background: #e1f5fe;
        padding: 10px 15px;
        border-radius: 15px;
        position: relative;
        word-wrap: break-word;
    }

    .message.admin .message-content {
        background: #dcedc8;
    }

    .message.user .message-content::after {
        content: "";
        position: absolute;
        top: 10px;
        left: -10px;
        border-width: 10px 10px 10px 0;
        border-style: solid;
        border-color: transparent #e1f5fe transparent transparent;
    }

    .message.admin .message-content::after {
        content: "";
        position: absolute;
        top: 10px;
        right: -10px;
        border-width: 10px 0 10px 10px;
        border-style: solid;
        border-color: transparent transparent transparent #dcedc8;
    }

    .message .message-content p {
        margin: 0;
        font-size: 14px;
    }

    .message .message-content small {
        display: block;
        margin-top: 5px;
        font-size: 12px;
        color: #555;
    }

    /* Input Area Styling */
    .input-group-custom {
        padding: 15px;
        display: flex;
        border-top: 1px solid #e6e6e6;
        background: #fff;
    }

    .input-group-custom input {
        flex: 1;
        border: 1px solid #ccc;
        border-radius: 20px;
        padding: 10px 15px;
        font-size: 14px;
        outline: none;
        transition: border 0.3s;
    }

    .input-group-custom input:focus {
        border-color: #007bff;
    }

    .input-group-custom button {
        margin-left: 10px;
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.3s;
    }

    .input-group-custom button:hover {
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
        .container-custom {
            margin: 15px;
        }

        .chat-box {
            max-height: 400px;
        }

        .input-group-custom button {
            width: 40px;
            height: 40px;
        }
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-custom">
    <h1>
        Chat with {{ $user->username ?? $messages[0]->guest_alias }}
    </h1>
    <div class="header-info">
        @if($messages[0]->user_id)
            <span><strong>User Type:</strong> {{ ucfirst($user->user_type) }}</span>
            <span><strong>Phone:</strong> {{ $user->phone }}</span>
            <span><strong>Email:</strong> {{ $user->email }}</span>
        @else
            <span><strong>Guest User</strong></span>
        @endif
    </div>

    <div class="chat-box" id="chat-box">
        @foreach($messages as $message)
            <div class="message {{ $message->is_admin ? 'admin' : 'user' }}">
                <div class="avatar">
                    @if($message->is_admin)
                        @if($message->admin && $message->admin->profile_image)
                            <img src="{{ asset('storage/' . $message->admin->profile_image) }}" alt="Admin Avatar">
                        @else
                            <i class="fas fa-user-cog"></i>
                        @endif
                    @else
                        @if($user->profile_image)
                            <img src="{{ asset('storage/' . $user->profile_image) }}" alt="User Avatar">
                        @else
                            <i class="fas fa-user-circle"></i>
                        @endif
                    @endif
                </div>
                <div class="message-content">
                    <p>{{ $message->message }}</p>
                    <small>{{ $message->created_at->format('h:i A') }} - {{ $message->is_admin ? 'Admin' : 'You' }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <div class="input-group-custom">
        <input type="text" id="message-input" class="form-control" placeholder="Type a message...">
        <button id="send-button">
            <i class="fas fa-paper-plane"></i>
        </button>
    </div>
    <div id="typing-indicator">User is typing...</div>
</div>

@endsection

@section('scripts')
<script>
    const adminId = {{ auth('admin')->id() }};
    const userId = "{{ $user->user_id ?? $messages[0]->guest_id }}";
    const userName = "{{ $user->username ?? $messages[0]->guest_alias }}";
    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const chatBox = document.getElementById('chat-box');
    const messageInput = document.getElementById('message-input');
    const sendButton = document.getElementById('send-button');
    const typingIndicator = document.getElementById('typing-indicator');
    let typingTimeout;

    // Function to send a message
    function sendMessage() {
        let message = messageInput.value.trim();
        if (message !== '') {
            fetch(`/admin/chat-messages/${userId}/send-message`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message: message, is_admin: true, admin_id: adminId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageInput.value = '';
                    fetchMessages();
                } else {
                    alert('Failed to send message.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while sending the message.');
            });
        }
    }

    // Event listener for send button
    sendButton.addEventListener('click', function() {
        sendMessage();
    });

    // Event listener for Enter key
    messageInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    // Function to fetch messages
    function fetchMessages() {
        fetch(`/admin/chat-messages/${userId}/messages`)
            .then(response => response.json())
            .then(data => {
                chatBox.innerHTML = '';
                data.forEach(message => {
                    let messageDiv = document.createElement('div');
                    messageDiv.classList.add('message', message.is_admin ? 'admin' : 'user');

                    // Avatar
                    let avatarDiv = document.createElement('div');
                    avatarDiv.classList.add('avatar');
                    if (message.is_admin) {
                        if (message.admin && message.admin.profile_image) {
                            let img = document.createElement('img');
                            img.src = `/storage/${message.admin.profile_image}`;
                            img.alt = 'Admin Avatar';
                            avatarDiv.appendChild(img);
                        } else {
                            avatarDiv.innerHTML = '<i class="fas fa-user-cog"></i>';
                        }
                    } else {
                        if (message.user && message.user.profile_image) {
                            let img = document.createElement('img');
                            img.src = `/storage/${message.user.profile_image}`;
                            img.alt = 'User Avatar';
                            avatarDiv.appendChild(img);
                        } else {
                            avatarDiv.innerHTML = '<i class="fas fa-user-circle"></i>';
                        }
                    }

                    // Message Content
                    let contentDiv = document.createElement('div');
                    contentDiv.classList.add('message-content');
                    let msgP = document.createElement('p');
                    msgP.textContent = message.message;
                    let msgSmall = document.createElement('small');
                    msgSmall.textContent = `${new Date(message.created_at).toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'})} - ${message.is_admin ? 'Admin' : 'You'}`;
                    contentDiv.appendChild(msgP);
                    contentDiv.appendChild(msgSmall);

                    // Append to message div
                    messageDiv.appendChild(avatarDiv);
                    messageDiv.appendChild(contentDiv);

                    chatBox.appendChild(messageDiv);
                });
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch(error => {
                console.error('Error fetching messages:', error);
            });
    }

    // Function to show typing indicator
    messageInput.addEventListener('input', function() {
        clearTimeout(typingTimeout);
        typingIndicator.style.display = 'block';
        typingTimeout = setTimeout(() => {
            typingIndicator.style.display = 'none';
        }, 2000);
    });

    // Fetch messages initially and set interval
    fetchMessages();
    setInterval(fetchMessages, 5000);
</script>
@endsection