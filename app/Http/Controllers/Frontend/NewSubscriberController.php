<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\NewSubscribeRequest;
use App\Mail\Frontend\NewSubscriberMail;
use App\Models\NewSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewSubscriberController extends Controller
{
    public function store(NewSubscribeRequest $request){
       try{
        NewSubscriber::create([
            'email'=>$request->email,
        ]);
        session()->flash('success', 'your email stored success');
            Mail::to($request->email)->send(new NewSubscriberMail());
        return redirect()->back();

       }catch(\Exception $error){
        session()->flash('error', 'sorry Tray again Later');
        return redirect()->back();

       }
    }
}
