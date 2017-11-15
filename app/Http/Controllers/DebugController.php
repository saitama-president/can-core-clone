<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

class DebugController extends Controller implements \App\Common\ControllerRoute {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {

        if (empty(auth()->id())) {
            auth()->loginUsingId(1);
        }
    }

    public function status() {

        $user = request()->user;

        $user->repaires()->refresh();



        return view("debug.status", [
            "user" => $user
        ]);
    }

    public function home() {

        return view("debug.status", [
            "user" => $user
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
        \Log::Debug("強制ユーザ作成");
        $debug = new \App\CCC\service\DebugService();
        $user = $debug->user_add("email", "test@test.com");
        if (!empty($user)) {
            auth()->loginUsingId($user->id);
        }
        return redirect("/home");
    }

    public function asset_full() {
        $user = request()->user;

        \Log::Debug("素材回復するで{$user->name}");
        \Log::Debug("素材." . $user->assets()->get());

        foreach ($user->assets()->get() as $asset) {
            \Log::Debug("素材更新{$asset->id}");
            $asset->last_update = \Carbon\Carbon::now()->addDay(-1);
            $asset->save();
        }
        return redirect("/debug/status");
    }

    public function team_add() {
        $user = request()->user;

        //  \Log::Debug("チーム最大数？".);

        $user->teams()->save(new \App\CCC\data\user_team(["team_id" =>
            $user->teams()->max("team_id") + 1]));

        return redirect("/debug/status");
    }

    public function master() {


        return view("debug.master", [
            "master_character" => \App\CCC\data\master_character::all(),
            "master_rare" => \App\CCC\data\master_rare_type::all(),
            "voice_type" => \App\CCC\data\master_card_voice_type::all(),
        ]);
    }

    public static function Routes() {
        Route::get("/debug/create", "CreateController@js_scene");
        Route::get("/debug/status", "DebugController@status");
        Route::get("/debug/login", "DebugController@login");


        Route::get("/debug/asset_full", "DebugController@asset_full");
        Route::get("/debug/team_add", "DebugController@team_add");

        Route::get("/debug/map_add", function() {
            
        });
    }

}
