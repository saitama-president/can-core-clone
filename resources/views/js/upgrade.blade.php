@extends('layouts.scene')

{{--フレーム内の画面定義　--}}

@section('css')
    <link rel="stylesheet" href="{{url('css/play.css')}}">    
@endsection

@section('script')
<script>
    $("#HOME").ready(
      function(){

        bgm_play("/vendor/bgm/tol3.wav");        
       // alert('音！');
      }
    );
    
    
</script>
<script src="js/scene/home.js" ></script>

@endsection

@section('dom')

  <h2 class="title">改造</h2>
  
    {{-- ホーム画面 --}}
  <div id="HOME" class="background upgrade">
  </div>
  
  {{-- 基本メニュー --}}
  <div id="MENU">
    <div id="BUTTON_HOME" class="button">戻る</div>
  </div>


  {{-- HUD --}}
  @include('js.parts.hud')

  {{--通知関連--}}
  <div id="NOTIFY">
    <ul>
    </ul>
  </div>
  
  {{--時計--}}
  @include('js.parts.clock')
  
  <div id="WINDOW" class="hide">
    <h4>項目名</h4>
    <div class="close">×</div>
    <div></div>
  </div>

@endsection