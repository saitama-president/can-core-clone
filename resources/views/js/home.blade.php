@extends('layouts.scene')

{{--フレーム内の画面定義　--}}

@section('css')
    <link rel="stylesheet" href="{{url('css/play.css')}}">    
@endsection

@section('script')
<script>
    $("#HOME").ready(
      function(){

        bgm_play("/vendor/bgm/tol1.wav");        
       // alert('音！');
      }
    );
    
    
</script>
<script src="js/scene/home.js" ></script>

@endsection

@section('dom')
  
    {{-- ホーム画面 --}}
  <div id="HOME" class="background home">
  </div>
  
  {{-- 基本メニュー --}}
  <div id="MENU">
    <div id="BUTTON_HOME" class="hide button"></div>
    <div id="BUTTON_MISSION" class="button"></div>
    <div id="BUTTON_LAUNCH" class="button"></div>
    <div id="BUTTON_TEAM" class="button"></div>
    <div id="BUTTON_CREATE" class="button"></div>
    <div id="BUTTON_REPAIR" class="button"></div>
    <div id="BUTTON_CHARGE" class="button"></div>
    <div id="BUTTON_UPGRADE" class="button"></div>
  </div>


  {{-- HUD --}}
  <div id="HUD">
    <div id="USER_INFO">
      <span>ユーザ名</span>
    </div>
    <div id="USER_ITEM">
    <label class="A text-box">
      <div class="icon">&nbsp;</div>
      <span class="value">0</span>
    </label>
    <label class="B text-box">
      <div class="icon">&nbsp;</div>
      <span class="value">0</span>
    </label>
    <label class="C text-box">
      <div class="icon">&nbsp;</div>
      <span class="value">0</span>
    </label>
    <label class="D text-box">
      <div class="icon">&nbsp;</div>
      <span class="value">0</span>
    </label>
    </div>
  </div>

  {{--通知関連--}}
  <div id="NOTIFY">
    <ul>
    </ul>
  </div>

  {{--シーン描画--}}
  <div id="SCENE">
    <div class="CHAR image">
      <div class="serif off">
        <p>今日も元気に頑張りましょう</p>
      </div>
    </div>
  </div>
  
  {{--時計--}}
  <div id="DATE">
    <div id="TODAY"></div>      
    <div id="TIME"></div>
  </div>
  
  
  <div id="WINDOW" class="hide">
    <h4>項目名</h4>
    <div class="close">×</div>
    <div></div>
  </div>

@endsection