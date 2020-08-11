<?php

namespace App\Http\Controllers\Api;

use App\Feedback;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FeedbackController extends Controller
{

    public function index()
    {
       
        $reviews = Feedback::paginate(15);
        
        return response()->json($reviews);
    }
    public function all()
    {
       
        $reviews = Feedback::orderby('id','desc')->get();
        
        return response()->json($reviews);
    }
    
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'rating' => 'required|integer',
            'text' => 'required',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $imagename = Feedback::saveBase64Media($request->get('image'));

        $feedback = Feedback::create([
            'name' => $request->get('name'),
            'rating' => $request->get('rating'),
            'text' => $request->get('text'),
            'image'=> $imagename
        ]);
        $msg = $feedback ? 'Feedback created successfully' : "Something went wrong.";
        $error = $feedback ? false : true;

        $body = [
            'feedback' => $feedback,
        ];

        return generate_response($error, $msg, $body);
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'rating' => 'required|integer',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $imagename = Feedback::where(['id'=>$id])->value('image');
        if($request->get('image') && $request->get('image')!=''){
            $imagename = Feedback::saveBase64Media($request->get('image'));
        }


        $feedback = Feedback::where('id', $id)->update([
            'name' => $request->get('name'),
            'rating' => $request->get('rating'),
            'text' => $request->get('text'),
            'image'=> $imagename
        ]);
        $msg = $feedback ? 'Feedback updated successfully' : "Feedback not Found";
        $error = $feedback ? false : true;

        return generate_response($error, $msg);
    }
    public function delete($id)
    {

        $event = Feedback::where('id', $id)->delete();
        $msg = $event ? 'Feedback deleted successfully' : "Feedback not Found";
        $error = $event ? false : true;

        return generate_response($error, $msg);
    }
  
}
