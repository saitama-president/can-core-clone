<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PlayMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //ユーザ情報をバインドする
      
        \Log::Debug("Play MiddleWare");
        $user= \App\CCC\data\user::find(auth()->id());
        $request->merge(['user' => $user]);
        \Log::Debug("PM UID={$user->id}");
        return $next($request);
    }
}
