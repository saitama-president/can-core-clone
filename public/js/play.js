$(document).ready(function () {
  
    $("#SCENE .CHAR").on("click",function(){
      
        //セリフを出現させる
        $("#SCENE .CHAR .serif").toggleClass("off");
        $("#SCENE .CHAR .serif").toggleClass("fade-out");
    });
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
            alert('成功'+data);
            refresh();
        },
        error:function(){
            alert("通信に失敗しました");
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