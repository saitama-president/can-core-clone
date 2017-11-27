@extends('layouts.debug')


@section('head')
<script>

    $(document).ready(function () {
        // $("ul").click(function(){alert("ミ(^)(^)");});

    });

    function toggle($id) {

        $("#" + $id).toggleClass("show");
    }
    
    function notify($message="DONE"){
        
        $n=$("<p>").text('更新成功');
        $("#NOTIFY").append($n);
        
        setTimeout(function(){
            $n.remove();
        },5000);
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
            success: function (data) {
                
                notify();
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

<style>
    #master_list ul{
        display: none;
    }
    .show{
        display: block;
    }
    
    .notify{
        color: red;
    }
</style>
@endsection

@section('body')



<div class="notify" id="NOTIFY">
    @if(session('message')){{session('message')}}@endif
    
</div>

<h1>マスタ情報</h1>
<a href="{{url('debug/status')}}">ステータス情報</a>

<a href="{{url('debug/master_reload')}}">マスタ再取込</a>

<h2>マスタ一覧</h2>
<ul id="master_list">
    @foreach([
      'App\CCC\data\master_card'=>"カード一覧",
      'App\CCC\data\master_equipment'=>"装備一覧",
      'App\CCC\data\master_card_equip'=>"カード装備一覧",
      'App\CCC\data\master_character'=>"キャラクタ一覧",
      'App\CCC\data\master_rare_type'=>"レア度",
      'App\CCC\data\master_card_voice_type'=>"ボイス種別",
      'App\CCC\data\master_item'=>"アイテム全種",
      'App\CCC\data\master_launch'=>"出撃対象",
      'App\CCC\data\master_mission'=>"ミッション",
    ] as $class_name=>$label)
     <li>
        <h3 onclick="toggle('{{preg_match('#[^\\\]+$#',$class_name,$match)?$match[0]:""}}')">
          {{$label}}
          （{{$class_name::count()}}）
        </h3>
        <div>
            <ul id="{{preg_match('#[^\\\]+$#',$class_name,$match)?$match[0]:""}}" class="hide">                
                @foreach($class_name::all() as $item)
                <li>
                    {{$item->id}}:{{$item->name}}
                    <br>
                    {{$item}}
                </li>            
                @endforeach                
            </ul>
        </div>
    </li>
    @endforeach
    <li>
        <h3 onclick="toggle('master_map');">
            マップ
            （{{App\CCC\data\master_map::count()}}）
        </h3>
        <div>
            <a href="{{url('master/map/add')}}">＋</a>
            <ul id="master_map">
            @foreach(App\CCC\data\master_map::all() as $item)
            <li>                
                <label>
                    {{$item->id}}:
                    <input type="text" onchange="async(
                    '/master/map/name/{{$item->id}}','POST',{
                        'name':$(this).val()
                    },false);
                    " value="{{$item->name}}"/>
                    <a href="/master/map/edit/{{$item->id}}">編集</a>
                </label> 
            </li>
            @endforeach
            </ul>
            
        </div>
    </li>
</ul>

@endsection