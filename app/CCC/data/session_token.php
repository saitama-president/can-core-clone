<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

/**
 * お気に入りランチャ用のトークン管理テーブル
 */
class session_token extends Model 
implements \App\Common\CreateTable
{
    public $table="session_token";
    /**
     * 基本仕様：
     * 一回生成したtokenは基本的に期間無制限で使える。
     * ただしこの認証はユーザ認証ではなくただのユーザID紐づけとしてのみ機能する。
     * なので、必要に応じて画面内からログイン操作を行わせる必要がある。
     * @param \Illuminate\Database\Schema\Blueprint $b
     */
    
    
    
    public static function RegUniqueToken($user_id){        
        $success=false;
        $miss_count=0;
        while($miss_count<100){
            $hash=md5(uniqid());
            try{
                $token=new session_token();
                $token->user_id=$user_id;
                $token->token=$hash;
                $token->save();
                
                return $hash;
            }
            catch(\Exception $e){
                \Log::debug("ハッシュかぶってる:{$hash}");
            }
            $miss_count++;
        }
        throw new Exception("ハッシュ生成に失敗");
    }

    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('token',32);
        
        $b->unique(['token'],"uniq_sess_token");
        
        $b->integer('user_id');
        $b->boolean('enable')->default(true);
        $b->timestamps();
    }
    
    public function user(){
        return $this->belongsTo("App\CCC\data\user","user_id","id");
    }

}
