@extends('layouts.inner_frame')
{{--
  開始ボタンだけを置く
 --}}
 
 @section('scripts')
 
 
 
 @endsection
 
 
 
 @section('contents')
 
 <script>
   
   function start(){
     
     setTimeout(function(){       
       document.location.href="/index";
     },3000);
     
   }
   
   $(document).ready(
    function(){
      $(document).on("click",function(){
          alert("SE_再生準備");
          se_play("/vendor/herewego.mp3");
          $(document).off("click");
      });    
    }
  );
   
   
 </script>
 <style>
   #START{
     position: absolute;
     left: 50%;
     top: 50%;
   }
   
 </style>
 
 
 <div id="START" onclick="start();">開始</div>
 @endsection