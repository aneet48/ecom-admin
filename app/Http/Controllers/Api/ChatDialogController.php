<?php

namespace App\Http\Controllers\Api;

use App\ChatDialog;
use App\ChatDialogUser;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ChatDialogController extends Controller
{
    public function userDialogs(Request $request, $user_id)
    {
        $paginate = $request->has('paginate') ? $request->get('paginate') : 10;
        $selected_dialog = null;

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
                    $dialog = ChatDialog::create([
                        'related' => $type,
                        'related_id' => $id,
                        'user_id' => $user_id,
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
        }

        $query = ChatDialogUser::with('dialog', 'dialog.users');
        $query = $query->where('user_id', $user_id);
        if ($selected_dialog && $selected_dialog->id) {
            $query = $query->orderByRaw('IF(dialog_id = ' . $selected_dialog->id . ', 0,1)');
        }
        $dialogs = $query->latest()->paginate($paginate);
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
        $data = [
            'type' => '',
        ];
    }
}
