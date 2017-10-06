<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->get('/nullpo', function (Request $request) {
    return ["OK"];
});

Route::get("status",function(){
    
 return [
     "status"=>[     
        "A"=>100,
        "B"=>120,
        "C"=>120,
        "D"=>120,
     ]
 ];   
});