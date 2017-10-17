@extends('layouts.scene')

{{--フレーム内の画面定義　--}}

@section('css')
    <link rel="stylesheet" href="{{url('css/play.css')}}">    
@endsection

@section('script')
<script>
    alert('出撃を表示した！');
    bgm_play("/vendor/bgm.mp3");
</script>
<script src="js/scene/home.js" ></script>

@endsection

@section('dom')
   <h2 class="title">出撃</h2>

  <div id="HOME" class="background launch">
  </div>
  {{-- ホーム画面 --}}
  <div id="LAUNCH" class="background">
  </div>
  
  {{-- 出撃リスト --}}
  <div id="LAUNCH_LIST">
      <h3>カテゴリ選択</h3>
      <ul>
          <li>攻略</li>
          <li>対戦</li>
          <li>遠征</li>
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
      
      
      {{-- 出撃ボタン --}}
      <div class="BUTTON">
          
          <label>
              1<input type=radio name="" value="1" />
          </label>
          
          <button>出撃！</button>
      </div>
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

  {{--シーン描画--}}
  <div id="SCENE">
    <div class="CHAR image">
      <div class="serif off">
        <p>今日も元気に頑張ろう</p>
      </div>
    </div>
  </div>
  
  {{--時計--}}
  <div id="DATE">
    <div id="TODAY"></div>      
    <div id="TIME"></div>
  </div>
  
@endsection