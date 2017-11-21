@extends('layouts.debug')

@section('head')

<style>
    canvas{
        width: 100vmin;
        min-width: 100vmin;        
        max-width: 100vmin;
        height:100vmin;
        min-height: 100vmin;
        max-height: 100vmin;
        
        background: gray;
    }
</style>

<script>
    var c=null;
    $(document).ready(function(){
        $("#canvas").click(function($e){
            
            
            
        });
        
        c=$("#canvas")[0].getContext('2d');
        
        c.beginPath();
        c.beginPath();
        c.moveTo(150,20);
        c.lineTo(250, 130);
        c.lineTo(50, 130);
        c.closePath();
        
        
    });
    
   function success(){
   }
    
   function async($url, $method = "GET", $data = {},$reload=true
    ){
        if(!$data._token){
            $data._token='{{csrf_token()}}';
        }
        $.ajax({
            url: $url,
            method: $method,
            data: $data,
            success: function ($data) {
                
                success();
                if($reload){
                    location.reload();
                }
            },
            error: function (err) {
                alert("失敗");
            }
        });
        return false;
    }
    
    
</script>

@endsection

@section('body')
<canvas id="canvas" width="100" height="100">
    
</canvas>

<div>
    <button onclick="return async('/master/map/point_add/{{$map_id}}');">＋</button>    
    
    
    <p>あいうえおかきくけこ</p>
</div>

@foreach(App\CCC\data\master_map_point
    ::where("map_id",$map_id)
    ->get() as $item)
<a>
    {{$item->id}}
</a>
 
@endforeach

@endsection