<?php

namespace App\Http\Controllers\Api;

use App\ChatDialog;
use App\ChatMessage;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ChatMessageController extends Controller
{
    public function messages(Request $request, $dialog_id)
    {
        $paginate = $request->has('paginate') ? $request->get('paginate') : 10;

        $messages = ChatMessage::where('dialog_id', $dialog_id)
            ->latest()
            ->paginate($paginate);

        return response()->json($messages);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dialog_id' => 'required|unique:chat_dialogs,id,' . $request->get('dialog_id'),
            'user_id' => 'required|unique:users,id,' . $request->get('user_id'),
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

    public function unreadMessage(Request $request, $user_id)
    {
        $dialogs = ChatDialog::withCount([
            'unreadMessages' => function ($query) use ($user_id) {
                $query->where('user_id', '!=', $user_id);

            }])
            ->whereHas('users', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->whereHas(
                'unreadMessages', function ($query) use ($user_id) {
                    $query->where('user_id', '!=', $user_id);

                })
            ->count();

        return response()->json($dialogs);

    }

    public function markReadDialog($dialog_id, $user_id)
    {
        $update = ChatMessage::where('dialog_id', $dialog_id)
            ->where('user_id', '!=', $user_id)
            ->where('read', false)
            ->update([
                'read' => true,
                'read_at' => Carbon::now()->toDateTimeString(),

            ]);
        return response()->json($update);

    }

    public function sendChatEmail(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            Mail::send([], [], function ($message) use ($request,$user) {
                $message->to($user->email)
                    ->subject('You have some unread messages')
                    ->setBody('<h1>Hi, someone wants to have a chat with  you.Please check your inbox 
                    ', 'text/html'); // for HTML rich messages
            });
        }

    }
}
