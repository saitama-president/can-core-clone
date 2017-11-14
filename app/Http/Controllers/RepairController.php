<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RepairController extends Controller
 implements \App\Common\ControllerRoute
{
    public $scene_name="repair";
    use Traits\JsSceneTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function status(){
        
        
        return $user->status();
    }
    
    public function repair($id){
        $user=request()->user;
        
        $card=$user->card($id);
        
        
        
        
    }

    public static function Routes() {
        Route::get("/js/repair","RepairController@js_scene");
        Route::get("/api/repair/{id}","RepairController@repair");
        Route::get("/play/repair","RepairController@index");
    }

}
