@extends('layouts.debug')

@section('head')

<style>
    body{
        overflow-y: hidden;
    }
    
    #canvas_root{
        position: relative;
        margin: 0;
        padding: 0;
        width: 100vmin;
        min-width: 100vmin;        
        max-width: 100vmin;
        height:100vmin;
        min-height: 100vmin;
        max-height: 100vmin;
    }

    canvas{
        width: 100vmin;
        min-width: 100vmin;        
        max-width: 100vmin;
        height:100vmin;
        min-height: 100vmin;
        max-height: 100vmin;

        background: lightgray;
        position: absolute;
    }

    #canvas_overlay_point{
        position: absolute;
    }
    #canvas_overlay_point > li{
        position: absolute;
        list-style: none;
    }
    

    #info{
        position: relative;
    }
</style>

<script>
    var c = null;
    $(document).ready(function () {
        $("#canvas").click(function ($e) {



        });

        c = $("#canvas")[0].getContext('2d');
        c.lineWidth = 3;



    });

    function draw() {

    }

    function success() {
    }

    function async($url, $method = "GET", $data = {}, $reload = true
            ){
        if (!$data._token) {
            $data._token = '{{csrf_token()}}';
        }
        $.ajax({
            url: $url,
            method: $method,
            data: $data,
            success: function ($data) {

                success();
                if ($reload) {
                    location.reload();
                }
            },
            error: function (err) {
                alert("失敗");
            }
        });
        return false;
    }

    function drawPath($fx, $fy, $tx, $ty, $key = "?") {


        c.beginPath();
        c.fillStyle = 'rgb(255,0,0)';
        c.strokeStyle = 'rgb(255,0,0)';

        c.moveTo($fx, $fy);
        c.lineTo($tx, $ty);
        c.stroke();
        c.closePath();

        c.font = "1em 'ＭＳ Ｐゴシック'";
        c.strokeText("OK", 10, 25);

    }

    function drawPoint($fx, $fy, $key = "?")
    {
    }
    
    function dragBegin($e){
    }
    
    function dragEnd($sender,$e){
        console.log($e.clientX+":"+$e.clientY+"<"+$e.clientWidth);
        
        var $baseWidth=$("#canvas_root")[0].clientWidth;
        var $baseHeight=$("#canvas_root")[0].clientHeight;
        
        $vx=( $e.clientX / $baseWidth * 100.0)+"vmin";
        $vy=( $e.clientY / $baseHeight * 100.0)+"vmin";
        console.log($vx+":"+$vy);
        $($sender)
                .css('left',$vx )
                .css('top',$vy);
        
        console.log("終了");
    }


</script>

@endsection

@section('body')
<div id="canvas_root" dropzone="move">
    <canvas id="canvas" width="1000" height="1000" dropzone="move"></canvas>
    <ul id="canvas_overlay_point" dropzone="move">
        @foreach(App\CCC\data\master_map_point
            ::where("map_id",$map_id)
            ->get() as $item)
            <li style="left:10vmin;top:10vmin;" draggable=true 
                ondragstart="console.log('begin')"
                ondragend="dragEnd(this,event);"
                >({{$item->id}})</li>
        @endforeach
    </ul>
</div>    
<div id="info">
    <button onclick="return async('/master/map/point_add/{{$map_id}}');">＋</button>
    <h3>地点リスト</h3>
    <ul>
        @foreach(App\CCC\data\master_map_point
        ::where("map_id",$map_id)
        ->get() as $item)
        <li id="POINT_{{$item->id}}">
            <label >
                {{$item->id}}
                {{$item}}
            </label>
            <script>
                $('#POINT_{{$item->id}}').ready(function (e) {
                    drawPath(10, 20, 30, 40);
                });
            </script>
        </li>
        @endforeach
    </ul>        
</div>

@endsection