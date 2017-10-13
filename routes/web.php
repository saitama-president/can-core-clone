<?php

Route::get('/', function () {
    return view('index');
});

Route::get('play',function () {
    return view('play');
});
/*
Route::get('test',function () {
    
    $user=new App\CCC\data\user();
    \Event::Fire(new \App\Events\UserRegistedEvent($user));
    
    return ["OK"];
});*/

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home',"HomeController@home");
});

//session_tokenで認証する→必要はなくね？
Route::get('/home/{session_id}',"HomeController@home_from_session");
//手動
Route::POST('/api/login',"Auth\LoginController@manual_login");

Route::get('/home',"HomeController@home");



Route::group(['middleware' => ['play']], function () {
    
    //Route::get('/home',"HomeController@home");

    //出撃結果（レンダリングのみ）
    Route::get('/index',"HomeController@index");
    Route::get('/launch',"LaunchController@result");
    Route::get("/api/launch","LaunchController@launch");
    Route::get("/api/status","HomeController@status");    
    Route::get("/api/create","CreateController@create");
    
});

if(config("app.debug")){
  Route::get("/debug/login","DebugController@login");
}
