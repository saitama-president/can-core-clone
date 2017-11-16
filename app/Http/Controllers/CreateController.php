<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class CreateController extends Controller implements \App\Common\ControllerRoute {

    public $scene_name = "create";

    use Traits\JsSceneTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        \Log::Debug("create呼び出し");
        try {

            $type = request("type");

            switch ($type) {
                case 1:return $this->create_build();
                case 2:return $this->create_develop();
                default: return abort(403);
            }
        } catch (\Exception $e) {
            \Log::Debug("エラーでとるで");
            abort(500);
        }
    }

    /**
     * 開発
     */
    private function create_develop() {
        $items = [
            1 => request("A"),
            2 => request("B"),
            3 => request("C"),
            4 => request("D"),
        ];

        $user = request()->user;

        $assets = $user->assets();
        \Log::Debug("開発しようとしてるで");
        foreach ($items as $k => $v) {
            if (!$assets->spend($k, $v)) {
                throw new \Exception("素材足りひん[ - $v {$k}]");
            }
        }
        //素材を消費
        //結果を追加（製造リストに追加）
        //
        //レシピから検索
        $master_card_id = 1;
        $complete_time = 120;

        $result_id = $user->creates()->add(
            $user->id, $line, $master_card_id, $complete_time
        );
        \Log::Debug("CREATE_ID={$result_id}");

        return "OK";
    }

    /**
     * 建造
     * @return string
     */
    private function create_build() {
        \Log::Debug("製造");
        $items = [
            1 => request("A"),
            2 => request("B"),
            3 => request("C"),
            4 => request("D"),
        ];

        $line = request("L");
        $user = request()->user;


        /* 減らす */
        $assets = $user->assets();
        //資材を消費
        foreach ($items as $k => $v) {
            if (!$assets->spend($k, $v)) {
                throw new \Exception("素材足りひん[{$asset->value()} - $v {$k}]");
            }
        }
        //素材を消費
        //結果を追加（製造リストに追加）
        //
        //レシピから検索

        $master_card_id = mt_rand(1, 3);
        $complete_time = mt_rand(1, 6)*30;

        $result_id = $user->creates()->add(
            $user->id, $line, $master_card_id, $complete_time
        );
        \Log::Debug("CREATE_ID={$result_id}");
        /* そして増やす */
        return "OK";
    }

    public function take($id) {
        $user = request()->user;
        \Log::debug("取得するで");
        $create = $user->creates()->where("id", $id)->first();

        if (
            empty($create) || !$create->is_takable
        )
            return abort(403);
        \Log::debug("取得できるはずやで");
        return $create->take() ? "OK" : abort(403);
    }

    public function status() {
        $user = request()->user;

        return $user->status();
    }

    /**
     * 分解
     */
    public function teardown($id) {
        $user = request()->user;
        $user->cards()->remove($id);
        return "OK";
    }

    /*
     * 廃棄
     */

    public function dispose($id) {
        
    }

    /**
     * 時短やで
     * @param type $id
     * @return string
     */
    public function shortcut($id) {
        $user = request()->user;

        $create = $user->creates()->where("id", $id)->first();

        $create->complete_at = \Carbon\Carbon::now()->addSecond(-1);

        $create->save();
        return "OK";
    }

    public static function Routes() {
        Route::get("/js/create", "CreateController@js_scene");
        Route::POST("/api/create", "CreateController@create")->middleware("transaction");
        Route::get("/api/create/shortcut/{id}", "CreateController@shortcut")->middleware("transaction");
        Route::get("/api/create/teardown/{id}", "CreateController@teardown")->middleware("transaction");
        Route::get("/api/create/take/{id}", "CreateController@take");
        Route::get("/play/create", "CreateController@index");
    }

}
