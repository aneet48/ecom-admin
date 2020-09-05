<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\UserVisits;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserVisitsController extends Controller
{
    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'feature' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $visit = UserVisits::where([
            'user_id' => $request->get('user_id'),
            'feature' => $request->get('feature'),
        ])->whereDate('created_at', Carbon::today())->first();

        if (!$visit) {
            $visit = UserVisits::create([
                'user_id' => $request->get('user_id'),
                'feature' => $request->get('feature'),
            ]);
        }

        $msg = $visit ? 'visit created successfully' : "visit not Found";
        $error = $visit ? false : true;
        $body = [
            'visit' => $visit,
        ];

        return generate_response($error, $msg, $body);

    }
}
