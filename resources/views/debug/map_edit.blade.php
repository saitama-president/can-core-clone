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

        background: lightgray;
    }
    
    #canvas_overlay_point{
        position: absolute;
    }
</style>

<script>
    var c = null;
    $(document).ready(function () {
        $("#canvas").click(function ($e) {



        });

        c = $("#canvas")[0].getContext('2d');
        c.lineWidth=3;



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
    
    function drawPath($fx,$fy,$tx,$ty,$key="?"){

        
        c.beginPath();        
        c.fillStyle = 'rgb(255,0,0)';
        c.strokeStyle = 'rgb(255,0,0)';
        
        c.moveTo($fx,$fy);
        c.lineTo($tx,$ty);
        c.stroke();
        c.closePath();
        
        c.font = "1em 'ＭＳ Ｐゴシック'";
        c.strokeText("OK", 10, 25);
        
    }
    
    function drawPoint($fx,$fy,$key="?")
    {
    }


</script>

@endsection

@section('body')
<canvas id="canvas" width="1000" height="1000">
    <span>ABCDE</span>
</canvas>
<ul id="canvas_overlay_point">
    
</ul>

<div>
    <button onclick="return async('/master/map/point_add/{{$map_id}}');">＋</button>    

    <p>あいうえおかきくけこ
    </p>
</div>

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
            $('#POINT_{{$item->id}}').ready(function(e){
                drawPath(10,20,30,40);
            });
        </script>
    </li>

    @endforeach
</ul>
@endsection