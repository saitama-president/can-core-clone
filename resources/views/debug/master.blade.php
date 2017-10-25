@extends('layouts.debug')


@section('head')
<script>
    
    $(document).ready(function(){
       // $("ul").click(function(){alert("ミ(^)(^)");});
        
    });
    
    function toggle($id){
        
        $("#"+$id).toggleClass("show");
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
  <li>
    <h3 onclick="toggle('master_character')">キャラクタ一覧</h3>
    <div>
        <ul id="master_character" class="hide">
            @foreach($master_character as $item)
            <li>
                {{$item->id}}:{{$item->name}}
            </li>            
            @endforeach
        </ul>
    </div>
    
    
    <h3 onclick="toggle('master_rare')">レア度</h3>
    <div>
        <ul id="master_rare" class="hide">
            @foreach($master_rare as $item)
            <li>
                {{$item->id}}:{{$item->name}}
            </li>            
            @endforeach
        </ul>
    </div>

    <h3 onclick="toggle('voice_type')">ボイス種別</h3>
    <div>
        <ul id="master_rare" class="hide">
            @foreach($voice_type as $item)
            <li>
                {{$item->id}}:{{$item->name}}
            </li>            
            @endforeach
        </ul>
    </div>
    
    
  </li>


</ul>

@endsection