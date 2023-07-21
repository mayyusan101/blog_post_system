<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    //direct profile
    public function index(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('admin.profile.index',compact('user'));
    }
    //account update
    public function accountUpdate(Request $request){

        $this->checkUserValidation($request);
        $data = $this->getUserData($request);
        User::where('id',Auth::user()->id)->update($data);
        return back()->with(['updateSuccess' => 'Admin account is updated']);
    }
    //direct password page
    public function passwordPage(){
        return view('admin.profile.password');
    }
    //change password
    public function changePassword(Request $request){

        $this->passwordValidation($request);

        $db_data = User::where('id',Auth::user()->id)->first();
        $db_oldPassword = $db_data['password'];

        if(Hash::check($request->oldPassword, $db_oldPassword)){
            User::where('id',Auth::user()->id)->update([
                'password' => Hash::make($request->newPassword)
            ]);
           return redirect()->route('dashboard');
        }else{
            return back()->with(['failMessage' => 'Your old password is not the same']);
        }
    }
    //get user data
    private function getUserData($request){
        return[
           'name' => $request->name,
           'email' => $request->email,
           'phone' => $request->phone,
           'address' => $request->address,
           'gender' =>  $request->gender,
        ];
    }
    //check user validation
    private function checkUserValidation($request){
        Validator::make($request->all(),[
            'name' => 'required | max:20',
            'email' => 'required'
        ],[
            'name.required' => 'Name is required',
            'email.required' => 'Email is require'
        ])->validate();
    }
    //check password validation
    private function passwordValidation($request){

        $validationRules = [
            'oldPassword' => 'required',
            'newPassword' => 'required | min:8',
            'comfirmPassword' => 'required | same:newPassword',
        ];
        $validationMessage = [
            'comfirmPassword.same' => 'New password and comfirm password are not same'
        ];
        Validator::make($request->all(),$validationRules,$validationMessage)->validate();
    }
}
