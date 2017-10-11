<?php

namespace App\CCC\data;

use Illuminate\Database\Eloquent\Model;

use App\CCC\data\user_create;

class user extends Model implements \App\Common\CreateTable {

    public $table="ccc_user";
    //
    public static function CreateTable(\Illuminate\Database\Schema\Blueprint $b) {
        $b->increments('id');
        $b->string('name',20);
        
        $b->timestamps();
    }

    use \App\CCC\data_trait\user\payment;
    use \App\CCC\data_trait\user\present;
    use \App\CCC\data_trait\user\card;
    use \App\CCC\data_trait\user\create;
    use \App\CCC\data_trait\user\asset;
    use \App\CCC\data_trait\user\charge;
    use \App\CCC\data_trait\user\house;
    use \App\CCC\data_trait\user\launch;
    use \App\CCC\data_trait\user\payment;
    use \App\CCC\data_trait\user\repair;
    use \App\CCC\data_trait\user\team;
    use \App\CCC\data_trait\user\upgrade;



}
