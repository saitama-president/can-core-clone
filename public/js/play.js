$(document).ready(function () {
  
    audio_play();

    setInterval(function(){
      var now=new Date();
      $("#TIME").text(
              (
                now.getHours() < 10
                ?("0"+now.getHours())
                :now.getHours()
              )
              +":"+
              (
                now.getMinutes() < 10
                ?("0"+now.getMinutes())
                :now.getMinutes()
              )
              );
      $("#TODAY").text(
              (
                (now.getMonth()+1) < 10
                  ?("0"+(now.getMonth()+1))
                  :((now.getMonth()+1))
              )
              +"/"+(
                now.getDate()<10
                ?("0"+now.getDate())
                :(now.getDate())
              )                       
      );
      
    },1000);
    
    $("#WINDOW .close").on("click",function(){
      $("#WINDOW").toggleClass("hide");
    });
  
    $("#SCENE .CHAR").on("click",function(){      
        //セリフを出現させる
        $("#SCENE .CHAR .serif").toggleClass("off");
    });
    $("#BUTTON_HOME").on("click", function () {
      notify("ホームボタンを押した");
    }
    );
    $("#BUTTON_LAUNCH").on("click", function () {
      notify("出撃ボタンを押した");
    }
    );
    $("#BUTTON_TEAM").on("click", function () {
      notify("チーム編成ボタンを押した");
    }
    );
    
    $("#BUTTON_CREATE").on("click", function () {
      show_window();
      
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
            notify("製造しました。結果"+data);
            
            refresh();
        },
        error:function(){
            alert("通信に失敗しました。画面をリロードしてください");
        }
      });
    }
    );
    $("#BUTTON_REPAIR").on("click", function () {
      notify("修理ボタンを押した");
    }
    );
    $("#BUTTON_CHARGE").on("click", function () {
      notify("補給ボタンを押した");
    }
    );
    $("#BUTTON_UPGRADE").on("click", function () {
      notify("改造ボタンを押した");
    }
    );
    
    $("#BUTTON_MISSION").on("click", function () {
      notify("任務ボタンを押した");
    }
    );
    
    $(".button").on("click",function(){
        var $t=$(this);
        $t.toggleClass("pressed");
        
        setTimeout(function($t){
          $t.toggleClass("pressed");
        },300,$t);
        
    });
    refresh();
});

$(".notify").ready(function(){
  //alert($(this).text());
  
});

setInterval(function () {refresh();}, 10000);

function notify($message){
  
  $li=$("<li>",{"class":"fade-in"}).text($message);
  $("#NOTIFY > ul").append($li);
  
  //クリックしても削除
  $li.on("click",function(){$(this).remove();});
  //30秒後に削除
  setTimeout(function($li){ $li.remove();},15000,$li);
  
}

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

function show_window(){
  $("#WINDOW").removeClass("hide");
}

/*web audio関連*/

function audio_play(){
  getAudioBuffer('/vendor/Menu_Titles 01.wav', function(buffer) {
    $(document).on("click",function(){
        
        playSound(buffer);
        $(document).off("click");
    });
    
  });
}
window.AudioContext = window.AudioContext || window.webkitAudioContext;  

var context = new AudioContext();
//グローバルのBGM再生フラグ
var BGMPlayed=false;

// Audio 用の buffer を読み込む
var getAudioBuffer = function(url, fn) {  
  var req = new XMLHttpRequest();
  // array buffer を指定
  req.responseType = 'arraybuffer';

  req.onreadystatechange = function() {
    if (req.readyState === 4) {
      if (req.status === 0 || req.status === 200) {
        // array buffer を audio buffer に変換
        context.decodeAudioData(req.response, function(buffer) {
          // コールバックを実行
          fn(buffer);
        });
      }
    }
  };

  req.open('GET', url, true);
  req.send('');
};

// サウンドを再生
function playSound(buffer) {  
  // source を作成
  var source = context.createBufferSource();
  // buffer をセット
  source.buffer = buffer;
  source.loop =true;
  // context に connect
  source.connect(context.destination);
  // 再生
  source.start(0);
};

