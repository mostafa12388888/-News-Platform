<?php

namespace App\Http\Controllers\Admin\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:notifications');

    }
    public function index()
    {
        $notifications = Auth::guard('admin')->user()->notifications()->get();
        auth()->user()->unreadNotifications->markAsRead();
        return view('admin.Notification.index', compact('notifications'));
    }
    public function deleteNotification($id)
    {
        $notifications = Auth::guard('admin')->user()->notifications()->whereId($id)->first();
        if (!$notifications) {
            Session::flash('error', 'tray again later');
            return redirect()->back();
        }
        $notifications->delete();
        Session::flash('success', 'Notification Deleted Succfully');
        return redirect()->back();
    }
    public function deleteAll()
    {
        $notifications = Auth::guard('admin')->user()->notifications()->delete();

        Session::flash('success', 'Notification Deleted All Succfully');
        return redirect()->back();
    }
}
