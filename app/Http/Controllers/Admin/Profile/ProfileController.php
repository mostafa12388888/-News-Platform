<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Profile\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:profile');

    }
    public function index()
    {
        return view('admin.Profile.index');
    }
    public function update(ProfileRequest $request)
    {
        $admin = Admin::findOrFail(auth('admin')->user()->id);
        if(!Hash::check($request->password,$admin->password)){
            Session::flash('error','Your can not update your profile');
            return redirect()->back();
        }

        $admin->update([
            "email" => $request->email,
            "name" => $request->name,
            "user_name" => $request->username,
        ]);
        Session::flash('success','Your Profile is updated');

        return redirect()->back();

    }
}
