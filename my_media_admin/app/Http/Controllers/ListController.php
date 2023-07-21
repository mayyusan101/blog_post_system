<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ListController extends Controller
{
     //direct admin list
     public function index(){

        $users = User::where('role','admin')->get();
        return view('admin.list.index',compact('users'));
    }
    //delete user
    public function deleteUser($id){

        $userName = User::select('name')->where('id',$id)->first();
        $userName = $userName['name'];

        User::where('id',$id)->delete();

        return back()->with(['deleteMessage' => 'is sucessfully deleted!' ,'name' => $userName ]);
    }
    //search user
    public function searchUser(Request $request){

        $users = User::orWhere('name','like','%'.$request->searchKey.'%')
                    ->orWhere('phone','like','%'.$request->searchKey.'%')
                    ->get();

        return view('admin.list.index',compact('users'));
    }
}
