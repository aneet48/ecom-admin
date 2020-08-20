<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{

    public function contacts()
    {
        $contacts = Contact::latest()->paginate(15);

        return response()->json($contacts);
    }

    public function contact($id)
    {
        $contact = Contact::find($id);
        return response()->json($contact);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'name' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return generate_response(true, $validator->errors()->all());
        }

        $contact = Contact::create([
            'email' => $request->get('email'),
            'message' => $request->get('message'),
            'name' => $request->get('name'),
        ]);
        $msg = $contact ? 'Contact created successfully' : "Contact not Found";
        $error = $contact ? false : true;
        $body = [
            'contact' => $contact,
        ];

        Mail::send([], [], function ($message) use ($request) {
            $message->to('test@test.com')
                ->subject('Contact Form filled')
                ->setBody('<h1>Hi, someone wants to contact you </h1> <br>
                    <p>name :  ' . $request->get('name') . '</p><br>
                    <p>email :  ' . $request->get('email') . '</p><br>
                    <p>message :  ' . $request->get('message') . '</p><br>
                    ', 'text/html'); // for HTML rich messages
        });

        return generate_response($error, $msg, $body);
    }

    public function delete($id)
    {

        $contact = Contact::where('id', $id)->delete();
        $msg = $contact ? 'Contact deleted successfully' : "Contact not Found";
        $error = $contact ? false : true;

        return generate_response($error, $msg);
    }
}
