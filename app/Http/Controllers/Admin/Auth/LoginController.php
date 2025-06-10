<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['checkAuth', 'showLoginForm']);
        $this->middleware(['auth:admin'])->only(['logout']);
    }
    public function showLoginForm()
    {

        return view('Admin.Auth.login');
    }
    public function checkAuth(Request $request)
    {
        $request->validate([
            "email" => "required|email|exists:admins,email",
            "password" => "required|min:5",
            // "remember" => "in:on,off",
        ]);
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))

            // if admin has permission home redirect home else redirect the first page has permission
            $permission = Auth::guard('admin')->user()->Role->permission;
            if(is_null($permission))
            return view('frontEnd.wait');
        if (!in_array('home', $permission))
            return redirect()->intended('admin/' . $permission[0]);

        return redirect()->intended(RouteServiceProvider::ADMIN_HOME);

        return redirect()->back()->withErrors(['email' => "credentials dose not match !"]);
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flash('success', 'you logout successfully');
        return redirect()->route('admin.login.show');
    }
}
