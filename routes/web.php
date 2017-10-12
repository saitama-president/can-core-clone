<?php



Route::get('/', function () {
    return view('index');
});

Route::get('play',function () {
    return view('play');
});

Route::get('test',function () {
    
    $user=new App\CCC\data\user();
    \Event::Fire(new \App\Events\UserRegistedEvent($user));
    
    return ["OK"];
});

Auth::routes();

Route::group(['middleware' => ['play']], function () {
    Route::get('/home',"HomeController@index");
    //出撃結果（レンダリングのみ）
    Route::get('/launch',"LaunchController@result");
    Route::get("/api/launch","LaunchController@launch");
    Route::get("/api/status","HomeController@status");
    
    /*製造関連*/
    Route::get("/api/create","CreateController@create");
    
    
    
});

if(config("app.debug")){
  Route::get("/debug/login","DebugController@login");
}
