<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminChatController extends Controller
{  public function index()
    {
        $chatMessages = ChatMessage::with('user')
            ->select('user_id', 'guest_id', 'guest_alias', 'created_at')
            ->groupBy('user_id', 'guest_id', 'guest_alias', 'created_at')
            ->get()
            ->map(function ($chat) {
                $chat->lastMessage = ChatMessage::where('user_id', $chat->user_id)
                    ->orWhere('guest_id', $chat->guest_id)
                    ->latest()
                    ->first();
                return $chat;
            });

        return view('admin.ChatMessages.index', compact('chatMessages'));
    }

    public function getMessages($id)
{
    $messages = ChatMessage::where('user_id', $id)->orWhere('guest_id', $id)->get();
    return response()->json($messages);
}
public function show($id)
{
    $user=[];
    // Determine if $id is a string or an integer
    if (is_numeric($id)) {
        // If $id is numeric, treat it as user_id
        $messages = ChatMessage::where('user_id', $id)->get();
        $user = User::find($id);

        // Mark unseen messages as seen for user_id
        ChatMessage::where('user_id', $id)
            ->where('seen', 0)
            ->update(['seen' => 1]);
    } else {
        // If $id is a string, treat it as guest_id
        $messages = ChatMessage::where('guest_id', $id)->get();

        // Mark unseen messages as seen for guest_id
        ChatMessage::where('guest_id', $id)
            ->where('seen', 0)
            ->update(['seen' => 1]);
    }

    if (!$user) {
        $user = [];
    }

    return view('admin.ChatMessages.view', compact('user', 'messages'));
}


    public function sendMessage(Request $request, $id)
    {
        \Log::info('sendMessage called with ID: ' . $id);
    \Log::info('Request data: ', $request->all());
        
        $message = new ChatMessage();
        if (is_numeric($id)) {
            $message->user_id = $id;
        } else {
            $message->guest_id = $id;
        }
        $message->message = $request->message;
        $message->is_admin = $request->is_admin;
        $message->guest_alias = $request->guest_alias;
        $message->seen = false;
        $message->admin_id =  auth('admin')->id() ;
        $message->save();
    
        return response()->json(['success' => true]);
    }
}