<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAll extends Migration {

  private $data_name_space = "\\App\\CCC\\data\\user";

  private function data_files() {
    return \File::files(app_path("CCC/data/user"));
  }
  
  private function master_files(){
      return \File::files(app_path("CCC/data/master"));
  }

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    echo "CREATE_INIT";


    foreach ($this->data_files() as $data) {
      //var_dump(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);
      $base_name = basename($data, '.php');
      
      $class_name = "$this->data_name_space\\$base_name";
      $table = new $class_name();
      $table_name = $table->table;
      var_dump("$base_name:$table_name 作成");
      Schema::dropIfExists($table_name);
      Schema::create($table_name, function(Blueprint $b)
              use($class_name, $table_name) {
//                    echo "テーブル：{$table_name} 作成 \n";
        $class_name::CreateTable($b);

        //マスタテーブルを実装しているかどうか
       
        //var_dump($implements);
      });
       $implements = class_implements($class_name);
       
      if (in_array('App\Common\MasterTable', $implements)) {
        $class_name::InitTable();
      }
    }
    
    var_dump("マスタ読み込み開始");
    
    try{
    //excelからマスタを入れる
        Illuminate\Support\Facades\Artisan::Call("master:load");
    }
    catch(\Exception $e){
        var_dump($e->getTraceAsString());
        var_dump($e->getMessage());
    }
    
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    foreach ($this->data_files() as $data) {
      //var_dump(\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class);
      $base_name = basename($data, '.php');
      $class_name = "$this->data_name_space\\$base_name";
      $table = new $class_name();
      $table_name = $table->table;
      var_dump($table_name . "作成");
      Schema::dropIfExists($table_name);
    }
  }

}
