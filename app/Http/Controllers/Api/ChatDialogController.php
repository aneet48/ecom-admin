<?php

namespace App\Http\Controllers\Api;

use App\ChatDialog;
use App\ChatDialogUser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatDialogController extends Controller
{
    public function userDialogs(Request $request, $user_id)
    {
        $paginate = $request->has('paginate') ? $request->get('paginate') : 20;

        $dialogs = ChatDialogUser::with('dialog', 'dialog.users')->where('user_id', $user_id)->paginate($paginate);
        return response()->json($dialogs);
    }

    public function dialog(Request $request, $dialog_id)
    {

        $dialogs = ChatDialogUser::with('dialog', 'dialog.users')->where('dialog_id', $dialog_id)
            ->first();
        return response()->json($dialogs);
    }

    public function delete($dialog_id)
    {

        $city = ChatDialog::where('id', $dialog_id)->delete();
        $msg = $city ? 'City deleted successfully' : "City not Found";
        $error = $city ? false : true;

        return generate_response($error, $msg);
    }

    public function tempDialog(Request $request)
    {
        $data=[
            'type'=>''
        ];
    }
}
