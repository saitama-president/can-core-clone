@extends('layouts.frame')

@section('styles')
<link rel="stylesheet" href="{{url('css/play.css')}}" >
  
@endsection

{{--基本Json通信のみとするので表示系は扱わないが、画面サンプル--}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script src="{{url("/js/play.js")}}" ></script>
<script>


</script>
@endsection

@section('contents')

<div id='contents'>
  {{-- 基本メニュー --}}
  <div id="MENU">
    <div id="BUTTON_HOME">home</div>
    <div id="BUTTON_LAUNCH">出撃</div>
    <div id="BUTTON_TEAM">編成</div>
    <div id="BUTTON_CREATE">製造</div>
    <div id="BUTTON_REPAIR">修復</div>
    <div id="BUTTON_CHARGE">補給</div>
    <div id="BUTTON_UPGRADE">改造</div>
  </div>

  {{-- ホーム画面 --}}
  <div id="HOME">

  </div>

  {{-- HUD --}}
  <div id="HUD">
    <label class="A">燃<span class="value">0</span></label>
    <label class="B">弾<span class="value">0</span></label>
    <label class="C">石<span class="value">0</span></label>
    <label class="D">鉄<span class="value">0</span></label>
  </div>

  {{--通知関連--}}
  <div id="NOTIFY">

  </div>

  {{--シーン描画--}}
  <div id="SCENE">
    <div class="CHAR image">
      <div class="serif off">
        <p>今日も元気に頑張ろう</p>
      </div>
    </div>
  </div>
</div>
@endsection