<?php

namespace App\Http\Controllers\Api;

use App\ChatDialog;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatDialogController extends Controller
{
    public function userDialogs(Request $request,$user_id)
    {
       $dialogs = ChatDialog::where('users','like',$user_id)->get();
       dd($dialogs);
    }
}
