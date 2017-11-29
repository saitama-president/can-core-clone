<?php
namespace App\CCC\data\traits;

/**
 * Description of belongsToUser
 *
 * @author s-yoshihara
 */
trait belongsToUser {
    
    public function user(){
        return $this->belongsTo(\App\CCC\data\user\user::class);
    }
}
