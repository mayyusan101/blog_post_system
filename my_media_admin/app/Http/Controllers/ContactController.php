<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //direct contact list
    public function index(){

        $contacts = Contact::orderBy('created_at','desc')->orderBy('created_at','desc')->paginate(5);
        return view('admin.contact.list',compact('contacts'));
    }
    //read detail
    public function detail($id){

        $contact = Contact::find($id);
        return view('admin.contact.detail',compact('contact'));
    }
    //delete contact
    public function delete($id){
        Contact::where('id',$id)->delete();
        return back();
    }
}
