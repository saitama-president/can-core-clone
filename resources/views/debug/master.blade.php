@extends('layouts.debug')


@section('head')
<script>

    $(document).ready(function () {
        // $("ul").click(function(){alert("ミ(^)(^)");});

    });

    function toggle($id) {

        $("#" + $id).toggleClass("show");
    }

</script>

<style>
    #master_list ul{
        display: none;
    }
    .show{
        display: block;
    }
</style>
@endsection

@section('body')
<h1>マスタ情報</h1>
<a href="{{url('debug/status')}}">ステータス情報</a>

<a href="{{url('debug/master_reload')}}">マスタ再取込</a>

<h2>マスタ一覧</h2>
<ul id="master_list">
    @foreach([
      'App\CCC\data\master_card'=>"カード一覧",
      'App\CCC\data\master_character'=>"キャラクタ一覧",
      'App\CCC\data\master_rare_type'=>"レア度",
      'App\CCC\data\master_card_voice_type'=>"ボイス種別",
      'App\CCC\data\master_card'=>"カード一覧",
      'App\CCC\data\master_card'=>"カード一覧",
      'App\CCC\data\master_card'=>"カード一覧",
    ] as $class_name=>$label)
     <li>
        <h3 onclick="toggle('{{basename($class_name)}}')">
          {{$label}}
          （{{$class_name::count()}}）
        </h3>
        <div>
            <ul id="{{basename($class_name)}}" class="hide">                
                @foreach($class_name::all() as $item)
                <li>
                    {{$item}}
                </li>            
                @endforeach                
            </ul>
        </div>
    </li>
    @endforeach
</ul>

@endsection