<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\CCC\data\user\user;

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
        $uid=auth()->id();
        if(empty($uid)){
            \Log::Debug("UID={$uid} 取得できない");
            
            return $next($request);
        }
        
        $user= user::find($uid);
        $request->merge(['user' => $user]);
        return $next($request);
    }
}
