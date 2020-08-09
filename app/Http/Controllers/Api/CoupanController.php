<?php

namespace App\Http\Controllers\Api;

use App\Coupan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoupanController extends Controller
{

    public function index()
    {
       
        $reviews = Coupan::paginate(15);
        
        return response()->json($reviews);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'expiry_date' => 'required',
            'users_can_use' => 'required|integer',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }


        $coupan = Coupan::create([
            'code' => $request->get('code'),
            'expiry_date' => $request->get('expiry_date'),
            'users_can_use' => $request->get('users_can_use'),
            'amount' => $request->get('amount'),
            
        ]);
        $msg = $coupan ? 'Coupan created successfully' : "Something went wrong.";
        $error = $coupan ? false : true;

        $body = [
            'coupan' => $coupan,
        ];

        return generate_response($error, $msg, $body);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'code' => 'required|string',
            'expiry_date' => 'required',
            'users_can_use' => 'required|integer',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

      
        $coupan = Coupan::where('id', $id)->update([
            'code' => $request->get('code'),
            'expiry_date' => $request->get('expiry_date'),
            'users_can_use' => $request->get('users_can_use'),
            'amount' => $request->get('amount'),
        ]);
        $msg = $coupan ? 'Coupan updated successfully' : "Coupan not Found";
        $error = $coupan ? false : true;

        return generate_response($error, $msg);
    }
    public function delete($id)
    {

        $coupan = Coupan::where('id', $id)->delete();
        $msg = $coupan ? 'Coupan deleted successfully' : "Coupan not Found";
        $error = $coupan ? false : true;

        return generate_response($error, $msg);
    }
  
}
