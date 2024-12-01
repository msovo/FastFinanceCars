<?php
namespace App\Http\Controllers;

use App\Models\ChatMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Guest;
use Illuminate\Support\Facades\Log;

class ChatMessageController extends Controller
{
 
    public function index(Request $request)
{
    $guestId = $request->query('guest_id');
    

    $messagesQuery = ChatMessage::query();

    if (Auth::check()) {
        $messagesQuery->where(function ($query) {
            $query->where('user_id', Auth::id());
           
        });
    } elseif ($guestId) {
       
        $messagesQuery->where(function ($query) use ($guestId) {
            $query->where('guest_id', $guestId);
               
        });
    } else {
        return response()->json([], 200);
    }

    $messages = $messagesQuery->with('user')->get();


    return $messages;
}


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'message' => 'required|string|max:1000',
            'guest_id' => 'required|string|max:255',
            'guest_alias' => 'required|string|max:255',
        ]);


        if (Auth::check()) {
            $chatMessage = ChatMessage::create([
                'user_id' => Auth::check(),
                'message' => $validatedData['message'],
            ]);
        } else {
           
            $chatMessage = ChatMessage::create([
                'guest_id' => $validatedData['guest_id'],
                'guest_alias' => $validatedData['guest_alias'],
                'message' => $validatedData['message'],
            ]);
        } 



      
        Log::debug('Message saved', ['message' => $chatMessage]);
        return response()->json([
            'status' => 'success',
            'data' => $chatMessage,
        ]);
    }

    public function register(Request $request)
    {
        Log::debug('Register method called', ['request' => $request->all()]);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        Log::debug('Validation passed');

        $guestId = Str::uuid()->toString();

        $guest = Guest::create([
            'guest_id' => $guestId,
            'guest_alias' => $request->name,
            'email' => $request->email,
        ]);

        Log::debug('Guest created', ['guest' => $guest]);

        return response()->json(['guest_id' => $guest->guest_id], 201);
    }
}