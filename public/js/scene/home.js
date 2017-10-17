
/*各共通画面遷移ボタン処理（あとで切り出す）*/
$(document).ready(function () {
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

    $("#BUTTON_LAUNCH").on("click", function () {
        scene_change("/js/launch");
    }
    );
    $("#BUTTON_TEAM").on("click", function () {
      scene_change("js/team");
    }
    );
    $("#BUTTON_HOME").on("click", function () {
        scene_change("js/home");
    });
    
    $("#BUTTON_CREATE").on("click", function () {
        scene_change("/js/create");
    });
    $("#BUTTON_REPAIR").on("click", function () {
      scene_change("/js/repair");
    }
    );
    $("#BUTTON_CHARGE").on("click", function () {
      scene_change("/js/charge");
    }
    );
    $("#BUTTON_UPGRADE").on("click", function () {
      scene_change("/js/upgrade");
    }
    );
    
    $("#BUTTON_MISSION").on("click", function () {
      scene_change("/js/mission");
    }
    );
    
    $(".button").on("click",function(){
        se_play("/vendor/se/Click_Mechanical_01.mp3");
      
        var $t=$(this);
        $t.toggleClass("pressed");
        
        setTimeout(function($t){
          $t.toggleClass("pressed");
        },300,$t);
        
    });
    
    $("#WINDOW .close").on("click",function(){
      $("#WINDOW").toggleClass("hide");
    });
  
    $("#SCENE .CHAR").on("click",function(){      
        //セリフを出現させる
        
        se_play("/vendor/voice/kyoumoichiniti.mp3");
        $("#SCENE .CHAR .serif").toggleClass("off");
    });
    refresh();
});

$(".notify").ready(function(){
  
});

/**
 * 10秒おきに更新
 * →ここに定義するのは違う？
 * @return {undefined}
 */
setInterval(function () {refresh();}, 10000);
/*
 * 通知を表示
 * @param {type} $message
 * @return {undefined}
 */
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

function scene_change($next_scene){
    $.ajax({
        url: $next_scene,
        success: function (data) {
            //トランジション設定をする
            
            $("#contents").addClass("black-out");
            setTimeout(function(){
                $("#contents").addClass("black-in");
                $("#contents").removeClass("black-out");
                
                bgm_stop();
                $("#contents").html(data);
                
                setTimeout(function(){
                  $("#contents").removeClass("black-in");
                },3000);
            },3000);
        }
    });
}

function rand(min, max) {
  return Math.floor( Math.random() * (max - min + 1) ) + min;
}

function show_window(){
  $("#WINDOW").removeClass("hide");
}

