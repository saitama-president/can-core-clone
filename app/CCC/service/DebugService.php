<?php

namespace App\CCC\service;

use App\User;

/**
 * Description of DebugService
 *
 * @author s-yoshihara
 */
class DebugService {

    public function user_add($name = "test", $email = "test@test.com") {

        \Log::Debug("ユーザ追加デバッグ");

        $user = User::where("email", $email)->first();
        if (!empty($user)) {
            return $user;
        }

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt("test");
        $user->save();

        $ccc_user = new \App\CCC\data\user();
        $ccc_user->id = $user->id;
        $ccc_user->name = $user->name;
        $ccc_user->save();


        \Event::Fire(new \App\Events\UserRegistedEvent($ccc_user));


        //いろいろ突っ込む
        /* 製造 */
        $ccc_user->creates()->save(
            new \App\CCC\data\user_create([
            "line_id" => 1,
            "master_card_id" => 1,
            "created_at" => \Carbon\Carbon::now(),
            "complete_at" => \Carbon\Carbon::now()->addMinute()
            ])
        );
        /* カード */
        $ccc_user->cards()->save(
            new \App\CCC\data\user_card([
            "line_id" => 1,
            "master_card_id" => 1,
            "created_at" => \Carbon\Carbon::now(),
            "complete_at" => \Carbon\Carbon::now()->addMinute()
        ]));
        \Log::debug("ユーザは作成できた？");
        
        return $ccc_user;
    }
    
    

}
