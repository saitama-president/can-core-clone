@extends('layouts.inner_frame')
{{--
  開始ボタンだけを置く
 --}}
 
 @section('scripts')
 
 
 
 @endsection
 
 @section('contents')
 
 <script>
   
   function start(){
     
     
     document.location.href="/index";
   }
   
 </script>
 
 <a onclick="start();">開始</a>
 @endsection