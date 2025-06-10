<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index()
    {
        return view('frontEnd.contact');
    }
    public function store(ContactRequest $request)
    {
        $contact = Contact::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'ip_address' => $request->ip(),
            'title' => $request->title,
            'body' => $request->body,
        ]);
        $admins=Admin::get();
        Notification::send($admins,new NewContactNotify($contact));

        if (!$contact)
            Session::flash('error', 'contact Us Failed');
        else
        Session::flash('success', 'contact Us stored success');




            return redirect()->back();
    }
}
