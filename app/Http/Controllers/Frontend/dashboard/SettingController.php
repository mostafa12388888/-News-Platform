<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\frontend\dashboard\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function getSetting(){
        $user=auth()->user();
        return view('frontEnd.dashboard.setting',compact('user'));
    }
    public function update(UserUpdateRequest $request){
        $user=User::findOrFail(auth()->user()->id);
        if($request->file('image'))
        {
            FileHelper::deleteFile('/storage'.$user->image);
            $image= FileHelper::uploadFile($request->image,'userImage');
        }
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'user_name'=>$request->username,
            'phone'=>$request->phone,
            'image'=>$image??$user->image,
            'street'=>$request->street,
            'city'=>$request->city,
            'country'=>$request->country,
        ]);
        Session::flash('success','your update is success');
        return redirect()->back();

    }
    public function changePassword(Request $request){
        $request->validate([
            "current_password"=>"required",
            "password"=>"required|confirmed",
            "password_confirmation"=>"required"
        ]);
        if(!Hash::check($request->current_password,auth()->user()->password)){
            Session::flash('error',"Password Dos Not Match !");
            return redirect()->back();
        }
        User::FindOrFail(auth()->user()->id)->update([
            "password"=>Hash::make($request->current_password),
        ]);
        Session::flash('success'," Your Password Successfully !");
            return redirect()->back();

    }
}
