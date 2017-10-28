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
                case 2:return $this->create_build();
                default: return abort(403);
            }
        } catch (\Exception $e) {
            \Log::Debug("エラーでとるで");
            abort(500);
        }
    }
    
    

    private function create_build() {
        $items = [
            1=>request("A"),
            2=>request("B"),
            3=>request("C"),
            4=>request("D"),
        ];
        
        $line = request("L");

        $user = request()->user;

        try {
            /* 減らす */
            DB::transaction(
                function()
                use($items, $user) {
                //資材を消費
                foreach ($items as $k => $v) {
                    \Log::debug($k);
                    $asset=$user->assets()->where("asset_id",$k)->first();
                    \Log::debug($asset->id);
                    if (!$asset->spend($v)) {
                        throw new \Exception("素材足りひん[{$asset->value()} - $v {$k}]");
                    }
                }
                //素材を消費
                //結果を追加（製造リストに追加）
                //$user->addCard();
                
                
                $result_id = $user->add_create(
                    1, 1, 60
                );
                \Log::Debug("CREATE_ID={$result_id}");
            }
            );
        } catch (\Exception $e) {
            \Log::Debug("例外でとるで");
            \Log::Debug($e->getMessage());
            \Log::Debug($e->getTraceAsString());
            return "NG";
        }
        \Log::debug("CREATEする");
        \Log::debug(get_class($user));


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
    
    public function shortcut($id){
      $user = request()->user;
      
      $create=$user->creates()->where("id",$id)->first();

      $create->complete_at= \Carbon\Carbon::now()->addSecond(-1);
      
      $create->save();
      return "OK";
    }

    public static function Routes() {
        Route::get("/js/create", "CreateController@js_scene");
        Route::POST("/api/create", "CreateController@create");
        Route::get("/api/create/shortcut/{id}", "CreateController@shortcut");
        Route::get("/api/create/take/{id}", "CreateController@take");
        Route::get("/play/create", "CreateController@index");
    }

}
