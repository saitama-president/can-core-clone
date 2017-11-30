<?php

namespace App\CCC\service;


use App\CCC\data\user as user;
use App\CCC\data\master as master;

/**
 * Description of DebugService
 *
 * @author s-yoshihara
 */
class DebugService {

    public function user_add($name = "test", $email = "test@test.com") {

        \Log::Debug("ユーザ追加デバッグ");

        $user = \App\User::where("email", $email)->first();
        if (!empty($user)) {
            return $user;
        }

        $user = new \App\User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt("test");
        $user->save();

        $ccc_user = new user\user();
        $ccc_user->id = $user->id;
        $ccc_user->name = $user->name;
        $ccc_user->save();

        \Event::Fire(new \App\Events\UserRegistedEvent($ccc_user));
        //いろいろ突っ込む
        /* 製造 */
        $ccc_user->creates()->save(
            new user_create([
            "line_id" => 1,
            "master_card_id" => 1,
            "created_at" => \Carbon\Carbon::now(),
            "complete_at" => \Carbon\Carbon::now()->addMinute()
            ])
        );
        /* カード */
        \Log::debug("ユーザは作成できた？");
        
        return $ccc_user;
    }
    
    

}
