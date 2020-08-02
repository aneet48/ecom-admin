<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'meta_key' => 'required',
            'meta_value' => 'required',
            'group' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $setting = Setting::updateOrCreate([
            'meta_key' => $request->get('meta_key'),
            'group' => $request->get('group'),
        ], [
            'meta_value' => $request->get('meta_value'),

        ]);

        $body = [
            'setting' => $setting,
        ];
        $msg = "Setting is updated successfully";

        return generate_response(false, $msg, $body);

    }

    public function search($meta_key,$group){
        $setting = Setting::where(['meta_key'=>$meta_key,'group'=>$group])->first();
        return response()->json($setting);
    }
}
