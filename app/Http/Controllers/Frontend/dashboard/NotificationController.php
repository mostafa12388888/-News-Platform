<?php

namespace App\Http\Controllers\frontend\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function getNotification()
    {
        auth()->user()->unreadNotifications ->markAsRead();
        return view('frontEnd.dashboard.notification');
    }
    public function deleteNotification(Request $request){
        auth()->user()->notifications()->findOrFail($request->id)->delete();
        Session::flash('success','the Notifications is Deleted');
        return redirect()->back();
    }
    public function deleteNotificationAll(){
        auth()->user()->notifications()->delete();
        Session::flash('success','All Notifications Deleted');
        return redirect()->back();
    }
    public function readAll(){
        auth()->user()->unreadNotifications ->markAsRead();
    }
}
