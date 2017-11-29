<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\CCC\data\user\user_team_member;

class TeamController extends Controller implements \App\Common\ControllerRoute {

  public $scene_name = "team";

  use Traits\JsSceneTrait;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('play', [
        "user" => request()->user
    ]);
  }

  public function status() {
    $user = request()->user;
    return $user->status();
  }

  public function edit_commit() {
    \Log::Debug("チーム編集");

    $user = request()->user;
    $team_id = request("team_id");
    $members = [
        request("A"),
        request("B"),
        request("C"),
        request("D"),
        request("E"),
        request("F"),
    ];
    \Log::Debug(var_export($members,true));
    $new_members=[];
    
    foreach($members as $index=>$card_id){
      
      $new_member=user_team_member::firstOrNew([
          "user_id"=>$user->id,
          "position_index"=>$index+1,
          "team_id"=>$team_id,
      ]);
      $new_member->card_id = $card_id;
      \Log::Debug("CID:".$card_id);
      $new_members[]=$new_member;  
      
    }

    $user->team($team_id)->members()->savemany($new_members);



    return "OK";
  }

  public function edit_list() {
    $user = request()->user;
    $team_id = request("team_id");
  }
  
  public function rename(){
    $user = request()->user;
    $team_id = request("team_id");
    $name = request("name");
    $team=$user->team($team_id);
    $team->name=$name;
    $team->save();
    
    return "OK";
  }

  public static function Routes() {
    Route::get("/js/team", "TeamController@js_scene");
    Route::POST("/api/team/edit", "TeamController@edit_commit");
    Route::POST("/api/team/rename", "TeamController@rename");
    Route::get("/api/team/edit", "TeamController@edit_list");
    Route::get("/play/team", "TeamController@index");
  }

}
