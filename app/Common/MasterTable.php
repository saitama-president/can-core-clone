<?php
namespace App\Common;


interface MasterTable{
    
    public static function InitTable();
    public static function RegistMasterRow(Array $data=[]);
}