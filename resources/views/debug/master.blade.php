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
      "master_c"=>"カードマスタ"
    ] as $id=>$v)
     <li>
        <h3 onclick="toggle('{{$id}}')">
          {{$v}}
          （{{
            ('App\CCC\data'.'\master_card')::count()}}）
        </h3>
        <div>
            <ul id="{{$id}}" class="hide">
                @foreach(App\CCC\data\master_card::all() as $item)
                <li>
                    {{$item}}
                </li>            
                @endforeach
            </ul>
        </div>
    </li>
    @endforeach
     <li>
        <h3 onclick="toggle('master_card')">カード一覧
          （{{App\CCC\data\master_card::count()}}）
        </h3>
        <div>
            <ul id="master_card" class="hide">
                @foreach(App\CCC\data\master_card::all() as $item)
                <li>
                    {{$item->id}}:{{$item->name}}
                </li>            
                @endforeach
            </ul>
        </div>
    </li>

  
    <li>
        <h3 onclick="toggle('master_character')">キャラクタ一覧
          （{{App\CCC\data\master_character::count()}}）
        </h3>
        <div>
            <ul id="master_character" class="hide">
                @foreach(App\CCC\data\master_character::all() as $item)
                <li>
                    {{$item->id}}:{{$item->name}}
                </li>            
                @endforeach
            </ul>
        </div>
    </li>

    <li>
        <h3 onclick="toggle('master_rare')">レア度</h3>
        <div>
            <ul id="master_rare" class="hide">
                @foreach(App\CCC\data\master_rare_type::all() as $item)
                <li>
                    {{$item->id}}:{{$item->name}}
                </li>            
                @endforeach
            </ul>
        </div>
    </li>

    <li>
        <h3 onclick="toggle('voice_type')">ボイス種別</h3>
        <div>
            <ul id="voice_type" class="hide">
                @foreach(\App\CCC\data\master_card_voice_type::all() as $item)
                <li>
                    {{$item->id}}:{{$item->name}}
                </li>            
                @endforeach
            </ul>
        </div>
    </li>

</ul>

@endsection