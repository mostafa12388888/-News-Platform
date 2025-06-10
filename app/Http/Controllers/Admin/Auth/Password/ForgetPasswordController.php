<?php

namespace App\Http\Controllers\Admin\Auth\Password;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Notifications\SendOtpNotify;
use Ichtrojan\Otp\Otp;
use Illuminate\Http\Request;

class ForgetPasswordController extends Controller
{
    private $otp;
    public function __construct()
    {
        $this->otp = new Otp();
    }
    public function showEmailForm()
    {
        return view('Admin.Auth.password.email');
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:admins,email",
        ]);
        $admin = Admin::whereEmail($request->email)->first();
        $admin->notify(new SendOtpNotify());
        return redirect()->route('admin.password.showOtpForm', ['email' => $admin->email]);
    }
    public function showOtpForm($email)
    {
        return view('Admin.Auth.password.confirm', compact('email'));
    }
    public function verifyOtp(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:admins,email",
            "token" => "required|min:5|max:6",
        ]);
        $otp = $this->otp->validate($request->email, $request->token);
        if (!$otp->status)
            return redirect()->back()->withErrors(['token' => $otp->message]);
        return redirect()->route('admin.password.reset',['email',$request->email]);
    }
}
