<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkNotificationReadAt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->query('notify')){
            $notification=auth()->user()->unreadNotifications()->find($request->query('notify'));
            if($notification)
            $notification->markAsRead();
        }
        if($request->query('notify-admin')){
            $notification=auth('admin')->user()->unreadNotifications()->find($request->query('notify-admin'));
            if($notification)
            $notification->markAsRead();
        }
        return $next($request);
    }
}
