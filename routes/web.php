<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
      App\Http\Controllers\DebugController::Routes();
      App\Http\Controllers\MasterEditController::Routes();
    }
    
    
});

