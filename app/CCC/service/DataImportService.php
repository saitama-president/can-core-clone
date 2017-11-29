<?php

namespace App\CCC\service;

use App\User;
use PHPExcel;
use PHPExcel_IOFactory;


/**
 * Description of DebugService
 *
 * @author s-yoshihara
 */
class DataImportService {
    
    /*
     * 定義の順番が重要（マスタが他のマスタを参照するため）
     */
    const SHEET_LIST = [
        "master_character"=>"キャラクタ定義",
        "master_item"=>"アイテム定義",
        "master_item_asset"=>"資源アイテム定義",
        "master_item_stock"=>"消費アイテム定義",
        "master_item_achive"=>"実績定義",
        
        "master_rare_type"=>"レアリティ定義",
        
        "master_card_voice_category"=>"ボイスカテゴリ定義",
        "master_card_voice_type"=>"ボイス種別定義",
        "master_card"=>"カード定義",
        
        "master_recipient"=>"レシピテーブル定義",
        //"master_card"=>"レシピ朱つりょkう定義",
        
        //"master_card_voice"=>"ボイス定義",
        
        
        
        
        /*"master_item_stock"=>"消費アイテム定義",
        "master_item_unique"=>"個別アイテム定義",
        "master_item_achive"=>"アイテム定義",
        "master_item"=>"アイテム定義",*/
        
        /*
      "master_rare_type"=>"レアリティ定義",
      "master_card_class"=>"カードクラス定義",
      "master_card"=>"カード定義",
      "master_assets"=>"素材定義",
        
      "master_card_class"=>"カードクラス定義",
      "master_card"=>"カード定義",
*/
        
    ];

    public function loadFromExcel($excel) {
        require_once base_path('vendor/phpoffice/phpexcel/Classes/PHPExcel.php');
        
        \Illuminate\Support\Facades\DB::transaction(
            function()
            use($excel) {
            /*
              シートごとに登録を行う
             *              */
            $obj_reader = \PHPExcel_IOFactory::createReader('Excel2007');
            $book = $obj_reader->load(resource_path($excel));
            
            foreach(self::SHEET_LIST as $table=>$sheet_name){
                
                $sheet = $book->getSheetByName($sheet_name);
                \Log::Debug("$sheet_name シート読み込み");
                $data=$this->sheet2array($sheet);
                $class_name='\App\CCC\data\master\\'.$table;
                
                foreach($data as $row){
                    $class_name::RegistMasterRow($row);
                    
                }
                //var_dump($class_name::All()->toJson());
                echo "$class_name 登録完了\n";
                
                
                
            }     
        }
        );
    }

    private function sheet2array(\PHPExcel_Worksheet $sheet) {
        $result=[];
        $header=[];
        foreach($sheet->getRowIterator(1,1) as $head){
            foreach ($head->getCellIterator() as $k=>$cell) {
                $header[$k]=$cell->getValue();
            }            
        }
        
        //$v=$sheet->getCell("C1")->;
        //var_dump($sheet->getCellByColumnAndRow(2,2)->());
        
        foreach ($sheet->getRowIterator(2) as $line) {
            $row=[];
            foreach ($line->getCellIterator() as $key=>$cell) {
                
                
                $row[$header[$key]]=
                    $cell->isFormula()
                        ?($cell->getOldCalculatedValue()=="#N/A"?null:$cell->getOldCalculatedValue())
                        :$cell->getValue()
                    ;
                
                 //$row[$header[$key]]=$cell->getValue();
                //$row[$header[$key]]=$cell->Value();
                // セルの値取得
            }

            $result[]=$row;
        }
        
        return (object)$result;
    }

}
