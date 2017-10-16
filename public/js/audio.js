var context;
var bufferLoader;
window.AudioContext = window.AudioContext || window.webkitAudioContext;


$(document).ready(function () {
  // Fix up prefixing
  window.AudioContext = window.AudioContext || window.webkitAudioContext;
  if (context == null) {
    context = new AudioContext();
  }

  bufferLoader = new BufferLoader(
          context,
          [
            '/vendor/herewego.mp3',
            '/vendor/bgm.mp3'
          ],
          function($list){
            $.each($list,function($i,$val){
              var source = context.createBufferSource();
              
              source.buffer = $val;
              source.connect(context.destination);
              source.start(0);
              
            });
          });

  //bufferLoader.load();
});


function bgm_play($url, $require_click = false) {
  prepare_sound($url, function ($buff) {

    if ($require_click) {
      $(document).on("click", function () {
        play_loop($buff);
        $(document).off("click");
      });
    } else {
      play_loop($buff);
    }
  });
}

function voice_play($url) {


}

function se_play($url, $require_click = false) {
  prepare_sound($url, function ($buff) {
    if ($require_click) {
      $(document).on("click", function () {
        play_oneshot($buff);
        $(document).off("click");
      });
    } else {
      play_oneshot($buff);
    }

  });
}


// Audio 用の buffer を読み込む
function prepare_sound(url, fn) {
  var req = new XMLHttpRequest();
  // array buffer を指定
  req.responseType = 'arraybuffer';
  req.onreadystatechange = function () {
    if (req.readyState === 4) {
      if (req.status === 0 || req.status === 200) {
        // array buffer を audio buffer に変換
        context.decodeAudioData(req.response, function (buffer) {
          // コールバックを実行
          fn(buffer);
        });
      }
    }
  };
  req.open('GET', url, true);
  req.send('');
}
;

function play_loop($b) {
  var $src = context.createBufferSource();
  $src.buffer = $b;
  $src.loop = true;
  var $gain = context.createGain();
  $src.connect($gain);
  $gain.connect(context.destination);
  $gain.gain.value = 0.25;
  $src.start(0);
}

function play_oneshot($buff) {

  var $src = context.createBufferSource();
  $src.buffer = $buff;
  var $gain = context.createGain();
  $src.connect($gain);
  $gain.connect(context.destination);
  $gain.gain.value = 0.5;
  $src.start(0);
}




function BufferLoader(context, urlList, callback) {
  this.context = context;
  this.urlList = urlList;
  this.onload = callback;
  this.bufferList = new Array();
  this.loadCount = 0;
}

BufferLoader.prototype.loadBuffer = function(url, index) {
  // Load buffer asynchronously
  var request = new XMLHttpRequest();
  request.open("GET", url, true);
  request.responseType = "arraybuffer";

  var loader = this;

  request.onload = function() {
    // Asynchronously decode the audio file data in request.response
    loader.context.decodeAudioData(
      request.response,
      function(buffer) {
        if (!buffer) {
          alert('error decoding file data: ' + url);
          return;
        }
        loader.bufferList[index] = buffer;
        if (++loader.loadCount == loader.urlList.length)
          loader.onload(loader.bufferList);
      },
      function(error) {
        console.error('decodeAudioData error', error);
      }
    );
  }

  request.onerror = function() {
    alert('BufferLoader: XHR error');
  }

  request.send();
}

BufferLoader.prototype.load = function() {
  for (var i = 0; i < this.urlList.length; ++i)
  this.loadBuffer(this.urlList[i], i);
}
