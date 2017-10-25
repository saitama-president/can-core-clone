<?php
use Illuminate\Support\Facades\Artisan;

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
    
    //iFrameの一番最初に表示するもの
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
    
    
    /*    
     *DOM出力だけするやつ
     * →値を入れないので認証は必要ない
     */
    Route::get("/js/create","CreateController@js_scene");
    Route::get("/js/launch","LaunchController@js_scene");
    Route::get("/js/repair","RepairController@js_scene");
    Route::get("/js/team","TeamController@js_scene");
    Route::get("/js/charge","ChargeController@js_scene");
    Route::get("/js/upgrade","UpgradeController@js_scene");
    Route::get("/js/mission","MissionController@js_scene");
    Route::get("/js/home","HomeController@js_scene");
    
    if(config("app.debug")){        
        Route::get("/debug/status","DebugController@status");
        Route::get("/debug/login","DebugController@login");
        
        //マスタ一覧画面
        Route::get("/debug/master","DebugController@master");
        
        Route::get("/debug/master_reload",function(){
            
            Artisan::call("master:load");
            
            return redirect("/debug/master")->with("message","取り込み完了");
        });
    }
    
    
});

