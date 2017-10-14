<?php

Route::get('/', function () {
    return view('index');
});

Route::get('play',function () {
    return view('play');
});

Auth::routes();


//session_tokenで認証する→必要はなくね？
//手動
Route::POST('/api/login',"Auth\LoginController@manual_login");


Route::get('/home',"HomeController@home");
Route::get('/api/is_login',"Auth\LoginController@is_login");


Route::group(['middleware' => ['play']], function () {
    
    //Route::get('/home',"HomeController@home");
    Route::get('/enter',function(){return view("iframe.enter");});

    //出撃結果（レンダリングのみ）
    Route::get('/index',"HomeController@index");
    Route::get('/launch',"LaunchController@result");
    Route::get("/api/launch","LaunchController@launch");
    Route::get("/api/status","HomeController@status");    
    Route::get("/api/create","CreateController@create");
    
    /*各機能画面*/
    Route::get("/play/create","CreateController@index");
    Route::get("/play/launch","LaunchController@index");
    Route::get("/play/repair","RepairController@index");
    Route::get("/play/team","TeamController@index");
    Route::get("/play/charge","ChargeController@index");
    Route::get("/play/upgrade","UpgradeController@index");
    Route::get("/play/mission","MissionController@index");
    Route::get("/play/home","HomeController@index");
    
});

if(config("app.debug")){
  Route::get("/debug/login","DebugController@login");
}
