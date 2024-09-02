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
}
