@extends('layouts.scene')

{{--フレーム内の画面定義　--}}

@section('css')
    <link rel="stylesheet" href="{{url('css/play.css')}}">    
@endsection

@section('script')
<script>
    bgm_play("/vendor/bgm.mp3");
</script>
<script src="js/scene/home.js" ></script>

@endsection

@section('dom')
   <h2 class="title">任務</h2>

  <div id="HOME" class="background mission">
  </div>
    {{-- ホーム画面 --}}
  <div id="LAUNCH" class="background">

  </div>
  
  {{-- 出撃リスト --}}
  <div id="LAUNCH_LIST">
      <h3>カテゴリ選択</h3>
      <ul>
          <li></li>
      </ul>

      
      <div class="STORY">
        <h4>海域選択</h4>
        <ul>
            <li></li>
        </ul>
      </div>
      <div class="PVP">
        <h4>対戦相手選択</h4>
        <ul>
            <li></li>
        </ul>
      </div>
      <div class="STORY">
        <h4>海域選択</h4>
        <ul>
            <li></li>
        </ul>
      </div>
      
      
  </div>


  {{-- HUD --}}
  @include('js.parts.hud')

  {{--シーン描画--}}
  <div id="SCENE">
    <div class="CHAR image">
      <div class="serif off">
        <p>今日も元気に頑張ろう</p>
      </div>
    </div>
  </div>
  
  {{--時計--}}
@include('js.parts.clock')
  
@endsection