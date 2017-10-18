<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command("user:add {email=test@admin.com} {name=test}",function(
    
    $email="test@admin.com",
    $name = "test"
    ){
    $this->comment("ユーザを追加します");
    
    
    
    $debug=new App\CCC\service\DebugService();
    \Illuminate\Support\Facades\DB::transaction(
        function()
        use($user,$debug,$name,$email)
        {
            $user= $debug->user_add($name, $email);
        }
        );
    
    
    
    $this->comment("ユーザを追加完了");
});

Artisan::command("status",function(){
    
    $user= \App\CCC\data\user::find(1);    
    foreach($user->assets()->get() as $a){
        $this->info("{$a->asset_id}:{$a->value()}");
    }

    /*
    foreach($user->cards()->get() as $c){
        $this->info($c->id);
    }*/

    
    $this->comment("Done");
});