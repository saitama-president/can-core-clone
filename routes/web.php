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
    
    App\Http\Controllers\ChargeController::Routes();
    App\Http\Controllers\CreateController::Routes();    
    App\Http\Controllers\HomeController::Routes();
    App\Http\Controllers\LaunchController::Routes();
    App\Http\Controllers\MissionController::Routes();
    App\Http\Controllers\RepairController::Routes();
    App\Http\Controllers\TeamController::Routes();
    App\Http\Controllers\UpgradeController::Routes();    

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

