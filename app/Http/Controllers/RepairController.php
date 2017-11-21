<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RepairController extends Controller implements \App\Common\ControllerRoute {

  public $scene_name = "repair";

  use Traits\JsSceneTrait;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    
  }

  public function status() {


    return $user->status();
  }

  public function repair($id) {
    $user = request()->user;
    \Log::Debug("修理やで");

    $card = $user->card($id);

    \Log::Debug("{$card->status->hp}->100");
    if (100 == $card->status->hp) {
      \Log::Debug("HPいっぱいやから無理やで");
    }

    $user->repaires()->add($card->id);


    return "OK";
  }

  public function shortcut($id) {
    $user = request()->user;

    $repair = $user->repaires()->where("id", $id)->first();

    $repair->complete_at = \Carbon\Carbon::now()->addSecond(-1);

    $repair->save();
    return "OK";
  }

  public static function Routes() {
    Route::get("/js/repair", "RepairController@js_scene");
    Route::POST("/api/repair/{id}", "RepairController@repair");
    Route::POST("/api/repair/shortcut/{id}", "RepairController@shortcut");
    Route::get("/play/repair", "RepairController@index");
  }

}
