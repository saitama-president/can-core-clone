<?php
namespace App\Http\Controllers\Traits;


trait JsSceneTrait{
    
    public function js_scene(){
        return view("js/{$this->scene_name}");
    }
}