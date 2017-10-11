<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $items=[
            "A"=>request("A"),
            "B"=>request("B"),
            "C"=>request("C"),
            "D"=>request("D"),
        ];

        /*減らす*/
        $user=request()->user;
        
        try{
        DB::transaction(
            function()
            use($items,$user)
            {
                //資材を消費
                foreach($items as $k=>$v){
                   if(!$user->spend($k,$v)){
                       throw new \Exception("素材足りひん[{$k}]");
                   }
                }
                //素材を消費
                
                
                
                //結果を追加（製造リストに追加）
                
                 //$user->addCard();
                
            }
        );
        }
        catch (\Exception $e){
            return "NG";
        }
        \Log::debug("CREATEする");
        
        
        
        /*そして増やす*/
        return "OK";
    }
    
    public function status(){
        $user=request()->user;
        
        return $user->status();
    }
}
