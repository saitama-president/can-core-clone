/*web audio関連*/
window.AudioContext = window.AudioContext || window.webkitAudioContext;  
var context = new AudioContext();



function bgm_play($url,$require_click=true){
  prepare_sound($url, function($buff) {
     
    if($require_click){
      $(document).on("click",function(){          
          play_loop($buff);
          $(document).off("click");
      });      
    } else{
      play_loop($buff);
    }    
  });
}

function se_play($url){
  prepare_sound($url, function($buff) {
    play_oneshot($buff);
  });  
}


// Audio 用の buffer を読み込む
function prepare_sound(url, fn) {  
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

function play_loop($b){
  var $src = context.createBufferSource();
  $src.buffer = $b;
  $src.loop =true;
  var $gain = context.createGain();
  $src.connect($gain);
  $gain.connect(context.destination);
  $gain.gain.value = 0.25;
  $src.start(0);
}

function play_oneshot($buff){
  
  var $src = context.createBufferSource();
  $src.buffer = $buff;
  var $gain = context.createGain();
  $src.connect($gain);
  $gain.connect(context.destination);
  $gain.gain.value = 0.5; 
  $src.start(0);
}



