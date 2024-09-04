<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileIndex(){
        return view('Admin.Pages.Profile.ProfileIndex');
    }

    public function PasswordUpdatePage(){
        return view('Admin.Pages.Profile.UpdatePassword');
    }

    public function PasswordUpdate(Request $request, $id){
        $validation = $request->validate([
            'password' => 'required|min:5|max:25',
            'password_confirmation' => 'required|same:password',
        ]);

        $data =  array();
        $data['password'] = Hash::make($request->password);
        $res = User::where('id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Password Update Successfully!');
        }else{
            return back()->with('error_message','Password Update Fail!');
        }
    }

    public function ProfileEdit($id){
        $User = User::where('id',$id)->select('id', 'name', 'email')->first();
        return view('Admin/Pages/Profile/ProfileUpdate',compact('User'));
    }

    public function ProfileUpdate(Request $request, $id){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);
        $data =  array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $res = User::where('id','=',$id)->update($data);
        if ($res){
            return back()->with('success_message','Profile Update Successfully!');
        }else{
            return back()->with('error_message','Profile Update Fail!');
        }
    }
}
