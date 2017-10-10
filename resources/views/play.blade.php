@extends('layouts.frame')

@section('styles')
<link rel="stylesheet" href="{{url('css/play.css')}}" >
  
@endsection

{{--基本Json通信のみとするので表示系は扱わないが、画面サンプル--}}
@section('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<script>

$(document).ready(function () {
    $("#BUTTON_HOME").on("click", function () {
    alert("aaa");
    }
    );
    $("#BUTTON_LAUNCH").on("click", function () {
    alert("aaa");
    }
    );
    $("#BUTTON_TEAM").on("click", function () {
    alert("aaa");
    }
    );
    $("#BUTTON_CREATE").on("click", function () {
      alert('製造');  
      $.ajax({
        url: "/api/create",
        cache:false,
        data:{
            "A":rand(3,20),
            "B":rand(3,20),
            "C":rand(3,20),
            "D":rand(3,20)
        },
        success: function (data) {
            alert('成功');
            refresh();
        }
      });
    }
    );
    $("#BUTTON_REPAIR").on("click", function () {
    alert("aaa");
    }
    );
    $("#BUTTON_CHARGE").on("click", function () {
    alert("aaa");
    }
    );
    $("#BUTTON_UPGRADE").on("click", function () {
    alert("aaa");
    }
    );
    refresh();
});

setInterval(
function () {refresh();}, 10000);

function refresh(){
  $.ajax({
    url: "/api/status",
    cache:false,
    crossDomain:true,
    xhrFields: {
    withCredentials: true
    },
    success: function (data) {

      var status = data.status;

      $("#HUD .A .value").text(data.A);
      $("#HUD .B .value").text(data.B);
      $("#HUD .C .value").text(data.C);
      $("#HUD .D .value").text(data.D);

    }
  });

  console.log("update");
    
}
function rand(min, max) {
  return Math.floor( Math.random() * (max - min + 1) ) + min;
}
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

  </div>
</div>
@endsection