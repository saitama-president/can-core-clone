<?php

namespace App\CCC\data_trait\user;

/**
 * Description of payment
 *
 * @author s-yoshihara
 */
trait payment {

    public function payments() {
        return $this->hasMany("App\CCC\data\user_payment");
    }

    public function getFreeStone() {

        return $this->payments()->where("payment_type", 1)->a;
    }

    public function getTotalStone() {
        
    }

    public function getPaymentStone() {
        
    }

}
