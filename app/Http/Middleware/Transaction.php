<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Transaction
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
        try{
            DB::beginTransaction();
            $result=$next($request);            
            DB::commit();
            return $result;
        }
        catch(\Exception $e){            
            DB::rollback(); 
            \Log::error($e->getMessage());
            \Log::info("ロールバックされた");
            return abort(403,"ERROR: {$e->getMessage()}");
        }
            
        
    }
}
