<?php

namespace App\Http\Controllers\Api;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    //get contact message
    public function contact (Request $request){
        $data = $this->getContactData($request);
        Contact::create($data);
        return response()->json(['status' => 'success']);
    }
    //get contact data
    private function getContactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->subject,
            'message' => $request->message
        ];
    }
}
