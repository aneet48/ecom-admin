<?php

namespace App\Http\Controllers\Api;

use App\ChatMessage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ChatMessageController extends Controller
{
    public function messages(Request $request, $dialog_id)
    {
        $paginate = $request->has('paginate') ? $request->get('paginate') : 20;

        $messages = ChatMessage::where('dialog_id', $dialog_id)
            ->latest()
            ->paginate($paginate);

        return response()->json($messages);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dialog_id' => 'required|string|unique:chat_dialogs,id,' . $request->get('dialog_id'),
            'user_id' => 'required|string|unique:users,id,' . $request->get('user_id'),
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $message = ChatMessage::create([
            'dialog_id' => $request->get('dialog_id'),
            'user_id' => $request->get('user_id'),
            'message' => $request->get('message'),
        ]);

        return response()->json($message);

    }
}
