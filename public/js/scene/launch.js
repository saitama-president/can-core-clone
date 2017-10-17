$(document).ready(function () {
    
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
  
});

/**
 * 10秒おきに更新
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
                
                $("#contents").html(data);
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

