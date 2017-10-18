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

Artisan::command("user:add {email=test@admin.com} {name=test}", function(

    $email = "test@admin.com",
    $name = "test"
    ) {
    $this->comment("ユーザを追加します");



    $debug = new App\CCC\service\DebugService();
    \Illuminate\Support\Facades\DB::transaction(
        function()
        use($user, $debug, $name, $email) {
        $user = $debug->user_add($name, $email);
    }
    );



    $this->comment("ユーザを追加完了");
});

Artisan::command("user_status {id=1}", function($id) {

    $user = \App\CCC\data\user::find($id);
    foreach ($user->assets()->get() as $a) {
        $this->info("{$a->asset_id}:{$a->value()}");
    }


    foreach ($user->cards()->get() as $c) {
        $this->info($c->id);
    }




    $this->comment("Done");
});

Artisan::command("master_load", function() {
    require_once base_path('vendor/phpoffice/phpexcel/Classes/PHPExcel.php');


    try {
        \Illuminate\Support\Facades\DB::transaction(
            function()
            {
            /*
                シートごとに登録を行う
             *              */
            $obj_reader = PHPExcel_IOFactory::createReader('Excel2007');
            $book   = $obj_reader->load(resource_path("master.xlsx"));
            $book->getSheetByName("シート名");
            $sheet = $book->getSheetByName("シート名");
            foreach ($sheet->getRowIterator() as $row) {
                $tmp = array();
                // 列イテレータ取得
                foreach ($row->getCellIterator() as $cell) {
                    // セルの値取得
                    $this->comment($cell->getValue());
                }
                $this->comment("NEXT...");
            }
        }
        );
    } catch (\Exception $e) {

        $this->error($e->getMessage());
        $this->info("マスタ登録処理は中断されました");
    }


    $this->comment("Done");
});
