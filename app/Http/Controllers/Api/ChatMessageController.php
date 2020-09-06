<?php

namespace App\Http\Controllers\Api;

use App\ChatMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function dialogs(Request $request, $user_id)
    {
        $dialogs = ChatMessage::where('sender_id',$user_id)
        ->orWhere('reciever_id',$user_id)
        ->get();

        return response()->json($dialogs);
    }
}
