<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    public function reset($email)
    {
        return view('Admin.Auth.password.reset', compact('email'));
    }
    public function createPassword(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:admins,email",
            "password" => "required|confirmed|min:8",
            "password_confirmation" => "required",
        ]);
        $admin = Admin::whereEmail($request->email)->first();
        if (!$admin)
            return redirect()->back()->withErrors(['email' => 'try again Later!']);
        $admin->update([
            'password' => Hash::make($request->password),
        ]);
        Session::flash('success',"your Password Updated Successfully!");
        return redirect()->route('admin.login.show');
    }
}
