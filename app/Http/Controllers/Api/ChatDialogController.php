<?php

namespace App\Http\Controllers\Api;

use App\ChatDialog;
use App\ChatDialogUser;
use App\ConnectyCube;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductRequest;
use App\User;
use Illuminate\Http\Request;

class ChatDialogController extends Controller
{
    public function userDialogs(Request $request, $user_id)
    {
        $paginate = $request->has('paginate') ? $request->get('paginate') : 10;
        $selected_dialog = null;
        $user = User::find($user_id);

        if ($request->has('type') && $request->has('id')) {
            $type = $request->get('type');
            $id = $request->get('id');
            if ($type == 'product') {
                $dialog = ChatDialog::where([
                    'related' => $type,
                    'related_id' => $id,
                    'user_id' => $user_id,
                ])->get()->first();

                $related_data = Product::find($id);

                if (!$dialog && $related_data) {
                    // dd($related_data->seller->connectycube_user);

                    $occupants_ids = [
                        $related_data->seller->connectycube_user->connectycube_id,
                    ];
                    $name = 'product_' . $related_data->id . '&user_' . $related_data->seller_id;
                    $data = ConnectyCube::createDialog($occupants_ids, $user->connectycube_user, $name);
                    if (!$data['dialog_id']) {
                        return generate_response(true, 'Dialog not created');

                    }
                    $dialog = ChatDialog::create([
                        'related' => $type,
                        'related_id' => $id,
                        'user_id' => $user_id,
                        'connecty_dialog_id' => $data['dialog_id'],
                        'xmpp_room_jid' => $data['xmpp_room_jid'],
                    ]);
                    $dialog_user = ChatDialogUser::updateOrCreate([
                        'dialog_id' => $dialog->id,
                        'user_id' => $related_data->seller_id,
                    ]);

                    $dialog_user = ChatDialogUser::updateOrCreate([
                        'dialog_id' => $dialog->id,
                        'user_id' => $user_id,
                    ]);

                }
                $selected_dialog = $dialog;

            }
            if ($type == 'request') {
                $dialog = ChatDialog::where([
                    'related' => $type,
                    'related_id' => $id,
                    'user_id' => $user_id,
                ])->get()->first();
               

                $related_data = ProductRequest::with('user','user.connectycube_user')->find($id);

                if (!$dialog && $related_data) {
                    // dd($related_data->seller->connectycube_user);

                    $occupants_ids = [
                        $related_data->user->connectycube_user->connectycube_id,
                    ];
                    $name = 'request_' . $related_data->id . '&user_' . $related_data->user_id;
                    $data = ConnectyCube::createDialog($occupants_ids, $user->connectycube_user, $name);
                    if (!$data['dialog_id']) {
                        return generate_response(true, 'Dialog not created');

                    }
                    $dialog = ChatDialog::create([
                        'related' => $type,
                        'related_id' => $id,
                        'user_id' => $user_id,
                        'connecty_dialog_id' => $data['dialog_id'],
                        'xmpp_room_jid' => $data['xmpp_room_jid'],
                    ]);
                    $dialog_user = ChatDialogUser::updateOrCreate([
                        'dialog_id' => $dialog->id,
                        'user_id' => $related_data->user_id,
                    ]);

                    $dialog_user = ChatDialogUser::updateOrCreate([
                        'dialog_id' => $dialog->id,
                        'user_id' => $user_id,
                    ]);

                }
                $selected_dialog = $dialog;

            }
        }
        $query = ChatDialog::with('users')->withCount([
            'unreadMessages' => function ($query) use ($user_id) {
                $query->where('user_id', '!=', $user_id);
            }]);

        $query = $query->whereHas('users', function ($query) use ($user_id) {
            $query->where('user_id', $user_id);
        });
        if ($selected_dialog && $selected_dialog->id) {
            $query = $query->orderByRaw('IF(id = ' . $selected_dialog->id . ', 0,1)');
        }

        $dialogs = $query->latest()->paginate($paginate);

        // $query = ChatDialogUser::with('dialog', 'dialog.users','dialog.unreadMessages');
        // $query = $query->where('user_id', $user_id);
        // if ($selected_dialog && $selected_dialog->id) {
        //     $query = $query->orderByRaw('IF(dialog_id = ' . $selected_dialog->id . ', 0,1)');
        // }
        // $dialogs = $query->latest()->paginate($paginate);
        // return response()->json($dialogs);
        return generate_response(false, '', $dialogs);

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
        $data = [
            'type' => '',
        ];
    }
}
