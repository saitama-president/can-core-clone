<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller {

    public $scene_name="create";
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

        $items = [
            "A" => request("A"),
            "B" => request("B"),
            "C" => request("C"),
            "D" => request("D"),
        ];
        
        $line=1;
        


        $user = request()->user;

        try {
            /* 減らす */
            DB::transaction(
                function()
                use($items, $user) {
                //資材を消費
                foreach ($items as $k => $v) {
                    if (!$user->spend($k, $v)) {
                        throw new \Exception("素材足りひん[{$k}]");
                    }
                }
                //素材を消費
                //結果を追加（製造リストに追加）
                //$user->addCard();
                $result_id= $user->add_create(
                    1,
                    1,
                    60
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
        
        $creates= DB::Select("SELECT * FROM user_create ");
        
        foreach($creates as $create){
            \Log::debug("$create->user_id ");
        }

        /* そして増やす */
        return "OK";
    }

    public function status() {
        $user = request()->user;

        return $user->status();
    }

}
