<?php

namespace App\Http\Controllers\client;

use App\Events\MessageSentEvent;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required',
            'message' => 'required'
        ]);
        $message = Chat::create([
            'sender_id' => Auth::user()->user_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);
        $receiverId = $request->receiver_id;
        $senderId = Auth::user()->user_id;
        broadcast(new MessageSentEvent($message, $receiverId, $senderId));
        return response()->json($message);
    }

    public function getChatUserAdmin($senderId){
        $getChat = Chat::where('sender_id', $senderId)
            ->orWhere('receiver_id', $senderId)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json([
            'message' => $getChat->map(function ($message){
                return [
                  'text' => $message->message,
                  'sender' => $message->sender_id === Auth::user()->user_id ? 'user' : 'support',
                  'time' => $message->created_at->format('H:i')
                ];
            })
        ]);
    }

    public function getChatUser($senderId){
        $getChat = Chat::where('sender_id', $senderId)
            ->orWhere('receiver_id', $senderId)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json([
            'message' => $getChat->map(function ($message){
                return [
                    'text' => $message->message,
                    'sender' => $message->sender_id === Auth::user()->user_id ? 'user' : 'support',
                    'time' => $message->created_at->format('H:i')
                ];
            })
        ]);
    }

}
